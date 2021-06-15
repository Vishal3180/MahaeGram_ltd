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
                       

?>
<div class="container">
<table class="table table-striped">
  <thead class="bg-info">
  
  </thead>
  <tbody>

<?php
include 'config.php';
$count=0;
$sql = "SELECT `All_Name_For_POST_PDF`, `PDF_Name` FROM `AllPdf` ORDER BY `All_PDF_Date` DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
     ?>
        <tr>
            <td>
                <?php echo $count++; ?>
            </td>
            <td>
                <?php echo $row['All_Name_For_POST_PDF'];
                $pdf = $row['PDF_Name'];
                ?>
            </td>
            <td class="text-right">
                <a href="Admin/Forms/APIs/AdminData/PostManagement/ALLPDF/<?php echo $pdf; ?>" class="btn btn-info btn-sm" download="<?php echo $pdf; ?>">
                                                 Download
                                    </a>
                
            </td>
            
        </tr>
        



                       
    <?php }
}
else{?>
    <tr>
            <td>
                No Data Found
            </td>
            <td>
                None
                
            </td>
            
        </tr>
<?php
    
}
?>

</tbody>
</table>
</div>

<?php
                       
                   }
                   
?>