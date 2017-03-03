

wpsitesynccontent.push = function(post_id)
{
	console.log('push()');
	// Do nothing when in a disabled state
	if (this.disable || !this.inited)
		return;

	// clear the message to start things off
//	jQuery('#sync-message').html('');
//	jQuery('#sync-message').html(jQuery('#sync-working-msg').html());
//	jQuery('#sync-content-anim').show();
//	jQuery('#sync-message').parent().hide().show(0);
	// set message to "working..."
	this.set_message(jQuery('#sync-msg-working').text(), true);

	this.post_id = post_id;

	var checkedCatInputs = jQuery('#synccategorychecklist input:checked');
	var categories = [];

	if ( checkedCatInputs.length ){
		for ( var i = 0; i < checkedCatInputs.length ; i++ ){
			var catInput = checkedCatInputs[i];
			var inputvalue = jQuery(catInput).val();
			categories[i] = inputvalue;
			
		}
		
	}
	

	var data = { action: 'spectrom_sync', operation: 'push', post_id: post_id, _sync_nonce: jQuery('#_sync_nonce').val(), target_terms: categories.join(',') };

	var push_xhr = {
		type: 'post',
		async: true, // false,
		data: data,
		url: ajaxurl,
		success: function(response) {
//console.log('push() success response:');
//console.log(response);
			wpsitesynccontent.clear_message();
			if (response.success) {
//				jQuery('#sync-message').text(jQuery('#sync-success-msg').text());
				wpsitesynccontent.set_message(jQuery('#sync-success-msg').text(), false, true);
				if ('undefined' !== typeof(response.notice_codes) && response.notice_codes.length > 0) {
					for (var idx = 0; idx < response.notice_codes.length; idx++) {
						wpsitesynccontent.add_message(response.notices[idx]);
					}
				}
			} else {
				if ('undefined' !== typeof(response.data.message))
//					jQuery('#sync-message').text(response.data.message);
					wpsitesynccontent.set_message(response.data.message, false, true);
			}
		},
		error: function(response) {
//console.log('push() failure response:');
//console.log(response);
			var msg = '';
			if ('undefined' !== typeof(response.error_message))
				wpsitesynccontent.set_message('<span class="error">' + response.error_message + '</span>', false, true);
//			jQuery('#sync-content-anim').hide();
		}
	};

	// Allow other plugins to alter the ajax request
	jQuery(document).trigger('sync_push', [push_xhr]);
//console.log('push() calling jQuery.ajax');
	jQuery.ajax(push_xhr);
//console.log('push() returned from ajax call');

};