<?php
/**
 * @author Anushka Rajasingha
 * @url http://www.anushkar.com
 * @date 02/26/2015
 * @var MMContacts
 * @uses Communicate with the database
 * */
if (! trait_exists ( 'MMDbBase' )) {
	trait MMDbBase {
		public $tablename;
		public $dbdata;
		public $uniqueid;
		public $id;
		/**
		 * Description 
		 * @name Description
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $description;
		public $sortOrder;
		public $isActive;
		public $isDelete;
		public $copyof;
		public $createdate;
		public function __construct() {
		}
		private function _validateId() {
			try {
				
				if (isset ( $_POST ['uniqueid'] ) && ! empty ( $_POST ['uniqueid'] )) {
					$this->uniqueid = $_POST ['uniqueid'];
				} else if (isset ( $_POST ['data'] ['uniqueid'] ) && ! empty ( $_POST ['data'] ['uniqueid'] )) {
					$this->uniqueid = $_POST ['data'] ['uniqueid'];
				} else if (isset ( $this->uniqueid ))
					return true;
				else {
					echo json_encode ( array (
							'msgError' => 'Invalid unique id' 
					) );
					exit ();
				}
				
				return true;
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _setTablename($_tableName) {
			try {
				global $wpdb;
				$this->tablename = $wpdb->prefix . self::$current_plugin_data ['TextDomain'] . $_tableName;
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _save() {
			try {
				global $wpdb;
				$this->_getNextSortOrder ();
				$wpdb->hide_errors ();
				$wpdb->insert ( $this->tablename, $this->dbdata );
				
				if (! empty ( $wpdb->last_error )) {
					$errorlogger = new ErrorLogger ();
					$errorlogger->add_message ( $wpdb->last_error . PHP_EOL . ' -- ' . $wpdb->last_query );
					echo json_encode ( array (
							'msgError' => $wpdb->last_error 
					) );
					$wpdb->flush ();
					exit ();
				}
				
				return $this->id = $wpdb->insert_id;
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _update() {
			try {
				global $wpdb;
				
				if (array_key_exists ( 'isDelete', $this->dbdata )) {
					$this->_query ( "call sortorderDec('" . $this->tablename . "',$this->sortOrder)" );
				} else {
					$this->_getNextSortOrder ();
					$wpdb->hide_errors ();
					$wpdb->update ( $this->tablename, $this->dbdata, array (
							'uniqueid' => $this->uniqueid 
					) );
					
					if (! empty ( $wpdb->last_error )) {
						$errorlogger = new ErrorLogger ();
						$errorlogger->add_message ( $wpdb->last_error . PHP_EOL . ' -- ' . $wpdb->last_query );
						echo json_encode ( array (
								'msgError' => $wpdb->last_error 
						) );
						$wpdb->flush ();
						exit ();
					}
				}
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _copy() {
			try {
				$this->copyof = $this->uniqueid;
				$this->uniqueid = Plugin_Utilities::getUniqueKey ( 10 );
				$this->__setDbData ();
				$this->_save ();
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _deleteAll() {
			try {
				global $wpdb;
				$wpdb->query ( "update " . $this->tablename . " set `isDelete` = 1 " );
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _getItem() {
			try {
				if ($this->uniqueid == null) {
					throw new Exception('Invalid uniqueid ');
				}
				global $wpdb;
				$__result = $wpdb->get_row ( "select * from " . $this->tablename . " where uniqueid='" . $this->uniqueid . "'", ARRAY_A );
				Plugin_Utilities::injectObjectData ( $__result, $this );
				return $__result;
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _getResults($_isActive = 0) {
			try {
				global $wpdb;
				$_isActive = $_isActive == 1 ? ' isActive = 1 and ' : '';
				$__result = $wpdb->get_results ( "select * from " . $this->tablename . " where " . $_isActive . " isDelete=0 order by sortOrder", ARRAY_A );
				return $__result;
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _getRow($_uniqueid = null) {
			try {
				global $wpdb;
				$_uniqueid = $_uniqueid == null ? "" : " `uniqueid` = '" . $_uniqueid . "' and ";
				$__result = $wpdb->get_row ( "select * from " . $this->tablename . " where " . $_uniqueid . " isDelete=0 order by sortOrder", ARRAY_A );
				return $__result;
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _getCustomResults($query) {
			try {
				global $wpdb;
				$__result = $wpdb->get_results ( $query, ARRAY_A );
				return $__result;
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _query($query) {
			try {
				global $wpdb;
				return $wpdb->query ( $query );
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _changeStatus() {
			try {
				
				if (isset ( $_POST ['tblName'] ) && isset ( $_POST ['uniqueid'] ) && isset ( $_POST ['status'] )) {
					global $wpdb;
					$__propName = 'isActive';
					
					if (isset ( $_POST ['propName'] ))
						$__propName = $_POST ['propName'];
					$this->_setTablename ( $_POST ['tblName'] );
					$this->uniqueid = $_POST ['uniqueid'];
					$this->_getItem ();
					$this->$__propName = $_POST ['status'];
					global $wpdb;
					$wpdb->update ( $this->tablename, array (
							$__propName => $this->$__propName 
					), array (
							'uniqueid' => $this->uniqueid 
					) );
				}
				
				exit ();
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		public function _getNextSortOrder() {
			try {
				
				if (empty ( $this->dbdata ['sortOrder'] ) || $this->dbdata ['sortOrder'] == 0) {
					
					if (array_key_exists ( 'isDelete', $this->dbdata ) && $this->dbdata ['isDelete'] == 1) {
					} else {
						$query = 'select count(sortOrder)+1 as nextSortOrder from ' . $this->tablename . ' where isDelete = 0 ';
						$_result = $this->_getCustomResults ( $query );
					}
					
					return $this->dbdata ['sortOrder'] = $_result [0] ['nextSortOrder'];
				} else {
					$this->_query ( "call sortorderInc('" . $this->tablename . "',$this->sortOrder)" );
					return $this->dbdata ['sortOrder'];
				}
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
				exit ();
			}
		}
		private function _evalThis() {
			try {
				ob_start ();
				print_r ( $this );
				$result = ob_get_clean ();
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $result );
			} 

			catch ( Exception $e ) {
				$errorlogger = new ErrorLogger ();
				$errorlogger->add_message ( $e->getMessage () );
			}
		}
	}
}