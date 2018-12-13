<?php
if (!class_exists('MMGRProxy')) {
	class MMGRProxy extends MMQuoteBase{
		private $API_UserName;
		private $API_Password;
		private $API_XML;
		private $nvpreq;
		private $API_Token;
		private $UserGroup;
		
		public function __construct(){}
		
		/* Implement MMQuoteBase abstract Members - starts */
		public function __init(){
			try {

				$_sysSet = new MMSystemSettings();
				$_sysSet->GetSystemSetting();
				
				$this->API_UserName = urlencode($_sysSet->apigreenropekey);
				$this->API_Password = urlencode($_sysSet->apigreenropevalue);
				$this->UserGroup = empty($_sysSet->apigreenropeug) ? 'Online Quote' : '$_sysSet->apigreenropeug';
				
				$this->API_XML = urlencode("<GetAuthTokenRequest>\n</GetAuthTokenRequest>\n");
				
				// NVPRequest for submitting to server
				$this->nvpreq = "email=$this->API_UserName&password=$this->API_Password&xml=$this->API_XML";
				
				// echo "Request was $this->nvpreq\n\n";
				
				$httpResponse = $this->Send_CE_XML_Request($this->nvpreq);
				
				// echo "Response was $httpResponse\n\n";
				
				$my_reader = new XMLReader();
				$my_reader->xml($httpResponse);
				
				$xml_result = "";
				$xml_token = "";
				$xml_errorcode = "";
				$xml_errormsg = "";
				
				while ($my_reader->read())
				{
					switch ($my_reader->nodeType)
					{
						case XMLReader::ELEMENT:
							if ($my_reader->name == "Result")
							{
								$my_reader->read();
								$xml_result = $my_reader->value;
							}
							else if ($my_reader->name == "Token")
							{
								$my_reader->read();
								$xml_token = $my_reader->value;
							}
							else if ($my_reader->name == "ErrorCode")
							{
								$my_reader->read();
								$xml_errorcode = $my_reader->value;
							}
							else if ($my_reader->name == "ErrorText")
							{
								$my_reader->read();
								$xml_errormsg = $my_reader->value;
							}
				
							break;
					}
				}
				
				if ($xml_result == "Error")
				{
					print "Error - error code was $xml_errorcode, error message was $xml_errormsg\n";
				}
				else if ($xml_result == "Success")
				{
					$this->API_Token = urlencode($xml_token);
					// echo $this->API_Token;
				}
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}			
		}
		
		public function __setDbData(){}
		
		/* Implement MMQuoteBase abstract Members - ends */
		
		
		/* MMGRProxy Member Starts */
		private function Send_CE_XML_Request($request)
		{
			$test_url = "https://api.stgi.net/xml.pl";
		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $test_url);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// turning off the server and peer verification(TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		
			return curl_exec($ch);
		}
		
		private function ReadResponse($httpResponse,$keyName){
			try {
				//echo $httpResponse;
				$my_reader = new XMLReader();
				$my_reader->xml($httpResponse);
				
				$xml_result = "";
				$value = "";
				$xml_errorcode = "";
				$xml_errormsg = "";
				
				while ($my_reader->read())
				{
					switch ($my_reader->nodeType)
					{
						case XMLReader::ELEMENT:
							if ($my_reader->name == "Result")
							{
								$my_reader->read();
								$xml_result = $my_reader->value;
							}
							else if ($my_reader->name == $keyName)
							{
								$my_reader->read();
								$value = $my_reader->value;
							}
							else if ($my_reader->name == "ErrorCode")
							{
								$my_reader->read();
								$xml_errorcode = $my_reader->value;
							}
							else if ($my_reader->name == "ErrorText")
							{
								$my_reader->read();
								$xml_errormsg = $my_reader->value;
							}
				
							break;
					}
				}
				
				if ($xml_result == "Error")
				{					//print "Error - error code was $xml_errorcode, error message was $xml_errormsg\n";
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message("Error - error code was $xml_errorcode, error message was $xml_errormsg\n");
				return $xml_errorcode;
				}
				else if ($xml_result == "Success")
				{
					return $value;
				}
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		private function ReadErrorMsg($httpResponse,$keyName){
			try {
				//echo $httpResponse;
				$my_reader = new XMLReader();
				$my_reader->xml($httpResponse);
		
				$xml_result = "";
				$value = "";
				$xml_errorcode = "";
				$xml_errormsg = "";
		
				while ($my_reader->read())
				{
					switch ($my_reader->nodeType)
					{
						case XMLReader::ELEMENT:
							if ($my_reader->name == "Result")
							{
								$my_reader->read();
								$xml_result = $my_reader->value;
							}
							else if ($my_reader->name == $keyName)
							{
								$my_reader->read();
								$value = $my_reader->value;
							}
							else if ($my_reader->name == "ErrorCode")
							{
								$my_reader->read();
								$xml_errorcode = $my_reader->value;
							}
							else if ($my_reader->name == "ErrorText")
							{
								$my_reader->read();
								$xml_errormsg = $my_reader->value;
							}
		
							break;
					}
				}
		
				if ($xml_result == "Error")
				{					//print "Error - error code was $xml_errorcode, error message was $xml_errormsg\n";
					$errorlogger = new ErrorLogger();
					$errorlogger->add_message("Error - error code was $xml_errorcode, error message was $xml_errormsg\n");
					return $xml_errormsg;
				}
				else if ($xml_result == "Success")
				{
					return $value;
				}
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		public function AddContact($mm_contact){
			try {
				$contactInfo = new MMContacts();
				$contactInfo = $mm_contact;				
				
				
				$API_XML_String = "<AddContactsRequest>\n";
				$API_XML_String .= "<Contacts>\n";
				$API_XML_String .= "<Contact account_id='40878'>\n";
				$API_XML_String .= "<Firstname>{$contactInfo->firstName}</Firstname>\n";
				$API_XML_String .= "<Lastname>{$contactInfo->lastName}</Lastname>\n";
				$API_XML_String .= "<Address1>{$contactInfo->postAddress}</Address1>\n";
				$API_XML_String .= "<Address2>{$contactInfo->postAddress1}</Address2>\n";
				$API_XML_String .= "<City>{$contactInfo->city}</City>\n";
				$API_XML_String .= "<State>{$contactInfo->state}</State>\n";
				$API_XML_String .= "<Zip>{$contactInfo->zipcode}</Zip>\n";
				$API_XML_String .= "<Phone>{$contactInfo->phoneNumber}</Phone>\n";
				$API_XML_String .= "<Mobile>{$contactInfo->mobileNumber}</Mobile>\n";
				$API_XML_String .= "<Email>{$contactInfo->emailAddress}</Email>\n";
				$API_XML_String .= "<Groups>\n";
				$API_XML_String .= "<Group>{$this->UserGroup}</Group>\n";
				$API_XML_String .= "</Groups>\n";
				$API_XML_String .= "</Contact>\n";
				$API_XML_String .= "</Contacts>\n";
				
				$API_XML_String .= "</AddContactsRequest>\n";
				
				
				$this->API_XML = urlencode($API_XML_String);
				
				// NVPRequest for submitting to server
				$nvpreq = "email=$this->API_UserName&auth_token=$this->API_Token&xml=$this->API_XML";
				
				// echo "Request was $nvpreq\n\n";
				
				$httpResponse = $this->Send_CE_XML_Request($nvpreq);
				
				$result = $this->ReadResponse($httpResponse, 'Contact_id');
				if($result == '1002'){
					$result = $this->GetContact($mm_contact);
					if($result == ''){
						$error = $this->ReadErrorMsg($httpResponse, 'Contact_id');
						$_strat = strpos($error, 'ID ')+3 ; 
						$_end = strpos($error, '.');
						$_id  = substr($error, $_strat,$_end - $_strat);
						return $_id;
					}
				}
				return $result;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function GetContact($mm_contact){
			try {
				$contactInfo = new MMContacts();
				$contactInfo = $mm_contact;
				$API_XML_String = "<GetContactsRequest account_id='40878' email=\"{$contactInfo->emailAddress}\">\n";
        		$API_XML_String .= "</GetContactsRequest>\n";
				$this->API_XML = urlencode($API_XML_String); //echo $API_XML_String;
				$this->nvpreq = "email=$this->API_UserName&auth_token=$this->API_Token&xml=$this->API_XML";
				$httpResponse = $this->Send_CE_XML_Request($this->nvpreq);
				$result = $this->ReadResponse($httpResponse, 'Contact_id');
				//var_dump($result);
				return $result;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		/* MMGRProxy Member Ends */
	}
}
	