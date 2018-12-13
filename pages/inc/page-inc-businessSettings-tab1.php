<div class="position-center">
	<div class="row">
	<div class="col-md-6">
	<form role="form" class="form-horizontal" id="frm_startpricing">
	<div class="form-group">
	<div class="col-xs-12 col-sm-12 col-lg-12">
		<label >Manage Starting Prices</label>
		<p>
		Use this page to personalize the Starting Prices on the quote fornt-page.
		</p></div>
	</div>
	<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="busspHomeType">Building Type</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
				<select class="form-control" name="busspHomeType" id="busspHomeType"
					 data-field-value="yes" data-field-name="hometype">
					 		<option>Select a Building Type</option>
					 		<?php
							$__hometypes = new MMHomeTypes();
					 		 foreach ($__hometypes->GetHomeTypes(1) as $key => $value) {
					 			?>
					 		 <option value="<?php echo $value->uniqueid;?>"><?php echo $value->hometype;;?></option>
					 		<?php
					 		}?>
					 		</select>	
			</div>
			<div class="col-xs-2">
				<button title="This will be the type of premises going to display on quote starting page. This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="busspFrequent">Type of Cleaning</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">				
					<select class="form-control" name="busspFrequent" id="busspFrequent"
					 data-field-value="yes" data-field-name="frequency">
					 		<option>Select a Type of Cleaning</option>
					 		<?php
							$__hometypes = new MMFrequencies();
					 		 foreach ($__hometypes->Get_Frequencies(1) as $key => $value) {
					 			?>
					 		 <option value="<?php echo $value->uniqueid;?>"><?php echo $value->frequency;?></option>
					 		<?php
					 		}?>
					 		</select>
			</div>
			<div class="col-xs-2">
				<button title="This will be the frequent that going to display on quote starting page.  This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="busspPrice">Price</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				<div class="input-group m-bot15"><span
						class="input-group-addon">$</span>
					<input type="number" class="form-control" name="busspPrice"  data-field-value="yes" data-field-name="price" min="0" step="0.01"  required="required"> 
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will be the quote start price according the selected home type and frequent.  This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="busspSortOrder">Sort Order</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
				
					<input type="number" class="form-control" name="busspSortOrder"  data-field-value="yes" data-field-name="sortOrder" min="0" step="1"> 
				
			</div>
			<div class="col-xs-2">
				<button title="This will be the sort order of each start pricing option when it display on front quote page." data-placement="bottom"
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
				<button title="This will allows to enabl/disable the particuler price option. This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div class="form-group">
						<input type="hidden" data-field-value="yes" data-field-name="uniqueid" value=''/>
							<div class="col-xs-12 col-sm-6 col-lg-6 btn-container">
								<button type="button" class="btn btn-success col-xs-12 col-md-6 btn-submit"
									id="btn_save_startpricing">Save Settings</button>
									<div class="hidden-xs hidden-sm col-md-1"></div>
									<button type="button" class="btn btn-success col-xs-12 col-md-4 btn-reset"
									id="btn_reset_startpricing">Reset</button>
							</div>						
						
					</div>
	</form>
	</div>
	<div class="col-md-6">
		 <table class="table table-hover general-table" id="data_table_startpricing"></table>
	</div>
	</div>
</div>
	