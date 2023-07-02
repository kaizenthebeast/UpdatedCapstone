<?php
include("../userRegister/authentication.php");
include("../userRegister/dbs.php");
include("../admin/adminHeader.php");

?>



<!-- admin table page for archive submissions

-->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.approve-btn').click(function() {
      var id = $(this).data('id');
      console.log('ID:', id);
      $.ajax({
        type: 'POST',
        url: 'update.php',
        data: {
          id: id,
          approved: 1
        },
        success: function() {
          console.log('AJAX request successful');
          alert('The row has been approved.');
        },
        error: function(xhr, status, error) {
          console.log('AJAX request error:', error);
        }
      });
    });

    $('.view-btn').click(function(e) {
      e.preventDefault();
      var pdfPath = $(this).closest('tr').find('td.pdf-path').text();
      console.log('pdfPath:', pdfPath);

      window.open(pdfPath, '_blank');
    });


    $('.disapprove-btn').click(function() {
      var id = $(this).data('id');
      console.log('ID:', id);
      $.ajax({
        type: 'POST',
        url: 'delete.php',
        data: {
          id: id
        },
        success: function() {
          console.log('AJAX request successful');
          alert('The row has been disapproved and deleted.');
          window.location.reload();
        },
        error: function(xhr, status, error) {
          console.log('AJAX request error:', error);
        }
      });
    });

    $('.read-more-link').click(function(e) {
      e.preventDefault();
      var $truncatedContent = $(this).prev('.truncated');
      var $fullContent = $(this).next('.full');

      $truncatedContent.hide();
      $fullContent.show();

      $(this).hide();
    });
  });
</script>

<div class="container-fluid my-5 ">
  <div class="container-fluid">
    <div class="title text-center text-uppercase text-white rounded p-1" style="letter-spacing: .1em; background-color:rgb(4, 4, 132);">
      <h2>List of unapproved submissions</h2>

    </div>

    <div class="table-responsive">
      <table class="table table-striped ">
        <thead class="text-center" style="background-color: #F9B900;">
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Year</th>
            <th>Abstract</th>
            <th>Members</th>
            <th>Email</th>
            <th>Tags</th>
            <th>PDF</th>
            <th>Created At</th>
            <th>Approved</th>
            <th>Operation</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "testing";

          $conn = mysqli_connect($servername, $username, $password, $dbname);
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT * FROM thesis WHERE approved='0'";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["year"] . "</td>";

            $abstract = $row["abstract"];
            $maxCharacters = 150;
            if (strlen($abstract) > $maxCharacters) {
              $truncatedAbstract = substr($abstract, 0, $maxCharacters) . '...';
              $fullAbstract = $abstract;
              $abstract = '<span class="truncated">' . $truncatedAbstract . '</span>';
              $abstract .= ' <a href="#" class="read-more-link">Read More</a>';
              $abstract .= ' <span class="full" style="display: none;">' . $fullAbstract . '</span>';
            }
            echo '<td>' . $abstract . '</td>';

            echo "<td>" . $row["members"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["tags"] . "</td>";
            echo "<td class='pdf-path'>" . $row["pdf_path"] . "</td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "<td>" . $row["approved"] . "</td>";
            echo "<td>";
            echo "<div class='d-flex align-center flex-column'>";
            echo "<button type='button' class='view-btn btn-secondary border-0 p-1 mb-1 rounded' data-id='" . $row["id"] . "'>View</button>";
            echo "<button type='button' class='approve-btn btn-primary border-0 p-1 mb-1 rounded' data-id='" . $row["id"] . "'>Approve</button>";
            echo "<button type='button' class='disapprove-btn btn-danger border-0 p-1 mb-1 rounded' data-id='" . $row["id"] . "'>Disapprove</button>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
          }

          mysqli_close($conn);
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="btn-container">
    <a href="../admin/index.php" class="btn btn-primary">Back</a>
  </div>
</div>



<?php
include("../admin/adminFooter.php");
?>