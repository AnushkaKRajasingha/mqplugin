<?php include 'page-option-header.php'; ?>
<?php $__sysset = new MMSystemSettings(); $__sysset->GetSystemSetting();  ?>
<section class="wrapper">

	<div class="row">
		<div class="col-md-12">			
			<section class="panel">
				<header class="panel-heading tab-bg-dark-navy-blue">
					<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#hometypes"> <i
								class="fa  fa-home"></i> Building Types
						</a></li>
						<li class=""><a href="#frequency" data-toggle="tab"> <i
								class="fa  fa-cleaning"></i> Type of Cleaning
						</a></li>
						<li class=""><a data-toggle="tab" href="#osMarketing"> <i
								class="fa  fa-signal"></i> Marketing
						</a></li>
						<li class=""><a data-toggle="tab" href="#syssetHourlyRates"> <i
								class="fa fa-hourlyrate fa-mymq-lg"></i> Hourly Rates / Max. Sqft
						</a></li>
						<li class=""><a href="#apiSettings" data-toggle="tab"> <i
								class="fa fa-gears"></i> API Settings
						</a></li>
						<li class="<?php if($__sysset->infusionsoftstatus == '0'){echo 'disabled';}?>" id="isapifieldstab"><a href="#isapifields" data-toggle="tab"> <i
								class="fa fa-th-list"></i>Infusion API Fields
						</a></li>
						<li class=""><a href="#contactInformation" data-toggle="tab"> <i
								class="fa  fa-phone"></i> Contact Information
						</a></li>
						<li class=""><a href="#displayMessages" data-toggle="tab"> <i
								class="fa fa-align-justify"></i> Messages
						</a></li>
						<li class=""><a href="#gasettings" data-toggle="tab"> <i
								class="fa  fa-google"></i> Google Settings
						</a></li>
						<li class=""><a href="#extrasettings" data-toggle="tab"> <i
								class="fa  fa-wrench"></i> Extra Settings
						</a></li>
						
						
					</ul>
				</header>
				<div class="panel-body">
					<div class="tab-content">
					<div class="tab-pane  active" id="hometypes">
                           <?php  include_once 'inc/page-inc-initialParam-tab1.php';?>
                        </div>
						<div class="tab-pane" id="frequency">
                        <?php  include_once 'inc/page-inc-initialParam-tab2.php';?>
                        </div>   
                        <div class="tab-pane" id="osMarketing">
                           <?php  include_once 'inc/page-inc-osSettings-tab2.php';?>
                        </div>
                         <div class="tab-pane" id="syssetHourlyRates">
                           <?php  include_once 'inc/page-inc-sysSettings-tab3.php';?>
                        </div>  
						<div class="tab-pane" id="apiSettings">
                        <?php  include_once 'inc/page-inc-defaultSettings-tab5.php';?>
                        </div>
                        <div class="tab-pane" id="isapifields">
                        <?php  include_once 'inc/page-inc-defaultSettings-tab5_1.php';?>
                        </div>
						<div class="tab-pane" id="contactInformation">
                        <?php  include_once 'inc/page-inc-defaultSettings-tab2.php';?>
                        </div>
                        <div class="tab-pane" id="displayMessages">
                        <?php  include_once 'inc/page-inc-defaultSettings-tab3.php';?>
                        </div>
                         <div class="tab-pane" id="gasettings">
                        <?php  include_once 'inc/page-inc-sysSettings-tab9.php';?>
                        </div>
						 <div class="tab-pane" id="extrasettings">
                        <?php  include_once 'inc/page-inc-sysSettings-tab8.php';?>
                        </div>
						
					</div>
				</div>
			<!-- 	<div class="panel-heading tab-bg-dark-navy-blue">
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10 btn-container">
							<div class="col-xs-12 col-sm-4 col-lg-3">
								<button type="button" class="btn btn-success col-xs-12"
									id="btn_save_syssettings">Save Settings</button>
							</div>
						</div>
						<div class="clear"></div>
					</div>

				</div> -->
			</section>
			<!-- <input type="submit" value="" style="display: none;">  -->
			
		</div>
	</div>

</section>
<?php include 'page-option-footer.php'; ?>