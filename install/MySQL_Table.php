<?php 

$result = $con->query("CREATE TABLE `items` (`Id` int(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY (`Id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$result = $con->query("ALTER TABLE `items` ADD `Status` VARCHAR(255) NOT NULL ;"); //ENUM (style)::  Online / Offline / NewSession
$result = $con->query("ALTER TABLE `items` MODIFY COLUMN `Status` VARCHAR(255) AFTER `Id`;"); 
$result = $con->query("ALTER TABLE `items` ADD `Type` VARCHAR(255) NOT NULL ;");
$result = $con->query("ALTER TABLE `items` MODIFY COLUMN `Type` VARCHAR(255) AFTER `Status`;"); 
$result = $con->query("ALTER TABLE `items` ADD `Condition` VARCHAR(255) NOT NULL ;");
$result = $con->query("ALTER TABLE `items` MODIFY COLUMN `Condition` VARCHAR(255) AFTER `Type`;"); 
$result = $con->query("ALTER TABLE `items` ADD `Quantity` VARCHAR(255) NOT NULL ;");
$result = $con->query("ALTER TABLE `items` MODIFY COLUMN `Quantity` VARCHAR(255) AFTER `Condition`;");
$result = $con->query("ALTER TABLE `items` ADD `[vat]CodeName` VARCHAR(255) NOT NULL ;");
$result = $con->query("ALTER TABLE `items` MODIFY COLUMN `[vat]CodeName` VARCHAR(255) AFTER `Quantity`;"); 
$result = $con->query("ALTER TABLE `items` ADD `SalePrice_InVAT` decimal(20,8) NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `Barcode` VARCHAR(255) NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `SKUcode` VARCHAR(255) NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `DisplayPicture` VARCHAR(255) NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `Extra_Size` VARCHAR(255) NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `Extra_Color` VARCHAR(255) NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `InsertDateTime` DATETIME NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `UpdateDateTime` DATETIME NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `SearchTags` TEXT NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `InputSearchTags` TEXT NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `OrderBy` VARCHAR(255) NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items` ADD `Plugin_Sitemap` ENUM('Yes','No') NOT NULL ;"); // 



$result = $con->query("CREATE TABLE `items_language` (`Id` int(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY (`Id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$result = $con->query("ALTER TABLE `items_language` ADD `[items]Id` int(20) NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items_language` ADD `LanguageCode` varchar(2) NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items_language` ADD `Title` varchar(255) NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items_language` ADD `Description` text NOT NULL ;"); // 
$result = $con->query("ALTER TABLE `items_language` ADD `Categorie` text NOT NULL ;"); // 
?>