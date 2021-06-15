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
            
            $amount= $_POST['Amount'];
            $transaction = $_POST['transactionNumber'];
            $transactionFor = 'Add AMount To Wallete';
            $PaymentMode = $_POST['PaymentMode'];
            $fid = $_POST['fid'];
            
            
            $fileNameScreeShot=$_FILES['ScreenShot']['name'];
                         $filesize=$_FILES['ScreenShot']['size'];
                         $filetypeSelfDeclaration =$_FILES['ScreenShot']['type'];
                                        
                        if(file_exists("Documents/WalleteRequest/" . $fileNameScreeShot)){
                            echo $fileNameScreeShot . " is already exists.";
                            exit;
                        } 
                        else{
                                move_uploaded_file($_FILES["ScreenShot"]["tmp_name"], "Documents/WalleteRequest/" . $fileNameScreeShot);
                                 $qry ="INSERT INTO `pendingtransactionrequest`(`franchiseID`,`PaymentMode`,`TransactionNumber`, `TransactionFor`, `TransactionAmount`,`status`,`operationFor`,`TransactionPhoto`) VALUES ('$fid','$PaymentMode','$transaction','$transactionFor','$amount','Pending','Credit','$fileNameScreeShot')";
            $result=mysqli_query($conn,$qry);
            if($result)
            {
              echo 'true';
            }
            else
            {
                echo "Error: " . $qry . "<br>" . $conn->error;
            }
                        } 
                        
                        
                        
           
            
            

        }