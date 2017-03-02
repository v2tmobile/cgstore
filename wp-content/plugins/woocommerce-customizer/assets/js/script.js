jQuery(document).ready(function() {
	//alert(jQuery('.form-table').length);
	var html_template =   '<h2 id="title_5" class="customizer_title">Level 5</h2>'
						+ '<button id="button_5" class="button_remove" value="5" type="button">-</button>'
						+ '<table class="form-table" id="form_table_5">'
						+ '<tbody><tr valign="top">'
						+ '<th scope="row" class="titledesc">'
						+ '<label for="value_5">Value</label>'
						+ '<span class="woocommerce-help-tip"></span></th>'
						+ '<td class="forminp forminp-text">'
						+ '<input name="value_5" id="value_5" style="" value="" class="" placeholder="" type="text"></td>'
						+ '</tr><tr valign="top">'
						+ '<th scope="row" class="titledesc">'
						+ '<label for="percent_5">Percent (%)</label>'
						+ '<span class="woocommerce-help-tip"></span></th>'
						+ '<td class="forminp forminp-text">'
						+ '<input name="percent_5" id="percent_5" style="" value="" class="" placeholder="" type="text"></td>'
						+ '</tr></tbody></table>'
						;
	
	remove();

	jQuery('#button_add').on('click', function() {
		var length = jQuery('.form-table').length + 1;
		var html = html_template;
		jQuery(this).before(html);
		//jQuery('.button_remove').show();
		remove();
	});

	function remove() {
		jQuery('.button_remove').on('click', function() {
			if (jQuery('.form-table').length > 1) {
				var i = jQuery(this).val();
				jQuery('#title_' + i).remove();
				jQuery('#button_' + i).remove();
				jQuery('#form_table_' + i).remove();
			}
			
			if (jQuery('.form-table').length == 1) {
				//jQuery('.button_remove').hide();
			}
			
			reset();
		});
	}
	
	function reset() {
		jQuery('.customizer_title').each(function(i) {
			var j = i + 1;
			jQuery(this).prop('id', 'title_' + j);
			jQuery(this).text('Level ' + j);
		});

		jQuery('.button_remove').each(function(i) {
			var j = i + 1;
			jQuery(this).prop('id', 'button_' + j);
			jQuery(this).val(j);
		});

		remove();
	}
});