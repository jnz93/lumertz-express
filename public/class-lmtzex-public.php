<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       unitycode.tech
 * @since      1.0.0
 *
 * @package    Lmtzex
 * @subpackage Lmtzex/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Lmtzex
 * @subpackage Lmtzex/public
 * @author     jnz93 <box@unitycode.tech>
 */
class Lmtzex_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'woocommerce_before_cart_table', array( $this, 'displayCustomCheckoutField' ), 10, 1 );
		add_action( 'wp_footer', array( $this, 'checkoutDeliveryJqueryScript' ) );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lmtzex-public.css', array(), $this->version, 'all' );

		if( is_checkout() || is_cart() ){
			wp_enqueue_style( 'datetimepicker', plugin_dir_url( __FILE__ ) . 'css/jquery.datetimepicker.min.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lmtzex-public.js', array( 'jquery' ), $this->version, false );

		if( is_checkout() || is_cart() ){
			wp_enqueue_script( 'datetimepicker', plugin_dir_url( __FILE__ ) . 'js/jquery.datetimepicker.full.min.js', array( 'jquery' ), $this->version, false );
		}

	}

	/**
	 * Mostrar o datepicker no carrinho e checkout
	 * 
	 * @param object $checkout
	 */
	public function displayCustomCheckoutField( $checkout )
	{
		# Define time zone
		date_default_timezone_set( 'America/Sao_Paulo' );

		echo '<div id="my_custom_checkout_field">
		<h3>'.__('Agendar entrega: ').'</h3>';

		# Hide datetimepicker container field
		// echo '<style>.shipping__table, .shipping__table--multiple{ display: none;}</style>';

		// DateTimePicker
		woocommerce_form_field( 'delivery_date', array(
			'type'          => 'text',
			'class'         => array('my-field-class form-row-wide off'),
			'id'            => 'datetimepicker',
			'required'      => true,
			'label'         => __('Selecione uma data'),
			'placeholder'   => __(''),
			'options'       => array('' => __('', 'woocommerce' ))
		),'');

		echo '</div>';
	}

	/**
	 * Script para manipular o datetimerpicker
	 * 
	 */
	public function checkoutDeliveryJqueryScript() {
		// Only on front-end and checkout page
		if( is_checkout() || is_cart() && !is_wc_endpoint_url() ):
		?>
		<script>
		jQuery(function($){
			var d = '#datetimepicker',
				f = d+'_field',
				hours = ['11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30'];
	
			// $(f).hide();
		
			$(d).datetimepicker({
				format: 'd.m.Y H:i',
				allowTimes: hours,
				minDate:'-1970/01/1',
				minTime:'12:00',
			});

			$(d).change( function(){
				if( jQuery(this).val() != '' ){
					jQuery('.shipping__table, .shipping__table--multiple').show();
				} else {
					jQuery('.shipping__table, .shipping__table--multiple').hide();
				}
			});
		});
		</script>
		<?php
	
		endif;
	}
}
