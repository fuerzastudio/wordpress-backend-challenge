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

							<button type="submit" class="j-fuerza" data-action="haveInterested">
                                <span class="j-fuerza-title">Enviar</span>
                                <i id="j-fuerza-land" class="fa fa-spinner fa-pulse fa-fw d-none"></i>
                            </button>


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
