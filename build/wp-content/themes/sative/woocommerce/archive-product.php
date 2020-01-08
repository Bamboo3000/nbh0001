<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>

<section class="products__list">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-11 col-12">
				<div class="row products__list-top justify-content-between align-items-start scene_element scene_element--fadeindown scene_element--delayed">
					<div class="col-xl-8 products__list-title">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1><?php woocommerce_page_title(); ?></h1>
					<?php endif; ?>
					</div>
					<div class="col-auto products__list-filter">
						<?php sative_catalog_ordering(); ?>
					</div>
				</div>
				<div class="row justify-content-center">

					<?php if ( woocommerce_product_loop() ) {

						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();
								wc_get_template_part( 'content', 'product' );
							}
						}

					} else {
						
						do_action( 'woocommerce_no_products_found' );

					} ?>

				</div>
			</div>
		</div>
		<div class="row justify-content-center mt-5 scene_element scene_element--fadeinup scene_element--delayed11">
			<div class="col-12 text-center">
				<a href="" class="btn btn__full">Ładuj więcej stuff'u!</a>
			</div>
			<?php do_action( 'woocommerce_after_shop_loop' ); ?>
		</div>
	</div>
</section>

<?php get_footer();