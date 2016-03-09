<?php

    class ProductsCsv extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('download');
    $this->load->helper('file'); 
    $this->load->helper('array');
    $this->load->dbutil();
  }
  public function index()
  {
    $data['baseURL'] = base_url();
    $this->load->view('prod_csv', $data);
  }
  public function prodCSV($startID,$endID) 
  {
    $this->load->model('magento_csv');
    $productDetail = $this->magento_csv->csvprodData($startID,$endID);
    $file = fopen('php://output', 'w');
    ob_start();
    $header  = array('sku' => 'sku',
                     '_store'=>'_store',
                     '_attribute_set'=>'_attribute_set',
                     '_type'=>'_type',
                     '_category'=>'_category',
                     '_root_category'=>'_root_category',
                     '_product_websites'=>'_product_websites',
                     'color'=>'color',
                     'cost'=>'cost',
                     'country_of_manufacture'=>'country_of_manufacture',
                     'created_at'=>'created_at',
                     'custom_design'=>'custom_design',
                     'custom_design_from'=>'custom_design_from',
                     'custom_design_to'=>'custom_design_to',
                     'custom_layout_update'=>'custom_layout_update',
                     'description'=>'description',
                     'enable_googlecheckout'=>'enable_googlecheckout',
                     'gallery'=>'gallery',
                     'gift_message_available'=>'gift_message_available',
                     'has_options'=>'has_options',
                     'image'=>'image',
                     'image_label'=>'image_label',
                     'manufacturer'=>'manufacturer',
                     'media_gallery'=>'media_gallery',
                     'meta_description'=>'meta_description',
                     'meta_keyword'=>'meta_keyword',
                     'meta_title'=>'meta_title',
                     'minimal_price'=>'minimal_price',
                     'msrp'=>'msrp',
                     'msrp_display_actual_price_type'=>'msrp_display_actual_price_type',
                     'msrp_enabled'=>'msrp_enabled',
                     'name'=>'name',
                     'news_from_date'=>'news_from_date',
                     'news_to_date'=>'news_to_date',
                     'options_container'=>'options_container',
                     'page_layout'=>'page_layout',
                     'price'=>'price',
                     'required_options'=>'required_options',
                     'short_description'=>'short_description',
                     'small_image'=>'small_image',
                     'small_image_label'=>'small_image_label',
                     'special_from_date'=>'special_from_date',
                     'special_price'=>'special_price',
                     'special_to_date'=>'special_to_date',
                     'status'=>'status',
                     'tax_class_id'=>'tax_class_id',
                     'thumbnail'=>'thumbnail',
                     'thumbnail_label'=>'thumbnail_label',
                     'updated_at'=>'updated_at',
                     'url_key'=>'url_key',
                     'url_path'=>'url_path',
                     'visibility'=>'visibility',
                     'weight'=>'weight',
                     'qty'=>'qty',
                     'min_qty'=>'min_qty',
                     'use_config_min_qty'=>'use_config_min_qty',
                     'is_qty_decimal'=>'is_qty_decimal',
                     'backorders'=>'backorders',
                     'use_config_backorders'=>'use_config_backorders',
                     'min_sale_qty'=>'min_sale_qty',
                     'use_config_min_sale_qty'=>'use_config_min_sale_qty',
                     'max_sale_qty'=>'max_sale_qty',
                     'use_config_max_sale_qty'=>'use_config_max_sale_qty',
                     'is_in_stock'=>'is_in_stock',
                     'notify_stock_qty'=>'notify_stock_qty',
                     'use_config_notify_stock_qty'=>'use_config_notify_stock_qty',
                     'manage_stock'=>'manage_stock',
                     'use_config_manage_stock'=>'use_config_manage_stock',
                     'stock_status_changed_auto'=>'stock_status_changed_auto',
                     'use_config_qty_increments'=>'use_config_qty_increments',
                     'qty_increments'=>'qty_increments',
                     'use_config_enable_qty_inc'=>'use_config_enable_qty_inc',
                     'enable_qty_increments'=>'enable_qty_increments',
                     'is_decimal_divided'=>'is_decimal_divided',
                     '_links_related_sku'=>'_links_related_sku',
                     '_links_related_position'=>'_links_related_position',
                     '_links_crosssell_sku'=>'_links_crosssell_sku',
                     '_links_crosssell_position'=>'_links_crosssell_position',
                     '_links_upsell_sku'=>'_links_upsell_sku',
                     '_links_upsell_position'=>'_links_upsell_position',
                     '_associated_sku'=>'_associated_sku',
                     '_associated_default_qty'=>'_associated_default_qty',
                     '_associated_position'=>'_associated_position',
                     '_tier_price_website'=>'_tier_price_website',
                     '_tier_price_customer_group'=>'_tier_price_customer_group',
                     '_tier_price_qty'=>'_tier_price_qty',
                     '_tier_price_price'=>'_tier_price_price',
                     '_group_price_website'=>'_group_price_website',
                     '_group_price_customer_group'=>'_group_price_customer_group',
                     '_group_price_price'=>'_group_price_price',
                     '_media_attribute_id'=>'_media_attribute_id',
                     '_media_image'=>'_media_image',
                     '_media_lable'=>'_media_lable',
                     '_media_position'=>'_media_position',
                     '_media_is_disabled'=>'_media_is_disabled'
                     
                      );
    fputcsv($file, $header);

        foreach ($productDetail as $fields) 
        {
           $data = array('sku' => $fields[0]['productID'],
                         '_store'=>'',
                         '_attribute_set'=>'Default',
                         '_type'=>'simple',
                         '_category'=>$fields[0]['Category'],
                         '_root_category'=>'',
                         '_product_websites'=>'base',
                         'color'=>$fields[0]['Color'],
                         'cost'=>'',
                         'country_of_manufacture'=>$fields[0]['Country'],
                         'created_at'=>$fields[0]['AddedOn'],
                         'custom_design'=>'',
                         'custom_design_from'=>'',
                         'custom_design_to'=>'',
                         'custom_layout_update'=>'',
                         'description'=>$fields[0]['Description'],
                         'enable_googlecheckout'=>'1',
                         'gallery'=>'',
                         'gift_message_available'=>'',
                         'has_options'=>'1',
                         'image'=>'',
                         'image_label'=>'',
                         'manufacturer'=>'',
                         'media_gallery'=>'',
                         'meta_description'=>'',
                         'meta_keyword'=>'',
                         'meta_title'=>'',
                         'minimal_price'=>'',
                         'msrp'=>'',
                         'msrp_display_actual_price_type'=>'Use config',
                         'msrp_enabled'=>'Use config',
                         'name'=>$fields[0]['productName'],
                         'news_from_date'=>'',
                         'news_to_date'=>'',
                         'options_container'=>'Block after Info Column',
                         'page_layout'=>'',
                         'price'=>$fields[0]['totalSellingPrice'],
                         'required_options'=>'0',
                         'short_description'=>'',
                         'small_image'=>'',
                         'small_image_label'=>'',
                         'special_from_date'=>'',
                         'special_price'=>'',
                         'special_to_date'=>'',
                         'status'=>$fields[0]['productStatus'],
                         'tax_class_id'=>'',
                         'thumbnail'=>'',
                         'thumbnail_label'=>'',
                         'updated_at'=>'',
                         'url_key'=>'',
                         'url_path'=>'',
                         'visibility'=>'',
                         'weight'=>$fields[0]['Weight'],
                         'qty'=>$fields[0]['productQuantity'],
                         'min_qty'=>'0',
                         'use_config_min_qty'=>'1',
                         'is_qty_decimal'=>'0',
                         'backorders'=>'0',
                         'use_config_backorders'=>'1',
                         'min_sale_qty'=>'1',
                         'use_config_min_sale_qty'=>'1',
                         'max_sale_qty'=>'0',
                         'use_config_max_sale_qty'=>'',
                         'is_in_stock'=>'',
                         'notify_stock_qty'=>'',
                         'use_config_notify_stock_qty'=>'',
                         'manage_stock'=>'',
                         'use_config_manage_stock'=>'',
                         'stock_status_changed_auto'=>'',
                         'use_config_qty_increments'=>'',
                         'qty_increments'=>'',
                         'use_config_enable_qty_inc'=>'',
                         'enable_qty_increments'=>'',
                         'is_decimal_divided'=>'',
                         '_links_related_sku'=>'',
                         '_links_related_position'=>'',
                         '_links_crosssell_sku'=>'',
                         '_links_crosssell_position'=>'',
                         '_links_upsell_sku'=>'',
                         '_links_upsell_position'=>'',
                         '_associated_sku'=>'',
                         '_associated_default_qty'=>'',
                         '_associated_position'=>'',
                         '_tier_price_website'=>'',
                         '_tier_price_customer_group'=>'',
                         '_tier_price_qty'=>'',
                         '_tier_price_price'=>'',
                         '_group_price_website'=>'',
                         '_group_price_customer_group'=>'',
                         '_group_price_price'=>'',
                         '_media_attribute_id'=>'',
                         '_media_image'=>'',
                         '_media_lable'=>'',
                         '_media_position'=>'',
                         '_media_is_disabled'=>''
                         
                          );
            fputcsv($file, $data);
        }
            $string = ob_get_clean();
                    
            $filename = 'csv_' . date('Ymd') .'_' . date('His');
            header("Cache-Control: private",false);
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment filename=\"$filename.csv\";" );
            header("Content-Transfer-Encoding: binary");
 
            exit($string);
    }
  }
?>