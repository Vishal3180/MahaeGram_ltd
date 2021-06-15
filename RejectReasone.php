<?php
// Initialize the session
session_start();
include 'config.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedinCenter"]) || $_SESSION["loggedinCenter"] !== true){
    header("location: index.php");
    exit;
}
?>
<?php

                   
                                

    if($_SERVER["REQUEST_METHOD"] == "POST"){
            include 'config.php';
            $fillid = $_POST['post_link'];
            
            $sql = "SELECT `RejectReason` FROM `filledformdetails` WHERE `FilID`='$fillid'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                // output data of each row
                while($row= $result->fetch_assoc()) {
                        echo $row['RejectReason'];
                    }
                }
            else{
                echo 'error 1';
                exit;
                }

        }