<?php
/**
 * WooCommerce Braintree Gateway
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@woocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Braintree Gateway to newer
 * versions in the future. If you wish to customize WooCommerce Braintree Gateway for your
 * needs please refer to http://docs.woocommerce.com/document/braintree/
 *
 * @package   WC-Braintree/Gateway/PayPal
 * @author    WooCommerce
 * @copyright Copyright: (c) 2016-2017, Automattic, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

use \SkyVerge\Plugin_Framework as WC_Braintree_Framework;

defined( 'ABSPATH' ) or exit;

/**
 * Braintree PayPal Gateway Class
 *
 * @since 3.0.0
 */
class WC_Gateway_Braintree_PayPal extends WC_Gateway_Braintree {


	/** PayPal payment type */
	const PAYMENT_TYPE_PAYPAL = 'paypal';


	/**
	 * Initialize the gateway
	 *
	 * @since 3.0.0
	 */
	public function __construct() {

		parent::__construct(
			WC_Braintree::PAYPAL_GATEWAY_ID,
			wc_braintree(),
			array(
				'method_title'       => __( 'Braintree (PayPal)', 'woocommerce-gateway-paypal-powered-by-braintree' ),
				'method_description' => __( 'Allow customers to securely pay using their PayPal account via Braintree.', 'woocommerce-gateway-paypal-powered-by-braintree' ),
				'supports'           => array(
					self::FEATURE_PRODUCTS,
					self::FEATURE_CARD_TYPES,
					self::FEATURE_PAYMENT_FORM,
					self::FEATURE_TOKENIZATION,
					self::FEATURE_CREDIT_CARD_CHARGE,
					self::FEATURE_CREDIT_CARD_CHARGE_VIRTUAL,
					self::FEATURE_CREDIT_CARD_AUTHORIZATION,
					self::FEATURE_CREDIT_CARD_CAPTURE,
					self::FEATURE_DETAILED_CUSTOMER_DECLINE_MESSAGES,
					self::FEATURE_REFUNDS,
					self::FEATURE_VOIDS,
					self::FEATURE_CUSTOMER_ID,
					self::FEATURE_ADD_PAYMENT_METHOD,
					self::FEATURE_TOKEN_EDITOR,
				),
				'payment_type'       => self::PAYMENT_TYPE_PAYPAL,
				'environments'       => $this->get_braintree_environments(),
				'shared_settings'    => $this->shared_settings_names,
			)
		);

		// tweak some frontend text so it matches PayPal
		add_filter( 'gettext', array( $this, 'tweak_payment_methods_text' ), 10, 3 );

		// tweak the "Delete" link text on the My Payment Methods table to "Unlink"
		add_filter( 'wc_braintree_my_payment_methods_table_method_actions', array( $this, 'tweak_my_payment_methods_delete_text' ), 10, 2 );

		// tweak the admin token editor to support PayPal accounts
		add_filter( 'wc_payment_gateway_braintree_paypal_token_editor_fields', array( $this, 'adjust_token_editor_fields' ) );

		// sanitize admin options before saving
		add_filter( 'woocommerce_settings_api_sanitized_fields_braintree_paypal', array( $this, 'filter_admin_options' ) );
	}


	/**
	 * Gets the gateway JS localized parameters.
	 *
	 * @since 2.0.0
	 * @return array
	 */
	protected function get_gateway_js_localized_script_params() {

		$params = parent::get_gateway_js_localized_script_params();

		if ( is_cart() ) {
			$params['client_token']     = $this->generate_client_token();
			$params['cart_nonce']       = wp_create_nonce( 'wc_' . $this->get_id() . '_cart_set_payment_method' );
			$params['cart_handler_url'] = add_query_arg( 'wc-api', get_class( $this ), home_url() );
		}

		return $params;
	}


