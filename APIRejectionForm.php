<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'config.php';
    $fid = $_POST['FID'];
    $reason = $_POST['Reason'];
    $status = 'Reject';

   
        $qry ="UPDATE `filledformdetails` SET `FormStatus`='$status',`RejectReason`='$reason' WHERE `FilID`='$fid'";
        $result=mysqli_query($conn,$qry);
        if($result)
        {
                echo 'Saved';
                                
                                    
        }
        else{
                echo 'Error';
        }
   
}
?>