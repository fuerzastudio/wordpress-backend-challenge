<?php

if(!class_exists('Fuerza_add_custom_box')){
	final class Fuerza_add_custom_box
	{

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


		private static function arraySetting(): array{
			return [
				"_fuerza_data",
				"_fuerza_hour",
				"_fuerza_link",
			];
		}


		public static function htmlDateLimit($post)
		{
			$jsonField = json_decode(get_post_meta($post->ID, '_fuerza_settings', true), false);

			if ($jsonField) {
				$date = $jsonField->_fuerza_data;
				$hour = $jsonField->_fuerza_hour;
				$link = $jsonField->_fuerza_link;
			}

			?>

			<style>
                .fuerza-items {
                    width: 100%;
                    margin: 30px auto;
                    display: flex;
                    align-items: center;
                    gap: 20px;
                    flex-wrap: wrap;
                }

                .fuerza-box-item {
                    min-width: 150px;
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(100px, 2fr));
                    gap: 20px;
                }

                .fuerza-item-url {
                    display: flex;
                    flex-direction: column;
                    row-gap: 10px
                }

                .fuerza-box-item-link {
                    flex: 1;
                }

                .fuerza-item-url input {
                    height: 50px;
                    padding: 10px 20px;
                }
			</style>
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
					<label for="_fuerza_data">URI da página do formulário de inscrições</label>
					<input type="url" name="_fuerza_link" id="_fuerza_link" value="<?= $link ?? '' ?>">
				</div>
			</div>
			<?php
		}

		public static function findAll($post){
			global $wpdb;

			$css_folder =  plugins_url() . '/fuerza-course-try/assets/css';
			wp_enqueue_style('font-icons', $css_folder . '/report.css', "",'1.0.1');

			$response = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}fuerza_courser",OBJECT );

			if($response){

				?>
				<style>
                    #fuerza-report {
                        width: 100%;
                        border: 1.5px solid #333;
                        margin: 0 auto 10px;
                        padding: 0;
                    }

                    #fuerza-report .title,
                    #fuerza-report tr,
                    #fuerza-report td {
                        height: 30px;
                        font-size: 15px;
                        border-top: 1px solid #333;
                        border-bottom: 1px solid #333;
                    }
				</style>


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
							<td scope="row" class="center"> <?= $resp->id ?></td>
							<td class="center"> <?= $resp->name ?></td>
							<td class="center"> <?= $resp->email ?></td>
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
				echo '<h3> Não há nenhum interessado neste curso ainda</h3>';
				echo '</div>';
			}

		}

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