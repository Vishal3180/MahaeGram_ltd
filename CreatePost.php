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
                               $classtype = $_POST['ClassmType']; 
                                $alert = $_POST['alert'];
                              $Postname = $_POST['postName'];
                               
                                $filename = $_POST['FileName'];
                                
                         
                          $fileNamePost =$_FILES['Poster']['name'];
                                
                             
                               
                                
                       if(!empty($fileNamePost)){
                                
                                if(file_exists("AdminData/PostManagement/Posters/" . $fileNamePost)){
                                                echo $fileNamePost . " is already exists.";
                                                exit;
                                            }
                                            else{ 
                                                 
                                       
                                $sql = "INSERT INTO `posts`(`PostName`, `postImage`,`ImageName`,`ClassID`,`alert`) VALUES ('$Postname','$fileNamePost','$filename','$classtype','$alert')";               
                                                        $result=mysqli_query($conn,$sql);
                                                        if($result)
                                                        {
                                                             move_uploaded_file($_FILES["Poster"]["tmp_name"], "AdminData/PostManagement/Posters/" . $fileNamePost);
                                                          
                                                          
                                                        $sql = "SELECT `postID` FROM `posts` WHERE `PostName`='$Postname'";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                        // output data of each row
                                                        while($row= $result->fetch_assoc()) {
                                                            
                                                            
                                                        $_SESSION["postid"] = $row['postID'];
                                                        
                                                        }
                                                        }else{
                                                        echo 'error 1';
                                                        exit;
                                                        }
       
                                                          echo 'Saved';  
                                                        }
                                                        else{
                                                            
                                                            echo 'Error';
                                                            exit;
                                                        }
                                                        
    
                     
                                
                                
                                

                   }
            }
           
        }
                   
?>