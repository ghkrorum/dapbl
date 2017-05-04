<?php
// spectrom_sync_api_push_content
function kxn_sync_post_type($postTypes = array()){
	$postTypes[]= 'author';
	return $postTypes;
}

add_filter( 'spectrom_sync_allowed_post_types',  'kxn_sync_post_type' );

function kxn_sync_api_push_content($data, $apiRequest){

	if ( empty( $data['post_data']['post_content'] ) ){
		$post_id = $data['post_id'];

		$post_thumbnail_id = abs(get_post_thumbnail_id($post_id));

		if ('' !== $post_thumbnail_id) {

			$img = wp_get_attachment_image_src($post_thumbnail_id, 'large');

			// convert site url to relative path
			if (FALSE !== $img) {
				$src = $img[0];

				$path = str_replace(trailingslashit(site_url()), ABSPATH, $src);
				
					$apiRequest->upload_media($post_id, $path, NULL /*$this->host*/, TRUE, $post_thumbnail_id);
			}
		}
	}
	
	return $data;
}

add_filter( 'spectrom_sync_api_push_content',  'kxn_sync_api_push_content', 10, 2 );

//'spectrom_sync_api_request', $data, $action, $remote_args);

function kxn_sync_api_request_push($data, $action = null, $remote_args = null){
	if ( $action  == 'push' ){

		$postId = $data['post_id'];
		$postMeta = $data['post_meta'];

		$data['taxonomies']['hierarchical'] = array();
		
		if ($postMeta){
			$api = new SyncApiRequest();

			foreach ( $postMeta as $key => $metaValue ){

				$field = get_field_object($key, $postId, false, true);

				if ($field){

					if ( $field['type'] == 'image' && $field['value'] ){

						$imageId = $field['value'];
						
						$wpPost = get_post( $imageId );

						$img = wp_get_attachment_image_src($imageId, 'large');
						if (FALSE !== $img) {
							$src = $img[0];
							$path = str_replace(trailingslashit(site_url()), ABSPATH, $src);
							$attach_post = get_post($imageId, OBJECT);
							$attach_alt = get_post_meta($imageId, '_wp_attachment_image_alt', TRUE);
							$post_fields = array (
					//			'name' => 'value',
								'post_id' => $imageId,
								'featured' => 0,
								'boundary' => wp_generate_password(24),		// TODO: remove and generate when formatting POST content in _media()
								'img_path' => dirname($path),
								'img_name' => basename($path),
								'img_url' => $attach_post->guid,
								'contents' => file_get_contents($path),
								// 'attach_id' => $imageId,
								'attach_desc' => (NULL !== $attach_post) ? $attach_post->post_content : '',
								'attach_title' => (NULL !== $attach_post) ? $attach_post->post_title : '',
								'attach_caption' => (NULL !== $attach_post) ? $attach_post->post_excerpt : '',
								'attach_name' => (NULL !== $attach_post) ? $attach_post->post_name : '',
								'attach_alt' => (NULL !== $attach_post) ? $attach_alt : '',
							);
							
							$apiResponse = $api->api('upload_media', $post_fields);

							if ( $apiResponse->is_success() ) {
								// print_r($apiResponse);
								$data['post_meta'][$key][0] = $apiResponse->response->data->attachment_id;
							}

						}
					}
					elseif ( $field['type'] == 'relationship' && $field['value'] ){

						$relatedPostIds = array();

						foreach ( $field['value'] as $relatedPostId ){

							$apiResponse = $api->api('push', array('post_id' => $relatedPostId));

							if ( $apiResponse->is_success() ) {
								$relatedPostIds[] = $apiResponse->response->data->post_id;
							}
						}

						$data['post_meta'][$key][0] = serialize($relatedPostIds);

					}
				}					
				
			}

			// exit();
		}

		$input = new SyncInput();

		$data['target_terms'] = $input->post('target_terms', '');
		
	}
	
	return $data;
}
// allow add-ons to modify the data stream
add_filter( 'spectrom_sync_api_request',  'kxn_sync_api_request_push', 10, 3  );

function kxn_sync_metabox_before_button($error){
	global $post;

	if ($post->post_type == 'post'){
		$model = new SyncModel();
		$sync_data = $model->get_sync_data($post->ID, SyncOptions::get('site_key'));

		$targetPostId = (NULL !== $sync_data)?$sync_data->target_content_id:0;

		$api = new SyncApiRequest();
		$apiResponse = $api->api('kxn_get_categories', array('target_post_id' => $targetPostId) );

		if ( $apiResponse->response->data->category_check_list )
			echo $apiResponse->response->data->category_check_list;
	}

}
add_filter( 'spectrom_sync_metabox_before_button',  'kxn_sync_metabox_before_button', 10, 1  );



