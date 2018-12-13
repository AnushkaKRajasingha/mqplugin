<form class="form-horizontal" id="frm_quoteContacts" >
					 <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label" for="firstName">First Name</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="firstName" class="form-control" placeholder="First Name"  data-field-value="yes" data-field-name="firstName" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label" for="lastName">Last Name</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="lastName" class="form-control" placeholder="Last Name"  data-field-value="yes" data-field-name="lastName">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label" for="emailAddress">Email Address</label>
                                            <div class="col-lg-8">
                                                <input type="email" id="emailAddress" class="form-control" placeholder="Email Address"  data-field-value="yes" data-field-name="emailAddress" required>
                                            </div>
                                            <!-- modofications to the req#0006 -->
                                                <div class="col-lg-offset-4 col-lg-8 ">
                                            <div class="small checkbox single-row">                                            
                                                <input type="checkbox" 
                                                <?php 
                                                if($_syssettings && $_syssettings->isDefOptIn ){
													if($_syssettings->isDefOptIn == '0')
														echo " ";
													else echo ' checked="checked" ';
												}
												?> 
                                                data-field-value="yes" data-field-name="isOptIn" id="chbisOptIn" name="chbisOptIn">
                                                <label for="chbisOptIn" class="small-label">Yes, please send me my quote and information via email.</label>                                                
                                            </div>
                                            </div>
                                            <!-- modofications to the req#0006 -->
                                        </div> 
                                         
                                           <div class="form-group">
                                        <label class="col-lg-4 control-label" for="phoneNumber">Phone</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="phoneNumber" class="form-control" placeholder="Phone"  data-field-value="yes" data-field-name="phoneNumber" required>
                                        </div>
                                    </div>
                                 
                                        </div>
                                   <div class="col-md-6">
                                      
                                   
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label" for="zipcode">ZipCode</label>
                                        <div class="col-lg-8">                                            
                                            <input type="text" id="zipcode" class="form-control" placeholder="ZipCode"  data-field-value="yes" data-field-name="zipcode" disabled>
                                        </div>
                                    </div>                                   
                                     <div class="form-group">
                                     
						 <label class="col-lg-4 control-label" for="ctrlMarketingRef">How did you find us ?</label>
						<div class="col-lg-8">
								<select class="form-control quoteValueMember" id="ctrlMarketingRef"
									data-field-value="yes" data-field-name="ctrlMarketingRef" data-propname="marketingRef">
									<option value="-1">How did you find us</option>
									<?php 
									$_marketing = new MMAMarketing();
									foreach ($_marketing->Get_MarketingRefs(1) as $key => $value) {											
										?>
										 <option value="<?php echo $value->uniqueid;?>"><?php echo $value->description; ?></option>
										<?php
									}?>									
								</select>
							</div>
				
                                     </div>
                                    </div>
                                    
                     <div class="col-xs-12 text-left">
					<?php if($_syssettings){ echo $_syssettings->instexttab5;}?>
					</div>             
					<div class="form-group">
						<div class="col-lg-offset-10 col-lg-2">							
								<button type="button" class="btn btn-success col-xs-12"
									id="btn_save_contactInfo">Get My Quote</button>							
						</div>
						<div class="clear"></div>
					</div>

				
                                    <input type="submit" value="" style="display: none;">
                </form>