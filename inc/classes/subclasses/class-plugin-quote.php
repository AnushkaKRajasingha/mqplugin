<?php
use Stripe\Object;
/**
 * @author Anushka Rajasingha
 * @url http://www.anushkar.com
 * @date 02/26/2015
 * @uses Quote Data Fields
 *
 */
if (interface_exists('IMMPriceBase') && !class_exists('MMQuotes')) {
	class MMQuotes extends MMQuoteBase{
		use MMDbBase;

		public $startpricing;
		public $schedule;
		public $frequency;
		public $servicearea;
		public $sqfootage;
		public $bedrooms;
		public $bathrooms;
		public $pets;
		public $addServices;
		/**
		 * Which holds contact details of the Quote
		 * @since 1.0.0
		 * @access public
		 * @var MMContacts
		 * @category classObject
		 * @param ISLevel0 MMContacts IS Leval 0 Parameter
		 */
		public $contactinfo;
		public $marketingRef;
		
		/**
		 * Total Price of the Quote
		 * @name Total Price
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $totalprice;		
		
		/**
		 * Is the quote for Hourly rate
		 * @name Is Hourly Rate
		 * @since 1.0.0
		 * @access public
		 * @var bool
		 * @category varable
		 * @subpackage MMQuotes
		 * @param ISLevel0 string directmap
		 */
		public $isHourlyRate;
		public $hourlyrate;
		
		public $isLocked;
		public $payment;
		
		
		public $firsttimeclean;
		
		private $__totalclean;
		public $__priceSuggesions;
		
		public $_totalpriceStr;
		private $_pdf = 0.00;
		private $_extraserv ='';
		private $_extraservcost = '';
		public $_typeofclean;
		
		/* IS required fields */ 
		
		/**
		 * Frequency Desired of the Quote
		 * @name Frequency Desired
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $FrequencyDesired;
		/**
		 * Type of Clean Interested In of the Quote
		 * @name Type of Clean Interested In
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $TypeofCleanInterestedIn;
		/**
		 * Weekly Cost of the Quote
		 * @name Weekly Cost
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $WeeklyCost;
		/**
		 * BiWeekly Cost of the Quote
		 * @name BiWeekly Cost
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $BiWeeklyCost;
		/**
		 * Monthly Cost of the Quote
		 * @name Monthly Cost
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $MonthlyCost;
		
		public $AnyQuestionsorComments;
		
		/**
		 * First Time Clean Quote
		 * @name First Time Clean Quote
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $FirstCleanQuote;
		/**
		 * One Time or Move Out Clean Quote
		 * @name One Time or Move Out Clean Quote
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $OTMOQuote;
		
		/**
		 * Quote Create Date
		 * @name Quote Create Date
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $quotecreatedate;
		
		/**
		 * Current Quote Type
		 * @name Current Quote Type
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $CurrentQuoteType;
		
		
		
		public function __construct(){ $this->__init();}
		public function applyData(){
			try {
				$this->schedule->applyData();
				$this->sqfootage->applyData();
				$this->contactinfo->applyData();
				$this->hourlyrate->applyData();
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
			}
		}		
		/* Implement MMQuoteBase abstract Members  */ 		
		public function __init(){
			try {
				$this->_setTablename('_quotes');
				$this->FrequencyDesired = 'Other';
				$this->startpricing = new MMStartPricing();
				$this->schedule = new MMAvailableDates();
				$this->frequency = new MMFrequencyPricing();
				$this->servicearea = new MMServAreaPricing();
				$this->sqfootage = new MMSqFootagePricing();
				$this->bedrooms = new MMBedroomPricing();
				$this->bathrooms = new MMBathroomPricing();
				$this->pets = new MMPetPricing();
				$this->addServices = Array();
				$this->contactinfo = new MMContacts();
				$this->marketingRef = new MMAMarketing();
				$this->hourlyrate = new MMHourlyRates();
				$this->__priceSuggesions = array();
				$this->isLocked = false;
				$this->payment = new MMPayments();
				$this->FirstCleanQuote = $this->OTMOQuote = (float)0;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		/* Implement MMQuoteBase abstract Members  ends */
	
		/* MMStartPricing Members */
		
		
		public function __setDbData(){
			
			$this->dbdata = array(
					'uniqueid' => $this->uniqueid,
					'startpricing' => maybe_serialize($this->startpricing),
					'schedule' => maybe_serialize($this->schedule),
					'frequency' =>  maybe_serialize($this->frequency),
					'servicearea' =>  maybe_serialize($this->servicearea),
					'sqfootage' =>  maybe_serialize($this->sqfootage),
					'bedrooms' =>  maybe_serialize($this->bedrooms),
					'bathrooms' =>  maybe_serialize($this->bathrooms),					
					'pets' =>  maybe_serialize($this->pets),
					'addServices' =>  maybe_serialize($this->addServices),
					'contactinfo' =>  maybe_serialize($this->contactinfo),
					'marketingRef' =>  maybe_serialize($this->marketingRef),
					'totalprice' => $this->totalprice,
					'isHourlyRate' => $this->isHourlyRate,
					'hourlyrate' => maybe_serialize($this->hourlyrate),
					'isActive' => $this->isActive,
					'isLocked' => $this->isLocked,
					'payment' =>  maybe_serialize($this->payment) 
			);
		}
		
		public function _makeViwable(){
			try {
				$this->_calTotal();
				$this->createdate = date('Y-m-d',strtotime($this->createdate));
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function __totale(){
			$errorlogger = new ErrorLogger();
			
			
			//var_dump(debug_backtrace());//debug_print_backtrace();
			//echo 'itis here';
			$this->totalprice = 0; $this->_typeofclean = $this->startpricing->frequencytext;
			if($this->isHourlyRate){
				$this->totalprice = $this->hourlyrate->price;
				$this->_typeofclean = 'Hourly Rate';
			}
			else{
				$this->totalprice = 0;
				if ($this->startpricing->uniqueid != null) {
					$this->totalprice += $this->startpricing->price;
				}
				if ($this->schedule->uniqueid != null) {
					$_surcharge = new MMSurchargeRates();
					$sc = $_surcharge->GetSurchargeRateByDate($this->schedule->availabledate);
					if ($sc) {
						$this->totalprice += $sc[0]['price'];
						$this->_pdf = $sc[0]['price'];
					}					
				}
				if ($this->frequency->uniqueid != null) {
					$this->totalprice += $this->frequency->price;
				}
				if ($this->sqfootage->uniqueid != null) {
					$this->totalprice += $this->sqfootage->price;
				}
				if ($this->bedrooms->uniqueid != null) {
					$this->totalprice += $this->bedrooms->price;
				}
				if ($this->bathrooms->uniqueid != null) {
					$this->totalprice += $this->bathrooms->price;
				}
				if ($this->pets->uniqueid != null) {
					$this->totalprice += $this->pets->price;
				}
				if (is_array($this->addServices) && count($this->addServices) > 0) {
					foreach ($this->addServices as $key => $value) {
						$this->totalprice += $value->price;
						$this->_extraserv .= $value->description.',';
						$this->_extraservcost .= number_format((float)$value->price,2).',';
					}
					$this->_extraserv = rtrim($this->_extraserv,',');
					$this->_extraservcost = rtrim($this->_extraservcost,',');
				}
				
				$this->__totalclean = $this->totalprice;
				
				$__pricewithoutrecurr = $this->totalprice - $this->frequency->price;
				
				
				$_frequency = new MMFrequencies();
				$_frequency->uniqueid = $this->startpricing->frequency;
				$_frequency->_getItem();
				
				if($_frequency->isRecurring == 1){

					$_recurschedual = new MMFrequencyPricing();
					
					$_ftpricing = new MMFirstTimePricing();
					$_ftpricing->GetFirstTimePrice();
					
					//var_dump($this->startpricing->uniqueid);
					//var_dump($_ftpricing->prices);
					/* Fix for the first time price cheking */ 
					$_hasStartPricing = array_key_exists($this->startpricing->uniqueid, $_ftpricing->prices);				
					/* Fix for the first time price cheking */
					
					if ($_hasStartPricing) {
						$_startPricing = new MMStartPricing();
						$_startPricing->uniqueid = $_ftpricing->prices[$this->startpricing->uniqueid];
						$_startPricing->_getItem(); //var_dump($_startPricing);
					}
					
					
					
					
					$_selected = false;
					foreach ($_recurschedual->Get_FrqPricing(1) as $key => $value) {
						
						if($_ftpricing->priceoption != -1){
							if($value->uniqueid == $this->frequency->uniqueid)
							{
								//$this->firsttimeclean = $this->totalprice + ($this->totalprice * ($_ftpricing->priceoption / 100));
								$this->firsttimeclean = $__pricewithoutrecurr + ($__pricewithoutrecurr * ($_ftpricing->priceoption / 100));
								//$this->totalprice += $this->firsttimeclean;
								$_selected = true;
							}
							//else{
								$_suggestTotal = $__pricewithoutrecurr + $value->price ;
								//$_suggestTotalFtc = $_suggestTotal + ($_suggestTotal * ($_ftpricing->priceoption / 100));
								//$_suggestTotal += $_suggestTotalFtc;
								$this->__priceSuggesions[] = array('desc' => 'Total for '.$value->description, 'total'=> $_suggestTotal ,'selected' => $_selected );
							//}
						}
						else{							
							//echo $_ftpricing->prices[$this->startpricing->uniqueid].PHP_EOL;
							
							if($value->uniqueid == $this->frequency->uniqueid && $_hasStartPricing)
							{
								/* SqF cleaning type modification 04212015 */
								$__oneTimeSqfPrice = $this->sqfootage->getOnetimePrice($_startPricing);
								//var_dump($__oneTimeSqfPrice);
								/* SqF cleaning type modification 04212015 */
								
								$this->firsttimeclean = $__pricewithoutrecurr - $this->startpricing->price + $_startPricing->price - $this->sqfootage->price + $__oneTimeSqfPrice;
								//$this->totalprice += $this->firsttimeclean;
								$_selected = true;
							}
							//else{
								$_suggestTotal = $__pricewithoutrecurr + $value->price ;
								//$_suggestTotalFtc = $__pricewithoutrecurr - $this->startpricing->price + $_startPricing->price;
								//$_suggestTotal += $_suggestTotalFtc;
								$this->__priceSuggesions[] = array('desc' => 'Total for '.$value->description, 'total'=> $_suggestTotal ,'selected' => $_selected);
							//}
						}
						$_selected = false;
						
					}
					$this->totalprice = $this->firsttimeclean;
				}
			
			}
			
			if($this->isLocked && $this->payment->isPaid){
				$this->totalprice = $this->payment->amount;
			}
			
			return $this->totalprice;
		}
		
		private function _calTotal(){
			try {		
				$this->__totale();
				$this->_totalpriceStr = number_format((float)$this->totalprice,2);
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public  function GetQuoteSummery($withinlinecss = 0){
			try {
				$_summeryContainer_style = " style='' ";
				$_summeryContainer_h3_style = " style='' ";
				$_serviceItem_start_style = " style='' ";
				$_serviceItemSub_start_style = "";
				$_serviceItemSub_row_start_style = " style='' ";
				$_lable_start_style = " style='' ";
				$_valuetext_start_style = " style='' ";
				$_currvaluetext_start_style = " style='' ";
				$_notselected_style = " style='' ";
				$_zeroValue_style = " style='' ";
				
				$_bold_style = " style='' ";
				$_currencySymbol = '';
				$_spacer = '';
				
				if($withinlinecss == 1){
					$_summeryContainer_style = " style='padding:2em;background-color:#eeeeee;' ";
					$_summeryContainer_h3_style = " style='' ";
					$_serviceItem_start_style = " style='padding-top: 0;margin-top: 0;clear: both;display: block;font-size: 1.2em;width: 100%;' ";
					$_serviceItemSub_start_style = " style='padding-left:2%;' ";
					$_serviceItemSub_row_start_style = " style='' ";
					$_lable_start_style = " style='margin-top: 0;padding-top: 0;display: inline-block;width: 30%; ' ";
					$_valuetext_start_style = " style='margin-top: 0;padding-top: 0;display: inline-block;width: 50%;' ";
					$_currvaluetext_start_style = " style='' ";
					$_notselected_style = " style='color: #ff0000;' ";
					$_zeroValue_style = " style='color: #ff0000;' ";
					
					$_bold_style = " style='font-weight:bold; ' ";
					$_currencySymbol = '$ ';
					$_spacer = '&nbsp;&nbsp;';
				}
				
				
				$_summeryContainer = "<div id='summery_{$this->uniqueid}' class='quote-summery' {$_summeryContainer_style}>";
				$_summeryContainer_end = "</div>";
				$_summeryHtml = "<h3 {$_summeryContainer_h3_style}>Summary</h3>";
				$_serviceItem_start = "<div class='service-item' {$_serviceItem_start_style}>"; $_serviceItem_end = "</div>";
				$_serviceItemSub_start = "<div class='service-item-sub' >"; $_serviceItemSub_end = "</div>";
				$_serviceItemSub_row_start = "<div class='service-item-sub row' >"; $_serviceItemSub_row_end = "</div>";
				$_lable_start = "<span class='lable-text' {$_lable_start_style}>"; $_lable_end = "</span>";
				$_valuetext_start = "<span class='value-text' {$_valuetext_start_style}>"; $_valuetext_end = "</span>";
				$_currvaluetext_start = "<span class='value-text currency' {$_currvaluetext_start_style}>".$_currencySymbol; $_currvaluetext_end = "</span>";
				$_notselected = "<span class='warning' {$_notselected_style}>Not selected</span>";
				$_zeroValue = "<span class='warning' {$_zeroValue_style}>0.00</span>";
				$_errorValue = $_serviceItemSub_start.$_lable_start.$_notselected.$_lable_end.$_currvaluetext_start.$_zeroValue.$_valuetext_end.$_serviceItemSub_end;
				
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Preferred Service '.$_lable_end.$_valuetext_start.$this->startpricing->hometypetext."/".$this->startpricing->frequencytext.$_valuetext_end.$_serviceItem_end;
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Date Scheduled '.$_lable_end.$_valuetext_start.date('l - F j, Y',strtotime($this->schedule->availabledate)).$_valuetext_end.$_serviceItem_end;
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Service Area '.$_lable_end.$_valuetext_start.$this->servicearea->zipcode.$_valuetext_end.$_serviceItem_end;
				
				if($this->isHourlyRate){
					$_summeryHtml .= $_serviceItem_start.$_lable_start.'Hourly Charge Details '.$_lable_end.$_serviceItem_end;
					$_summeryHtml .= $_serviceItemSub_start.$_lable_start.'Hourly Rate'.$_lable_end.$_currvaluetext_start.$this->hourlyrate->hourlyrate.$_valuetext_end.$_serviceItemSub_end;
					$_summeryHtml .= $_serviceItemSub_start.$_lable_start.'No. of Hours'.$_lable_end.$_valuetext_start.$this->hourlyrate->numberofhours.$_valuetext_end.$_serviceItemSub_end;
					$_summeryHtml .= $_serviceItem_start."<span class='quote-total actual'>".$_lable_start.'Total '.$_lable_end.$_currvaluetext_start.$this->totalprice.$_valuetext_end."</span>".$_serviceItem_end;
				}
				else{
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Beginning Price '.$_lable_end.$_currvaluetext_start.$this->startpricing->price.$_currvaluetext_end.$_serviceItem_end;
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Preferred Date Fee '.$_lable_end.$_serviceItem_end;	
							
				$_surcharge = new MMSurchargeRates();
				$sc = $_surcharge->GetSurchargeRateByDate($this->schedule->availabledate);
				$__date = date('D M j',strtotime($this->schedule->availabledate));
				$_sp = '0.00';
				if ($sc) {
					$_sp = $sc[0]['price'];
				}				
				$__date = $__date.' (+$'.$_sp.')';				
				$_summeryHtml .= $_serviceItemSub_start.$_lable_start.$_spacer.$__date.$_lable_end.$_currvaluetext_start.$_sp.$_valuetext_end.$_serviceItemSub_end;
				
				$_frequency = new MMFrequencies();
				$_frequency->uniqueid = $this->startpricing->frequency;
				$_frequency->_getItem();
				
				if($_frequency->isRecurring == 1){
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Recurring Schedule '.$_lable_end.$_serviceItem_end;
				if($this->frequency->uniqueid != null)
					$_summeryHtml .= $_serviceItemSub_start.$_lable_start.$_spacer.$this->frequency->description.$_lable_end.$_currvaluetext_start.$this->frequency->price.$_valuetext_end.$_serviceItemSub_end;
				else
					$_summeryHtml .= $_errorValue;
				}
				
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Square Footage '.$_lable_end.$_serviceItem_end;
				
				if($this->sqfootage->uniqueid != null)
					$_summeryHtml .= $_serviceItemSub_start.$_lable_start.$_spacer.$this->sqfootage->description.$_lable_end.$_currvaluetext_start.$this->sqfootage->price.$_valuetext_end.$_serviceItemSub_end;
				else
					$_summeryHtml .= $_errorValue;
				
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Bedrooms '.$_lable_end.$_serviceItem_end;
				if($this->bedrooms->uniqueid != null)
				$_summeryHtml .= $_serviceItemSub_start.$_lable_start.$_spacer.$this->bedrooms->brcount.' '.$this->bedrooms->description.$_lable_end.$_currvaluetext_start.$this->bedrooms->price.$_valuetext_end.$_serviceItemSub_end;
				else
					$_summeryHtml .= $_errorValue;
				
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Bathrooms '.$_lable_end.$_serviceItem_end;
				if($this->bathrooms->uniqueid != null)
				$_summeryHtml .= $_serviceItemSub_start.$_lable_start.$_spacer.$this->bathrooms->bathrcount.' '.$this->bathrooms->description.$_lable_end.$_currvaluetext_start.$this->bathrooms->price.$_valuetext_end.$_serviceItemSub_end;
				else
					$_summeryHtml .= $_errorValue;
				
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Pets '.$_lable_end.$_serviceItem_end;
				if($this->pets->uniqueid != null)
				$_summeryHtml .= $_serviceItemSub_start.$_lable_start.$_spacer.$this->pets->description.$_lable_end.$_currvaluetext_start.$this->pets->price.$_valuetext_end.$_serviceItemSub_end;
				else
					$_summeryHtml .= $_errorValue;
				
				$_summeryHtml .= $_serviceItem_start.$_lable_start.'Extra Services '.$_lable_end.$_serviceItem_end;
				if (is_array($this->addServices) && count($this->addServices) > 0) {
					foreach ($this->addServices as $key => $value) {
						$_summeryHtml .= $_serviceItemSub_start.$_lable_start.$_spacer.$value->description.$_lable_end.$_currvaluetext_start.$value->price.$_valuetext_end.$_serviceItemSub_end;
					}
				}	

				if($_frequency->isRecurring == 1){
					//$_summeryHtml .= $_serviceItemSub_row_start.$_lable_start.'First Time Clean'.$_lable_end.$_currvaluetext_start.number_format((float)$this->firsttimeclean,2).$_currvaluetext_end.$_serviceItem_end;
					$_summeryHtml .= $_serviceItem_start."<span class='quote-total actual' {$_bold_style}>".$_lable_start.'First Time Clean '.$_lable_end.$_currvaluetext_start.number_format((float)$this->totalprice,2).$_valuetext_end."</span>".$_serviceItem_end;
					/* req#0009 */
					$_sysset = new MMSystemSettings(); $_sysset->GetSystemSetting();
					if(!empty($_sysset->FTCExplanation)){
					$_summeryHtml .= $_serviceItemSub_start."<span class='actual lable-text' {$_bold_style}>".$_sysset->FTCExplanation."</span>".$_serviceItem_end;
					}
					/* req#0009 */
				}
				else{
					$_summeryHtml .= $_serviceItem_start."<span class='quote-total actual' {$_bold_style}>".$_lable_start.'Total '.$_lable_end.$_currvaluetext_start.number_format((float)$this->totalprice,2).$_valuetext_end."</span>".$_serviceItem_end;
				}
									
				foreach ($this->__priceSuggesions as $key => $value) {
					$c = $value['selected'] ? 'actual' : '';
					$_bold = '';  
					if ($withinlinecss == 1 && $value['selected']) {
						$_bold = "style='font-weight:bold; '";
					}
					$_summeryHtml .= $_serviceItem_start."<span class='quote-total {$c}' {$_bold} >".$_lable_start.$value['desc'].$_lable_end.$_currvaluetext_start.number_format((float)$value['total'],2).$_valuetext_end."</span>".$_serviceItem_end;
				}
				
				}				
				return $_summeryContainer.$_summeryHtml.$_summeryContainer_end;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		
		public function GetQuoteSummeryFull(){
			try {
				$_quoteFSumFull = <<<EOD
				 <header class="panel-heading tab-bg-dark-navy-blue ">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#quote">Quote Summary</a>
                        </li>

                        <li class="">
                            <a data-toggle="tab" href="#contact">Contact Information</a>
                        </li>
                    </ul>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="quote" class="tab-pane active">
							{$this->GetQuoteSummery()}
                        </div>
                        <div id="contact" class="tab-pane">{$this->contactinfo->GetContactPreviwe($this->uniqueid,$this->contactinfo->uniqueid)}</div>
                    </div>
                </div>
                <br/>
               
                <span class="col-md-12 message text-center"><h5>Customer find us from {$this->marketingRef->description}</h5></span>       		
                
EOD;
				return $_quoteFSumFull;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		
		public function SaveQuote(){
			try {
		
				$_obj = Plugin_Utilities::extractDataToOjbect($this); //var_dump($_obj); exit;
				if ($_obj == null) {
					echo json_encode(array('error'=>'Unable to extract object data'));
					exit;
				}
		
		
				if (empty($this->uniqueid)) {
					$this->uniqueid = Plugin_Utilities::getUniqueKey(10);
					$this->__setDbData();
					$this->_save();
					exit;
				}
				else{
					$this->__setDbData();
					$this->_update();
					echo json_encode($this);
					exit;
				}
		
		
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		public function GetQuotes(){
			try {
				$obj_array = (array)$this->Get_Quotes(1);
				echo json_encode($obj_array);
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function Get_Quotes($_isActive = 0){
			try {
				$__result =  $this->_getResults($_isActive);
				$__quotes = new ArrayIterator();
				foreach ($__result as $value) {
					$__quote = new MMQuotes();					
					$__quote->_setQuoteData($value);
					$__quotes->append($__quote);
				}
				return $__quotes;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function GetQuote(){
			try {
				
				$this->_validateId();
				$value = $this->_getRow($this->uniqueid);
				$this->_setQuoteData($value);
				return $this;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		private function _setQuoteData($value){
			try {
				Plugin_Utilities::injectObjectData($value, $this);
				$this->startpricing = unserialize($value['startpricing']);
				$_hometype = new MMHomeTypes();
				$_hometype->uniqueid = $this->startpricing->hometype;
				$_hometype->_getItem();
				$this->startpricing->hometypetext = $_hometype->hometype;				
				$_sysset = new MMSystemSettings(); $_sysset->GetSystemSetting();		
				$this->WeeklyCost = $this->BiWeeklyCost = $this->MonthlyCost = (float)0;				
				$this->OTMOQuote = $this->FirstCleanQuote = (float)$this->totalprice;				
				$this->schedule = unserialize($value['schedule']); if($this->schedule != NULL) $this->schedule->applyData();				
				$this->frequency = unserialize($value['frequency']);
				$this->servicearea = unserialize($value['servicearea']);
				$this->sqfootage = unserialize($value['sqfootage']); if($this->sqfootage != NULL)$this->sqfootage->applyData();					
				$this->bedrooms = unserialize($value['bedrooms']);
				$this->bathrooms = unserialize($value['bathrooms']);
				$this->pets = unserialize($value['pets']);
				$this->addServices = unserialize($value['addServices']);
				$this->contactinfo = unserialize($value['contactinfo']); if($this->contactinfo != NULL)$this->contactinfo->applyData();				
				$this->marketingRef = unserialize($value['marketingRef']);
				$this->marketingRef->Howdidyoufindus = $this->marketingRef->description;				
				$this->hourlyrate = unserialize($value['hourlyrate']); if($this->hourlyrate != NULL)$this->hourlyrate->applyData();				
				$this->payment = unserialize($value['payment']);				
				$_frequency = new MMFrequencies();
				$_frequency->uniqueid = $this->startpricing->frequency;
				$_frequency->_getItem();
				$this->startpricing->frequencytext = $_frequency->frequency;
				
				/*setting field value according to the ID list values*/
				$this->TypeofCleanInterestedIn = $this->startpricing->frequencytext;
				
				if($_frequency->isRecurring == 1){
					$this->FrequencyDesired = $this->frequency->description;
					$this->TypeofCleanInterestedIn = 'Ongoing Maid Service';
					$this->CurrentQuoteType = 'Recurring Service'; // according to the IS Quote field Current Quote Type;
				}
				else{
					if(strpos($this->startpricing->frequencytext,'One Time') >= 0 ){
						$this->TypeofCleanInterestedIn = 'One Time Clean - Occupied Home';
						$this->CurrentQuoteType = 'One Time Clean'; // according to the IS Quote field Current Quote Type;
					}
					else if(strpos($this->startpricing->frequencytext,'Move') >= 0 ){
						$this->TypeofCleanInterestedIn = 'Move In or Out Clean';
						if(strpos($this->startpricing->frequencytext,'Move In') >= 0 ){
							$this->CurrentQuoteType = 'Move In Cleaning'; // according to the IS Quote field Current Quote Type;
						}
						if(strpos($this->startpricing->frequencytext,'Move Out') >= 0 ){
							$this->CurrentQuoteType = 'Move Out Cleaning'; // according to the IS Quote field Current Quote Type;
						}
					}
				}
				/*setting field value according to the ID list values*/
				
				if($this->isHourlyRate){
					$this->hourlyrate->FirstTimeCleanHours = $this->hourlyrate->OneTimeMoveOutCleanHours = (int)$this->hourlyrate->numberofhours;
					$this->CurrentQuoteType = 'By The Hour Cleaning'; // according to the IS Quote field Current Quote Type;
				}else if($_sysset->hourlyrate > 0){
					$_total = $this->firsttimeclean == null ?  $this->totalprice : $this->firsttimeclean;
					$this->hourlyrate->FirstTimeCleanHours = $this->hourlyrate->OneTimeMoveOutCleanHours = round((float)$_total / (float)$_sysset->hourlyrate,2);
				}
				
				$this->_makeViwable();//var_dump($this);
				
				$_commontext = 'Total for ';
				
				foreach ($this->__priceSuggesions as $key => $value) {
					if($value['desc'] == $_commontext.'Weekly'){ $this->WeeklyCost = (float)$value['total']; }
					if($value['desc'] == $_commontext.'Every 2 Weeks'){ $this->BiWeeklyCost = (float)$value['total']; }
					if($value['desc'] == $_commontext.'Every 4 Weeks'){ $this->MonthlyCost = (float)$value['total']; }
				}
				$this->quotecreatedate  = date('m-d-Y',strtotime($this->createdate));
				
				//var_dump($this);
				return $this;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				return false;
			}
		}
		
		
		public function CopyQuote(){
			try {
				$this->GetQuote();
				$obj = $this->_getItem();
				Plugin_Utilities::injectObjectData($obj, $this);
				$this->_copy();
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function DeleteQuote(){
			try {
				$this->_validateId();
				$obj = $this->_getItem();
				Plugin_Utilities::injectObjectData($obj, $this);
				$this->isDelete = "1";
				$this->__setDbData();
				$this->dbdata["isDelete"] = $this->isDelete;
				$this->_update();
				echo json_encode($this);
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		/* Front page ajax Functions */
		/* Quote Initialize */
		public function _initQuote(){
			try {
				if (isset($_POST['uniqueid'])) {
					$this->startpricing->uniqueid = $_POST['uniqueid'];
					$this->startpricing->_getStartPrice();
					
					$this->uniqueid = Plugin_Utilities::getUniqueKey(10);
					$this->isActive = 2;
					$this->__setDbData();
					$this->_save();
					echo json_encode($this);
					exit;
				}exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		/* Set quote Values */
		public function _setQuoteValues(){
			try {				
				if (isset($_POST['uniqueid']) && isset($_POST['propUniqueid']) && isset($_POST['propname'])) {					
					$this->GetQuote();
					$_propertyName = $_POST['propname'];
					
					$this->$_propertyName->uniqueid = $_POST['propUniqueid'];
					$this->$_propertyName->_getItem();						
					
					$this->__setDbData();					
					//var_dump($this);					
					$this->_update();
					/* Fix for the issue #37 */ 
					$this->GetQuote();
					if($this->schedule == null || $this->schedule->scheduleddate == '01-01-1970'){
						echo json_encode(array('error' => 'Invalid Date, Please pick a valid date first.','ctrlToValidate'=>'ctrlScheduale')); exit;
					}
					/* Fix for the issue #37 */
					echo json_encode($this);
				}exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function _setAddServiceChanges(){
			try {
				if (isset($_POST['uniqueid']) && isset($_POST['propUniqueid']) && isset($_POST['propname']) && isset($_POST['addremove'])) {
					$this->GetQuote();
					$_propertyName = $_POST['propname'];

					if($_POST['addremove'] == 1){
					$_addServices = new MMAdditionalServs();
					$_addServices->uniqueid = $_POST['propUniqueid'];
					$_addServices->_getItem();
					
					$this->addServices[$_addServices->uniqueid] = $_addServices;
					}
					else{
						if(is_array($this->$_propertyName))
							unset($this->addServices[$_POST['propUniqueid']]);
					}
						
					$this->__setDbData();
					//var_dump($this);
					$this->_update();
					echo json_encode($this);
				}exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		public function _setHourlyrateValues(){
			try {
				if (isset($_POST['uniqueid']) && isset($_POST['noofhours']) ){
					$this->GetQuote();
					$_sysset = new MMSystemSettings(); $_sysset->GetSystemSetting();
					$this->hourlyrate->hourlyrate = $_sysset->hourlyrate;
					$this->hourlyrate->numberofhours = $_POST['noofhours'];
					$this->totalprice = $this->hourlyrate->GetTotalCost();
					
					$this->__setDbData();
					//var_dump($this);
					$this->_update();
					echo json_encode($this);
				}exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		public function _getQuoteSummery(){
			try {
				if (isset($_POST['uniqueid'])) {
					$this->GetQuote();

					
					$sysset = new MMSystemSettings(); $sysset->GetSystemSetting();
					if($sysset->enablesysemail){ /* req#0001 */
					$_summery = $this->GetQuoteSummery(1);					
					$headers[] = "From: MaidQuote <".$sysset->fromemail.">";
					$headers[] = "Reply-to: Quote CC <".$sysset->confirmemail.">";
					$headers[] = "Cc: Quote CC <".$sysset->confirmemail.">";
					$headers[] = "Content-type: text/html" ;
					add_filter( 'wp_mail_content_type', 'set_html_content_type' );
					function set_html_content_type() {
						return 'text/html';
					}
					$__P = PHP_EOL.PHP_EOL.'<br/><div style="padding:1em;">'.$sysset->whowearemsg.PHP_EOL.'</div>';
					$_summeryemail = $_summery.$__P;					
					//	wp_mail( get_option( 'admin_email' ), 'Your Quote Summary - '.get_bloginfo('name'), $_summeryemail,$headers );
					wp_mail( $this->contactinfo->emailAddress, 'Your Quote Summary - '.get_bloginfo('name'), $_summeryemail,$headers );					
					remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
					} /* req#0001 */
					
					$_summery = $this->GetQuoteSummery();
					
					echo json_encode(array('quoteSummery'=>$_summery));
				}exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function _getQuoteSummeryFull(){
			try {
				if (isset($_POST['uniqueid'])) {
					$this->GetQuote();					
			  		$_summery = $this->GetQuoteSummeryFull();
					echo json_encode(array('quoteSummery'=>$_summery));
				}exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		/*
		 * Quote Save Ajax Function
		 * This is the initial step for the quote save.
		 * */
		public function _saveQuoteContacts(){
			try {
				if (isset($_POST['uniqueid']) && isset($_POST['data'])) {
					$this->GetQuote();
					$contactInfo  = new MMContacts();
					$_obj = Plugin_Utilities::extractDataToOjbect($contactInfo); //var_dump($_obj); exit;
					if ($_obj == null) {
						echo json_encode(array('error'=>'Unable to extract object data'));
						exit;
					}
					$contactInfo->SaveContact();
					$this->contactinfo = $contactInfo;

					$sysset =  new MMSystemSettings(); $sysset->GetSystemSetting();
					if($sysset->infusionsoftstatus == 1){
						$_InfusionsoftProxy = new MMInfusionsoftProxy();
						$_InfusionsoftProxy->createInfusionsoftContact($this,$sysset);
					}
						
					$this->isActive = 1 ;
					$this->__setDbData();
					//var_dump($this);
					$this->_update();
					echo json_encode($this);
				}exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		public function QuotePaymentSubmit(){
			try {
				if (isset($_POST['uniqueid']) && isset($_POST['data'])) {
					$this->GetQuote();
					$_payment = new MMPayments();
					$_obj = Plugin_Utilities::extractDataToOjbect($_payment->card);
					$_payment->currency = 'USD';
					$_payment->paymetDate = date('Y-m-d');
					$_payment->amount = $this->totalprice;
					$paymentresponse = $_payment->MakePayment($this->uniqueid);
					
					if($paymentresponse){
						if(!array_key_exists('error',$paymentresponse)){
						$sysset = new MMSystemSettings(); 
						$sysset->GetSystemSetting();
							
						$this->isLocked = true;	
						$this->contactinfo->stripeEmail = $_payment->card->billingemailAddress;
						$this->contactinfo->stripeCustId = $paymentresponse['customer_id'];
						
						$this->contactinfo->postAddress = $_payment->card->billingAddress;
						$this->contactinfo->postAddress1 = $_payment->card->billingAddress1;
						$this->contactinfo->city = $_payment->card->billingcity;
						$this->contactinfo->state = $_payment->card->billingstate;
						
						if($sysset->infusionsoftstatus == 1){							
							$ISProxy = new MMInfusionsoftProxy();
							if($ISProxy->addContactTags($sysset->infusionsoftclsec, $sysset->infusionsoftclid, $this->contactinfo->ISContact_id, $sysset->appointmentbookedtagid)){
								$this->contactinfo->ISContactGrps = json_encode(array($sysset->quotedisplayedtstagid,$sysset->appointmentbookedtagid));
							}
							$ISProxy->updateContact($this->contactinfo, $sysset);							
						}
						$this->contactinfo->__setDbData();
						$this->contactinfo->_save();
						if($sysset->enablesysemail == 1){
						$headers[] = "From: MaidQuote <".$sysset->fromemail.">";
						$headers[] = "Reply-to: Booking CC <".$sysset->supportemail.">";
						$headers[] = "Cc: Booking CC <".$sysset->supportemail.">";
						$headers[] = "Content-type: text/html" ;
						add_filter( 'wp_mail_content_type', 'set_html_content_type' );
						function set_html_content_type() {
							return 'text/html';
						}
						$__P = PHP_EOL.PHP_EOL.'<br/><div style="padding:1em;">'.$sysset->whowearemsg.PHP_EOL.'</div>';
						$_summeryemail = $sysset->msgSecondEmail.$__P;							
						//	wp_mail( get_option( 'admin_email' ), 'Your Quote Summary - '.get_bloginfo('name'), $_summeryemail,$headers );
						wp_mail( $this->contactinfo->emailAddress, 'Your cleaning is booked - '.get_bloginfo('name'), $_summeryemail,$headers );							
						remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
						}
						
						}
						else{
							echo json_encode(array('error' => $paymentresponse['error']));
							exit;
						}
					}					
					$this->payment = $_payment;
					
					$this->__setDbData();
					$this->_update();				
					 
					echo json_encode($this);
					
				}
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		/*
		 * 
		 * */
		/* Ajax Methods */
		public function _createISContactByContact(){
			try {
				$_obj = Plugin_Utilities::extractDataToOjbect($this); //var_dump($_obj); exit;
				if ($_obj == null) {
					echo json_encode(array('error'=>'Unable to extract object data'));
					exit;
				}
		
				$this->GetQuote();
				/* ob_start(); var_dump($this);
				$vardump = ob_get_clean();
				echo json_encode(array('error'=>$vardump)); */
				$_syssettings = new MMSystemSettings();  $_syssettings->GetSystemSetting();
				$mmisproxy = new MMInfusionsoftProxy();
				$ISContactId = $mmisproxy->createInfusionsoftContact($this, $_syssettings);
				if($this->isLocked){
					if($mmisproxy->addContactTags($_syssettings->infusionsoftclsec, $_syssettings->infusionsoftclid, $ISContactId, $_syssettings->appointmentbookedtagid)){
								$this->contactinfo->ISContactGrps = json_encode(array($_syssettings->quotedisplayedtstagid,$_syssettings->appointmentbookedtagid));
					}
					$mmisproxy->updateContact($this->contactinfo, $_syssettings);
				}
				//$this->contactinfo->__createISContact();
				echo json_encode(array('ISContact_id'=>$ISContactId));
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		/* Front page ajax Functions */
		
		
		/* 
		 * Front Quote View
		 * */
		
		public function _quoteView(){
			
			$__ftp = new MMFirstTimePricing();
			$_showquote = $__ftp->IsAllOptionSet() ;			
			if($_showquote){
			$_syssettings = new MMSystemSettings();  $_syssettings->GetSystemSetting(); 
			?>
			<div class="col-xs-12">
			<input type="hidden" id="uniqueid" value="" />
			<div id="layerProcessing">
			<div style="width:100%;text-align: center;">
			     <img width="100px"  src="<?php echo WPQP_PLUGIN_IMGDIR_URL;?>/gears2.gif" /></div> 
			</div>
			<div id="wizard" class="<?php echo self::$current_plugin_data['TextDomain']."-quote-view";?>">
				<h2>Home Type</h2>
				<section>
					<?php include 'views/view-plugin-hometypes.php';?>					
				</section>
				<h2>Type of Clean</h2>
				<section class="spfrequency">
					<!-- Type of clean Goes here -->
				</section>
				<h2>When and Where</h2>
				<section class="whenNwhere">					
					<?php include 'views/view-plugin-whenandwhere.php';?>
				</section>
				<h2>About your Home</h2>
				<section>
					<?php include 'views/view-plugin-aboutyourhome.php';?>	
				</section>
				<h2>Your Information</h2>
				<section>
					<?php include 'views/view-plugin-contactform.php';?>					 
				</section>
				<h2 class="display">Your Quote</h2>
				<section class="tab-quote-summery">
					<!-- Quote Summary Goes Here -->
					<?php include 'views/view-plugin-quotesummary.php';?>
				</section>				
				<?php if($_syssettings->stripeapistatus == 1){ ?>
				<h2 class="payments">Payments</h2>
				<section>
					<!-- Payme page Goes Here -->
					<?php include 'views/view-plugin-payments.php';?>					
				</section>				
				<?php } ?>
				
			</div>

		</div>
		
<?php }
		else{
			?>
			<div class="col-xs-12">
			<h3>Unable to genarate Quote Wizard.</h3>
			<p>Please map One-Time cleaning option price for each Recurring cleaning option.</p>
			</div>
			<?php 
		}
		}
		
		/*
		 * Genarate data to Export quotes
		 * */
		public function _QuoteExportData(){
			try {
				$_fieldList = array(
						'Reference No' => 'uniqueid',
						'Received' => 'createdate',
						'Building Type' => 'startpricing.hometypetext',
						'Type of Cleaning' => '_typeofclean',
						'Schedule Date' => 'schedule.availabledate',
						'ZipCode' => 'servicearea.zipcode',
						'Beginning Price' => 'startpricing.price',
						'Preferred Date fee' => '_pdf',
						'Recurring Schedule' => 'frequency.description',
						'RS Cost' => 'frequency.price',
						'Square Footage' => 'sqfootage.description',
						'Sqf Cost' => 'sqfootage.price',
						'Bedroom(s)' => 'bedrooms.brcount',
						'Cost for bedroom(s)' => 'bedrooms.price',
						'Bathroom(s)' => 'bathrooms.bathrcount',
						'Cost for bathroom(s)' => 'bathrooms.price',
						'Pets' => 'pets.description',
						'Cost for pets' => 'pets.price',
						'Extra Services' => '_extraserv',
						'Costs for extra services' => '_extraservcost',
						'First Time Clean' => 'firsttimeclean',
						'Hourly Rate' => 'hourlyrate.hourlyrate',
						'No. of Hours' => 'hourlyrate.numberofhours',
						'Quote Amount' => '_totalpriceStr',
						'Paid' => 'isLocked',
						'Customer Name' => 'contactinfo.firstName',
						'Customer Phone' => 'contactinfo.phoneNumber',
						'Customer Email' => 'contactinfo.emailAddress',
						'Customer Stripe URL' => 'contactinfo._stripeurl',
				);
				$obj_array = (array)$this->Get_Quotes(1);
				$__quotes = new ArrayIterator();
				
				foreach ($obj_array as $value) {
					if($value->contactinfo != null){$value->contactinfo->_setStripeURL();}
					$_record = array();
					foreach ($_fieldList as $fieldkey => $field) {
							if(strpos($field, ".")){
								$__parent = null;
								foreach (explode(".", $field) as $key) {
									if($__parent == null)
										if($value->$key != null)
											$__parent = $value->$key;
										else
										{ $__parent = null; break; } 
									else
										if($__parent->$key != null)
											$__parent = $__parent->$key;
										else
										{ $__parent = null; break; } 
									
								}								
								$_record[$fieldkey] = $__parent;
							}
							else
							{
								$_record[$fieldkey] = $value->$field;
							}
							$_record[$fieldkey] = $_record[$fieldkey] == null ? '' : $_record[$fieldkey];
					}
					$__quotes->append($_record);
				}
				echo json_encode((array)$__quotes);
				exit;								
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
	}
}