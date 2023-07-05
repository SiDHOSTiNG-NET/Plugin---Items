<?php 

if(isset($_POST["Form_Submit"])){


    // , `Condition`, `SalePrice_InVAT`
    // , '$_POST[Form_Item_Type]', '$_POST[Form_Item_Condition]'. '$_POST[Form_Item_Price]'

    $sql = "INSERT INTO `items` (`Status`, `Type`, `Condition`, `Quantity`, `SalePrice_InVAT`, `SKUcode`, `Barcode`, `InsertDateTime`)
    VALUES ('Offline', '$_POST[Form_Item_Type]', '$_POST[Form_Item_Condition]', '$_POST[Form_Item_Quantity]', '$_POST[Form_Item_Price]', '$_POST[Form_Item_SKU]', '$_POST[Form_Item_EAN]', '$datetime')";
    $con->query($sql);
    $last_id = $con->insert_id;
    $sql = "INSERT INTO `items_language` (`[items]Id`, `LanguageCode`, `Title`, `Description`)
    VALUES ('$last_id', 'EN', '$_POST[Form_Item_Title]', '$_POST[Form_Item_Description]')";
    $con->query($sql);
    if(function_exists('\P\VAT\listSQL')){ //if VAT plugin Installed
        $sql = "UPDATE `items` SET `[vat]CodeName`='$_POST[Form_Item_VAT]' WHERE Id='$last_id'";
        $con->query($sql);
    }

    header('Location: /'.$AdminFolder.'/Plugin/Items/Pages/Item?itemID='.$last_id);

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
                <button type="button" class="btn btn-link" onclick="location.href='<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/AddItem/Step2?ItemType=<?php echo $_GET["ItemType"]; ?>'" ><i class="fas fa-angle-left fa-2x" style="color:#ffffff;"></i></button>
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
		<div class="col py-3" >
            <form action="<?php echo $AdminFolder; ?>/Plugin/Items/Pages/AddItem/Step3" method="POST" id="Form_AddItem" >
                
                <div class="form-group">
                    <label for="">Title:*</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Title" name="Form_Item_Title" Id="Form_Item_Title"  onkeyup="localStorage.setItem(this.id, this.value)" required>
                </div>
                <div class="form-group">
                    <label for="">Description:</label>
                    <textarea class="form-control form-control-lg" name="Form_Item_Description" Id="Form_Item_Description"  onkeyup="localStorage.setItem(this.id, this.value)"></textarea>
                </div>
                <div class="form-group">
                    <label for="">SKU:</label>
                    <input type="text" class="form-control form-control-lg" placeholder="SKU" name="Form_Item_SKU" Id="Form_Item_SKU"  onkeyup="localStorage.setItem(this.id, this.value)"  >
                </div>
                
                <div class="form-group">
                    <label for="">Quantity:</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Quantity" name="Form_Item_Quantity" Id="Form_Item_Quantity"  onkeyup="localStorage.setItem(this.id, this.value)"  >
                </div>
                <?php if(function_exists('\P\VAT\listSQL')){ ?>
                    <div class="form-group">
                        <label>VAT Procent:</label>
                        <select class="form-control form-control-lg" name="Form_Item_VAT" Id="Form_Item_VAT"  onchange="localStorage.setItem(this.id, this.value)">
                            <?php 
                                $result = mysqli_query($con, "SELECT * FROM `vat` WHERE `Status`='Enable' ");
                                while($row = mysqli_fetch_array($result)){
                            ?>
                                <option value="<?php echo $row["CodeName"]; ?>"><?php echo $row["CountryCode"]." ".$row["Group Name"]." ".$row["Procent"] ; ?>%</option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>
                   
                <?php //} ?>
                <div class="form-group">
                    <label for="">Price:* (incl.VAT)</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Price example(12.00)" name="Form_Item_Price" Id="Form_Item_Price" value=""  onkeyup="localStorage.setItem(this.id, this.value)" >
                </div>
                <div class="form-group">
                    <label for="">EAN code:</label>
                    <input type="text" class="form-control form-control-lg" placeholder="EAN" name="Form_Item_EAN" Id="Form_Item_EAN"  onkeyup="localStorage.setItem(this.id, this.value)"  >
                </div>
                <input name="Form_Item_Type" value="<?php echo $_GET["ItemType"]; ?>">
                <input name="Form_Item_Condition" value="<?php echo $_GET["ItemCondition"]; ?>">
                <button type="submit" class="btn btn-lg btn-primary btn-block" name="Form_Submit" value="New_Item">Submit</button>
            </form>
        </div>
    </div>
</div>



<script>
    
document.getElementById("Form_Item_Title").value = localStorage.getItem("Form_Item_Title");
document.getElementById("Form_Item_Description").value = localStorage.getItem("Form_Item_Description");
document.getElementById("Form_Item_SKU").value = localStorage.getItem("Form_Item_SKU");
document.getElementById("Form_Item_Quantity").value = localStorage.getItem("Form_Item_Quantity");
document.getElementById("Form_Item_VAT").value = localStorage.getItem("Form_Item_VAT");
document.getElementById("Form_Item_Price").value = localStorage.getItem("Form_Item_Price");
document.getElementById("Form_Item_EAN").value = localStorage.getItem("Form_Item_EAN");
   
$(document).ready(function (e) {
	$("#Form_AddItem").on('submit',(function(e) {
		localStorage.removeItem("Form_Item_Title");
		localStorage.removeItem("Form_Item_Description");
		localStorage.removeItem("Form_Item_SKU");
		localStorage.removeItem("Form_Item_Quantity");
		localStorage.removeItem("Form_Item_VAT");
		localStorage.removeItem("Form_Item_Price");
        localStorage.removeItem("Form_Item_EAN");
	}));
});
</script>

<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>