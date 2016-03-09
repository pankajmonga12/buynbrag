<?php
//Mysql server, user, Pwd credentials.
$con = mysql_connect('54.251.39.22','vignesh','Vitallabs321'); 
if (!$con) { 
        die('Could not connect to MySQL: ' . mysql_error()); 
}

//Select the db.
$select = mysql_select_db('bnbdb', $con);

//Source path where the products folder has been placed
$src_base_dir = 'C:\\p2\\';
echo $src_base_dir.'<br>';
//Run the script for stores one by one.
$store_id = 149;
//$query = "SELECT store_id,product_id,bnb_product_code FROM products where store_id = $store_id";
$query = "SELECT * FROM products where store_id = $store_id";
echo $query.'<br>';
$result = mysql_query($query);

//Just incase any error occurs while renaming the folder the corresponding bnb_product_code is added into error_folder variable
$error_folder = "";
if($result)
{
		$count = mysql_num_rows($result);
		if($count == 0)
			echo 'No rows fetched :-|.<br>';
		else
		{
			echo 'Entering while loop now.<br>';
			//Loop runs for all the products in that particular store.
			while($row = mysql_fetch_array($result))
			{
			  //For Store 109,141,147
				//$pd_code = explode('_',trim($row['bnb_product_code']));
				/* $pd_code[1] = 'EGO';
				$pd_final = implode('_', $pd_code);
				$old_folder_name =  $src_base_dir.$row['store_id']. "\\" .trim($pd_final); */
				
				//Old folder name of the product in the particular store i.e., bnb_product_code.
				$old_folder_name =  $src_base_dir.$row['store_id']. "\\" .trim($row['bnb_product_code']);
				
				//New folder name of the product in the particular store i.e., product_id.
				$new_folder_name =  $src_base_dir.$row['store_id']. "\\" .$row['product_id'];
				
				if(file_exists($old_folder_name))
				{
					//Rename if File exists and return true.
					echo $old_folder_name."------>".$new_folder_name.'-';
					echo rename($old_folder_name, $new_folder_name);
					echo '<br>';
				}
				else
				{
					//If folder doesnot exist store it inside error folder.
					$error_folder[] = $old_folder_name;
					echo "Folder doesnot Exists".'<br>';
				}
			}
			echo 'Exiting while loop.<br>';
		}
}
else
{
	echo 'Some error occured while fetching data from db. Check the configurations properly<br>';
}
var_dump($error_folder);
?>