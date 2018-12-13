<div class="position-center">
<form id="frm_sysSettings_api" method="post" role="form" class="form-horizontal frm_sysSettings">
<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="sysStripeApiStatus">Enable Stripe API</label>
			<div class="col-xs-6 col-md-4 col-lg-2">
				<div data-toggle="buttons" class="btn-group">
					<?php setRadioBtn($__sysset,'stripeapistatus','sysStripeApiStatus',array('Yes','No'));?>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to enabl/disable the Strpe API." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">		
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="sysStripeApiStatus">Use Stripe API</label>
			<div class="col-xs-6 col-md-4 col-lg-2">
				<div data-toggle="buttons" class="btn-group">
					<?php setRadioBtn($__sysset,'stripeapitype','sysStripeApitype',array('Live','Test'));?>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to change the Strpe API type." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		
		<!-- Stripe test Api Settings -->
			<div class="form-group valstripeapitype <?php if($__sysset->stripeapitype === '1'){ echo 'hidden';}?>" >
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysapistripetestkey">Stripe Test API Key</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="Your Stripe API Key" id="sysapistripetestkey"
					class="form-control" data-field-value="yes" data-field-name="apistripetestkey" value="<?php if(isset($__sysset)){echo $__sysset->apistripetestkey;}?>" required="required">
			</div>
			<div class="col-xs-2">
				<button title="The Test Stipe API Key is how Quote Plugin communicates with Stripe. Enter the correct Test Stripe API Key" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group valstripeapitype <?php if($__sysset->stripeapitype === '1'){ echo 'hidden';}?>">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysapistripetestvalue">Stripe Test API Secret</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="Your Stripe API Secret" id="sysapistripetestvalue"
					class="form-control" data-field-value="yes" data-field-name="apistripetestvalue" value="<?php if(isset($__sysset)){echo $__sysset->apistripetestvalue;}?>" required="required">
			</div>
			<div class="col-xs-2">
				<button title="The Test Stipe API Secret is how Quote Plugin communicates with Stripe. Enter the correct Test Stripe API Secret" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>	
		<!-- Stripe test Api Settings -->
		
		<!-- Stripe Live Api Settings -->
	<div class="form-group valstripeapitype <?php if($__sysset->stripeapitype === '0'){ echo 'hidden';}?>">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysapiStripeKey">Stripe Live API Key</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="Your Stripe API Key" id="sysapiStripeKey"
					class="form-control" data-field-value="yes" data-field-name="apistripekey" value="<?php if(isset($__sysset)){echo $__sysset->apistripekey;}?>" required="required">
			</div>
			<div class="col-xs-2">
				<button title="The Stipe API Key is how Quote Plugin communicates with Stripe. Enter the correct Stripe API Key" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group valstripeapitype <?php if($__sysset->stripeapitype === '0'){ echo 'hidden';}?>">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysapiStripeValue">Stripe Live API Secret</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="Your Stripe API Secret" id="sysapiStripeValue"
					class="form-control" data-field-value="yes" data-field-name="apistripevalue" value="<?php if(isset($__sysset)){echo $__sysset->apistripevalue;}?>" required="required">
			</div>
			<div class="col-xs-2">
				<button title="The Stipe API Secret is how Quote Plugin communicates with Stripe. Enter the correct Stripe API Secret" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>	
		<!-- Stripe Live Api Settings -->
		<div class="form-group">		
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="sysStripeApiStatus">Allow Stripe Charge</label>
			<div class="col-xs-6 col-md-4 col-lg-2">
				<div data-toggle="buttons" class="btn-group">
					<?php setRadioBtn($__sysset,'stripeapicharge','sysStripeApiCharge',array('Yes','No'));?>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows the Strpe API type to cgarge from client credit / debit card." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="sysStripeApiStatus">Enable Infusionsoft API</label>
			<div class="col-xs-6 col-md-4 col-lg-2">
				<div data-toggle="buttons" class="btn-group">
					<?php setRadioBtn($__sysset,'infusionsoftstatus','sysInfusionsoftApiStatus',array('Yes','No'));?>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to enabl/disable the Infusionsoft API." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
	<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysinfusionsoftclid">Infusionsoft Client ID</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="Your Infusionsoft Client ID" id="sysinfusionsoftclid"
					class="form-control" data-field-value="yes" data-field-name="infusionsoftclid" value="<?php if(isset($__sysset)){echo $__sysset->infusionsoftclid;}?>" required="required">
			</div>
			<div class="col-xs-2">
				<button title="The Infusionsoft is how Quote Plugin communicates with infusionsoft. Enter the correct infusionsoft client id. Ex : https://CLIENT_ID.infusionsoft.com" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysinfusionsoftclsec">Infusionsoft Application Api Key</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="Your Infusionsoft Client Secret" id="sysinfusionsoftclsec"
					class="form-control" data-field-value="yes" data-field-name="infusionsoftclsec" value="<?php if(isset($__sysset)){echo $__sysset->infusionsoftclsec;}?>" required="required">
			</div>
			<div class="col-xs-2">
				<button title="The Infusionsoft Api Key is how Quote Plugin communicates with Infusionsoft Enter the correct Infusionsoft API Key. (To get the api key , go to your infusionsoft application > Admin > aettings > Application > Api - Encrypted Key: xxxxxxxxxxxxxxx )" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
			<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysquotedisplayedtstagid">Quote Displayed Tag ID</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
			<?php
							$__hometypes = new MMFrequencies();
					 		 foreach ($__hometypes->Get_Frequencies(1) as $key => $value) {
					 			?>
					 		 <div class="input-group m-bot15">
				<input type="text" placeholder="Infusionsoft Tag ID for <?php echo $value->frequency;?>" id="sysquotedisplayedtstagid.<?php echo $value->uniqueid;?>" data-uniqueid="<?php echo $value->uniqueid;?>"
					class="form-control" data-field-value="yes" data-field-name="quotedisplayedtstagid.<?php echo $value->uniqueid;?>" value="<?php if(isset($__sysset) && is_array($__sysset->quotedisplayedtstagid) && array_key_exists($value->uniqueid, $__sysset->quotedisplayedtstagid)){echo $__sysset->quotedisplayedtstagid[$value->uniqueid];}?>" required="required">
					<span class="input-group-addon"><?php echo $value->frequency;?></span></div>
					 		<?php
					 		}?>
					 		 <div class="input-group m-bot15">
				<input type="text" placeholder="Infusionsoft Tag ID for Cleaning by the hour" id="sysquotedisplayedtstagid.hourly" data-uniqueid="hourly"
					class="form-control" data-field-value="yes" data-field-name="quotedisplayedtstagid.hourly" value="<?php if(isset($__sysset) && is_array($__sysset->quotedisplayedtstagid) && array_key_exists('hourly', $__sysset->quotedisplayedtstagid)){echo $__sysset->quotedisplayedtstagid['hourly'];}?>" required="required">
					<span class="input-group-addon">Cleaning by the hour</span></div>

			</div>
			<div class="col-xs-2">
				<button title="The Infusionsoft contact tag id, that use for tag when the quote is displayed d, The tag ID. This is found on the Infusionsoft Setup > Tags menu" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
			<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysappointmentbookedtagid">Appointment Booked Tag ID</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="Your Infusionsoft Client ID" id="sysappointmentbookedtagid"
					class="form-control" data-field-value="yes" data-field-name="appointmentbookedtagid" value="<?php if(isset($__sysset)){echo $__sysset->appointmentbookedtagid;}?>" required="required">
			</div>
			<div class="col-xs-2">
				<button title="The Infusionsoft contact tag id, that use for tag when the quote is displayed, The tag ID. This is found on the Infusionsoft Setup > Tags menu" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10 btn-container">
							<div class="col-xs-12 col-sm-4 col-lg-3">
								<button type="button" class="btn btn-success col-xs-12 btn_save_syssettings"
									id="">Save Settings</button>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					
			</form>		
</div>
