<?php

                   
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                               $pendingid = $_POST['pendingid']; 
                              $decision = $_POST['decision'];
                            
                            
                        if($decision=='Approved'){    
                            $sql = "SELECT `franchiseID`,`TransactionAmount` FROM `pendingtransactionrequest` WHERE `PendingTransID`='$pendingid'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row= $result->fetch_assoc()) {
                            
                            $billAmount = $row['TransactionAmount'];
                            $fid = $row['franchiseID'];
                            
                            }
                            }else{
                            echo 'error 1';
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
                            echo 'error 2';
                            exit;
                            }


                                            $totalBalance = $totalbalance + $billAmount;
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


$qry="UPDATE `UserWalleteDetails` SET `Total_Balance`='$totalBalance' WHERE `franchiseID`='$fid'";
$result=mysqli_query($conn,$qry);
if($result)
{
$qry1="INSERT INTO `transactionDetails`(`TransactionNumber`, `franchiseID`, `ProductName`, `OperationWallete`, `TransactionAmount`,`TransactionStatus`) VALUES ('$TransactionNumber','$fid','Credited By Admin','Credit','$billAmount','Success')";
$result=mysqli_query($conn,$qry1);
if($result)
{
    
$qry2="UPDATE `pendingtransactionrequest` SET `status`='Approved' WHERE `PendingTransID`='$pendingid'";
$result=mysqli_query($conn,$qry2);
if($result)
{
      echo 'changed'; 

}
else{
    echo "error";
}
    
    
}
else{
echo '3error';
exit;
}

}else{
echo '4error';
exit;
}




}
else if($decision=='Rejected'){
                    $qry2="UPDATE `pendingtransactionrequest` SET `status`='Rejected' WHERE `PendingTransID`='$pendingid'";
                $result=mysqli_query($conn,$qry2);
                if($result)
                {
                      echo 'changed'; 
                
                }
                else{
                    echo "error";
                }
}

}
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                           
                    
                                
                                

                   
?>