<?php
$itemID=$_GET["itemID"];

if(isset($_POST["Form_Submit"])){

    $result = mysqli_query($con, "SELECT * FROM `items` WHERE `Id`='$itemID' ");
    $num=mysqli_num_rows($result);
    if($num=="0"){
    
    } else {
        $con->query("UPDATE `items` SET `Quantity`='$_POST[Form_Item_Quantity]', `SKUcode`='$_POST[Form_Item_SKUcode]', `Barcode`='$_POST[Form_Item_Barcode]', `InputSearchTags`='$_POST[Form_Item_InputSearchTags]' WHERE `Id`='$itemID' ");
        \P\Items\updateDateTime($itemID);
        \P\Items\searchTags($itemID);

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
            <form action="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/SKU_QTY_BARCODE?itemID=<?php echo $itemID; ?>" method="POST" id="Form_AddItem" >
                <div class="form-group">
                    <label for="">Quantity:*</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Quantity" name="Form_Item_Quantity" Id="Form_Item_Quantity" value="<?php echo $row["Quantity"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="">SKUcode:*</label>
                    <input type="text" class="form-control form-control-lg" placeholder="SKUcode" name="Form_Item_SKUcode" Id="Form_Item_SKUcode" value="<?php echo $row["SKUcode"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Barcode:</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Barcode" name="Form_Item_Barcode" Id="Form_Item_Barcode" value="<?php echo $row["Barcode"]; ?>" >
                </div>
                <div class="form-group">
                    <label for="">Search:</label>
                    <input type="text" class="form-control form-control-lg" data-role="tagsinput" placeholder="SearchTags" name="Form_Item_InputSearchTags" Id="Form_Item_InputSearchTags" value="<?php echo $row["InputSearchTags"]; ?>" >
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block" name="Form_Submit" value="Update_Item_ExtraOne">Submit</button>
            </form>
        </div>
    </div>
</div>


<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>