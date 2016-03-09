<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized!');
class Curate_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function curate($productDetails)
	{
		$retVal = NULL;
		$qry = $this->db->insert('bm_products', $productDetails);
		$productID = $this->db->insert_id();
		$retVal = array( 'saved' => $qry, 'productID' => $productID );
		return $retVal;
	}

	public function createCategory($catName)
	{
		$retVal = NULL;
		log_message('INFO', 'rapiv1/curate_model/createCategory fired');
		$this->db->set('catName', $catName);
		$qry = $this->db->insert('bm_cats');
		$catID = $this->db->insert_id();
		$retVal = array( 'saved' => $qry, 'catID' => $catID );
		log_message('INFO', 'returning:- '.print_r($retVal,TRUE) );
		return $retVal;
	}
}
?>