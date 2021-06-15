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
  //for image
      if($_SERVER["REQUEST_METHOD"] == "POST"){
          
          include 'config.php';
          $SevriceName = $_POST['ServiceName'];
          $filename =$_FILES['ServiceFile']['name'];
          
          if(file_exists("ClientData/DataMyBusiness/MyServices/" . $filename)){
                                                echo $filename . " is already exists.";
                                                exit;
                                            }
                                            else{
                                                move_uploaded_file($_FILES["ServiceFile"]["tmp_name"], "ClientData/DataMyBusiness/MyServices/" . $filename);
                                                
          $sql = "SELECT `WEBID` FROM `webconffgcientdetails` WHERE `franchiseID`='$fid'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          while($row= $result->fetch_assoc()) {
                        $webid= $row['WEBID'];

                      }
          }

          $qry="INSERT INTO `services`(`WEBID`,`ServiceName`, `ServiceImage`) VALUES ('$webid','$SevriceName','$filename')";
          $result=mysqli_query($conn,$qry);
          if($result)
          {
              
              echo 'true';
          }
          else
          {
              echo 'false';

          }

}
}

  ?>