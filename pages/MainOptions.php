<?php
wp_enqueue_style('wn_stylesheet', 'http://westonnetworks.com/static/css/wp-style.css');
wp_enqueue_script('jquery');

$options = $this->grabOptions('main');
?>
<div class="section" style="margin-right: 20px !important;">
	<div class="box visible">
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="DoUpdate" value="true" />
		<h2 class="notopmargin">Automation Suite Options</h2>
		<p>Welcome to the Automation Suite.</p>
		<p>We need to know a few things before we can continue. Please, finish these sentences:</p>
		<ul>
			<li>
				I <select name="AutomationSuite_AutoMore">
					<option value="1" <?php echo (!isset($options['AutomationSuite_AutoMore']) || $options['AutomationSuite_AutoMore'] == true) ? 'selected="SELECTED" ' : null;?>/>would	
					<option value="0" <?php echo (isset($options['AutomationSuite_AutoMore']) && $options['AutomationSuite_AutoMore'] != true) ? 'selected="SELECTED" ' : null;?>/>wouldn't
				  </select> like to use the Auto More Tag Module.
			</li>
			<li>
				I <select name="AutomationSuite_AutoPaging">
					<option value="1" <?php echo (isset($options['AutomationSuite_AutoPaging']) && $options['AutomationSuite_AutoPaging'] == true) ? 'selected="SELECTED" ' : null;?>/>would	
					<option value="0" <?php echo (!isset($options['AutomationSuite_AutoPaging']) || $options['AutomationSuite_AutoPaging'] != true) ? 'selected="SELECTED" ' : null;?>/>wouldn't
				  </select> like to use the Auto Post Paging Module.
			</li>
			<li>
				I <select name="AutomationSuite_AutoTagger">
					<option value="1" <?php echo (isset($options['AutomationSuite_AutoTagger']) && $options['AutomationSuite_AutoTagger'] == true) ? 'selected="SELECTED" ' : null; ?>/>would
					<option value="0" <?php echo (!isset($options['AutomationSuite_AutoTagger']) || $options['AutomationSuite_AutoTagger'] != true) ? 'selected="SELECTED" ' : null; ?>/>wouldn't
				</select> like to use the Auto Post Tagger Module.
			</li>
		</ul>
		<p class="submit">
			<input type="submit" class="button-primary" name="submit" value="Update" />
		</p>
</form>
		<?php include_once('paypal.php'); ?>
	</div>
</div>

