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
                <button type="button" class="btn btn-link" onclick="location.href='<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/AddItem'" ><i class="fas fa-angle-left fa-2x" style="color:#ffffff;"></i></button>
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


<div class="container-fluid" >
	<div class="row">
		<div class="col px-0" >
            <div class="p-3" style="font-weight: bold;">Select Item Condition:</div>
            <div class="btn-group-vertical rounded-0 btn-group-lg btn-block">
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/AddItem/Step3?ItemType=<?php echo $_GET["ItemType"]; ?>&ItemCondition=New" class="btn btn-li text-left " >New</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/AddItem/Step3?ItemType=<?php echo $_GET["ItemType"]; ?>&ItemCondition=Used" class="btn btn-li text-left"   >Used</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/AddItem/Step3?ItemType=<?php echo $_GET["ItemType"]; ?>&ItemCondition=Refurbished" class="btn btn-li text-left" >Refurbished</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/AddItem/Step3?ItemType=<?php echo $_GET["ItemType"]; ?>&ItemCondition=Junkyard" class="btn btn-li text-left" >Junkyard</a>
            </div>
        </div>
    </div>
</div>


<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>