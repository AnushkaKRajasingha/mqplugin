<div class="position-center">
	<div class="row">
	<div class="col-md-6">
	<form role="form" class="form-horizontal" id="frm_frequency">
	<div class="form-group">
	<div class="col-xs-12 col-sm-12 col-lg-12">
		<label >Manage Type of Cleaning</label>
		<p>
		Use this page to manage type of cleaning for the base price section.
		</p></div>
	</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="initparamfrq">Type of Cleaning</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="One Time" id="initparamfrq"
					class="form-control" data-field-value="yes" data-field-name="frequency"  required="required">
			</div>
			<div class="col-xs-2">
				<button title="This will be the Type of Cleaning that going to display on quote starting page.  This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="initparamfrqIconImage">Icon Image</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<input type="text" placeholder="http://yourImagelocation.com/logo.png" id="initparamfrqIconImage"
					class="form-control customurls" data-field-value="yes" data-field-name="iconImageUrl">
			</div>
			<div class="col-xs-2">
				<button title="This will display on quote start page according to the selected option.  This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="initparamfrqSortOrder">Sort Order</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				
					<input type="number" class="form-control" name="initparamfrqSortOrder"  data-field-value="yes" data-field-name="sortOrder" min="0" step="1"> 
				
			</div>
			<div class="col-xs-2">
				<button title="This will be the sort order of each start pricing option when it display on front quote page." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="initparamfrqrecurring">Recurring</label>
			<div class="col-xs-6 col-sm-8 col-lg-6">
				<div data-toggle="buttons" class="btn-group">
					<label class="btn btn-default btn-yes"> <input type="radio" name="initparamfrqrecurring"  data-field-value="yes" data-field-name="isRecurring" value="1">Yes</label> 
					<label class="btn btn-default btn-no active"> <input type="radio" name="initparamfrqrecurring"  checked data-field-value="yes" data-field-name="isRecurring" value="0">No</label>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to set whether it is recurring or not." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="initparamfrqStatus">Active</label>
			<div class="col-xs-6 col-sm-8 col-lg-6">
				<div data-toggle="buttons" class="btn-group">
					<label class="btn btn-default btn-yes active"> <input type="radio" name="initparamfrqStatus" checked data-field-value="yes" data-field-name="isActive" value="1">Yes</label> 
					<label class="btn btn-default btn-no"> <input type="radio" name="initparamfrqStatus"  data-field-value="yes" data-field-name="isActive" value="0">No</label>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to enabl/disable the particuler cleaning type. This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
						<input type="hidden" data-field-value="yes" data-field-name="uniqueid" value=''/>
							<div class="col-xs-12 col-sm-6 col-lg-6 btn-container">
								<button type="button" class="btn btn-success col-xs-12 col-md-7 btn-submit"
									id="btn_save_initparamfrq">Save Type of Cleaning</button>
									<div class="hidden-xs hidden-sm col-md-1"></div>
									<button type="button" class="btn btn-success col-xs-12 col-md-3 btn-reset"
									id="btn_reset_initparamfrq">Reset</button>
							</div>						
						
					</div>
	</form>
	</div>
	<div class="col-md-6">
		 <table class="table table-hover general-table" id="data_table_initparamFrequencies"></table>
	</div>
	</div>
</div>
	