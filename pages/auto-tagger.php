<?php
wp_enqueue_style('wn_stylesheet', 'http://westonnetworks.com/static/css/wp-style.css');
wp_enqueue_script('jquery');

$options = $this->grabOptions('auto-tagger');

?>

<div class="section" style="margin-right: 20px !important;">
	<div class="box visible">
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="DoUpdate" />
		<h2 class="notopmargin">Automation Suite Options &raquo; Auto Post Tagger</h2>
		<p>Welcome to the Auto Post Tagging module.</p>
		<p>To properly tag your posts, I need to know a little more information. Just complete this paragraph:</p>
		<p>I would like to pull a total of <input type="text" name="AutoTagger_TagTheNetCount" value="<?php echo $options['AutoTagger_TagTheNetCount']; ?>" /> tags from Tagthe.net. I would not like to use <input type="text" name="AutoTAgger_Blacklist" value="<?php echo $options['AutoTagger_Blacklist']; ?>" /> tags, which I have separated by commas, at all, in any of my posts.</p>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Update Auto Post Tagger Settings'); ?>" />
		</p>
</form>
		<?php include_once('paypal.php'); ?>
	</div>
</div>
