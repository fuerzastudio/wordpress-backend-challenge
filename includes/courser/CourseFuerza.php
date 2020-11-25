<?php

if(!class_exists( 'CourseFuerza')) {
	/**
	 * Class CourseFuerza
	 */
	final class CourseFuerza {

		/**
		 * CourseFuerza constructor.
		 */
		public function __construct() {

			add_action( 'init', [$this,'fuerza_register_post_type'] );

		}

		/**
		 *
		 */
		public function fuerza_register_post_type(): void {

			if ( post_type_exists( 'fuerza_courses' ) ) {
				return;
			}

			$slug = 'fuerza-courses';

			$rewrite = $slug ? array(
				'slug'       => sanitize_title( $slug ),
				'with_front' => false,
				'feeds'      => false
			) : false;

			register_post_type( 'fuerza_courses',
				[
					'labels' => [

						'name' => __( 'Fuerza Courses', 'fuerza' ),

						'singular_name' => __( 'Fuerza Course', 'fuerza' ),

						'add_new' => __( 'Add new course', 'fuerza' ),

						'add_new_item' => __( 'Add Course', 'fuerza' ),

						'edit' => __( 'Edit', 'fuerza' ),

						'edit_item' => __( 'Edit Course', 'fuerza' ),

						'new_item' => __( 'Nova Course', 'fuerza' ),

						'view' => __( 'View', 'fuerza' ),

						'view_item' => __( 'Ver Course', 'fuerza' ),

						'search_items' => __( 'Search Course', 'fuerza' ),

						'not_found' => __( 'Course not found', 'fuerza' ),

						'not_found_in_trash' => __( 'Course not found in the trash', 'fuerza' ),

						'parent' => __( 'Parent Course', 'fuerza' ),

					],

					'description' => __( 'Adds custom post of the Fuerza Courses type.', 'fuerza' ),

					'public' => true,

					'has_archive' => [ 'archive_slug', 'fuerza_courses' ],

					'menu_icon' => 'dashicons-edit-page',

					'rewrite' => $rewrite,

					'can_export' => true,

					'menu_position' => 5,

					'supports' => [ 'title', 'editor', 'excerpt', 'thumbnail' ],

					'capability_type' => 'post',

				]

			);

		}

	}
}