<div class="position-center">
<form id="frm_sysSettings_extra" method="post" role="form" class="form-horizontal frm_sysSettings">
<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="sysEnblHourlyRate">Enable Available Date Auto Update</label>
			<div class="col-sm-8 col-md-4">
				<div data-toggle="buttons" class="btn-group">
					<?php setRadioBtn($__sysset,'dateautoupdate','sysDateautoupdate',array('Yes','No')); ?>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to enabl/disable the automatic available date update." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
	<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sysHourlyRate">Custom Styles</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="form-control" rows="9"  placeholder="/* Custom Styles */" id="customstyle"  data-field-value="yes" data-field-name="customstyle"><?php if(isset($__sysset)){echo $__sysset->customstyle;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="This featur will allows to set custom style of the plugin front page." data-placement="bottom"
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

