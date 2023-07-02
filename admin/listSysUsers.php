<!-- admin registration tab

-->

<?php
include("../userRegister/authentication.php");
require_once('../userRegister/dbs.php');
include ("../admin/adminHeader.php");


$passwordMinLength = 8;
$passwordErrorMessage = '';

if (isset($_POST['register_admin'])) {
    $userEmail = $_POST['userEmail'];
    $password = $_POST['password'];

    if (strlen($password) < $passwordMinLength) {
        $passwordErrorMessage = "Password should be at least $passwordMinLength characters long";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

        $query = "INSERT INTO registered_users (userEmail, password) VALUES ('$userEmail', '$hashedPassword')";
        mysqli_query($conn, $query);

        header("Location: listSysUsers.php");
        exit();
    }
}

if (isset($_POST['remove_admin'])) {
    $adminId = $_POST['admin_id'];

    $query = "DELETE FROM registered_users WHERE id = '$adminId'";
    mysqli_query($conn, $query);

    header("Location: listSysUsers.php");
    exit();
}

$query = "SELECT * FROM registered_users";
$result = mysqli_query($conn, $query);

$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>






<div class="container-fluid my-5">
  <h1 class="text-center">USER LIST</h1>

  <div class="row">
    <div class="col-md-12">
      <div class="table-wrapper bg">
        <div class="table-title px-5" style="background-color:rgb(4, 4, 132) ;">
          <div class="row">
            <div class="col-sm-6 ps-2 d-flex align-items-center justify-content-center">
              <h2 class="text-white text-uppercase" style="letter-spacing: .1em;">View Users</h2>
            </div>
            <div class="col-sm-6 p-0 d-flex justify-content-lg-end justify-content-center">
              <button type="button" class="btn text-uppercase text-white my-2" data-toggle="modal" data-target="#registerAdminModal" style="background-color:#F9B900; letter-spacing:.1em;">Register Admin</button>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead style="background-color: #F9B900;">
              <tr>
                <th>
                  <span class="custom-checkbox">
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll"></label>
                  </span>
                </th>
                <th>#</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user) : ?>
                <tr>
                  <td>
                    <span class="custom-checkbox">
                      <input type="checkbox" id="checkbox<?php echo $user['ID']; ?>" name="option[]" value="<?php echo $user['ID']; ?>">
                      <label for="checkbox<?php echo $user['ID']; ?>"></label>
                    </span>
                  </td>
                  <td><?php echo $user['ID']; ?></td>
                  <td><?php echo $user['userEmail']; ?></td>
                  <td>Admin</td>
                  <td>
                    <form method="POST" action="">
                      <input type="hidden" name="admin_id" value="<?php echo $user['ID']; ?>">
                      <button type="submit" class="btn btn-danger" name="remove_admin">Remove</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <a href="index.php" class="btn btn-primary mb-3">Back</a>
        <!-- <div class="clearfix">
          <ul class="pagination">

          </ul>
        </div> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="registerAdminModal" tabindex="-1" role="dialog" aria-labelledby="registerAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerAdminModalLabel">Register Admin</h5>
        <button type="button" class="close btn btn-secondary py-0 px-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="font-size: 1.5em;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if (!empty($passwordErrorMessage)) : ?>
          <div><?php echo $passwordErrorMessage; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
          <div class="form-group">
            <label for="username">Email:</label>
            <input type="text" class="form-control" id="userEmail" name="userEmail" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="register_admin">Register</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


    <?php
   include ("../admin/adminFooter.php");
    ?>

    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".xp-menubar").on('click',function(){
                $("#sidebar").toggleClass('active');
                $("#content").toggleClass('active');
            });

            $('.xp-menubar,.body-overlay').on('click',function(){
                $("#sidebar,.body-overlay").toggleClass('show-nav');
            });
        });
    </script>

