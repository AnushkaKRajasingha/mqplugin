<div class="position-center">
	<div class="row">
	<div class="col-md-6">
	<form role="form" class="form-horizontal" id="frm_SqfPricing">
	<div class="form-group">
	<div class="col-xs-12 col-sm-12 col-lg-12">
		<label >Manage Square Footage Pricing</label>
		<p>
		Use this page to manage the Square Footage Pricing on the quote fornt-page. You must save start pricing before create a Square Footage Pricing Option. 
		</p></div>
	</div>
	<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sqfFrequency">Type of Cleaning</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
			<select class="form-control" name="sqfFrequency" id="sqfFrequency" 
					 data-field-value="yes" data-field-name="frequency">
					 <option>Select a Type of Cleaning</option>
					 <?php 
					 	$_startPricing = new MMStartPricing();
					 	foreach ($_startPricing->GetCleaningTypes(1) as $key => $value) {
					 		?>
					 		 <option value="<?php echo $value['frequency'];?>"><?php echo $value['frequencytext'];?></option>
					 		<?php 
					 	}
					 ?>
					 </select>				
			</div>
			<div class="col-xs-2">
				<button title="This will be type of cleaning for the squre footage pricing ." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div> 

			<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sqfDescription">Description</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="25 Sqf" name="sqfDescription" id="sqfDescription"
					class="form-control" data-field-value="yes" data-field-name="description">
			</div>
			<div class="col-xs-2">
				<button title="This will be the small description for the squre footage pricing" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sqfPrice">Price</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<div class="input-group m-bot15"><span
						class="input-group-addon">$</span>
					<input type="number" class="form-control" name="sqfPrice"  data-field-value="yes" data-field-name="price" min="0" step="0.01"> 
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will be the price of the selected squre footage." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="sqfSortOrder">Sort Order</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				
					<input type="number" class="form-control" name="sqfSortOrder"  data-field-value="yes" data-field-name="sortOrder" min="0" step="1"> 
				
			</div>
			<div class="col-xs-2">
				<button title="This will be the sort order of each Sq.foot pricing when it display on front quote page." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="sqfStatus">Active</label>
			<div class="col-xs-6 col-sm-8 col-lg-6">
				<div data-toggle="buttons" class="btn-group">
					<label class="btn btn-default btn-yes active"> <input type="radio" name="sqfStatus" checked data-field-value="yes" data-field-name="isActive" value="1">Yes</label> 
					<label class="btn btn-default btn-no"> <input type="radio" name="sqfStatus"  data-field-value="yes" data-field-name="isActive" value="0">No</label>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to enabl/disable the particuler price option. This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
						
							<input type="hidden" data-field-value="yes" data-field-name="uniqueid" value=''/>
							<div class="col-xs-12 col-sm-6 col-lg-6 btn-container">
								<button type="button" class="btn btn-success col-xs-12 col-md-6 btn-submit"
									id="btn_save_sqfpricing">Save Settings</button>
									<div class="hidden-xs hidden-sm col-md-1"></div>
									<button type="button" class="btn btn-success col-xs-12 col-md-4 btn-reset"
									id="btn_reset_sqfpricing">Reset</button>
							</div>							
						
					</div>
	</form>
	</div>
	<div class="col-md-6">
		 <table class="table table-hover general-table" id="data_table_sqfpricing"></table>
	</div>
	</div>
</div>
	