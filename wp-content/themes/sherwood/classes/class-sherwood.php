<?php
/**
 * Class: Sherwood
 *
 * @package sherwood
 */

class Sherwood extends Theme {
	public function __construct() {
		parent::__construct();
		add_action( 'init', array( $this, 'custom_post_types' ), 0 );
		add_action( 'after_setup_theme', function() {
			add_image_size( 'project-preview', 800, 450, array( 'center', 'center' ) );
		});
	}

	public function custom_post_types() {
		$labels = array(
			'name'                  => _x( 'Projects', 'Post Type General Name', 'emma' ),
			'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'emma' ),
			'menu_name'             => __( 'Projects', 'emma' ),
			'name_admin_bar'        => __( 'Projects', 'emma' ),
			'archives'              => __( 'Project Archives', 'emma' ),
			'attributes'            => __( 'Project Attributes', 'emma' ),
			'parent_item_colon'     => __( 'Parent Project:', 'emma' ),
			'all_items'             => __( 'All Projects', 'emma' ),
			'add_new_item'          => __( 'Add New Project', 'emma' ),
			'add_new'               => __( 'Add New', 'emma' ),
			'new_item'              => __( 'New Project', 'emma' ),
			'edit_item'             => __( 'Edit Project', 'emma' ),
			'update_item'           => __( 'Update Project', 'emma' ),
			'view_item'             => __( 'View Project', 'emma' ),
			'view_items'            => __( 'View Projects', 'emma' ),
			'search_items'          => __( 'Search Project', 'emma' ),
			'not_found'             => __( 'No project found', 'emma' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'emma' ),
			'featured_image'        => __( 'Featured Image', 'emma' ),
			'set_featured_image'    => __( 'Set featured image', 'emma' ),
			'remove_featured_image' => __( 'Remove featured image', 'emma' ),
			'use_featured_image'    => __( 'Use as featured image', 'emma' ),
			'insert_into_item'      => __( 'Insert into project', 'emma' ),
			'uploaded_to_this_item' => __( 'Uploaded to this project', 'emma' ),
			'items_list'            => __( 'Projects list', 'emma' ),
			'items_list_navigation' => __( 'Projects list navigation', 'emma' ),
			'filter_items_list'     => __( 'Filter projects list', 'emma' ),
		);
		$args = array(
			'label'                 => __( 'Project', 'emma' ),
			'description'           => __( 'Portfolio projects', 'emma' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', 'excerpt' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-portfolio',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'rewrite'               => array(
				'slug' => 'projects',
			),
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);
		register_post_type( 'project', $args );
	}
}
