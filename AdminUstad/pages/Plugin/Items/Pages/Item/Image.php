<?php
$itemID=$_GET["itemID"];

if(isset($_POST["Form_Submit"])){

$target_dir_sql="img/Plugin/Items/Item/$itemID/";
$target_dir = "../$target_dir_sql";

if(!is_dir($target_dir)){ mkdir($target_dir, 0755, true); }
$target_file = $target_dir . basename($_FILES["Form_Item_UploadImage"]["name"]);
$target_file_sql = $target_dir_sql . basename($_FILES["Form_Item_UploadImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["Form_Submit"])) {
  $check = getimagesize($_FILES["Form_Item_UploadImage"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}



// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["Form_Item_UploadImage"]["size"] > 5000000) {
    echo "Sorry, your file(".$_FILES["Form_Item_UploadImage"]["size"].") is too large.";
    $uploadOk = 1;
  }

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["Form_Item_UploadImage"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["Form_Item_UploadImage"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

    $result = mysqli_query($con, "SELECT * FROM `items` WHERE `Id`='$itemID' ");
    $num=mysqli_num_rows($result);
    if($num=="0"){
    
    } else {
        $con->query("UPDATE `items` SET `DisplayPicture`='$target_file_sql' WHERE `Id`='$itemID' ");
        header('Location: /'.$AdminFolder.'/Plugin/Items/Pages/Item?itemID='.$itemID);
    }

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("pages/inc/Header.php"); ?>
</head>
<body>
<?php //include("pages/inc/bs4_navbar.php"); ?>


<div class="container-fluid bg-dark shadow  fixed-top ">
    <div class="row align-items-center " style="height:3.375rem; ">
        <div class="col-12 px-0">
            <div class="btn-group  float-left "> 
                <button type="button" class="btn btn-link" onclick="location.href='<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/Item?itemID=<?php echo $itemID; ?>'" ><i class="fas fa-angle-left fa-2x" style="color:#ffffff;"></i></button>
            </div>
            <div class="btn-group  float-right ">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#sh-Modal-RightSidebar"><i class="fas fa-bars fa-2x" style="color:#ffffff;"></i></button>
            </div>
            <span class="text-white mt-2" style=" font-size:160%; font-variant: small-caps; line-height:49px;">Items</a>
        </div>
    </div>
</div>


<?php include("pages/Plugin/Items/Sidebar.php"); ?>


<div class="modal" id="sh-Modal-Ajax"></div>
<div class="modal" id="sh-Modal-Waiting"><div class="modal-dialog modal-dialog-centered text-center"><i class="fas fa-cog fa-spin fa-5x mx-auto"></i></div></div>
<!-- Start : Your Page Source -->



<?php
$result = mysqli_query($con, "SELECT * FROM `items` WHERE `Id`='$itemID'");
$row = mysqli_fetch_array($result);
?>


<div class="container-fluid" >
	<div class="row">
		<div class="col py-3" >
            <form action="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Image?itemID=<?php echo $itemID; ?>" method="POST" id="Form_AddItem" enctype="multipart/form-data">
                <div class="form-group d-none">
                    <label for="">Image:*</label>
                    <input type="file"  class="form-control form-control-lg" name="Form_Item_UploadImage" Id="Form_Item_UploadImage" onchange="sub(this)" >
                </div>
                <button type="button" id="SelectImageBtn" onclick="getFile()" class="btn btn-lg btn-outline-secondary btn-block mb-3">Select Image</button>
                <button type="submit" class="btn btn-lg btn-primary btn-block" name="Form_Submit" value="Update_Item_UploadImage">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
function getFile() {
  document.getElementById("Form_Item_UploadImage").click();
}

function sub(obj) {
  var file = obj.value;
  var fileName = file.split("\\");
  document.getElementById("SelectImageBtn").innerHTML = fileName[fileName.length - 1];
  document.myForm.submit();
  event.preventDefault();
}
</script>

<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>