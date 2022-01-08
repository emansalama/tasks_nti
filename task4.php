<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function clean($p1){
       $p1= strip_tags($p1);
       $p1= trim($p1);
        return $p1;

    }

  $name     = clean($_POST['name']); 
  $email    = clean($_POST['email']);
  $password = $_POST['password'];
  $address = $_POST['address'];
  $gender =clean($_POST["gender"]);


   $errors = [];

  # Validate Name ... 
   if(empty($name)){
      $errors['Name'] = "Field Required";
  }

  # Validate Email 
  if(empty($email)){
      $errors['Email'] = "Field Required";
  }
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors['Email'] = "in validate";
}


  # Validate Password 
  if(empty($password)){
      $errors['Password'] = "Field Required";
  }elseif(strlen($password) < 6){
    $errors['Password'] = "Length must be >= 6 chars";
  }
    # Validate address 
    if(empty($address)){
        $errors['address'] = "Field Required";
    }elseif(strlen($address) < 10){
      $errors['address'] = "Length must be >= 10 chars";
    }
    # Validate URL 
    if(empty($_POST['website'])){
        $errors['website'] = "Field Required";
    }
    elseif(!filter_var($_POST['website'],FILTER_VALIDATE_URL)){
        $errors['website'] = "in validate";
    }
    elseif(strpos($_POST['website'],'https://www.linkedin.com') < 0 ){
        $errors['website'] = "in validate LinkedIn";
    }
      # Validate Gender 
    if (empty($_POST["gender"])) {
        $errors['gender'] = "Gender is required";
      } else {
        $gender = clean($_POST["gender"]);
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
      
    $_SESSION['name']  = $name;
    $_SESSION['email'] = $email;
    $_SESSION['address'] = $address;
    $_SESSION['gender'] = $gender;


    
    

   $_SESSION['user'] = ["name" => $name , "email" => $email,"address" => $address,"gender" => $gender];

    echo 'Data Saved In Session';


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
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">

Name: <input type="text" name="name">
E-mail: <input type="text" name="email">
Password: <input type="password" name="password">
address: <input type="text" name="address">
Gender:
<input type="radio" name="gender" value="female">Female
<input type="radio" name="gender" value="male">Male<br>
website:<input type="url" name="website">
Upload image:<input type="file"  name="image">

<input type="submit" name="submit"><br>

</form>

</body>
</html>