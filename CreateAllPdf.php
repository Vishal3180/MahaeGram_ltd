
<?php
  //for image
      if($_SERVER["REQUEST_METHOD"] == "POST"){
          
          include 'config.php';
          $pdfname = $_POST['pdfname'];
          $filename =$_FILES['pdffile']['name'];
          
          
          if(!empty($filename)){
                          if(file_exists("AdminData/PostManagement/ALLPDF/" . $filename)){
                                                echo $filename . " is already exists.";
                                                exit;
                                            }
                                            else{

if(!empty($pdfname)){
$qry="INSERT INTO `AllPdf`(`All_Name_For_POST_PDF`, `PDF_Name`) VALUES ('$pdfname','$filename')";
          $result=mysqli_query($conn,$qry);
          if($result)
          {
            move_uploaded_file($_FILES["pdffile"]["tmp_name"], "AdminData/PostManagement/ALLPDF/" . $filename);
            echo 'created';
              
          }
          else
          {
              echo 'error in inserting';
                exit;
          }

                                            
}else{
    echo 'please enter post name for pdf';
}


                                            }
          }else{
              echo 'please attach pdf file';
          }

                                                
     
     

}


  ?>