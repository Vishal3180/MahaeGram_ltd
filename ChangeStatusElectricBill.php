<?php

                   
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                              $EBID = $_POST['EBID'];
                              $status = $_POST['status'];
                              if(!empty($EBID)){
                                  
                            
                            if($status == 'fail'){
                                
                            $sql = "SELECT `EBID`, `franchiseID`, `ElectricMobileNumber`, `ConsumerNumber`, `ElectricBillAmount`, `date`, `TransactionNumber`, `ElectricBillStatus` FROM `ElectricBillDetails` WHERE `EBID`='$EBID'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                while($row= $result->fetch_assoc()) {
                                    
                                $billAmount = $row['ElectricBillAmount'];
                                $fid = $row['franchiseID'];
                                
                                    
                                }
                            }else{
                                echo 'not authenticated';
                                exit;
                                }
                            
                                
                                $sql = "SELECT `walleteIDUser`, `Total_Balance`, `franchiseID` FROM `UserWalleteDetails` WHERE `franchiseID`='$fid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                while($row= $result->fetch_assoc()) {
                                    
                                    $totalbalance = $row['Total_Balance'];
                                
                                    
                                }
                                }else{
                                echo 'Wallete Not Found';
                                exit;
                                }
                                
$qry="UPDATE `ElectricBillDetails` SET `ElectricBillStatus`='fail' WHERE `EBID`='$EBID'";
$result=mysqli_query($conn,$qry);
if($result)
{
    
    
    
}else{
    echo 'Electric Form Not Updated';
    exit;
}
                                $totalBalance = $totalbalance + $billAmount;
                                $qry="UPDATE `UserWalleteDetails` SET `Total_Balance`='$totalBalance' WHERE `franchiseID`='$fid'";
$result=mysqli_query($conn,$qry);
if($result)
{
    
    
    
    
    
    
    
}else{
    echo 'Wallete Not Updated';
    exit;
}
          
          
          function getName($n) {
$characters = '0123456789';
$randomString = '';

for ($i = 0; $i < $n; $i++) {
  $index = rand(0, strlen($characters) - 1);
  $randomString .= $characters[$index];
}

return $randomString;
}
$n=15;
$TransactionNumber = getName($n);
$qry="INSERT INTO `transactionDetails`(`TransactionNumber`, `franchiseID`, `ProductName`, `OperationWallete`, `TransactionAmount`,`TransactionStatus`) VALUES ('$TransactionNumber','$fid','ElectricBill Failed','Credit','$billAmount','Success')";
$result=mysqli_query($conn,$qry);
if($result)
{
    echo 'changed';
}else{
    echo 'Transaction Not Recorded';
    exit;
    
}                                
                                
                                
                            }else if($status=='paid'){
$qry="UPDATE `ElectricBillDetails` SET `ElectricBillStatus`='paid',`ElectricBill_commission`='2.5', `Commision_status`='Approved' WHERE `EBID`='$EBID'";
$result=mysqli_query($conn,$qry);
if($result)
{
    
    echo 'changed';
    
    
}else{
    echo 'Electric Form Not Updated';
    exit;
}
                                
                            }
                            
                            
                            
                              }else{
                                  echo 'Not Authenticated';
                              }         
                                







                                                
                                                
                                                
                                                
                                                
                                                
                                                        
                                                        

             }
                   
?>