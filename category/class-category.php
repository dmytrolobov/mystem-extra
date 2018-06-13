<?php if ( ! defined( 'ABSPATH' ) ) exit;
	/**
		* MyStem Category Templates
		*
		* @package     MyStem Extra
		* @subpackage  
		* @copyright   Copyright (c) 2018, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	if( !class_exists( 'MyStem_Category_Temlates' ) ) {
		
		define( 'MyStem_Category_Temlates_Url', plugin_dir_url( __FILE__ ) );
		
		class MyStem_Category_Temlates {
			function __construct() {										
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );					
				add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );					
				add_action( 'category_add_form_fields', array( $this, 'add_meta_field' ), 10, 2 );
				add_action( 'post_tag_add_form_fields', array( $this, 'add_meta_field' ), 10, 2 );				
				add_action( 'category_edit_form_fields', array( $this, 'edit_meta_field' ), 10, 2 );
				add_action( 'post_tag_edit_form_fields', array( $this, 'edit_meta_field' ), 10, 2 );				
				add_action( 'edited_category', array( $this, 'save_meta_field' ), 10, 2 );  
				add_action( 'create_category', array( $this, 'save_meta_field' ), 10, 2 );
				add_action( 'edited_post_tag', array( $this, 'save_meta_field' ), 10, 2 );  
				add_action( 'create_post_tag', array( $this, 'save_meta_field' ), 10, 2 );				
				add_filter( 'category_template', array( $this, 'get_category_template' ) );
				add_filter( 'tag_template', array( $this, 'get_category_template' ) );				
				add_action( 'pre_get_posts', array( $this, 'number_posts' ) );				
				add_filter( 'single_template', array( $this, 'get_custom_post_type_template' ) );
			}
			
			
			function front_scripts() {
				wp_enqueue_style( 'mystem-category-temlates', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
			}
			
			function admin_scripts( $hook ) {
				// Load taxonomy and term pages
				if( $hook == 'edit-tags.php' ||  $hook == 'term.php' ) {		
					// font awesome stylesheet
					wp_enqueue_style( 'mystem-font-awesome', get_template_directory_uri() . '/font-awesome/css/fontawesome-all.min.css', array(), '5.0.11', 'all' );
					
					// include color picker
					wp_enqueue_style('wp-color-picker');
					wp_enqueue_script('wp-color-picker');
					
					// include icon picker
					wp_enqueue_script('mystem-fonticonpicker', get_template_directory_uri() . '/inc/assets/fonticonpicker/js/fonticonpicker.min.js', array('jquery'));
					
					wp_enqueue_style('mystem-fonticonpicker', get_template_directory_uri() . '/inc/assets/fonticonpicker/css/fonticonpicker.min.css');
					
					wp_enqueue_style('mystem-fonticonpicker-darkgrey', get_template_directory_uri() . '/inc/assets/fonticonpicker/css/fonticonpicker.darkgrey.min.css');
					
					// include script for taxonomy
					wp_enqueue_script( 'mystem-taxonomy', plugin_dir_url( __FILE__ ) . 'assets/js/taxonomy.js' );				
					
				}
				else{
					return;
				}
			}
			
			function add_meta_field() {
				// this will add the custom meta field to the add new term page
			?>			
			<div class="form-field">
				<label for="mystem_cat_meta[icon_field]"><?php _e( 'Icon', 'mystem-extra' ); ?></label>				
				<select class="iconpicker" name="mystem_cat_meta[icon_field]">
					<?php					
						$icons = mystem_fontawesome_icons();
						foreach ( $icons as $icon ){
							echo '<option>' . $icon . '</option>';
						}
					?>
				</select>
				<p class="description"><?php _e( 'Select the icon','mystem-extra' ); ?></p>
			</div>
			
			<div class="form-field">
				<label for="mystem_cat_meta[icon_color]"><?php _e( 'Icon color', 'mystem-extra' ); ?></label>
				<input type="text" name="mystem_cat_meta[icon_color]" value="#383838" class="color-picker-field">
				<p class="description"><?php _e( 'Select Icon color','mystem-extra' ); ?></p>
			</div>
			
			<div class="form-field">
				<label for="mystem_cat_meta[cat_template]"><?php _e('Category Template', 'mystem-extra'); ?></label>
				<select name="mystem_cat_meta[cat_template]">
					<option value='default'><?php _e('Default','mystem-extra'); ?></option>
					<option value='default-without-sidebar'><?php _e('Default without sidebar','mystem-extra'); ?></option>
					<option value='grid'><?php _e('Grid','mystem-extra'); ?></option>
					<option value='grid-third'><?php _e('Grid 3 column','mystem-extra'); ?></option>
					<option value='grid-without-sidebar'><?php _e('Grid without sidebar','mystem-extra'); ?></option>
					<option value='grid-without-sidebar-third'><?php _e('Grid without sidebar 3 column','mystem-extra'); ?></option>
					<option value='grid-without-sidebar-fourth'><?php _e('Grid without sidebar 4 column','mystem-extra'); ?></option>
					<option value='classic'><?php _e('Classic','mystem-extra'); ?></option>
					<option value='classic-without-sidebar'><?php _e('Classic without sidebar','mystem-extra'); ?></option>
				</select>
				<p class="description"><?php _e( 'Select a specific template for this category','mystem-extra' ); ?></p>		
			</div>
			
			<div class="form-field">
				<label for="mystem_cat_meta[hide_header]"><?php _e('Hide Header', 'mystem-extra'); ?></label>
				<input type="checkbox" name="mystem_cat_meta[hide_header]" value="1">
				<p class="description"><?php _e( 'Hide title and description','mystem-extra' ); ?></p>
			</div>
			
			<div class="form-field">
				<label for="mystem_cat_meta[number_posts]"><?php _e('Number posts', 'mystem-extra'); ?></label>
				<input type="number" name="mystem_cat_meta[number_posts]" step="1" class="small-text" value="<?php echo get_option('posts_per_page'); ?>" >
				<p class="description"><?php _e( 'Number posts of category','mystem-extra' ); ?></p>
			</div>	
			
			<div class="form-field">
				<label for="mystem_cat_meta[single_template]"><?php _e('Single Post Template', 'mystem-extra'); ?></label>
				<select name="mystem_cat_meta[single_template]">
					<option value='default'><?php _e('Default','mystem-extra'); ?></option>
					<option value='default-without-sidebar'><?php _e('Default without sidebar','mystem-extra'); ?></option>					
				</select>
				<p class="description"><?php _e( 'Select a specific template for this posts in category','mystem-extra' ); ?></p>		
			</div>
			
			<?php
			}
			
			function edit_meta_field($term) {
				
				// put the term ID into a variable
				$t_id = $term->term_id;
				
				// retrieve the existing value(s) for this meta field. This returns an array
			$mystem_cat_meta = get_option( "mystem_taxonomy_$t_id" ); ?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="mystem_cat_meta[icon_field]"><?php _e( 'Icon', 'mystem-extra' ); ?></label></th>
				<td>
					<select class="iconpicker" name="mystem_cat_meta[icon_field]">
						<?php					
							$sel_icon = esc_attr( $mystem_cat_meta['icon_field'] ) ? esc_attr( $mystem_cat_meta['icon_field'] ) : '';
							$icons = mystem_fontawesome_icons();
							foreach ( $icons as $icon ){
								echo '<option' . selected( $sel_icon, $icon ) . '>' . $icon . '</option>';						
							}
						?>
					</select>
					<p class="description"><?php _e( 'Select the icon','mystem-extra' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="mystem_cat_meta[icon_color]"><?php _e( 'Icon color', 'mystem-extra' ); ?></label></th>
				<td>
					<input type="text" name="mystem_cat_meta[icon_color]" value="<?php echo esc_attr(!empty( $mystem_cat_meta['icon_color'] ) ) ? esc_attr( $mystem_cat_meta['icon_color'] ) : '#383838'; ?>" class="color-picker-field">
					<p class="description"><?php _e( 'Select Icon color','mystem-extra' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="mystem_cat_meta[cat_template]"><?php _e('Category Template', 'mystem-extra'); ?></label></th>
				<td>
					<select name="mystem_cat_meta[cat_template]">
						<?php					
							$sel_cat = esc_attr( $mystem_cat_meta['cat_template'] ) ? esc_attr( $mystem_cat_meta['cat_template'] ) : 'default';					
						?>
						<option value='default' <?php selected( $sel_cat, 'default' ); ?>><?php _e('Default','mystem-extra'); ?></option>
						<option value='default-without-sidebar' <?php selected( $sel_cat, 'default-without-sidebar' ); ?>><?php _e('Default without sidebar','mystem-extra'); ?></option>
						<option value='grid' <?php selected( $sel_cat, 'grid' ); ?>><?php _e('Grid','mystem-extra'); ?></option>
						<option value='grid-third' <?php selected( $sel_cat, 'grid-third' ); ?>><?php _e('Grid 3 column','mystem-extra'); ?></option>
						<option value='grid-without-sidebar' <?php selected( $sel_cat, 'grid-without-sidebar' ); ?>><?php _e('Grid without sidebar','mystem-extra'); ?></option>
						<option value='grid-without-sidebar-third' <?php selected( $sel_cat, 'grid-without-sidebar-third' ); ?>><?php _e('Grid without sidebar 3 column','mystem-extra'); ?></option>
						<option value='grid-without-sidebar-fourth' <?php selected( $sel_cat, 'grid-without-sidebar-fourth' ); ?>><?php _e('Grid without sidebar 4 column','mystem-extra'); ?></option>
						<option value='classic' <?php selected( $sel_cat, 'classic' ); ?>><?php _e('Classic','mystem-extra'); ?></option>
						<option value='classic-without-sidebar' <?php selected( $sel_cat, 'classic-without-sidebar' ); ?>><?php _e('Classic without sidebar','mystem-extra'); ?></option>
						
					</select>
					<p class="description"><?php _e( 'Select a specific template for this category','mystem-extra' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="mystem_cat_meta[hide_header]"><?php _e('Hide Header', 'mystem-extra'); ?></label></th>
				<td>
					<?php $hide_header = !empty( $mystem_cat_meta['hide_header'] ) ? 1 : 0; ?>
					<input type="checkbox" name="mystem_cat_meta[hide_header]" value="1"<?php checked( $hide_header ); ?>>
					<p class="description"><?php _e( 'Hide title and description','mystem-extra' ); ?></p>
				</td>	
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="mystem_cat_meta[number_posts]"><?php _e('Number posts', 'mystem-extra'); ?></label></th>
				<td>
					<input type="number" name="mystem_cat_meta[number_posts]" step="1" class="small-text" value="<?php echo esc_attr(!empty( $mystem_cat_meta['number_posts'] ) ) ? esc_attr( $mystem_cat_meta['number_posts'] ) : get_option('posts_per_page'); ?>" >
					<p class="description"><?php _e( 'Number posts of category','mystem-extra' ); ?></p>
				</td>	
			</tr>
			
			<tr class="form-field">
				<th scope="row" valign="top"><label for="mystem_cat_meta[single_template]"><?php _e('Single Post Template', 'mystem-extra'); ?></label></th>
				<td>
					<select name="mystem_cat_meta[single_template]">
						<?php					
							$sel_cat = esc_attr( $mystem_cat_meta['single_template'] ) ? esc_attr( $mystem_cat_meta['single_template'] ) : 'default';					
						?>
						<option value='default' <?php selected( $sel_cat, 'default' ); ?>><?php _e('Default','mystem-extra'); ?></option>
						<option value='default-without-sidebar' <?php selected( $sel_cat, 'default-without-sidebar' ); ?>><?php _e('Default without sidebar','mystem-extra'); ?></option>
						
					</select>
					<p class="description"><?php _e( 'Select a specific template for this posts in category','mystem-extra' ); ?></p>
				</td>
			</tr>
			
			<?php
			}
			
			function save_meta_field( $term_id ) {
				if ( isset( $_POST['mystem_cat_meta'] ) ) {
					$t_id = $term_id;
					$mystem_cat_meta = get_option( "mystem_taxonomy_$t_id" );
					$cat_keys = array_keys( $_POST['mystem_cat_meta'] );
					foreach ( $cat_keys as $key ) {
						if ( isset ( $_POST['mystem_cat_meta'][$key] ) ) {
							$mystem_cat_meta[$key] = $_POST['mystem_cat_meta'][$key];
						}						
					}
					if ( !isset ( $_POST['mystem_cat_meta']['hide_header'] ) ) { 
						$mystem_cat_meta['hide_header'] = 0;
					}
					// Save the option array.
					update_option( "mystem_taxonomy_$t_id", $mystem_cat_meta );
				}
			} 
			
			function get_category_template( $category_template ) {
				$cat_ID = absint( get_queried_object()->term_id );
				$cat_meta = get_option( 'mystem_taxonomy_'.$cat_ID );
				if ( isset( $cat_meta['cat_template'] ) ) {
					$temp = plugin_dir_path( __FILE__ ) . 'template/'.$cat_meta['cat_template'].'.php';
					if ( !empty( $temp ) ) {
						return $temp;
					}					
				}
				return $category_template;
			}			
			
			function number_posts($query) {
				if ( $query->is_category || $query->is_tag ) {
					$cat_ID = absint( get_queried_object()->term_id );
					$cat_meta = get_option( 'mystem_taxonomy_'.$cat_ID );
					$number_posts = !empty( $cat_meta['number_posts'] ) ? $cat_meta['number_posts'] : get_option('posts_per_page');
					$query->set('posts_per_page',$number_posts);
				}
			}
			
			function get_custom_post_type_template($single_template) {
				global $post;
				if ($post->post_type == 'post') {
					$categories = get_the_category( $post->ID );				
					$cat_ID = absint( $categories[0]->cat_ID );
					$cat_meta = get_option( 'mystem_taxonomy_'.$cat_ID );				
					if ( isset( $cat_meta['single_template'] ) && $cat_meta['single_template'] != 'default' ) {
						$temp = plugin_dir_path( __FILE__ ) . 'single-template/'.$cat_meta['single_template'].'.php';
						if ( !empty( $temp ) ) {
							return $temp;
						}					
					}
				}
				return $single_template;
				
			}
			
		}
		
	}				