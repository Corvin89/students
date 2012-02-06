<!-- start footer -->
						</div>
					</div>
				</div><!-- #main -->

				<footer <?php $this->classes('footer'); ?> role="contentinfo">
<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with three columns of widgets.
	 * file should be named sidebar-footer.php
	 */
	//$this->get_sidebar( 'footer' );
?>
					<div  <?php $this->classes('* site-generator'); ?>>
						<a style='color: #555;font-weight: bold;' href="<?php echo esc_url( 'http://blog.mailpress.org/' ); ?>" title="<?php esc_attr_e( 'The WordPress Mailing Plugin' ); ?>"><?php printf( 'Proudly mailed by %s', 'MailPress' ); ?></a>
					</div>
				</footer><!-- #colophon -->
			</div><!-- #page -->
<?php if (isset($this->args->unsubscribe)) { ?>
			<div <?php $this->classes('mail_link'); ?>>
				<a href='{{unsubscribe}}'  <?php $this->classes('mail_link_a a'); ?>>Manage your subscriptions</a>
			</div>
<?php } ?>
		</div><!-- #body -->
	</body>
</html><?php 
remove_filter( 'wp_nav_menu', 				array('MP_theme_2011_html', 'wp_nav_menu'));
remove_filter( 'wp_page_menu', 				array('MP_theme_2011_html', 'wp_nav_menu'));
remove_filter( 'comments_popup_link_attributes', 	array('MP_theme_2011_html', 'comments_popup_link_attributes') );
remove_filter( 'the_category', 				array('MP_theme_2011_html', 'the_category') );
remove_filter( 'term_links-post_tag', 			array('MP_theme_2011_html', 'term_links_post_tag') );