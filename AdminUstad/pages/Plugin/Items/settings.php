<!DOCTYPE html>
<html lang="en">
<head>
<?php include("pages/inc/Header.php"); ?>

</head>
<body>
<?php //include("pages/inc/bs4_navbar.php"); ?>


<div class="container-fluid bg-dark shadow  fixed-top ">
    <div class="row align-items-center " style="height:3.375rem; ">
        <div class="col-12 pr-0">
            <div class="btn-group  float-right ">
                <button type="button" class="btn btn-link d-none" onclick="enableSearch()"><i class="fas fa-search fa-2x" style="color:#ffffff;" ></i></button>
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#sh-Modal-RightSidebar"><i class="fas fa-bars fa-2x" style="color:#ffffff;"></i></button>
            </div>
            <i data-toggle="modal" data-target="#sh-Modal-RightSidebar" class="fas fa-bars fa-2x  pointer float-right d-none" style="color:#ffffff;"></i>
            <span class="text-white mt-2" style=" font-size:160%; font-variant: small-caps; line-height:49px;">Items</a>
        </div>
    </div>
</div>

<?php include("pages/Plugin/Items/Sidebar.php"); ?>


<div class="modal" id="sh-Modal-Ajax"></div>
<div class="modal" id="sh-Modal-Waiting"><div class="modal-dialog modal-dialog-centered text-center"><i class="fas fa-cog fa-spin fa-5x mx-auto"></i></div></div>
<!-- Start : Your Page Source -->







<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>
