<?php
if(!defined('WESTON_NETWORKS_AUTO_MORE_TAG')){
	define('WESTON_NETWORKS_AUTO_MORE_TAG', true);
	class AutoMore {
		
		private static $_instance;

		public $length;
		public $options;
		public $data;

		public function __construct($wpdb) {
			$this->_db = &$wpdb;
			self::$_instance = &$this;
	
			add_filter('content_save_pre', 'AutoMore::addTag', '1', 2);
			add_shortcode('amt_override', array($this, 'manualOverride'));
			add_shortcode('no_more', array($this, 'manualOverride'));
		}

		public static function getInstance() {
			return self::$_instance;
		}
		
		public function activate() {
			update_option('AutomationSuite_Module_AutoMore', true);
		}

		public function deactivate() {
			update_option('AutomationSuite_Module_Auto_more', false);
		}

		public static function addTag($data, $arr = array()){
			
			$options = array();
			$options['quantity'] = (int)get_option('AutoMore_quantity', 200);
			$options['units'] = (int)get_option('AutoMore_units', 1);
			$options['break'] = (int)get_option('AutoMore_break', 1);
			$options['ignore_man_tag'] = (bool)get_option('AutoMore_ignore_man_tag', true);
			$length = $options['quantity'];
			$breakOn = $options['break'];

			$moreTag = strpos($data, '[amt_override]');

			if($moreTag !== false && $options['ignore_man_tag'] != true){
				
				return self::$_instance->manual($data);

			}

			if(strpos($data, '[no_more]')){
				return $data;
			}
			
			// Sanitize the nasty characters out!

			$data = str_replace(chr(160), chr(32), $data);
			$data = str_replace(chr(194), '', $data);

			if(mb_strlen(strip_tags($data)) <= 0)
				return $data;

			switch($options['units']){
				case 1:
					
					return self::$_instance->byCharacter($data, $length, $breakOn);
					break;
				case 2:
				default:

					return self::$_instance->byWord($data, $length, $breakOn);
					break;

				case 3:
					
					return self::$_instance->byPercent($data, $length, $breakOn);
					break;
			}

		}

		public function manual($data) {

			$data = str_replace('<!--more-->', '', $data);
			$data = str_replace('[amt_override]','[amt_override]<!--more-->', $data);

			return $data;

		}

		public function byWord($data, $length, $breakOn) {
		
			$break = ($breakOn == 2) ? PHP_EOL : ' ';
			$data = str_replace('<!--more-->', '', $data);
			$stripped_data = strip_tags($data);

			$fullLength = mb_strlen($data);

			$strippedLocation = 0;
			$wordCount = 0;
			for($i = 0; $i < $fullLength; $i++){
				if($stripped_data[$strippedLocation] != $data[$i]){
					continue;
				}

				if($wordCount >= $length){
					if($stripped_data[$strippedLocation] == $break){
						$insertSpot = $i;
						break;
					}
				}

				if($stripped_data[$strippedLocation] == ' '){
					$wordCount++;
				}
				
				$strippedLocation++;

			}

			$start = trim(mb_substr($data, 0, $insertSpot));
			$end = trim(mb_substr($data, $insertSpot));

			if(mb_strlen($start) > 0 && mb_strlen($end) > 0)
				$data = $start.'<!--more-->'.$end;

			return $data;

		}

		public function byCharacter($data, $length, $breakOn) {

			$break = ($breakOn == 2) ? PHP_EOL : ' ';
			$data = str_replace('<!--more-->', '', $data);
			$stripped_data = strip_tags($data);

			$fullLength = mb_strlen($data);

			$strippedLocation = 0;

			for($i = 0; $i < $fullLength; $i++){
				if($stripped_data[$strippedLocation] != $data[$i]){
					continue;
				}

				if($strippedLocation >= $length){
					if($stripped_data[$strippedLocation] == $break){
						$insertSpot = $i;
						break;
					}
				}
				
				$strippedLocation++;

			}

			$start = trim(mb_substr($data, 0, $insertSpot));
			$end = trim(mb_substr($data, $insertSpot));

			if(mb_strlen($start) > 0 && mb_strlen($end) > 0)
				$data = $start.'<!--more-->'.$end;

			return $data;

		}

		public function byPercent($data, $length, $breakon) {

			$debug = null;
			$break = ($breakOn === 2) ? PHP_EOL : ' ';
			$data = str_replace('<!--more-->', '', $data);
			/* Strip Tags, get length */
			$stripped_data = strip_tags($data);
			$lengthOfPost = mb_strlen($stripped_data);
			$fullLength = mb_strlen($data);

			/* Find location to insert */

			$insert_location = $lengthOfPost * ($length / 100);

			/* iterate through post, look for differences between stripped and unstripped. If found, continue*/

			$strippedLocation = 0;		

			for($i = 0; $i < $fullLength; $i++){
				if($stripped_data[$strippedLocation] != $data[$i]){
					continue;
				}
		
				if($strippedLocation >= $insert_location){
					if($stripped_data[$strippedLocation] == $break){
						$insertSpot = $i;
						break;
					}
				}

				$strippedLocation++;	
			}
			
			$start = trim(mb_substr($data, 0, $insertSpot));
			$end = trim(mb_substr($data, $insertSpot));

			if(mb_strlen($start) > 0 && mb_strlen($end) > 0)
				$data = $start.'<!--more-->'.$end;			
			
			return $data;

		}

		public function updateAll() {
		
			if(get_option('AutoMore_auto_update', true) != true)
				return;
		
			// Stop the auto tagger from firing, so we don't have a baragge of auto tagging going on.
			WNAutomation::getInstance()->stopTagger();
			$posts = get_posts(array(
				'numberposts' => '-1',
				'post_status' => 'publish',
				'post_type' => 'post'
			));

			if(count($posts) > 0){
				global $post;
				foreach($posts as $post){
					setup_postdata($post);
					$post->post_content = self::addTag($post->post_content);
					wp_update_post($post);
					usleep(750000);
				}
			}
	
		}

		public function manualOverride($atts, $content = null, $code = null){
			// We just want to make this tag disappear. Let's just make it go away now...
			return null;
		}

	}
	
}
