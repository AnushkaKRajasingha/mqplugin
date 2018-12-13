<?php
class Add_Hooks extends Plugin_Core{
	public function __construct(){		
		$this->_addHook();
		register_activation_hook( WPQP_PLUGINDIR.'/wp_QuotePlugin.php',array($this,'_activate'));
		register_deactivation_hook( WPQP_PLUGINDIR.'/wp_QuotePlugin.php',array($this,'_deactivate'));
		$this->_regAjaxMethosd();
		$this->_registerHelperFuncs();
		$this->_regPluginShortCodes();		
	}
	
	public function _addHook(){
		add_filter('_isLicenseActive',array( &$this, '_isLicenseActive' ));
		
		if(apply_filters('_isLicenseActive',self::$current_plugin_data['TextDomain'])){
			add_action('wp_head',array(&$this,'_customPluginHeader'));
			add_action('wp_footer',array(&$this,'_customPluginFooter'));
			add_action( 'admin_menu', array( &$this, 'menuInit' ) );
			//add_action( 'template_redirect', array(&$this,'_loadTemplate'), 1 );
		}
		else{
			add_action( 'admin_menu', array( &$this, 'inactiveMenuInit' ) );
		}
		add_action(self::$current_plugin_data['TextDomain'].'_script_localiztion', array(&$this,'_scriptLocalization'));
		add_action('admin_enqueue_scripts', array( &$this, 'scriptInit' ));		
	}		
	
	public function _activate(){
		//update_option('WPQP-settings', 'sadasdasdasd');
		add_option(self::$current_plugin_data['TextDomain'].'-settings', maybe_serialize(self::$current_plugin_data) );
		global $wpdb;
		foreach (init_var::_getDbTables() as $key => $value) {
			$table_name = $wpdb->prefix .self::$current_plugin_data['TextDomain'].$key;
			$value = str_replace("@table_name",$table_name,$value);
			if($wpdb->get_var("SHOW TABLES LIKE '".$table_name."'") != $table_name){
				$wpdb->query($value);
			}
		}
		/* DB changes ececution by AKR on 06122015 */
		$_dbupdateScript = init_var::_getDbUpdates(); 
		if($_dbupdateScript != null){
			$wpdb->show_errors = false;
			foreach ($_dbupdateScript as $_query) {
				$_query = str_replace('@wpprefix', $wpdb->prefix, $_query);
				$_query = str_replace('@textdomain', self::$current_plugin_data['TextDomain'], $_query);
				$wpdb->query($_query);
			}
			$wpdb->show_errors = true;
		}
		/* DB changes ececution by AKR on 06122015 */
	}
	
	public function _deactivate(){
		delete_option(self::$current_plugin_data['TextDomain'].'-settings');
		if (self::$current_plugin_data['DbRemove']=='Yes') {
			global $wpdb;
			foreach (init_var::_getDbTables() as $key => $value) {
				$table_name = $wpdb->prefix .self::$current_plugin_data['TextDomain'].$key;
				$results = $wpdb->query("drop table ".$table_name." ;");
			}
		}
	}
	
	private function _regAjaxMethosd(){
		foreach (init_var::_getMethodAjax() as $key => $value) {
			$single_action = $value['func'];
			add_action( 'wp_ajax_'.self::$current_plugin_data['TextDomain'].$key, array( &$this, $single_action ) );
			if($value['user'])
				add_action( 'wp_ajax_nopriv_'.self::$current_plugin_data['TextDomain'].$key, array( &$this, $single_action ) );
		}
	}
	
	private function _regPluginShortCodes(){
		foreach (init_var::_getShortCodeSettings() as $key => $value) {
			add_shortcode($key, array( &$this,$value));
		}
	}
	
	/* added new private hook req#0006 */
	private function _registerHelperFuncs(){
		add_filter(self::$current_plugin_data['TextDomain'].'_setRadioBtn',array( &$this, '_setRadioBtn' ),10,4);
	}
	/* added new private hook req#0006 */
}