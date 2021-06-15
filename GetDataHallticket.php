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
              // Include the database configuration file
              include 'config.php';
             echo 'hello';
              // Get image data from database
              echo '<div class="container">';
              $result = $conn->query("SELECT `SID`, `TypeName`, `LinkName`, `Link` FROM `scrolldetail` WHERE `TypeName`='Hallticket' ORDER BY `Date` DESC");
              ?>
              <?php if($result->num_rows > 0){ ?>
                      <?php while($row = $result->fetch_assoc()){ ?>
                        <div class="row container shadow" style="margin-bottom:15px;">
                            <ul style="list-style-type:square;">
                        <li style="font-size: 28px;">
                          <a href="<?php echo $row['Link']; ?>">
                          <p style="padding-top:25px;font-size:20px;color:black">
                            <?php echo $row['LinkName']; ?>
                          </p>
                        </a>
                      </li>
                    </ul>
                      </div>
                      
<?php
}
                  
              }
                   }
              
?>
</div>