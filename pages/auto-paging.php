<?php
wp_enqueue_style('wn_stylesheet', 'http://westonnetworks.com/static/css/wp-style.css');
wp_enqueue_script('jquery');
wp_enqueue_script('automation-suite',plugins_url('/js/automation-suite.js', dirname(__FILE__).'/../automation-suite.php'),array('jquery'));

$options = $this->grabOptions('auto-paging');

if(isset($_POST['DoUpdate']) && isset($options['AutoPaging_auto_update']) && $options['AutoPaging_auto_update'] == true){
	$url = plugins_url('pages/auto-paging-update-all.php', dirname(__FILE__));
	wp_remote_post( $url, array('timeout' => 0.01, 'blocking' => false, 'sslverify' => apply_filters('https_local_ssl_verify', true)) );
}
?>
<div class="section" style="margin-right: 20px !important;">
	<div class="box visible">
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="DoUpdate" />
		<h2 class="notopmargin">Automation Suite Options &raquo; Auto Post Pagination</h2>
		<p>Welcome to the Auto Post Pagination module.</p>
		<p>When automatically placing the NextPage tag, we need to know a few things for the intelligent placement to work. Just complete this paragraph:</p>
		<p>I would like to place my NextPage Tag only if there is a minimum of <input name="AutoPaging_quantity" id="AutoPaging_quantity" value="<?php echo isset($options['AutoPaging_quantity']) ? $options['AutoPaging_quantity'] : 200; ?>" /> <select name="AutoPaging_units" id="AutoPaging_units">
					<option value="1" <?php echo ($options['AutoPaging_units'] == 1 || !isset($options['AutoPaging_units'])) ? 'selected="SELECTED" ' : null; ?>/>Characters
					<option value="2" <?php echo ($options['AutoPaging_units'] == 2) ? 'selected="SELECTED" ' : null; ?>/>Words
			</select> present. I would like to set a maximum of <select name="AutoPaging_maximum" id="AutoPaging_maximum">
					<option value="2" <?php echo (!isset($options['AutoPaging_maximum']) || $options['AutuPaging_maximum'] == 2) ? 'selected="SELECTED"' : null; ?>/>Two
					<option value="3" <?php echo ($options['AutuPaging_maximum'] == 3) ? 'selected="SELECTED"' : null; ?>/>Three
					<option value="4" <?php echo ($options['AutuPaging_maximum'] == 4) ? 'selected="SELECTED"' : null; ?>/>Four
			</select> pages. I <select id="AutoPaging_auto_update" name="AutoPaging_auto_update">
					<option value="1" <?php echo (!isset($options['AutoPaging_auto_update']) || $options['AutoPaging_auto_update'] == true) ? 'selected="SELECTED" ' : null;?>/>would
					<option value="0" <?php echo (isset($options['AutoPaging_auto_update']) && $options['AutoPaging_auto_update'] == false) ? 'selected="SELECTED" ' : null;?>/>wouldn't
				</select> like to automatically update every post in my blog when I update my settings.</p>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Update Auto Post Paging Settings'); ?>" />
		</p>
</form>
		<?php include_once('paypal.php'); ?>
	</div>
</div>