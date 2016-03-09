<?php
class Transaction_model extends CI_Model {



  function transactionDetail($limit = 0, $offset = 0)
    {
      $this->db->select('distinct(orders.txnid) As taxID');
      $this->db->select('orders.order_id As orderID');
      $this->db->select('orders.date_of_order As dateOfOrder');
      $this->db->where('orders.date_of_order>=','"2014-05-31 00:00:00"',FALSE);
      $this->db->order_by("orders.txnid", "desc");
      $query = $this->db->get('orders',$limit, ($offset-1)*$limit);
      return $query->result();
    }
     public function record_count() 
    {
      $this->db->select("distinct(orders.txnid)");
      $this->db->like("orders.date_of_order",'2014-05-31');
      $count = $this->db->count_all_results("orders");
      //$this->db->get();
      //$total = count($count);
      return $count;
    }

    function beforeCheckoutData($transID)
    {
      $this->db->select('beforeCheckout.bcData');
      $this->db->where("beforeCheckout.txnid",$transID );
      $this->db->from('beforeCheckout');
      $query = $this->db->get();
      return $query->result();
    }
    function afterCheckoutData($transID)
    {
      $this->db->select('afterCheckout.acData');
      $this->db->where("afterCheckout.txnid",$transID );
      $this->db->from('afterCheckout');
      $query = $this->db->get();
      return $query->result();
    }
  }
?>