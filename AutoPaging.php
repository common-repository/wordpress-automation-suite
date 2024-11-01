<?php
if(!defined('WESTON_NETWORKS_AUTO_PAGINATION')){
	define('WESTON_NETWORKS_AUTO_PAGINATION', true);
	class AutoPaging {
		
		private static $_instance;

		public $length;
		public $options;
		public $data;

		public function __construct($wpdb) {
			$this->_db = &$wpdb;
			self::$_instance = &$this;
	
			add_filter('content_save_pre', 'AutoPaging::addTag', '1', 2);
		}

		public static function getInstance() {
			return self::$_instance;
		}
		
		public function activate() {
			update_option('AutomationSuite_Module_AutoPaging', true);
		}

		public function deactivate() {
			update_option('AutomationSuite_Module_AutoPaging', false);
		}

		public static function addTag($data, $arr = array()){
			
			$options = array();
			$length = (int)get_option('AutoPaging_quantity', 200);
			$units = (int)get_option('AutoPaging_units', 1);
			$max = (int)get_option('AutoPaging_maximum', 1);

			// Sanitize the nasty characters out of it! 

			$data = str_replace(chr(160), chr(32), $data);
			$data = str_replace(chr(194), '', $data);

			if(($units == 1 && mb_strlen(strip_tags($data)) < $length) || str_word_count(strip_tags($data)) < $length){ 
				return $data;
			}else{
				return self::$_instance->byPercent($data, $max);
			}
		
		}

		public function byPercent($data, $maximum) {

			$debug = null;
			$break = ' ';
			$data = str_replace('<!--nextpage-->', '', $data);

			/* Strip Tags, get length */
			$stripped_data = strip_tags($data);
			$lengthOfPost = mb_strlen($stripped_data);
			$fullLength = mb_strlen($data);

			/* Find location to insert */

			$insert_location = (int)($lengthOfPost * ((100 / $maximum) / 100));

			/* iterate through post, look for differences between stripped and unstripped. If found, continue*/

			$strippedLocation = 0;		
			$insertSpot = 0;
			for($total = 1; $total < $maximum; $total++){
				for($i = $insertSpot; $i < $fullLength; $i++){
	
					if($stripped_data[$strippedLocation] != $data[$i]){
						continue;
					}
				
					if($strippedLocation >= ($insert_location * $total)){

						if($stripped_data[$strippedLocation] == $break){
							$insertSpot = $i;
							break;
						}
					}

					$strippedLocation++;	
				}
			
				$start = trim(mb_substr($data, 0, $insertSpot));
				$end = trim(mb_substr($data, $insertSpot));

				if(mb_strlen($start) > 0 && mb_strlen($end) > 0){
					$data = $start.'<!--nextpage-->'.$end;
				}

				$stripped_data = strip_tags($data);

			}
			
			return $data;

		}

		public function updateAll() {
		
			if(get_option('AutoPaging_auto_update', true) != true)
				return;
				
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

	}
	
}
