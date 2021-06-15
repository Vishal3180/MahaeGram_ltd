<?php

                             
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                                $fid = $_POST['fid'];
                                 $Fname = $_POST['Fname'];
                                 
                                  $Lname = $_POST['Lname'];
                                   $MobileNo = $_POST['MobileNo'];
                                    $DOB = $_POST['DOB'];
                                     $Gender = $_POST['Gender'];
                                      $Address = $_POST['Address'];
                                       $ShopName = $_POST['ShopName'];
                                        $AdharNO= $_POST['AdharNO'];
                                         $panno= $_POST['panno'];
                                          $WhatsappLink= $_POST['WhatsappLink'];
                                           
                                           $profile =  $_FILES["userprofile"]["name"];
                                            
                        
                        if(!empty($profile)){            
                    
                        if(file_exists("ClientData/profiles/" . $profile)){
                            echo $profile . " is already exists.";
                            exit;
                        } 
                        else{
                              
                                                    $qry="UPDATE `users` SET `ProfilePicture`='$profile'  WHERE `franchiseID`= '$fid'"; 
                                                            $result=mysqli_query($conn,$qry);
                                                            if($result)
                                                            {
                                                                     move_uploaded_file($_FILES["userprofile"]["tmp_name"], "ClientData/profiles/" . $profile);
                                                                    
                                                                
                                                            }
                                                            else{
                                                                echo 'error occ 1';
                                                            }
                              
                            
                                        
                                
                                
                        }  
                    }
                        
                        
                        $qry="UPDATE `users` SET `Fname`='$Fname',`Lname`='$Lname',`Mobile`='$MobileNo',`Address`='$Address',`ShopName`='$ShopName',`AdharNo`='$AdharNO',`PANNo`='$panno',`WhatsAppGroupLink`='$WhatsappLink',`DOB`='$DOB',`Gender`='$Gender' WHERE `franchiseID`= '$fid'";
                                                            $result=mysqli_query($conn,$qry);
                                                            if($result)
                                                            {
                                                             echo 'saved';
                                                                
                                                            }
                                                            else{
                                                                echo 'error occ 2';
                                                            }
                       
                        
                    























                  
                   }
                   
                   
                   ?>
