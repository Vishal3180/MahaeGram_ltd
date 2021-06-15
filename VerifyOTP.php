<?php

                   
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                            if(isset($_POST['OTP'])){
                            $OTP1 = $_POST['OTP']; 
                            $otp2 = $_COOKIE["otp"] ;
                            $ot = $otp2;
                            
                            if(strcmp($OTP1, $ot) == 0){
                                echo 'matched';
                            }else{
                                echo 'not matched';
                            }
                            
                            
                            }
                       
                   }
                            