<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function clean($p1){
       $p1= strip_tags($p1);
       $p1= trim($p1);
        return $p1;

    }

  $title     = clean($_POST['title']); 
  $content = $_POST['content'];



   $errors = [];

  # Validate title ... 
   if(empty($title)){
      $errors['Name'] = "Field Required";
  }


    # Validate content 
    if(empty($content)){
        $errors['content'] = "Field Required";
    }elseif(strlen($content) < 50){
      $errors['content'] = "Length must be >= 50 chars";
    }
    
      
      //upload image
      if(!empty($_FILES['image']['name'])){

        $imgName     = $_FILES['image']['name'];
        $imgTempPath = $_FILES['image']['tmp_name'];
        $imagSize    = $_FILES['image']['size'];
        $imgType     = $_FILES['image']['type'];
     
     
         $imgExtensionDetails = explode('.',$imgName);
         $imgExtension        = strtolower(end($imgExtensionDetails));
     
         $allowedExtensions   = ['png','jpg','gif'];
     
            if(in_array($imgExtension ,$allowedExtensions)){
                // upload code ..... 
               
             $finalName = rand().time().'.'.$imgExtension;
     
              $disPath = './uploads/'.$finalName;
               
             if(move_uploaded_file($imgTempPath,$disPath)){
                 echo 'Image Uploaded';
             }else{
                 echo 'Error Try Again';
             }
     
            }else{
                echo 'Extension Not Allowed';
            }
     
     
        }
        else{
            echo 'Image Field Required';
        }


   if(count($errors) > 0){
       foreach ($errors as $key => $value) {
        
           echo '* '.$key.' : '.$value.'<br>';
       }
   }else{
     
    $myfile = fopen("test.txt", "a") or die("Unable to open file!");
    $txt = 'Title :'.$title."|".'content'.$content.'|'.'<img src="./uploads/'.$finalName.'"/>'."/n";
    fwrite($myfile, $txt);
    fclose($myfile);
    echo 'Data Saved In file';
 }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">


title: <input type="text" name="title">
content: <input type="text" name="content">

Upload image:<input type="file"  name="image">

<input type="submit" name="submit"><br>

</form>

</body>
</html>