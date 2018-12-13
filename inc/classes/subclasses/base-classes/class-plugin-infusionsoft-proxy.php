<?php 
require_once ABSPATH . '/wp-includes/class-IXR.php';
require_once ABSPATH . '/wp-includes/class-wp-http-ixr-client.php';

if (!class_exists('MMInfusionsoftProxy')) {
	class MMInfusionsoftProxy extends MMQuoteBase{
		public $accessToken;
		public $cid ;
		public $subdomain;
		public $apiUrl = 'https://api.infusionsoft.com/api/xmlrpc/';
		public $authUrl ;
		public function __construct(){
			
		}
		/* Implement MMQuoteBase abstract Members - ends */
		public function __init(){
		}
		public function __setDbData(){
		}
		/* Implement MMQuoteBase abstract Members - ends */

		/**
		 * Public function to create infutionsoft contact
		 * @param MMQuote $quote
		 * @parm MMSystemSettings $_sysset
		 */
		public function createInfusionsoftContact($quote,$_sysset){
			try {
				$quote->applyData();
				$contact = $quote->contactinfo;
				$_contact =$this->genarateFieldsArray($quote,$_sysset);
				$arguments = array($_contact,'Email');				
				$method = 'ContactService.addWithDupCheck' ;			
				
				
				//return 'test';
				//var_dump($arguments); return 'test';
				
				if($id = $this->_callInfusionSoft($_sysset->infusionsoftclsec, $_sysset->infusionsoftclid, $method, $arguments)){
					if($quote->contactinfo->isOptIn == 1)
					if(!$this->_callInfusionSoft($_sysset->infusionsoftclsec, $_sysset->infusionsoftclid, 'APIEmailService.optIn', array($contact->emailAddress,'First display of cleaning quote.'))){
						$errorlogger = new ErrorLogger();
						$errorlogger->add_message('Email opt-in fail for contact id - '.$contact->id);
					}
					else{
						$contact->ISMarketable = 1;
					}
					$contact->ISContact_id = $id;
					$contact->hasIsAccount = 1 ;
					if(!empty($_sysset->quotedisplayedtstagid) && is_array($_sysset->quotedisplayedtstagid) && ( array_key_exists($quote->startpricing->frequency, $_sysset->quotedisplayedtstagid) || ($quote->isHourlyRate &&  array_key_exists('hourly', $_sysset->quotedisplayedtstagid)))){
						if($quote->isHourlyRate && $this->addContactTags($_sysset->infusionsoftclsec, $_sysset->infusionsoftclid, $contact->ISContact_id,$_sysset->quotedisplayedtstagid['hourly'])){
							$contact->ISContactGrps = json_encode(array($_sysset->quotedisplayedtstagid['hourly']));
						}						
						else if($this->addContactTags($_sysset->infusionsoftclsec, $_sysset->infusionsoftclid, $contact->ISContact_id,$_sysset->quotedisplayedtstagid[$quote->startpricing->frequency]))
						{
							$contact->ISContactGrps = json_encode(array($_sysset->quotedisplayedtstagid[$quote->startpricing->frequency]));
						} 
					} // else{echo "Can't get in"; var_dump(array('quotedisplayedtstagid' => $_sysset->quotedisplayedtstagid,'is_empty' => empty($_sysset->quotedisplayedtstagid),'is_array' => is_array($_sysset->quotedisplayedtstagid),'array_key_exist' => array_key_exists($quote->startpricing->frequency, $_sysset->quotedisplayedtstagid),'_key' => $quote->startpricing->frequency  ));}
					$contact->__setDbData();
					$contact->_update();
				}
			return $contact->ISContact_id;
			
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		/*
		 * Public function to make IS contact marketable
		 * */
		public function makeISContactMarketable($contact,$reason,$_sysset){			
			if(!$this->_callInfusionSoft($_sysset->infusionsoftclsec, $_sysset->infusionsoftclid, 'APIEmailService.optIn', array($contact->emailAddress,$reason))){
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message('Email opt-in fail for contact id - '.$contact->id);
				return false;
			}
			
			return true;
		}

		/*
		 * Public function to add tags to infusionsoft contact
		 * @param Infusionsoft PrivateKey $privatekey
		 * @param Infusionsoft Client Id $clientid
		 * @param Infusionsoft Contact ID $iscontactid
		 * @param Infusionsoft Tag Id $tagid
		 * */
		public function addContactTags($privatekey,$clientid,$iscontactid,$tagid){
			try {
				$method = 'ContactService.addToGroup';
				$arguments = array(intval($iscontactid),intval($tagid));
				return $this->_callInfusionSoft($privatekey, $clientid, $method, $arguments);
								
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				return false;
			}
		}
		
		/*
		 * Public function to update infusionsoft contact
		 * @param MMContacts $contact
		 * @param MMSystemSettingss $sysset
		 * */
		public function updateContact($contact,$sysset){
			try {
				 $quote = new MMQuotes(); $quote->contactinfo = $contact;
				/* $sysset = new MMSystemSettings();
				$contact = new MMContacts(); */
				
				/*$_contact = array(
						"FirstName"		=> $contact->firstName,
						"LastName" 		=> $contact->lastName,
						"Email" 		=> $contact->emailAddress,
						"StreetAddress1" 	=> $contact->postAddress,
						"StreetAddress2" => $contact->postAddress1,
						"City"		 	=> $contact->city,
						"State"		 	=> $contact->state);*/
				 $this->genarateFieldsArray($quote, $sysset,array('MMContacts'));
				
				$method = 'ContactService.update';
				$arguments = array($contact->ISContact_id,  $_contact);
				
				return $this->_callInfusionSoft($sysset->infusionsoftclsec, $sysset->infusionsoftclid, $method, $arguments);
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				return false;
			}
		}
		
		
		/*
		 * Private function to communicate with the infusionsoft
		 * @param Infusionsoft PrivateKey $privatekey
		 * @param Infusionsoft Client Id $clientid
		 * @param Infusionsoft MethodName $method
		 * @param Arguments $arguments
		 * */
		private function _callInfusionSoft($privatekey,$clientid,$method,$args,$retry = 3){
			try {
								
				$arguments = array_merge( array( $method, $privatekey ), $args );				
				// Initialize the client
				$client = new WP_HTTP_IXR_Client( 'https://' . $clientid . '.infusionsoft.com/api/xmlrpc' );				
				// Call the function and return any error that happens
				if ( ! call_user_func_array( array( $client, 'query' ), $arguments ) ) {
					$errorlogger = new ErrorLogger();
					$errorlogger->add_message($client->getErrorCode() .' - '. $client->getErrorMessage() .PHP_EOL.'Method - '.$method); //.PHP_EOL.'Args - '. Plugin_Utilities::custom_var_dump($args));
					//echo $client->getErrorMessage();
					
					if($retry > 0){
						$errorlogger->add_message('Retrying ...'.(4 - $retry)); $retry = $retry - 1;
						return $this->_callInfusionSoft($privatekey, $clientid, $method, $args,$retry);
					}
					
					return;// new WP_Error( 'invalid-request', $client->getErrorMessage() );
				}
				// Pass the response directly to the user
				$return =  $client->getResponse(); //var_dump($return);
				return $return;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				return false;
			}
		}
		
		/**
		 * @param Infusionsoft $infusionsoft
		 * @param MMContacts $contact
		 */
		private function addWithDupCheck($infusionsoft,$contact) {
			//$contact = array('FirstName' => $contact->firstName, 'LastName' => $contact->lastName, 'Email' => $contact->emailAddress);

			/*$contact = array(
					"FirstName"		=> $contact->firstName,
					"LastName" 		=> $contact->lastName,
					"Email" 		=> $contact->emailAddress,
					"StreetAddress1" 	=> $contact->postAddress .','.$contact->postAddress1,
					"City"		 	=> $contact->city,
					"State"		 	=> $contact->state,
					"PostalCode" 		=> $contact->zipcode,
			);*/
			$sysset = new MMSystemSettings(); $sysset->GetSystemSetting();
			$quote = new MMQuotes(); $quote->contactinfo = $contact;
			$this->genarateFieldsArray($quote, $sysset,array('MMContacts'));
			return $infusionsoft->contacts->addWithDupCheck($contact, 'Email');
		}
		
		/*
		 * Function to genarate array by using mapped fields
		 * @param MMQuote $quote
		 * @parm MMSystemSettings $_sysset 
		 */
		public function genarateFieldsArray($quote,$_sysset,$filterclass = array()){
			try {
				/*$quote = new MMQuotes();
				$_sysset = new MMSystemSettings();*/
				$fieldArray = array();
				foreach ($_sysset->mqisfields as $key => $value) {
					if(count($filterclass) > 0 && !in_array($key, $filterclass)) continue;
					foreach ($value as $key2 => $value2) {
						switch ($key) {
							case 'MMQuotes':
								{
									$fieldArray[$value2] = $quote->$key2;
								}
							break;
							case 'MMContacts':
								{
									$fieldArray[$value2] = $quote->contactinfo->$key2;
								}
							break;
							case 'MMAMarketing':
								{
									$fieldArray[$value2] = $quote->marketingRef->$key2;
								}
							break;
							case 'MMSqFootagePricing':
								{
									$fieldArray[$value2] = $quote->sqfootage->$key2;
								}
							break;
							case 'MMHourlyRates':
								{
									$fieldArray[$value2] = $quote->hourlyrate->$key2;
								}
							break;
							case 'MMAvailableDates':
								{
									if ($key2 == 'scheduleddate') {
									global $infusionsoft;
									$isApp = $infusionsoft->getConnection();
									$correctedkeydate = str_replace('-', '/', $quote->schedule->$key2);
									$infuDate = $isApp->infuDate($correctedkeydate);
									$fieldArray[$value2] = $infuDate; 
									
									}
									else{
										$fieldArray[$value2] = $quote->schedule->$key2;
									}
								}
							break;
							case 'MMBedroomPricing':
								{
									$fieldArray[$value2] = (float)$quote->bedrooms->$key2;
								}
							break;
							case 'MMBathroomPricing':
								{
									$fieldArray[$value2] = (float)$quote->bathrooms->$key2;
								}
							break;
							case 'MMPetPricing':
								{
									$fieldArray[$value2] = $quote->pets->$key2;
								}
							break;
							default: break;
						}
					}
				}
				return $fieldArray;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				return false;
			}
		}
		
		function get_contact_fields() {
			global $infusionsoft;
		
			$contactFields = array(
					'Address1Type', 'Address2Street1', 'Address2Street2', 'Address2Type', 'Address3Street1', 'Address3Street2', 'Address3Type',
					'AssistantName', 'AssistantPhone', 'BillingInformation', 'City', 'City2', 'City3', 'Company', 'ContactNotes',
					'ContactType', 'Country', 'Country2', 'Country3', 'Email', 'EmailAddress2', 'EmailAddress3', 'Fax1', 'Fax1Type',
					'Fax2', 'Fax2Type', 'FirstName', 'Groups', 'JobTitle', 'LastName', 'Leadsource', 'MiddleName', 'Nickname', 'Password',
					'Phone1', 'Phone1Ext', 'Phone1Type', 'Phone2', 'Phone2Ext', 'Phone2Type', 'Phone3', 'Phone3Ext', 'Phone3Type',
					'Phone4', 'Phone4Ext', 'Phone4Type', 'Phone5', 'Phone5Ext', 'Phone5Type', 'PostalCode', 'PostalCode2', 'PostalCode3',
					'ReferralCode', 'SpouseName', 'State', 'State2', 'State3', 'StreetAddress1', 'StreetAddress2', 'Suffix', 'Title',
					'Username', 'Validated', 'Website', 'ZipFour1', 'ZipFour2', 'ZipFour3',
			);
			$contactFields = array_combine($contactFields, $contactFields);
		
			if($infusionsoft!=null):
		
			$isApp = $infusionsoft->getConnection();
			if ($isApp) { 
				$validTypes = array('15'=>'Text', '16'=>'Text Area');
				$customFields = $isApp->dsQuery("DataFormField", 500, 0, array('Name'=>'%'), array('Name', 'Label', 'DataType'));
				if (isset($customFields[0]['Name'])) {
					foreach ($customFields as $field) {
						//if (isset($validTypes[$field['DataType']])) {
							$contactFields['_'.$field['Name']] = $field['Label'];
						//}
					}
				}
			}
			asort($contactFields);
			endif;
			return $contactFields;
		}
		
		function get_field_selector($name, $match) {
			$fields = $this->get_contact_fields();
			$html  = '<select name="'.$name.'" id="'.$name.'" class="form-control">';
			$selected = $match == '' ? 'selected="selected"' : '';
			$html .= '<option value="" '.$selected.'>-- none --</option>';
			foreach ($fields as $field=>$label) {
				$selected = $match == $field ? 'selected="selected"' : '';
				$html .= '<option value="'.$field.'" '.$selected.'>'.$label.'</option>';
			}
			$html .= '</select>'.PHP_EOL;
		
			return $html;
		}

		/* Ajax Function */
		/**
		 * @param Action _iscallback
		 * */
		public function _infusionsoftcallback_(){
			try {
				$_response = array('_post'=>$_POST,'_get' => $_GET); var_dump($_response);
				self::__call('_updateInfusionSoftCb',$_response);
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
	
	}
}