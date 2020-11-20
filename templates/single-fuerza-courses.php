<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}
	date_default_timezone_set('America/Sao_Paulo');
	get_header(); ?>


<?php while ( have_posts() ) : ?>
	<?php the_post();

	$data = json_decode(get_post_meta($post->ID, '_fuerza_settings', true), false);

	$time = date('H:i:s', strtotime($data->_fuerza_data));
	$limitDay = date('d/m/Y', strtotime($data->_fuerza_data));
	$link = $data->_fuerza_link;
	?>

	<style>
        .fuerza-container {
            width: 80%;
            margin: 40px auto;
        }

        .fuerza-container .fuerza-main-content .fuerza-header {
            margin: 100px 0;
        }

        .fuerza-container .fuerza-main-content header.fuerza-header h2 {
            font-size: 44px !important;
            color: red;
        }

        .fuerza-container .fuerza-main-content h3.header-excerpt p {
            font-size: 28px !important;
            color: red;
        }

        .fuerza-container .box-form-fuerza h3 {
            text-align: center;
            font-size: 30px !important;
            text-transform: uppercase;
            color: red;
        }

        .box-form-fuerza {
            max-width: 600px;
            margin: 100px auto;

            display: flex;
            flex-direction: column;

        }

        .box-form-fuerza .form-group-fuerza+.form-group-fuerza {
            margin-top: 30px;
        }

        .box-form-fuerza small {
            margin-top: 10px;
            padding: 5px;
            color: red;
        }

        .box-form-fuerza-button {
            flex: 1;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }

        .box-form-fuerza-button button {
            width: 200px;
            margin-top: 40px;
            cursor: pointer;
            text-decoration: none;
        }

        input[type="hidden"] {
            display: none;
        }

        .d-none {
            display: none
        }

        .d-flex {
            display:
        }

        .d-error {
            border: 1px solid;
            border-color: red !important;
        }

        .pt-4 {
            margin-top: 20px !important;
        }

        a.button_link {
            -webkit-appearance: none;
            -moz-appearance: none;
            background: #cd2653;
            border: none;
            border-radius: 0;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 0.0333em;
            line-height: 1.25;
            opacity: 1;
            padding: 1.1em 1.44em;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            transition: opacity 0.15s linear;
            width: 100%;
            max-width: 300px;

            margin: 30px auto;
        }
	</style>
	<div class="fuerza-container">

		<header class="header-fuerza">
			<h2><?php the_title(); ?></h2>

			<h3 class="header-excerpt"><?php  the_excerpt() ?></h3>
		</header>

		<main class="fuerza-main-content">
			<div class="date-limit">

				<?php if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime($data->_fuerza_data))): ?>

					<span><i class="fa fa-calendar" aria-hidden="true"></i> <?= $limitDay  ?> -
        <i class="fa fa-clock-o" aria-hidden="true"></i> <?= $time ?>
      </span>

				<?php else: ?>

					<span>
        <i class="fa fa-calendar" aria-hidden="true"></i>As inscrições já se encerraram
      </span>

				<?php endif; ?>;
			</div>

			<?php the_content(); ?>


			<!--
			=======================================
			* Form
			=======================================
			-->

			<section class="box-form-fuerza">

				<?php if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime($data->_fuerza_data))): ?>

					<form action="" method="post">
						<div class="from-title">
							<h3>Tenho Interesse</h3>
						</div>

						<div class="form-group-fuerza j-name">
							<label for="name"></label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Nome completo"
							       aria-describedby="name">
						</div>

						<div class="form-group-fuerza j-email">
							<label for="email"></label>
							<input type="email" name="email" id="email" class="form-control" placeholder="E-mail"
							       aria-describedby="email">

						</div>

						<div class="form-group-fuerza box-form-fuerza-button">

							<button type="submit" class="j-fuerza" data-action="haveInterested"> enviar</button>

						</div>

						<input type="hidden" name="courser" value="<?= the_title() ?>">
						<input type="hidden" name="courser_id" value="<?= $post->ID ?>">

					</form>


				<?php else: ?>;

					<!--
				  =======================================
				  * Button
				  =======================================
				  -->

					<a href="<?= $link ?>" class="button_link" target="_blank" rel="noopener noreferrer">Inscrição</a>

				<?php endif; ?>

			</section>

		</main>


	</div>



<?php endwhile; // end of the loop. ?>

<?php
	get_footer( 'shop' );
