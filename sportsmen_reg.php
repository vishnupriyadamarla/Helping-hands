<?php
//require "header.php";
if(isset($_POST['sportsmen_reg'])){
  session_start();
  require_once "connect.php";
    $image=$_FILES['photo'];
    $target_dir = "uploads/sportsmen/";
    $target_file = $target_dir . basename($image["name"]);
    $msg='';
        $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
  if($image["tmp_name"]!=''){
      $check = getimagesize($image["tmp_name"]);
      if($check !== false ){ if (move_uploaded_file($image["tmp_name"], $target_file)===false) {
      $uploadOk=0;
    $msg.="Sory error in uploading image\n";
  }}

  else {
    $uploadOk=0;
    $msg.='File is not an image\n';
}}
else{
  $uploadOk=0;
}
if($uploadOk==1)
  $q="insert into sportsmen values('".$_POST['email']."','".$_POST['pwd']."','".$_POST['name']."','".$_POST['sport']."','".$_POST['phone']."','".basename($image["name"])."');";
else
  $q="insert into sportsmen values('".$_POST['email']."','".$_POST['pwd']."','".$_POST['name']."','".$_POST['sport']."','".$_POST['phone']."',NULL);";
   $res=mysqli_query($conn,$q);
    if($res===false){
    $msg.='Registration failed';
    $_SESSION['msg']=$msg;
    $_SESSION['opt']='2';
    print_r($_SESSION);
    header("Location:register.php");
    }
    else{
      $_SESSION['msg']="Successfully Registered";
      $_SESSION['login']=$_POST['email'];
      header("Location:home.php");
    }
    if($msg!='')    echo "<script>alert('".$msg."');</script>";

  }
 ?>

<br><br>
<form  action="sportsmen_reg.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-lg-2">Name:</div>
    <div class="col-lg-10"><input type=text class="form-control" name="name" required></div>
  </div><br>
    <div class="form-group">
    <div class="col-lg-2">Sport:</div>
    <div class="col-lg-10"><select class="form-control" name="sport" required>
    <option value='vollyball'>VollyBall</option>
    <option value='tennis'>Tennis</option>
    <option value='cricket'>Cricket</option>
    <option value='kabaddi'>Kabaddi</option>
    <option value='athletics'>Athletics</option>
    <option value='chess'>Chess</option>
    </select>
    </div>
  </div><br>
    <div class="form-group">
        <div class="col-lg-2">Email : </div>
          <div class="col-lg-10"><input type=email class="form-control" name="email" required></div>
  </div><br>
  <div class="form-group">
        <div class="col-lg-2">Create Password: </div>
          <div class="col-lg-10"><input type=password name="pwd" class="form-control" required></div><br>
  </div><br>
  <div class="form-group">
        <div class="col-lg-2">Confirm Password: </div>
          <div class="col-lg-10"><input type=password name="cpwd" class="form-control" required></div><br>
  </div><br>
  <div class="form-group">
        <div class="col-lg-2">phone : </div>
          <div class="col-lg-10"><input type=text name="phone" pattern="[0-9]+" class="form-control" required></div><br>
  </div><br>
  
<div class="form-group">
      <div class="col-lg-2">Photo:</div>
      <div class= " custom-file">
        <div class="col-lg-10"><input type="file" class="custom-file-input" id="file2" name="photo" onchange="filename('file2','filelabel2');" >
        <label class="custom-file-label" id="filelabel2">choose file</label></div>
      </div>
    </div>
 
    <div class="form-group row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4"><input type="submit" name="sportsmen_reg" value="SUBMIT" onclick="return validate();" class="btn btn-primary"></div>
      <div class="col-lg-4"></div>
    </div></form>
