<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$attachment_ids = $product->get_gallery_image_ids();

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<section class="products__single" id="product-<?php the_ID(); ?>">
	<div class="container">
        <?php if( $product->is_on_sale() ) : ?>
            <h4 class="text-size-xxxxlarge onsale">
                On Sale!
            </h4>
        <?php endif; ?>
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-7 col-md-10">
                <div id="product_carousel" class="products__single-slider carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-toggle="modal" data-target="#sliderZoomModal" data-zoom="zoom0">
                            <img data-src="<?= get_the_post_thumbnail_url('', 'size640') ?>" alt="" class="bg-cover lazy">
                        </div>
                        <?php foreach ( $attachment_ids as $key => $attachment_id ) : ?>
                            <div class="carousel-item" data-toggle="modal" data-target="#sliderZoomModal" data-zoom="zoom<?= $key + 1; ?>">
                                <img data-src="<?= wp_get_attachment_image_url($attachment_id, 'size640'); ?>" alt="" class="bg-cover lazy">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if(count($attachment_ids) >= 1): ?>
                    <ol class="carousel-indicators">
                        <li data-target="#product_carousel" data-slide-to="0" class="active">
                            <img data-src="<?= get_the_post_thumbnail_url('', 'thumbnail') ?>" alt="" class="bg-cover lazy">
                        </li>
                        <?php foreach ( $attachment_ids as $key => $attachment_id ) : ?>
                            <li data-target="#product_carousel" data-slide-to="<?= $key + 1; ?>">
                                <img data-src="<?= wp_get_attachment_image_url($attachment_id, 'thumbnail'); ?>" alt="" class="bg-cover lazy">
                            </li>
                        <?php endforeach; ?>
                    </ol>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-5 col-md-8 products__single-text">
                <?php
                    $marki = get_the_terms(get_the_ID(), 'marka')[0]; 
                    if($marki) :
                ?>
                <h2 class="text-size-small text-bold text-tertiary text-upper nomargin">
                    <a href="<?= get_term_link($marki); ?>"><?= $marki->name; ?></a>
                </h2>
                <?php endif; ?>
                <h1 class="text-upper mt-1">
                    <?= get_the_title(); ?>
                </h1>
                <?php if( $product->is_on_sale() ) : ?>
                <h3 class="price text-size-xxxlarge" style="color: red;">
                    <small><?= wc_price($product->get_regular_price()); ?></small>
                    <?= wc_price(get_post_meta( get_the_ID(), '_price', true )); ?>
                </h3>
                <?php else: ?>
                <h3 class="price text-grey3 text-size-xxxlarge">
                    <?= wc_price(get_post_meta( get_the_ID(), '_price', true )); ?>
                </h3>
                <?php endif; ?>
                <?= wc_get_stock_html( $product ); ?>
                <?php if($product->is_in_stock()): ?>
                <div class="addtocart">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>
                <div class="shipping">
                    <i class="fas fa-shipping-fast text-size-xxxlarge"></i>
                    <span class="text-size-normal text-bold">
                        Mordo, będzie szybko!<br/>
                        <strong>24h</strong> i towar jest u Ciebie! *
                    </span>
                </div>
                <?php else: ?>
                    <?php get_template_part( 'template-parts/oosproduct', 'form' ); ?>
                    <script>
                        $(document).ready(function() {
                            $('#productformslug').val('<?= get_the_title(); ?> | <?= $product->get_slug(); ?>');
                        });
                    </script>
                <?php endif; ?>
            </div>
        </div>
    </div> 
    <div class="products__single-more">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <?php 
                            if(get_the_content()){
                                $notactiveC = false;
                            } else {
                                $notactiveC = true;
                            } 

                            if ($product->has_attributes() || $product->has_dimensions() || $product->has_weight()) {
                                $notactiveT = false;
                            } else {
                                $notactiveT = true;
                            }
                        ?>
                        <?php if($notactiveC == false): ?>
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Opis stuff'u</a>
                        <?php endif; ?>
                        <?php if ($notactiveT == false): ?>
                        <a class="nav-item nav-link <?= $notactiveC ? 'active' : null; ?>" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Technikalia</a>
                        <?php endif; ?>
                        <a class="nav-item nav-link <?= $notactiveC && $notactiveT ? 'active' : null; ?>" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Opinie mordeczek</a>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <?php if($notactiveC == false): ?>
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <?php the_content(); ?>
                        </div>
                        <?php endif; ?>
                        <?php if($notactiveT == false): ?>
                        <div class="tab-pane fade <?= $notactiveC ? 'show active' : null; ?>" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <?php do_action( 'woocommerce_product_additional_information', $product ); ?>
                        </div>
                        <?php endif; ?>
                        <div class="tab-pane fade <?= $notactiveC && $notactiveT ? 'show active' : null; ?>" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div id="reviews" class="woocommerce-Reviews">
                                <div id="comments">
                                    <h2 class="woocommerce-Reviews-title">
                                        <?php
                                        $count = $product->get_review_count();
                                        if ( $count && wc_review_ratings_enabled() ) {
                                            /* translators: 1: reviews count 2: product name */
                                            $reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
                                            echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
                                        } 
                                        ?>
                                    </h2>

                                    <?php if ( have_comments() ) : ?>
                                        <ol class="commentlist">
                                            <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
                                        </ol>

                                        <?php
                                        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                                            echo '<nav class="woocommerce-pagination">';
                                            paginate_comments_links(
                                                apply_filters(
                                                    'woocommerce_comment_pagination_args',
                                                    array(
                                                        'prev_text' => '&larr;',
                                                        'next_text' => '&rarr;',
                                                        'type'      => 'list',
                                                    )
                                                )
                                            );
                                            echo '</nav>';
                                        endif;
                                        ?>
                                    <?php else : ?>
                                        <p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
                                    <?php endif; ?>
                                </div>

                                <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
                                    <div id="review_form_wrapper">
                                        <div id="review_form">
                                            <?php
                                            $commenter    = wp_get_current_commenter();
                                            $comment_form = array(
                                                /* translators: %s is product title */
                                                'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
                                                /* translators: %s is product title */
                                                'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
                                                'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
                                                'title_reply_after'   => '</span>',
                                                'comment_notes_after' => '',
                                                'label_submit'        => esc_html__( 'Submit', 'woocommerce' ),
                                                'logged_in_as'        => '',
                                                'comment_field'       => '',
                                            );

                                            $name_email_required = (bool) get_option( 'require_name_email', 1 );
                                            $fields              = array(
                                                'author' => array(
                                                    'label'    => __( 'Name', 'woocommerce' ),
                                                    'type'     => 'text',
                                                    'value'    => $commenter['comment_author'],
                                                    'required' => $name_email_required,
                                                ),
                                                'email' => array(
                                                    'label'    => __( 'Email', 'woocommerce' ),
                                                    'type'     => 'email',
                                                    'value'    => $commenter['comment_author_email'],
                                                    'required' => $name_email_required,
                                                ),
                                            );

                                            $comment_form['fields'] = array();

                                            foreach ( $fields as $key => $field ) {
                                                $field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
                                                $field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

                                                if ( $field['required'] ) {
                                                    $field_html .= '&nbsp;<span class="required">*</span>';
                                                }

                                                $field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

                                                $comment_form['fields'][ $key ] = $field_html;
                                            }

                                            $account_page_url = wc_get_page_permalink( 'myaccount' );
                                            if ( $account_page_url ) {
                                                /* translators: %s opening and closing link tags respectively */
                                                $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
                                            }

                                            if ( wc_review_ratings_enabled() ) {
                                                $comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . '</label><select name="rating" id="rating" required>
                                                    <option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
                                                    <option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
                                                    <option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
                                                    <option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
                                                    <option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
                                                    <option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
                                                </select></div>';
                                            }

                                            $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

                                            comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                                            ?>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
                                <?php endif; ?>

                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="products__single-share">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="text-upper title">Udostępniaj to ziom:</h4>
                        </div>
                        <div class="col-auto">
                            <?php
                                global $wp;
                                $sh_url = home_url( add_query_arg( array(), $wp->request ) );
                                $sh_title = get_the_title();
                                $sh_img = get_the_post_thumbnail_url('', 'size640');
                            ?>
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/sharer.php?u=<?= $sh_url; ?>" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="" target="_blank">
                                        <i class="fab fa-facebook-messenger"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="whatsapp://send?text=Obczaj%20to:%20<?= $sh_url; ?>" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/share?url=<?= $sh_url; ?>&text=<?= $sh_title; ?>&hashtags=nbhdskate" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://pinterest.com/pin/create/bookmarklet/?media=<?= $sh_img; ?>&url=<?= $sh_url; ?>&description=<?= $sh_title; ?>" target="_blank">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.linkedin.com/shareArticle?url=<?= $sh_url; ?>&title=<?= $sh_title; ?>" target="_blank">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:?subject=Obczaj to ziom!&body=<?= $sh_url; ?>" target="_blank">
                                        <i class="fas fa-at"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php woocommerce_output_related_products(); ?>

<!-- Modal -->
<div class="products__single-modal modal fade" id="sliderZoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body" data-zoom="zoom0">
                <img data-src="<?= get_the_post_thumbnail_url('', 'full') ?>" alt="" class="bg-cover lazy">
            </div>
            <?php foreach ( $attachment_ids as $key => $attachment_id ) : ?>
                <div class="modal-body" data-zoom="zoom<?= $key + 1; ?>">
                    <img data-src="<?= wp_get_attachment_image_url($attachment_id, 'full'); ?>" alt="" class="bg-cover lazy">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
