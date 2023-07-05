<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("pages/inc/Header.php"); ?>  
</head>
<body class="v3">
<?php \template\navbar(array("Btn_Search"=>true)); ?>
<?php include("pages/Plugin/".$Plugin."/Sidebar.php"); ?>
<div class="modal" id="sh-Modal-Ajax"></div>
<div class="modal" id="sh-Modal-Waiting"><div class="modal-dialog modal-dialog-centered text-center"><i class="fas fa-cog fa-spin fa-5x mx-auto"></i></div></div>
<!-- Start : Your Page Source -->




<div >
<div class="d-none" id="SearchBar" style="">
    <input type="text" id="SearchInput" class="form-control form-control-lg" placeholder="Search" autofocus>
</div>
<table class="table table-hover table-striped" id="myTable">
    <?php 
        $result = mysqli_query($con, "SELECT * FROM `items`  ");
        while($row = mysqli_fetch_array($result)){
    ?>
        <tr onclick="location.href='<?php echo $AdminFolder; ?>/Plugin/Items/Pages/Item?itemID=<?php echo $row['Id']; ?>'">
            <td class="" style="width:37px;  padding:1px; vertical-align: middle;   <?php if($row["Status"]=="Offline"){ echo" background-image: linear-gradient(to left, rgba(255,0,0,0), rgba(255,102,102,1)); "; } ?>"  >
                <img class="card-img-top" src="img/space.png"  style="height:35px; width:35px; background-image:url('<?php echo \P\Items\itemImage($row["Id"]); ?>'); background-position: center; background-repeat: no-repeat; background-size: contain;">
            </td>
            <td class="p-1" style="font-size:90%;">
                <?php echo \P\Items\itemTitle($row["Id"]); ?><br>
                <span style="font-size:80%;"><?php echo $row["SKUcode"] ?> - <?php echo $row["Barcode"] ?></span>
            </td>
        </tr>
            

    <?php } ?>
</table>
</div>



<script>
    $(document).ready(function(){
  $("#SearchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
    function enableSearch(){
        //alert("soon");
        $("#SearchInput").focus();
        
        $("#SearchBar").toggleClass("d-none");
        document.getElementById('SearchInput').focus();
    }
</script>




<?php include("pages/inc/bs4_bottombar.php"); ?>
<!-- End : Your Page Source -->
</body>
</html>