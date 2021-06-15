<?php

                   
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                            $postid = $_POST['Post_ID']; 
                         
                         
                         //remove all the files
                         
                                                     
     $sql = "SELECT `postImage` FROM `posts` WHERE `postID`='$postid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                              // output data of each row
                                  while($row= $result->fetch_assoc()) {
                                   
                                   $filename= $row['postImage'];
                                if(file_exists("AdminData/PostManagement/Posters/" . $filename))
                                   {
                                       $filess= "AdminData/PostManagement/Posters/".$filename;
                                      unlink("$filess");
                                       
                                }
                                  }
                                }
                               
                                                    
     $sql = "SELECT `postImage` FROM `posts` WHERE `postID`='$postid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                              // output data of each row
                                  while($row= $result->fetch_assoc()) {
                                   
                                   $filename= $row['postImage'];
                                if(file_exists("AdminData/PostManagement/Posters/" . $filename))
                                   {
                                       $filess= "AdminData/PostManagement/Posters/".$filename;
                                      unlink("$filess");
                                       
                                }

                                  }
                                }
                             
                             
                              $sql = "SELECT `file` FROM `file` WHERE `postID`='$postid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                              // output data of each row
                                  while($row= $result->fetch_assoc()) {
                                   $filenamef= $row['file'];
                                if(file_exists("AdminData/PostManagement/Posters/PostersFile/" . $filenamef))
                                   {
                                       $filessf= "AdminData/PostManagement/Posters/PostersFile/".$filenamef;
                                      unlink("$filessf");
                                       
                                }

                                  }
                                }   
                           
                           
                                               
                            $qry="DELETE FROM `posts` WHERE `postID`='$postid'";
                                           $result=mysqli_query($conn,$qry);
                                           if($result)
                                           {
                                                    $qry="DELETE FROM `file` WHERE `postID`='$postid'";
                                                       $result=mysqli_query($conn,$qry);
                                                       if($result)
                                                       {
                                                          echo 'deleted'; 
                                                       }else{
                                                           echo 'error during deletion files';
                                                       }
                                            }
                                           else{
                                               echo 'error on deletion';
                                           }
                                        
                       
                   }
                   
?>