function kxn_sync_api_request_action_get_categories($data, $action, $remote_args){

	return $data;
}

add_filter( 'spectrom_sync_api_request_action',  'kxn_sync_api_request_action_get_categories', 10, 3  );

function kxn_sync_api_action_get_categories($res, $action, $response){

	if ($action == 'kxn_get_categories')
	{
		

$categoryBox = <<<EOT
<div id="sync-taxonomy-category" class="categorydiv">
	<ul id="sync-category-tabs" class="category-tabs">
		<li class="tabs"><a href="#sync-category-all">Target Categories</a></li>
	</ul>
	<div id="sync_target-category-all" class="tabs-panel">
		<input name="sync_post_category[]" value="0" type="hidden">
		%s
	</div>
</div>
EOT;

		$input = new SyncInput();
		$targetPostId = $input->post_int('target_post_id', 0);
		$postTermIds = array();

		SyncDebug::log( "kxn_get_categories: target postID: ".$targetPostId );

		if ( $targetPostId ){
			$postTerms = get_the_terms( $targetPostId, 'category' );
			if ($postTerms){
				foreach ($postTerms as $term){
					$postTermIds[] = $term->term_id;
				}
			}
		}

		$categories = get_categories(array(
			'hide_empty' => false,
			'parent' => 0
		));

		SyncDebug::log( "kxn_get_categories: categories found: ".var_export($categories, true) );

		$orderedCats = array();
		$categoryList = '';

		foreach ( $categories as $cat ){
			$childItems = '';

			$listItem = '<li id="sync-category-%1$s" class="popular-category"><label class="selectit"><input value="%1$s" name="sync_post_category[]" id="in-sync-category-%1$s" type="checkbox" %4$s >%2$s</label>%3$s</li>';

			$childrenTerms = get_categories( array( 'hide_empty' => false,'parent' => $cat->term_id ) );
			if ( $childrenTerms ){
				foreach ( $childrenTerms as $childTerm ){

					$childItem = '<li id="sync-category-%1$s"><label class="selectit"><input value="%1$s" name="sync_post_category[]" id="in-sync-category-%1$s" type="checkbox" %3$s> %2$s</label></li>';

					$checked = ( in_array($childTerm->term_id, $postTermIds) )?'checked':'';

					$childItems .= sprintf( $childItem,
				        $childTerm->term_id,
				        $childTerm->name,
				        $checked
				    );

				}				
				$childItems = '<ul class="children">'.$childItems.'</ul>';
			}

			$catChecked = ( in_array($cat->term_id, $postTermIds) )?'checked':'';

			$categoryList .= sprintf( $listItem,
		        $cat->term_id,
		        $cat->name,
		        $childItems,
		        $catChecked
		    );
		}

		if ( $categoryList ){
			$categoryList = '<ul id="synccategorychecklist" class="categorychecklist synccategorychecklist form-no-clear">'.$categoryList.'</ul>';
		}

		$categoryBox = sprintf( $categoryBox, $categoryList);

		SyncDebug::log( "kxn_get_categories: category box: ".$categoryBox );

		$data = array(
			'category_check_list' => $categoryBox,
		);

		// move data from filtered array into response object
		foreach ($data as $key => $value) {
			$response->set($key, $value);
		}

		$response->success(TRUE);

		$response->send();
		
		exit();
	}
	return $res;
}
add_filter( 'spectrom_sync_api',  'kxn_sync_api_action_get_categories', 10, 3  );

function kxn_sync_scripts( $hook ){

	if ( 'post.php' != $hook ) {
        return;
    }
	
	$themeUrl = get_stylesheet_directory_uri();
	wp_enqueue_script('kxn-sync', get_template_directory_uri().'/js/kxn-sync.js', array('jquery'), '1.0', TRUE);
}

add_action('admin_enqueue_scripts', 'kxn_sync_scripts');

function kxn_sync_push_content_assign_taxonomy_terms($target_post_id, $post_data, $response){

	$input = new SyncInput();
	$targetTerms = $input->post_raw('target_terms', '');
	if ($targetTerms){
		$termIds = explode(',', $targetTerms);
		$termIds = array_map( 'intval', $termIds );
		wp_set_object_terms( $target_post_id, $termIds, 'category' );
	}
}

add_action('spectrom_sync_push_content', 'kxn_sync_push_content_assign_taxonomy_terms', 10, 3);