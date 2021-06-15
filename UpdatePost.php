<?php

                   
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                            $postid = $_POST['Post_ID']; 
                          $filenamepost =$_FILES['posts']['name'];
                        if(!empty($filenamepost)){
                           if(file_exists("AdminData/PostManagement/Posters/" .$filenamepost)){
                                                            echo $filenamepost . " is already exists.";
                                                            exit;
                                                        }
                                                        else{
                                                           
                        
                                                            $qry="UPDATE `posts` SET `postImage`='$filenamepost' WHERE `postID`= '$postid'";
                                                            $result=mysqli_query($conn,$qry);
                                                            if($result)
                                                            {
                move_uploaded_file($_FILES["posts"]["tmp_name"], "AdminData/PostManagement/Posters/" . $filenamepost);
                                                                echo 'true';
                                                            }
                                                            else{
                                                            echo '3error';
                                                            exit;
                                                            }
                        
                                                            
                                                        }
                           
                       }
                       else{
                           echo "select file";
                           exit;
                       }
                    
                                                          

                       
                   }
                   
?>