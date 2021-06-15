<?php
// Initialize the session
session_start();
include 'config.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedinCenter"]) || $_SESSION["loggedinCenter"] !== true){
    header("location: index.php");
    exit;
}
$fid = $_SESSION["id"];
?>
<?php

   if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'config.php';
$Category = $_POST['Category'];
$productname = $_POST['productname'];
        $Date = $_POSt['Date'];
        $CName = $_POST['Name'];
        $CDOB = $_POST['DOB'];
        $CPhoto = $_POST['Photo'];
        $CSignature = $_POST['Signature'];
        $CMobile = $_POST['MobileNumber'];
        $CEmail = $_POST['Email'];
        $CPrint = $_POST['Reprint'];
        $PANNumber = $_POST['PANNumber'];
        
        
        $AppLastName = $_POST['AppLastName'];
        $AppFirstName = $_POST['AppFirstName'];
        $AppMiddleName = $_POST['AppMiddleName'];
        $FatherLastName = $_POST['FatherLastName'];
        $FatherFirstName = $_POST['FatherFirstName'];
        $FatherMiddleName = $_POST['FatherMiddleName'];
        $MotherLastName = $_POST['MotherLastName'];
        $MotherFirstName = $_POST['MotherFirstName'];
        $MotherMiddleName = $_POST['MotherMiddleName'];
        $AppBirthDate = $_POST['AppBirthDate'];
        $ISDCode = $_POST['ISDCode'];
        $STDCode = $_POST['STDCode'];
        $AppMobileNumber = $_POST['AppMobileNumber'];
        $AppEmail = $_POST['AppEmail'];
        $ProofOfIdentity = $_POST['ProofOfIdentity'];
        $ProofOfAddress = $_POST['ProofOfAddress'];
        $ProofOfDOB = $_POST['ProofOfDOB'];
        $AreaCode = $_POST['AreaCode'];
        $AoType = $_POST['AoType'];
        $RangeCode = $_POST['RangeCode'];
        $AoNo = $_POST['AoNo'];
        $status= "Pending";  
        $billAmount = $_POST['Price'];


        
        
                                                                                    $n=15;
                                                                                    function getName($n) {
                                                                                        $characters = '0123456789';
                                                                                        $randomString = '';
                                                                                    
                                                                                        for ($i = 0; $i < $n; $i++) {
                                                                                            $index = rand(0, strlen($characters) - 1);
                                                                                            $randomString .= $characters[$index];
                                                                                        }
                                                                                    
                                                                                        return $randomString;
                                                                                    }
                                                                                    
                                                                                    $TransactionNumber = getName($n); 
                                                                                    
                                                                                    
                                                                                    
              $sql = "SELECT `Total_Balance` FROM `UserWalleteDetails` WHERE `franchiseID`='$fid'";
                                  $result = $conn->query($sql);
                                  if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row= $result->fetch_assoc()) {
                                        $totalbalance = $row['Total_Balance'];
                                        
   }
  }
  else{
      echo 'wallete Not Found';
        exit;
      
  }
    if($billAmount <= $totalbalance){
                  $totalBalance = $totalbalance - $billAmount;  
                    $qry="UPDATE `UserWalleteDetails` SET `Total_Balance`='$totalBalance' WHERE `franchiseID`='$fid'";
                    $result=mysqli_query($conn,$qry);
                    if($result)
                    {
                        
                    }else{
                        echo 'balance Not Updated';
                        exit;
                    }
                        $qry="INSERT INTO `transactionDetails`(`TransactionNumber`, `franchiseID`, `ProductName`, `OperationWallete`, `TransactionAmount`,`TransactionStatus`) VALUES ('$TransactionNumber','$fid','CorrectionPAN','Debit','$billAmount','Success')";
                        $result=mysqli_query($conn,$qry);
                        if($result)
                        {
                            
                        }
                        else{
                            echo 'Transaction Not Recorded';
                            exit;
                        }
                         $sql = "INSERT INTO `NewPanCard1stStep`(`franchiseID`,`CategoryOfApplicant`,`PANfor`,`PANNumber`, `ApplicantLastName`, `ApplicantMiddleName`, `ApplicantFirstName`, `FatherLastName`,`FatherMiddleName`, `FatherFirstName`,`MotherLastName`, `MotherMiddleName`, `MotherFirstName`, `DOB`, `ISDCODE`, `STDCODE`, `MobileNumber`, `Email`, `ProofOfIdentity`, `ProofOfAddress`, `ProofOfDOB`, `AreaCode`, `AoType`, `RangeCode`, `AoNo`, `Status`, `CName`, `CMobile`, `CPhoto`, `CEmail`, `CDOB`, `CSign`, `CReprint`,`TransactionNumber`) VALUES ('$fid','$Category','Correction','$PANNumber','$AppLastName','$AppMiddleName','$AppFirstName','$FatherLastName','$FatherMiddleName','$FatherFirstName','$MotherLastName','$MotherMiddleName','$MotherFirstName','$AppBirthDate','$ISDCode','$STDCode','$AppMobileNumber','$AppEmail','$ProofOfIdentity','$ProofOfAddress','$ProofOfDOB','$AreaCode','$AoType','$RangeCode','$AoNo','Pending','$CName','$CMobile','$CPhoto','$CEmail','$CDOB','$CSignature','$CPrint','$TransactionNumber')";
                                if ($conn->query($sql) === TRUE) {
                                    echo 'Saved';
                                }
                                else{
                                    echo 'Pancard Is Not Saved Please Call To Addmin';
                                    exit;
                                }
                    
    }else{
        echo 'insufficient Balance';
        exit;
    }
   
       
   }

?>