<div class="position-center">
	<div class="row">
	<div class="col-md-6">
	<form role="form" class="form-horizontal" id="frm_additionalserv">
	<div class="form-group">
	<div class="col-xs-12 col-sm-12 col-lg-12">
		<label >Manage Additional Servises</label>
		<p>
		Use this page to manage the Additional Service Pricing on the quote fornt-page. This form allows you to manage Additional service name price and it's display order.. 
		</p></div>
	</div>


			<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="asDescription">Service Name</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="Refrig and Freezer" id="asDescription"
					class="form-control" data-field-value="yes" data-field-name="description">
			</div>
			<div class="col-xs-2">
				<button title="This will be the small description for the additional service" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
				<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="asFrequent">Type of Cleaning</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">		
					<select class="form-control" name="asFrequent" id="asFrequent"
					 data-field-value="yes" data-field-name="frequency">
					 		<option>Select a Type of Cleaning</option>
					 		<?php
							$__hometypes = new MMFrequencies();
					 		 foreach ($__hometypes->Get_Frequencies(1) as $key => $value) {
					 			?>
					 		 <option value="<?php echo $value->uniqueid;?>"><?php echo $value->frequency;?></option>
					 		<?php
					 		}?>
					 		<option value="-1">All</option>
					 		</select>
			</div>
			<div class="col-xs-2">
				<button title="This will be the frequent that going to display on quote starting page.  This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
				<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="asIconImage">Icon Image</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="http://yourImagelocation.com/logo.png" id="asIconImage"
					class="form-control customurls" data-field-value="yes" data-field-name="iconImageUrl" required="required">
			</div>
			<div class="col-xs-2">
				<button title="This will display on quote additional service page according to the selected option.  This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="asPrice">Price</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<div class="input-group m-bot15"><span
						class="input-group-addon">$</span>
					<input type="number" class="form-control" name="asPrice"  data-field-value="yes" data-field-name="price" min="0" step="0.01"> 
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will be the price of the additional service." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="asSortOrder">Sort Order</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				
					<input type="number" class="form-control" name="asSortOrder"  data-field-value="yes" data-field-name="sortOrder" min="0" step="1"> 
				
			</div>
			<div class="col-xs-2">
				<button title="This will be the sort order of each service when it display on front quote page." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="asStatus">Active</label>
			<div class="col-xs-6 col-sm-8 col-lg-6">
				<div data-toggle="buttons" class="btn-group">
					<label class="btn btn-default btn-yes active"> <input type="radio" name="asStatus" checked data-field-value="yes" data-field-name="isActive" value="1">Yes</label> 
					<label class="btn btn-default btn-no"> <input type="radio" name="asStatus"  data-field-value="yes" data-field-name="isActive" value="0">No</label>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to enabl/disable the additional service. This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
						
							<input type="hidden" data-field-value="yes" data-field-name="uniqueid" value=''/>
							<div class="col-xs-12 col-sm-6 col-lg-6 btn-container">
								<button type="button" class="btn btn-success col-xs-12 col-md-6 btn-submit"
									id="btn_save_additionalserv">Save Settings</button>
									<div class="hidden-xs hidden-sm col-md-1"></div>
									<button type="button" class="btn btn-success col-xs-12 col-md-4 btn-reset"
									id="btn_reset_additionalserv">Reset</button>
							</div>						
						
					</div>
	</form>
	</div>
	<div class="col-md-6">
		 <table class="table table-hover general-table" id="data_table_additionalserv"></table>
	</div>
	</div>
</div>
	