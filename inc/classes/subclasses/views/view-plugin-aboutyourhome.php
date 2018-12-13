<div class="col-md-6" id="about-your-home">
	<div class="col-sm-6 text-center icon-huge ">
		<span class="text">Square Footage</span><i
			class="fa fa-sqft fa-mymq-5x"></i><span class="text text-medume">
			<div class="col-md-12 input-container">
				<select class="form-control quoteValueMember" id="ctrlSquareFootage"
					data-field-value="yes" data-field-name="ctrlSquareFootage"
					data-propname="sqfootage">
					<option value="-1">Please select a Square Footage</option>
				</select>
			</div> </span>
	</div>
	<?php if($_syssettings->enablehourlyrate == 1){ ?>
	
	<div class="col-sm-6 text-center icon-huge">
		<span class="text">Is your home larger than <?php echo (int)$_syssettings->maxsqft;?>
			sq feet?
		</span><i class="fa fa-expand fa-mymq-5x"></i><span
			class="text text-medume"><br />
			<div class="col-md-12 input-container">
				<div class="">
					<div data-toggle="buttons" class="btn-group">
						<label class="btn btn-default btn-yes btn-xs"> <input type="radio"
							name="maxsqft" data-field-value="yes" data-field-name="yes"
							value="1" data-hourlyrate="<?php echo $_syssettings->hourlyrate; ?>">Yes
						</label> <label class="btn btn-default btn-no btn-xs active"> <input
							type="radio" name="maxsqft" checked data-field-value="yes"
							data-field-name="no" value="0">No
						</label>
					</div>
				</div>
			</div>
		</span>
	</div>
	<?php } ?>
	<div class="col-sm-6 text-center icon-huge hourly-rate-effects">
		<span class="text">Number of Bedrooms</span><i class="fa fa-bed fa-mymq-5x"></i><span
			class="text text-medume"><br />
			<div class="col-md-12 input-container">
				<select class="form-control quoteValueMember" id="ctrlBedRooms"
					data-field-value="yes" data-field-name="ctrlBedRooms"
					data-propname="bedrooms">
					<option value="-1"># of Bedrooms</option>
					<?php 
					$_bedrooms = new MMBedroomPricing();
					foreach ($_bedrooms->Get_BedroomPricing(1) as $key => $value) {
											?>
					<option value="<?php echo $value->uniqueid;?>">
						<?php echo $value->brcount.' '.$value->description.' (+ $'.$value->price.')';?>
					</option>
					<?php
										}
										?>
				</select>

			</div> </span>
	</div>
	<div class="col-sm-6 text-center icon-huge hourly-rate-effects">
		<span class="text">Number of Bathrooms</span><i
			class="fa fa-bathroom fa-mymq-5x"></i><span class="text text-medume"><br />
			<div class="col-md-12 input-container">
				<select class="form-control quoteValueMember" id="ctrlBathrooms"
					data-field-value="yes" data-field-name="ctrlBathrooms"
					data-propname="bathrooms">
					<option value="-1"># of Bathrooms</option>
					<?php 
					$_bathroom = new MMBathroomPricing();
					foreach ($_bathroom->Get_BathroomPricing(1) as $key => $value) {
											?>
					<option value="<?php echo $value->uniqueid;?>">
						<?php echo $value->bathrcount.' '.$value->description.' (+ $'.$value->price.')';?>
					</option>
					<?php
										}
										?>
				</select>
			</div> </span>
	</div>
	<div class="col-sm-6 text-center icon-huge hourly-rate-effects">
		<span class="text">Pets ?</span><i class="fa fa-paw fa-mymq-5x"></i><span
			class="text text-medume"><br />
			<div class="col-md-12 input-container">
				<select class="form-control quoteValueMember" id="ctrlPets"
					data-field-value="yes" data-field-name="ctrlPets"
					data-propname="pets">
					<option value="-1">Your pet option</option>
					<?php 
					$_pets = new MMPetPricing();
					foreach ($_pets->Get_PetPricing(1) as $key => $value) {
											?>
					<option value="<?php echo $value->uniqueid;?>">
						<?php echo $value->description.' (+ $'.$value->price.')';?>
					</option>
					<?php
										}
										?>
				</select>
			</div> </span>
	</div>