	/**
	 * Add PayPal-specific fields to the admin payment token editor
	 *
	 * @since 3.2.0
	 * @return array
	 */
	public function adjust_token_editor_fields() {

		$fields = array(
			'id' => array(
				'label'    => __( 'Token ID', 'woocommerce-plugin-framework' ),
				'editable' => false,
				'required' => true,
			),
			'payer_email' => array(
				'label'   => __( 'Email', 'woocommerce-gateway-paypal-powered-by-braintree' ),
				'editable' => false,
			),
		);

		return $fields;
	}


	/**
	 * Return the PayPal payment form instance
	 *
	 * @since 3.0.0
	 * @return \WC_Braintree_PayPal_Payment_Form
	 */
	public function get_payment_form_instance() {

		return new WC_Braintree_PayPal_Payment_Form( $this );
	}


	/**
	 * Tweak two frontend strings so they match PayPal lingo instead of "Bank". This is
	 * the least hacky approach that doesn't require fairly significant refactoring
	 * of the framework code responsible for these strings, or results in an approach
	 * that won't work when the strings are translated
	 *
	 * @since 3.0.0
	 * @param string $translated_text translated text
	 * @param string $raw_text pre-translated text
	 * @param string $text_domain text domain
	 * @return string
	 */
	public function tweak_payment_methods_text( $translated_text, $raw_text, $text_domain ) {

		if ( 'woocommerce-plugin-framework' === $text_domain ) {

			if ( 'Use a new bank account' === $raw_text ) {

				$translated_text = __( 'Use a new PayPal account', 'woocommerce-gateway-paypal-powered-by-braintree' );

			} elseif ( 'Bank Accounts' === $raw_text ) {

				$translated_text = __( 'PayPal Accounts', 'woocommerce-gateway-paypal-powered-by-braintree' );
			}
		}

		return $translated_text;
	}


	/**
	 * Tweak the "Delete" link on the My Payment Methods actions list to "Unlink"
	 * which is more semantically correct (and less likely to cause customers
	 * to think they are deleting their actual PayPal account)
	 *
	 * @since 3.0.0
	 * @param array $actions payment method actions
	 * @param \WC_Braintree_Payment_Method $token
	 * @return array
	 */
	public function tweak_my_payment_methods_delete_text( $actions, $token ) {

		if ( $token->is_paypal_account() ) {
			$actions['delete']['name'] = __( 'Unlink', 'woocommerce-gateway-paypal-powered-by-braintree' );
		}

		return $actions;
	}


	/**
	 * Add PayPal method specific form fields, currently:
	 *
	 * + remove phone/URL dynamic descriptor (does not apply to PayPal)
	 *
	 * @since 3.0.0
	 * @see WC_Gateway_Braintree::get_method_form_fields()
	 * @return array
	 */
	protected function get_method_form_fields() {

		$fields = parent::get_method_form_fields();

		unset( $fields['phone_dynamic_descriptor'] );
		unset( $fields['url_dynamic_descriptor'] );

		return $fields;
	}


	/**
	 * Verify that a payment method nonce is present before processing the
	 * transaction
	 *
	 * @since 3.0.0
	 * @return bool
	 */
	protected function validate_paypal_fields( $is_valid ) {

		return $this->validate_payment_nonce( $is_valid );
	}


	/**
	 * Add PayPal specific data to the order, primarily for Subscriptions support
	 *
	 * @since 3.0.0
	 * @param \WC_Order|int $order order
	 * @return \WC_Order
	 */
	public function get_order( $order ) {

		$order = parent::get_order( $order );

		if ( $this->get_plugin()->is_subscriptions_active() ) {

			$order_id = WC_Braintree_Framework\SV_WC_Order_Compatibility::get_prop( $order, 'id' );

			$is_renewal = WC_Braintree_Framework\SV_WC_Plugin_Compatibility::is_wc_subscriptions_version_gte_2_0() ? wcs_order_contains_renewal( $order_id ) : WC_Subscriptions_Order::order_contains_subscription( $order_id );

			if ( $is_renewal ) {
				$order->payment->recurring = true;
			}
		}

		return $order;
	}


