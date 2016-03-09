<?php 
class Productscsv extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		
		
	}
	
public function upload()
{
if(isset($_POST['submit']))
 {
     $filename=$_FILES['files']['name'];
	 $filename="assets/".$filename;
	 move_uploaded_file($_FILES['files']['tmp_name'],$filename);
	 $handle = fopen($filename, "r+");
	
	$data = fgetcsv($handle, 1000, ",");    //Remove Ist column headings
	$data = fgetcsv($handle, 1000, ",");   //  Remove IInd column headings
	
	
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		
	$Sno = mysql_real_escape_string($data[0]);
	
	$Pimg = mysql_real_escape_string($data[1]);
	
	$VProdcode = mysql_real_escape_string($data[2]);
	
	$Bnbprodcode = mysql_real_escape_string($data[3]);
	
	$category = mysql_real_escape_string($data[4]);
	
	$subCategory1 = mysql_real_escape_string($data[5]);
	
	$subCategory2 = mysql_real_escape_string($data[6]);
	
	$subCategory3 = mysql_real_escape_string($data[7]);
	
	$storeSection = mysql_real_escape_string($data[8]);
	
	$storeId = mysql_real_escape_string($data[9]);
	
	$product = mysql_real_escape_string($data[10]);
	
	$prodCreatWrite = mysql_real_escape_string($data[11]);
	
	$color = mysql_real_escape_string($data[12]);
	
	$finish = mysql_real_escape_string($data[13]);
	
	$size = mysql_real_escape_string($data[14]);
	
	$techSpec = mysql_real_escape_string($data[15]);
	
	$materialComp = mysql_real_escape_string($data[16]);
	
	$totalPiece = mysql_real_escape_string($data[17]);
	
	$tags = mysql_real_escape_string($data[18]);
	
	$occasion = mysql_real_escape_string($data[19]);
	
	$styles = mysql_real_escape_string($data[20]);
	
	$prd1DimensionLabel = mysql_real_escape_string($data[21]);
	
	$prd1Length = mysql_real_escape_string($data[22]);
	
	$prd1Width = mysql_real_escape_string($data[23]);
	
	$prd1height = mysql_real_escape_string($data[24]);
	
	$prd1capacity = mysql_real_escape_string($data[25]);
	
	$prd1diameter = mysql_real_escape_string($data[26]);
	
	$prd1unit = mysql_real_escape_string($data[27]);
	
	$prd2DimensionLabel = mysql_real_escape_string($data[28]);
	
	$prd2Length = mysql_real_escape_string($data[29]);
	
	$prd2Width = mysql_real_escape_string($data[30]);
	
	$prd2height = mysql_real_escape_string($data[31]);
	
	$prd2capacity = mysql_real_escape_string($data[32]);
	
	$prd2diameter = mysql_real_escape_string($data[33]);
	
	$prd2unit = mysql_real_escape_string($data[34]);
	
	$prd3DimensionLabel = mysql_real_escape_string($data[35]);
	
	$prd3Length = mysql_real_escape_string($data[36]);
	
	$prd3Width = mysql_real_escape_string($data[37]);
	
	$prd3height = mysql_real_escape_string($data[38]);
	
	$prd3capacity = mysql_real_escape_string($data[39]);
	
	$prd3diameter = mysql_real_escape_string($data[40]);
	
	$prd3unit = mysql_real_escape_string($data[41]);
	
	$weight = mysql_real_escape_string($data[42]);
	
	$whatsInBox = mysql_real_escape_string($data[43]);
	
	$usage = mysql_real_escape_string($data[44]);
	
	$careQcIns = mysql_real_escape_string($data[45]);	
	
	$assembly = mysql_real_escape_string($data[46]);
	
	$sellerAssurance = mysql_real_escape_string($data[47]);
	
	$additionalInfo = mysql_real_escape_string($data[48]);
	
	$deliveryTime = mysql_real_escape_string($data[49]);
	
	$price = mysql_real_escape_string($data[50]);
	
	$cartonlength = mysql_real_escape_string($data[51]);
	
	$cartonwidth = mysql_real_escape_string($data[52]);
	
	$cartonheight = mysql_real_escape_string($data[53]);
	
	$actualWeight = mysql_real_escape_string($data[54]);
	
	$volWeCal = mysql_real_escape_string($data[55]);
	
	$prefMode = mysql_real_escape_string($data[56]);
	
	$moneyin = mysql_real_escape_string($data[57]);
	
	$bnbComm = mysql_real_escape_string($data[58]);
	
	$taxRate = mysql_real_escape_string($data[59]);
	
	$taxThis = mysql_real_escape_string($data[60]);
	
	$insurance = mysql_real_escape_string($data[61]);
	
	$shippingCost = mysql_real_escape_string($data[62]);
	
	$mrp = mysql_real_escape_string($data[63]);
	
	$discountMrp = mysql_real_escape_string($data[64]);
	
	$discountValue = mysql_real_escape_string($data[65]);
	
	$sellingPrice = mysql_real_escape_string($data[66]);
	
	$quantity = mysql_real_escape_string($data[67]);
	
	$processingTime = mysql_real_escape_string($data[68]);
	
	
	
   if($Sno!="")
  {
    $section="";
    $sqlFetchStore=mysql_fetch_array(mysql_query("select * from store_section where store_id='".$storeId."' and name='".$storeSection."'"));
	$section=$sqlFetchStore['0'];
	$sectionStoreId=$sqlFetchStore['1'];
	$sectionName=$sqlFetchStore['2'];
	if($sectionStoreId!=$storeId && $sectionName!=$storeSection)
	{
	   $sqlStoresection="insert into store_section(store_id,name,is_on_discount,promotion_id) values('".$storeId."','".$storeSection."',0,0)";
	   $resultStoresection=mysql_query($sqlStoresection);
	   if(!$resultStoresection)
	    {
			die('Invalid query: ' . mysql_error());
		}
	   $storeSectionId = mysql_fetch_array(mysql_query("SELECT MAX(storesection_id) FROM store_section"));
	   $section = $storeSectionId['0']; 
	 }
	 if($discountValue>0)
	 {
	       $sqlpromotion=mysql_query("insert into promotion(store_id,discount_on_type,promotion_type,discount,expiry_type,status) values ('".$storeId."',1,0,'".$discountValue."',0,1)");
		   $sqlfetchPromotion=mysql_fetch_array(mysql_query("select max(id) from promotion"));
		   $promotionId=$sqlfetchPromotion['0'];

		   
$sqlProductsNew = "INSERT INTO productsNew(store_id, cat_id, sub_catid1, sub_catid2, sub_catid3, product_name, prd_act_weight, tax_rate, insurance_cost, shipping_cost, selling_price, quantity, processing_time, discount, discount_percent, prd_vol_weight, shipping_mode, bnb_commission, bnb_product_code, storesection_id) ";
$sqlProductsNew .= "VALUES ('".$storeId."','".$category."','".$subCategory1."','".$subCategory2."','".$subCategory3."','".$product."','".$weight."','".$taxRate."','".$insurance."','".$shippingCost."','".$sellingPrice."','".$quantity."','".$processingTime."','".$discountValue."','".$discountMrp."','".$volWeCal."','".$prefMode."','".$bnbComm."','".$Bnbprodcode."','".$section."')";

$sqlProductsNew = "INSERT INTO productsNew(store_id, cat_id, sub_catid1, sub_catid2, sub_catid3, product_name, prd_act_weight, tax_rate, insurance_cost, shipping_cost, selling_price, quantity, processing_time, discount, discount_percent, is_on_discount, prd_vol_weight, shipping_mode, seller_earnings, bnb_commission, promotion_id, bnb_product_code, storesection_id) ";
$sqlProductsNew .= "VALUES ('".$storeId."','".$category."','".$subCategory1."','".$subCategory2."','".$subCategory3."','".$product."','".$weight."','".$taxRate."','".$insurance."','".$shippingCost."','".$sellingPrice."','".$quantity."','".$processingTime."','".$discountValue."','".$discountMrp."',".($discountValue > 0? 1 : 0).",'".$volWeCal."','".$prefMode."','".$moneyin."','".$bnbComm."','".$promotionId."','".$Bnbprodcode."','".$section."')";
	
	        $result=mysql_query($sqlProductsNew);
			
			$sqlfetchProduct=mysql_fetch_array(mysql_query("select max(product_id) from productsNew"));
			$oldProdId=$sqlfetchProduct['0'];
			
			$sqloldProducts="insert into products(product_id,store_id,cat_id,sub_catid1,sub_catid2,sub_catid3,product_name,bnb_product_code,storesection_id,occasions,style,tags,length,breadth,height,prd_act_weight,prd_vol_weight,shipping_mode,seller_earnings,bnb_commission,tax_rate,insurance_cost,shipping_cost,selling_price,quantity,processing_time,status,discount,is_on_discount,promotion_id) values('".$oldProdId."',
			                 '".$storeId."','".$category."','".$subCategory1."','".$subCategory2."','".$subCategory3."','".$product."','".$Bnbprodcode."','".$section."','".$occasion."','".$styles."','".$tags."','".$prd1Length."','".$prd1Width."','".$prd1height."','".$weight."','".$volWeCal."','".$prefMode."','".$moneyin."','".$bnbComm."','".$taxRate."','".$insurance."','".$shippingCost."','".$sellingPrice."','".$quantity."','".$processingTime."',1,'".$discountValue."',1,'".$promotionId."')";
			
			$resultold=mysql_query($sqloldProducts);
			if(!$resultold)
	        {
			die('Invalid query: ' . mysql_error());
		    }
			
	   
	   if(!$result)
	    {
			die('Invalid query: ' . mysql_error());
		}
	 }
	 else
	 {
	         $sqlProductsNew1 = "INSERT INTO productsNew(store_id,cat_id,sub_catid1,sub_catid2,sub_catid3,product_name,prd_act_weight,tax_rate,insurance_cost,shipping_cost,selling_price,quantity,processing_time,discount,discount_percent,is_on_discount,prd_vol_weight,shipping_mode,seller_earnings,bnb_commission,promotion_id,bnb_product_code,storesection_id) VALUES ('".$storeId."','".$category."','".$subCategory1."','".$subCategory2."','".$subCategory3."','".$product."',
	        '".$weight."','".$taxRate."','".$insurance."','".$shippingCost."','".$sellingPrice."','".$quantity."','".$processingTime."','".$discountValue."','".$discountMrp."',0,'".$volWeCal."','".$prefMode."','".$moneyin."','".$bnbComm."',0,'".$Bnbprodcode."','".$section."')";
	         $result=mysql_query($sqlProductsNew1);
			 
			 $sqlfetchProduct1=mysql_fetch_array(mysql_query("select max(product_id) from productsNew"));
			$oldProdId1=$sqlfetchProduct1['0'];
			 
			 $sqloldProducts1="insert into products(product_id,store_id,cat_id,sub_catid1,sub_catid2,sub_catid3,product_name,bnb_product_code,storesection_id,occasions,style,tags,length,breadth,height,prd_act_weight,prd_vol_weight,shipping_mode,seller_earnings,bnb_commission,tax_rate,insurance_cost,shipping_cost,selling_price,quantity,processing_time,status,discount,is_on_discount,promotion_id) values('".$oldProdId1."',
			                 '".$storeId."','".$category."','".$subCategory1."','".$subCategory2."','".$subCategory3."','".$product."','".$Bnbprodcode."','".$section."','".$occasion."','".$styles."','".$tags."','".$prd1Length."','".$prd1Width."','".$prd1height."','".$weight."','".$volWeCal."','".$prefMode."','".$moneyin."','".$bnbComm."','".$taxRate."','".$insurance."','".$shippingCost."','".$sellingPrice."','".$quantity."','".$processingTime."',1,'".$discountValue."',0,0)";
			
			 mysql_query($sqloldProducts1);
	 }
	$productId = mysql_fetch_array(mysql_query("SELECT MAX(product_id) FROM productsNew"));
	$product = $productId['0'];
	
    $sqlPDesc="insert into pDesc(refProductID,description,occasions,style,tags,vendor_product_code,finish,tech_spec,material_composition,whats_in_the_box,care,assembly,seller_assurance,additional_info,cartonLength,cartonBreadth,cartonHeight,packageWeight,`usage`) values ('".$product."','".$prodCreatWrite."',
	          '".$occasion."','".$styles."','".$tags."','".$VProdcode."','".$finish."','".$techSpec."','".$materialComp."','".$whatsInBox."','".$careQcIns."','".$assembly."','".$sellerAssurance."','".$additionalInfo."','".$cartonlength."','".$cartonwidth."','".$cartonheight."','".$actualWeight."','".$usage."')";
    $res= mysql_query($sqlPDesc);
	
	   if(!$res)
		{
			die('Invalid query: ' . mysql_error());
		}
   if($prd1Length!="" || $prd1Width!="" || $prd1height!="" || $prd1unit!="" || $prd1capacity!="" || $prd1diameter!="" || $prd1DimensionLabel!="")
     {
	      $newUnit="";
	      if($prd1unit=='cms'){
	      $newUnit=2;}
	      else{
          $newUnit=1;}

	
    $sqlpDims="insert into pDims(refProductID,length,breadth,height,dimensionUnit,capacity,diameter,dimensionLabel) values
	          ('".$product."','".$prd1Length."','".$prd1Width."','".$prd1height."','".$newUnit."','".$prd1capacity."','".$prd1diameter."','".$prd1DimensionLabel."')";
	mysql_query($sqlpDims);
	  if($prd2Length!="" || $prd2Width!="" || $prd2height!="" || $prd2unit!="" || $prd2capacity!="" || $prd2diameter!="" || $prd2DimensionLabel!="")
      {
	     $newUnit1="";
	      if($prd2unit=='cms'){
	      $newUnit1=2;}
	      else{
          $newUnit1=1;}
	     $sqlpDims1="insert into pDims(refProductID,length,breadth,height,dimensionUnit,capacity,diameter,dimensionLabel) values
	          ('".$product."','".$prd2Length."','".$prd2Width."','".$prd2height."','".$newUnit1."','".$prd2capacity."','".$prd2diameter."','".$prd2DimensionLabel."')";
	     mysql_query($sqlpDims1);
	  }
	     if($prd3Length!="" || $prd3Width!="" || $prd3height!="" || $prd3unit!="" || $prd3capacity!="" || $prd3diameter!="" || $prd3DimensionLabel!="")
         {
		    $newUnit2="";
	        if($prd3unit=='cms'){
	        $newUnit2=2;}
	        else{
            $newUnit2=1;}
		    $sqlpDims2="insert into pDims(refProductID,length,breadth,height,dimensionUnit,capacity,diameter,dimensionLabel) values
	          ('".$product."','".$prd3Length."','".$prd3Width."','".$prd3height."','".$newUnit2."','".$prd3capacity."','".$prd3diameter."','".$prd3DimensionLabel."')";
	         mysql_query($sqlpDims2);
		 }
    }	
   }
   
   
	
 }	

          			 
    
	
	$data['msg']="Product Data Imported!!";
 
		
}


	     
    $this->load->view('productCsv',$data); 
}
}
?>