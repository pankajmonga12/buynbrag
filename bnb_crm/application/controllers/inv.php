<?php
class Inv extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $retVals = array();
        if ($a === "default") {
            $retVals['db'] = base_url() . 'index.php/crm/sellerInvoice/' . $b;
            $retVals['dc'] = "Default Invoice";
            $retVals['dd'] = base_url() . 'index.php/crm/sellerInvoicePDFNew/' . $b;
            $retVals['de'] = "PDF";
        } else if ($a === "fedex") {
            $retVals['db'] = base_url() . 'index.php/crm/changeShippingPartner/' . $b . '/1';
            $retVals['dc'] = "Fedex Invoice";
            $retVals['dd'] = base_url() . 'index.php/crm/changeShippingPartnerPDF/' . $b . '/1';
            $retVals['de'] = "PDF";
            $retVals['df'] = base_url() . 'index.php/download/invoice/' . $b . '/1';
            $retVals['dg'] = "DL";
        } else if ($a === "bd") {
            $retVals['db'] = base_url() . 'index.php/crm/changeShippingPartner/' . $b . '/2';
            $retVals['dc'] = "BlueDart Invoice";
            $retVals['dd'] = base_url() . 'index.php/crm/changeShippingPartnerPDF/' . $b . '/2';
            $retVals['de'] = "PDF";
            $retVals['df'] = base_url() . 'index.php/download/invoice/' . $b . '/2';
            $retVals['dg'] = "DL";
        } else if ($a === "gati") {
            $retVals['db'] = base_url() . 'index.php/crm/changeShippingPartner/' . $b . '/3';
            $retVals['dc'] = "Gati Invoice";
            $retVals['dd'] = base_url() . 'index.php/crm/changeShippingPartnerPDF/' . $b . '/3';
            $retVals['de'] = "PDF";
            $retVals['df'] = base_url() . 'index.php/download/invoice/' . $b . '/3';
            $retVals['dg'] = "DL";
        }
        $retVals['updated'] = TRUE;
        $response = json_encode($retVals, JSON_FORCE_OBJECT);
        $this->output->set_content_type("application/json");
        $this->output->set_output($response);
    }

    public function updatepick()
    {
        $this->load->model('crm_model');
        $id = $this->input->post('a');
        $date = $this->input->post('b');
        $retVals = array();
        $query = $this->crm_model->updatepickup($date, $id);
        $retVals['updated'] = TRUE;
        $response = json_encode($retVals, JSON_FORCE_OBJECT);
        $this->output->set_content_type("application/json");
        $this->output->set_output($response);
    }
}

?>