<?php

                   
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                            $Del_PDF_ID = $_POST['Del_PDF_ID']; 
                                         
     $sql = "SELECT `PDF_Name` FROM `AllPdf` WHERE `All_PDF_ID`='$Del_PDF_ID'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                              // output data of each row
                                  while($row= $result->fetch_assoc()) {
                                   
                                   $filename= $row['PDF_Name'];
                               
                                  }
                                }
                                if(file_exists("AdminData/PostManagement/ALLPDF/" . $filename))
                                   {
                                       $filess= "AdminData/PostManagement/ALLPDF/".$filename;
                                      unlink("$filess");
                                       
                                }
                                 
                                               
                            $qry="DELETE FROM `AllPdf` WHERE `All_PDF_ID`='$Del_PDF_ID'";
                                           $result=mysqli_query($conn,$qry);
                                           if($result)
                                           {
                                                  echo 'deleted';
                                            }
                                           else{
                                               echo 'error on deletion';
                                           }
                                        
                       
                   }
                   
?>