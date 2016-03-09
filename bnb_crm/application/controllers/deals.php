<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized');
class Deals extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Calcutta');
		$this->load->model('check_products');

        $this->baseURL = base_url();
    }
    public function index()
    {
    	$data['baseURL'] = $this->baseURL;
    	$this->load->view( 'dealsTable', $data );
    }
    public function getDeal()
    {
    	//$this->output->enable_profiler(TRUE);
    	if (isset($_POST['submit'])) 
        {
            $start = strtotime($this->input->post('start'));
    	    $end = strtotime($this->input->post('end'));
    	    $name = $this->input->post('dealName');
    	    $handle = fopen($_FILES['file']['tmp_name'], "r");

    	    $productIDs = array();
    	    
    	    while( ( $data = fgetcsv( $handle, 0, ',' ) ) !== FALSE )
	        {
               $productIDs[$data[1]] = $data[1];
        	}
            //echo "<p> Products uploaded: ".implode( ',', $productIDs )."</p>";

            $productsToAdd = $this->check_products->checkQuantity( $productIDs );
            
            if( $productsToAdd === FALSE )
            {
        	    //echo "<p>Some of the products that you are trying to upload are out of stock!</p>";
                $result = FALSE;
            }
            else
            {
            	$dealID = $this->check_products->insertDeal( $start, $end, $name );
            	//print "<p> deal id = ".$dealID."</p>";
            	if( $dealID !== NULL && $dealID !== FALSE )
            	{
            		rewind($handle); // rewind the file pointer
                    $tP = array_flip( $productsToAdd ); // flip the array
                    $result = array();
                    $this->db->trans_start(); // start a DB transaction
	                while(($data = fgetcsv($handle, 0, ','))!== FALSE)
	            	{
	            		$productID = $data[1];
	            		$productPrice = array_key_exists(2, $data) ? $data[2] : 0.00;
                        $result[] = isset( $tP[$productID] ) ? $this->check_products->insertProducts( $productID, $productPrice, $dealID ): FALSE;
	            	}
                    $this->db->trans_complete(); // end the DB transactions
                    //echo "<p> Products added to the DEAL <i>".$name."</i> are: ".implode( ',', $result )."</p>";
	            }
	            elseif( $dealID === NULL )
	            {
	            	//echo "<p>Unable to create deal</p>";
                    $result = NULL;
	            }
                elseif( $dealID === FALSE )
                {
                    //echo "<p>Deal can not end before it starts </p>";
                    $result = FALSE;
                }
        	}
            $response = json_encode($result);
            $this->output->set_content_type('application/json');
            $this->output->set_output($response);
        }
    }
    public function addProducts()
    {
        if (isset($_POST['submit'])) 
        {
            $dealID = $this->input->post('dealID');
            $handle = fopen($_FILES['file']['tmp_name'], "r");

            $productIDs = array();
            
            while( ( $data = fgetcsv( $handle, 0, ',' ) ) !== FALSE )
            {
               $productIDs[$data[1]] = $data[1];
            }
            //echo "<p> Products uploaded: ".implode( ',', $productIDs )."</p>";

            $productsToAdd = $this->check_products->checkQuantity( $productIDs );
            
            if( $productsToAdd === FALSE )
            {
                $result = FALSE;
            }
            else
            {
                if( $dealID !== NULL && $dealID !== FALSE )
                {
                    rewind($handle); // rewind the file pointer
                    $tP = array_flip( $productsToAdd ); // flip the array
                    $result = array();
                    $this->db->trans_start(); // start a DB transaction
                    while(($data = fgetcsv($handle, 0, ','))!== FALSE)
                    {
                        $productID = $data[1];
                        $productPrice = array_key_exists(2, $data) ? $data[2] : 0.00;
                        $result[] = isset( $tP[$productID] ) ? $this->check_products->insertProducts( $productID, $productPrice, $dealID ): FALSE;
                    }
                    $this->db->trans_complete(); // end the DB transactions*/
                }
                elseif( $dealID === NULL )
                {
                    $result = NULL;
                }
                elseif( $dealID === FALSE )
                {
                    $result = FALSE;
                }
            }
            $response = json_encode($result);
            $this->output->set_content_type('application/json');
            $this->output->set_output($response);
        }
    }
    public function readDeals()
    {
        $data= array();
        $data['dealsDetail'] = $this->check_products->dealsDetail();
        $response = json_encode($data);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function dealProducts()
    {
        $pageNumber = NULL;
        $responseData = array();
        $responseData['totalResults'] = NULL;
        $responseData['totalPages'] = 0;
        $responseData['result'] = NULL;
        $dealID = $this->input->get('dealID');
        $pageNumber = $this->input->get('pageNumber');
        switch( is_null($pageNumber) )
        {
            case TRUE:  $pageNumber = 0;
            break;
        }
        $maxResults = 20;
        $responseData['totalResults'] = $this->check_products->countDeal($dealID);
        $responseData['totalPages'] = ceil( $responseData['totalResults'] / $maxResults );
        $responseData['result'] = $this->check_products->dealProductDeatsils($dealID,$pageNumber,$maxResults);
        $responseData['productCount'] = count($responseData['result']); 
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function deleteDeal()
    {
        $dealID = $this->input->get('dealID');
        $data = $this->check_products->deleteDealDetails($dealID); 
        $response = json_encode($data);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function deleteDealProduct()
    {
        $productID = $this->input->get('productID');
        $data = $this->check_products->deleteProduct($productID); 
        $response = json_encode($data);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function categoryDetails()
    {
        $categoryName = $this->check_products->categoryName();
        $response = json_encode($categoryName);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function generateCoupon()
    {
        $couponID = $this->input->get('couponID');
        $percentOff = $this->input->get('percentOff');
        $useCount = $this->input->get('useCount');
        $discountType = $this->input->get('discountType');
        $validFrom = strtotime($this->input->get('validFrom'));
        $validUpto = strtotime($this->input->get('validUpto'));
        $minimumPurchaseAmount = $this->input->get('minimumPurchaseAmount');
        $userEmail = $this->input->get('userName');
        $parameter = $this->input->get('parameter');
        $visibility = $this->input->get('visibility');
        if(is_numeric($userEmail))
        {
            $userID = $userEmail;
        }
        else
        {
            $userID = $this->check_products->getUserID($userEmail);
        }
        $data = array('couponid' => $couponID,
                 'percentoff' => $percentOff,
                 'usecount' => $useCount,
                 'discounttype' => $discountType,
                 'validFrom' => $validFrom,
                 'validUpto' => $validUpto,
                 'minPurchaseAmount' => $minimumPurchaseAmount,
                 'user_id' => $userID,
                 'param1' => $parameter,
                 'visibility' => $visibility
                );
        log_message("INFO", "DATA BEING RETURNED FROM(\$data) SEARCH_M/TERMARRAY IS_____".print_r($data, TRUE));
        $data = $this->check_products->createCoupon($couponID,$percentOff,$useCount,$discountType,$validFrom,$validUpto,$minimumPurchaseAmount,$userID,$parameter,$visibility);
        $response = json_encode($data);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function deleteCoupon()
    {
        $couponID = $this->input->get('couponID');
        $data = $this->check_products->deleteCouponDetails($couponID);
        $response = json_encode($data);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function alterCoupon()
    {
        $couponID = $this->input->get('couponID');
        $validUpto = strtotime($this->input->get('validityParameter'));
        $visibility = $this->input->get('visibility');
        $data = $this->check_products->changeValidity($validUpto,$couponID,$visibility);
        $response = json_encode($data);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function checkCoupon()
    {
        $couponID = $this->input->get('couponID');
        $data = $this->check_products->checkCouponID($couponID);
        $response = json_encode($data);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function checkCouponValidity()
    {
        $couponID = $this->input->get('couponID');
        $data = $this->check_products->checkCouponValidityModel($couponID);
        $response = json_encode($data);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
}
?>