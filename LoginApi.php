<?php
require_once "config.php";
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["UserName"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["UserName"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT `franchiseID`,`Fname`, `Lname`, `password` ,`ShopName`,`Address`,`Mobile`,`Status` FROM users WHERE `franchiseID` ='$username' AND `password`='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row= $result->fetch_assoc()) {
          session_start();
          // Store data in session variables
          $_SESSION["loggedinCenter"] = true;
          $_SESSION["id"] = $row['franchiseID'];
          $_SESSION["Fname"] = $row['Fname'];
          $_SESSION["Lname"] = $row['Lname'];
         $_SESSION['Status'] = $row['Status'];
          $_SESSION["Address"] = $row['Address'];
          $_SESSION["ShopName"] = $row['ShopName'];
          $_SESSION["Mobile"] = $row['Mobile'];
          // Redirect user to welcome page
         echo 'auth';
        }
      }
        else{
        echo 'noauth';
        }
    }

    // Close connection

}
  mysqli_close($conn);
  
?>