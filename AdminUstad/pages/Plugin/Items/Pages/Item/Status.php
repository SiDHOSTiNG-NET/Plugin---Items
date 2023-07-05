<?php
$itemID=$_GET["itemID"];

if(isset($_GET["ItemStatus"]) AND $_GET["ItemStatus"]=="Online"){ $con->query("UPDATE `items` SET `Status`='Online' WHERE `Id`='$itemID'"); }
if(isset($_GET["ItemStatus"]) AND $_GET["ItemStatus"]=="Offline"){ $con->query("UPDATE `items` SET `Status`='Offline' WHERE `Id`='$itemID'"); }

if(isset($_GET["ItemType"]) AND $_GET["ItemType"]=="StandardItem"){ $con->query("UPDATE `items` SET `Type`='StandardItem' WHERE `Id`='$itemID'"); }
if(isset($_GET["ItemType"]) AND $_GET["ItemType"]=="VirtualItem"){ $con->query("UPDATE `items` SET `Type`='VirtualItem' WHERE `Id`='$itemID'"); }
if(isset($_GET["ItemType"]) AND $_GET["ItemType"]=="Service"){ $con->query("UPDATE `items` SET `Type`='Service' WHERE `Id`='$itemID'"); }
if(isset($_GET["ItemType"]) AND $_GET["ItemType"]=="PackOfItems"){ $con->query("UPDATE `items` SET `Type`='PackOfItems' WHERE `Id`='$itemID'"); }

if(isset($_GET["ItemCondition"]) AND $_GET["ItemCondition"]=="New"){ $con->query("UPDATE `items` SET `Condition`='New' WHERE `Id`='$itemID'"); }
if(isset($_GET["ItemCondition"]) AND $_GET["ItemCondition"]=="Used"){ $con->query("UPDATE `items` SET `Condition`='Used' WHERE `Id`='$itemID'"); }
if(isset($_GET["ItemCondition"]) AND $_GET["ItemCondition"]=="Refurbished"){ $con->query("UPDATE `items` SET `Condition`='Refurbished' WHERE `Id`='$itemID'"); }
if(isset($_GET["ItemCondition"]) AND $_GET["ItemCondition"]=="Junkyard"){ $con->query("UPDATE `items` SET `Condition`='Junkyard' WHERE `Id`='$itemID'"); }


?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("pages/inc/Header.php"); ?>
<style>
    body{ margin-top:3.375rem; margin-bottom:3.375rem;}
    .btn-li{ background-color:#ffffff; color:#3d3d3d; font-size:13pt !important;  }
    .btn-li:hover{ background-color:#dddddd; }
</style>
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
$result = mysqli_query($con, "SELECT * FROM `items` WHERE `Id`='$_GET[itemID]'");
$row = mysqli_fetch_array($result);
?>


<div class="container-fluid" >
	<div class="row">
        <div class="col-12 px-0" >
            <div class="p-3" style="font-weight: bold;">Select Item Status:</div>
            <div class="btn-group-vertical rounded-0 btn-group-lg btn-block">
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Status?itemID=<?php echo $itemID; ?>&ItemStatus=Online" class="btn btn-li text-left " ><?php if($row["Status"]=="Online"){ echo '<i class="fas fa-check fa-1x4x float-right" ></i>'; } ?>Online</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Status?itemID=<?php echo $itemID; ?>&ItemStatus=Offline" class="btn btn-li text-left"   ><?php if($row["Status"]=="Offline"){ echo '<i class="fas fa-check fa-1x4x float-right" ></i>'; } ?>Offline</a>
            </div>
        </div>
        <div class="col-12 px-0" >
            <div class="p-3" style="font-weight: bold;">Select Item Type:</div>
            <div class="btn-group-vertical rounded-0 btn-group-lg btn-block">
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Status?itemID=<?php echo $itemID; ?>&ItemType=StandardItem" class="btn btn-li text-left " ><?php if($row["Type"]=="StandardItem"){ echo '<i class="fas fa-check fa-1x4x float-right" ></i>'; } ?>Standard Item</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Status?itemID=<?php echo $itemID; ?>&ItemType=VirtualItem" class="btn btn-li text-left"   ><?php if($row["Type"]=="VirtualItem"){ echo '<i class="fas fa-check fa-1x4x float-right" ></i>'; } ?>Virtual Item</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Status?itemID=<?php echo $itemID; ?>&ItemType=Service" class="btn btn-li text-left" ><?php if($row["Type"]=="Service"){ echo '<i class="fas fa-check fa-1x4x float-right" ></i>'; } ?>Service</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Status?itemID=<?php echo $itemID; ?>&ItemType=PackOfItems" class="btn btn-li text-left" ><?php if($row["Type"]=="PackOfItems"){ echo '<i class="fas fa-check fa-1x4x float-right" ></i>'; } ?>Pack of Itemss</a>
            </div>
        </div>
		<div class="col-12 px-0" >
            <div class="p-3" style="font-weight: bold;">Select Item Condition:</div>
            <div class="btn-group-vertical rounded-0 btn-group-lg btn-block">
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Status?itemID=<?php echo $itemID; ?>&ItemCondition=New" class="btn btn-li text-left " ><?php if($row["Condition"]=="New"){ echo '<i class="fas fa-check fa-1x4x float-right" ></i>'; } ?>New</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Status?itemID=<?php echo $itemID; ?>&ItemCondition=Used" class="btn btn-li text-left"   ><?php if($row["Condition"]=="Used"){ echo '<i class="fas fa-check fa-1x4x float-right" ></i>'; } ?>Used</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Status?itemID=<?php echo $itemID; ?>&ItemCondition=Refurbished" class="btn btn-li text-left" ><?php if($row["Condition"]=="Refurbished"){ echo '<i class="fas fa-check fa-1x4x float-right" ></i>'; } ?>Refurbished</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item/Status?itemID=<?php echo $itemID; ?>&ItemCondition=Junkyard" class="btn btn-li text-left" ><?php if($row["Condition"]=="Junkyard"){ echo '<i class="fas fa-check fa-1x4x float-right" ></i>'; } ?>Junkyard</a>
            </div>
        </div>
    </div>
</div>


<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>