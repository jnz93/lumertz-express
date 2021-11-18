<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       unitycode.tech
 * @since      1.0.0
 *
 * @package    Lmtzex
 * @subpackage Lmtzex/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Lmtzex
 * @subpackage Lmtzex/admin
 * @author     jnz93 <box@unitycode.tech>
 */
class Lmtzex_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		/**
		 * Adição da página de configuração no menu wordpress
		 *
		 */
		add_action( 'admin_menu', array( $this, 'registerSettingsMenuPage') );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Lmtzex_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lmtzex_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lmtzex-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Lmtzex_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lmtzex_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lmtzex-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * 
	 */
	public function registerSettingsMenuPage()
	{
		# Configurações
		$page_title = 'Lummertz Express - Configurações';
		$menu_title = 'Lummertz Express';
		$menu_slug 	= 'lummertz-express';
		$capability = '5';
		$icon_url 	= plugin_dir_url( __FILE__ ) . 'img/delivery-icon.png';
		$position 	= 20;

		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, array( $this, 'importSettingsPage' ), $icon_url, $position );
	}

	/**
	 * Importação do layout da página de administração do plugin
	 * 
	 */
	public function importSettingsPage()
	{
		require_once plugin_dir_path( __FILE__ ) . 'partials/lmtzex-admin-display.php';
	}


}
