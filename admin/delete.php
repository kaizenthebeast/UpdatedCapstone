<!-- Admin delete function button

-->

<?php
$id = $_POST['id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM thesis WHERE id = $id";

if (mysqli_query($conn, $sql)) {
  echo "success";
} else {
  echo "error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
