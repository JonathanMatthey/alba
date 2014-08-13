(function ($) {
    "use strict";
    $(document).ready(function () {
    	/* Clearfix for ACF Admin Styles */
    	$('<div class="clearfix"></div>').insertAfter($('div.field > select'));
    	$('<div class="select-arrow"></div>').insertAfter($('div.field > select'));
    	$('<div class="clearfix"></div>').insertAfter($('div.field > textarea'));
    	$('<div class="clearfix"></div>').insertAfter($('div.field > .acf-color_picker'));
    	$('<div class="clearfix"></div>').insertAfter($('div.field > .text'));
    	$('<div class="clearfix"></div>').insertAfter($('div.field > .input'));
    	$('<div class="clearfix"></div>').insertAfter($('div.field > .checkbox_list'));
    	$('<div class="clearfix"></div>').insertAfter($('div.field > .acf-image-uploader'));
    	$('<div class="clearfix"></div>').insertAfter($('div.field > .acf-input-wrap'));
    	
    	/* start flexible layout fields in closed mode */
    	$('.layout').each(function() {
    	    if($(this).parent().attr('class') !== 'clones') {
    	        $(this).attr('data-toggle', 'closed');
                $(this).children('.acf-input-table').hide();
    	    }
    	});
            	
    	/* wysiwyg editor in full width */
    	$('.row_layout .field_type-wysiwyg').each(function() {
    	   $(this).children('td.label').remove();
    	   $(this).children('td:first-child').attr('colspan', '2');
    	});

        /* repeater field in full width */
        $('.field_type-repeater').each(function() {
           $(this).children('td.label').remove();
           $(this).children('td:first-child').attr('colspan', '2');
        });
        
        /* first two repeater fields for rows and columns */
        $('.repeater tr.field_key-field_52deae5b75c7d').children('td.label').remove();
        $('.repeater tr.field_key-field_52deae7b75c7e').children('td.label').remove();
        
        /* repeater sub field wysiwygin full width */
        $('.repeater tr.field_type-wysiwyg').each(function() {
           $(this).children('td.label').remove();
           $(this).children('td:first-child').attr('colspan', '2');
        });

    	$('.field ul.acf-checkbox-list li label').each( function() {
    	    if($(this).children('.checkbox').prop('checked')) {
    	        $(this).css('backgroundPosition', '0px -21px');
                $(this).addClass('checked');
    	    }
    	});
    	
    	/* include the content editor in the workview content editor tab */
    	$('#acf_3362, #acf_acf_content-editor').insertAfter('.field_key-field_52af1e0e9d2d9');
    	
    	/* include the content editor in the page tab */
        $('#acf_3362, #acf_acf_content-editor').insertAfter('.field_key-field_530238f0d553c');
    	
    	/* include the custom header in the page custom header tab */
        $('#acf_1307, #acf_acf_fullscreen-cover').insertAfter('.field_key-field_52f2469819e07');
    	
    	/* include the custom header in the workview project header tab */
    	$('#acf_1307, #acf_acf_fullscreen-cover').insertAfter('.field_key-field_51ef0717531f2');
    });
})(jQuery);