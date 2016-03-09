<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized');
class Reportdetails extends CI_Controller
{
  public $baseURL;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Calcutta');
    $this->load->library('pagination');

    $this->baseURL = base_url();
  }
  public function index()
  {
    $data = array();
    $data['baseURL'] = $this->baseURL;
    $this->load->view('dashboard', $data);
  }
	
  public function storeDetails()
  {
    	$this->load->model('reportmodel');
    	$storeName = $this->reportmodel->storeName();
      $response = json_encode($storeName);
      $this->output->set_content_type('application/json');
      $this->output->set_output($response);
  }

  public function lastSevenDays()
  {
    $this->load->model('reportmodel');
    for ($i = 0; $i <=7; $i++)
    {
      $sevenDays[] = date('Y-m-d', strtotime("-$i day "));
      $sevenDays2[] = date('d-M-Y', strtotime("-$i day "));
      //$xValue = array('categories' => array_merge($sevenDays2));
    }
    $reverseArray2 = array_reverse($sevenDays2);
    $xValue = array('categories' => $reverseArray2);
    $reverseArray = array_reverse($sevenDays);
    for ($i=0; $i <count($reverseArray) ; $i++) 
    { 
      $data[] = $this->reportmodel->sevenDaysDetail($reverseArray[$i]);
    }
    $total = array();
    foreach ($data as $key => $value)
    { 
      foreach($value as $subValue)
      {
        $sellingPrice[] = (int)$subValue->totalSellingPrice;
        $bnbCommission[] = (int)$subValue->bnbCommissionValue;
        $finalCommission[] = (int)$subValue->finalCommissionValue;
        $redeemedCoupon[] = (int)$subValue->couponRedeemed;
      }
    }
    $yValue[] = array('name' =>'Selling Price','data' => $sellingPrice);
    $yValue[] = array('name' =>'BNB Commission','data' => $bnbCommission);
    $yValue[] = array('name' =>'Final Commission','data' => $finalCommission);
    $yValue[] = array('name' =>'Coupon Redeemed','data' => $redeemedCoupon);
    $responseData['orderDate'] = $xValue;
    $responseData['value'] = $yValue;
    $response = json_encode($responseData);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);

    /*$graph['orderDate'] = json_encode($xValue);
    $graph['value'] = json_encode($yValue);
    echo "<pre>".print_r($response, TRUE)."</pre>";
    $this->load->view('graph',$graph);*/
  }

  public function monthlyReport()
  {
    //$filter = date( "Y-m", ( strtotime($month)));
    $month = $this->input->get('month');
    $this->load->model('reportmodel');
    $data = $this->reportmodel->monthlyModel($month); 
    $response = json_encode($data);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);
  }

  public function customReport()
  {
    $start = $this->input->get('start');
    $end = $this->input->get('end');
    $catID = $this->input->get('category');
    $storeID = $this->input->get('store');
    $startDate = $start.' '."00:00:00";
    $endDate = $end.' '."23:59:59";
    $this->load->model('reportmodel');
    if($catID == 0 && $storeID == 0)
    {
      $data = $this->reportmodel->customModel($startDate,$endDate);
    }
    elseif($catID == 0)
    {
      $data = $this->reportmodel->customModelOne($startDate,$endDate,$storeID);
    }
      elseif($storeID == 0)
    {
      $data = $this->reportmodel->customModelTwo($startDate,$endDate,$catID);
    }
      else 
    {
      $data = $this->reportmodel->customModelThree($startDate,$endDate,$catID,$storeID);
    }
    //echo "<pre>".print_r($data, TRUE)."</pre>";
    $response = json_encode($data);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);
  }

	public function dailyData() 
  {
    $start = $this->input->get('start');
    $end = $this->input->get('end');
    $refineData = $this->input->get('datatypeDay');
    $startDate = $start.' '."00:00:00";
    $endDate = $end.' '."23:59:59";
    $this->load->model('reportmodel');
    $data = $this->reportmodel->columnChart($startDate,$endDate);
    foreach ($data as $key => $value)
    { 
      foreach($value as $subValue)
      {
        $date = $subValue->date_of_order;
        $dateValue[] =date( "d-M-Y", ( strtotime($date)));
        $xValue = array('categories' => array_merge($dateValue));
        if($refineData == 2)
        {
          $sellingPrice[] = (int)$subValue->totalSellingPrice;
          //$yValue = array('name' =>'Selling Price','data' => array_merge($sellingPrice));
        }
        elseif($refineData == 1)
        {
          $bnbCommission[] = (int)$subValue->bnbCommissionValue;
          //$yValue = array('name' =>'Bnb Commission Value','data' => array_merge($bnbCommission));
        }
        elseif($refineData == 3)
        {
          $finalCommission[] = (int)$subValue->finalCommissionValue;
          //$yValue = array('name' =>'Final commission','data' => array_merge($finalCommission));
        }
        else
        {
          $sellingPrice[] = (int)$subValue->totalSellingPrice;
          $bnbCommission[] = (int)$subValue->bnbCommissionValue;
          $finalCommission[] = (int)$subValue->finalCommissionValue;
        }
      }
    }
    if ($refineData == 2)
    {
      $yValue[] = array('name' =>'Selling Price','data' => $sellingPrice);
    }
    elseif($refineData == 1)
    {
      $yValue[] = array('name' =>'Bnb Commission Value','data' => $bnbCommission);
    }
    elseif($refineData == 3)
    {
      $yValue[] = array('name' =>'Final commission','data' => $finalCommission);
    }
    else
    {
      $yValue[] = array('name' =>'Selling Price','data' => $sellingPrice);
      $yValue[] = array('name' =>'BNB Commission','data' => $bnbCommission);
      $yValue[] = array('name' =>'Final Commission','data' => $finalCommission);
    }
    $responseData['orderDate'] = $xValue;
    $responseData['value'] = $yValue;
    $response = json_encode($responseData);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);
    /*$graph['orderDate'] = json_encode($xValue);
    $graph['value'] = json_encode($yValue);
    $this->load->view('graph',$graph);
    echo "<pre>".print_r($data, TRUE)."</pre>";*/
  }
  
  public function monthlyData()
  {
    $start = $this->input->get('startDate');
    $end = $this->input->get('endDate');
    $refineData = $this->input->get('datatype');
    $startDate = date( "Y-m-d".' '."00:00:00", ( strtotime($start)));
    $endDate = date( "Y-m-d".' '."23:59:59", ( strtotime($end)));
    $this->load->model('reportmodel');
    $data = $this->reportmodel->columnChartTwo($startDate,$endDate);
    //echo "<pre>".print_r($data, TRUE)."</pre>";
    foreach ($data as $key => $value)
    { 
      foreach($value as $subValue)
      {
        $date = $subValue->date_of_order;
        $dateValue[] =date( "M-Y", ( strtotime($date)));
        $xValue = array('categories' => array_merge($dateValue));
        if($refineData == 2)
        {
          $sellingPrice[] = (int)$subValue->totalSellingPrice;
          //$yValue = array('name' =>'Selling Price','data' => array_merge($sellingPrice));
        }
        elseif($refineData == 1)
        {
          $bnbCommission[] = (int)$subValue->bnbCommissionValue;
          //$yValue = array('name' =>'Bnb Commission Value','data' => array_merge($bnbCommission));
        }
        elseif($refineData == 3)
        {
          $finalCommission[] = (int)$subValue->finalCommissionValue;
          //$yValue = array('name' =>'Final commission','data' => array_merge($finalCommission));
        }
          else
        {
          $sellingPrice[] = (int)$subValue->totalSellingPrice;
          $bnbCommission[] = (int)$subValue->bnbCommissionValue;
          $finalCommission[] = (int)$subValue->finalCommissionValue;
        }
      }
    }
    if ($refineData == 2)
    {
      $yValue[] = array('name' =>'Selling Price','data' => $sellingPrice);
    }
    elseif($refineData == 1)
    {
      $yValue[] = array('name' =>'Bnb Commission Value','data' => $bnbCommission);
    }
    elseif($refineData == 3)
    {
      $yValue[] = array('name' =>'Final commission','data' => $finalCommission);
    }
    else
    {
      $yValue[] = array('name' =>'Selling Price','data' => $sellingPrice);
      $yValue[] = array('name' =>'Bnb Commission Value','data' => $bnbCommission);
      $yValue[] = array('name' =>'Final commission','data' => $finalCommission);
    }
    $responseData['orderDate'] = $xValue;
    $responseData['value'] = $yValue;
    $response = json_encode($responseData);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);
    /*$graph['orderDate'] = json_encode($xValue);
    $graph['value'] = json_encode($yValue);
    print_r($graph['value']);
    $this->load->view('graph',$graph);
    echo "<pre>".print_r($data, TRUE)."</pre>";*/
  }
  
  public function weeklyData()
  {
    $count = $this->input->get('week');
    $refineData = $this->input->get('datatype');
    $this->load->model('reportmodel');
    for ($i = 0; $i <= $count; $i++)
    {
      //$k = $i+1;
      $k = $i*1;
      $j = $i+1;
      $weeks[] = date("'Y-m-d 00:00:00'", strtotime("-$j Monday ")). ' and ' .date("'Y-m-d 23:59:59'", strtotime("-$k Sunday"));
      //$weeks[] = date("'Y-m-d 00:00:00'", strtotime("-$k week ")). ' and ' .date("'Y-m-d 23:59:59'", strtotime("-$i week"));
      $weeks2[] = date('d-M-Y', strtotime("-$j Monday ")). ' to ' .date('d-M-Y', strtotime("-$k Sunday"));
      //$weeks2[] = date('d-M-Y', strtotime("-$k week ")). ' to ' .date('d-M-Y', strtotime("-$i week"));
    }
    $reverseArray2 = array_reverse($weeks2);
    $xValue = array('categories' => $reverseArray2);
    $reverseArray = array_reverse($weeks);
    //print_r ($reverseArray);
    for ($i=0; $i <count($reverseArray) ; $i++)
    {
    	$data[] = $this->reportmodel->weeklyDataModel($reverseArray[$i]);
    }
    foreach ($data as $key => $value)
    { 
      foreach($value as $subValue)
      {
        if($refineData == 2)
        {
          $sellingPrice[] = (int)$subValue->totalSellingPrice;
          //$yValue = array('name' =>'Selling Price','data' => array_merge($sellingPrice));
        }
        elseif($refineData == 1)
        {
          $bnbCommission[] = (int)$subValue->bnbCommissionValue;
          //$yValue = array('name' =>'Bnb Commission Value','data' => array_merge($bnbCommission));
        }
        elseif($refineData == 3)
        {
          $finalCommission[] = (int)$subValue->finalCommissionValue;
          //$yValue = array('name' =>'Final commission','data' => array_merge($finalCommission));
        }
          else
        {
          $sellingPrice[] = (int)$subValue->totalSellingPrice;
          $bnbCommission[] = (int)$subValue->bnbCommissionValue;
          $finalCommission[] = (int)$subValue->finalCommissionValue;
        }
      }
    }
    if ($refineData == 2)
    {
      $yValue[] = array('name' =>'Selling Price','data' => $sellingPrice);
    }
    elseif($refineData == 1)
    {
      $yValue[] = array('name' =>'Bnb Commission Value','data' => $bnbCommission);
    }
    elseif($refineData == 3)
    {
      $yValue[] = array('name' =>'Final commission','data' => $finalCommission);
    }
    else
    {
      $yValue[] = array('name' =>'Selling Price','data' => $sellingPrice);
      $yValue[] = array('name' =>'BNB Commission','data' => $bnbCommission);
      $yValue[] = array('name' =>'Final Commission','data' => $finalCommission);
      //$yValue[] = array('name' =>'Coupon Redeemed','data' => $redeemedCoupon);
    }
    $responseData['orderDate'] = $xValue;
    $responseData['value'] = $yValue;
    $response = json_encode($responseData);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);
    /*$graph['orderDate'] = json_encode($xValue);
    $graph['value'] = json_encode($yValue);
    $this->load->view('graph',$graph);*/
  }
  
  public function topSelling()
  {
    $start = $this->input->get('start');
    $end = $this->input->get('end');
    $catID = $this->input->get('category');
    $storeID = $this->input->get('store');
    $startDate = $start.' '."00:00:00";
    $endDate = $end.' '."23:59:59";
    $this->load->model('reportmodel');
    if($catID == 0 && $storeID == 0)
    {
      $data = $this->reportmodel->topSellingModel($startDate,$endDate);
    }
    elseif($catID == 0)
    {
      $data = $this->reportmodel->topSellingModelOne($startDate,$endDate,$storeID);
    }
      elseif($storeID == 0)
    {
      $data = $this->reportmodel->topSellingModelTwo($startDate,$endDate,$catID);
    }
      else 
    {
      $data = $this->reportmodel->topSellingModelThree($startDate,$endDate,$catID,$storeID);
    }
    //echo "<pre>".print_r($data, TRUE)."</pre>";
    $response = json_encode($data);
    $this->output->set_content_type('application/json');
    $this->output->set_output($response);
  }
}

?>
