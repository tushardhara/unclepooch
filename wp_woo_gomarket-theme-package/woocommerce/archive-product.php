<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>
	<!--<div class="top-page">
		<?php// dimox_breadcrumbs();?>
	</div>-->
	<?php do_action('wd_before_main_content'); ?>	
	
	<div id="container" class="page-template default-template">
		<div id="content" class="container" role="main">
			<div id="main">	
			
				<?php
					global $wd_data;	
					if( isset($wd_data) ){
						$_layout_config = explode("-",$wd_data['wd_prod_cat_layout']);
					}else{
						$_layout_config = array(0,1,0);
					}
					$_left_sidebar = (int)$_layout_config[0];
					$_right_sidebar = (int)$_layout_config[2];
					$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "span12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "span18" : "span24" );					
				?>
				
				<?php if( $_left_sidebar ): ?>
							<div id="left-sidebar" class="span6 hidden-phone">
								<div class="left-sidebar-content alpha omega">
								<?php
									if ( is_active_sidebar( $wd_data['wd_prod_cat_left_sidebar'] ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( $wd_data['wd_prod_cat_left_sidebar'] ); ?>
										</ul>
								<?php endif; ?>
								</div>
							</div><!-- end left sidebar -->
				<?php endif;?>	

				<div id="main_content" class="<?php echo $_main_class?>">
				
					<div>				
									
						<?php
							/**
							 * woocommerce_before_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
							 * @hooked woocommerce_breadcrumb - 20
							 */
							do_action('woocommerce_before_main_content');
						?>
							<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

								<h1 class="page-title heading-title"><?php woocommerce_page_title(); ?></h1>

							<?php endif; ?>

							<?php
								if( isset($wd_data['wd_prod_cat_custom_content']) && strlen($wd_data['wd_prod_cat_custom_content']) > 0 ){
									echo "<div class='cat_custom_content'>";
									echo do_shortcode (stripslashes(htmlspecialchars_decode( base64_decode($wd_data['wd_prod_cat_custom_content']) )) );
									echo "</div>";
								}
							?>
						
							
							

							<?php do_action( 'woocommerce_archive_description' ); ?>
						
							<?php 
								global $woocommerce_loop;
								$_old_woocommerce_loop = $woocommerce_loop;
							?>
						
							<ul class="archive-product-subcategories">	
								<?php ob_start();	?>
								<?php $show_sub_cat = woocommerce_product_subcategories(); ?>
								<?php echo $product_subcategories_html = ob_get_clean();?>
							</ul>	

							<?php 
								$woocommerce_loop = $_old_woocommerce_loop;
								if( absint($wd_data['wd_prod_cat_column']) > 0 ){
									$woocommerce_loop['columns'] = absint($wd_data['wd_prod_cat_column']);
								}
							?>
							
							<?php if ( have_posts() ) : ?>
								<div class="wd_meta_loop">
								<?php
									/**
									 * woocommerce_before_shop_loop hook
									 *
									 * @hooked woocommerce_result_count - 20
									 * @hooked woocommerce_catalog_ordering - 30
									 */
									
									do_action( 'woocommerce_before_shop_loop' );
								?>
								</div>
								<?php woocommerce_product_loop_start(); ?>
								
									<?php while ( have_posts() ) : the_post(); ?>

										<?php wc_get_template_part( 'content', 'product' ); ?>

									<?php endwhile; // end of the loop. ?>

								<?php woocommerce_product_loop_end(); ?>

								<?php
									/**
									 * woocommerce_after_shop_loop hook
									 *
									 * @hooked woocommerce_pagination - 10
									 */
									do_action( 'woocommerce_after_shop_loop' );
								?>

							<?php elseif ( ! $show_sub_cat ) : ?>

								<?php wc_get_template( 'loop/no-products-found.php' ); ?>

							<?php endif; ?>

						<?php
							/**
							 * woocommerce_after_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action('woocommerce_after_main_content');
						?>
	
					</div>

				</div>	
	
				<?php if( $_right_sidebar  ): ?>
							<div id="right-sidebar" class="span6">
								<div class="right-sidebar-content alpha omega">
								<?php
									if ( is_active_sidebar( $wd_data['wd_prod_cat_right_sidebar'] ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( $wd_data['wd_prod_cat_right_sidebar'] ); ?>
										</ul>
								<?php endif; ?>
								</div>
							</div><!-- end right sidebar -->
				<?php endif;?>	
				
			</div>
		</div>
	</div>
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action('woocommerce_sidebar');
	?>

<?php get_footer('shop'); ?>