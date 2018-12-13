<?php include 'page-option-header.php'; ?>
<section class="wrapper">

	<div class="row">
		<div class="col-md-12">			
			<section class="panel">
				<header class="panel-heading tab-bg-dark-navy-blue">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#busStartPricing"> <i
								class="fa  fa-home"></i> Starting Prices
						</a></li>
						<li class=""><a href="#psfirsttimeprices" data-toggle="tab"> <i
								class="fa  fa-thumbs-o-up"></i> First-Time Prices
						</a></li>
						<li class=""><a href="#busBedroomPricing" data-toggle="tab"> <i
								class="fa  fa-bed"></i> Bedroom Pricing
						</a></li>
						<li class=""><a href="#busBathroomPricing" data-toggle="tab"> <i
								class="fa fa-bathroom fa-mymq-lg"></i> Bathroom Pricing
						</a></li>
						
						<li class=""><a href="#busFrequency" data-toggle="tab"> <i
								class="fa  fa-retweet"></i> Frequency
						</a></li>
						<li class=""><a href="#apiSettings" data-toggle="tab"> <i
								class="fa fa-github-alt"></i> Pet Pricing
						</a></li>
						<li class=""><a data-toggle="tab" href="#ssSquareFootagePricing"> <i
								class="fa  fa-plus-square-o"></i> Square Footage Pricing
						</a></li>
						<li class=""><a data-toggle="tab" href="#osAdditionalServices"> <i
								class="fa  fa-plus"></i> Additional Services
						</a></li>
					</ul>
				</header>
				<div class="panel-body">
					<div class="tab-content">
						<div class="tab-pane  active" id="busStartPricing">
                           <?php  include_once 'inc/page-inc-businessSettings-tab1.php';?>
                        </div>
                        <div class="tab-pane" id="psfirsttimeprices">
                        <?php  include_once 'inc/page-inc-firsttimeprices.php';?>
                        </div>
						<div class="tab-pane" id="busBedroomPricing">
                        <?php  include_once 'inc/page-inc-businessSettings-tab2.php';?>
                        </div>
                        <div class="tab-pane" id="busBathroomPricing">
                        <?php  include_once 'inc/page-inc-businessSettings-tab3.php';?>
                        </div>
						<div class="tab-pane " id="busFrequency">
                        <?php  include_once 'inc/page-inc-businessSettings-tab4.php';?>
                        </div>
						<div class="tab-pane" id="apiSettings">
                        <?php  include_once 'inc/page-inc-businessSettings-tab5.php';?>
                        </div>
                        <div class="tab-pane" id="ssSquareFootagePricing">
                           <?php  include_once 'inc/page-inc-sizeSettings-tab1.php';?>
                        </div>
                        <div class="tab-pane" id="osAdditionalServices">
                           <?php  include_once 'inc/page-inc-osSettings-tab1.php';?>
                        </div>
					</div>
				</div>
				
			</section>
			
			
		</div>
	</div>
	
</section>
<?php include 'page-option-footer.php'; ?>