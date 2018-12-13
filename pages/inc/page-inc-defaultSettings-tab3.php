<div class="position-center">
<form id="frm_sysSettings_msg" method="post" role="form" class="form-horizontal frm_sysSettings">
			<!-- req#0009 -->
			<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="customPaymentMsg">Explanation for First Time Clean</label>
			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="wysihtml5 form-control" rows="9"  placeholder="Small description about First Time Payment." id="expftctext"  data-field-value="yes" data-field-name="FTCExplanation"><?php if(isset($__sysset)){echo $__sysset->FTCExplanation;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="This text will be displayed to explain the First Time Payment when use select the recurring cleaning type." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<!-- req#0009 -->
			<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="customPaymentMsg">Custom Payment Message</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="wysihtml5 form-control" rows="9"  placeholder="Small description about the payment." id="customPaymentMsg"  data-field-value="yes" data-field-name="custompmtmsg"><?php if(isset($__sysset)){echo $__sysset->custompmtmsg;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="The custom payment message is displayed on the payment page. A sentence or short paragraph is the client about important information concerning payment. This will be displayed in RED on the payment page above the submit button." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
					<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="msgWhoWeAre">Who We Are</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="wysihtml5 form-control" rows="9"  placeholder="Description about who we are" id="msgWhoWeAre"  data-field-value="yes" data-field-name="whowearemsg"><?php if(isset($__sysset)){echo $__sysset->whowearemsg;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="Who we are in formation is displayed on the page quoting fron-pages. This information can be short paragraph or several paragraphs explaining your business." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="msgTermsandConditions">Terms and Conditions</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="wysihtml5 form-control" rows="9"  placeholder="Details about your terms and conditions." id="msgTermsandConditions"  data-field-value="yes" data-field-name="termandcondmsg"><?php if(isset($__sysset)){echo $__sysset->termandcondmsg;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="Terms & Conditions are displayed on the payment page. Usually a short paragraph is best with a link to a popup your site that displays a more details and conditions form." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
			<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="msgThankYouNote">Thank You Note</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="wysihtml5 form-control" rows="9"  placeholder="Small description for the thank you page and for the quote summay email." id="msgThankYouNote"  data-field-value="yes" data-field-name="thankyounotemsg"><?php if(isset($__sysset)){echo $__sysset->thankyounotemsg;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="Small description for the thank you page and for the quote summay email." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="msgSecondEmail">Booking Complete Email Content</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="wysihtml5 form-control" rows="9"  placeholder="Small description for the booking complete email." id="msgSecondEmail"  data-field-value="yes" data-field-name="msgSecondEmail"><?php if(isset($__sysset)){echo $__sysset->msgSecondEmail;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="Small description for the booking complete email." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
		<h3 class="label-info text-center">Tab Instruction Texts</h3>
		</div>
				<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="instexttab3">Tab 3</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="wysihtml5 form-control" rows="9"  placeholder="Tab 3 instruction text." id="instexttab3"  data-field-value="yes" data-field-name="instexttab3"><?php if(isset($__sysset)){echo $__sysset->instexttab3;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="Instruction text for the tab 3." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="instexttab4">Tab 4</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="wysihtml5 form-control" rows="9"  placeholder="Tab 4 instruction text." id="instexttab4"  data-field-value="yes" data-field-name="instexttab4"><?php if(isset($__sysset)){echo $__sysset->instexttab4;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="Instruction text for the tab 4." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="instexttab5">Tab 5</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="wysihtml5 form-control" rows="9"  placeholder="Tab 5 instruction text." id="instexttab5"  data-field-value="yes" data-field-name="instexttab5"><?php if(isset($__sysset)){echo $__sysset->instexttab5;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="Instruction text for the tab 5." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="instexttab6">Tab 6</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					 <textarea class="wysihtml5 form-control" rows="9"  placeholder="Tab 6 instruction text." id="instexttab6"  data-field-value="yes" data-field-name="instexttab6"><?php if(isset($__sysset)){echo $__sysset->instexttab6;}?></textarea>
			</div>
			<div class="col-xs-2">
				<button title="Instruction text for the tab 6." data-placement="bottom"
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
