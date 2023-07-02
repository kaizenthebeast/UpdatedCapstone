<?php
session_start();
include('dbs.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $verify_query = "SELECT verify_token, verify_status FROM registered_users WHERE verify_token=? LIMIT 1";
    $stmt = mysqli_prepare($conn, $verify_query);
    mysqli_stmt_bind_param($stmt, 's', $token);
    mysqli_stmt_execute($stmt);
    $verify_query_run = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($verify_query_run) > 0) {
        $row = mysqli_fetch_array($verify_query_run);

        if ($row['verify_status'] == "0") {
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE registered_users SET verify_status='1' WHERE verify_token=? LIMIT 1";
            $stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($stmt, 's', $clicked_token);
            $update_query_run = mysqli_stmt_execute($stmt);

            if ($update_query_run) {
                 echo "
            <script>
                alert('User Email Verification is Successful');
                window.location.href = '../home/register.php';
            </script>
        ";
            } else {
                echo "
            <script>
                alert('User Email Verification is not Successful');
                window.location.href = '../home/register.php';
            </script>
        ";
            }
        } else {
            echo "
            <script>
                alert('Your Email is already been verified');
                window.location.href = '../home/register.php';
            </script>
        ";
        }
    } else {
        echo "
            <script>
                alert('Token verification does not exist');
                window.location.href = '../home/register.php';
            </script>
        ";
    }
} else {
    echo "
            <script>
                alert('Not Allowed in this page');
                window.location.href = '../home/register.php';
            </script>
        ";
}


?>



    <?php
    include "../home/footer.php";
    ?>
    