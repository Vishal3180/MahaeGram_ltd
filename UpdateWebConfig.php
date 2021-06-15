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
     $uid = $_SESSION['id'];
     $tittle = $_POST['title'];
     $HeaderShopName = $_POST['HeaderShopName'];
     $officeTime = $_POST['Officetime'];
     $TopHeaderContact = $_POST['TopHeaderContact'];
     $Email = $_POST['EmailID'];
     $ShopNameOnImage = $_POST['ShopNameOnImage'];
     $FooterContact = $_POST['FooterContact'];
     $FooterWhatsAppNumber = $_POST['FooterWhatsAppNumber'];

     $a1 = $_POST['AddressLine1'];
     $a2 = $_POST['AddressLine2'];
     $a3 = $_POST['AddressLine3'];
     $a4 = $_POST['AddressLine4'];
     $EnquiryWhatsApp = $_POST['EnquiryWhatsApp'];
     $JoinWhatsAppGroupLink = $_POST['JoinWhatsAppGroupLink'];
     $facebook = $_POST['Facebook'];
     $Instagram = $_POST['Instagram'];
     $Twitter = $_POST['Twitter'];
     $Printerest = $_POST['Printerest'];
   //$area=$_POST['Area'];

   $sql = "UPDATE `webconffgcientdetails` SET`title`='$tittle',`HeaderShopName`='$HeaderShopName',`officeTime`='$officeTime',`TopHeaderContact`='$TopHeaderContact',`EmailID`='$Email',`ShopNameOnImage`='$ShopNameOnImage',`FooterContact`='$FooterContact',`FooterWhatsAppNumber`='$FooterWhatsAppNumber',`AddressLine1`='$a1',`AddressLine2`='$a2',`AddressLine3`='$a3',`AddressLine4`='$a4',`EnquiryWhatsApp`='$EnquiryWhatsApp',`JoinWhatsAppGroupLink`='$JoinWhatsAppGroupLink',`Facebook`='$facebook',`Twitter`='$Twitter',`Instagram`='$Instagram',`Printerest`='$Printerest' WHERE `franchiseID`='$fid'";
   if ($conn->query($sql) === TRUE) {
     echo 'true';
}
else{
    echo 'false';
}
}
      // there is something in the field, do stuff

   ?>
