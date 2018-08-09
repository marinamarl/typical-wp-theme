<!DOCTYPE html>
	<html class="no-js" <?php language_attributes() ?>>
		<head>
			<meta charset="<?php bloginfo( 'charset' ) ?>">
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
			<?php wp_head() ?>
		</head>
		<body <?php body_class() ?> >
			<header>
				<div class="wrap">

					<div class="grid-lines">
						<div class="container full-h">
							<div class="row">
								<div class="col col-7 bordered"></div>
								<div class="col col-7 bordered"></div>
								<div class="col col-7 bordered"></div>
								<div class="col col-7 bordered hidden-phone"></div>
								<div class="col col-7 bordered hidden-phone"></div>
								<div class="col col-7 bordered hidden-phone"></div>
								<div class="col col-7 bordered hidden-phone"></div>
							</div>
						</div>
					</div>

					<nav>
						<div class="icon-toggle">-</div>

						<div class="container">
							<div class="row">
								<div class="col col-7-double">
									<h3 class="tp hidden-phone"><?php _e('Output', 'typical') ?></h3>
									<div class="menu work-menu">
										<ul>
											<li><a href="/"><?php _e('All Work', 'typical') ?></a></li>
											<?php
											$terms = get_terms( array( 'taxonomy' => 'works' ));
											foreach ($terms as $term) { ?>
												<li><a href="<?php echo get_term_link($term) ?>"><?php _e($term->name) ?></a></li>
											<?php } ?>
										</ul>
									</div>
								</div>
								<div class="col col-7-double">
									<h3 class="tp hidden-phone"><?php _e('Soft', 'typical') ?></h3>
									<div class="menu">
										<ul>
											<li><a href="/soft"><?php _e('All Soft', 'typical') ?></a></li>
											<?php
											$terms = get_terms( array( 'taxonomy' => 'category' ));
											foreach ($terms as $term) { ?>
												<li><a href="<?php echo get_term_link($term) ?>"><?php _e($term->name) ?></a></li>
											<?php } ?>
										</ul>
									</div>
								</div>
								<div class="col col-7-double">
									<h3 class="tp hidden-phone"><?php _e('Hard', 'typical') ?></h3>
									<?php echo get_menu('hard_menu') ?>
								</div>
								<div class="col col-7 hidden-phone">
									<h3 class="tp control-toggle">
										<span><?php _e('Out of control', 'typical') ?></span>
									</h3>
								</div>
							</div>
						</div>
					</nav>

				</div>
			</header>