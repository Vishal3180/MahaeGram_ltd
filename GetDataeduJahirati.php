<?php

include 'config.php';
$sql = "SELECT `postID`, `PostName`, `ImageName`,`postImage`, `litePostImage`,`date`, `ClassID` FROM `posts` WHERE `ClassID`='2' ORDER BY `date` DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
     ?>
            <div class="col-sm-2 col-6 float-left" style="margin-bottom:15px;">
              <div class="card shadow" style="width: auto;height:180px;background-color:#e6f2ff;border-style: solid;border-color:#607d8b;border-width: 5px;">
          <?php
                $pid = $row['postID'];
                echo "<a href='postInformation.php?varpid=$pid'>";
            ?>
              <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['litePostImage']);?>" class="card-img-top" style="height:120px; width:120 "; alt=""/>
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
    echo 'error';
}

/*$myJSON = json_encode($emparray);

echo $myJSON;
*/

?>