	/**
	 * Gets the PayPal checkout locale based on the WordPress locale
	 *
	 * @link http://wpcentral.io/internationalization/
	 * @link https://developers.braintreepayments.com/guides/paypal/vault/javascript/v2#country-and-language-support
	 *
	 * @since 2.0.0
	 * @return string
	 */
	public function get_safe_locale() {

		$locale = strtolower( get_locale() );

		$safe_locales = array(
				'en_au',
				'de_at',
				'en_be',
				'en_ca',
				'da_dk',
				'en_us',
				'fr_fr',
				'de_de',
				'en_gb',
				'zh_hk',
				'it_it',
				'nl_nl',
				'no_no',
				'pl_pl',
				'es_es',
				'sv_se',
				'en_ch',
				'tr_tr',
				'es_xc',
				'fr_ca',
				'ru_ru',
				'en_nz',
				'pt_pt',
		);

		if ( ! in_array( $locale, $safe_locales ) ) {
			$locale = 'en_us';
		}

		/**
		 * Braintree PayPal Locale Filter.
		 *
		 * Allow actors to filter the locale used for the Braintree SDK
		 *
		 * @since 3.0.0
		 * @param string $lang The button locale.
		 * @return string
		 */
		return apply_filters( 'wc_braintree_paypal_locale', $locale );
	}


	/**
	 * Performs a payment transaction for the given order and returns the
	 * result
	 *
	 * @since 3.0.0
	 * @see SV_WC_Payment_Gateway_Direct::do_transaction()
	 * @param \WC_Order $order the order object
	 * @return \SV_WC_Payment_Gateway_API_Response the response
	 */
	protected function do_paypal_transaction( WC_Order $order ) {

		if ( $this->perform_credit_card_charge( $order ) ) {
			$response = $this->get_api()->credit_card_charge( $order );
		} else {
			$response = $this->get_api()->credit_card_authorization( $order );
		}

		// success! update order record
		if ( $response->transaction_approved() ) {

			// order note, e.g. Braintree (PayPal) Sandbox Payment Approved (Transaction ID ABC)
			/* translators: Placeholders: %1$s - payment method title (e.g. PayPal), %2$s - transaction environment (either Sandbox or blank string), %3$s - type of transaction (either Authorization or Payment) */
			$message = sprintf(
				__( '%1$s %2$s %3$s Approved', 'woocommerce-gateway-paypal-powered-by-braintree' ),
				$this->get_method_title(),
				$this->is_test_environment() ? __( 'Sandbox', 'woocommerce-gateway-paypal-powered-by-braintree' ) : '',
				$this->perform_credit_card_authorization( $order ) ? __( 'Authorization', 'woocommerce-gateway-paypal-powered-by-braintree' ) : __( 'Payment', 'woocommerce-gateway-paypal-powered-by-braintree' )
			);

			// adds the transaction id (if any) to the order note
			if ( $response->get_transaction_id() ) {
				/* translators: Placeholders: %s - transaction ID */
				$message .= ' ' . sprintf( __( '(Transaction ID %s)', 'woocommerce-gateway-paypal-powered-by-braintree' ), $response->get_transaction_id() );
			}

			$order->add_order_note( $message );
		}

		return $response;
	}


	/**
	 * Get the order note message when a customer saves their PayPal account
	 * to their WC account
	 *
	 * @since 3.0.0
	 * @see SV_WC_Payment_Gateway_Direct::get_saved_payment_method_token_order_note()
	 * @param \WC_Braintree_Payment_Method $token the payment token being saved
	 * @return string
	 */
	protected function get_saved_payment_token_order_note( $token ) {

		return sprintf( __( 'PayPal Account Saved: %s', 'woocommerce-gateway-paypal-powered-by-braintree' ), $token->get_payer_email() );
	}


