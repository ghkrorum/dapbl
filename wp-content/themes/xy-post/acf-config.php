<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_589161d6b0cab',
	'title' => 'Home',
	'fields' => array (
		array (
			'post_type' => array (
			),
			'taxonomy' => array (
			),
			'allow_null' => 1,
			'multiple' => 0,
			'return_format' => 'object',
			'ui' => 1,
			'key' => 'field_589bd1343a2e5',
			'label' => 'Noticia destacada',
			'name' => 'featured_post',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
		),
		array (
			'taxonomy' => 'category',
			'field_type' => 'select',
			'multiple' => 0,
			'allow_null' => 1,
			'return_format' => 'object',
			'add_term' => 1,
			'load_terms' => 0,
			'save_terms' => 0,
			'key' => 'field_589161de5389f',
			'label' => 'Categoría Principal 1',
			'name' => 'main_cat_1',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
		),
		array (
			'taxonomy' => 'category',
			'field_type' => 'select',
			'multiple' => 0,
			'allow_null' => 1,
			'return_format' => 'object',
			'add_term' => 1,
			'load_terms' => 0,
			'save_terms' => 0,
			'key' => 'field_5891623e538a0',
			'label' => 'Categoría Principal 2',
			'name' => 'main_cat_2',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
		),
		array (
			'taxonomy' => 'category',
			'field_type' => 'select',
			'multiple' => 0,
			'allow_null' => 1,
			'return_format' => 'object',
			'add_term' => 1,
			'load_terms' => 0,
			'save_terms' => 0,
			'key' => 'field_58916269538a1',
			'label' => 'Categoría Principal 2',
			'name' => 'main_cat_3',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'template-home.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'the_content',
		1 => 'featured_image',
	),
	'active' => 1,
	'description' => '',
));

endif;