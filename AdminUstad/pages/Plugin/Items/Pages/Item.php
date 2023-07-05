<?php
$itemID=$_GET["itemID"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("pages/inc/Header.php"); ?>  
</head>
<body class="v3">
<?php \template\navbar(array("Btn_BackLink"=>"$AdminFolder/Plugin/$Plugin/dashboard")); ?>
<?php include("pages/Plugin/".$Plugin."/Sidebar.php"); ?>
<div class="modal" id="sh-Modal-Ajax"></div>
<div class="modal" id="sh-Modal-Waiting"><div class="modal-dialog modal-dialog-centered text-center"><i class="fas fa-cog fa-spin fa-5x mx-auto"></i></div></div>
<!-- Start : Your Page Source -->


<?php
$result = mysqli_query($con, "SELECT * FROM `items` WHERE `Id`='$_GET[itemID]'");
$row = mysqli_fetch_array($result);


?>


<div>
<table class="table table-hover table-striped">
    <tr>
        <td onclick="location.href='<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/Item/Status?itemID=<?php echo $itemID; ?>'" >
            Status, Type , Condition
            <div style="font-size:80%;"><?php echo $row["Status"].", ".\P\Items\itemType_codeToName($row["Type"]).", ".$row["Condition"]; ?></div>
        </td>
    </tr>
    <tr>
        <td  onclick="location.href='<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/Item/Text?itemID=<?php echo $itemID; ?>'" >
            Title, Description
            <div style="font-size:80%;">
                <?php echo \P\Items\itemTitle($row["Id"]); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td  onclick="location.href='<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/Item/Price?itemID=<?php echo $itemID; ?>'">
            Price , VAT
            <div style="font-size:80%;"><?php echo $row["SalePrice_InVAT"]; ?></div>
        </td>
    </tr>
    <tr>
        <td  onclick="location.href='<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/Item/SKU_QTY_BARCODE?itemID=<?php echo $itemID; ?>'">
            SKU, Quantity, Barcode
            <div style="font-size:80%;"><?php echo $row["SKUcode"].", ".$row["Quantity"].", ".$row["Barcode"]; ?></div>
        </td>
    </tr>
    <tr>
        <td  onclick="location.href='<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/Item/Image?itemID=<?php echo $itemID; ?>'">
            Image
        </td>
    </tr>
    <tr>
        <td  onclick="location.href='<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/Item/Sitemap?itemID=<?php echo $itemID; ?>'">
            Sitemap
        </td>
    </tr>
</table>
</div>







<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>

