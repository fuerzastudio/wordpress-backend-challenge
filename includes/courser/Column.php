<?php

	if ( ! function_exists( 'fuerza_courses_list_columns_header' ) ) {

		/**
		 * @param $columns
		 *
		 * @return array
		 */
		function fuerza_courses_list_columns_header( $columns ): array {
			$before = array_slice( $columns, 0, 2 );

			$after = array_slice( $columns, 2 );

			$new_columns = [

				'total-interested' => __( 'Total Interested', 'fuerza' ),

			];

			$columns = array_merge( $before, $new_columns, $after );

			return $columns;
		}

		add_filter( 'manage_edit-fuerza_courses_columns', 'fuerza_courses_list_columns_header' );

	}

	if ( ! function_exists( 'fuerza_courses_list_columns_data' ) ) {

		/**
		 * @param $column
		 */
		function fuerza_courses_list_columns_data( $column ) {
			global $post;

			$total = Interesting::getTotalCount( $post->ID );

			if ( $column === 'total-interested' && $total ) {
				?>

                <div class='fuerza-buttons' style='padding: 0 40px; font-weight: bold; font-size: 14px'>
					<?= $total ?>
                </div>
				<?php
			}

		}

		add_filter( 'manage_fuerza_courses_posts_custom_column', 'fuerza_courses_list_columns_data' );

	}