<?php
class Crm extends CI_Controller
{
    //public $archBits = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata');
        $this->load->model('crm_model');
        //error_reporting(E_ALL);
        //ini_set('display_errors', 1);
        $this->archBits = 64;
    }

    public function logout()
    {
        $this->session->unset_userdata('status');
    }

    public function index($crm_tab = 0)
    {
        $datepick = $this->input->post('datepickup');
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        //Start Thejas Stores
        $data['stores'] = $this->crm_model->get_stores();
        $data['pickup'] = $this->crm_model->pickup($datepick);
        $data['crm_tab'] = $crm_tab;
        //End Thejas Stores
        $data['base_url'] = base_url();
        $data['buyer_first_name'] = '';
        $data['buyer_last_name'] = '';
        $data['joined_date'] = '';
        $data['email'] = '';
        $data['mobile'] = '';
        $data['dob'] = '';
        $data['shipping_address'] = '';
        $data['shipping_city'] = '';
        $data['shipping_state'] = '';
        $data['shipping_country'] = '';
        $data['shipping_pincode'] = '';
        $data['last_purchase_date'] = '';
        $this->form_validation->set_rules('emailid', 'Email Address', 'trim|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|numeric|min_length[10]|max_length[10]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('a.php', $data);
        } else {
            $mobile_no = $this->input->post('mobile');
            if (!empty($mobile_no)) {
                $order_details = $this->crm_model->order_details_mob($mobile_no);
                if (!empty($order_details)) {
                    $data['order_list'] = $this->crm_model->order_lists($order_details[0]['user_id']);
                    $user_details = $this->crm_model->user_details($order_details[0]['user_id']);
                    $data['buyer_first_name'] = $order_details[0]['shipping_fname'];
                    $data['buyer_last_name'] = $order_details[0]['shipping_lname'];
                    $data['joined_date'] = $user_details['joined_date'];
                    $data['email'] = $order_details[0]['shipping_emailid'];
                    $data['mobile'] = $mobile_no;
                    $data['dob'] = $user_details['dob'];
                    $data['shipping_address'] = $order_details[0]['shipping_address'];
                    $data['shipping_city'] = $order_details[0]['shipping_city'];
                    $data['shipping_state'] = $order_details[0]['shipping_state'];
                    $data['shipping_country'] = $order_details[0]['shipping_country'];
                    $data['shipping_pincode'] = $order_details[0]['shipping_pincode'];
                    $data['last_purchase_date'] = date('D jS, M Y - g:i:s A', strtotime($order_details[0]['date_of_order']));
                } else {
                    echo '<span style = "color: red";>' . "No Order has been placed yet using this Mobile Number: $mobile_no!" . '</span>';
                }
                #echo '<br>'.anchor('crm', 'Try it again!');
            }
            $this->load->view('a.php', $data);
        }
    }

    public function modify_buyer_orders($order_id)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $data['base_url'] = base_url();
        $data['order_details'] = $this->crm_model->change_order_details($order_id);
        $data['order_id'] = $order_id;
        if ($data['order_details']['status_order'] == 1) {
            $data['order_details']['status_order'] = 'Yet To Process';
            $data['val'] = 1;
        } elseif ($data['order_details']['status_order'] == 2) {
            $data['order_details']['status_order'] = 'In Process';
            $data['val'] = 2;
        } elseif ($data['order_details']['status_order'] == 3) {
            $data['order_details']['status_order'] = 'Shipped';
            $data['val'] = 3;
        } elseif ($data['order_details']['status_order'] == 4) {
            $data['order_details']['status_order'] = 'Completed';
            $data['val'] = 4;
        } elseif ($data['order_details']['status_order'] == 5) {
            $data['order_details']['status_order'] = 'Cancel Order';
            $data['val'] = 5;

        } elseif ($data['order_details']['status_order'] == 6) {
            $data['order_details']['status_order'] = 'Problem with Order';
            $data['val'] = 6;
            } elseif ($data['order_details']['status_order'] == 7) {
            $data['order_details']['status_order'] = 'Test Order';
            $data['val'] = 7;
        }
        $this->load->view('modify', $data);
    }

    public function modify_orders($order_id)
    {
        $status = $this->session->userdata('status');
        if (empty($status))
        {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $status = $this->input->get('status');
        $mode = $this->input->get('mode');
        $shipping_address = $this->input->get('shipping_address');
        $shipping_city = $this->input->get('shipping_city');
        $shipping_state = $this->input->get('shipping_state');
        $shipping_country = $this->input->get('shipping_country');
        $shipping_pincode = $this->input->get('shipping_pincode');
        $this->crm_model->save_order_changes($status, $mode, $shipping_address, $shipping_city, $shipping_state, $shipping_country, $shipping_pincode, $order_id);
        echo 'Sucessfully Updated';
    }

    public function modify_last_purchase_details()
    {
//
    }

    public function datePicker($date)
    {
        if (!empty($date)) {
            $this->db->model('crm_model');
            $dateChanged = $this->crm_model->update_db($date);
            $responseData['dateChanged'] = $dateChanged;
            $response = json_encode($reponseData, JSON_FORCE_OBJECT);
            $this->output->set_content_type('application/json');
            $this->output->set_output($responseData);
        }
    }

    public function save_store($did)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $v1 = $this->input->get('s1');
        $v2 = $this->input->get('s2');
        $v3 = $this->input->get('s3');
        $v4 = $this->input->get('s4');
        $v5 = $this->input->get('s5');
        $v6 = $this->input->get('s6');
        $v7 = $this->input->get('s7');
        echo $this->crm_model->save_stores($store_id, $v1, $v2, $v3, $v4, $v5, $v6, $v7);
    }

    public function store($name, $order_status = 0, $pageNumber = NULL)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $live_url = 'http://www.buynbrag.com/';
        //$live_url = 'http://localhost/bnbl/';
        $this->load->model('crm_model');
        if (is_null($pageNumber)) // if the pageNumber is not specified
        {
            $pageNumber = 0; // set the pageNumber to 0 (the first page)
        }
        $totalOrders = $this->crm_model->maxOrderbyname($name); // maximum orderIDs
        $totalNumberOfPages = $totalOrders / 50; // total number of pages
        $currentPageNumber = $pageNumber; // store the current page number
        $s_ord = $this->crm_model->store_names();
        $s_order = $this->crm_model->order_details_storebyname($name, $order_status, $pageNumber);
        $allOrdersxxx = array();
        $allTxnsxxx = array();
        $allvendors = array();
        $rowColor = 0;
        ?>
        <?php foreach ($s_order as $row) {
        $allvendors[] = $row['order_id'];
    } ?>
        <input id="allvendors" type="HIDDEN" value="<?php echo implode(',', $allvendors); ?>"/>
        <a href="/bnb_crm/index.php/crm/">Home</a>
        <h3 align="center"><strong>(Showing orders from <?php echo $name; ?>)</strong></h3><br/>
        <p>
            <label>With selected, change status to</label>
            <select name="operations" id="operationsAllxxx">
                <option value="1">Restart Processing</option>
                <option value="2">Start Processing</option>
                <option value="3">Shipping</option>
                <option value="4">Completed</option>
                <option value="5">Cancel Order</option>
                <option value="6">Problem with Order/Invoice</option>
                <option value="7">Test Order</option>
                <option value="21">[USE WITH CAUTION]Regenerate Invoice(with Old AWB Code)</option>
                <option value="22">[USE WITH CAUTION]Regenerate Invoice(with New AWB Code)</option>
            </select>
            <input type="BUTTON" value=" Go " onClick="modifyOrders()"/>
        </p>
