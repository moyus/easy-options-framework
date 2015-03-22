jQuery(document).ready(function ($) {
	
	var EOF_settings = {
		init: function() {
			this.color();
			this.media();
			this.image_select();
			this.repeat();
			this.date();
			this.eof_port();
		},
		/*=Color Picker Field */
		color: function() {
			// Add Color Picker to all inputs that have 'color-field' class
			$( '.eof-color-picker' ).wpColorPicker();
		},
		/*=Date Picker Field */
		date: function() {
			//$('.eof-datepicker').datepicker();	
		},
		/*=Media Uploader Field  */
		media: function() {

			var custom_uploader;
			var $url_input = '';

			$('body').on('click', '.eof-media-delete-button', function(e) {
				e.preventDefault();

				$url_input = $('#' + $(this).data('input-id'));
				$url_input.val('');
				$(this).closest('td').find('.image-preview').remove();
			});

			$('body').on('click', '.eof-media-button', function(e) {
				e.preventDefault();
				
				$url_input = $('#' + $(this).data('input-id'));

				if( undefined !== custom_uploader ) {
					custom_uploader.open();
					return;
				}

				// Create the media frame.
				custom_uploader = wp.media.frames.file_frame = wp.media({
					frame: 'post',
					state: 'insert',
					multiple: false
				});
				//When an image is selected, run a callback.
				custom_uploader.on('insert', function() {
					var selection = custom_uploader.state().get('selection');
					selection.each( function( attachment, index ) {
						attachment = attachment.toJSON();
						if( 0 === index ) {
							//Place first attachment in field
							$url_input.val( attachment.url );
						} else {
							//Create a new row for all additional attachments
							// @todo
						}
					});
					
				});

				custom_uploader.open();

			});

			//var custom_uploader, $url_input = '';
		},
		image_select: function() {

			var syncClassChecked = function( img ) {
				var radioName = img.prev('input[type="radio"]').attr('name');

				$('input[name="' + radioName + '"]').each(function() {
					// Define img by radio name.
					var myImg = $(this).next('img');

					// Add / Remove Checked class.
					if ( $(this).prop('checked') ) {
						myImg.addClass('item-selected wp-ui-highlight');
					} else {
						myImg.removeClass('item-selected wp-ui-highlight');
					}
				});
			}

			$('input.radioImageSelect').each(function(e) {
				$(this)
					// First all we are need to hide the radio input.
					.hide()
					// And add new img element by data-image source.
					.after('<img src="' + $(this).data('image') + '" alt="radio image" />');

				// Define the new img element.
				var img = $(this).next('img');
				// Add item class.
				img.addClass('radio-img-item');

				// When we are created the img and radio get checked, we need add checked class.
				if ( $(this).prop('checked') ) {
					img.addClass('item-selected wp-ui-highlight');
				}

				// Create click event on img element.
				img.on('click', function(e) {
					$(this)
						// Prev to current radio input.
						.prev('input[type="radio"]')
						// Set checked attr.
						.prop('checked', true)
						// Run change event for radio element.
						.trigger('change');

					// Firing the sync classes.
					syncClassChecked($(this));
				} );
			});
		},
		repeat: function() {
			var $parent = $('.eof-repeat-table-wrap');
			$parent.on('click', '.add-row', function(event) {
				event.preventDefault();
				var count = $(this).data('count');
				var $new_item = $parent.find('tr.clone').clone().removeAttr('class').removeAttr('style');
				var $item = $new_item.wrap('<div/>').parent().html().replace(/field_count/g, count);
				$parent.find('tbody').append($item);
				count += 1;
				$(this).data('count', count);

			});

			$parent.on('click', 'tbody tr .item-action', function(event) {
				event.preventDefault();
				$(this).closest('tr').remove();
			});
		},
		/* import and export option settings */
		eof_port: function() {

		}
	};
	EOF_settings.init();
});