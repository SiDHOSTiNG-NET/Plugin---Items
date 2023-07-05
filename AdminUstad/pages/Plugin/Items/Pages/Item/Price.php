<?php
$itemID=$_GET["itemID"];

if(isset($_POST["Form_Submit"])){

    $result = mysqli_query($con, "SELECT * FROM `items` WHERE `Id`='$itemID' ");
    $num=mysqli_num_rows($result);
    if($num=="0"){
    
    } else {
        $con->query("UPDATE `items` SET `SalePrice_InVAT`='$_POST[Form_Item_SalePrice_InVAT]', `[vat]CodeName`='$_POST[Form_Item_VAT]' WHERE `Id`='$itemID' ");
        \P\Items\updateDateTime($itemID);
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
            <form action="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Price?itemID=<?php echo $itemID; ?>" method="POST" id="Form_AddItem" >
                <div class="form-group">
                    <label for="">Sale Price incl.VAT:*</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Sale Price incl.VAT" name="Form_Item_SalePrice_InVAT" Id="Form_Item_SalePrice_InVAT" value="<?php echo $row["SalePrice_InVAT"]; ?>" required>
                </div>
                <?php if(function_exists('\P\VAT\listSQL')){ ?>
                    <div class="form-group">
                        <label>VAT Procent:</label>
                        <select class="form-control form-control-lg" name="Form_Item_VAT" Id="Form_Item_VAT" >
                            <option value="" <?php if($row["[vat]CodeName"]==""){ echo"selected"; } ?>>Not Selected</option>
                            <?php 
                                $result2 = mysqli_query($con, "SELECT * FROM `vat` WHERE `Status`='Enable' ");
                                while($row2 = mysqli_fetch_array($result2)){
                            ?>
                                <option value="<?php echo $row2["CodeName"]; ?>" <?php if($row["[vat]CodeName"]==$row2["CodeName"]){ echo"selected"; } ?>><?php echo $row2["CountryCode"]." ".$row2["Group Name"]." ".$row2["Procent"] ; ?>%</option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-lg btn-primary btn-block" name="Form_Submit" value="Update_Item_Price">Submit</button>
            </form>
        </div>
    </div>
</div>


<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>