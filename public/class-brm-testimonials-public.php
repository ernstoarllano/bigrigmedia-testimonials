<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://ernestoarellano.dev
 * @since      1.0.0
 *
 * @package    Brm_Testimonials
 * @subpackage Brm_Testimonials/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Brm_Testimonials
 * @subpackage Brm_Testimonials/public
 * @author     Ernesto Arellano <ernesto@bigrigmedia.net>
 */
class Brm_Testimonials_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * 
	 * @since		1.0.0
	 * @access	protected
	 * @var			string		 $post_type		The post type of the plugin.
	 */
	private $post_type;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.0.0
	 * @param   string	$plugin_name	The name of this plugin.
	 * @param   string  $version    	The version of this plugin.
	 * @param		string	$post_type		The post type of this plugin.
	 */
	public function __construct( $plugin_name, $version, $post_type ) {
		
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->post_type = $post_type;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/brm-testimonials-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/brm-testimonials-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Shortcode to display testimonials
	 * 
	 * @since 1.0.0
	 */
	public function testimonials_shortcode() {
		$data = new \WP_Query([
			'post_type' 			=> $this->post_type,
			'posts_per_page' 	=> -1
		]);

		if ( $data->have_posts() ) {
			$posts = $data->posts;

			$output = '';

			foreach ( $posts as $post ) {
				$terms = get_the_terms( $post, 'source' );
				$title = !empty( $terms ) ? $post->post_title .' &#124; '. $terms[0]->name : $post->post_title;

				$output .= '<blockquote class="testimonial">
										 '.apply_filters('the_content', $post->post_content).'
										 <footer>
										 	<cite>'.$title.'</cite>
										 </footer>
									 </blockquote>';
			}

			return '<div class="testimonials js-testimonials">'.$output.'</div>';
		}

		return;
	}

}
