<?php
$itemID=$_GET["itemID"];

if(isset($_POST["Form_Submit"])){

    $_POST["Form_Item_Title"]=mysqli_real_escape_string($con, $_POST["Form_Item_Title"]);
    $_POST["Form_Item_Description"]=mysqli_real_escape_string($con, $_POST["Form_Item_Description"]);


    $result = mysqli_query($con, "SELECT * FROM `items_language` WHERE `[items]Id`='$itemID' AND `LanguageCode`='EN'");
    $num=mysqli_num_rows($result);
    if($num=="0"){
        $sql = "INSERT INTO `items_language` (`[items]Id`, `LanguageCode`, `Title`, `Description`)
        VALUES ('$itemID', 'EN', '$_POST[Form_Item_Title]', '$_POST[Form_Item_Description]')";
        $con->query($sql);
    } else {
        $con->query("UPDATE `items_language` SET `Title`='$_POST[Form_Item_Title]', `Description`='$_POST[Form_Item_Description]' WHERE `[items]Id`='$itemID' AND `LanguageCode`='EN'");
        \P\Items\updateDateTime($itemID);
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
$result = mysqli_query($con, "SELECT * FROM `items_language` WHERE `[items]Id`='$itemID' AND `LanguageCode`='EN'");
$row = mysqli_fetch_array($result);
?>


<div class="container-fluid" >
	<div class="row">
		<div class="col py-3" >
            <form action="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Text?itemID=<?php echo $itemID; ?>" method="POST" id="Form_AddItem" >
                <div class="form-group">
                    <label for="">Title:*</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Title" name="Form_Item_Title" Id="Form_Item_Title" value="<?php echo $row["Title"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Description:</label>
                    <textarea class="form-control form-control-lg" name="Form_Item_Description" Id="Form_Item_Description"  ><?php echo $row["Description"]; ?></textarea>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block" name="Form_Submit" value="Update_Item_Text">Submit</button>
            </form>
        </div>
    </div>
</div>


<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>