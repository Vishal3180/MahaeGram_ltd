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
                $cls = $_POST['cls'];
             
$sql = "SELECT `postID`, `PostName`, `ImageName`,`postImage`,`date`, `ClassID` FROM `posts` WHERE `ClassID`='$cls' ORDER BY `date` DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
     ?>
               <?php 
            $strclass = $row['ClassID'];
            ?>
                <div class="col-sm-2 col-6 float-left" id="<?php echo $strclass; ?>" style='margin-bottom:15px;'>
              <div class="card shadow" style="width: auto;height:180px;background-color:#e6f2ff;border-style: solid;border-color:#607d8b;border-width: 5px;">
          <?php
                $pid =  base64_encode($row['postID']);
                echo "<a href='PostDetails.php?varpid=$pid'>";
            ?>
              <img src="Admin/Forms/APIs/AdminData/PostManagement/Posters/<?php echo $post = $row['postImage']; ?>" class="card-img-top" style="height:120px; width:120 "; alt=""/>
            <?php
            echo '</a>';
             ?>
             <div class="container-fluid">
               <?php
                     $pid = $row['postID'];
                 ?>
               <p class="text-center text-justify" style="font-size: 12px;color:black;font-stretch: expanded;font-size-adjust: 0.58;">
                  <?php  echo $row['PostName'];?>
                  
              </p>
             </div>
        </div>
        </div>

          <?php

    
  }
}else{
    echo 'notFound';
}


}

?>