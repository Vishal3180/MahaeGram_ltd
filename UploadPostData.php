<?php
// Initialize the session
session_start();
include 'config.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedinAdmin"]) || $_SESSION["loggedinAdmin"] !== true){
    header("location: index.php");
    exit;
}

?>
<?php

   if($_SERVER["REQUEST_METHOD"] == "POST"){
                        include 'config.php';
                        $postid = $_SESSION["postid"]; 
                        
                        
                        $classtype = $_POST['ClassmType'];
                        $link = $_POST['Link'];
                        $nameoflink = $_POST['NameOfLink'];
                        $pdfname = $_POST['FileName'];
                        $filenamepdf =$_FILES['PDF']['name'];
                        
                        if($classtype=='PDF' || $classtype == 'Image'){
                            
                               if(!empty($filenamepdf)){
                                   if(file_exists("AdminData/PostManagement/Posters/PostersFile/" .$filenamepdf)){
                                                                    echo $filenamepdf . " is already exists.";
                                                                    exit;
                                                                }
                                                                else{
                                                                    
                                
                                                $qry="INSERT INTO `file`(`file`, `FileName`, `TypeName`, `PostID`) VALUES ('$filenamepdf','$pdfname','$classtype','$postid')";
                                                                    $result=mysqli_query($conn,$qry);
                                                                    if($result)
                                                                    {
    move_uploaded_file($_FILES["PDF"]["tmp_name"], "AdminData/PostManagement/Posters/PostersFile/" . $filenamepdf);
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
                                    
                           //end her 
                           
                            }else if($classtype=='Link'){
                                
                                //link
                $qry="INSERT INTO `file`(`FileName`,`TypeName`,`LinkName`, `PostID`) VALUES ('Link','$classtype','$link','$postid')";
                                                                    $result=mysqli_query($conn,$qry);
                                                                    if($result)
                                                                    {
                                                                        echo 'true';
                                                                    }
                                                                    else{
                                                                    echo 'link error';
                                                                    exit;
                                                                    }
                                
                                                                    
                                                                }
                                
                                
                           
                        
                        
                      
                                                          

                       
                   }
                   
?>