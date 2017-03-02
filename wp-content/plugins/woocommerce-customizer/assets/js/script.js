jQuery(document).ready(function() {
	//alert(jQuery('.form-table').length);
	var html_template =   '<h2 id="title_%i%" class="customizer_title">Level %i%</h2>'
						+ '<button id="button_%i%" class="button_remove" value="%i%">Remove</button>'
						+ '<table class="form-table" id="form_table_%i%">'
						+ '<tbody><tr valign="top">'
						+ '<th scope="row" class="titledesc">'
						+ '<label for="value_%i%">Value</label>'
						+ '<span class="woocommerce-help-tip"></span></th>'
						+ '<td class="forminp forminp-text">'
						+ '<input name="value_%i%" id="value_%i%" style="" value="" class="customizer_value" placeholder="" type="text"></td>'
						+ '</tr><tr valign="top">'
						+ '<th scope="row" class="titledesc">'
						+ '<label for="percent_%i%">Percent (%)</label>'
						+ '<span class="woocommerce-help-tip"></span></th>'
						+ '<td class="forminp forminp-text">'
						+ '<input name="percent_%i%" id="percent_%i%" style="" value="" class="customizer_percent" placeholder="" type="text"></td>'
						+ '</tr></tbody></table>'
						;

	remove();

	jQuery('#button_add').on('click', function() {
		var length = jQuery('.form-table').length + 1;
		var html = html_template.replace(/%i%/g, length);
		jQuery(this).before(html);
		//jQuery('.button_remove').show();
		remove();
	});

	function remove() {
		jQuery('.button_remove').unbind('click').bind('click', function() {
			if (jQuery('.form-table').length > 1) {
				var i = jQuery(this).val();
				jQuery('#title_' + i).remove();
				jQuery('#button_' + i).remove();
				jQuery('#form_table_' + i).remove();

				reset();
			}

			if (jQuery('.form-table').length == 1) {
				//jQuery('.button_remove').hide();
			}
			
		});
	}
	
	function reset() {
		jQuery('.customizer_title').each(function(i) {
			var j = i + 1;
			jQuery(this).attr('id', 'title_' + j).html('Level ' + j);
		});

		jQuery('.button_remove').each(function(i) {
			var j = i + 1;
			jQuery(this).attr('id', 'button_' + j).val(j);
		});
		
		jQuery('.customizer_value').each(function(i) {
			var j = i + 1;
			jQuery(this).attr('id', 'value_' + j).attr('name', 'value_' + j);
			jQuery(this).parent().parent().find('label').attr('for', 'value_' + j);
		});

		jQuery('.customizer_percent').each(function(i) {
			var j = i + 1;
			jQuery(this).attr('id', 'percent_' + j).attr('name', 'percent_' + j);
			jQuery(this).parent().parent().find('label').attr('for', 'percent_' + j);
		});
		
		jQuery('.form-table').each(function(i) {
			var j = i + 1;
			jQuery(this).attr('id', 'form_table_' + j);
		});

		remove();
	}
});