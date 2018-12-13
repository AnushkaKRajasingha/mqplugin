<div class="position-center">
<form id="frm_sysSettings_hourlyrates" method="post" role="form" class="form-horizontal frm_sysSettings">
<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="sysEnblHourlyRate">Enable Hourly Rates</label>
			<div class="col-sm-8 col-md-4">
				<div data-toggle="buttons" class="btn-group">
					<?php setRadioBtn($__sysset,'enablehourlyrate','sysEnblHourlyRate',array('Yes','No')); ?>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to enabl/disable the Hourly Rate Option for the quote." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
	<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysHourlyRate">Hourly Rate</label>

			<div class="col-sm-8 col-md-4"><div class="input-group m-bot15">
			<span
						class="input-group-addon">$</span>
				<input  placeholder="8.00" id="sysHourlyRate"
					class="form-control" type="number" data-field-value="yes" data-field-name="hourlyrate" value="<?php if(isset($__sysset)){echo $__sysset->hourlyrate;}?>" min="0" step="0.01" >
			<span
						class="input-group-addon">Per Hour</span>
			</div>
			</div>
			<div class="col-xs-2">
				<button title="The is the hourly rate for the quote" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
	<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysMaxSqft">Max. Square Footage</label>

			<div class="col-sm-8 col-md-4"><div class="input-group m-bot15">
				<input  id="sysMaxSqft" type="number" min="0" step="1"	class="form-control" value="<?php if(isset($__sysset)){echo $__sysset->maxsqft;}?>"  type="number" data-field-value="yes" data-field-name="maxsqft" placeholder="350" >
			<span
						class="input-group-addon">Sqft</span>
			</div>
			</div>
			<div class="col-xs-2">
				<button title="The is the hourly rate for the quote" data-placement="bottom"
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