</div>
<div class="text-center hidden-md hidden-lg">
					<?php if($_syssettings){ echo $_syssettings->instexttab4;}?>
					</div>
<div
	class="col-md-6 hourly-rate-effects" id="extra-services">
	<div class="col-md-12">
		<h3 class="col-sm-6">Extra Services</h3>
		<div class="col-sm-6 text-right">
			<div data-toggle="buttons" class="btn-group">
				<label class="btn btn-default btn-yes btn-xs"> <input type="radio"
					name="extrasrvselect" data-field-value="yes"
					data-field-name="isActive" value="1">Select All
				</label> <label class="btn btn-default btn-no btn-xs active"> <input
					type="radio" name="extrasrvselect" checked data-field-value="yes"
					data-field-name="isActive" value="0">None
				</label>
			</div>
		</div>
	</div>
	<!-- Extra service starts here -->

	<?php $_addServices = new MMAdditionalServs(); $_addServiceColl = $_addServices->Get_AdditionalServs(1); 
	$_servicecount = count($_addServiceColl);
	if($_servicecount > 0 ){
				?>

	<?php 

	foreach ($_addServiceColl as $key => $value) {
					?>
	<div
		class="col-sm-6 text-center icon-huge addServices <?php echo $value->frequency.' '; if($value->frequencyisRecurring == '1'){ echo "Recurring";} else {if($value->frequencyisRecurring == '0') echo "Not-Recurring"; else echo "All";} ?>">
		<span class="text"><?php echo $value->description?> </span>
		<div data-uniqueid="<?php echo $value->uniqueid;?>" class="add-service icon-image" style="background-image:url('<?php echo $value->iconImageUrl;?>');" ></div>
		<span class="text text-medume"><br />
			<div class="col-md-12 input-container">
				<div data-toggle="buttons" class="btn-group">
					<label class="btn btn-default btn-yes"> <input type="radio"
						name="<?php echo $value->uniqueid;?>" data-field-value="yes"
						data-field-name="<?php echo $value->uniqueid;?>" value="1"
						data-propname="addServices" class="rdbaddservice">Yes
					</label> <label class="btn btn-default btn-no active"> <input
						type="radio" name="<?php echo $value->uniqueid;?>" checked
						data-field-value="yes"
						data-field-name="<?php echo $value->uniqueid;?>" value="0"
						data-propname="addServices" class="rdbaddservice">No
					</label>
				</div>
			</div> ( + $<?php echo $value->price;?>) </span>
	</div>
	<?php
				}
				?>

	<?php }else{ echo "<p> No Estra Service Found" ;
} ?>

	<!-- Extra service ends here -->
</div>
 <!-- Hourly rate option goes here -->
 <div class="col-sm-6 hourly-rate-effects form-horizontal"  style="display:none;" id="frm_hourlyrate">
	<div class="col-md-12">
		<h3 class="col-md-12">Go for Hourly Rate.</h3>		
	</div>
	<div class="form-group"><div class="clear"></div></div>
	<div class="form-group"><div class="col-md-12"><p>Since your home is lager than <?php echo $_syssettings->maxsqft;?> sq feet , you have to purchase the service for hourly rate.</p></div></div>
	<div class="form-group">
			<label class="col-md-3 control-label" for="ftPriceOption">Number of hours</label>
			<div class="col-md-6"><div class="input-group m-bot15">
			
				<input  placeholder="0.00" id="numbofhours"
					class="form-control" type="number" min="0" data-field-value="yes" data-field-name="numbofhours" min="1" step="0.5">
			<span
						class="input-group-addon">Hour(s)</span>
			</div>
			</div>
	</div>
	<div class="form-group"><label class="col-md-3 control-label" for="hourlyrateTotal">Total Cost</label> 
	<div class="col-md-6">
	<h3 style="margin: 0px;" id="hourlyrateTotal">$0.00</h3>
	</div>
	</div>
	</div>
  <!-- Hourly rate option ends here -->
<div class="text-left hidden-xs hidden-sm col-md-12">
					<?php if($_syssettings){ echo $_syssettings->instexttab4;}?>
					</div>