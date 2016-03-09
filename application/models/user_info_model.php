<?php

class User_info_model extends CI_Model
{

	//fetch store & owner information

	function savePersonalInfo($uid)
	{
		$aDoor = $this->input->post('check1');
		$intrestedin = "";
		$N = count($aDoor);
		for ($i = 0; $i < $N; $i++) {
			if ($intrestedin != "") {
				$intrestedin .= ",";
				$intrestedin .= (string)$aDoor[$i];
			} else {
				$intrestedin = (string)$aDoor[$i];
			}
		}
		//$bday=$this->input->post('birth_date');
		//$date=strtotime($bday);
		//$dob = date( 'Y-m-d', $date );
		$full_name = $this->input->post('person_nickname');
		$gender = $this->input->post('sex');
		$address = $this->input->post('street_address');
		$city_name = $this->input->post('cityName');
		$state = $this->input->post('stateName');
		$pin = $this->input->post('PinCode');
		$country = $this->input->post('countryName');
		$county_code = $this->input->post('country_code');
		$mob = $this->input->post('mobile_no');
		$about_me = $this->input->post('about_me');
		$taste = $this->input->post('tastes');
		$mydata = array(
			'full_name' => $full_name,
			'gender' => $gender,
			'address' => $address,
			'city' => $city_name,
			'state' => $state,
			'pin' => $pin,
			'country' => $country,
			'country_code' => $county_code,
			'mob' => $mob,
			'about_me' => $about_me,
			'interested_in' => $intrestedin,
			'taste' => $taste
		);
		log_message('Info', "User with user_id=$uid is Updating his profile details with following details.");
		log_message('Info', "$uid.full_name = $full_name.");
		log_message('Info', "$uid.gender = $gender.");
		log_message('Info', "$uid.address = $address.");
		log_message('Info', "$uid.city = $city_name.");
		log_message('Info', "$uid.state = $state.");
		log_message('Info', "$uid.pin = $pin.");
		log_message('Info', "$uid.country = $country.");
		log_message('Info', "$uid.country_code = $county_code.");
		log_message('Info', "$uid.mob = $mob.");
		log_message('Info', "$uid.about_me = $about_me.");
		log_message('Info', "$uid.interested_in = $intrestedin.");
		log_message('Info', "$uid.taste = $taste.");
		$this->db->update('user_details', $mydata, "user_id =$uid");
		redirect(base_url('user_info/user_detail/' . $uid));
	}


	function userdetails($userid)
	{
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->where('user_id', $userid);
		$result = $this->db->get();
		return $result->result();

	}

	function getRandomProducts()
	{
		$this->db->select('*,products.status as pro_status');
		$this->db->from('products');
		$this->db->join('catagories', 'catagories.category_id = products.cat_id', 'left');
		$this->db->order_by('product_id', 'RANDOM');
		$this->db->limit(12);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function addMytaste($data)
	{

		$this->load->database();
		$this->db->insert('taste', $data);

	}

	function deleteMyPrevioustaste($user_id)
	{
		$this->db->where('user_id', $user_id)
			->delete('taste');


	}

	function getLastRow()
	{

		return $this->db->insert_id();
	}

	function getMytaste($u_id)
	{
		$this->db->select('*');
		$this->db->from('taste');
		$this->db->join('products', 'taste.product_id = products.product_id', 'right');
		$this->db->where('taste.user_id', $u_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function getSimilarTasteUser($u_id, $arr)
	{

		$sqlq1 = "SELECT `user_details`.`full_name` as name ,`user_details`.`user_id` as u_id  FROM (`taste`) RIGHT JOIN `products` ON `taste`.`product_id` = `products`.`product_id` JOIN `user_details` ON `taste`.`user_id` = `user_details`.`user_id` WHERE (`taste`.`user_id` != " . $u_id . ")AND (";
		$sql2 = "";
		for ($i = 0; $i < count($arr); $i++) {
			if ($i == 0) {
				$sql2 = "`products`.`tags` LIKE  '%" . $arr[$i] . "%'";
			} else {
				$sql2 .= " OR `products`.`tags` LIKE  '%" . $arr[$i] . "%'";
			}


		}
		$sql2 .= ")";
		$sql = $sqlq1 . $sql2;
		$query = $this->db->query($sql);


		return $query->result();
	}

	function getSimilarTasteProducts($products, $arr)
	{

		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('store_info', 'products.store_id = store_info.store_id', 'right');
		$this->db->where_not_in('products.product_id', $products);
		for ($i = 0; $i < count($arr); $i++) {
			if ($i == 0)
				$this->db->where("products.tags LIKE '%{$arr[$i]}%'");
			else
				$this->db->or_where("products.tags LIKE '%{$arr[$i]}%'");
		}
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function saveaccountInfo($uid)
	{
		$aDoor = $this->input->post('check1');
		$intrestedin = "";
		$N = count($aDoor);
		for ($i = 0; $i < $N; $i++) {
			if ($intrestedin != "") {
				$intrestedin .= ",";
				$intrestedin .= (string)$aDoor[$i];
			} else {
				$intrestedin = (string)$aDoor[$i];
			}
		}
//$bday=$this->input->post('birth_date');
//$date=strtotime($bday);
//$dob = date( 'Y-m-d', $date );
		$address = $this->input->post('street_address');
		$city_name = $this->input->post('cityName');
		$state = $this->input->post('stateName');
		$pin = $this->input->post('PinCode');
		$country = $this->input->post('countryName');
		$county_code = $this->input->post('country_code');
		$mob = $this->input->post('mobile_no');
		$mydata = array(
			'address' => $address,
			'city' => $city_name,
			'state' => $state,
			'pin' => $pin,
			'country' => $country,
			'country_code' => $county_code,
			'mob' => $mob
		);
		log_message('Info', "User with user_id=$uid is Updating his profile details with following details.");
		log_message('Info', "$uid.address = $address.");
		log_message('Info', "$uid.city = $city_name.");
		log_message('Info', "$uid.state = $state.");
		log_message('Info', "$uid.pin = $pin.");
		log_message('Info', "$uid.country = $country.");
		log_message('Info', "$uid.country_code = $county_code.");
		log_message('Info', "$uid.mob = $mob.");
		$this->db->update('user_details', $mydata, "user_id =$uid");
		redirect(base_url('user_info/user_detail/' . $uid));
	}


	public function change_pswd($user_id, $new_password, $confirm_password)
	{

		$data = array(
			'password' => md5($confirm_password)
		);
		$this->db->where('user_id', $user_id);
		$this->db->update('user_details', $data);
	}
}
?>
