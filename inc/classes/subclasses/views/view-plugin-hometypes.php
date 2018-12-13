<?php $_startpricing = new MMStartPricing(); $_hometypes = $_startpricing->GetHousTypes(1); 
					if(count($_hometypes) > 0){
					$colcount = 12 / count($_hometypes);
					foreach ($_hometypes as $key => $value) {
						?>
						<div class="col-sm-<?php echo $colcount; ?> col-md-<?php echo $colcount; ?> text-center icon-huge">
						<span class="text"><?php echo $value['hometypetext'];?></span><div data-hometype="<?php echo $value['hometype'];?>" class="start-price icon-image" style="background-image:url('<?php echo $value['iconImageUrl'];?>');" ></div><span
							class="text text-medume">Starting at $<?php echo $value['price'];?> </span>
					</div>
						<?php
					}
					}
					?>