<?php if (!defined('BASEPATH')) exit('Direct script access not allowed');

class Download extends CI_Controller
{
    public function __constructor()
    {
        parent::__constructor();
    }

    public function index($storeID, $productID, $orderID)
    {
        $this->load->helper('download');
        $data = file_get_contents("https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/" . $storeID . "/" . $productID . "/fancy1.jpg"); // Read the file's contents
        $name = 'order_no_' . $orderID . '.jpg';
        force_download($name, $data);
    }

    public function invoice($orderID, $shippingPartner)
    {
        $this->load->helper('download');
        $data = file_get_contents(base_url() . "index.php/crm/changeShippingPartnerPDF/" . $orderID . "/" . $shippingPartner); // Read the file's contents

        $partnerName = "";
        if ($shippingPartner == 1) {
            $partnerName = "FEDEX_";
        } elseif ($shippingPartner == 2) {
            $partnerName = "BLUE_DART_";
        } elseif ($shippingPartner == 3) {
            $partnerName = "GATI_";
        }

        $name = $partnerName . 'shipping_label_order_' . $orderID . '.pdf';
        force_download($name, $data);
    }
}

?>