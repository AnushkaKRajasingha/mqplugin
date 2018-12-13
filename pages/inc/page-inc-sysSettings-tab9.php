<!-- req#0008 -->
<div class="position-center">
	<form id="frm_sysSettings_msg" method="post" role="form"
		class="form-horizontal frm_sysSettings">

<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="fromemail">Google Analytic tracking ID (UA-XXXXX-X)</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="UA-XXXXX-X" id="gaid"
					class="form-control" data-field-value="yes" data-field-name="gasettings.googleanalyticid" value="<?php if(isset($__sysset)&& $__sysset->gasettings){ if(is_object($__sysset->gasettings)){echo $__sysset->gasettings->googleanalyticid;} elseif(is_array($__sysset->gasettings)){ echo $__sysset->gasettings['googleanalyticid'];} }?>">
			</div>
			<div class="col-xs-2">
				<button title="Google Analytic site's ID (UA-XXXXX-X) ref : https://support.google.com/analytics/answer/1032385?hl=en ." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="fromemail">Event Tracking at Quote Started</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="ga('send', 'event', { eventCategory: 'Quote', eventAction: 'Quote Started', eventLabel: 'Click'});" id="gaid"
					class="form-control" data-field-value="yes" data-field-name="gasettings.trackingcode1" value="<?php if(isset($__sysset)&& $__sysset->gasettings){ if(is_object($__sysset->gasettings)){echo stripslashes($__sysset->gasettings->trackingcode1);} elseif(is_array($__sysset->gasettings)){  echo stripslashes($__sysset->gasettings['trackingcode1']);}}?>">
			</div>
			<div class="col-xs-2">
				<button title="Google Analytic event tracking code." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="fromemail">Event Tracking at Information Request</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="ga('send', 'event', { eventCategory: 'Quote', eventAction: 'Information Request', eventLabel: 'Click'});" id="gaid"
					class="form-control" data-field-value="yes" data-field-name="gasettings.trackingcode2" value="<?php if(isset($__sysset)&& $__sysset->gasettings){  if(is_object($__sysset->gasettings)){echo stripslashes($__sysset->gasettings->trackingcode2);} elseif(is_array($__sysset->gasettings)){   echo stripslashes($__sysset->gasettings['trackingcode2']);}}?>">
			</div>
			<div class="col-xs-2">
				<button title="Google Analytic event tracking code." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="fromemail">Event Tracking at Quote Delivery</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="ga('send', 'event', { eventCategory: 'Quote', eventAction: 'QuoteDel', eventLabel: 'Click'});" id="gaid"
					class="form-control" data-field-value="yes" data-field-name="gasettings.trackingcode3" value="<?php if(isset($__sysset)&& $__sysset->gasettings){  if(is_object($__sysset->gasettings)){echo stripslashes($__sysset->gasettings->trackingcode3);} elseif(is_array($__sysset->gasettings)){   echo stripslashes($__sysset->gasettings['trackingcode3']);}}?>">
			</div>
			<div class="col-xs-2">
				<button title="Google Analytic event tracking code." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="fromemail">Event Tracking at Appointment Request</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="ga('send', 'event', { eventCategory: 'Quote', eventAction: 'ApptReq', eventLabel: 'Click'});" id="gaid"
					class="form-control" data-field-value="yes" data-field-name="gasettings.trackingcode4" value="<?php if(isset($__sysset)&& $__sysset->gasettings){   if(is_object($__sysset->gasettings)){echo stripslashes($__sysset->gasettings->trackingcode4);} elseif(is_array($__sysset->gasettings)){  echo stripslashes($__sysset->gasettings['trackingcode4']);}}?>">
			</div>
			<div class="col-xs-2">
				<button title="Google Analytic event tracking code." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10 btn-container">
				<div class="col-xs-12 col-sm-4 col-lg-3">
					<button type="button"
						class="btn btn-success col-xs-12 btn_save_syssettings" id="">Save
						Settings</button>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</form>
</div>
<!-- req#0008 -->
