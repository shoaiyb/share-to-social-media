function hide_show_tr_select_animation(){
	var radio_stsm_style = jQuery('input:radio[name="stsm_options[stsm-select-style]"]');
	if ( radio_stsm_style.is(':checked') && ( radio_stsm_style.filter(':checked').val() == 'horizontal-with-count' || radio_stsm_style.filter(':checked').val() == 'small-buttons' ) ) {
        jQuery("tr.tr-select-animation").hide();
    }
    else{
    	jQuery("tr.tr-select-animation").show();	
    }
}

jQuery(document).ready(function(){

	hide_show_tr_select_animation();
	jQuery('input:radio[name="stsm_options[stsm-select-style]"]').change(function(){
        /*if ( $(this).is(':checked') && ( $(this).val() == 'horizontal-with-count' || $(this).val() == 'small-buttons' ) ) {
	        jQuery("tr.tr-select-animation").hide();
	    }
	    else{
	    	jQuery("tr.tr-select-animation").show();	
	    }*/
	    hide_show_tr_select_animation();
    });

});


