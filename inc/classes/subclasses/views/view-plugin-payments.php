<form class="form-horizontal" id="frm_pmtsubmition" >
					 <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label" for="nameOnCard">Name on Card</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="nameOnCard" class="form-control" placeholder="Your Name on Card"  data-field-value="yes" data-field-name="nameOnCard" required>
                                            </div>
                                        </div>                                       
 
                                           <div class="form-group">
                                        <label class="col-lg-4 control-label" for="cardNumber">Card Number</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="cardNumber" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679; &#9679;&#9679;&#9679;&#9679; &#9679;&#9679;&#9679;&#9679; &#9679;&#9679;&#9679;&#9679;"  data-field-value="yes" data-field-name="cardNumber" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label" for="expMonth">Expiration Date</label>
                                        <div class="col-lg-4">
                                         <select class="form-control" id="expMonth" data-field-value="yes" data-field-name="expMonth"  >
                                         	<?php for ($i = 1; $i < 13; $i++) {
                                         		?>
                                         		<option value="<?php echo $i;?>"><?php echo $i.' - '.date('F', strtotime("2000-$i-01")); ?></option>
                                         		<?php 
                                         	}?>
                                         </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select class="form-control" id="expYear"   data-field-value="yes" data-field-name="expYear" >
                                         	<?php for ($i = 0; $i < 10; $i++) {
                                         		$year = date('Y') + $i;
                                         		?>
                                         		<option value="<?php echo $year;?>"><?php echo $year; ?></option>
                                         		<?php 
                                         	}?>
                                         </select>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label" for="cvv">Card Security Code</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="cvv" class="form-control" placeholder="000"  data-field-value="yes" data-field-name="cvv" required >
                                        </div>
                                    </div>                                     
                                        </div><div class="col-md-6">
                                      
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label" for="billingAddress">Street Address</label>
                                        <div class="col-lg-8">                                            
                                            <input type="text" id="billingAddress" class="form-control" placeholder="Billing Address 1"  data-field-value="yes" data-field-name="billingAddress" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label" for="billingAddress1"></label>
                                        <div class="col-lg-8">                                            
                                            <input type="text" id="billingAddres" class="form-control" placeholder="Billing Address 2"  data-field-value="yes" data-field-name="billingAddress1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label" for="billingcity">City</label>
                                        <div class="col-lg-8">                                            
                                            <input type="text" id="billingcity" class="form-control" placeholder="City"  data-field-value="yes" data-field-name="billingcity">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label" for="billingstate">State</label>
                                        <div class="col-lg-8">   
                                        <select class="form-control" id="billingstate"
									data-field-value="yes" data-field-name="billingstate" >
                                        	<?php foreach (init_var::_getUSStates() as $key => $value) {
                                        		?>
                                        		<option value="<?php echo $key;?>"><?php echo $value ?></option>
                                        		<?php
                                        	}?>
                                        	</select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label" for="billingzipcode">ZipCode</label>
                                        <div class="col-lg-8">                                            
                                            <input type="text" id="billingzipcode" class="form-control" placeholder="ZipCode"  data-field-value="yes" data-field-name="billingzipcode">
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label" for="billingemailAddress">Email Address</label>
                                            <div class="col-lg-8">
                                                <input type="email" id="billingemailAddress" class="form-control" placeholder="Email Address"  data-field-value="yes" data-field-name="billingemailAddress" required>
                                            </div>
                                        </div>
                                    </div>
                                  <div class="col-md-12">
 	 								<div class="form-group text-right"> 	 	 
 	 	 								 <h3 class="col-md-offset-6 col-md-6" id="pmtquotetotal"></h3>
 	 								</div>
 								</div>
 								<div class="col-md-12">
										<div class="form-group"><p><?php echo $_syssettings->custompmtmsg;?></p></div>
								</div>
 								<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-offset-4 col-md-4">							
													<button type="button" class="btn btn-success col-xs-12"
														id="btn_submit_payment">Authorize Card *</button>	
														<div class="text-center"><small>*Authorize your card and secure your service date</small></div>						
											</div>
											<div class="clear"></div>
										</div>
								</div>
                                <input type="submit" value="" style="display: none;">
                </form>
				<form class="form-horizontal hide-form" id="frm_thankyou" ><div id="thanlyou-container">
					<div class="col-md-12">
					<div class="form-group">
					<h3>Thank You</h3>
					<p><?php echo $_syssettings->thankyounotemsg; ?></p>
					</div>
					</div>
					<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-offset-4 col-md-4">
											<!-- req#0007 -->							
													<button id="btn_return-to-home" class="btn btn-success col-xs-12" onclick="javascript:window.location =  window.location;"
			type="button">Start New Quote</button>						
											</div>
											<div class="clear"></div>
										</div>
								</div>
				</div></form>                