<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
include "dbs.php";





function sendemail_verify($fullName, $userEmail, $verify_token)
{
	//Load Composer's autoloader
	require __DIR__ . '/../PHPMailer/src/Exception.php';
	require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
	require __DIR__ . '/../PHPMailer/src/SMTP.php';


	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);
	$mail->isSMTP();                                            //Send using SMTP
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication

	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through 
	$mail->Username   = '8200722@ntc.edu.ph';                     //SMTP username
	$mail->Password   = 'godlikes12';                               //SMTP password

	$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
	$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients
	$mail->setFrom('8200722@ntc.edu.ph', 'Academic Research Portal');
	$mail->addAddress($userEmail);     //Add a recipient



	//Content
	$mail->isHTML(true);                                  //Set email format to HTML
	$mail->Subject = 'Email Verification from Academic Research Portal';

	$email_template = "
    
     <h2>You have Registered with Academic Research Portal</h2>
     <p>Please Click the link given to verify your acccount </p>
     <br/><br/>
     <a href='http://localhost/digital%20Archiving/userRegister/verification.php?token=$verify_token'>Click me to verify</a>
    ";


	$mail->Body    = $email_template;


	$mail->send();
	echo "
      <script>
         alert('Message has been sent to your email account');
      </script>
    ";
}



$errorEmpty = false;
$errorEmail = false;

if (isset($_POST['fullName']) || isset($_POST['userEmail']) || isset($_POST['password']) || isset($_POST['confirmPassword'])) {
    $fullName = $_POST['fullName'];
    $userEmail = $_POST['userEmail'];
    $password = $_POST['password'];
    $re_pass = $_POST['confirmPassword'];
    $verify_token = md5(rand());

    // Check if email is already exist in the database
    $check_mail_query = "SELECT userEmail FROM registered_users WHERE userEmail='$userEmail' LIMIT 1";
    $check_mail_query_run = mysqli_query($conn, $check_mail_query);

    $response = array(
        'status' => 0,
        'message' => 'Form Submission Failed'
    );

    if (!empty($fullName) && !empty($userEmail) && !empty($password) && !empty($re_pass)) {
        $response = array(); // Initialize the response array
       //  error handler 
        if (!preg_match('/^[a-zA-Z ]+$/', $fullName)) {
            $response['message'] = 'Please enter a valid full name';
        }elseif (strlen($fullName) < 6) {
            $response['message'] = 'Enter  your complete full name';
        }
         elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $response['message'] = 'Please enter a valid email';
        } elseif (strlen($password) < 5) {
            $response['message'] = 'Password must be at least 5 characters long';
        } elseif ($password !== $re_pass) {
            $response['message'] = 'Passwords do not match';
        } elseif (mysqli_num_rows($check_mail_query_run) > 0) {
            $response['message'] = 'Email is already taken';
        } 
		
		else{
            // Hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO registered_users (fullName, userEmail, password, verify_token) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $fullName, $userEmail, $password, $verify_token);
            $query_run = mysqli_stmt_execute($stmt);

            if ($query_run) {
                $response['status']= 1;
                $response['message'] = 'Please Verify your account.';
                sendemail_verify($fullName, $userEmail, $verify_token);
            
                
            } else {
                $response['message'] = 'Registration is failed';
            }
        }
    } else {
        $response['message'] = 'All input fields are required';
		$errorEmpty =true;
    }

    echo json_encode($response);
}

