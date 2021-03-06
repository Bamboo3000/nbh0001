<header class="home__header">
	<div id="home_carousel" class="home__header-slider carousel slide" data-ride="carousel">
	<?php if( have_rows('slides') ) : ?>
		<?php if(sizeof(get_field('slides')) > 1) : ?>
		<ol class="carousel-indicators">
			<?php while ( have_rows('slides') ) : the_row(); ?>
				<li data-target="#home_carousel" data-slide-to="<?= get_row_index() - 1; ?>" <?= get_row_index() == 1 ? 'class="active"' : null ?>></li>
			<?php endwhile; ?>
		</ol>
		<?php endif; ?>
		<div class="carousel-inner">
		<?php while ( have_rows('slides') ) : the_row(); ?>
			<div class="carousel-item <?= get_row_index() == 1 ? 'active' : null ?>">
				<?php if(get_sub_field('video')): ?>
					<div class="embed-container full">
						<iframe class="lazy" data-src="<?= get_sub_field('video'); ?>?controls=0&autoplay=1&mute=1&rel=0&loop=1&showinfo=0" allow="autoplay; encrypted-media;" frameborder="0" allowfullscreen></iframe>
					</div>
				<?php else: 
					$mobileS = get_sub_field('image')['sizes']['medium'];
					$mobileL = get_sub_field('image')['sizes']['medium_large'];
					$tablet = get_sub_field('image')['sizes']['large'];
					?>
					<picture class="bg-cover">
						<source class="lazyset" media="(max-width: 400px)" data-srcset="<?= esc_url($mobileS); ?>">
						<source class="lazyset" media="(max-width: 720px)" data-srcset="<?= esc_url($mobileL); ?>">
						<source class="lazyset" media="(max-width: 1200px)" data-srcset="<?= esc_url($tablet); ?>">
						<source class="lazyset" data-srcset="<?= get_sub_field('image')['url']; ?>">
						<img class="bg-cover lazy" data-src="<?= get_sub_field('image')['url']; ?>" alt="<?= get_sub_field('image')['title']; ?>">
					</picture>
				<?php endif; ?>
				<?php if(get_sub_field('title') || get_sub_field('text') || get_sub_field('button')): ?>
				<div class="carousel-caption">
					<?php if(get_sub_field('title')): ?>
						<h1><?= get_sub_field('title'); ?></h1>
					<?php endif; ?>
					<?php if(get_sub_field('text')):
						get_sub_field('text');
					endif; ?>
					<?php if(get_sub_field('button')): ?>
						<a href="<?= get_sub_field('button')['url']; ?>" class="btn btn__border black box-shadow"><?= get_sub_field('button')['title']; ?></a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
		</div>
		<?php if(sizeof(get_field('slides')) > 1) : ?>
		<a class="carousel-control-prev" href="#home_carousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Poprzedni</span>
		</a>
		<a class="carousel-control-next" href="#home_carousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Następny</span>
		</a>
		<?php endif; ?>
	<?php endif; ?>
	</div>
</header>