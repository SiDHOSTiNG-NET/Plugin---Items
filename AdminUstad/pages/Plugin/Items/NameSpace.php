<?php 

namespace P\Items;

function itemTitle($itemID, $LanguageCode='EN'){
    global $con;
    $result = mysqli_query($con, "SELECT * FROM `items_language` WHERE `[items]Id`='$itemID' AND `LanguageCode`='$LanguageCode' ");
    $row = mysqli_fetch_array($result);
    $return=$row["Title"];
    return $return;
} 

function itemImage($itemID){
	global $con;

    //$DisplayPicture=singleQuery("`items` WHERE `Id`='$itemID'", "DisplayPicture");

    $result = mysqli_query($con, "SELECT * FROM `items` WHERE `Id`='$itemID'");
    $row = mysqli_fetch_array($result);
    $DisplayPicture=$row["DisplayPicture"];
	if(is_file("../".$DisplayPicture)){
		$return=$DisplayPicture;
	} else {
		if(parse_url("$DisplayPicture", PHP_URL_HOST)){
			$return=$DisplayPicture;
		} else {
			$return="img/Plugin/Items/No-image-available.jpg";
		}
		
	}
	//print_r($DisplayPicture);

	//$return=$DisplayPicture;

	return $return;
    
}

function searchTags($ItemId){
	global $con;

	$result = mysqli_query($con, "SELECT * FROM `items` WHERE `Id`='$ItemId'");
    $row = mysqli_fetch_array($result);
	$InputSearchTags=" ".$row["InputSearchTags"]." ";
	$InputSearchTags .=" ".$row["Barcode"]." ";
	
	$result = mysqli_query($con, "SELECT * FROM `items_language` WHERE `[items]Id`='$ItemId'  ");
	$num=mysqli_num_rows($result);
	while($row = mysqli_fetch_array($result)){
		$InputSearchTags .=" ".$row["Title"]." ";
	}
	//$InputSearchTags=" $InputSearchTags $num $ItemId";
	$con->query("UPDATE `items` SET `SearchTags`='$InputSearchTags' WHERE `Id`='$ItemId' ");

	return $InputSearchTags;
}

function itemType_codeToName($codeName){
	if($codeName=="StandardItem"){ $return="Standard Item"; }
	if($codeName=="VirtualItem"){ $return="Virtual Item"; }
	if($codeName=="Service"){ $return="Service"; }
	if($codeName=="PackOfItems"){ $return="Pack Of Items"; }
	return $return;
}

function Sitemap($itemID, $LanguageCode="EN"){
	global $con;
    $result = mysqli_query($con, "SELECT * FROM `items` WHERE `Id`='$itemID'");
    $row = mysqli_fetch_array($result); 
	$title=sh_SeoURL(\P\Items\itemTitle($itemID, $LanguageCode));
	$url="/nl/i/".$title."/".$itemID;
	list($UpdateDate, $UpdateTime) = explode(" ", $row["UpdateDateTime"]);
	$return["loc"]=$url;
	$return["lastmod"]=$UpdateDate;
	$return["changefreq"]="monthly";
	return $return;

}

function updateDateTime($itemID){
	global $con;
	global $datetime;
	$con->query("UPDATE `items` SET `UpdateDateTime`='$datetime' WHERE `Id`='$itemID' ");
}

?>