<div class="position-center">
<?php $_ftprice = new MMFirstTimePricing(); $_ftprice->GetFirstTimePrice(); // var_dump($_ftprice);?>
<form id="frm_psfirsttimeprices" method="post" role="form" class="form-horizontal">
<div class="form-group">
			<label class="col-md-3 control-label" for="ftPriceOption">First-Time Price Option</label>
			<div class="col-md-5">
			<div data-toggle="buttons" class="btn-group">
				<?php setRadioBtnWithValue($_ftprice,'priceoption','ftPriceOption',array('Assign One-Time Prices','% From Total')); ?>
			</div>
				
			</div>
			<div class="col-xs-2">
				<button title="First-Time price selcting metod" data-placement="bottom"
					data-toggle="tooltip" class="btn tooltips fa fa-question-circle"
					type="button"></button>
			</div>
		</div>
		<div id="recurring-item-container">
			<?php 
			$_startPrices = new MMStartPricing(); $_startpricelist = $_startPrices->_GetStartPricing(1);
			
			$_norecurring = true;
			if( count($_startpricelist) > 0){
				foreach ($_startpricelist as $key => $value) {
					if($value->isRecurring == 1){
					?>
					<div class="form-group">
					
						<label class="col-md-3 control-label" for="prices.<?php echo $value->uniqueid;?>"> <?php echo $value->hometypetext.' / '.$value->frequencytext.' ($'.$value->price.')';  ?>  => </label>
							<div class="col-md-6">
								<select class="form-control" name="prices.<?php echo $value->uniqueid;?>" id="<?php echo $value->uniqueid;?>"
					 data-field-value="yes" data-field-name="prices.<?php echo $value->uniqueid;?>">
					 		<option value="-1">Select a the one-time price option.</option>
					 		<?php
							 $_onetimeOptionList = $_startPrices->_GetStartPricingForFirsttime(1,$value->hometype);
					 		 foreach ($_onetimeOptionList as $key2 => $value2) {
					 			?>
					 		 <option
					 		 <?php
							if(count($_ftprice->prices) > 0 && array_key_exists($value->uniqueid, $_ftprice->prices) && $_ftprice->prices[$value->uniqueid] == $value2->uniqueid ) {
								echo 'selected';
							}
					 		 ?>
					 		  value="<?php echo $value2->uniqueid;?>"><?php echo $value2->hometypetext.' / '.$value2->frequencytext.' ($'.$value2->price.')';  ?></option>
					 		<?php
					 		}?>
					 		</select>								 
							</div>							
						
					</div>
					<?php 
					$_norecurring = false;
					}					
				}
				if($_norecurring){
					?>
					<div class="form-group">						
						<label class="col-md-offset-3 col-md-8"> You don't have recurring type of cleaning option. </label>	
					</div>
					<div class="form-group">
						<div class="btn-container">
						<label class="col-md-3 control-label"> if you just created the starting prices with recurring type of cleaning.</label>
							<div class="col-md-2">
								<button type="button" class="btn btn-warning col-xs-12"
									id="btn_reload-recur-item-con" onclick="javascript:window.location = window.location+'#psfirsttimeprices'; location.reload();">Please Reload Page</button> 
							</div>							
						</div>
					</div>
					<?php 
				}
			}
			else{ ?>
			<div class="form-group">
						<div class="btn-container">
						<label class="col-md-3 control-label"> if you just created the starting prices.</label>
							<div class="col-md-2">
								<button type="button" class="btn btn-warning col-xs-12"
									id="btn_reload-recur-item-con" onclick="javascript:window.location = window.location+'#psfirsttimeprices'; location.reload();">Please Reload Page</button> 
							</div>							
						</div>
					</div>
			<?php } ?>
		</div>
				<div class="form-group">
						<div class="btn-container">
							<div class="col-md-offset-3 col-md-2">
								<button type="button" class="btn btn-success col-xs-12"
									id="btn_save_firsttimeprices">Save Settings</button>
							</div>
						</div>
					</div>
</form>
</div>
