<div class="position-center">
<form id="frm_sysSettings_contacts" method="post" role="form" class="form-horizontal frm_sysSettings">
<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="fromemail">From</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="email" placeholder="from@example.com" id="fromemail"
					class="form-control" data-field-value="yes" data-field-name="fromemail" value="<?php if(isset($__sysset)){echo $__sysset->fromemail;}?>">
			</div>
			<div class="col-xs-2">
				<button title="The From email address is use for the sent every email by the system." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="confirmEmail">Quote CC</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="email" placeholder="quotecc@example.com" id="confirmemail"
					class="form-control" data-field-value="yes" data-field-name="confirmemail" value="<?php if(isset($__sysset)){echo $__sysset->confirmemail;}?>">
			</div>
			<div class="col-xs-2">
				<button title="The Quote CC email will be cc'd when a quote is sent out." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="supportEmail">Booking CC</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="email" placeholder="bookingcc@example.com" id="supportEmail"
					class="form-control" data-field-value="yes" data-field-name="supportemail" value="<?php if(isset($__sysset)){echo $__sysset->supportemail;}?>">
			</div>
			<div class="col-xs-2">
				<button title="The Booking CC email will be cc'd when an appointment is booked." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="supportPhone">Support Phone Number</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="000 000 0000" id="supportPhone"
					class="form-control" data-field-value="yes" data-field-name="supportphone" value="<?php if(isset($__sysset)){echo $__sysset->supportphone;}?>">
			</div>
			<div class="col-xs-2">
				<button title="The support umber display on the email that sent to the client once service has been schedualed." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="sysEnblHourlyRate">Enable / Disable System mail</label>
			<div class="col-sm-8 col-md-4">
				<div data-toggle="buttons" class="btn-group">
					<?php setRadioBtn($__sysset,'enablesysemail','sysEnablesysemail',array('Yes','No')); ?>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to enabl/disable the system email." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<!-- req#0005 -->
				<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="sysEnblHourlyRate">Default email opt-in status</label>
			<div class="col-sm-8 col-md-4">
				<div data-toggle="buttons" class="btn-group">
					<?php setRadioBtn($__sysset,'isDefOptIn','sysIsDefOptIn',array('Enable','Disable')); ?>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to set the default email optin status of the contact." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<!-- /* req#0006 */ -->
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
