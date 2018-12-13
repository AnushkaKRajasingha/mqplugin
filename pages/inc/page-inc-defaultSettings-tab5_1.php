<div class="position-center">
<form id="frm_is_api_fields" method="post" role="form" class="form-horizontal frm_sysSettings">
	<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysapiStripeKey">MaidQuote Data Field</label>

			<div class="col-xs-10 col-sm-3 col-lg-2">
				<?php $list = Plugin_Utilities::drawClassPropList('select', 'infusionsoft_api',array('MMQuotes','MMContacts','MMAMarketing','MMSqFootagePricing','MMHourlyRates','MMAvailableDates','MMBedroomPricing','MMBathroomPricing','MMPetPricing'),'selectpicker form-control','sel_mqisfields'); ?>
			</div>			
			<div class="col-xs-1">
				<button title="MaidQuote data field to map with Infutionsoft API" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
			<div class="col-xs-10 col-sm-3 col-lg-2">
				<!-- <input type="text" placeholder="Infusionsoft API field to map" class="form-control" id="isfieldname" />  -->
				<?php 
				$isproxy = new MMInfusionsoftProxy();
				echo  $isproxy->get_field_selector('isfieldname', '');
				?>
				
			</div>
			<div class="col-xs-1">
				<button title="Infusionsoft field to map with the system data" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-1">
								<button type="button" class="btn btn-success col-xs-12"
									id="btn_mapisfield">Map It</button>
							</div>
		</div>
			<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysquotedisplayedtstagid">Mapped Fields</label>

			<div class="col-xs-12 col-sm-10 col-lg-10" id="is_mapped_field_ctr">
			<?php 
			//var_dump($list);
			foreach ($__sysset->mqisfields as $key => $value) {
				foreach ($value as $key2 => $value2) {
				$uniqueid = $key.$key2;
				$dataFieldName = $key.'.'.$key2;
				$name = $list[$key2][1]->tags['name'][0];// var_dump($name);
				?>
					<div class="input-group input-group-sm m-bot15 col-sm-4" style="float:inherit;" id="cntr_<?php echo $uniqueid;?>">
				<span class="input-group-addon"><?php echo $name;?></span><input type="text" placeholder="<?php echo $name; ?>" id="mqisfields.<?php echo $uniqueid;?>" data-uniqueid="<?php echo $uniqueid;?>"
					class="form-control" data-field-value="yes" data-field-name="mqisfields.<?php echo $dataFieldName;?>" value="<?php echo $value2;?>" required="required">
					<span class="btnisfieldremove input-group-addon" id="btnisfieldremove_<?php echo $uniqueid;?>" data-uniqueid="<?php echo $uniqueid;?>"><i title="Remove" data-placement="bottom"
					data-toggle="tooltip" class="tooltips fa fa-minus-square"></i></span></div>
					<?php 
				}
			}
		
			?>					 		 

			</div>
			
		</div>
		<div class="form-group">
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