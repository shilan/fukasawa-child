<?php get_header(); ?>

<div class="content">
																	                    
	<?php 

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$archive_title = '';
	$archive_subtitle = '';

	if ( is_archive() ) {
		$archive_title = get_the_archive_title();
	} elseif ( is_search() ) {
		$archive_title = sprintf( _x( 'Search results: "%s"', 'Variable: search query text', 'fukasawa' ), get_search_query() );
	} elseif ( $paged > 1 ) {
		$archive_title = sprintf( __( 'Page %1$s of %2$s', 'fukasawa' ), $paged, $wp_query->max_num_pages );
	}

	if ( ( is_archive() || is_search() ) && 1 < $wp_query->max_num_pages ) {
		$archive_subtitle = sprintf( __( 'Page %1$s of %2$s', 'fukasawa' ), $paged, $wp_query->max_num_pages );
	}

	$archive_description = get_the_archive_description();

	if ( $archive_title ) : ?>

		<div class="page-title">
			
			<div class="section-inner clear">
	
				<h1 class="archive-title">
					<?php 
					echo $archive_title;
					
					if ( $archive_subtitle ) {
						echo '<span class="archive-subtitle">' . $archive_subtitle . '</span>';
					} 
					?>
					
				</h1>

				<?php if ( $archive_description ) : ?>

					<div class="archive-description">
						<?php echo wp_kses_post( wpautop( $archive_description ) ); ?>
					</div><!-- .archive-description -->

				<?php endif; ?>
						
			</div><!-- .section-inner -->
			
		</div><!-- .page-title -->

	<?php endif; ?>

	<?php if ( have_posts() ) : ?>

		<div class="posts fade-in-image" id="posts">
				
			<?php 
			
			while ( have_posts() ) : the_post();
				$template_part_name = get_post_type() == 'post' ? get_post_format() : get_post_type();
				get_template_part( 'content', $template_part_name );
			endwhile; 

			?>
		
		</div><!-- .posts -->

		<?php get_template_part( 'pagination' ); ?>

	<?php elseif ( is_search() ) : ?>

		<div class="post-content">
        	            
            <p><?php _e( "We couldn't find any results for your search query. You can give it another try through the search form below.", 'fukasawa' ); ?></p>
            
            <?php get_search_form(); ?>
            
        </div><!-- .post-content -->

	<?php endif; ?>
		
</div><!-- .content -->
	              	        
<?php get_footer(); ?>