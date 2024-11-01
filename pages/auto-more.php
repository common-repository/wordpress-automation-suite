<?php
wp_enqueue_style('wn_stylesheet', 'http://westonnetworks.com/static/css/wp-style.css');
wp_enqueue_script('jquery');
wp_enqueue_script('automation-suite',plugins_url('/js/automation-suite.js', dirname(__FILE__).'/../automation-suite.php'),array('jquery'));

$options = $this->grabOptions('auto-more');

if(isset($_POST['DoUpdate']) && isset($options['AutoMore_auto_update']) && $options['AutoMore_auto_update'] == true){
	$url = plugins_url('pages/auto-more-update-all.php', dirname(__FILE__));
	wp_remote_post( $url, array('timeout' => 0.01, 'blocking' => false, 'sslverify' => apply_filters('https_local_ssl_verify', true)) );
}
?>
<div class="section" style="margin-right: 20px !important;">
	<div class="box visible">
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="DoUpdate" />
		<h2 class="notopmargin">Automation Suite Options &raquo; Auto More Tag</h2>
		<p>Welcome to the Auto More Tag module.</p>
		<p>When automatically placing the more tag, we need to know a few things for the intelligent placement to work. Just complete this paragraph:</p>
		<p>I would like to place my More Tag after <input name="AutoMore_quantity" id="AutoMore_quantity" value="<?php echo isset($options['AutoMore_quantity']) ? $options['AutoMore_quantity'] : 200; ?>" /> 				<select name="AutoMore_units" id="AutoMore_units">
					<option value="1" <?php echo ($options['AutoMore_units'] == 1 || !isset($options['AutoMore_units'])) ? 'selected="SELECTED" ' : null; ?>/>Characters
					<option value="2" <?php echo ($options['AutoMore_units'] == 2) ? 'selected="SELECTED" ' : null; ?>/>Words
					<option value="3" <?php echo ($options['AutoMore_units'] == 3) ? 'selected="SELECTED" ' : null; ?>/>Percent
			</select>, at the nearest <select id="AutoMore_break" name="AutoMore_break">
					<option value="1" <?php echo ($options['AutoMore_break'] == 1 || !isset($options['AutoMore_break'])) ? 'selected="SELECTED" ' : null; ?>/>Space
					<option value="2" <?php echo ($options['AutoMore_break'] == 2) ? 'selected="SELECTED" ' : null; ?>/>End of Line
				</select>. I <select id="AutoMore_auto_update" name="AutoMore_auto_update">
					<option value="1" <?php echo (!isset($options['AutoMore_auto_update']) || $options['AutoMore_auto_update'] == true) ? 'selected="SELECTED" ' : null;?>/>would
					<option value="0" <?php echo (isset($options['AutoMore_auto_update']) && $options['AutoMore_auto_update'] == false) ? 'selected="SELECTED" ' : null;?>/>wouldn't
				</select> like to automatically update every post in my blog when I update my settings. I <select id="AutoMore_ignore_man_tag" name="AutoMore_ignore_man_tag">
					<option value="1" <?php echo (!isset($options['AutoMore_ignore_man_tag']) || $options['AutoMore_ignore_man_tag'] == true) ? 'selected="SELECTED" ' : null;?>/>would
					<option value="0" <?php echo (isset($options['AutoMore_ignore_man_tag']) && $options['AutoMore_ignore_man_tag'] == false) ? 'selected="SELECTED" ' : null;?>/>wouldn't
				</select> like to ignore manually inserted shortcode more tags of the format [amt_override].</p>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Update Auto More Tag Settings'); ?>" />
		</p>
</form>
		<?php include_once('paypal.php'); ?>
	</div>
</div>