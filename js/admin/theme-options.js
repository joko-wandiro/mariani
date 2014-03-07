( function($){
$(document).ready( function(){
    Feedback= {
		selector: {},
        'default': function(data){
			console.log(data);
        },
        'alert': function(data){
			alert(data);
        },
    }
	
    Ajax= {		
		'form': '',
        'type': "default",
		'extra': "default",
		container: '',
        send: function(url, data){
            AjaxObj= this;
            $.ajax({
				async: false,
                dataType: 'json',
                type: 'POST',
                url: url,
                data: data,
                beforeSend: function(){
					AjaxObj.blockUI();
                },
                complete: function(){
					AjaxObj.unBlock();
                },
                success: function(data){
                    type= AjaxObj.type;
                    Feedback[type](data);
                }
            });
        },
		loading: function(url, data){
			container= this.container;
			$(container).load(url + ' ' + container, data);
		},
		blockUI: function(){
			$.blockUI({ 
//				message: '<h1>Loading...</h1>'
				message: phc_camera_admin_js_params.loading_text,
			});
		},
		unBlock: function(){
			$.unblockUI(); 
		},
	}

	$( "#tabs" ).tabs();
});
})(jQuery);

jQuery(document).ready( function($){
	// Uploading files
	var file_frame;
	
	$('.upload_image_button').live('click', function( event ){
		event.preventDefault();
		$obj= $(this);
		
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			$obj.parent().find('input[name^="phantasmacode_theme_settings_vars[image_url]"]').val(attachment.id);
			$obj.parent().prev().find('img').attr({'src': attachment.url})
		});

		// Finally, open the modal
		file_frame.open();
	});
})