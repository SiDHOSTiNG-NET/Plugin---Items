<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("pages/inc/Header.php"); ?>
</head>
<body>
<?php //include("pages/inc/bs4_navbar.php"); ?>


<div class="container-fluid bg-dark shadow  fixed-top">
    <div class="row align-items-center" style="height:3.375rem; ">
        <div class="col-12">
            <i data-toggle="modal" data-target="#sh-Modal-RightSidebar" class="fas fa-bars fa-2x mr-2 pointer float-right" style="color:#ffffff;"></i>
            <span class="text-white" style=" font-size:160%; font-variant: small-caps;">Items</a>
        </div>
    </div>
</div>


<?php include("pages/Apps/Items/Sidebar.php"); ?>


<div class="modal" id="sh-Modal-Ajax"></div>
<div class="modal" id="sh-Modal-Waiting"><div class="modal-dialog modal-dialog-centered text-center"><i class="fas fa-cog fa-spin fa-5x mx-auto"></i></div></div>
<!-- Start : Your Page Source -->







<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>