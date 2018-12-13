<?php include 'page-option-header.php'; ?>
<section class="wrapper">

	<div class="row">
		<div class="col-md-12">			
			<section class="panel">
				<header class="panel-heading tab-bg-dark-navy-blue">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#dsDatesAvailable"> <i
								class="fa  fa-calendar"></i> Dates Available
						</a></li>
						<li class=""><a data-toggle="tab" href="#dsDaySurchargeRate"> <i
								class="fa  fa-sort-amount-desc"></i> Day Surcharge Rate
						</a></li>
						<li class=""><a data-toggle="tab" href="#ssSquareFootagePricing"> <i
								class="fa  fa-location-arrow"></i> Manage Zipcodes
						</a></li>
					</ul>
				</header>
				<div class="panel-body">
					<div class="tab-content">
						<div class="tab-pane  active" id="dsDatesAvailable">
                           <?php  include_once 'inc/page-inc-dateSettings-tab1.php';?>
                        </div>
						<div class="tab-pane" id="dsDaySurchargeRate">
                           <?php  include_once 'inc/page-inc-dateSettings-tab2.php';?>
                        </div>
                        <div class="tab-pane" id="ssSquareFootagePricing">
                           <?php  include_once 'inc/page-inc-locSettings-tab1.php';?>
                        </div>
					</div>
				</div>
				
			</section>
			
			
		</div>
	</div>
</section>
<?php include 'page-option-footer.php'; ?>