<?php if( ! defined('BASEPATH') ) exit('Direct access not allowed');

/*	TO DO
 *	when a user changes their payment method from COD to Online
 *	
 *
 */

class Checkout extends CI_Controller
{
	public $userID = NULL;
	public $isLoggedIN = NULL;
	public $isReallyLoggedIN = NULL;

	public function __construct()
	{
		parent::__construct();
		$this->userID = $this->session->userdata('id');
		$this->isLoggedIN = $this->session->userdata('logged_in');
		$this->isReallyLoggedIN = ($this->userID !== FALSE && $this->isLoggedIN !== FALSE && is_numeric($this->userID) && $this->userID > 0 && $this->isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$this->load->model('rapiv1/checkout_model', 'checkout_model');
	}

	public function index()
	{
		echo "Hello World!";
	}

	public function init($stepID = 1) // stepID = 0 - reserved, 1 - cart page, 2 - checkout page
	{
		/*
		 * Initialize checkout
		 * if $stepID > 1, Check if user already has some stateData saved. if there is any, read that data into the stateData array and save that only with the new stepID
		 * if there is none
		 * Read the current user's cart
		 * Store all products and coupons and bragbucks redeemed
		 * 
		*/
		$responseData = array();
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['canPurchase'] = $this->checkout_model->canPurchase( $this->userID );

		$stateData = array();

		$stateData['userID'] = $this->userID;
		$stateData['cartData'] = NULL;
		$stateData['coupons'] = NULL;
		$stateData['bragBucks'] = NULL;
		$stateData['stepID'] = $stepID;

		$response = NULL;

		switch( $this->isReallyLoggedIN && $responseData['canPurchase'] )
		{
			case TRUE:	if( $stepID > 1)
						{
							$stateData = $this->checkout_model->readCheckoutStateData( $this->userID, TRUE );
							log_message( 'INFO', "before json_decode and get_object_vars, stateData = \r\n".print_r( $stateData, TRUE ) );
							$stateData = get_object_vars( json_decode( $stateData['stateData'] ) );
							log_message( 'INFO', "after json_decode and get_object_vars, stateData = \r\n".print_r( $stateData, TRUE ) );
							$stateData['stepID'] = $stepID;
						}
						else
						{
							$stateData['cartData'] = $this->checkout_model->readUserCart( $this->userID );
							$stateData['cartGrandTotal'] = 0.00;
							// calculate the grandtotal price of products which the user will pay on completion of complete transaction
							foreach( $stateData['cartData'] as $cartItem )
							{
								$stateData['cartGrandTotal'] += ( ( $cartItem->isOnDiscount == 0 ) ? $cartItem->originalPrice : ( $cartItem->originalPrice - $cartItem->discountAmount ) );
							}

							$stateData['coupons'] = $this->checkout_model->appliedCoupons( $this->userID );
							$stateData['coupons']['removed'] = FALSE;
							$stateData['coupons']['removedID'] = NULL;
							$stateData['bragBucks'] = NULL; // currently sending NULL as bragBucks logic is yet to be written
							$stateData['email'] = $this->checkout_model->userID2Email( $this->userID );
						}
						
						$responseData['result'] = $this->checkout_model->saveState( $stateData );
						$responseData['stateData'] = $stateData;
				break;
		}

		$response = json_encode( $responseData );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( $response );
	}

	public function setAddress( $addressType = 1, $addressID = NULL ) /* addressType = 1 - shipping address, 2 - billing address, 3 - shipping + billing address */
	{
		$response = NULL;
		$responseData = array();
		
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['result'] = NULL;

		switch($this->isReallyLoggedIN === TRUE)
		{
			case TRUE:	switch( ( $addressType == 1 || $addressType == 2 || $addressType == 3 ) && ! is_null($addressID) )
						{
							case TRUE:	// call set address function from model
										$responseData['result'] = $this->checkout_model->setAddress( $addressType, $addressID, $this->userID );
								break;
						}
				break;
		}

		$response = json_encode( $responseData );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( $response );

	}

	public function canResume()
	{
		$response = NULL;
		$responseData = array();

		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['canResume'] = FALSE;

		switch( $this->isReallyLoggedIN === TRUE )
		{
			case TRUE: $responseData['canResume'] = $this->checkout_model->hasCheckoutStateData( $this->userID );
				break;
		}

		$response = json_encode( $responseData );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( $response );
	}

	public function readState($return = FALSE)
	{
		$response = NULL;
		$responseData = array();

		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['data'] = NULL;

		switch( $this->isReallyLoggedIN === TRUE )
		{
			case TRUE: $responseData['data'] = $this->checkout_model->readCheckoutStateData( $this->userID );
				break;
		}

		switch( $return )
		{
			case TRUE:	return $responseData;
				break;
		}

		$response = json_encode( $responseData );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( $response );
	}

	public function setPaymentMethod($shippingAddressID = NULL, $billingAddressID = NULL, $userPaymentMode = NULL)
	{
		switch( is_null( $shippingAddressID ) )
		{
			case TRUE:	$shippingAddressID = ( $this->input->post('shippingAddressID') !== FALSE ) ? $this->input->post('shippingAddressID'): NULL;
				break;
		}

		switch( is_null( $billingAddressID ) )
		{
			case TRUE:	$billingAddressID = ( $this->input->post('billingAddressID') !== FALSE ) ? $this->input->post('billingAddressID'): NULL;
				break;
		}

		switch( is_null( $userPaymentMode ) )
		{
			case TRUE:	$userPaymentMode = ( $this->input->post('userPaymentMode') !== FALSE ) ? $this->input->post('userPaymentMode'): NULL; // user payemnt mode = 1 - online, 2 - cod
				break;
		}

		$response = NULL;
		$responseData = array();
		
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['result'] = NULL;

		switch( $this->isReallyLoggedIN === TRUE && ! is_null($shippingAddressID) &&  ! is_null($billingAddressID)  && ! is_null($userPaymentMode) && is_numeric($shippingAddressID) && is_numeric($billingAddressID) && is_numeric($userPaymentMode) )
		{
			case TRUE:	$responseData['result'] = $this->checkout_model->setPaymentOption( $shippingAddressID, $billingAddressID, $userPaymentMode, $this->userID );
				break;
		}

		$response = json_encode( $responseData );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( $response );
	}

	public function initCOD()
	{
		$response = NULL;
		$responseData = array();

		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['data'] = NULL;

		switch( $this->isReallyLoggedIN === TRUE )
		{
			case TRUE: $responseData['data'] = $this->checkout_model->processCOD( $this->userID );
				break;
		}

		$response = json_encode( $responseData );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( $response );
	}

	public function getTransaction( $transID = NULL)
	{
		$response = NULL;
		$responseData = array();

		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['data'] = NULL;

		switch( $this->isReallyLoggedIN === TRUE )
		{
			case TRUE: $responseData['data'] = $this->checkout_model->getTransaction( $transID, $this->userID );
				break;
		}

		$response = json_encode( $responseData );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( $response );
	}

	public function getOrders( $transID = NULL )
	{
		$this->getTransaction( $transID );
	}

	public function getTransactions()
	{
		$response = NULL;
		$responseData = array();

		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['data'] = NULL;

		switch( $this->isReallyLoggedIN === TRUE )
		{
			case TRUE: $responseData['data'] = $this->checkout_model->getTransactions( $this->userID );
				break;
		}

		$response = json_encode( $responseData );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( $response );
	}

	public function payment()
	{
		$response = NULL;
		$responseData = array();

		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['data'] = NULL;

		switch( $this->isReallyLoggedIN === TRUE )
		{
			case TRUE:	$stateData = $this->checkout_model->readCheckoutStateData( $this->userID, TRUE );
						$stateData = get_object_vars( json_decode( $stateData['stateData'] ) );
						if( $stateData['paymentMode'] == 2)
						{
							$responseData['data'] = $this->checkout_model->processCOD( $this->userID );
						}
						else
						{
							$responseData['data'] = NULL;
						}
				break;
		}

		$response = json_encode( $responseData );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( $response );
	}
}
?>