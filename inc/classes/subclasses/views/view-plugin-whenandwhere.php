<div class="col-sm-6 col-md-6 text-center icon-huge">
						<span class="text">Pick Your Date</span><i class="fa fa-calendar"></i><span
							class="text text-medume"><br />
							<div class="col-md-10 input-container">
								<select class="form-control quoteValueMember" id="ctrlScheduale"
									data-field-value="yes" data-field-name="ctrlScheduale" data-propname="schedule" title="Pick Your Date ( Schedule Date )">
									<option value="-1">Select a date</option>
									<?php 
									$_datesAvailable = new MMAvailableDates();
									$_surcharge = new MMSurchargeRates();
									foreach ($_datesAvailable->Get_AvailableDates(1) as $key => $value) {
											$sc = $_surcharge->GetSurchargeRateByDate($value->availabledate); // req#0005 by AKR
											if($sc && $sc[0]['isActive']){
										?>
										 <option value="<?php echo $value->uniqueid;?>"><?php echo $value->availabledate." ".date("l",strtotime($value->availabledate)); if($sc){ echo " (+ $".$sc[0]['price'].")";} ?></option>
										<?php
									}}?>									
								</select>
							</div> </span>
					</div>
					<div class="col-sm-6 col-md-4 text-center icon-huge" id="recurringSchedule" style="display:none;">
						<span class="text">Recurring Schedule</span><i class="fa  fa-retweet"></i><span
							class="text text-medume"><br />
							<div class="col-md-10 input-container">
								<select class="form-control quoteValueMember" id="ctrlfrequency"
									data-field-value="yes" data-field-name="ctrlfrequency" data-propname="frequency">
									<option value="-1">Select the frequency</option>
									<?php 
									$_frequency = new MMFrequencyPricing();
									foreach ($_frequency->Get_FrqPricing(1) as $key => $value) {											
										?>
										 <option value="<?php echo $value->uniqueid;?>"><?php echo $value->description.' (+$'.$value->price.')'; ?></option>
										<?php
									}?>									
								</select>
							</div> </span>
					</div>
					<div class="col-sm-6 col-md-6 text-center icon-huge">
						<span class="text">Where are you ?</span><i class="fa fa-location-arrow"></i><span
							class="text text-medume"><br />
							<div class="col-md-10 input-container">
								<select class="form-control quoteValueMember" id="ctrlServArea"
									data-field-value="yes" data-field-name="ctrlServArea" data-propname="servicearea">
									<option value="-1">Select your zip code</option>
									<?php 
									$_ServAvailable = new MMServAreaPricing();
									
									foreach ($_ServAvailable->Get_ServAreaPricing(1) as $key => $value) {
										?>
										 <option value="<?php echo $value->uniqueid;?>"><?php echo $value->zipcode;?> </option>
										<?php
									}?>		
								</select>
							</div> </span>
					</div>
					<div class="col-md-8 text-left">
					<?php if($_syssettings){ echo $_syssettings->instexttab3;}?>
					</div>