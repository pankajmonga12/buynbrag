<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized!');

class Curate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rapiv1/curate_model', 'curate_model');
		error_reporting(-1);
		ini_set("display_errors", 1);
	}

	public function foreignFancy()
	{
		$responseData = array();
		$responseData['isLoggedIN'] = FALSE;
		$responseData['isValid'] = FALSE;

		$productName = ( ($this->input->post('pName') !== FALSE)? $this->input->post('pName'): NULL);
		$productLink = ( ($this->input->post('pLink') !== FALSE)? $this->input->post('pLink'): NULL);
		$productImgSrc = ( ($this->input->post('pImgSrc') !== FALSE)? $this->input->post('pImgSrc'): NULL);
		$productCatID = ( ($this->input->post('pCatID') !== FALSE)? $this->input->post('pCatID'): NULL);
		$productSellingPrice = ( ($this->input->post('pSellingPrice') !== FALSE)? $this->input->post('pSellingPrice'): NULL );

		$userID = $this->session->userdata('id');
		
		if( !is_null($productName) && !is_null($productLink) && !is_null($productImgSrc) && !is_null($productCatID) && is_numeric($productCatID) && !is_null($productSellingPrice) && $userID !== FALSE )
		{
			$responseData['isLoggedIN'] = TRUE;
			$responseData['isValid'] = TRUE;
			$timeStamp = time();
			$fanciedFromIP = $this->input->ip_address();

			$prodDetails = array
						(
							'productName' => $productName,
							'catID' => $productCatID,
							'curatedBy' => $userID,
							'ts' => time(),
							'curatedFromIP' => $fanciedFromIP,
							'sellingPrice' => $productSellingPrice
						);
			$responseData['result'] = $this->curate_model->curate($prodDetails);
		}

		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function saveCat()
	{
		log_message('INFO', 'rapiv1/curate/saveCat fired');
		$catName = ( ($this->input->post('cName') !== FALSE)? $this->input->post('cName'): NULL);
		$responseData = array();
		$responseData['isValid'] = FALSE;
		$responseData['isLoggedIN'] = FALSE;
		$userID = $this->session->userdata('id');

		if( !is_null($catName) && $userID !== FALSE && ($userID == 22 || $userID == 141 || $userID = 5124 || $userID == 3691) )
		{
			$responseData['isValid'] = TRUE;
			$responseData['isLoggedIN'] = TRUE;
			$responseData['userID'] = $userID;
			log_message('INFO', 'calling category function from model');
			$responseData['result'] = $this->curate_model->createCategory($catName);
		}

		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
}
?>