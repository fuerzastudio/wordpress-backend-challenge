<?php

if(!class_exists('Fuerza_add_custom_box')){
	/**
	 * Class Fuerza_add_custom_box
	 */
	final class Fuerza_add_custom_box
	{
		/**
		 *
		 */
		public static function add()
		{
			$screens = ['fuerza_courses'];
			foreach ($screens as $screen) {

				add_meta_box('time-limit', 'Data Limite', [
					self::class,
					'htmlDateLimit',
				], $screen);

				add_meta_box('list-all', 'Interessados no Curso', [
					self::class,
					'findAll',
				], $screen);

			}
		}

		/**
		 *
		 */
		public static function save()
		{
			if (isset($_POST['post_ID']) && $_POST['post_type'] === 'fuerza_courses') {
				$postId = $_POST['post_ID'];
			}

			$setting = self::arraySetting();

			if (isset($postId)) {

				$set = [];
				foreach ($setting as $key) {
					$item = !empty($_POST[$key]) ? $_POST[$key] : '';
					$set[$key] = $item;
				}

				$set = json_encode($set);
				update_post_meta($postId, '_fuerza_settings', $set);
			}
		}


		/**
		 * @return string[]
		 */
		private static function arraySetting(): array{
			return [
				"_fuerza_data",
				"_fuerza_hour",
				"_fuerza_link",
			];
		}


		/**
		 * @param $post
		 */
		public static function htmlDateLimit($post)
		{
			$jsonField = json_decode(get_post_meta($post->ID, '_fuerza_settings', true), false);

			if ($jsonField) {
				$date = $jsonField->_fuerza_data;
				$hour = $jsonField->_fuerza_hour;
				$link = $jsonField->_fuerza_link;
			}

			?>

			<div class="fuerza-items">
				<div class="fuerza-box-item">
					<div class="fuerza-item-url">
						<label for="_fuerza_data">Data Limite </label>
						<input type="datetime-local" name="_fuerza_data" id="_fuerza_data" value="<?= $date ?? '' ?>">
					</div>

					<div class="fuerza-item-url">
						<label for="_fuerza_hour">Carga horária</label>
						<input type="text" name="_fuerza_hour" id="_fuerza_hour" value="<?= $hour ?? '' ?>">
					</div>
				</div>

				<div class="fuerza-item-url fuerza-box-item-link">
					<label for="_fuerza_link">URI da página do formulário de inscrições</label>
					<input type="url" name="_fuerza_link" id="_fuerza_link" value="<?= $link ?? '' ?>">
				</div>
			</div>
			<?php
		}

		/**
		 * @param $post
		 */
		public static function findAll($post){

			$response = Interesting::findAll( $post->ID);

			if($response){
				?>

				<table id="fuerza-report" class="cell-border stripe" style="width:100%">
					<thead>
					<tr class="title">
						<th scope="col">#</th>
						<th scope="col">Nome</th>
						<th scope="col">Email</th>
						<th scope="col">Data</th>
						<th scope="col">Hora</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($response as $resp){

						$date = date('d/m/Y', strtotime($resp->created_at));
						$time = date('H:i:s', strtotime($resp->created_at));

						?>

						<tr>
							<td class="center"> <?= $resp->id ?></td>
							<td class=""> <?= $resp->name ?></td>
							<td class=""> <?= $resp->email ?></td>
							<td class="center"> <?= $date ?></td>
							<td class="center"> <?= $time ?></td>
						</tr>


					<?php } ?>
					</tbody>
					<tfoot>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nome</th>
						<th scope="col">Email</th>
						<th scope="col">Data</th>
						<th scope="col">Hora</th>
					</tr>
					</tfoot>
				</table>
				<?php
			}else{

				echo '<div class="fuerza-not-found">';
				echo $post->ID;
				echo '<h3> Não há nenhum interessado neste curso ainda</h3>';
				echo '</div>';
			}

		}

		/**
		 *
		 */
		public function __constructor()
		{
		}

	}

	if (is_admin()) {
		add_action('add_meta_boxes', [
			'Fuerza_add_custom_box',
			'add',
		]);
		add_action('save_post', [
			'Fuerza_add_custom_box',
			'save',
		]);

	}

}