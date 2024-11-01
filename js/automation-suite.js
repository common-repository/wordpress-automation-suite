jQuery(document).ready(function(){
	jQuery('#AutoMore_units').change(function() {
		var value = jQuery(this).val();
		
		if(value == 3){
			jQuery('#AutoMore_quantity').unbind('keyup');
			jQuery('#AutoMore_quantity').keyup(function() {
				if(parseInt(jQuery('#AutoMore_quantity').val()) > 99){
					jQuery('#AutoMore_quantity').val(99);
				}else if(parseInt(jQuery('#AutoMore_quantity').val()) < 1){
					jQuery('#AutoMore_quantity').val(1);
				}
			});
			if(parseInt(jQuery('#AutoMore_quantity').val()) > 99){
				jQuery('#AutoMore_quantity').val(99);
			}else if(parseInt(jQuery('#AutoMore_quantity').val()) < 1){
				jQuery('#AutoMore_quantity').val(1);
			}
		}else{
			jQuery('#AutoMore_quantity').unbind('keyup');
			jQuery('#AutoMore_quantity').keyup(function() {
				if(parseInt(jQuery('#AutoMore_quantity').val()) < 0){
					jQuery('#AutoMore_quantity').val(0);
				}
			});
		}
	});

	jQuery('#AutoMore_units').change();
});
