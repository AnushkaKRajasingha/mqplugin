<div class="position-center">
	<div class="row">
	<div class="col-md-6">
	<form role="form" class="form-horizontal" id="frm_avalableDates">
	<div class="form-group">
	<div class="col-xs-12 col-sm-12 col-lg-12">
		<label >Manage Available Dates</label>
		<p>
		Use this page to manage the available service dates of the service provier. 
		</p></div>
	</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label" for="avaDateDate">Date</label>

			<div class="col-xs-10 col-sm-8 col-lg-6">
<!--<div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="<?php echo date("Y-m-d");	?>"  class="input-append date dpYears">
                                        <input type="text" readonly="" value="<?php echo date("Y-m-d");	?>" size="16" class="form-control" name="avaDateDate" data-field-value="yes" data-field-name="availabledate" >
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                              </span>
                                    </div>-->
                                    <div class="input-group input-large" data-date="<?php echo date("Y-m-d");	?>" data-date-format="yyyy-mm-dd">
                                        <input type="text" placeholder="Start Date" class="form-control dpd1" name="avaDateDateFrom"  data-field-value="yes" data-field-name="availabledate">
                                        <span class="input-group-addon">To</span>
                                        <input type="text" placeholder="End Date"  class="form-control dpd2" name="avaDateDateTo" data-field-value="yes" data-field-name="availabledateto">
                                    </div>
				
			</div>
			<div class="col-xs-1">
				<button title="This will be the date for that service available." data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
				<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-lg-2 control-label"
				for="avaAvailability">Availablity</label>
			<div class="col-xs-6 col-sm-8 col-lg-6">
				<div data-toggle="buttons" class="btn-group">
					<label class="btn btn-default btn-yes active"> <input type="radio" name="avaAvailability" checked data-field-value="yes" data-field-name="isActive" value="1">Yes</label> 
					<label class="btn btn-default btn-no"> <input type="radio" name="avaAvailability"  data-field-value="yes" data-field-name="isActive" value="0">No</label>
				</div>
			</div>
			<div class="col-xs-2">
				<button title="This will allows to set the availability of each days. This is a required field" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
			</div>	
		<div class="form-group">
						
							<input type="hidden" data-field-value="yes" data-field-name="uniqueid" value=''/>
							<div class="col-xs-12 col-sm-6 col-lg-6 btn-container">
								<button type="button" class="btn btn-success col-xs-12 col-md-6 btn-submit"
									id="btn_save_avaDate">Save Settings</button>
									<div class="hidden-xs hidden-sm col-md-1"></div>
									<button type="button" class="btn btn-success col-xs-12 col-md-4 btn-reset"
									id="btn_reset_avaDate">Reset</button>
							</div>							
						
					</div>
	</form>
	</div>
	<div class="col-md-6">
		 <table class="table table-hover general-table" id="data_table_avaDate"></table>
	</div>
	</div>
</div>
	