	/**
	 * Adds any gateway-specific transaction data to the order
	 *
	 * @since 3.0.0
	 * @see SV_WC_Payment_Gateway_Direct::add_transaction_data()
	 * @param \WC_Order $order the order object
	 * @param \WC_Braintree_API_PayPal_Transaction_Response $response the transaction response
	 */
	public function add_payment_gateway_transaction_data( $order, $response ) {

		// authorization code, called "Authorization Unique Transaction ID" by PayPal
		if ( $response->get_authorization_code() ) {
			$this->update_order_meta( $order, 'authorization_code', $response->get_authorization_code() );
		}

		// charge captured
		if ( $order->payment_total > 0 ) {
			// mark as captured
			if ( $this->perform_credit_card_charge( $order ) ) {
				$captured = 'yes';
			} else {
				$captured = 'no';
			}
			$this->update_order_meta( $order, 'charge_captured', $captured );
		}

		// payer email
		if ( $response->get_payer_email() ) {
			$this->update_order_meta( $order, 'payer_email', $response->get_payer_email() );
		}

		// payment ID
		if ( $response->get_payment_id() ) {
			$this->update_order_meta( $order, 'payment_id', $response->get_payment_id() );
		}

		// debug ID, if logging is enabled
		if ( $this->debug_log() && $response->get_debug_id() ) {
			$this->update_order_meta( $order, 'debug_id', $response->get_debug_id() );
		}
	}


	/** Refund feature ********************************************************/


	/**
	 * Adds PayPal-specific data to the order after a refund is performed
	 *
	 * @since 3.0.0
	 * @param \WC_Order $order the order object
	 * @param \WC_Braintree_API_PayPal_Transaction_Response $response the transaction response
	 */
	protected function add_payment_gateway_refund_data( WC_Order $order, $response ) {

		if ( $response->get_refund_id() ) {
			// add_order_meta() to account for multiple refunds on a single order
			$this->add_order_meta( $order, 'refund_id', $response->get_refund_id() );
		}
	}


	/** Getters ***************************************************************/


	/**
	 * Get the default payment method title, which is configurable within the
	 * admin and displayed on checkout
	 *
	 * @since 3.0.0
	 * @see SV_WC_Payment_Gateway::get_default_title()
	 * @return string payment method title to show on checkout
	 */
	protected function get_default_title() {

		return __( 'PayPal', 'woocommerce-gateway-paypal-powered-by-braintree' );
	}


	/**
	 * Get the default payment method description, which is configurable
	 * within the admin and displayed on checkout
	 *
	 * @since 3.0.0
	 * @see SV_WC_Payment_Gateway::get_default_description()
	 * @return string payment method description to show on checkout
	 */
	protected function get_default_description() {

		return __( 'Click the PayPal icon below to sign into your PayPal account and pay securely.', 'woocommerce-gateway-paypal-powered-by-braintree' );
	}


	/**
	 * Override the default icon to set a PayPal-specific one
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public function get_icon() {

		// from https://www.paypal.com/webapps/mpp/logos-buttons
		$icon_html = '<img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" alt="PayPal" />';

		return apply_filters( 'woocommerce_gateway_icon', $icon_html, $this->get_id() );
	}


	/**
	 * Return the PayPal payment method image URL
	 *
	 * @since 3.0.0
	 * @see SV_WC_Payment_Gateway::get_payment_method_image_url()
	 * @param string $type unused
	 * @return string the image URL
	 */
	public function get_payment_method_image_url( $type ) {

		return parent::get_payment_method_image_url( 'paypal' );
	}


	/**
	 * Braintree PayPal acts like a direct gateway
	 *
	 * @since 3.0.0
	 * @return boolean true if the gateway supports authorization
	 */
	public function supports_credit_card_authorization() {
		return $this->supports( self::FEATURE_CREDIT_CARD_AUTHORIZATION );
	}


	/**
	 * Braintree PayPal acts like a direct gateway
	 *
	 * @since 3.0.0
	 * @return boolean true if the gateway supports charges
	 */
	public function supports_credit_card_charge() {
		return $this->supports( self::FEATURE_CREDIT_CARD_CHARGE );
	}


}
