<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized');

class Address extends CI_Controller
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
    $this->load->model('rapiv1/address_model', 'address_model');
  }
  
  public function index()
  {
    echo "Hello World!";
  }

  public function save()
  {
    $responseData = array();
    $responseData['isLoggedIN'] = $this->isReallyLoggedIN;
    $responseData['result'] = NULL;
    $responseData['isValid'] = FALSE;
    $responseData['invalidPhoneNumber'] = TRUE;

    $addressData = array();

    $addressData['userID'] = $this->userID;
    $addressData['firstName'] = ($this->input->post('firstName') !== FALSE && strcmp( trim( $this->input->post('firstName') ), "") !== 0) ? trim( $this->input->post('firstName') ): NULL;
    $addressData['middleName'] = ($this->input->post('middleName') !== FALSE && strcmp( trim( $this->input->post('middleName') ), "") !== 0) ? trim( $this->input->post('middleName') ): NULL;
    $addressData['lastName'] = ($this->input->post('lastName') !== FALSE && strcmp( trim( $this->input->post('lastName') ), "") !== 0) ? trim( $this->input->post('lastName') ): NULL;
    $addressData['address1'] = ($this->input->post('address1') !== FALSE && strcmp( trim( $this->input->post('address1') ), "") !== 0) ? trim( $this->input->post('address1') ): NULL;
    $addressData['address2'] = ($this->input->post('address2') !== FALSE && strcmp( trim( $this->input->post('address2') ), "") !== 0) ? trim( $this->input->post('address2') ): NULL;
    $addressData['city'] = ($this->input->post('city') !== FALSE && strcmp( trim( $this->input->post('city') ), "") !== 0) ? trim( $this->input->post('city') ): NULL;
    $addressData['state'] = ($this->input->post('state') !== FALSE && strcmp( trim( $this->input->post('state') ), "") !== 0) ? trim( $this->input->post('state') ): NULL;
    $addressData['country'] = ($this->input->post('country') !== FALSE  && strcmp( trim( $this->input->post('country') ), "") !== 0) ? trim( $this->input->post('country') ): NULL;
    $addressData['zipcode'] = ($this->input->post('zipcode') !== FALSE && strcmp( trim( $this->input->post('zipcode') ), "") !== 0) ? trim( $this->input->post('zipcode') ): NULL;
    $addressData['phoneNo'] = ($this->input->post('phoneNo') !== FALSE && strcmp( trim( $this->input->post('phoneNo') ), "") !== 0) ? trim( $this->input->post('phoneNo') ): NULL;
    $addressData['addressType'] = ($this->input->post('addressType') !== FALSE && strcmp( trim( $this->input->post('addressType') ), "") !== 0 && is_numeric( $this->input->post('addressType') ) ) ? trim( $this->input->post('addressType') ): 1; // 1 = shipping, 2 = billing
    $addressData['lastUsed'] = 0; // never = 0 = 1st Jan 1970
    $addressData['fromIP'] = ip2long( $this->input->ip_address() ); // save the ip address as a long value
    $addressData['cc'] = $addressData['country'];
    $addressData['editMode'] = ($this->input->post('editMode') !== FALSE && strcmp( trim( $this->input->post('editMode') ), "") !== 0) ? trim( $this->input->post('editMode') ): 0;
    $addressData['addressID'] = ($this->input->post('addressID') !== FALSE && strcmp( trim( $this->input->post('addressID') ), "") !== 0) ? trim( $this->input->post('addressID') ): NULL;
    $addressData['email'] = ($this->input->post('email') !== FALSE && strcmp( trim( $this->input->post('email') ), "") !== 0) ? trim( $this->input->post('email') ): "";

    //print_r( json_encode($addressData) );
    
    if( $this->isReallyLoggedIN === TRUE )
    {
      switch( !is_null($addressData["firstName"]) && !is_null($addressData["lastName"])  && !is_null($addressData["address1"]) && !is_null($addressData["city"]) && !is_null($addressData["state"]) && !is_null($addressData["country"]) && !is_null($addressData["zipcode"]) && !is_null($addressData["phoneNo"])  && !is_null($addressData["addressType"]) )
      {
        case TRUE:  if( preg_match('/^([0|\+[0-9]{1,3})?([0-9]{10})$/', $addressData['phoneNo']) )
                    {
                      $responseData['isValid'] = TRUE;
                      $responseData['invalidPhoneNumber'] = FALSE;
                      $responseData['result'] = $this->address_model->saveAddress( $addressData );
                    }
          break;
      }
    }
    
    $response = json_encode($responseData);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);
  }

  public function read($pageNumber = NULL)
  {
    log_message('INFO', "inside address/read");
    $responseData = array();
    $response = NULL;

    $responseData['isLoggedIN'] = $this->isReallyLoggedIN;
    $responseData['totalResults'] = NULL;
    $responseData['totalPages'] = 0;
    $responseData['result'] = NULL;

    switch( is_null($pageNumber) )
    {
      case TRUE:  $pageNumber = 0;
        break;
    }

    $maxResults = 24;

    $responseData['totalResults'] = $this->address_model->maxAddress( $this->userID );
    $responseData['totalPages'] = ceil( $responseData['totalResults'] / $maxResults );
    
    if( $this->isReallyLoggedIN === TRUE )
    {
      $responseData['result'] = $this->address_model->readAddress( $this->userID, $pageNumber, $maxResults );
    }
    
    $response = json_encode($responseData);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);
  }

  public function delete($addressID = NULL)
  {
    log_message('INFO', "inside address/read");
    $responseData = array();
    $responseData['isLoggedIN'] = $this->isReallyLoggedIN;
    $responseData['result'] = NULL;
    $response = NULL;

    switch($this->isReallyLoggedIN === TRUE)
    {
      case TRUE:  $responseData['result'] = $this->address_model->remove($addressID);
        break;
    }
    $response = json_encode($responseData);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);
  }

  public function checkPincode( $pinCode = NULL )
  {
    log_message('INFO', "inside address/read");
    $responseData = array();
    $responseData['isLoggedIN'] = $this->isReallyLoggedIN;
    $responseData['result'] = NULL;
    $response = NULL;

    switch($this->isReallyLoggedIN === TRUE)
    {
      case TRUE:  $pInfo = $this->address_model->getPincodeInfo( $pinCode );
                  $t = array();
                  foreach( $pInfo as $pItem )
                  {
                    $t2 = array();
                    if( $pItem->deliveryCapability == 1 )
                    {
                      $t2['deliveryCapability'] = TRUE;
                    }
                    else
                    {
                      $t2['deliveryCapability'] = FALSE;
                    }
                    if( $pItem->codCapability == 1 )
                    {
                      $t2['codCapability'] = TRUE;
                    }
                    else
                    {
                      $t2['codCapability'] = FALSE;
                    }
                    $t2['pinInfo'] = $pItem;
                    $t[] = $t2;
                  }
                  $responseData['result'] = $t;
        break;
    }
    $response = json_encode($responseData);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);
  }
}