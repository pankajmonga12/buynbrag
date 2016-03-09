<?php

$firstname = $this->input->post('firstname');
$lastname = $this->input->post('lastname');
$address1 = $this->input->post('address1');
$city = $this->input->post('city');
$state = $this->input->post('state');
$country = $this->input->post('country');
$address11 = $this->input->post('address11');
$city1 = $this->input->post('city1');
$state1 = $this->input->post('state1');
$country1 = $this->input->post('country1');
$zipcode = $this->input->post('zipcode');
$mob_country_code = $this->input->post('mob_country_code');
$phone = $this->input->post('phone');
$email = $this->input->post('email');
$amount = $this->input->post('amount');
$tax = $this->input->post('tax');

$tmp_xtemp = array
			(
				'amount' => $amount,
				'tax' => $tax,
				'firstname' => $firstname,
				'lastname' => $lastname,
				'address1' => $address1,
				'city' => $city,
				'state' => $state,
				'country' => $country,
				'zipcode' => $zipcode,
				'mob_country_code' => $mob_country_code,
				'phone' => $phone,
				'email' => $email
			);
$data = array_merge( $data, $tmp_xtemp );

?>