<!--        <style type="text/css">-->
<!--            .ordersTable {-->
<!--                width: 100%;-->
<!--                border-collapse: collapse;-->
<!--                border-color: #0a6d52;-->
<!--                border-width: 3px;-->
<!--                cell-padding: 2px;-->
<!--                background-color: #fff;-->
<!--                color: #0a6d52;-->
<!--            }-->
<!---->
<!--            .ordersTable TR, .ordersTable TD {-->
<!--                border: 3px solid #0a6d52;-->
<!--            }-->
<!--        </style>-->
        <table border="1" class="ordersTable">
        <tr>
            <td colspan="13">
                <div style="width: 100%">
                    <?php
                    for ($i = 0; $i < $totalNumberOfPages; $i++) {
                        if ($i == $currentPageNumber) {
                            print "<b title=\"You are on this page\" >" . $i . "</b>&nbsp;|&nbsp;";
                        } else {
                            print "<a href=\"#\" onClick=\"all_order_filterstore(" . $name . "," . $i . ")\">" . $i . "</a>&nbsp;|&nbsp;";
                        }
                    }
                    ?>
                </div>
            </td>
        </tr>
        <tr align="center" style="background-color: #525252; color: #fff">
            <th>Select</th>
            <th scope="col">Store Name</th>
            <th scope="col">Order ID</th>
            <th scope="col">Ordered Date</th>
            <th scope="col">Last Date For PickUP</th>
            <th scope="col">Logistics Partner</th>
            <th scope="col">Track ID</th>
            <th scope="col">Product Information</th>
            <th scope="col">Product Image</th>
            <th scope="col">Qty</th>
            <th scope="col">Paid Price(Total)</th>
            <th scope="col">Order status</th>
            <th scope="col">Action</th>
            <th scope="col">Buyer Invoice</th>
            <th scope="col">Shipping Label</th>
            <th scope="col">Send Mail</th>
        </tr>
        <?php foreach ($s_order as $row) { ?>
            <?php
            $allOrdersxxx[] = $row['order_id'];
            $allTxnsxxx[] = $row['txnid'];
            ?>
            <tr align="center">
                <td>
                    <?php
                    //if($row['status_order'] != 4 && $row['status_order'] != 5)
                    {
                        ?>
                        <input type="CHECKBOX" id="orderNo<?php echo $row['order_id']; ?>">
                    <?php
                    }
                    ?>
                </td>
                <td><span style="cursor:pointer" onclick="seller_info(<?php echo $row['order_id']; ?>)"></td>
                <td><strong><font color="#990066"><?php echo $row['order_id']; ?></font></strong></td>
                <td><strong><font color="#330066"><?php echo $row['orderdate']; ?></font></strong></td>
                <?php $Date = $row['date_of_order'];
                $edate = date('Y-m-d', strtotime($Date . ' + ' . $row['processing_time'] . ' days'));?>
                <td><strong><font color="#330066"><?php echo $edate; ?></font></strong></td>
                <td>
                    <select class="invoice">
                        <option class="selectedOption" value="default_<?php echo $row['order_id']; ?>"
                                id="default_<?php echo $row['order_id']; ?>">Default
                        </option>
                        <option class="selectedOption" value="fedex_<?php echo $row['order_id']; ?>"
                                id="fedex_<?php echo $row['order_id']; ?>">Fedex
                        </option>
                        <option class="selectedOption" value="gati_<?php echo $row['order_id']; ?>"
                                id="gati_<?php echo $row['order_id']; ?>">Gati
                        </option>
                        <option class="selectedOption" value="bd_<?php echo $row['order_id']; ?>"
                                id="bd_<?php echo $row['order_id']; ?>">Blue Dart
                        </option>
                    </select>
                </td>

                <td style=" color: #0a6d52">
                    <strong>
                        <font color="#006600">
                            
                            
                    <?php
                            if (!is_null($row['awb_no'])) {
                                echo $row['awb_no'] . "<hr/>";
                                print'<p> UPDATE AWB NO: <input type="text" id="genrateawbNO"></p>';
                                 print '<input type = "button" value = "save awb no" onclick = "updateAWBNO(\''.$row['order_id'].'\')">'; 
                                
                            }
                            if ($row['shipping_partner'] == 3) // if the shipping partner is gati
                            {
                                echo "<font color=\"red\">Not Applicable</font>";
                                if (!is_null($row['awb_no'])) // and still an AWB NO has been generated, then provide a link to re-claim it
                                {
                                    // print '<a target="_blank" href="'.base_url().'index.php/crm/reclaimAWBNO/'.$row['awb_no'].'">Reclaim AWB NO</a>';
                                    /* THIS FEATURE CAN NOT BE MADE BECAUSE OF DB LIMITATIONS */
                                }
                            } else {
                                if ((is_null($row['awb_no']) || strcmp($row['awb_no'], "") === 0) && $row['status_order'] != 5) // if no AWB NO has been generated
                                {
                                    print '<input type="BUTTON" onCLick="window.open(\'' . base_url() . 'index.php/crm/generateAWBNO/' . $row['order_id'] . '\',\'\',\'width=200,height=100\')" value="Generate AWB NO">';
                                  print'<p>AWB NO: <input type="text" id="genrateawbNO"></p>';
                               print '<input type = "button" value = "save awb no" onclick = "updateAWBNO(\''.$row['order_id'].'\')">';  
                                }
                            }
                            ?>
                            
                        </font>
                    </strong>
                </td>
                <td><strong><font color="#330066">
                            Name : <?php echo $row['product_name']; ?></br>
                            Code : <?php echo $row['bnb_product_code']; ?></br>
                            Size : <?php echo $row['vsize']; ?></br>
                            Colour : <?php echo $row['vcolor']; ?></br>
                        </font></strong>
                </td>
                <td>
                    <img style="cursor:pointer" onclick="product_info(<?php echo $row['order_id']; ?>)" alt="Product"
                         height="70"
                         src="https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/<?php echo $row['store_id']; ?>/<?php echo $row['product_id']; ?>/img1_97x80.jpg"/>
                    <br/><a
                        href="<?php echo base_url(); ?>index.php/download/index/<?php echo $row['store_id'] . '/' . $row['product_id'] . '/' . $row['order_id']; ?>"
                        target="_blank"> Download Image </a>
                </td>
                <td><strong><?php echo $row['quantity']; ?></strong></td>
                <td>
                    <div style="cursor:pointer" onclick="payment_info(<?php echo $row['order_id']; ?>)">
                        <img src="<?php echo base_url(); ?>assets/<?php echo $row['pg_type']; ?>.png" width="80"
                             alt="payment_mode"><br>
                        <?php $total = ($row['quantity'] * $row['amt_paid'] * (1 - $row['redeemedprice']));
                        ?>
                        <strong>Rs.<br><?php echo floatval($total); ?>.00</strong>
                    </div>
                </td>
                <?php
                if ($row['status_order'] == 1)
                    $status = '<img src="' . base_url() . 'assets/pending.png" width="120" alt="Pending New Order" />';
                elseif ($row['status_order'] == 2)
                    $status = '<img src="' . base_url() . 'assets/process.png" width="120" alt="In Process" />'; elseif ($row['status_order'] == 3)
                    $status = '<img src="' . base_url() . 'assets/shipping.png" width="120" alt="Shipping" />'.'Date Of Pickup:'.$row['date_of_pickup'].'Airway NO'.$row['awb_no']; elseif ($row['status_order'] == 4)
                    $status = '<img src="' . base_url() . 'assets/completed.png" width="120" alt="Completed" />'.'Date Of Pickup:'.$row['date_of_pickup'].'Airway NO'.$row['awb_no']; elseif ($row['status_order'] == 5)
                    $status = '<img src="' . base_url() . 'assets/cancelled.png" width="120" alt="Cancelled" />'; elseif ($row['status_order'] == 6)
                    $status = 'Problem with Order/Invoice<br><img src="' . base_url() . 'assets/problem.png" width="120" alt="Problem with Order" />';elseif ($row['status_order'] == 7)
                    $status = 'Test Order<br><img src="' . base_url() . 'assets/test.png" width="120" alt="Test Order" />'; else $status = 'not defined';?>
                <td><?php echo $status; ?></td>
                <td>
                    <?php if (!($row['status_order'] == 5) and !($row['status_order'] == 4)) : ?>
                        <select id="bnb_sts_<?php echo $row['order_id']; ?>">
                            <option value="1">Restart Processing</option>
                            <?php if ($row['status_order'] == 1) : ?>
                                <option value="2">Start Processing</option>
                                <option value="3">Shipping</option>
                                <option value="4">Completed</option>
                                <option value="5">Cancel Order</option>
                                <option value="6">Problem with Order</option>
                                <option value="7">Test Order</option>

                            <?php elseif ($row['status_order'] == 2) : ?>
                                <option value="3" onclick='popup(this.value,<?php echo $row['order_id']; ?>);'>
                                    Shipping
                                </option>
                                <option value="4">Completed</option>
                                <option value="5">Cancel Order</option>
                                <option value="6">Problem with Order/Invoice</option>
                                <option value="7">Test Order</option>
                            <?php elseif ($row['status_order'] == 3) : ?>
                                <option value="4">Completed</option>
                                <option value="5">Cancel Order</option>
                                <option value="6">Problem with Invoice</option>
                                <option value="7">Test Order</option>
                            <?php elseif ($row['status_order'] == 6) : ?>
                                <option value="21">Regenerate Invoice(with Old AWB Code)</option>
                                <option value="22">Regenerate Invoice(with New AWB Code)</option>
                                <option value="5">Cancel Order</option>
                                <option value="7">Test Order</option>
                            <?php endif; ?>
                        </select><br>

                        <input type="text" name="shippingdate" id="shippingdate<?php echo $row['order_id']; ?>"
                               placeholder="Shipping date YYYY-MM-DD" style='display:none'/><br>
                        <input type="text" name="shippingtime" id="shippingtime<?php echo $row['order_id']; ?>"
                               placeholder="Shipping time HH:MM" style='display:none'/>

                        <input type="button" value="Go"
                               onclick='return all_modify_status(<?php echo $row['order_id']; ?>,"<?php echo $row['txnid']; ?>", <?php echo $currentPageNumber; ?>)'/>
                    <?php elseif ($row['status_order'] == 4): ?>
                        <img src="<?php echo base_url(); ?>assets/completed.png" width="120" alt="Completed Oder"/>
                        
                    <?php else: ?>
                        <img src="<?php echo base_url(); ?>assets/cancelled.png" width="120" alt="Cancelled Oder"/>
                    <?php endif; ?>
                </td>
                <td>
                    <?php $filename1 = $live_url . 'invoice/' . $row['txnid'] . '/buyer_invoice_order_' . $row['order_id'] . '.pdf'; ?>
                    <table>
                        <tr>
                            <td rowspan="2"><a target="_blank" href="<?php echo $filename1; ?>"><img
                                        src="<?php echo base_url(); ?>assets/pdficon.gif" width="55"
                                        alt="PDF Icon"/></a></td>
                            <!--<td><input type="BUTTON" value="Explicit Email to Buyer" onClick="return emailInvoiceToBuyer(<?php $row['order_id']; ?>, '<?php $row['txnid']; ?>')" /></td>-->
                        </tr>
                        <!--<tr>
							<td><input type="BUTTON" value="Explicit Email to Seller" onClick="return emailInvoiceToSeller(<?php $row['order_id']; ?>, '<?php $row['txnid']; ?>')" /></td>
						</tr>-->
                    </table>
                </td>
                <td id="shivam_<?php echo $row['order_id']; ?>">
                </td>
                <td>
                    <div class="mail1"><input type="button" value="Send Mail" onclick="semail()" id="mail"></div>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="13">
                <div style="width: 100%; text-align: right">
                    <?php
                    for ($i = 0; $i < $totalNumberOfPages; $i++) {
                        if ($i == $currentPageNumber) {
                            print "<b title=\"You are on this page\" >" . $i . "</b>&nbsp;|&nbsp;";
                        } else {
                            print "<a href=\"#\" onClick=\"all_order_filter_paged(" . $i . ")\">" . $i . "</a>&nbsp;|&nbsp;";
                        }
                    }
                    ?>
                </div>
            </td>
        </tr>
        </table>
        <input id="allOrdersxxx" type="HIDDEN" value="<?php echo implode(',', $allOrdersxxx); ?>"/>
        <input id="allTxnsxxx" type="HIDDEN" value="<?php echo implode(',', $allTxnsxxx); ?>"/>
    <?php
    }

    public function orders_all($order_status = 0, $pageNumber = NULL)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $live_url = 'http://www.buynbrag.com/';
        //$live_url = 'http://localhost/bnbl/';
        $this->load->model('crm_model');
        if (is_null($pageNumber)) // if the pageNumber is not specified
        {
            $pageNumber = 0; // set the pageNumber to 0 (the first page)
        }
        $totalOrders = $this->crm_model->maxOrderID(); // maximum orderIDs
        $totalNumberOfPages = $totalOrders / 50; // total number of pages
        $currentPageNumber = $pageNumber; // store the current page number
        $s_order = $this->crm_model->order_details_all($order_status, $pageNumber);
        $s_ord = $this->crm_model->store_names();
        $allOrdersxxx = array();
        $allTxnsxxx = array();
        $allvendors = array();
        $rowColor = 0;
        ?>
        <?php foreach ($s_order as $row) {
        $allvendors[] = $row['order_id'];
    } ?>
        <input id="allvendors" type="HIDDEN" value="<?php echo implode(',', $allvendors); ?>"/>
        <h3><strong>(Showing orders from ORDER
                ID <?php echo ($totalOrders - ($currentPageNumber * 50)) . " - " . (($totalOrders - ($currentPageNumber * 50)) - 50); ?>
                )</strong></h3><br/>
        <p>
            <label>With selected, change status to</label>
            <select name="operations" id="operationsAllxxx">
                <option value="1">Restart Processing</option>
                <option value="2">Start Processing</option>
                <option value="3">Shipping</option>
                <option value="4">Completed</option>
                <option value="5">Cancel Order</option>
                <option value="6">Problem with Order/Invoice</option>
                <option value="7">Test Order</option>
                <option value="21">[USE WITH CAUTION]Regenerate Invoice(with Old AWB Code)</option>
                <option value="22">[USE WITH CAUTION]Regenerate Invoice(with New AWB Code)</option>
            </select>
            <input type="BUTTON" value=" Go " onClick="modifyOrders()"/>
        </p>
