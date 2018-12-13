<div id="summary-container" class="form-group">                                       
                              
</div>
<div class="form-group text-center">
					<?php if($_syssettings){ echo $_syssettings->instexttab6; } ?>
					</div>
<div class="form-group" style="margin-top: 3em;">
	<div class="col-md-offset-4 col-md-4">
		<?php if($_syssettings->stripeapistatus == 1){ ?>
		<button id="btn_book-cleaning" class="btn btn-success col-xs-12" onclick="javascript:jQuery('#wizard').steps('next');"
			type="button">Book your cleaning</button>
		<?php } else { ?>
		<button id="btn_return-to-home" class="btn btn-success col-xs-12" onclick="javascript:window.location = '<?php echo bloginfo('url');?>';"
			type="button">Return to home page</button>
		<?php } ?>	
	</div>
	<div class="clear"></div>
</div>
