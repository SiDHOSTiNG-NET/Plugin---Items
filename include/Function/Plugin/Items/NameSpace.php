<?php 

namespace P\Items;

function config($virable){
    include("include/Function/inc_NameSpace/config.php");
    return $return;
}

function t($tableName){
    include("include/Function/inc_NameSpace/t.php");
    return $return;
}






function itemImage($itemID){
	global $con;

	$DisplayPicture=singleQuery("`items` WHERE `Id`='$itemID'", "DisplayPicture");
	
	if(is_file($DisplayPicture)){
		$return=cdn($DisplayPicture, "return");
	} else {
		if(parse_url("$DisplayPicture", PHP_URL_HOST)){
			$return=$DisplayPicture;
		} else {
			$return=cdn("img/Plugin/Items/No-image-available.jpg", "return");
		}
		
	}
	//print_r($DisplayPicture);

	//$return=$DisplayPicture;

	return $return;
    
}

function itemInfo($itemID, $LanguageCode='EN'){
	global $con;
	global $datetime;
	global $date;
	global $path_exp;

	$last1mdatetime=date("Y-m-d", strtotime("$date -1 Month"));

	$itemInfo=\singleQuery("`items` WHERE `Id`='$itemID'");
	$itemLang=\singleQuery("`items_language` WHERE `[items]Id`='$itemID' AND `LanguageCode`='$LanguageCode'");

	
	$item["Id"]=$itemInfo["Id"];
	$item["title"]=$itemLang["Title"];
	$item["Description"]=$itemLang["Description"];
	if($itemInfo["InsertDateTime"]>$last1mdatetime){ 
		if($path_exp["1"]=="nl" || $LanguageCode="NL"){ $item["rightTag"]="Nieuw"; } // i hope this wil work i change without checking on 2021-05-02
		else { $item["rightTag"]="New";	}
			
	}
	$item["VAT_Procent"]=0;
	if(function_exists('\P\VAT\codename')) { $item["VAT_Procent"]=\P\VAT\codename($itemInfo["[vat]CodeName"]); } 

	//$item->leftTag="20%";
	$item["SKUcode"]=$itemInfo["SKUcode"];
	$item["Barcode"]=$itemInfo["Barcode"];
	$item["DPimage"]=str_replace('http://','//',itemImage($itemID));
	$item["images"]=str_replace('http://','//',itemImage($itemID));
	if(isset($itemInfo["Extra_Size"])){ $item["extraInfo"]=$itemInfo["Extra_Size"]; }
	if(isset($itemInfo["Extra_Color"])){ $item["extraInfo2"]=$itemInfo["Extra_Color"]; }
	$item["CurrencySymbol"]="&euro;";
	$item["Price"]=number_format($itemInfo["SalePrice_InVAT"], 2, '.', '');
	$item["link"]=$path_exp["1"]."/i/".\sh_SeoURL($itemLang["Title"])."/".$itemInfo["Id"];
	//$item=json_encode($item);
	//print_r($item);
	return $item;
}

function itemID_to_Title($ItemId, $LanguageCode){
	global $con;
	
	
	$result = mysqli_query($con, "SELECT * FROM `items_language` WHERE `[items]Id`='$ItemId' AND `LanguageCode`='$LanguageCode' ");
	$num=mysqli_num_rows($result);
	if($num=="0"){ 
	    $result = mysqli_query($con, "SELECT * FROM `items_language` WHERE `[items]Id`='$ItemId' AND `LanguageCode`='EN' ");
	}
	$row = $result->fetch_assoc();
	
	return $row["Title"];
}





function itemCard_BS4($JSON){
	if(is_array($JSON)){

	} else {
		$obj = json_decode($JSON);
		?>
		<div class="card" style="height:100%;">
			<!-- Right Side Tag -->
			<?php if(isset($obj->rightTag)){ ?>
				<div class="border border-right-0 border-start-0 shadow  rounded-left bg-success text-white font-weight-bold fw-bold px-1" style=" position: absolute; right:0px; top:20px;" ><?php echo $obj->rightTag; ?></div>
			<?php } ?>
			<!-- Left Side Tag -->
			<?php if(isset($obj->leftTag)){ ?>
				<div class="border border-left-0 shadow  rounded-right bg-info text-white font-weight-bold fw-bold px-1" style="position: absolute; left:0px; top:20px;" >20%</div>
			<?php } ?>
			<!-- Image -->
			<img class="card-img-top pointer" src="img/space.png" onclick="location.href='<?php echo $obj->link; ?>'" style=" width:100%; background-image:url('<?php echo $obj->images?>'); background-position: center; background-repeat: no-repeat; background-size: contain;">
			<!-- Titie , info , extra info -->
			<div class="card-body p-2 pointer" onclick="location.href='<?php echo $obj->link; ?>'"><div class="font-weight-bold fw-bold" style=""><?php echo $obj->title; ?></div>
				<?php if(isset($obj->extraInfo)){ ?><div><?php echo $obj->extraInfo; ?></div><?php } ?>
				<?php if(isset($obj->extraInfo2)){ ?><div><?php echo $obj->extraInfo2; ?></div><?php } ?>
			</div>
			<?php if(isset($obj->Price)){ ?><!-- Price -->
				<div class="card-footer p-1">
					<div  class=" font-weight-bold fw-bold"> 
						<?php if(isset($obj->FromPrice)){ ?><!-- From Price -->
							<span style="text-decoration: line-through; color:red;"><?php echo $obj->FromPrice; ?></span><?php } ?>
						<?php if(isset($obj->Price)){ ?><!-- Price -->
							<?php echo sh_amount($obj->Price); ?></div> <?php } ?>
						<div class="btn-group font-weight-bold fw-bold float-right float-end">
							<?php if(isset($obj->linkAddToFav)){ ?><button type="button" class="btn btn-master  " style=""><i class="far fa-heart"></i></button><?php } ?>
							<?php if(isset($obj->linkAddToCart)){ ?><button type="button" class="btn btn-master" style="border:0px solid #ffffff; border-left-width:1px;" onclick="sh_load_url('<?php echo $obj->linkAddToCart; ?>','#sh-Modal-Ajax');"><i class="far fa-shopping-cart"></i></button> <?php } ?>
						</div>
				</div>
			<?php } ?>
		</div>
		<?php
	}
	
}


?>