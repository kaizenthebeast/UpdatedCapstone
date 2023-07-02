<!-- admin settings sidebar tab

-->

<?php
include ("../userRegister/authentication.php");
include ("../userRegister/dbs.php");
include ("../admin/adminHeader.php");




$userEmail = ""; // Initialize the variable with an empty string
$password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userEmail = $_POST['userEmail'];
    $password = $_POST['password'];

    // Rest of your code
}
?>

<div class="container my-5 p-2">
    
    <div class="card p-5 ">
        <div class="card-title  text-center rounded text-uppercase text-white" style="background-color:rgb(4, 4, 132) ;">
            <h1 class="card-title">Login Again</h1>
        </div>
        

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group mb-4">
                <label for="username">Email:</label>
                <input type="text" name="userEmail" class="form-control mt-2" value="<?php echo $userEmail; ?>">
            </div>
            <div class="form-group mb-4 ">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control mt-2" value="">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</div>


<?php
     include ("../admin/adminFooter.php");
?>