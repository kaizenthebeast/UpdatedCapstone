<?php

 $hostName= "localhost";
 $dbUser  = "root";
 $dbPassword = "";
 $dbName   = "testing";
 
 $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
 if(!$conn){
   die("Database connection failed");
 }
 
 