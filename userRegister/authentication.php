<?php

session_start();


if(!isset($_SESSION['authenticated'])){

    echo "
            <script>
                alert('You need to log in first to access this page.');
                window.location.href = '../home/register.php';
            </script>
        ";
}



?>