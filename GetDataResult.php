 <?php
              // Include the database configuration file
              include 'config.php';
              // Get image data from database
              echo '<div class="container">';
              $result = $conn->query("SELECT `SID`, `TypeName`, `LinkName`, `Link` FROM `scrolldetail` WHERE `TypeName`='Result'");
              ?>
              <?php if($result->num_rows > 0){ ?>
                      <?php while($row = $result->fetch_assoc()){ ?>
                        <div class="row container shadow-sm" style="margin-bottom:15px;">
                            <ul style="list-style-type:square;">
                        <li style="font-size:23px;">
                          <a href="<?php echo $row['Link']; ?>">
                          <p style="padding-top:25px;font-size:20px;color:black;">
                            <?php echo $row['LinkName']; ?>
                          </p>
                        </a>
                      </li>
                    </ul>
                      </div>
                      
                      
<?php }} ?>
</div>