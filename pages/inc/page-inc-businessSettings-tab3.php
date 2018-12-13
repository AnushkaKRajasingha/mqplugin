<div class="position-center">
	<div class="row">
	<div class="col-md-6">
	<form role="form" class="form-horizontal" id="frm_BathroomPricing">
	<div class="form-group">
	<div class="col-xs-12 col-sm-12 col-lg-12">
		<label >Manage Bathroom Pricing</label>
		<p>
		Use this page to manage Bathroom pricing on the quote fornt-page.
		</p></div>
	</div>
		<div class="form-group">
			<label for="bathrNumbofBathrooms"
				class="col-xs-12 col-sm-2 col-lg-2 control-label">Number of Bathrooms</label>
			<div class="col-xs-10 col-sm-8 col-lg-6">
				<div class="input-group m-bot15">
					<input type="number" class="form-control" nme="bathrNumbofBathrooms"  data-field-value="yes" data-field-name="bathrcount" min="0" step="1"> <span
						class="input-group-addon">Bathroom(s)</span>
				</div>
			</div>
			
			<div class="col-xs-1">
				<button type="button" class="btn tooltips fa fa-question-circle"
					data-toggle="tooltip" data-placement="bottom" title=""
					data-original-title="The will be the amount of Bathrooms for the given price. This is a required field"></button>
			</div>
		</div>
<!-- 	<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="bathrDescription">Description</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="Bathroom" id="bathrDescription"
					class="form-control" data-field-value="yes" data-field-name="description">
			</div>
			<div class="col-xs-2">
				<button title="This will be the small description for the Bathroom. This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div> -->
<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="bathrPrice">Price</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<div class="input-group m-bot15"><span
						class="input-group-addon">$</span>
					<input type="number" class="form-control" name="bathrPrice"  data-field-value="yes" data-field-name="price" min="0" step="0.01"> 
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will be the beadroom price. This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="bathrSortOrder">Sort Order</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				
					<input type="number" class="form-control" name="bathrSortOrder"  data-field-value="yes" data-field-name="sortOrder" min="0" step="1"> 
				
			</div>
			<div class="col-xs-2">
				<button title="This will be the sort order of each Bathroom when it display on front quote page." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="bathrStatus">Active</label>
			<div class="col-xs-6 col-sm-8 col-lg-6">
				<div data-toggle="buttons" class="btn-group">
					<label class="btn btn-default btn-yes active"> <input type="radio" name="bathrStatus" checked data-field-value="yes" data-field-name="isActive" value="1">Yes</label> 
					<label class="btn btn-default btn-no"> <input type="radio" name="bathrStatus"  data-field-value="yes" data-field-name="isActive" value="0">No</label>
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
									id="btn_save_bathroompricing">Save Settings</button>
									<div class="hidden-xs hidden-sm col-md-1"></div>
									<button type="button" class="btn btn-success col-xs-12 col-md-4 btn-reset"
									id="btn_reset_bathroompricing">Reset</button>
							</div>		
					</div>
	</form>
	</div>
	<div class="col-md-6">
		 <table class="table table-hover general-table" id="data_table_bathroompricing"></table>
	</div>
	</div>
</div>
	