<!--        <style type="text/css">-->
<!--            .ordersTable {-->
<!--                width: 100%;-->
<!--                border-collapse: collapse;-->
<!--                border-color: #0a6d52;-->
<!--                border-width: 3px;-->
<!--                cell-padding: 2px;-->
<!--                background-color: #fff;-->
<!--                color: #0a6d52;-->
<!--            }-->
<!---->
<!--            .ordersTable TR, .ordersTable TD {-->
<!--                border: 3px solid #0a6d52;-->
<!--            }-->
<!---->
<!--            .article {-->
<!--                width: 100px;-->
<!--                height: 100px;-->
<!--                background: #333;-->
<!--                float: left;-->
<!--                margin: 5px;-->
<!--            }-->
<!--        </style>-->
        <table border="1" class="ordersTable">
        <tr>
            <td colspan="13">
                <div style="width: 100%; text-align: right">
                    <?php
                    for ($i = 0; $i < $totalNumberOfPages; $i++) {
                        if ($i == $currentPageNumber) {
                            print "<b title=\"You are on this page\" >" . $i . "</b>&nbsp;|&nbsp;";
                        } else {
                            print "<a href=\"#\" onClick=\"all_order_filter_paged(" . $i . ")\">" . $i . "</a>&nbsp;|&nbsp;";
                        }
                    }
                    ?>
                </div>
            </td>
        </tr>
        <tr align="center" style="background-color: #525252; color: #fff">
            <th>Select</th>
            <th scope="col">Store Name<select name="store_dropdown" class="str" id = "selectStore">
                    <option id="nameofstore" selected="selected" value="0">- - Select Store - -</option>
                    <?php foreach ($s_ord as $row1) : ?>
                        <option value="<?php echo $row1['store_name']; ?>"><?php echo $row1['store_name']; ?></option>
                    <?php endforeach; ?>
                </select><input type="button" value="Go" onclick = "selectStore()"></th>
            <th scope="col">Order ID <br>---------<br> Transaction ID</th>
            <th scope="col">Ordered Date
                <select class="obdate" id = "selectOrderedDate">
                    <option>--Select Date--</option>
                    <?php
                    $Date = date('Y-m-d');
                    for ($i = 0; $i < 30; $i++) {
                        $edate = date('Y-m-d', strtotime($Date . ' - ' . $i . ' days'));
                        ?>
                        <option value=<?php echo $edate; ?>><?php echo $edate; ?></option>
                    <?php
                    }
                    ?>
                </select><input type="button" value="Go" onclick = "selectOrderedDate()">
            </th>
            <th scope="col">Last Date For PickUP
                <select class="pudate" id = "selectPickupDate">
                    <option>--Select Date--</option>
                   <?php
                    $p=50;
                    $Date = date('Y-m-d');
                    $Date = date('Y-m-d', strtotime($Date. ' + '.$p.' days'));
                    for($i=0;$i<90;$i++)
                    {
                        $edate = date('Y-m-d', strtotime($Date. ' - '.$i.' days'));
                        ?>
                        <option value=<?php echo $edate;?>><?php echo $edate;?></option>
                    <?php
                    }
                    ?>
                </select><input type="button" value="Go" onclick = "selectPickupDate()">
            </th>
            <th scope="col">Logistics Partner</th>
            <th scope="col">Track ID</th>
            <th scope="col">Product Information</th>
            <th scope="col">Product Image</th>
            <th scope="col">Qty</th>
            <th scope="col">Paid Price(Total)</th>
            <th scope="col">BNB Discount</th>
            <th scope="col">Seller Earnings</th>
            <th scope="col">Order status</th>
            <th scope="col">Action</th>
            <th scope="col">Buyer Invoice</th>
            <th scope="col">Shipping Label</th>
            <th scope="col">Send Mail</th>
        </tr>
        <?php foreach ($s_order as $row) { ?>
            <?php
            $allOrdersxxx[] = $row['order_id'];
            $allTxnsxxx[] = $row['txnid'];
            ?>
            <tr align="center" id="<?php echo $row['order_id']; ?>">
                <td>
                    <?php
                    //if($row['status_order'] != 4 && $row['status_order'] != 5)
                    {
                        ?>
                        <input type="CHECKBOX" id="orderNo<?php echo $row['order_id']; ?>">
                    <?php
                    }
                    ?>
                </td>
                <td><span style="cursor:pointer"
                          onclick="seller_info(<?php echo $row['order_id']; ?>)"><?php echo $row['store_name']; ?></span>
                </td>
                <td><strong><font color="#990066"><?php echo $row['order_id']; ?><br>-----------<br><a href="#" onclick="Checkout('<?php echo $row['txnid']; ?>')"><?php echo $row['txnid']; ?></a></font></strong></td>
                <td><strong><font color="#330066"><?php echo $row['orderdate']; ?></font></strong></td>
                <?php //$Date = $row['date_of_order'];
                //$edate = date('Y-m-d', strtotime($Date. ' + '.$row['processing_time'].' days'));
                //$b = $this->crm_model->insertpickup($edate,$row['order_id']);
                ?>
                <td>
                    <strong><font color="#330066"><?php echo $row['date_of_pickup']; ?></font></strong>
                    <!--<input type="text" onmouseout="pickdate(this.id)" id="<?php echo $row['order_id']; ?>">-->
                    <!--<p id = "pickupDate"></p>-->
                    <input type ="text" onclick ="updatePickupDate()"> 


            </td>
                <td>
                    <select class="invoice">
                        <option class="selectedOption" value="default_<?php echo $row['order_id']; ?>"
                                id="default_<?php echo $row['order_id']; ?>">Default
                        </option>
                        <option class="selectedOption" value="fedex_<?php echo $row['order_id']; ?>"
                                id="fedex_<?php echo $row['order_id']; ?>">Fedex
                        </option>
                        <option class="selectedOption" value="gati_<?php echo $row['order_id']; ?>"
                                id="gati_<?php echo $row['order_id']; ?>">Gati
                        </option>
                        <option class="selectedOption" value="bd_<?php echo $row['order_id']; ?>"
                                id="bd_<?php echo $row['order_id']; ?>">Blue Dart
                        </option>
                    </select>
                </td>

                <td style=" color: #0a6d52">
                    <strong>
                        <font color="#006600">
                            <?php
                            if (!is_null($row['awb_no'])) {
                                echo $row['awb_no'] . "<hr/>";
                                print'<p> UPDATE AWB NO: <input type="text" id="genrateawbNO"></p>';
                                 print '<input type = "button" value = "save awb no" onclick = "updateAWBNO(\''.$row['order_id'].'\')">'; 
                            }
                            if ($row['shipping_partner'] == 3) // if the shipping partner is gati
                            {
                                echo "<font color=\"red\">Not Applicable</font>";
                                if (!is_null($row['awb_no'])) // and still an AWB NO has been generated, then provide a link to re-claim it
                                {
                                    // print '<a target="_blank" href="'.base_url().'index.php/crm/reclaimAWBNO/'.$row['awb_no'].'">Reclaim AWB NO</a>';
                                    /* THIS FEATURE CAN NOT BE MADE BECAUSE OF DB LIMITATIONS */
                                }
                            } else {
                                if ((is_null($row['awb_no']) || strcmp($row['awb_no'], "") === 0) && $row['status_order'] != 5) // if no AWB NO has been generated
                                {
                                    print '<input type="BUTTON" onCLick="window.open(\'' . base_url() . 'index.php/crm/generateAWBNO/' . $row['order_id'] . '\',\'\',\'width=200,height=100\')" value="Generate AWB NO">';
                                    print'<p>AWB NO: <input type="text" id="genrateawbNO"></p>';
                                    print '<input type = "button" value = "save awb no" onclick = "updateAWBNO(\''.$row['order_id'].'\')">'; 
                                }
                            }
                            ?>
                            
                        </font>
                    </strong>
                </td>
                <td><strong><font color="#330066">
                            Name : <?php echo $row['product_name']; ?></br>
                            Code : <?php echo $row['bnb_product_code']; ?></br>
                            Size : <?php echo $row['vsize']; ?></br>
                            Colour : <?php echo $row['vcolor']; ?></br>
                        </font></strong>
                </td>
                <td>
                    <img style="cursor:pointer" onclick="product_info(<?php echo $row['order_id']; ?>)" alt="Product"
                         height="70"
                         src="https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/<?php echo $row['store_id']; ?>/<?php echo $row['product_id']; ?>/img1_97x80.jpg"/>
                    <br/><a
                        href="<?php echo base_url(); ?>index.php/download/index/<?php echo $row['store_id'] . '/' . $row['product_id'] . '/' . $row['order_id']; ?>"
                        target="_blank"> Download Image </a>
                </td>
                <td><strong><?php echo $row['totalQuantity']; ?></strong></td>
                <td>
                    <div style="cursor:pointer" onclick="payment_info(<?php echo $row['order_id']; ?>)">
                        <img src="<?php echo base_url(); ?>assets/<?php echo $row['pg_type']; ?>.png" width="80"
                             alt="payment_mode"><br>
                        <?php $total = ceil(($row['totalQuantity'] * $row['amt_paid'] - $row['redeemedprice']));
                        ?>
                        <strong>Rs.<br><?php echo floatval($total); ?>.00</strong>
                    </div>
                </td>
                <?php
                if ($row['status_order'] == 1)
                    $status = '<img src="' . base_url() . 'assets/pending.png" width="120" alt="Pending New Order" />';
                elseif ($row['status_order'] == 2)
                    $status = '<img src="' . base_url() . 'assets/process.png" width="120" alt="In Process" />'; elseif ($row['status_order'] == 3)
                    $status = '<img src="' . base_url() . 'assets/shipping.png" width="120" alt="Shipping" />'.'Date Of Pickup:'.$row['date_of_pickup'].'Airway NO'.$row['awb_no']; 
                    elseif ($row['status_order'] == 4)
                    $status = '<img src="' . base_url() . 'assets/completed.png" width="120" alt="Completed" />'.'Date Of Pickup:'.$row['date_of_pickup'].'Airway NO'.$row['awb_no'];elseif ($row['status_order'] == 5)
                    $status = '<img src="' . base_url() . 'assets/cancelled.png" width="120" alt="Cancelled" />'; elseif ($row['status_order'] == 6)
                    $status = 'Problem with Order/Invoice<br><img src="' . base_url() . 'assets/problem.png" width="120" alt="Problem with Order" />';elseif ($row['status_order'] == 7)
                    $status = 'Test Order<br><img src="' . base_url() . 'assets/test.png" width="120" alt="Test Order" />'; else $status = 'not defined';?>
                <td><?php echo $row['discount']; ?></td>
                <td><?php echo $row['seller_earnings']; ?></td>
                <td><?php echo $status; ?></td>
                <td>
                    <?php if (!($row['status_order'] == 5) and !($row['status_order'] == 4)) : ?>
                        <select id="bnb_sts_<?php echo $row['order_id']; ?>">
                            <option value="1">Restart Processing</option>
                            <?php if ($row['status_order'] == 1) : ?>
                                <option value="2">Start Processing</option>
                                <option value="5">Cancel Order</option>
                                <option value="7">Test Order</option>
                                <option value="6">Problem with Order</option>
                                

                            <?php elseif ($row['status_order'] == 2) : ?>
                                <option value="3" onclick='popup(this.value,<?php echo $row['order_id']; ?>);'>
                                    Shipping
                                </option>

                                <option value="5">Cancel Order</option>
                                <option value="7">Test Order</option>
                                <option value="6">Problem with Order/Invoice</option>
                                
                            <?php elseif ($row['status_order'] == 3) : ?>
                                <option value="4">Completed</option>
                                <option value="5">Cancel Order</option>
                                <option value="7">Test Order</option>
                                <option value="6">Problem with Invoice</option>
                                
                            <?php elseif ($row['status_order'] == 6) : ?>
                                <option value="21">Regenerate Invoice(with Old AWB Code)</option>
                                <option value="22">Regenerate Invoice(with New AWB Code)</option>
                                <option value="7">Test Order</option>
                                <option value="5">Cancel Order</option>
                                
                            <?php endif; ?>
                        </select><br>

                        <input type="text" name="shippingdate" id="shippingdate<?php echo $row['order_id']; ?>"
                               placeholder="Shipping date YYYY-MM-DD" style='display:none'/><br>
                        <input type="text" name="shippingtime" id="shippingtime<?php echo $row['order_id']; ?>"
                               placeholder="Shipping time HH:MM" style='display:none'/>

                        <input type="button" value="Go"
                               onclick='return all_modify_status(<?php echo $row['order_id']; ?>, "<?php echo $row['txnid']; ?>", <?php echo $currentPageNumber; ?>,<?php echo $row['product_id']; ?>,<?php echo $row['totalQuantity']; ?>)'/>



                    <?php elseif ($row['status_order'] == 4): ?>
                        <img src="<?php echo base_url(); ?>assets/completed.png" width="120" alt="Completed Oder"/>
                                <br>Date Of Pickup: <?php echo $row['date_of_pickup'];?></br>
                        Airway no: <?php echo $row['awb_no'];?>

                    <?php else: ?>
                        <img src="<?php echo base_url(); ?>assets/cancelled.png" width="120" alt="Cancelled Oder"/>
                    <?php endif; ?>
                </td>
                <td>
                    <?php $filename1 = $live_url . 'invoice/' . $row['txnid'] . '/buyer_invoice_order_' . $row['order_id'] . '.pdf'; ?>
                    <table>
                        <tr>
                            <td rowspan="2"><a target="_blank" href="<?php echo $filename1; ?>"><img
                                        src="<?php echo base_url(); ?>assets/pdficon.gif" width="55"
                                        alt="PDF Icon"/></a></td>
                            <!--<td><input type="BUTTON" value="Explicit Email to Buyer" onClick="return emailInvoiceToBuyer(<?php $row['order_id']; ?>, '<?php $row['txnid']; ?>')" /></td>-->
                        </tr>
                        <!--<tr>
							<td><input type="BUTTON" value="Explicit Email to Seller" onClick="return emailInvoiceToSeller(<?php $row['order_id']; ?>, '<?php $row['txnid']; ?>')" /></td>
						</tr>-->
                    </table>
                </td>
                <td id="shivam_<?php echo $row['order_id']; ?>">
                </td>
                <td>
                <p>EMAIL ID: <input type="text" id="ownerEMAIL"></p>
                <input type = "button" value = "send email " onclick = "venderEMAIL(<?php echo $row['order_id']; ?>)">
                    
                    <div class="mail1"><input type="button" value="Send Mail" onclick="semail()" id="mail"></div>
                    <a target="_blank"
                       href="<?php echo base_url() . 'index.php/crm/sellerInvoice/' . $row['order_id']; ?>"
                       style="text-decoration: none; color: #0a6d52">Default Invoice</a> | <a target="_blank"
                                                                                              href="<?php echo base_url() . 'index.php/crm/sellerInvoicePDFNew/' . $row['order_id']; ?>"
                                                                                              style="text-decoration: none; color: #0a6d52">PDF</a>
                    <hr/>
                    <a target="_blank"
                       href="<?php echo base_url() . 'index.php/crm/changeShippingPartner/' . $row['order_id'] . '/1'; ?>"
                       style="text-decoration: none; color: #0a6d52">Fedex Invoice</a> | <a target="_blank"
                                                                                            href="<?php echo base_url() . 'index.php/crm/changeShippingPartnerPDF/' . $row['order_id'] . '/1'; ?>"
                                                                                            style="text-decoration: none; color: #0a6d52">PDF</a>
                    | <a target="_blank"
                         href="<?php echo base_url() . 'index.php/download/invoice/' . $row['order_id'] . '/1'; ?>"
                         style="text-decoration: none; color: #0a6d52">DL</a>
                    <hr/>
                    <a target="_blank"
                       href="<?php echo base_url() . 'index.php/crm/changeShippingPartner/' . $row['order_id'] . '/2'; ?>"
                       style="text-decoration: none; color: #0a6d52">BD Invoice</a> | <a target="_blank"
                                                                                         href="<?php echo base_url() . 'index.php/crm/changeShippingPartnerPDF/' . $row['order_id'] . '/2'; ?>"
                                                                                         style="text-decoration: none; color: #0a6d52">PDF</a>
                    | <a target="_blank"
                         href="<?php echo base_url() . 'index.php/download/invoice/' . $row['order_id'] . '/2'; ?>"
                         style="text-decoration: none; color: #0a6d52">DL</a>
                    <hr/>
                    <a target="_blank"
                       href="<?php echo base_url() . 'index.php/crm/changeShippingPartner/' . $row['order_id'] . '/3'; ?>"
                       style="text-decoration: none; color: #0a6d52">Gati Invoice</a> | <a target="_blank"
                                                                                           href="<?php echo base_url() . 'index.php/crm/changeShippingPartnerPDF/' . $row['order_id'] . '/3'; ?>"
                                                                                           style="text-decoration: none; color: #0a6d52">PDF</a>
                    | <a target="_blank"
                         href="<?php echo base_url() . 'index.php/download/invoice/' . $row['order_id'] . '/3'; ?>"
                         style="text-decoration: none; color: #0a6d52">DL</a>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="13">
                <div style="width: 100%; text-align: right">
                    <?php
                    for ($i = 0; $i < $totalNumberOfPages; $i++) {
                        if ($i == $currentPageNumber) {
                            print "<b title=\"You are on this page\" >" . $i . "</b>&nbsp;|&nbsp;";
                        } else {
                            print "<a href=\"#\" onClick=\"all_order_filter_paged(" . $i . ")\">" . $i . "</a>&nbsp;|&nbsp;";
                        }
                    }
                    ?>
                </div>
            </td>
        </tr>
        </table>
        <input id="allOrdersxxx" type="HIDDEN" value="<?php echo implode(',', $allOrdersxxx); ?>"/>
        <input id="allTxnsxxx" type="HIDDEN" value="<?php echo implode(',', $allTxnsxxx); ?>"/>
    <?php
    }

    public function searched_order($id)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $live_url = 'http://www.buynbrag.com/';
        //$live_url = 'http://localhost/bnbl/';
        $this->load->model('crm_model');
        $s_order = $this->crm_model->search_by_orderid($id);
        $allOrdersxxx = array();
        $allTxnsxxx = array();
        $rowColor = 0;
        ?>
        <table border="1" class="ordersTable">
            <tr align="center" style="background-color: #4C504F; color: #fff">
                <th>Select</th>
                <th scope="col">Store Name</th>
                <th scope="col">Order ID</th>
                <th scope="col">Ordered Date</th>
                <th scope="col">Last Date For PickUP</th>
                <th scope="col">Logistics Partner</th>
                <th scope="col">Track ID</th>
                <th scope="col">Product Information</th>
                <th scope="col">Product Image</th>
                <th scope="col">Qty</th>
                <th scope="col">Paid Price(Total)</th>
                <th scope="col">BNB Discount</th>
                <th scope="col">Seller Earnings</th>
                <th scope="col">Order status</th>
                <th scope="col">Action</th>
                <th scope="col">Buyer Invoice</th>
                <th scope="col">Shipping Label</th>
                <th scope="col">Send Mail</th>
            </tr>
            <?php
            $allOrdersxxx[] = $s_order[0]['order_id'];
            $allTxnsxxx[] = $s_order[0]['txnid'];
            ?>
            <tr align="center">
                <td>
                    <input type="CHECKBOX" id="orderNo<?php echo $s_order[0]['order_id']; ?>">
                </td>
                <td><?php echo $s_order[0]['store_name']; ?></td>
                <td><strong><font color="#990066"><?php echo $s_order[0]['order_id']; ?></font></strong></td>
                <td><strong><font color="#330066"><?php echo $s_order[0]['orderdate']; ?></font></strong></td>
                <td><strong><font color="#330066"><?php echo $s_order[0]['date_of_pickup']; ?></font></strong></td>
                <td>
                    <select class="invoice">
                        <option class="selectedOption" value="default_<?php echo $s_order[0]['order_id']; ?>"
                                id="default_<?php echo $s_order[0]['order_id']; ?>">Default
                        </option>
                        <option class="selectedOption" value="fedex_<?php echo $s_order[0]['order_id']; ?>"
                                id="fedex_<?php echo $s_order[0]['order_id']; ?>">Fedex
                        </option>
                        <option class="selectedOption" value="gati_<?php echo $s_order[0]['order_id']; ?>"
                                id="gati_<?php echo $s_order[0]['order_id']; ?>">Gati
                        </option>
                        <option class="selectedOption" value="bd_<?php echo $s_order[0]['order_id']; ?>"
                                id="bd_<?php echo $s_order[0]['order_id']; ?>">Blue Dart
                        </option>
                    </select>
                </td>
                <td style="background-color: #fff; color: #0a6d52">
                    <strong>
                        <font color="#006600">
                            <?php
                            if (!is_null($s_order[0]['awb_no'])) {
                                echo $s_order[0]['awb_no'] . "<hr/>";
                                print'<p> UPDATE AWB NO: <input type="text" id="genrateawbNO"></p>';
                                 print '<input type = "button" value = "save awb no" onclick = "updateAWBNO(\''.$row['order_id'].'\')">'; 
                            }
                            if ($s_order[0]['shipping_partner'] == 3) // if the shipping partner is gati
                            {
                                echo "<font color=\"red\">Not Applicable</font>";
                                if (!is_null($s_order[0]['awb_no'])) // and still an AWB NO has been generated, then provide a link to re-claim it
                                {
                                    // print '<a target="_blank" href="'.base_url().'index.php/crm/reclaimAWBNO/'.$s_order[0]['awb_no'].'">Reclaim AWB NO</a>';
                                    /* THIS FEATURE CAN NOT BE MADE BECAUSE OF DB LIMITATIONS */
                                }
                            } else {
                                if ((is_null($s_order[0]['awb_no']) || strcmp($s_order[0]['awb_no'], "") === 0) && $s_order[0]['status_order'] != 5) // if no AWB NO has been generated
                                {
                                    print '<input type="BUTTON" onCLick="window.open(\'' . base_url() . 'index.php/crm/generateAWBNO/' . $s_order[0]['order_id'] . '\',\'\',\'width=200,height=100\')" value="Generate AWB NO">';
                                    print '<p>AWB NO: <input type="text" id="genrateawbNO"></p>';
                                    print '<input type = "button" value = "save awb no" onclick = "updateAWBNO(\''.$row['order_id'].'\')">'; 
                                }
                            }
                            ?>
                            
                        </font>
                    </strong>
                </td>
                <td><strong><font color="#330066">
                            Name : <?php echo $s_order[0]['product_name']; ?></br>
                            Code : <?php echo $s_order[0]['bnb_product_code']; ?></br>
                            Size : <?php echo $s_order[0]['vsize']; ?></br>
                            Colour : <?php echo $s_order[0]['vcolor']; ?></br>
                        </font></strong>
                </td>
                <td>
                    <img style="cursor:pointer" onclick="product_info(<?php echo $s_order[0]['order_id']; ?>)"
                         alt="Product" height="70"
                         src="https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/<?php echo $s_order[0]['store_id']; ?>/<?php echo $s_order[0]['product_id']; ?>/img1_97x80.jpg"/>
                    <br/><a
                        href="<?php echo base_url(); ?>index.php/download/index/<?php echo $s_order[0]['store_id'] . '/' . $s_order[0]['product_id'] . '/' . $s_order[0]['order_id']; ?>"
                        target="_blank"> Download Image </a>
                </td>
                <td><strong><?php echo $s_order[0]['totalQuantity']; ?></strong></td>
                <td>
                    <div style="cursor:pointer" onclick="payment_info(<?php echo $s_order[0]['order_id']; ?>)">
                        <img src="<?php echo base_url(); ?>assets/<?php echo $s_order[0]['pg_type']; ?>.png" width="80"
                             alt="payment_mode"><br>
                        <?php $total = ceil($s_order[0]['totalQuantity'] * $s_order[0]['amt_paid'] - $s_order[0]['redeemedprice']);
                        ?>
                        <strong>Rs.<br><?php echo floatval($total); ?>.00</strong>
                    </div>
                </td>
                <?php
                if ($s_order[0]['status_order'] == 1)
                    $status = '<img src="' . base_url() . 'assets/pending.png" width="120" alt="Pending New Order" />';
                elseif ($s_order[0]['status_order'] == 2)
                    $status = '<img src="' . base_url() . 'assets/process.png" width="120" alt="In Process" />'; elseif ($s_order[0]['status_order'] == 3)
                    $status = '<img src="' . base_url() . 'assets/shipping.png" width="120" alt="Shipping" />'; elseif ($s_order[0]['status_order'] == 4)
                    $status = '<img src="' . base_url() . 'assets/completed.png" width="120" alt="Completed" />'; elseif ($s_order[0]['status_order'] == 5)
                    $status = '<img src="' . base_url() . 'assets/cancelled.png" width="120" alt="Cancelled" />'; elseif ($s_order[0]['status_order'] == 6)
                    $status = 'Problem with Order/Invoice<br><img src="' . base_url() . 'assets/problem.png" width="120" alt="Problem with Order" />'; else $status = 'not defined';?>
                <td><?php echo $s_order[0]['discount']; ?></td>
                <td><?php echo $s_order[0]['seller_earnings']; ?></td>
                <td><?php echo $status; ?></td>
                <td>
                    <?php if (!($s_order[0]['status_order'] == 5) and !($s_order[0]['status_order'] == 4)) : ?>
                        <select id="bnb_sts_<?php echo $s_order[0]['order_id']; ?>">
                            <option value="1">Restart Processing</option>
                            <?php if ($s_order[0]['status_order'] == 1) : ?>
                                <option value="2">Start Processing</option>
                                <option value="5">Cancel Order</option>
                                <option value="6">Problem with Order</option>

                            <?php elseif ($s_order[0]['status_order'] == 2) : ?>
                                <option value="3" onclick='popup(this.value,<?php echo $s_order[0]['order_id']; ?>);'>
                                    Shipping
                                </option>

                                <option value="5">Cancel Order</option>
                                <option value="6">Problem with Order/Invoice</option>
                            <?php elseif ($s_order[0]['status_order'] == 3) : ?>
                                <option value="4">Completed</option>
                                <option value="5">Cancel Order</option>
                                <option value="6">Problem with Invoice</option>
                            <?php elseif ($s_order[0]['status_order'] == 6) : ?>
                                <option value="21">Regenerate Invoice(with Old AWB Code)</option>
                                <option value="22">Regenerate Invoice(with New AWB Code)</option>
                                <option value="5">Cancel Order</option>
                            <?php endif; ?>
                        </select><br>

                        <input type="text" name="shippingdate" id="shippingdate<?php echo $s_order[0]['order_id']; ?>"
                               placeholder="Shipping date YYYY-MM-DD" style='display:none'/><br>
                        <input type="text" name="shippingtime" id="shippingtime<?php echo $s_order[0]['order_id']; ?>"
                               placeholder="Shipping time HH:MM" style='display:none'/>
                        <input type="button" value="Go"
                               onclick='return all_modify_status(<?php echo $s_order[0]['order_id']; ?>,"<?php echo $s_order[0]['txnid']; ?>", 0)'/>
                    <?php elseif ($s_order[0]['status_order'] == 4): ?>
                        <img src="<?php echo base_url(); ?>assets/completed.png" width="120" alt="Completed Oder"/>
                    <?php else: ?>
                        <img src="<?php echo base_url(); ?>assets/cancelled.png" width="120" alt="Cancelled Oder"/>
                    <?php endif; ?>
                </td>
                <td>
                    <?php $filename1 = $live_url . 'invoice/' . $s_order[0]['txnid'] . '/buyer_invoice_order_' . $s_order[0]['order_id'] . '.pdf'; ?>
                    <table>
                        <tr>
                            <td rowspan="2"><a target="_blank" href="<?php echo $filename1; ?>"><img
                                        src="<?php echo base_url(); ?>assets/pdficon.gif" width="55"
                                        alt="PDF Icon"/></a></td>
                            <!--<td><input type="BUTTON" value="Explicit Email to Buyer" onClick="return emailInvoiceToBuyer(<?php $s_order[0]['order_id']; ?>, '<?php $s_order[0]['txnid']; ?>')" /></td>-->
                        </tr>
                        <!--<tr>
							<td><input type="BUTTON" value="Explicit Email to Seller" onClick="return emailInvoiceToSeller(<?php $s_order[0]['order_id']; ?>, '<?php $s_order[0]['txnid']; ?>')" /></td>
						</tr>-->
                    </table>
                </td>
                <!-- <td>
                    <a target="_blank" href="<?php echo base_url().'index.php/crm/sellerInvoice/'.$s_order[0]['order_id']; ?>" style="text-decoration: none; color: #0a6d52">Default Invoice</a> | <a target="_blank" href="<?php echo base_url().'index.php/crm/sellerInvoicePDFNew/'.$s_order[0]['order_id']; ?>" style="text-decoration: none; color: #0a6d52">PDF</a><hr/>
                    <a target="_blank" href="<?php echo base_url().'index.php/crm/changeShippingPartner/'.$s_order[0]['order_id'].'/1'; ?>" style="text-decoration: none; color: #0a6d52">Fedex Invoice</a> | <a target="_blank" href="<?php echo base_url().'index.php/crm/changeShippingPartnerPDF/'.$s_order[0]['order_id'].'/1'; ?>" style="text-decoration: none; color: #0a6d52">PDF</a> | <a target="_blank" href="<?php echo base_url().'index.php/download/invoice/'.$s_order[0]['order_id'].'/1'; ?>" style="text-decoration: none; color: #0a6d52">DL</a><hr/>
                    <a target="_blank" href="<?php echo base_url().'index.php/crm/changeShippingPartner/'.$s_order[0]['order_id'].'/2'; ?>" style="text-decoration: none; color: #0a6d52">BD Invoice</a> | <a target="_blank" href="<?php echo base_url().'index.php/crm/changeShippingPartnerPDF/'.$s_order[0]['order_id'].'/2'; ?>" style="text-decoration: none; color: #0a6d52">PDF</a> | <a target="_blank" href="<?php echo base_url().'index.php/download/invoice/'.$s_order[0]['order_id'].'/2'; ?>" style="text-decoration: none; color: #0a6d52">DL</a><hr/>
                    <a target="_blank" href="<?php echo base_url().'index.php/crm/changeShippingPartner/'.$s_order[0]['order_id'].'/3'; ?>" style="text-decoration: none; color: #0a6d52">Gati Invoice</a> | <a target="_blank" href="<?php echo base_url().'index.php/crm/changeShippingPartnerPDF/'.$s_order[0]['order_id'].'/3'; ?>" style="text-decoration: none; color: #0a6d52">PDF</a> | <a target="_blank" href="<?php echo base_url().'index.php/download/invoice/'.$s_order[0]['order_id'].'/3'; ?>" style="text-decoration: none; color: #0a6d52">DL</a>
                </td>-->
                <td id="shivam_<?php echo $s_order[0]['order_id']; ?>">
                </td>
                <td>
                    <div class="mail1"><input type="button" value="Send Mail" onclick="semail()" id="mail"></div>
                    <a target="_blank"
                       href="<?php echo base_url() . 'index.php/crm/sellerInvoice/' . $s_order[0]['order_id']; ?>"
                       style="text-decoration: none; color: #0a6d52">Default Invoice</a> | <a target="_blank"
                                                                                              href="<?php echo base_url() . 'index.php/crm/sellerInvoicePDFNew/' . $s_order[0]['order_id']; ?>"
                                                                                              style="text-decoration: none; color: #0a6d52">PDF</a>
                    <hr/>
                    <a target="_blank"
                       href="<?php echo base_url() . 'index.php/crm/changeShippingPartner/' . $s_order[0]['order_id'] . '/1'; ?>"
                       style="text-decoration: none; color: #0a6d52">Fedex Invoice</a> | <a target="_blank"
                                                                                            href="<?php echo base_url() . 'index.php/crm/changeShippingPartnerPDF/' . $s_order[0]['order_id'] . '/1'; ?>"
                                                                                            style="text-decoration: none; color: #0a6d52">PDF</a>
                    | <a target="_blank"
                         href="<?php echo base_url() . 'index.php/download/invoice/' . $s_order[0]['order_id'] . '/1'; ?>"
                         style="text-decoration: none; color: #0a6d52">DL</a>
                    <hr/>
                    <a target="_blank"
                       href="<?php echo base_url() . 'index.php/crm/changeShippingPartner/' . $s_order[0]['order_id'] . '/2'; ?>"
                       style="text-decoration: none; color: #0a6d52">BD Invoice</a> | <a target="_blank"
                                                                                         href="<?php echo base_url() . 'index.php/crm/changeShippingPartnerPDF/' . $s_order[0]['order_id'] . '/2'; ?>"
                                                                                         style="text-decoration: none; color: #0a6d52">PDF</a>
                    | <a target="_blank"
                         href="<?php echo base_url() . 'index.php/download/invoice/' . $s_order[0]['order_id'] . '/2'; ?>"
                         style="text-decoration: none; color: #0a6d52">DL</a>
                    <hr/>
                    <a target="_blank"
                       href="<?php echo base_url() . 'index.php/crm/changeShippingPartner/' . $s_order[0]['order_id'] . '/3'; ?>"
                       style="text-decoration: none; color: #0a6d52">Gati Invoice</a> | <a target="_blank"
                                                                                           href="<?php echo base_url() . 'index.php/crm/changeShippingPartnerPDF/' . $s_order[0]['order_id'] . '/3'; ?>"
                                                                                           style="text-decoration: none; color: #0a6d52">PDF</a>
                    | <a target="_blank"
                         href="<?php echo base_url() . 'index.php/download/invoice/' . $s_order[0]['order_id'] . '/3'; ?>"
                         style="text-decoration: none; color: #0a6d52">DL</a>
                </td>
            </tr>
        </table>
        <input id="allOrdersxxx" type="HIDDEN" value="<?php echo implode(',', $allOrdersxxx); ?>"/>
        <input id="allTxnsxxx" type="HIDDEN" value="<?php echo implode(',', $allTxnsxxx); ?>"/>
        <p>
            <label>With selected, change status to</label>
            <select name="operations" id="operationsAllxxx">
                <option value="1">Restart Processing</option>
                <option value="2">Start Processing</option>
                <option value="3">Shipping</option>
                <option value="4">Completed</option>
                <option value="5">Cancel Order</option>
                <option value="6">Problem with Order/Invoice</option>
                <option value="7">Test Order</option>
                <option value="21">[USE WITH CAUTION]Regenerate Invoice(with Old AWB Code)</option>
                <option value="22">[USE WITH CAUTION]Regenerate Invoice(with New AWB Code)</option>
            </select>
            <input type="BUTTON" value=" Go " onClick="modifyOrders()"/>
        </p>
    <?php
    }

    public function orders_stores($store_id, $order_status = 0)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $live_url = 'http://www.buynbrag.com/';
        //$live_url = 'http://localhost/bnbl/';
        $sid = $this->input->get('store_id');
        $this->load->model('crm_model');
        $s_order = $this->crm_model->order_details_store($store_id, $order_status);
        ?>
        <div class="bigLabel clear_both">Access Orders</div>
        <div class="labeldetails">
            <div class="smallLabel">Order Type</div>
            <select class="firstdrop" id="dropdown1">
                <option
                    onclick="order_filter(<?php echo $store_id; ?>,0)" <?php if ($order_status == 0) echo 'selected="selected"'; ?>
                    value="all">All
                </option>
                <option <?php if ($order_status == 1) echo 'selected="selected"'; ?>
                    onclick="order_filter(<?php echo $store_id; ?>,1)" value="in_process">New/Pending Orders
                </option>
                <option <?php if ($order_status == 2) echo 'selected="selected"'; ?>
                    onclick="order_filter(<?php echo $store_id; ?>,2)" value="in_process">In Process
                </option>
                <option <?php if ($order_status == 3) echo 'selected="selected"'; ?>
                    onclick="order_filter(<?php echo $store_id; ?>,3)" value="shipping">Shipping
                </option>
                <option <?php if ($order_status == 4) echo 'selected="selected"'; ?>
                    onclick="order_filter(<?php echo $store_id; ?>,4)" value="completed">Completed
                </option>
                <option <?php if ($order_status == 5) echo 'selected="selected"'; ?>
                    onclick="order_filter(<?php echo $store_id; ?>,5)" value="cancelled">Cancelled Order
                </option>
                <option <?php if ($order_status == 6) echo 'selected="selected"'; ?>
                    onclick="order_filter(<?php echo $store_id; ?>,6)" value="problem">Problem with Order
                </option>
            </select>
            <strong> (<?php echo count($s_order); ?> orders found)</strong><br/>
            <table width="0" border="1">
                <tr align=center>
                    <th width="78" scope="col">Store Name</th>
                    <th width="93" scope="col">Order ID</th>
                    <th width="119" scope="col">Date of Order(GMT)</th>
                    <th width="60" scope="col">Logistics Partner</th>
                    <th width="59" scope="col">Track ID</th>
                    <th width="59" scope="col">Product Information</th>
                    <th width="58" scope="col">Qty</th>
                    <th width="66" scope="col">Paid Price(Total)</th>
                    <th width="82" scope="col">Order status</th>
                    <th width="150" scope="col">Action</th>
                    <th width="66" scope="col">Buyer Invoice</th>
                    <th width="57" scope="col">Shipping Label</th>
                </tr><?php foreach ($s_order as $row) : ?>
                    <tr align=center>
                        <td><img style="cursor:pointer" width="150"
                                 src="https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/<?php echo $row['store_id']; ?>/top_banner.png"/>
                        </td>
                        <td><strong><font color="#990066"><?php echo $row['order_id']; ?></font></strong></td>
                        <td><strong><font color="#330066"><?php echo $row['date_of_order']; ?></font></strong></td>
                        <?php if ($row['shipping_partner'] == 1) : ?>
                            <td><img width="80" src="<?php echo base_url(); ?>assets/fedex.png"/></td>
                        <?php elseif ($row['shipping_partner'] == 2) : ?>
                            <td><img width="80" src="<?php echo base_url(); ?>assets/bluedart.png"/></td>
                        <?php elseif ($row['shipping_partner'] == 3) : ?>
                            <td><img width="80" src="<?php echo base_url(); ?>assets/gati.png"/></td>
                        <?php endif; ?>

                        <td><strong><font
                                    color="#006600"><?php if ($row['shipping_partner'] == 3) echo "<font color=\"red\">Not Applicable</font>"; else echo $row['awb_no']; ?></font></strong>
                        </td>
                        <td><img style="cursor:pointer" onclick="product_info(<?php echo $row['order_id']; ?>)"
                                 alt="Product" height="70"
                                 src="https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/<?php echo $row['store_id']; ?>/<?php echo $row['product_id']; ?>/img1_97x80.jpg"/>
                        </td>
                        <td><strong><?php echo $row['quantity']; ?></strong></td>
                        <td>
                            <div style="cursor:pointer" onclick="payment_info(<?php echo $row['order_id']; ?>)">
                                <img src="<?php echo base_url(); ?>assets/<?php echo $row['pg_type']; ?>.png" width="80"
                                     alt="payment_mode"><br>
                                <?php $total = ($row['quantity'] * $row['amt_paid'] * (1 - $row['redeemedprice']));
                                ?>
                                <strong>Rs.<br><?php echo floatval($total); ?>.00</strong>
                            </div>
                        </td>
                        <?php
                        if ($row['status_order'] == 1)
                            $status = '<img src="' . base_url() . 'assets/pending.png" width="120" alt="Pending New Order" />';
                        elseif ($row['status_order'] == 2)
                            $status = '<img src="' . base_url() . 'assets/process.png" width="120" alt="In Process" />'; elseif ($row['status_order'] == 3)
                            $status = '<img src="' . base_url() . 'assets/shipping.png" width="120" alt="Shipping" />'; elseif ($row['status_order'] == 4)
                            $status = '<img src="' . base_url() . 'assets/completed.png" width="120" alt="Completed" />'; elseif ($row['status_order'] == 5)
                            $status = '<img src="' . base_url() . 'assets/cancelled.png" width="120" alt="Cancelled" />'; elseif ($row['status_order'] == 6)
                            $status = 'Problem with Order/Invoice<br><img src="' . base_url() . 'assets/problem.png" width="120" alt="Problem with Order" />'; else $status = 'not defined';?>
                        <td><?php echo $status; ?></td>
                        <td>
                            <?php if (!($row['status_order'] == 5) and !($row['status_order'] == 4)) : ?>
                                <select id="bnb_sts_<?php echo $row['order_id']; ?>">
                                    <?php if ($row['status_order'] == 1) : ?>
                                        <option value="2">Start Processing</option>
                                        <option value="5">Cancel Order</option>
                                        <option value="6">Problem with Order</option>
                                        <option value="7">Test Order</option>
                                    <?php elseif ($row['status_order'] == 2) : ?>
                                        <option value="3">Shipping</option>
                                        <option value="5">Cancel Order</option>
                                        <option value="6">Problem with Order/Invoice</option>
                                        <option value="7">Test Order</option>
                                    <?php elseif ($row['status_order'] == 3) : ?>
                                        <option value="4">Completed</option>
                                        <option value="5">Cancel Order</option>
                                        <option value="6">Problem with Invoice</option>
                                        <option value="7">Test Order</option>
                                    <?php elseif ($row['status_order'] == 6) : ?>
                                        <option value="21">Regenerate Invoice(with Old AWB Code)</option>
                                        <option value="22">Regenerate Invoice(with New AWB Code)</option>
                                        <option value="5">Cancel Order</option>
                                        <option value="7">Test Order</option>
                                    <?php endif; ?>
                                </select><br>
                                <input type="button" value="Go"
                                       onclick='return all_modify_status(<?php echo $row['order_id']; ?>,"<?php echo $row['txnid']; ?>")'/>
                            <?php elseif ($row['status_order'] == 4): ?>
                                <img src="<?php echo base_url(); ?>assets/completed.png" width="120"
                                     alt="Completed Oder"/>
                         
                            <?php else: ?>
                                <img src="<?php echo base_url(); ?>assets/cancelled.png" width="120"
                                     alt="Cancelled Oder"/>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php $filename1 = $live_url . 'invoice/' . $row['txnid'] . '/buyer_invoice_order_' . $row['order_id'] . '.pdf'; ?>
                            <a target="_blank" href="<?php echo $filename1; ?>"><img
                                    src="<?php echo base_url(); ?>assets/pdficon.gif" width="55" alt="PDF Icon"/></a>
                        </td>
                        <td>
                            <?php $filename2 = $live_url . 'invoice/' . $row['txnid'] . '/shipping_label_order_' . $row['order_id'] . '.pdf';
                            if ($row['status_order'] == 2 or $row['status_order'] == 3 or $row['status_order'] == 4) :?>
                            <a target="_blank" href="<?php echo $filename2; ?>"><img
                                    src="<?php echo base_url(); ?>assets/pdficon.gif" width="55" alt="PDF Icon"/>
                                </a><?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <br><br><br>
    <?php
    }

    public function modify_order($order_id, $orderStatus, $txn_id = '', $shippingdate = '', $shippingtime = '')
    {
        log_message('INFO', "inside crm/modify_order(\$order_id,\$status,\$txn_id='',\$shippingdate='',\$shippingtime='') === (" . $order_id . ", " . $orderStatus . ", " . $txn_id . ", " . $shippingdate . ", " . $shippingtime . ")");
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $this->load->model('crm_model');
        //$live_url = 'http://localhost/bnbl/index.php/';
        $live_url = 'http://www.buynbrag.com/index.php/';
        if ($orderStatus == 2) {
            echo $this->crm_model->seller_order_modify($order_id, 2, $shippingdate, $shippingtime);
            //redirect($live_url."invoice_controller/regenerate_barcode/$order_id/$txn_id");
        } elseif ($orderStatus == 21) {
            echo $this->crm_model->seller_order_modify($order_id, 2, $shippingdate, $shippingtime);

            redirect($live_url . "invoice_controller/regenerate_sl/$order_id/$txn_id");
        } elseif ($orderStatus == 22) {
            echo $this->crm_model->seller_order_modify($order_id, 2, $shippingdate, $shippingtime);

            redirect($live_url . "invoice_controller/regenerate_barcode/$order_id/$txn_id");
        } else {
            echo $this->crm_model->seller_order_modify($order_id, $orderStatus, $shippingdate, $shippingtime);
        }
    }
    public function newSendMail($allvendor)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $mail_vendor = explode('|', urldecode($allvendor));
        $this->load->model('crm_model');
        foreach ($mail_vendor as $mv)
        {
            $orderID = explode('_',urldecode($mv));
            $this->crm_model->sellermail2($orderID[1]);
        }
    }
    public function sendmail($allvendor)
    {
        $this->load->library('email');
        /*$config = array(
            'useragent' => 'BuynBrag',
            'protocol' => 'smtp',
            'smtp_host' => 'email-smtp.us-east-1.amazonaws.com',
            'smtp_user' => 'AKIAIWGOC3JYHQXJHYJA',
            'smtp_pass' => 'Ans0ELSec8JvU7A8kDIHoTReXqdDvxx13wam3xlTosWH',
            'smtp_timeout' => 5,
            'newline' => '\r\n',
            'smtp_port' => 465,
            );
            */
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $mail_vendor = explode('|', urldecode($allvendor));
        $this->load->model('crm_model');
        //$live_url = 'http://localhost/bnbl/index.php/';
        $live_url = 'http://www.buynbrag.com/';
        $this->load->library('email');
        //$this->email->initialize($config);
        foreach ($mail_vendor as $mv) {
            $mv = explode('_', urldecode($mv));
            $rt = $this->crm_model->sellermail($mv[1]);
            if ($mv[0] == "default")
                //$sd = $live_url.'index.php/crm/sellerInvoice/'.$rt[0]['order_id'];
            $sd = $live_url . 'bnb_crm/index.php/crm/sellerInvoicePDFNew/' . $rt[0]['order_id'];
            else if ($mv[0] == "fedex")
                //$sd = $live_url.'index.php/crm/changeShippingPartner/'.$rt['order_id'].'/1';
            $sd = $live_url . 'bnb_crm/index.php/crm/changeShippingPartnerPDF/' . $rt['order_id'] . '/1';
            else if ($mv[0] == "bd")
                $sd = $live_url . 'bnb_crm/index.php/crm/changeShippingPartnerPDF/' . $rt['order_id'] . '/2';
            //$sd = $live_url.'index.php/crm/changeShippingPartner/'.$rt['order_id'].'/2';
            else if ($mv[0] == "gati")
                //$sd = $live_url.'index.php/crm/changeShippingPartner/'.$rt['order_id'].'/3';
            $sd = $live_url . 'bnb_crm/index.php/crm/changeShippingPartnerPDF/' . $rt['order_id'] . '/3';
            if ($rt[0]['pg_type'] == "CC" || $rt[0]['pg_type'] == "DC" || $rt[0]['pg_type'] == "NB")
                $ptype = "Prepaid";
            else
                $ptype = "COD";
            $Date = $rt[0]['date_of_order'];
            $edate = date('Y-m-d', strtotime($Date . ' + ' . $rt[0]['processing_time'] . ' days'));
            $filename1 = $live_url . 'invoice/' . $rt[0]['txnid'] . '/buyer_invoice_order_' . $rt[0]['order_id'] . '.pdf';
            $image = 'https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/' . $rt[0]['store_id'] . '/' . $rt[0]['product_id'] . '/fancy1.jpg';
            $To = $rt[0]['owner_email'];
            $subject = 'New ' . $ptype . ' order ' . $rt[0]['order_id'] . ' ';
            $img = $live_url . "assets/404_logo.png";
            $mess = 'Dear ' . $rt[0]['owner_name'] . ',
			
Please find attached shipping label, invoice and image.

Click Here to Download Shipping Label: ' . $sd . '
Click Here to Download Invoice       : ' . $filename1 . '
Click Here to Download image         : ' . $image . '

To schedule a pick up, kindly send an email only to rajat.bhagat@buynbrag.com, pranshu@buynbrag.com, himanshu.kanogiya@buynbrag.com.
 
Do not reply to this email.
 
Order Information:

Order ID: ' . $rt[0]['order_id'] . '
Store Name: ' . $rt[0]['store_name'] . '
Product: ' . $rt[0]['product_name'] . '
Product Code: ' . $rt[0]['bnb_product_code'] . '
Payment Amount: ' . $rt[0]['amt_paid'] . '
Payment Type: ' . $ptype . '
Buyer Name: ' . $rt[0]['shipping_fname'] . ' ' . $rt[0]['shipping_lname'] . '
Buyer Address: ' . $rt[0]['shipping_address'] . '
Buyer Mobile: ' . $rt[0]['shipping_phoneno'] . '
Processing Time: ' . $rt[0]['processing_time'] . ' days
Estimated Dispatch Date:' . $edate . '


Looking forward to your reply.
 
 
 
Regards,

Team BuynBrag
Operations

Social Scientist E-Commerce Pvt Ltd
Mobile : 0124-4300827, 0124-4301793
Unit no. 36 | Hartron Complex | Electronic City | Sector 18 | Gurgaon | Haryana | 122015';
            //$Toll = 'mustanish.altamash@gmail.com';
            //$this->load->library('email');
            $this->email->from('support@buynbrag.com');
            //$list = array('mustanish.altamash@gmail.com', 'khansarebest@yahoo.com');
            $list = array($To, 'pranshu@buynbrag.com', 'himanshu.kanogiya@buynbrag.com', 'rajat.bhagat@buynbrag.com');
            $this->email->to($list);
            //$this->email->to('mustanish.altamash@gmail.com');
            //$this->email->cc('khansarebest@yahoo.com');
            //$this->email->cc('manish@buynbrag.com');
            //$this->email->cc('himanshu.kanogiya@buynbrag.com');
            $this->email->subject($subject);
            $this->email->message($mess);
            //$this->email->attach($sd);
            //$this->email->attach($filename1);
            //$this->email->attach($image);


            //$this->email->attach($filename1);
            //$this->email->attach($image);
            //$this->email->attach($sd);
            $this->email->send();
            echo $this->email->print_debugger();
        }
    }

    public function modifyOrders($orderStatus, $orderTxnStr)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        //$orders = array();
        //$trans = array();
        //print "<p>orderTxnStr = ".urldecode($orderTxnStr)."</p>";
        $otTmp = explode('|', urldecode($orderTxnStr));
        //print "<pre>";print_r($otTmp);print "</pre>";
        $this->load->model('crm_model');
        //$live_url = 'http://localhost/bnbl/index.php/';
        $live_url = 'http://www.buynbrag.com/index.php/';
        $links = array();
        foreach ($otTmp as $ot) {
            //print "<hr /><p>\$ot = ".$ot."</p>";
            $tmp = explode('__', $ot);
            $order = $tmp[0];
            $tran = $tmp[1];
            //print "<p>Order; ".$order."</p><p>tran: ".$tran."</p><hr/>";
            if ($orderStatus == 2) {
                // echo "<p> status = ".$status."</p>";
                echo $this->crm_model->seller_order_modify($order, 2);
                $links[] = $live_url . "invoice_controller/regenerate_barcode/" . $order . "/" . $tran;
            } elseif ($orderStatus == 21) {
                echo $this->crm_model->seller_order_modify($order, 2);
                $links[] = $live_url . "invoice_controller/regenerate_sl/" . $order . "/" . $tran;
            } elseif ($orderStatus == 22) {
                echo $this->crm_model->seller_order_modify($order, 2);
                $links[] = $live_url . "invoice_controller/regenerate_barcode/" . $order . "/" . $tran;
            } else {
                echo $this->crm_model->seller_order_modify($order, $orderStatus);
                print "<script type=\"text/javascript\">\r\n//<!--\r\nwindow.close();\r\n//-->\r\n</script>";
            }
        }
        //print "<pre>";print_r($links);print "</pre>";
        print "<p>Loading pop-ups. Please Wait...</p>";
        if (count($links) > 0) {
            foreach ($links as $link) {
                print "<p><a href=\"" . $link . "\">" . $link . "</a></p>";
            }
            print "<script type=\"text/javascript\">\r\n//<!--\r\n";
            print "var links = new Array();\r\n";
            foreach ($links as $link) {
                print "links.push(\"" . $link . "\");\r\n";
                //print "window.open(\"".$link."\");\r\n";
            }
            ?>
            function linkOpen(url)
            {
            window.open(url,'','width=200,height=100');
            }
            function linksOpen()
            {
            for(i = 0; i < links.length; i++)
            {
            setTimeout('linkOpen("'+links[i]+'")', (10*i)+30);
            }
            }
            linksOpen();
            <?php
            print "//-->\r\n</script>\r\n";
        }
        //print "<pre>";print_r($orders);print "</pre>";
        //print "<pre>";print_r($trans);print "</pre>";

    }

    public function newShippingLabelWithOldBarcode($orderID)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $this->load->model('crm_model');
        $shippingDetails = $this->crm_model->orderShippingDetails($orderID);
        $shippingPartner = $shippingDetails[0]->shipping_partner;
        $paymentStatus = $shippingDetails[0]->payment_status;
        $txnid = $shippingDetails[0]->txnid;
        if ($shippingPartner != 3) {
            $this->crm_model->fetchAWBNO($orderID);
            $this->sellerInvoice($orderID);
        }
    }

    public function updateDBv($pID,$quantity,$status,$orderID)
    {
        $this->load->model('crm_model');
        $responseData['result'] = $this->crm_model->updateDbOnCancel($quantity, $pID);
        $responseData['status'] = $this->crm_model->updateStatus($status,$orderID);
        $response = json_encode('responseData');
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function updatePickupDate($date,$orderID)
    {
        $this->load->model('crm_model');
        $responseData['result'] = $this->crm_model->updateup($date, $orderID);
        $response = json_encode('responseData');
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }

    public function vendorEMAIL()
    {
        $orderID = $this->input->get('id');
        $ownerEMAIL = $this->input->get('selectEMAIL');
        $this->load->model('crm_model');
        $this->crm_model->ownerEMAIL($ownerEMAIL,$orderID);
    }
    public function updateAWBNO()
    {
        $orderID = $this->input->get('id');
        $updateAWBNO = $this->input->get('genrateawbNO');
        $this->load->model('crm_model');
        $this->crm_model->updateAWBNO($updateAWBNO,$orderID);
    }

    public function orderDelivered()
    {
        $this->load->model('crm_model');
        $responseData['result'] = $this->crm_model->orderDeliveredModel($orderid);
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }
    public function Checkout()
    {
      $transID = $this->input->get('transID');

      $beforCheckoutData = $this->crm_model->beforeCheckoutData($transID);
      $response = $beforCheckoutData[0]['bcData'];
      $arrayBeforCheckoutData = (array)json_decode($response);
     
      $afterCheckoutData = $this->crm_model->afterCheckoutData($transID);
      $arrayAfterCheckoutData = NULL;

      if(!empty($afterCheckoutData))
      {
        $response2 = $afterCheckoutData[0]['acData'];
        $arrayAfterCheckoutData = (array)json_decode($response2);
      }
     
      $data['beforecheck']=$arrayBeforCheckoutData;
      $data['afterCheckout'] = $arrayAfterCheckoutData;
      $finaljson = json_encode($data);
      $this->output->set_content_type('application/json');
      $this->output->set_output($finaljson);

    }

    public function sellerInvoicePDF($orderID) // Shipping Label
    {
        $base_url = base_url();
        $storeURL = 'http://buynbragstores.s3.amazonaws.com/';
        $this->load->model('crm_model');
        $orderDetails = $this->crm_model->sellerInvoiceData($orderID);
        $routingCode['destination_code'] = '';
        $routingCode['return_code'] = '';
        $routingCode['retpin'] = '0';
        if ($orderDetails['shipping_partner'] == 2 && $orderDetails['payment_status'] == 2) {
            $routingCode = $this->crm_model->fetchRoutingRetcodeCOD($orderDetails['return_pincode']);
            $routingCode['destination_code'] = $this->crm_model->fetchRoutingCodeCOD($orderDetails['shipping_pincode']);
        }
        if ($orderDetails['shipping_partner'] == 2 && $orderDetails['payment_status'] == 1) {
            $routingCode['destination_code'] = $this->crm_model->fetchRoutingCodePaid($orderDetails['shipping_pincode']);
        }
        $this->load->library('cezpdf');
        include_once 'invoice_sellerPDF.php';
        $this->cezpdf->ezNewPage();
        include_once 'invoice_buyerPDF.php';
        $this->cezpdf->ezStream();
        $file_path = $base_url . "invoice/" . $orderDetails['txnid'];
        $file_path = __DIR__ . "/../../invoice/" . $orderDetails['txnid'];
        log_message('INFO', 'Filepath: ' . $file_path);
        if (!file_exists($file_path)) {
            log_message('Info', 'Filepath: ' . $file_path . ' does not exist! Will try to create now');
            switch (mkdir($file_path, 0777, TRUE)) {
                case TRUE:
                    log_message('Info', 'Filepath: ' . $file_path . ' created successfully.');
                    break;
                case FALSE:
                    log_message('Info', 'Filepath: ' . $file_path . ' could not be created.');
                    break;
            }
        }
        $pdfcode = $this->cezpdf->output();
        $fp = fopen($file_path . '/shipping_label_order_' . $orderID . '.pdf', 'wb') or die('unable to create file');
        fwrite($fp, $pdfcode);
        fclose($fp);
        redirect(base_url() . 'invoice/' . $orderDetails['txnid'] . '/shipping_label_order_' . $orderID . '.pdf');
        /*if ($over_write == 0) {
            $status = 2;
            $this->load->model('order');
            $date = 0;
            $time = 0;
            $this->order->changeOrderStatus($status, $orderID, $date, $time);
            $url = base_url('index.php/dashboard/order_status/' . $order_details['store_id']);
            redirect($url, 'location');
        } else {
            //$file_path = '../../../../../../invoice/'.$txn_id;
            //if(file_exists($file_path))
            //    echo '<a href="'.$file_path.'/shipping_label_order_'.$order_id.'.pdf"  target="_blank">pdf</a>';
            echo 'Seller Invoice was generated successfully!';
        }*/
    }

    public function sellerInvoice($orderID, $shippingPartner = NULL) // Seller Invoice only
    {
        log_message('INFO', "inside crm/sellerInvoice. Args passed:: \$orderID = " . $orderID . " \$shippingPartner = " . $shippingPartner);
        $base_url = base_url();
        $storeURL = 'http://buynbragstores.s3.amazonaws.com/';
        $this->load->model('crm_model');
        $orderDetails = $this->crm_model->sellerInvoiceData($orderID);
        $routingCode['destination_code'] = '';
        $routingCode['return_code'] = '';
        $routingCode['retpin'] = '0';
        switch (is_null($shippingPartner)) {
            case FALSE:
                $orderDetails['shipping_partner'] = $shippingPartner; // if some shipping partner was passed as argument, use that
        }
        if ($orderDetails['shipping_partner'] == 2 && $orderDetails['payment_status'] == 2) {
            $routingCode = $this->crm_model->fetchRoutingRetcodeCOD($orderDetails['return_pincode']);
            $routingCode['destination_code'] = $this->crm_model->fetchRoutingCodeCOD($orderDetails['shipping_pincode']);
        }
        if ($orderDetails['shipping_partner'] == 2 && $orderDetails['payment_status'] == 1) {
            $routingCode['destination_code'] = $this->crm_model->fetchRoutingCodePaid($orderDetails['shipping_pincode']);
        }
        /*$this->output->cache(525600); // cache the file for one year*/
        $data['orderDetails'] = $orderDetails;
        $data['routingCode'] = $routingCode;
        $data['storeURL'] = $storeURL;
        $data['orderID'] = $orderID;
        log_message('INFO', ' data being to the view[invoice_seller] is: ' . print_r($data, TRUE));
        $this->load->view('invoice_seller', $data);
    }

    public function sellerInvoicePDFNew($orderID, $shippingPartner = NULL) // Seller Invoice only
    {
        log_message('INFO', "inside crm/sellerInvoicePDFNew. Args passed:: \$orderID = " . $orderID . " \$shippingPartner = " . $shippingPartner);
        $base_url = base_url();
        $storeURL = 'http://buynbragstores.s3.amazonaws.com/';
        $this->load->model('crm_model');
        $orderDetails = $this->crm_model->sellerInvoiceData($orderID);
        $routingCode['destination_code'] = '';
        $routingCode['return_code'] = '';
        $routingCode['retpin'] = '0';
        switch (is_null($shippingPartner)) {
            case FALSE:
                $orderDetails['shipping_partner'] = $shippingPartner; // if a shippingPartner has been provided in the argument and
                if (file_exists(__DIR__ . "/../../invoice/" . $orderDetails['txnid'] . "/shipping_label_order_" . $orderID . ".pdf")) // if an invoice file exists,
                {
                    unlink(__DIR__ . "/../../invoice/" . $orderDetails['txnid'] . "/shipping_label_order_" . $orderID . ".pdf"); // delete it first
                }
        }
        if (file_exists(__DIR__ . "/../../invoice/" . $orderDetails['txnid'] . "/shipping_label_order_" . $orderID . ".pdf")) // if an invoice file exists,
        {
            log_message("ERROR", "FILE: " . __DIR__ . "/../../invoice/" . $orderDetails['txnid'] . "/shipping_label_order_" . $orderID . ".pdf" . " EXISTS. Will redirect to it now");
            redirect(base_url() . "invoice/" . $orderDetails['txnid'] . "/shipping_label_order_" . $orderID . ".pdf");
        } else {
            log_message("ERROR", "FILE: " . __DIR__ . "/../../invoice/" . $orderDetails['txnid'] . "/shipping_label_order_" . $orderID . ".pdf" . " DOES NOT EXIST. Will try to create now");
        }
        $file_path = __DIR__ . "/../../invoice/" . $orderDetails['txnid'];
        log_message('INFO', 'Filepath: ' . $file_path);
        if (!file_exists($file_path)) {
            log_message('Info', 'Filepath: ' . $file_path . ' does not exist! Will try to create now');
            switch (mkdir($file_path, 0777, TRUE)) {
                case TRUE:
                    log_message('Info', 'Filepath: ' . $file_path . ' created successfully.');
                    break;
                case FALSE:
                    log_message('Info', 'Filepath: ' . $file_path . ' could not be created.');
                    break;
            }
        }
        switch($this->archBits)
        {
            case 32:    $pdfGenerator = "wkhtmltopdf-i386";
                break;
            case 64:    $pdfGenerator = "wkhtmltopdf-amd64";
                break;
        }
        $cmd = __DIR__ . "/../../".$pdfGenerator." " . base_url() . "index.php/crm/sellerInvoice/" . escapeshellarg($orderID) . "/" . escapeshellarg($shippingPartner) . " " . __DIR__ . "/../../invoice/" . escapeshellarg($orderDetails['txnid']) . "/shipping_label_order_" . $orderID . ".pdf";
        log_message('INFO', "EXECUTING COMMAND: " . $cmd);
        $cmdOutput = `$cmd`;
        log_message('INFO', "OUTPUT FROM PDF COMMAND FOR ORDER NO " . $orderID);
        log_message('INFO', $cmdOutput);
        if (file_exists(__DIR__ . "/../../invoice/" . $orderDetails['txnid'] . "/shipping_label_order_" . $orderID . ".pdf")) {
            redirect(base_url() . "invoice/" . $orderDetails['txnid'] . "/shipping_label_order_" . $orderID . ".pdf");
        } else {
            log_message("ERROR", "FILE: " . __DIR__ . "/../../invoice/" . $orderDetails['txnid'] . "/shipping_label_order_" . $orderID . ".pdf" . " DOES NOT EXIST");
        }

    }

    public function changeShippingPartnerPDF($order_id, $shippingPartner = NULL) // Regenerates AWB NUMBER only if has not been created
    {
        log_message('INFO', "inside crm/changeSzhippingPartnerPDF. Args passed:: \$orderID = " . $order_id . " \$shippingPartner = " . $shippingPartner);
        $shipping_details = $this->crm_model->shipping_partner($order_id);
        $shipping_partner = (int)$shipping_details['shipping_partner'];
        $txn_id = (int)$shipping_details['txnid'];
        switch (is_null($shippingPartner)) {
            case FALSE:
                $shipping_partner = $shippingPartner; // if a shipping_partner was provided in argument then assign it where 1 = fedex, 2 = bluedart, 3 = gati
                break;
        }

        if ($shipping_partner == 2) {
            if ($shipping_details['payment_status'] != 1) {
                $shipping_type = 0;
            } else {
                $shipping_type = 1;
            }
        } else {
            $shipping_type = 1;
        }

        if ($shipping_partner != 3 && (is_null($shipping_details['awb_no']) || strcmp($shipping_details['awb_no'], "") === 0)) {
            $docket_number = $this->crm_model->docket_no($shipping_partner, $shipping_type);
            $this->crm_model->setAWBNO($order_id, $docket_number); // update the DB to fix the AWBNO
            $this->crm_model->update_docket($order_id, $shipping_partner, $docket_number, $shipping_type);
            $url = base_url("index.php/crm/sellerInvoicePDFNew/" . $order_id . '/' . $shipping_partner);
            redirect($url);
        } else {
            $awbNo = $this->crm_model->fetchAWBNO($order_id); // read the current awbNo for the current orderID
            if (!$this->crm_model->hasValidAWBNO($order_id, $shipping_type) && $shipping_partner != 3) // if the current order does not have the AWBNO according to its shipping partner and the shipping partner is not gati
            {
                $docket_number = $this->crm_model->docket_no($shipping_partner, $shipping_type);
                $this->crm_model->setAWBNO($order_id, $docket_number); // update the DB to fix the AWBNO
                $this->crm_model->update_docket($order_id, $shipping_partner, $docket_number, $shipping_type);
            }
            $url = base_url("index.php/crm/sellerInvoicePDFNew/" . $order_id . '/' . $shipping_partner);
            redirect($url);
        }
    }

    public function bydate($type, $date)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $live_url = 'http://www.buynbrag.com/';
        //$live_url = 'http://localhost/bnbl/';
        $totalNumberOfPages = 1; // total number of pages
        $currentPageNumber = 1;
        $this->load->model('crm_model');
        if ($type === "ob")
            $s_order = $this->crm_model->bydate($date);
        else if ($type === "pu")
            $s_order = $this->crm_model->pudate($date);?>
        <h3 align="center"><strong>(Showing orders from selected date :<?php echo $date; ?>)</strong></h3><br/>
        <p>
            <label>With selected, change status to</label>
            <select name="operations" id="operationsAllxxx">
                <option value="1">Restart Processing</option>
                <option value="2">Start Processing</option>
                <option value="3">Shipping</option>
                <option value="4">Completed</option>
                <option value="5">Cancel Order</option>
                <option value="6">Problem with Order/Invoice</option>
                <option value="7">Test Order</option>
                <option value="21">[USE WITH CAUTION]Regenerate Invoice(with Old AWB Code)</option>
                <option value="22">[USE WITH CAUTION]Regenerate Invoice(with New AWB Code)</option>
            </select>
            <input type="BUTTON" value=" Go " onClick="modifyOrders()"/>
        </p>
<!--        <style type="text/css">-->
<!--            .ordersTable {-->
<!--                width: 100%;-->
<!--                border-collapse: collapse;-->
<!--                border-color: #0a6d52;-->
<!--                border-width: 3px;-->
<!--                cell-padding: 2px;-->
<!--                background-color: #fff;-->
<!--                color: #0a6d52;-->
<!--            }-->
<!---->
<!--            .ordersTable TR, .ordersTable TD {-->
<!--                border: 3px solid #0a6d52;-->
<!--            }-->
<!--        </style>-->
        <table border="1" class="ordersTable">
        <tr>
            <td colspan="13">
                <div style="width: 100%;">
                    <?php
                    for ($i = 0; $i < $totalNumberOfPages; $i++) {
                        if ($i == $currentPageNumber) {
                            print "<b title=\"You are on this page\" >" . $i . "</b>&nbsp;|&nbsp;";
                        } else {
                            print "<a href=\"#\" onClick=\"all_order_filter_paged(" . $i . ")\">" . $i . "</a>&nbsp;|&nbsp;";
                        }
                    }
                    ?>
                </div>
            </td>
        </tr>
        <tr align="center" style="background-color: #0a6d52; color: #fff">
            <th>Select</th>
            <th scope="col">Store Name<select name="store_dropdown" class="str" id = "selectStore">
                    <option id="nameofstore" selected="selected" value="0">- - Select Store - -</option>
                    <?php foreach ($s_ord as $row1) : ?>
                        <option value="<?php echo $row1['store_name']; ?>"><?php echo $row1['store_name']; ?></option>
                    <?php endforeach; ?>
                </select><input type="button" value="Go" onclick = "selectStore()"></th>
            <th scope="col">Order ID</th>
            <th scope="col">Ordered Date
                <select class="obdate"id = "selectOrderedDate">
                    <option>--Select Date--</option>
                    <?php
                    $Date = $row['date_of_order'];
                    for ($i = 0; $i < 30; $i++) {
                        $edate = date('Y-m-d', strtotime($Date . ' - ' . $i . ' days'));
                        ?>
                        <option value=<?php echo $edate; ?>><?php echo $edate; ?></option>
                    <?php
                    }
                    ?>
            </th>
            <th scope="col">Last Date For PickUP</th>
            <th scope="col">Logistics Partner</th>
            <th scope="col">Track ID</th>
            <th scope="col">Product Information</th>
            <th scope="col">Product Image</th>
            <th scope="col">Qty</th>
            <th scope="col">Paid Price(Total)</th>
            <th scope="col">BNB Discount</th>
            <th scope="col">Seller Earnings</th>
            <th scope="col">Order status</th>
            <th scope="col">Action</th>
            <th scope="col">Buyer Invoice</th>
            <th scope="col">Shipping Label</th>
            <th scope="col">Send Mail</th>
        </tr>
        <?php foreach ($s_order as $row) { ?>
            <?php
            $allOrdersxxx[] = $row['order_id'];
            $allTxnsxxx[] = $row['txnid'];
            ?>
            <tr align="center">
                <td>
                    <?php
                    //if($row['status_order'] != 4 && $row['status_order'] != 5)
                    {
                        ?>
                        <input type="CHECKBOX" id="orderNo<?php echo $row['order_id']; ?>">
                    <?php
                    }
                    ?>
                </td>
                <td><span style="cursor:pointer"
                          onclick="seller_info(<?php echo $row['order_id']; ?>)"><?php echo $row['store_name']; ?></span>
                </td>
                <td><strong><font color="#990066"><?php echo $row['order_id']; ?></font></strong></td>
                <td><strong><font color="#330066"><?php echo $row['orderdate']; ?></font></strong></td>
                <?php $Date = $row['date_of_order'];
                $edate = date('Y-m-d', strtotime($Date . ' + ' . $row['processing_time'] . ' days'));?>
                <td><strong><font color="#330066"><?php echo $edate; ?></font></strong></td>
                <td>
                    <select class="invoice">
                        <option class="selectedOption" value="default_<?php echo $row['order_id']; ?>"
                                id="default_<?php echo $row['order_id']; ?>">Default
                        </option>
                        <option class="selectedOption" value="fedex_<?php echo $row['order_id']; ?>"
                                id="fedex_<?php echo $row['order_id']; ?>">Fedex
                        </option>
                        <option class="selectedOption" value="gati_<?php echo $row['order_id']; ?>"
                                id="gati_<?php echo $row['order_id']; ?>">Gati
                        </option>
                        <option class="selectedOption" value="bd_<?php echo $row['order_id']; ?>"
                                id="bd_<?php echo $row['order_id']; ?>">Blue Dart
                        </option>
                    </select>
                </td>

                <td style="background-color: #fff; color: #0a6d52">
                    <strong>
                        <font color="#006600">
                            <?php
                            if (!is_null($row['awb_no'])) {
                                echo $row['awb_no'] . "<hr/>";
                                print'<p> UPDATE AWB NO: <input type="text" id="genrateawbNO"></p>';
                                 print '<input type = "button" value = "save awb no" onclick = "updateAWBNO(\''.$row['order_id'].'\')">'; 
                            }
                            if ($row['shipping_partner'] == 3) // if the shipping partner is gati
                            {
                                echo "<font color=\"red\">Not Applicable</font>";
                                if (!is_null($row['awb_no'])) // and still an AWB NO has been generated, then provide a link to re-claim it
                                {
                                    // print '<a target="_blank" href="'.base_url().'index.php/crm/reclaimAWBNO/'.$row['awb_no'].'">Reclaim AWB NO</a>';
                                    /* THIS FEATURE CAN NOT BE MADE BECAUSE OF DB LIMITATIONS */
                                }
                            } else {
                                if ((is_null($row['awb_no']) || strcmp($row['awb_no'], "") === 0) && $row['status_order'] != 5) // if no AWB NO has been generated
                                {
                                    print '<input type="BUTTON" onCLick="window.open(\'' . base_url() . 'index.php/crm/generateAWBNO/' . $row['order_id'] . '\',\'\',\'width=200,height=100\')" value="Generate AWB NO">';
                                    print'<p>AWB NO: <input type="text" id="genrateawbNO"></p>';
                                    print '<input type = "button" value = "save awb no" onclick = "updateAWBNO(\''.$row['order_id'].'\')">'; 
                                }
                            }
                            ?>
                        </font>
                    </strong>
                </td>
                <td><strong><font color="#330066">
                            Name : <?php echo $row['product_name']; ?></br>
                            Code : <?php echo $row['bnb_product_code']; ?></br>
                            Size : <?php echo $row['vsize']; ?></br>
                            Colour : <?php echo $row['vcolor']; ?></br>
                        </font></strong>
                </td>
                <td>
                    <img style="cursor:pointer" onclick="product_info(<?php echo $row['order_id']; ?>)" alt="Product"
                         height="70"
                         src="https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/<?php echo $row['store_id']; ?>/<?php echo $row['product_id']; ?>/img1_97x80.jpg"/>
                    <br/><a
                        href="<?php echo base_url(); ?>index.php/download/index/<?php echo $row['store_id'] . '/' . $row['product_id'] . '/' . $row['order_id']; ?>"
                        target="_blank"> Download Image </a>
                </td>
                <td><strong><?php echo $row['totalQuantity']; ?></strong></td>
                <td>
                    <div style="cursor:pointer" onclick="payment_info(<?php echo $row['order_id']; ?>)">
                        <img src="<?php echo base_url(); ?>assets/<?php echo $row['pg_type']; ?>.png" width="80"
                             alt="payment_mode"><br>
                        <?php $total = ceil(($row['totalQuantity'] * $row['amt_paid'] - $row['redeemedprice']));
                        ?>
                        <strong>Rs.<br><?php echo floatval($total); ?>.00</strong>
                    </div>
                </td>
                <?php
                if ($row['status_order'] == 1)
                    $status = '<img src="' . base_url() . 'assets/pending.png" width="120" alt="Pending New Order" />';
                elseif ($row['status_order'] == 2)
                    $status = '<img src="' . base_url() . 'assets/process.png" width="120" alt="In Process" />'; elseif ($row['status_order'] == 3)
                    $status = '<img src="' . base_url() . 'assets/shipping.png" width="120" alt="Shipping" />'; elseif ($row['status_order'] == 4)
                    $status = '<img src="' . base_url() . 'assets/completed.png" width="120" alt="Completed" />'; elseif ($row['status_order'] == 5)
                    $status = '<img src="' . base_url() . 'assets/cancelled.png" width="120" alt="Cancelled" />'; elseif ($row['status_order'] == 6)
                    $status = 'Problem with Order/Invoice<br><img src="' . base_url() . 'assets/problem.png" width="120" alt="Problem with Order" />';elseif ($row['status_order'] == 7)
                    $status = 'Test Order<br><img src="' . base_url() . 'assets/test.png" width="120" alt="Test Order" />'; else $status = 'not defined';?>
                <td><?php echo $row['discount']; ?></td>
                <td><?php echo $row['seller_earnings']; ?></td>
                <td><?php echo $status; ?></td>
                <td>
                    <?php if (!($row['status_order'] == 5) and !($row['status_order'] == 4)) : ?>
                        <select id="bnb_sts_<?php echo $row['order_id']; ?>">
                            <option value="1">Restart Processing</option>
                            <?php if ($row['status_order'] == 1) : ?>
                                <option value="2">Start Processing</option>
                                <option value="5">Cancel Order</option>
                                <option value="6">Problem with Order</option>
                                <option value="7">Test Order</option>

                            <?php elseif ($row['status_order'] == 2) : ?>
                                <option value="3" onclick='popup(this.value,<?php echo $row['order_id']; ?>);'>
                                    Shipping
                                </option>

                                <option value="5">Cancel Order</option>
                                <option value="7">Test Order</option>
                                <option value="6">Problem with Order/Invoice</option>
                                <option value="7">Test Order</option>
                            <?php elseif ($row['status_order'] == 3) : ?>
                                <option value="4">Completed</option>
                                <option value="5">Cancel Order</option>
                                <option value="6">Problem with Invoice</option>
                                <option value="7">Test Order</option>
                            <?php elseif ($row['status_order'] == 6) : ?>
                                <option value="21">Regenerate Invoice(with Old AWB Code)</option>
                                <option value="22">Regenerate Invoice(with New AWB Code)</option>
                                <option value="5">Cancel Order</option>
                                <option value="7">Test Order</option>
                            <?php endif; ?>
                        </select><br>
                        <input type="text" name="shippingdate" id="shippingdate<?php echo $row['order_id']; ?>"
                               placeholder="Shipping date YYYY-MM-DD" style='display:none'/><br>
                        <input type="text" name="shippingtime" id="shippingtime<?php echo $row['order_id']; ?>"
                               placeholder="Shipping time HH:MM" style='display:none'/>


                        <input type="button" value="Go"
                               onclick='return all_modify_status(<?php echo $row['order_id']; ?>,"<?php echo $row['txnid']; ?>", <?php echo $currentPageNumber; ?>)'/>

                              

                    <?php elseif ($row['status_order'] == 4): ?>
                        <img src="<?php echo base_url(); ?>assets/completed.png" width="120" alt="Completed Oder"/>

                        
                    <?php else: ?>
                        <img src="<?php echo base_url(); ?>assets/cancelled.png" width="120" alt="Cancelled Oder"/>
                    <?php endif; ?>
                </td>
                <td>
                    <?php $filename1 = $live_url . 'invoice/' . $row['txnid'] . '/buyer_invoice_order_' . $row['order_id'] . '.pdf'; ?>
                    <table>
                        <tr>
                            <td rowspan="2"><a target="_blank" href="<?php echo $filename1; ?>"><img
                                        src="<?php echo base_url(); ?>assets/pdficon.gif" width="55"
                                        alt="PDF Icon"/></a></td>
                            <!--<td><input type="BUTTON" value="Explicit Email to Buyer" onClick="return emailInvoiceToBuyer(<?php $row['order_id']; ?>, '<?php $row['txnid']; ?>')" /></td>-->
                        </tr>
                        <!--<tr>
							<td><input type="BUTTON" value="Explicit Email to Seller" onClick="return emailInvoiceToSeller(<?php $row['order_id']; ?>, '<?php $row['txnid']; ?>')" /></td>
						</tr>-->
                    </table>
                </td>
                <td id="shivam_<?php echo $row['order_id']; ?>">
                </td>
                <td>
                    <div class="mail1"><input type="button" value="Send Mail" onclick="semail()" id="mail"></div>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="13">
                <div style="width: 100%; text-align: right">
                    <?php
                    for ($i = 0; $i < $totalNumberOfPages; $i++) {
                        if ($i == $currentPageNumber) {
                            print "<b title=\"You are on this page\" >" . $i . "</b>&nbsp;|&nbsp;";
                        } else {
                            print "<a href=\"#\" onClick=\"all_order_filter_paged(" . $i . ")\">" . $i . "</a>&nbsp;|&nbsp;";
                        }
                    }
                    ?>
                </div>
            </td>
        </tr>
        </table>
    <?php
    }

    public function changeShippingPartner($order_id, $shippingPartner = NULL) // Regenerates AWB NUMBER only if has not been created
    {
        $shipping_details = $this->crm_model->shipping_partner($order_id);
        $shipping_partner = (int)$shipping_details['shipping_partner'];
        $txn_id = (int)$shipping_details['txnid'];
        switch (is_null($shippingPartner)) {
            case FALSE:
                $shipping_partner = $shippingPartner; // 1 = fedex, 2 = bluedart, 3 = gati
                $changeShippingPartnerInDB = $this->crm_model->updateShippingPartner($order_id, $shippingPartner); // change the shipping partner in DB
                break;
        }

        if ($shipping_partner == 2) {
            if ($shipping_details['payment_status'] != 1) {
                $shipping_type = 0;
            } else {
                $shipping_type = 1;
            }
        } else
            $shipping_type = 1;
        if ($shipping_partner != 3 && is_null($shipping_details['awb_no'])) // only generate new AWB NO if it does not exist in the database
        {
            $docket_number = $this->crm_model->docket_no($shipping_partner, $shipping_type);
            $this->crm_model->update_docket($order_id, $shipping_partner, $docket_number, $shipping_type);
        } else {
            $awbNo = $this->crm_model->fetchAWBNO($order_id); // read the current awbNo for the current orderID
            if (!$this->crm_model->hasValidAWBNO($order_id, $shipping_type) && $shipping_partner != 3) // if the current order does not have the AWBNO according to its shipping partner and the shipping partner is not gati
            {
                $docket_number = $this->crm_model->docket_no($shipping_partner, $shipping_type);
                $this->crm_model->setAWBNO($orderID, $docket_number); // update the DB to fix the AWBNO
                $this->crm_model->update_docket($order_id, $shipping_partner, $docket_number, $shipping_type);
            }
        }
        $url = base_url("index.php/crm/sellerInvoice/" . $order_id . '/' . $shipping_partner);
        redirect($url);
    }

    public function generateAWBNO($orderID)
    {
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $shippingDetails = $this->crm_model->shipping_partner($orderID);
        $shippingPartner = (int)$shippingDetails['shipping_partner'];

        if ($shippingPartner == 2) {
            if ($shippingDetails['payment_status'] != 1)
                $shippingType = 0;
            else
                $shippingType = 1;
        } else
            $shippingType = 1;

        if ($shippingPartner != 3 && is_null($shippingDetails['awb_no'])) // only generate new AWB NO if it does not exist in the database
        {
            $docketNumber = $this->crm_model->docket_no($shippingPartner, $shippingType);
            $this->crm_model->update_docket($orderID, $shippingPartner, $docketNumber, $shippingType);
            print "<p>generating AWB NO...</p>";
        }
    }
    //jQuery("#shivam_"+n[1]).html("<a href='szdfaf'>asdasd</a>");
}

?>
