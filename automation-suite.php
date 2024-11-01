<?php
/*
Plugin Name: WordPress Automation Suite
Plugin URI: http://travisweston.com/
Author: Travis Weston
Author URI: http://travisweston.com/
Description: With the help of this automation suite you are able to forget about creating excerpts, you can forget about manually inserting new pages for your posts. With this suite, all of these actions can, and will, be automated for you!
Version: 2.9
*/
if(!defined('WESTON_NETWORKS_AUTOMATION_SUITE')){
	define('WESTON_NETWORKS_AUTOMATION_SUITE', true);
	include_once('Menu.php');
	
	class WNAutomation {

		private $_db;
		private $_modules = array();
		private $options;

		private $_footers = array(
//REMOVED
				);

		private static $_instance;
				
		public function __construct() {
			global $wpdb;
			$this->_db = $wpdb;
			
			$this->options = new AutomationSuite_Menus();

			if(get_option('AutomationSuite_AutoMore', true) != false){
				include_once('AutoMore.php');
				$this->_modules['auto-more'] = new AutoMore($wpdb);
			}

			if(get_option('AutomationSuite_AutoPaging', false) != false){
				include_once('AutoPaging.php');
				$this->_modules['auto-paging'] = new AutoPaging($wpdb);
			}

			if(get_option('AutomationSuite_AutoTagger', false) != false){
				if(function_exists('curl_init')){
					include_once('AutoTagger.php');
					$this->_modules['auto-tagger'] = new AutoTagger();
				}else{
					add_action('admin_notices', array($this, 'autoTaggerFail'));
				}
			}
			
			//add_action('wp_footer', array($this, 'giveCredit'));
			add_action('admin_notices', array($this, 'begForMoney'));
			self::$_instance = $this;
		}
		
		public function autoTaggerFail() {
			echo '<div id="message" class="error"><h4>ERROR:</h4>Auto Tagger Module requires PHP cURL extension to be installed.</div>';
			update_option("AutomationSuite_AutoTagger", false);
		}
		
		public static function getInstance() {
		
			if(!(self::$_instance instanceof WNAutomation))
				self::$_instance = new WNAutomation();
				
			return self::$_instance;
		
		}
		
		public function stopTagger() {
		
			if(!isset($this->_modules['auto-tagger']))
				return;
				
			$this->_modules['auto-tagger']->removeAction();
			
		}
		
		public function giveCredit() {
			
			// Removed
		
		}
		
		public function setAlertTime() {
			
			$time = get_option('AutomationSuite_AlertTime', false);
			
			if($time !== false && $time > time() && !isset($_GET['hide']))
				return;
			
			$length = '+1 Month';
			
			update_option('AutomationSuite_AlertTime', strtotime($length, time()));
			
		}
		
		public function begForMoney() {
		
			$time = get_option('AutomationSuite_AlertTime', false);

			if($time === false || $time > time() || isset($_GET['hide'])){
				$this->setAlertTime();
				return;
			}
			
			$button = <<<html
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="PMDJTKFD26YQL">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
html;
			echo '<div id="message" class="updated fade"><p style="font-weight: bold;"><span style="float: left;">You\'ve used the WordPress Automation Suite for a while now. If you enjoy it, please consider donating $1</span>'.$button.'<form action="'.$_SERVER['REQUEST_URI'].'" method="get" style="float: right;"><input type="hidden" name="hide" value="true" /><input type="submit" class="button-primary" name="hide_msg" value="Hide Message" /></form></p><div style="clear:both;">&nbsp;</div></div>';
			
		}
		
	}

	$wnauto = new WNAutomation();
	
}
