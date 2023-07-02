<?php
include("dbs.php");
session_start();

if (isset($_POST['login'])) {
    $userEmail = $_POST['userEmail'];
    $password = $_POST['password'];

    $query = "SELECT * FROM registered_users WHERE userEmail = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Password matched
        if (password_verify($password, $row['password'])) {
            if ($row['verify_status'] == "1") {
                // Check userType
                if ($row['userType'] == 'admin') {
                    $_SESSION['authenticated'] = TRUE;
                    $_SESSION['auth_user'] = [
                        'fullName' => $row['fullName'],
                        'userEmail' => $row['userEmail'],
                    ];
                    header("Location: ../admin/index.php");
                } else if ($row['userType'] == 'user') {
                    $_SESSION['authenticated'] = TRUE;
                    $_SESSION['auth_user'] = [
                        'fullName' => $row['fullName'],
                        'userEmail' => $row['userEmail'],
                    ];
                    header("Location: ../loginHome/test.php?error=Email is not yet verified");
                    exit(0);
                } else {
                    // User type is not allowed
                    header("Location: ../home/register.php?error=User type is not allowed");
                    exit(0);
                }
            } else {
                // Email is not verified
                header("Location: ../home/register.php?error=Email is not yet verified");
                exit(0);
            }
        } else {
            // Password did not match
            header("Location: ../home/register.php?error=Wrong email or password");
            exit(0);
        }
    } else {
        // Email not found in the database
        header("Location: ../home/register.php?error=Email not registered");
        exit(0);
    }
} else {
    // Error executing the query
    $error_message = mysqli_error($conn);
    header("Location: ../home/register.php?error=Cannot run query: $error_message");
    exit();
}


?>