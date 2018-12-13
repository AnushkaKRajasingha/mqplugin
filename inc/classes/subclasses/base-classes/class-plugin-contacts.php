<?php
/**
 * @author Anushka Rajasingha
 * @url http://www.anushkar.com
 * @date 02/26/2015
 * @var MMContacts
 * @uses Contact Information
 *
 */
if (!class_exists('MMContacts')) {
	class MMContacts extends MMQuoteBase{
		use MMDbBase;
		/**
		 * First Name in Contact Information
		 * @name First Name
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $firstName;
		/**
		 * Last Name in Contact Information
		 * @name Last Name
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $lastName;
		/**
		 * Email Address in Contact Information
		 * @name Email Address
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $emailAddress;
		/**
		 * Phone Number in Contact Information
		 * @name Phone Number
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $phoneNumber;
		/**
		 * Mobile Number in Contact Information
		 * @name Mobile Number
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $mobileNumber;
		/**
		 * Address Line 1
		 * @name Street Address 1
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $postAddress;
		/**
		 * Address Line 2
		 * @name Street Address 2
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $postAddress1;
		/**
		 * City
		 * @name City
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $city;
		/**
		 * State
		 * @name State
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $state;
		/**
		 * ZipCode
		 * @name ZipCode
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $zipcode;
		public $stripeEmail;
		public $stripeCustId;
		
		
		public $hasGRAccount = 0;
		public $grContact_id = null;
		
		public $hasIsAccount = 0; //req#0002 related
		public $ISContact_id = null; //req#0002 related
		public $ISContactGrps = ''; //req#0002 related
		public $ISMarketable; // related bugid#0002
		public $isOptIn ; // req#0005
		
		
		
		public $_stripeurl ;
		private $_iscontacturl = 'https://ll255.infusionsoft.com/Contact/manageContact.jsp?view=edit&ID=';
		
		public function __construct(){$this->__init();}
		
		public function applyData(){
			try {
				$this->phoneNumber = $this->phoneNumber == NULL ? 'N/A' : $this->phoneNumber;
				 $this->mobileNumber = $this->mobileNumber  == NULL ? 'N/A' : $this->mobileNumber;
				$this->postAddress = $this->postAddress == NULL ? 'N/A' : $this->postAddress;
				$this->postAddress1 = $this->postAddress1  == NULL ? 'N/A' : $this->postAddress1;
				$this->city =  $this->city == NULL ? 'N/A' : $this->city ;
				$this->state = $this->state == NULL ? 'N/A' : $this->state;
				$this->description = $this->description == NULL ? 'N/A' : $this->description;
				$sysset =  new MMSystemSettings();
				if($sysset->GetSystemSetting() != null){
					$this->_iscontacturl = "https://{$sysset->infusionsoftclid}.infusionsoft.com/Contact/manageContact.jsp?view=edit&ID=";
				}
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
			}
		}
		
		/* Implement MMQuoteBase abstract Members  */
		public function __init(){
			try {
				$this->_setTablename('_contacts');	
				$this->_setStripeURL();							
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		public function __setDbData(){
			try {
				$this->dbdata = array(
						'uniqueid' => $this->uniqueid,
						'firstName' => $this->firstName,
						'lastName' => $this->lastName,
						'emailAddress' => $this->emailAddress,
						'phoneNumber' => $this->phoneNumber == NULL ? 'N/A' : $this->phoneNumber,
						'mobileNumber' => $this->mobileNumber,
						'postAddress' => $this->postAddress == NULL ? 'N/A' : $this->postAddress,
						'postAddress1' => $this->postAddress1  == NULL ? 'N/A' : $this->postAddress1,
						'city' => $this->city == NULL ? 'N/A' : $this->city ,
						'state' => $this->state == NULL ? 'N/A' : $this->state,
						'zipcode' => $this->zipcode,
						'hasGRAccount' => $this->hasGRAccount,
						'grContact_id' => $this->grContact_id,
						'stripeEmail' => $this->stripeEmail,
						'stripeCustId' => $this->stripeCustId,
						'hasIsAccount' => $this->hasIsAccount,
						'ISContact_id' => $this->ISContact_id,
						'ISContactGrps' => $this->ISContactGrps,
						'ISMarketable' => $this->ISMarketable,
						'isOptIn' => $this->isOptIn // req#0006
						);
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		/* Implement MMQuoteBase abstract Members  */
		
		/* MMContacts members Starts */
		
		public function _setStripeURL(){
			if (self::$current_plugin_data['Environment'] == 'Dev') {
				$this->_stripeurl = 'https://dashboard.stripe.com/test/customers/';
			}
			else{
				$this->_stripeurl = 'https://dashboard.stripe.com/customers/';
			}
		}
		
		public function SaveContact(){
			try {
		
				$_obj = Plugin_Utilities::extractDataToOjbect($this); //var_dump($_obj); exit;
				if ($_obj == null) {
					echo json_encode(array('error'=>'Unable to extract object data'));
					exit;
				}		
		
				if (empty($this->uniqueid)) {
					$this->uniqueid = Plugin_Utilities::getUniqueKey(10);
					$sysset =  new MMSystemSettings(); $sysset->GetSystemSetting();
					if($sysset->greenropeapistatus == 1){
						$gr_proxy = new MMGRProxy();
						$gr_proxy->__init();					
						$this->grContact_id = $gr_proxy->AddContact($this);
					}
					$this->__setDbData();
					$this->_save();
				}
				else{
					$this->__setDbData();
					$this->_update();
					echo json_encode($this);
				}
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function GetContactPreviwe($quoteid = '',$contactid = ''){
			if(!empty($contactid)){
				$result = $this->_getRow($contactid);
				Plugin_Utilities::injectObjectData($result, $this);
				$this->_setStripeURL();
			}
			$_Container = "<div class='quote-contact {$this->firstName}'>";
			$_Container_end = "</div>";
			$_Title = "<h3>Customer Contact</h3>";
			$_serviceItem_start = "<div class='service-item'>"; $_serviceItem_end = "</div>";
			$_serviceItemSub_start = "<div class='service-item-sub'>"; $_serviceItemSub_end = "</div>";
			$_lable_start = "<span class='lable-text'>"; $_lable_end = "</span>";
			$_valuetext_start = "<span class='value-text'>"; $_valuetext_end = "</span>";
			$sripecustlink = '';
			if(!empty($this->stripeCustId)){
				$sripecustlink = $_serviceItem_start.$_lable_start.'Stripe Customer'.$_lable_end.$_valuetext_start.'<a href="'.$this->_stripeurl.$this->stripeCustId.'" target="_blank" >'.$this->stripeCustId.'</a>'.$_valuetext_end.$_serviceItem_end;
			}
			$islink = '';
			ob_start();
			var_dump($this->hasIsAccount);
			$vardump = ob_get_clean();
			$islink = $vardump;
			if($this->hasIsAccount == 1){
				$ismarketablelink = '';
				if(!($this->ISMarketable == 1)){
					$ismarketablelink = '<a href="#" onclick="makeISMarketable(this)" data-contactID="'.$this->id.'" data-uniqueid="'.$this->uniqueid.'" data-contactuniqueid="'.$quoteid.'" class="btn btn-primary col-sm-offset-1">Make Marketable</a>';
				}
				//$this->_iscontacturl = 'https://ll255.infusionsoft.com/Contact/manageContact.jsp?ID=';
				$islink = $_serviceItem_start.$_lable_start.'Infusion Contact ID'.$_lable_end.$_valuetext_start.'<a href="'.$this->_iscontacturl.$this->ISContact_id.'" target="_blank" >'.$this->ISContact_id.'</a>'.$ismarketablelink.$_valuetext_end.$_serviceItem_end;
			}
			else{
				$islink = $_serviceItem_start.$_lable_start.'No Infusionsoft Contact'.$_lable_end.$_valuetext_start.'<a href="#" onclick="createISContact(this)" data-contactID="'.$this->id.'" data-contactuniqueid="'.$this->uniqueid.'" data-uniqueid="'.$quoteid.'" class="btn btn-primary">Create Contact</a>'.$_valuetext_end.$_serviceItem_end;
			}
			
			$_view = <<<EOD
			{$_Container}{$_Title}
			{$_serviceItem_start}{$_lable_start}First Name {$_lable_end} {$_valuetext_start}{$this->firstName}{$_valuetext_end}{$_serviceItem_end}
			{$_serviceItem_start}{$_lable_start}Last Name {$_lable_end} {$_valuetext_start}{$this->lastName}{$_valuetext_end}{$_serviceItem_end}
			{$_serviceItem_start}{$_lable_start}Email Address {$_lable_end} {$_valuetext_start}{$this->emailAddress}{$_valuetext_end}{$_serviceItem_end}
			{$_serviceItem_start}{$_lable_start}Phone Number {$_lable_end} {$_valuetext_start}{$this->phoneNumber}{$_valuetext_end}{$_serviceItem_end}
			{$_serviceItem_start}{$_lable_start}Mobile Number {$_lable_end} {$_valuetext_start}{$this->mobileNumber}{$_valuetext_end}{$_serviceItem_end}
			{$_serviceItem_start}{$_lable_start}Street Address {$_lable_end} {$_valuetext_start}{$this->postAddress}{$_valuetext_end}{$_serviceItem_end}
			{$_serviceItem_start}{$_lable_start}{$_lable_end} {$_valuetext_start}{$this->postAddress1}{$_valuetext_end}{$_serviceItem_end}
			{$_serviceItem_start}{$_lable_start}City{$_lable_end} {$_valuetext_start}{$this->city}{$_valuetext_end}{$_serviceItem_end}
			{$_serviceItem_start}{$_lable_start}State{$_lable_end} {$_valuetext_start}{$this->state}{$_valuetext_end}{$_serviceItem_end}
			{$_serviceItem_start}{$_lable_start}ZipCode{$_lable_end} {$_valuetext_start}{$this->zipcode}{$_valuetext_end}{$_serviceItem_end}
			{$sripecustlink}
			{$islink}
			{$_Container_end}
EOD;
return $_view;
		}
		
		/*public function _setStripeURL(){
			$this->_stripeurl .= $this->stripeCustId;
		}*/
		
		public function __createISContact(){
			try {
				$mmisproxy = new MMInfusionsoftProxy();
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
			}
		}		
		
				
		/* MMContacts members Starts */
		
		/*
		 * Public ajax method to make IS contact marketable 
		 * */
		public function _makeISContactMarketable(){
			try {
				$_obj = Plugin_Utilities::extractDataToOjbect($this); //var_dump($_obj); exit;
				if ($_obj == null) {
					echo json_encode(array('error'=>'Unable to extract object data'));
					exit;
				}
				$result = $this->_getRow($this->uniqueid);
				Plugin_Utilities::injectObjectData($result, $this);
				$_syssettings = new MMSystemSettings();  $_syssettings->GetSystemSetting();
				$mmisproxy = new MMInfusionsoftProxy();
				if($mmisproxy->makeISContactMarketable($this,'Manually make marketable', $_syssettings)){
					$this->ISMarketable = 1;
					$this->__setDbData();
					$this->_update();
					echo json_encode(array('msg'=>'success'));
				}
				else{
					echo json_encode(array('error'=>'Make marketable fail. <br/>Reason :<br/>May be this email already marked as marketable. or<br/>Opt-out by system admin.'));
				}				
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
	}	
}