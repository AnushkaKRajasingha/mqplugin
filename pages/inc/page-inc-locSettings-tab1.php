<div class="position-center">
	<div class="row">
	<div class="col-md-6">
	<form role="form" class="form-horizontal" id="frm_ServareaPricing">
	<div class="form-group">
	<div class="col-xs-12 col-sm-12 col-lg-12">
		<label >Manage Zipcodes</label>
		<p>
		Use this page to manage the zipcodes that are servicable. This form allows youto alter the zip code option you wish to have displayed. 
		</p></div>
	</div>
	
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="servareaZipcode">ZipCode</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="07002" name ="servareaZipcode" id="servareaZipcode"
					class="form-control" data-field-value="yes" data-field-name="zipcode" required="required">
			</div>
			<div class="col-xs-2">
				<button title="This will be the zipcode that service available. This is a required field." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
	<!-- <div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="servareaDescription">Description</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="BAYONNE NJ" name="servareaDescription" id="servareaDescription"
					class="form-control" data-field-value="yes" data-field-name="description">
			</div>
			<div class="col-xs-2">
				<button title="This will be the small description for the location." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div> -->
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="servareaSortOrder">Sort Order</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				
					<input type="number" class="form-control" name="servareaSortOrder"  data-field-value="yes" data-field-name="sortOrder" min="0" step="1"> 
				
			</div>
			<div class="col-xs-2">
				<button title="This will be the sort order of each Zipcode when it display on front quote page." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="spStatus">Active</label>
			<div class="col-xs-6 col-sm-8 col-lg-6">
				<div data-toggle="buttons" class="btn-group">
					<label class="btn btn-default btn-yes active"> <input type="radio" name="autoplay" checked data-field-value="yes" data-field-name="isActive" value="1">Yes</label> 
					<label class="btn btn-default btn-no"> <input type="radio" name="autoplay"  data-field-value="yes" data-field-name="isActive" value="0">No</label>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to enabl/disable the particuler zipcode. This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
						
							<input type="hidden" data-field-value="yes" data-field-name="uniqueid" value=''/>
							<div class="col-xs-12 col-sm-6 col-lg-6 btn-container">
								<button type="button" class="btn btn-success col-xs-12 col-md-6 btn-submit"
									id="btn_save_servareapricing">Save Settings</button>
									<div class="hidden-xs hidden-sm col-md-1"></div>
									<button type="button" class="btn btn-success col-xs-12 col-md-4 btn-reset"
									id="btn_reset_servareapricing">Reset</button>
							</div>					
						
					</div>
	</form>
	</div>
	<div class="col-md-6">
		 <table class="table table-hover general-table" id="data_table_servareapricing"></table>
	</div>
	</div>
</div>
	