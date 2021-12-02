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

		add_action('woocommerce_checkout_update_order_meta', array( $this, 'saveOrderDeliveryDate'), 10, 1 );
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
		woocommerce_form_field( 'lmtzex_delivery_date', array(
			'type'          => 'text',
			'class'         => array('my-field-class form-row-wide off'),
			'id'            => 'lmtzex_delivery_date',
			'required'      => true,
			'label'         => __('Entrega'),
			'placeholder'   => __('Selecione data e horário'),
			'options'       => array('' => __('', 'woocommerce' ))
		), $_POST['lmtzex_delivery_date']);

		echo '</div>';
	}

	/**
	 * Script para manipular o datetimerpicker
	 * 
	 */
	public function checkoutDeliveryJqueryScript() {
		// Only on front-end and checkout page
		if( is_checkout() || is_cart() && !is_wc_endpoint_url() ):
			
			# Actived settings
			$isActivated 		= get_option( '_lmrtz_period_active', true );
	
			# Definição dos dias ativados e desativados
			$enabledWeekDays 	= array();
			$disabledWeekDays 	= array();
			$weekDays 		 	= array(
				'sunday'	=> '0',
				'monday'	=> '1',
				'tuesday'	=> '2',
				'wednesday'	=> '3',
				'thursday'	=> '4',
				'friday'	=> '5',
				'saturday'	=> '6',
			);
			$keysOfWeek 		= array(
				'sunday'	=> '_lmrtz_delivery_active_sunday',
				'monday'	=> '_lmrtz_delivery_active_monday',
				'tuesday'	=> '_lmrtz_delivery_active_tuesday',
				'wednesday'	=> '_lmrtz_delivery_active_wednesday',
				'thursday'	=> '_lmrtz_delivery_active_thursday',
				'friday'	=> '_lmrtz_delivery_active_friday',
				'saturday'	=> '_lmrtz_delivery_active_saturday',
			);
			foreach( $keysOfWeek as $day => $key ){
				$data = get_option( $key, true );
				if( $data ){
					$enabledWeekDays[] = $day;
				} else {
					$disabledWeekDays[] = (int) $weekDays[$day];
				}
			}
			$disabledWeekDays = json_encode( $disabledWeekDays );

			# Definição de horários ativados
			$deliveryStartHour 	= get_option( '_lmtzex_delivery_start_hour', true );
			$deliveryStartMin 	= get_option( '_lmtzex_delivery_start_min', true );
			$deliveryStart 		= $deliveryStartHour . ':' . $deliveryStartMin;

			$deliveryEndHour 	= get_option( '_lmtzex_delivery_end_hour', true );
			$deliveryEndMin 	= get_option( '_lmtzex_delivery_end_min', true );
			$deliveryEnd 		= $deliveryEndHour . ':' . $deliveryEndMin;

			$hours 				= array(
				'00:00',
				'00:30',
				'01:00',
				'01:30',
				'02:00',
				'02:30',
				'03:00',
				'03:30',
				'04:00',
				'04:30',
				'05:00',
				'05:30',
				'06:00',
				'06:30',
				'07:00',
				'07:30',
				'08:00',
				'08:30',
				'09:00',
				'09:30',
				'10:00',
				'10:30',
				'11:00',
				'11:30',
				'12:00',
				'12:30',
				'13:00',
				'13:30',
				'14:00',
				'14:30',
				'15:00',
				'15:30',
				'16:00',
				'16:30',
				'17:00',
				'17:30',
				'18:00',
				'18:30',
				'19:00',
				'19:30',
				'20:00',
				'20:30',
				'21:00',
				'21:30',
				'22:00',
				'22:30',
				'23:00',
				'23:30',
			);
			$posStartHour 		= array_search( $deliveryStart, $hours );
			$posEndHour 		= array_search( $deliveryEnd, $hours);
			$deliveryHours 		= json_encode( array_slice( $hours, $posStartHour, ( $posEndHour+1 - $posStartHour ) ) );

			# Habilitado entrega no mesmo dia
			$isSameDayActivated 	= get_option( '_lmrtz_same_day_delivery', true );
			$sameDayHourLimit 		= get_option( '_lmrtz_same_day_delivery_hour_limit', true );
			$sameDayMinLimit 		= get_option( '_lmrtz_same_day_delivery_min_limit', true );
			$sameDayLimit 			= $sameDayHourLimit . ':' . $sameDayMinLimit;
			
			# Definição de datas desabilitadas
			$disabledDates 			= array(); # Dias da semana
			$currentHour			= date_i18n( 'H:i' );
			$currentDate 			= date_i18n( 'd/m/Y' );
			$isEnabledSameDay 		= 1; # 0=não/1=sim
			if( $currentHour > $sameDayLimit ){
				$isEnabledSameDay 	= 0;
				$disabledDates[]	= $currentDate;
			}
			$daysOff 				= get_option( '_lmtzex_daysoff', true );
			$daysOffArr 			= array_filter( explode(',', $daysOff ) );
			foreach( $daysOffArr as $dayOff )
			{
				$disabledDates[] = trim($dayOff);
			}
			$disabledDates 		= json_encode( $disabledDates );

			$holidaysColor 		= get_option( '_lmtzex_color_holidays', true );
			$hourLimitColor		= get_option( '_lmtzex_color_hour_limit', true );
			$availableColor 	= get_option( '_lmtzex_color_available', true );

			?>
			<script>
			jQuery.datetimepicker.setLocale('pt-BR');
			jQuery(function($){
				var d = '#datetimepicker',
					f = d+'_field',
					hours = <?php echo $deliveryHours; ?>,
					disabledWeekdays = <?php echo $disabledWeekDays; ?>,
					disabledDatesList = <?php echo $disabledDates; ?>;
					
				$(d).datetimepicker({
					format: 'd.m.Y H:i',
					allowTimes: hours,
					disabledWeekDays: disabledWeekdays,
					disabledDates: disabledDatesList,
					formatDate: 'd/m/Y',
					minDate: '-1970/01/1',
					setLocale: 'pt-BR'
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

	/**
	 * Salvar o valor do input do datetimepicker no pedido
	 * 
	 * @param integer $order_id
	 */	
	public function saveOrderDeliveryDate( $order_id ) {
		if( !empty( $_POST['lmtzex_delivery_date'] ) )
			update_post_meta( $order_id, 'lmtzex_delivery_date', sanitize_text_field( $_POST['lmtzex_delivery_date'] ) );
	}

}
