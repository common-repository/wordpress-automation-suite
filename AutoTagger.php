<?php
if(!defined('WESTON_NETWORKS_AUTO_TAGGER')){
	define('WESTON_NETWORKS_AUTO_TAGGER',true);
	
	class AutoTagger {
	
		private $_tags = array();
		private static $_ignore = false;
		
		public function __construct(){
		
			$this->_curl = curl_init();
			
			/* Set the common cURL options */
			curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->_curl, CURLOPT_POST, true);
			add_action('save_post', array($this, 'tagPost'), 1);
			
		}
		
		public static function trim_tags(&$item){
		
			$item = trim($item);
			
		}

		public function removeTags($blacklist){
		
			$temp = array();
			
			foreach($this->_tags as $value){
				if(is_array($blacklist) && in_array($value, $blacklist))
					continue;
					
				$temp[] = $value;
			}
			
			$this->_tags = $temp;
			
		}
		
		public function tagPost($id) {
			if(self::$_ignore == true)
				return;
				
			$post_id = wp_is_post_revision($id);
			
			if($post_id !== false){
				$id = $post_id;
			}
			
			$post = get_post($id);
			$author_name = get_the_author_meta('display_name', $post->post_author);
			$count = get_option('AutoTagger_TagTheNetCount', 10);
			$this->_tags = array_merge($this->_addTagTheNet($post->post_title, $post->post_content, $author_name, $count));
			
			$list = get_option('AutoTagger_Blacklist', null);
			
			if(!empty($list)){
				$blacklisted = explode(',',strtolower($list));
			}
			
			if(!empty($blacklisted) && count($blacklisted) > 0){
			
				$blacklist = (!is_array($blacklisted)) ? array($blacklisted) : $blacklisted;
				
				array_walk($blacklist,'AutoTagger::trim_tags');
			
				$this->removeTags($blacklist);
			
			}

			$this->removeAction();
			wp_set_post_tags( $id, $this->_tags, true);
			curl_close($this->_curl);
		}
		
		public function removeAction() {
			self::$_ignore = true;
		}
		
		private function _addTagTheNet($title, $content, $author_name, $count = 10) {
		
			if($count <= 0)
				return array();
		
	        curl_setopt($this->_curl, CURLOPT_URL, 'http://tagthe.net/api/');
			curl_setopt($this->_curl, CURLOPT_POSTFIELDS, 'text='.urlencode($title.' written by '.$author_name.' '.$content).'&view=json');
			$result = json_decode(curl_exec($this->_curl));
			return (array)$result->memes[0]->dimensions->topic;
			
		}
	
	}
	
}