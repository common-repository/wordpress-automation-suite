<?php

class AutomationSuite_Menus {

	public function __construct() {
		if(isset($_POST['DoUpdate'])){
			$this->updateOptions($_POST);
		}
		add_action('admin_menu', array($this, 'buildMenu'));
	}

	public function updateOptions($new){

		foreach($new as $key => $value){
			if($key == 'DoUpdate')
				continue;

			update_option($key, $value);
		}
		
	}

	public function grabOptions($collection) {

		/* 
			Using this method we can store a seperate option for each field, and not one large array.
		*/

		$options = array();

		switch($collection) {
			case 'main':
				$options['AutomationSuite_AutoMore'] = get_option('AutomationSuite_AutoMore', true);
				$options['AutomationSuite_AutoPaging'] = get_option('AutomationSuite_AutoPaging', false);
				$options['AutomationSuite_AutoTagger'] = get_option('AutomationSuite_AutoTagger', false);
				//$options['AutomationSuite_GiveCredit'] = get_option('AutomationSuite_GiveCredit', false);
				break;
			case 'auto-more':
				$options['AutoMore_quantity'] = (int)get_option('AutoMore_quantity', 200);
				$options['AutoMore_units'] = get_option('AutoMore_units', 1);
				$options['AutoMore_break'] = get_option('AutoMore_break', 1);
				$options['AutoMore_auto_update'] = get_option('AutoMore_auto_update', true);
				$options['AutoMore_ignore_man_tag'] = get_option('AutoMore_ignore_man_tag', true);
				break;
			case 'auto-paging':
				$options['AutoPaging_quantity'] = (int)get_option('AutoPaging_quantity', 200);
				$options['AutoPaging_units'] = get_option('AutoPaging_units', 1);
				$options['AutoPaging_break'] = get_option('AutoPaging_break', 1);
				$options['AutoPaging_auto_update'] = get_option('AutoPaging_auto_update', true);
				break;
			case 'auto-tagger':
				$options['AutoTagger_TagTheNetCount'] = (int)get_option('AutoTagger_TagTheNetCount', 10);
				$options['AutoTagger_Blacklist'] = get_option('AutoTagger_Blacklist', null);
				break;
			default:
				break;
		}

		return $options;

	}

	public function buildMainOptionsPage() {

		require_once(dirname(__FILE__).'/pages/MainOptions.php');

	}

	public function buildAutoMoreOptionsPage() {

		require_once(dirname(__FILE__).'/pages/auto-more.php');

	}

	public function buildAutoPagingOptionsPage() {

		require_once(dirname(__FILE__).'/pages/auto-paging.php');

	}

	public function buildAutoTaggerOptionsPage() {
	
		require_once(dirname(__FILE__).'/pages/auto-tagger.php');
	
	}
	
	public function buildMenu() {

		$this->option_menu = add_menu_page('Automation Suite', 'Automation Suite', 'read', 'automation_suite', array($this, 'buildMainOptionsPage'), plugins_url('/imgs/icon.png', __FILE__));
		$this->option_menu_page_one = add_submenu_page('automation_suite', 'Automation Suite', 'Main Options', 'manage_options', 'automation_suite', array($this, 'buildMainOptionsPage'));
		if(get_option('AutomationSuite_AutoMore', true) != false){
			$this->option_menu_page_two = add_submenu_page('automation_suite', 'Auto More Tags', 'Auto More Tags', 'manage_options', 'automation_suite_auto_more', array($this, 'buildAutoMoreOptionsPage'));
		}
		
		if(get_option('AutomationSuite_AutoPaging', false) != false){
			$this->option_menu_page_three = add_submenu_page('automation_suite', 'Auto Post Paging', 'Auto Post Paging', 'manage_options', 'automation_suite_auto_paging', array($this, 'buildAutoPagingOptionsPage'));
		}

		if(get_option('AutomationSuite_AutoTagger', false) != false){
			$this->option_menu_page_four = add_submenu_page('automation_suite', 'Auto Post Tagger', 'Auto Post Tagger', 'manage_options', 'automation_suite_auto_tagger', array($this, 'buildAutoTaggerOptionsPage'));
		}
		
	}

}
