<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized!');

class Ldata extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rapiv1/landing_model', 'landing_model');
	}

	public function get($pageNumber = 0)
	{
		$responseData = array();
		$responseData['result'] = NULL;

		$catID = ($this->input->post('catID') !== FALSE)? $this->input->post('catID'): NULL;
		$userID = $this->session->userdata('id');

		$responseData['isLoggedIN'] = $this->session->userdata('logged_in');

		switch($responseData['isLoggedIN'] === FALSE)
		{
			case TRUE: $userID = NULL;
				break;
		}

		$responseData['result'] = $this->landing_model->readTrendingData($pageNumber, $userID);
        
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function shuffle()
	{
		$this->landing_model->shuffleTrendingProducts();
	}

	public function refreshTrendingData()
	{
		$this->landing_model->truncateTrendingProductsTable();
		$allData = $this->landing_model->readTrendingDataForGen();
		echo "<pre>".print_r($allData, TRUE)."</pre><hr/>";
		$batchData = array();

		$furniture = $allData['furniture'];
		$decor = $allData['decor'];
		$dining = $allData['dining'];
		$lighting = $allData['lighting'];
		$fashion = $allData['fashion'];
		$gnc = $allData['gnc'];
		$art = $allData['art'];
		$fashionM = $allData['fashionM'];
		$fashionW = $allData['fashionW'];
		$fashionAccessW = $allData['fashionAccessW'];
		$fashionAccessM = $allData['fashionAccessM'];
		$quirky = $allData['quirky'];
		$collectibles = $allData['collectibles'];

		$f1 = $d1 = $d2 = $l = $f2 = $g = $a = $fM = $fW = $fAM = $fAW = $q = $c =0;

		// save furniture of first batch
		for(;$f1 < 20; $f1++)
		{
			$batchData[] = array
							(
								'product_id' => $furniture[$f1]->product_id,
								'store_id' => $furniture[$f1]->store_id,
								'sort_order' => 0,
								'cat_id' => 6,
								'ts' => time(),
								'pScore' => $furniture[$f1]->pScore
							);
		}

		// save decor of first batch
		for(;$d1 < 16; $d1++)
		{
			$batchData[] = array
							(
								'product_id' => $decor[$d1]->product_id,
								'store_id' => $decor[$d1]->store_id,
								'sort_order' => 0,
								'cat_id' => 8,
								'ts' => time(),
								'pScore' => $decor[$d1]->pScore
							);
		}

		// save dining of first batch
		for(;$d2 < 4; $d2++)
		{
			$batchData[] = array
							(
								'product_id' => $dining[$d2]->product_id,
								'store_id' => $dining[$d2]->store_id,
								'sort_order' => 0,
								'cat_id' => 7,
								'ts' => time(),
								'pScore' => $dining[$d2]->pScore
							);
		}

		// save lighting of first batch
		for(;$l < 5; $l++)
		{
			$batchData[] = array
							(
								'product_id' => $lighting[$l]->product_id,
								'store_id' => $lighting[$l]->store_id,
								'sort_order' => 0,
								'cat_id' => 10,
								'ts' => time(),
								'pScore' => $lighting[$l]->pScore
							);
		}

		// save fashion of first batch
		/*for(;$f2 < 2; $f2++)
		{
			$batchData[] = array
							(
								'product_id' => $fashion[$f2]->product_id,
								'store_id' => $fashion[$f2]->store_id,
								'sort_order' => 0,
								'cat_id' => 2,
								'ts' => time(),
								'pScore' => $fashion[$f2]->pScore
							);
		}
		*/

		// save gnc of first batch
		/*for(;$g < 6; $g++)
		{
			$batchData[] = array
							(
								'product_id' => $gnc[$g]->product_id,
								'store_id' => $gnc[$g]->store_id,
								'sort_order' => 0,
								'cat_id' => 4,
								'ts' => time(),
								'pScore' => $gnc[$g]->pScore
							);
		}
		*/

		// save art of first batch
		for(;$a < 3; $a++)
		{
			$batchData[] = array
							(
								'product_id' => $art[$a]->product_id,
								'store_id' => $art[$a]->store_id,
								'sort_order' => 0,
								'cat_id' => 3,
								'ts' => time(),
								'pScore' => $art[$a]->pScore
							);
		}

		// save fashionM of first batch
		/*for(;$fM < 1; $fM++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionM[$fM]->product_id,
								'store_id' => $fashionM[$fM]->store_id,
								'sort_order' => 0,
								'cat_id' => 387,
								'ts' => time(),
								'pScore' => $fashionM[$fM]->pScore
							);
		}
		*/

		// save fashionW of first batch
		/*for(;$fW < 1; $fW++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionW[$fW]->product_id,
								'store_id' => $fashionW[$fW]->store_id,
								'sort_order' => 0,
								'cat_id' => 388,
								'ts' => time(),
								'pScore' => $fashionW[$fW]->pScore
							);
		}
		*/

		// save fashionAccessM of first batch
		for(;$fAM < 1; $fAM++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionAccessM[$fAM]->product_id,
								'store_id' => $fashionAccessM[$fAM]->store_id,
								'sort_order' => 0,
								'cat_id' => 14,
								'ts' => time(),
								'pScore' => $fashionAccessM[$fAM]->pScore
							);
		}

		// save fashionAccessW of first batch
		for(;$fAW < 2; $fAW++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionAccessW[$fAW]->product_id,
								'store_id' => $fashionAccessW[$fAW]->store_id,
								'sort_order' => 0,
								'cat_id' => 18,
								'ts' => time(),
								'pScore' => $fashionAccessW[$fAW]->pScore
							);
		}

		// save quirky of first batch
		for(;$q < 19; $q++)
		{
			$batchData[] = array
							(
								'product_id' => $quirky[$q]->product_id,
								'store_id' => $quirky[$q]->store_id,
								'sort_order' => 0,
								'cat_id' => 32,
								'ts' => time(),
								'pScore' => $quirky[$q]->pScore
							);
		}

		// save collectibles of first batch
		for(;$c < 1; $c++)
		{
			$batchData[] = array
							(
								'product_id' => $collectibles[$c]->product_id,
								'store_id' => $collectibles[$c]->store_id,
								'sort_order' => 0,
								'cat_id' => 392,
								'ts' => time(),
								'pScore' => $collectibles[$c]->pScore
							);
		}

		// batch 2

		$t = $f1;
		// save furniture of second batch
		for(;$f1 < ($t+20); $f1++)
		{
			$batchData[] = array
							(
								'product_id' => $furniture[$f1]->product_id,
								'store_id' => $furniture[$f1]->store_id,
								'sort_order' => 0,
								'cat_id' => 6,
								'ts' => time(),
								'pScore' => $furniture[$f1]->pScore
							);
		}

		$t = $d1;
		// save decor of second batch
		for(;$d1 < ($t+16); $d1++)
		{
			$batchData[] = array
							(
								'product_id' => $decor[$d1]->product_id,
								'store_id' => $decor[$d1]->store_id,
								'sort_order' => 0,
								'cat_id' => 8,
								'ts' => time(),
								'pScore' => $decor[$d1]->pScore
							);
		}

		$t = $d2;
		// save dining of second batch
		for(;$d2 < ($t+4); $d2++)
		{
			$batchData[] = array
							(
								'product_id' => $dining[$d2]->product_id,
								'store_id' => $dining[$d2]->store_id,
								'sort_order' => 0,
								'cat_id' => 7,
								'ts' => time(),
								'pScore' => $dining[$d2]->pScore
							);
		}

		$t = $l;
		// save lighting of second batch
		for(;$l < ($t+5); $l++)
		{
			$batchData[] = array
							(
								'product_id' => $lighting[$l]->product_id,
								'store_id' => $lighting[$l]->store_id,
								'sort_order' => 0,
								'cat_id' => 10,
								'ts' => time(),
								'pScore' => $lighting[$l]->pScore
							);
		}

		//$t = $f2;
		// save fashion of second batch
		/*for(;$f2 < ($t+2); $f2++)
		{
			$batchData[] = array
							(
								'product_id' => $fashion[$f2]->product_id,
								'store_id' => $fashion[$f2]->store_id,
								'sort_order' => 0,
								'cat_id' => 2,
								'ts' => time(),
								'pScore' => $fashion[$f2]->pScore
							);
		}*/

		//$t = $g;
		// save gnc of second batch
		/*for(;$g < ($t+6); $g++)
		{
			$batchData[] = array
							(
								'product_id' => $gnc[$g]->product_id,
								'store_id' => $gnc[$g]->store_id,
								'sort_order' => 0,
								'cat_id' => 4,
								'ts' => time(),
								'pScore' => $gnc[$g]->pScore
							);
		}
		*/

		$t = $a;
		// save art of second batch
		for(;$a < ($t+3); $a++)
		{
			$batchData[] = array
							(
								'product_id' => $art[$a]->product_id,
								'store_id' => $art[$a]->store_id,
								'sort_order' => 0,
								'cat_id' => 3,
								'ts' => time(),
								'pScore' => $art[$a]->pScore
							);
		}

		//$t = $fM;
		// save fashionM of second batch
		/*for(;$fM < ($t+1); $fM++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionM[$fM]->product_id,
								'store_id' => $fashionM[$fM]->store_id,
								'sort_order' => 0,
								'cat_id' => 387,
								'ts' => time(),
								'pScore' => $fashionM[$fM]->pScore
							);
		}*/

		//$t = $fW;
		// save fashionW of second batch
		/*for(;$fW < ($t+1); $fW++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionW[$fW]->product_id,
								'store_id' => $fashionW[$fW]->store_id,
								'sort_order' => 0,
								'cat_id' => 388,
								'ts' => time(),
								'pScore' => $fashionW[$fW]->pScore
							);
		}
		*/

		$t = $fAM;
		// save fashionAccessM of second batch
		for(;$fAM < ($t+1); $fAM++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionAccessM[$fAM]->product_id,
								'store_id' => $fashionAccessM[$fAM]->store_id,
								'sort_order' => 0,
								'cat_id' => 14,
								'ts' => time(),
								'pScore' => $fashionAccessM[$fAM]->pScore
							);
		}

		$t = $fAW;
		// save fashionAccessW of second batch
		for(;$fAW < ($t+2); $fAW++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionAccessW[$fAW]->product_id,
								'store_id' => $fashionAccessW[$fAW]->store_id,
								'sort_order' => 0,
								'cat_id' => 18,
								'ts' => time(),
								'pScore' => $fashionAccessW[$fAW]->pScore
							);
		}

		$t = $q;
		// save quirky of second batch
		for(;$q < ($t+19); $q++)
		{
			$batchData[] = array
							(
								'product_id' => $quirky[$q]->product_id,
								'store_id' => $quirky[$q]->store_id,
								'sort_order' => 0,
								'cat_id' => 32,
								'ts' => time(),
								'pScore' => $quirky[$q]->pScore
							);
		}

		$t = $c;
		// save collectibles of second batch
		for(;$c < ($t+1); $c++)
		{
			$batchData[] = array
							(
								'product_id' => $collectibles[$c]->product_id,
								'store_id' => $collectibles[$c]->store_id,
								'sort_order' => 0,
								'cat_id' => 392,
								'ts' => time(),
								'pScore' => $collectibles[$c]->pScore
							);
		}

		// batch 3

		$t = $f1;
		// save furniture of third batch
		for(;$f1 < ($t+20); $f1++)
		{
			$batchData[] = array
							(
								'product_id' => $furniture[$f1]->product_id,
								'store_id' => $furniture[$f1]->store_id,
								'sort_order' => 0,
								'cat_id' => 6,
								'ts' => time(),
								'pScore' => $furniture[$f1]->pScore
							);
		}

		$t = $d1;
		// save decor of third batch
		for(;$d1 < ($t+16); $d1++)
		{
			$batchData[] = array
							(
								'product_id' => $decor[$d1]->product_id,
								'store_id' => $decor[$d1]->store_id,
								'sort_order' => 0,
								'cat_id' => 8,
								'ts' => time(),
								'pScore' => $decor[$d1]->pScore
							);
		}

		$t = $d2;
		// save dining of third batch
		for(;$d2 < ($t+4); $d2++)
		{
			$batchData[] = array
							(
								'product_id' => $dining[$d2]->product_id,
								'store_id' => $dining[$d2]->store_id,
								'sort_order' => 0,
								'cat_id' => 7,
								'ts' => time(),
								'pScore' => $dining[$d2]->pScore
							);
		}

		$t = $l;
		// save lighting of third batch
		for(;$l < ($t+4); $l++)
		{
			$batchData[] = array
							(
								'product_id' => $lighting[$l]->product_id,
								'store_id' => $lighting[$l]->store_id,
								'sort_order' => 0,
								'cat_id' => 10,
								'ts' => time(),
								'pScore' => $lighting[$l]->pScore
							);
		}

		//$t = $f2;
		// save fashion of third batch
		/*for(;$f2 < ($t+2); $f2++)
		{
			$batchData[] = array
							(
								'product_id' => $fashion[$f2]->product_id,
								'store_id' => $fashion[$f2]->store_id,
								'sort_order' => 0,
								'cat_id' => 2,
								'ts' => time(),
								'pScore' => $fashion[$f2]->pScore
							);
		}
		*/

		//$t = $g;
		// save gnc of third batch
		/*for(;$g < ($t+6); $g++)
		{
			$batchData[] = array
							(
								'product_id' => $gnc[$g]->product_id,
								'store_id' => $gnc[$g]->store_id,
								'sort_order' => 0,
								'cat_id' => 4,
								'ts' => time(),
								'pScore' => $gnc[$g]->pScore
							);
		}
		*/

		$t = $a;
		// save art of third batch
		for(;$a < ($t+4); $a++)
		{
			$batchData[] = array
							(
								'product_id' => $art[$a]->product_id,
								'store_id' => $art[$a]->store_id,
								'sort_order' => 0,
								'cat_id' => 3,
								'ts' => time(),
								'pScore' => $art[$a]->pScore
							);
		}

		//$t = $fM;
		// save fashionM of third batch
		/*for(;$fM < ($t+1); $fM++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionM[$fM]->product_id,
								'store_id' => $fashionM[$fM]->store_id,
								'sort_order' => 0,
								'cat_id' => 387,
								'ts' => time(),
								'pScore' => $fashionM[$fM]->pScore
							);
		}
		*/

		//$t = $fW;
		// save fashionW of third batch
		/*for(;$fW < ($t+1); $fW++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionW[$fW]->product_id,
								'store_id' => $fashionW[$fW]->store_id,
								'sort_order' => 0,
								'cat_id' => 388,
								'ts' => time(),
								'pScore' => $fashionW[$fW]->pScore
							);
		}
		*/

		$t = $fAM;
		// save fashionAccessM of third batch
		for(;$fAM < ($t+1); $fAM++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionAccessM[$fAM]->product_id,
								'store_id' => $fashionAccessM[$fAM]->store_id,
								'sort_order' => 0,
								'cat_id' => 14,
								'ts' => time(),
								'pScore' => $fashionAccessM[$fAM]->pScore
							);
		}

		$t = $fAW;
		// save fashionAccessW of third batch
		for(;$fAW < ($t+2); $fAW++)
		{
			$batchData[] = array
							(
								'product_id' => $fashionAccessW[$fAW]->product_id,
								'store_id' => $fashionAccessW[$fAW]->store_id,
								'sort_order' => 0,
								'cat_id' => 18,
								'ts' => time(),
								'pScore' => $fashionAccessW[$fAW]->pScore
							);
		}

		$t = $q;
		// save quirky of third batch
		for(;$q < ($t+19); $q++)
		{
			$batchData[] = array
							(
								'product_id' => $quirky[$q]->product_id,
								'store_id' => $quirky[$q]->store_id,
								'sort_order' => 0,
								'cat_id' => 32,
								'ts' => time(),
								'pScore' => $quirky[$q]->pScore
							);
		}

		$t = $c;
		// save collectibles of third batch
		for(;$c < ($t+1); $c++)
		{
			$batchData[] = array
							(
								'product_id' => $collectibles[$c]->product_id,
								'store_id' => $collectibles[$c]->store_id,
								'sort_order' => 0,
								'cat_id' => 392,
								'ts' => time(),
								'pScore' => $collectibles[$c]->pScore
							);
		}

		$t = 1;
		echo "<p>now printing computed data</p>\r\n<table>\r\n<tr><th>S.No.</th><th>PID</th><th>sID</th><th>sortOrder</th><th>cat_id</th><th>time</th><th>pScore</th></tr>";
		foreach($batchData as $bd)
		{
			echo "<tr><td>".$t++."</td><td>".$bd['product_id']."</td><td>".$bd['store_id']."</td><td>".$bd['sort_order']."</td><td>".$bd['cat_id']."</td><td>".$bd['ts']."</td><td>".$bd['ts']."</td><td>".$bd['pScore']."</td></tr>";
		}
		echo "</table>";

		$retVal = $this->landing_model->write($batchData);
		echo "<pre>".print_r($retVal, TRUE)."</pre>";
	}

	public function add()
	{
		$_rm = strtoupper( $this->input->server('REQUEST_METHOD') );
		if($_rm == "POST")
		{
			// code to process the data
			$password = $this->input->post('password');
			if( $password !== FALSE && strcmp($password, 'szzdell') === 0 )
			{
				// code to save the product
			}
			else
			{
				?>
				<html><head><title>Wrong Password! - Add trending product(s)</title></head>
				<body><p style="color:#ff0000;background:#ffffff">Wrong Password!</p><form action="" method="POST"><input type="text" name="pids" size="30"><br/>
				<input type="PASSWORD" name="password" size="18"><input type="SUBMIT" value="Add"></form></body></html>
				<?php
			}
		}
		else
		{
			// print the form here
			?>
			<html><head><title>Add trending product(s)</title></head>
			<body><form action="" method="POST"><input type="text" name="pids" size="30"><br/>
			<input type="PASSWORD" name="password" size="18"><input type="SUBMIT" value="Add"></form></body></html>
			<?php
		}
	}
}
?>