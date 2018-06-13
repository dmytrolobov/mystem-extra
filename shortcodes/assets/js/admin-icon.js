jQuery(document).ready(function($) {
	//* Include colorpicker
	$('.wp-color-picker-field').wpColorPicker();	

	var iconshortcode;
	var icon_list;
	var tbH = 475;
	
	
	$("body").delegate("#icon-picker-button","click",function(){

		setTimeout(function() {
			
			tb_show( '<img src="'+$('#icon-picker-button').find('.icon').attr('src')+'" alt="Icons" class="picker_ttl_icon">Icons', '#TB_inline?height=475&width=700&inlineId=wow-icons' );						
			
			tbReposition();
			
			$("#TB_closeWindowButton").replaceWith($("<div class='closetb' id='TB_closeWindowButton'><span class='screen-reader-text'>Close</span><span class='tb-close-icon'></span></div>"));

		}, 300);	
		
	});
	
	// Close Thickbox
	$("body").delegate(".closetb","click",function(){
		tb_remove();
	});

	
		
	// Reposition Thickbox
	function tbReposition() {
		
		$('#TB_window').css({
			'top' : ((jQuery(window).height() - 475) / 6) + 'px',
			'left' : ((jQuery(window).width() - 800) / 4) + 'px',
			'margin-top' : ((jQuery(window).height() - 475) / 6) + 'px',
			'margin-left' : ((jQuery(window).width() - 800) / 4) + 'px',
			'max-height' : parseInt(tbH) + 'px',
			'min-height' : parseInt(tbH) + 'px',
		});
			
	}
	
	$(window).resize(function() {
		
		tbReposition();
		
	});
	
	
	// Thickbox Close Callback
	var old_tb_remove = window.tb_remove;

	var tb_remove = function() {
   	 old_tb_remove();
	 setTimeout(function() {
    	$('.mce-inline-toolbar-grp').hide();
		}, 500);
	};
	
	
	$('#color_icon').wpColorPicker({
		change: function(event, ui){
			$("#color_icon").val(ui.color.toString());
			generateiconcode();			
		},
	}	);
	
	$('#color_shape').wpColorPicker({
		change: function(event, ui){
			$("#color_shape").val(ui.color.toString());
			generateiconcode();			
		},
	}	);
	
	$('.select_icon').fontIconPicker({
		theme: 'fip-darkgrey',
		emptyIcon: false,
		allCategoryText: 'Show all'
	});	
	generateiconcode();	

	
});


function generateiconcode(){
	
	var name_icon = jQuery("#icongenerate :selected").text();
	var color_icon = jQuery("#color_icon").val();
	var shape_icon = jQuery("#icon_shape :selected").val();
	var color_shape = jQuery("#color_shape").val();	
	var size_icon = jQuery("#size_icon").val();
	var icon_align = jQuery("#icon_align").val();
	
	if (size_icon == ''){
		var  size_icon = 24;
	}
	
	iconshortcode = '[icon name="'+name_icon+'" color="'+color_icon+'" size="'+size_icon+'" shape="'+shape_icon+'" colorshape="'+color_shape+'" align="'+icon_align+'"]';
	
	if(shape_icon != 'none'){
		if ( shape_icon == 'fas fa-ban' ) {
			var preview = '<span class="fa-stack fa-2x" style="font-size:'+size_icon+'px;"><i class="'+name_icon+' fa-stack-1x fa-inverse" style="color:'+color_icon+';"></i><i class="'+shape_icon+' fa-stack-2x" style="color:'+color_shape+';"></i></span>';
		}
		else {
			var preview = '<span class="fa-stack fa-2x" style="font-size:'+size_icon+'px;"><i class="'+shape_icon+' fa-stack-2x" style="color:'+color_shape+';"></i><i class="'+name_icon+' fa-stack-1x fa-inverse" style="color:'+color_icon+';"></i></span>';			
		}
		
	}
	else {
		var preview = '<i class="'+name_icon+'" style="color:'+color_icon+';font-size:'+size_icon+'px;"></i>';
	}
	
	jQuery('#set_code_icon').html(iconshortcode);
	jQuery('#set_preview_icon').html(preview);
	
}

function insertgenerateiconcode(){
	
	if( jQuery('#wp-content-editor-container > textarea').is(':visible') ) {
		var val = jQuery('#wp-content-editor-container > textarea').val() + iconshortcode;
		jQuery('#wp-content-editor-container > textarea').val(val);	
	}
	else {
		tinyMCE.activeEditor.execCommand('mceInsertContent', 0, iconshortcode);
	}
	tb_remove();
}