<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://ernestoarellano.dev
 * @since      1.0.0
 *
 * @package    Brm_Testimonials
 * @subpackage Brm_Testimonials/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Brm_Testimonials
 * @subpackage Brm_Testimonials/admin
 * @author     Ernesto Arellano <ernesto@bigrigmedia.net>
 */
class Brm_Testimonials_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/brm-testimonials-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/brm-testimonials-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register custom post types 
	 * 
	 * @since 1.0.0
	 * @link 	https://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_types() {
		register_post_type( $this->post_type, [
      'label'               	=> 'Testimonials',
      'public'              	=> false,
      'publicly_queryable'  	=> false,
      'show_ui'             	=> true,
      'show_in_menu'        	=> true,
      'query_var'           	=> true,
      'rewrite'             	=> [ 'slug' => 'testimonials', 'with_front' => false ],
      'capability_type'     	=> 'post',
      'has_archive'         	=> false,
      'hierarchical'        	=> false,
      'menu_position'       	=> null,
      'menu_icon'           	=> 'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#a0a5aa" d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288zM325.8 240.2C308.5 260.4 283.1 272 256 272s-52.5-11.6-69.8-31.8c-8.6-10.1-23.8-11.3-33.8-2.7s-11.2 23.8-2.7 33.8c26.5 31 65.2 48.7 106.3 48.7s79.8-17.8 106.2-48.7c8.6-10.1 7.4-25.2-2.7-33.8-10-8.6-25.1-7.4-33.7 2.7zM192 192c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm128 0c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32z"/></svg>' ),
			'supports'            	=> [ 'editor','title' ]
		] );
	}

	/**
	 * Register custom post type taxonomies
	 * 
	 * @since 1.0.0
	 * @link	https://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	public function register_post_taxonomies() {
		$taxonomies = [
      'Source' => [
        'public'        => false,
        'label'         => 'Source',
        'url'           => 'source',
        'hierarchical'  => true,
        'parent'        => $this->post_type
      ]
    ];

    if ( !empty($taxonomies) ) {
      foreach ( $taxonomies as $key => $taxonomy ) {
        // Taxonomy variables
        $taxonomy_string    = str_replace( ' ', '_', strtolower( $key ) );
        $label              = ucwords( $taxonomy['label'] );
        $rewrite_url        = $taxonomy['url'];
        $public             = $taxonomy['public'];
        $hierarchical       = $taxonomy['hierarchical'];
        $parent             = $taxonomy['parent'];

        register_taxonomy(
          $taxonomy_string,
          $parent,
          [
            'label'         => $label,
            'public'        => $public,
            'show_ui'       => true,
            'rewrite'       => [ 'slug' => $rewrite_url, 'with_front' => false ],
            'hierarchical'  => $hierarchical
          ]
        );
      }
    }
	}

}
