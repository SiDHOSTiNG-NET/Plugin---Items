<!-- Left Modal-Sidebar -->
<div class="modal rightSidebar fade in" id="sh-Modal-RightSidebar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" style="padding-top: max(0px, env(safe-area-inset-top));">
	<div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Plugin Menu</h4>
            <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" style="font-size:200%;"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="btn-group-vertical rounded-0 btn-group-lg w-100" style="">
                <a href="<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/dashboard" class="btn btn-light text-start" ><i class="fas fa-tachometer-alt text-center" style="width:25px;"></i> Dashboard</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/AddItem" class="btn btn-light text-start"   ><i class="fas fa-plus text-center" style="width:25px;"></i> Add Item</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/Pages/itemSitemap" class="btn btn-light text-start"   >item Sitemap</a>
                <a href="<?php echo $AdminFolder; ?>/Plugin/<?php echo $Plugin; ?>/settings" class="btn btn-light text-start" ><i class="fas fa-cog text-center"  style="width:25px;"></i> Settings</a>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

	</div>
</div>
</div><!-- END : Left Modal-Sidebar  -->