<?php
if (interface_exists('IMMPriceBase') && !class_exists('MMSystemSettings')) {
	class MMSystemSettings extends MMQuoteBase{
		use MMDbBase;	

		public $hourlyrate;
		public $maxsqft;
		public $enablehourlyrate;
		
		public $stripeapistatus;
		public $apistripekey;
		public $apistripevalue;
		public $apistripetestkey;
		public $apistripetestvalue;
		public $stripeapitype;
		public $stripeapicharge;
		
		public $greenropeapistatus;
		public $apigreenropekey;
		public $apigreenropevalue;
		public $apigreenropeug;
		
		public $paypalstatus;
		public $apipaypalkey;
		public $paypalsbstatus;
		
		public $fromemail;
		public $confirmemail; // changed to Quote CC
		public $supportemail; // changed to Booking CC
		public $supportphone;
		/* modification ref req#0001 */
		public $enablesysemail;
		/* modification ref req#0001 - ends */
		
		public $custompmtmsg;
		public $whowearemsg;
		public $termandcondmsg;
		public $thankyounotemsg;
		public $msgSecondEmail;
		public $dateautoupdate;
		public $customstyle;
		public $infusionsoftstatus;
		public $infusionsoftclid;
		public $infusionsoftclsec;
		public $quotedisplayedtstagid; //req#0002
		public $appointmentbookedtagid; // req#0002 
		public $isDefOptIn; // req#0005
		public $FTCExplanation; //req#0009
		public $gasettings; //req#0008
		public $mqisfields; //issue #47
		
		public $instexttab3;
		public $instexttab4;
		public $instexttab5;
		public $instexttab6;
		
		
		
		public function __construct(){ $this->__init();}
		
		/* Implement MMQuoteBase abstract Members  */ 		
		public function __init(){
			try {
				$this->_setTablename('_syssettingss');
				$this->quotedisplayedtstagid = Array();
				$this->isDefOptIn = 1;
				$this->gasettings = new MMGoogleAnalytics(); //req#0008
				$this->mqisfields = Array();
				$this->stripeapitype = 0;
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
					'hourlyrate' => $this->hourlyrate,
					'maxsqft' => $this->maxsqft,
					'enablehourlyrate' => $this->enablehourlyrate,
					'stripeapistatus' => $this->stripeapistatus,
					'apistripekey' => $this->apistripekey,
					'apistripevalue' => $this->apistripevalue,
					'greenropeapistatus' => $this->greenropeapistatus,
					'apigreenropekey' => $this->apigreenropekey,
					'apigreenropevalue' => $this->apigreenropevalue,
					'paypalstatus' => $this->paypalstatus,
					'apipaypalkey' => $this->apipaypalkey,
					'paypalsbstatus' => $this->paypalsbstatus,
					'fromemail' => $this->fromemail,
					'confirmemail' => $this->confirmemail,
					'supportemail' => $this->supportemail,
					'supportphone' => $this->supportphone,
					'custompmtmsg' => $this->custompmtmsg,
					'whowearemsg' => $this->whowearemsg,
					'termandcondmsg' => $this->termandcondmsg,
					'thankyounotemsg' => $this->thankyounotemsg,
					'apigreenropeug' => $this->apigreenropeug,
					'msgSecondEmail' => $this->msgSecondEmail,
					'dateautoupdate' => $this->dateautoupdate,
					'customstyle' => $this->customstyle,
					'infusionsoftstatus' => $this->infusionsoftstatus,
					'infusionsoftclid' => $this->infusionsoftclid,
					'infusionsoftclsec' =>$this->infusionsoftclsec,
					'enablesysemail' => $this->enablesysemail,
					'quotedisplayedtstagid' => maybe_serialize($this->quotedisplayedtstagid), //req#0002
					'appointmentbookedtagid' => $this->appointmentbookedtagid, // req#0002
					'isDefOptIn' => $this->isDefOptIn, // req#0006
					'FTCExplanation' => $this->FTCExplanation, //req#0009
					'gasettings' => maybe_serialize($this->gasettings), //req#0008
					'mqisfields' => maybe_serialize($this->mqisfields), //req#0008
					'stripeapitype' => $this->stripeapitype, // issue #11
					'apistripetestkey' => $this->apistripetestkey,// issue #11
					'apistripetestvalue' => $this->apistripetestvalue,// issue #11
					'stripeapicharge' =>$this->stripeapicharge, // issue #17
					'instexttab3' => $this->instexttab3, // issue #26
					'instexttab4' => $this->instexttab4,// issue #26
					'instexttab5' => $this->instexttab5,// issue #26
					'instexttab6' => $this->instexttab6// issue #26
			);
		}
		public function SaveSystemSettings(){
			try {
				
				$_obj = Plugin_Utilities::extractDataToOjbect($this); //var_dump($_obj); exit;
				if ($_obj == null) {
					echo json_encode(array('error'=>'Unable to extract object data'));
					exit;
				}			
				
				
				if (empty($this->uniqueid)) {
					$this->_deleteAll();
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
		
		public function SaveAPISettings(){
			try {
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function GetSystemSetting(){
			try {
				$__result =  $this->_getRow();
				if($__result == null){
					//echo json_encode(array('error'=>'Unable to extract object data'));
					//exit;
					return null;
				}
				//var_dump($__result);
				Plugin_Utilities::injectObjectData($__result, $this); 
				$this->quotedisplayedtstagid = unserialize($__result['quotedisplayedtstagid']);		
				if(array_key_exists('gasettings',$__result))
					$this->gasettings = unserialize($__result['gasettings']);
				if(array_key_exists('mqisfields',$__result))
					$this->mqisfields = unserialize($__result['mqisfields']);
				//var_dump($this);
				return $this;
				//echo json_encode($this);
				//exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function GetSystemSettings(){
			try {
				$__result =  $this->_getResults(); // var_dump($__result); exit;
				$__systemsettings = new ArrayIterator();
				foreach ($__result as $value) {
					$__systemsetting = new MMSystemSettings();
					Plugin_Utilities::injectObjectData($value, $__systemsetting);
					$__systemsettings->append($__systemsetting);
				}
				$obj_array = (array) $__systemsettings;
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function CopySystemSettings(){
			try {
				$this->_validateId();
				$obj = $this->_getItem();
				Plugin_Utilities::injectObjectData($obj, $this);
				$this->description = 'Copy of '.$this->dayofweek;				
				$this->_copy();
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function DeleteSystemSettings(){
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
		
		
		/* MMStartPricing Members */
	}
}