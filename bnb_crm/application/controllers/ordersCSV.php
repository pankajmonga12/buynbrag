<?php if (!defined('BASEPATH')) exit('Direct Script Access not allowed');
class OrdersCSV extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('csv_model');
        $this->load->dbutil();
        $this->load->helper('download');
    }

    public function index()
    {
        $data['baseURL'] = base_url();
        $this->load->view('csv_view', $data);
        //$this->load->view('orders_csv', $data);
    }

    public function getCSV($fromOrderNumber = NULL, $toOrderNumber = NULL)
    {
        log_message('INFO', "Inside ordersCSV/getCSV");
        /* QUERY BEING USED
        select
        orders.order_id, orders.invoice_no, orders.txnid, orders.mihpayid, orders.bank_ref_num, orders.pg_type, orders.product_id, orders.status_order, orders.shipinPartStatus, orders.date_of_order, orders.quantity, orders.user_id, orders.store_id, orders.couponid, orders.redeemedprice, orders.amt_paid, orders.payment_status, orders.date_of_pickup, orders.time_of_pickup, orders.shipping_fname, orders.shipping_lname, orders.shipping_company, orders.shipping_address, orders.shipping_city, orders.shipping_state, orders.shipping_country, orders.shipping_pincode, orders.shipping_phoneno, orders.shipping_emailid, orders.shipping_cost, orders.shipping_partner, orders.mail_notify, orders.vsize, orders.vcolor, orders.awb_no,
        products.product_name AS productName,
        store_info.store_name, store_info.contact_name, store_info.contact_number, store_info.contact_email, store_info.communication_address, store_info.communication_city, store_info.communication_pincode
        from orders
        join products on products.product_id = orders.product_id
        join store_info on store_info.store_id = orders.store_id
        where orders.order_id >= 200 AND orders.order_id <= 250
        */
        $querySQL = "SELECT orders.order_id, orders.invoice_no, orders.txnid, orders.mihpayid, orders.bank_ref_num, orders.pg_type, orders.product_id, orders.status_order, orders.shipinPartStatus, orders.date_of_order, orders.quantity, orders.user_id, orders.store_id, orders.couponid, orders.redeemedprice, orders.amt_paid, orders.payment_status, orders.date_of_pickup, orders.time_of_pickup, orders.shipping_fname, orders.shipping_lname, orders.shipping_company, orders.shipping_address, orders.shipping_city, orders.shipping_state, orders.shipping_country, orders.shipping_pincode, orders.shipping_phoneno, orders.shipping_emailid, orders.shipping_cost, orders.shipping_partner, orders.mail_notify, orders.vsize, orders.vcolor, orders.awb_no,";
        $querySQL .= "products.product_name AS productName,";
        $querySQL .= "store_info.store_name, store_info.contact_name, store_info.contact_number, store_info.contact_email, store_info.communication_address, store_info.communication_city, store_info.communication_pincode";
        $querySQL .= " FROM orders";
        $querySQL .= " JOIN products ON products.product_id = orders.product_id";
        $querySQL .= " JOIN store_info ON store_info.store_id = orders.store_id";
        $querySQL .= " WHERE orders.order_id >= " . $this->db->escape($fromOrderNumber) . " AND orders.order_id <= " . $this->db->escape($toOrderNumber);
        log_message('INFO', "GOING TO RUN THE FOLLOWING QUERY\r\n" . print_r($querySQL, TRUE));
        $query = $this->db->query($querySQL);
        log_message('INFO', "DATA RETURNED IS_____\r\n" . print_r($query->result(), TRUE));
        $csvData = $this->dbutil->csv_from_result($query);
        $name = "OrdersData_from_orderID_" . $fromOrderNumber . "_to_" . $toOrderNumber . ".csv";
        force_download($name, $csvData);
    }
    
    public function storeCsv($storeID = NULL)
   {
      $this->load->dbutil();
      $storeCsv = $this->csv_model->storeInfo($storeID);
      $csvData = $this->dbutil->csv_from_result($storeCsv);
      $this->load->helper('download');
      $name = "StoreData_from_storeID_" .$storeID.".csv";
      force_download($name, $csvData); 
      return;
    }
    public function allstoreCsv()
    {
      $this->load->dbutil();
      $storeCsv = $this->csv_model->allstoreInfo();
      $csvData = $this->dbutil->csv_from_result($storeCsv);
      $this->load->helper('download');
      $name = "all_Store_Details.csv";
      force_download($name, $csvData); 
      return;
    }
    public function productCsv($startID = NULL,$endID = NULL)
    {
      $productCsv = $this->csv_model->productList($startID,$endID);
      $csvData = $this->dbutil->csv_from_result($productCsv);
      $name = "productData_from_productID_" . $startID . "_to_" . $endID . ".csv";
      force_download($name, $csvData);
    }

    public function UserCSV($startID = NULL,$endID = NULL)
    {
      $userCsv = $this->csv_model->userList($startID,$endID);
      $csvData = $this->dbutil->csv_from_result($userCsv);
      $name = "USERData_from_userID_" . $startID . "_to_" . $endID . ".csv";
      force_download($name, $csvData);
    }

    public function UserCSVEmail($email = NULL)
    {
      $userCsv = $this->csv_model->userListbyEmail( urldecode($email) );
      $csvData = $this->dbutil->csv_from_result($userCsv);
      $name = "USERData_OF_userEMAIL_" . $email . ".csv";
      force_download($name, $csvData);
    }
    
    public function CSVUserID($userID = NULL)
    {
      $userCsv = $this->csv_model->userListbyID($userID);
      $csvData = $this->dbutil->csv_from_result($userCsv);
      $name = "USERData_OF_userID_" . $userID . ".csv";
      force_download($name, $csvData);
    }
    
    public function CSVCartDetail()
    {
      $cartCsv = $this->csv_model->CartDetail();
      $csvData = $this->dbutil->csv_from_result($cartCsv);
      $name = "CartDetail_OF_users.csv";
      force_download($name, $csvData);
    }
     public function CSVstoreProduct($storeID)
    {
      $storeCsv = $this->csv_model->storeProducts($storeID);
      $csvData = $this->dbutil->csv_from_result($storeCsv);
      $this->load->helper('download');
      $name = "productData_from_storeID_" . $storeID . ".csv";
      force_download($name, $csvData);
    }
}

?>