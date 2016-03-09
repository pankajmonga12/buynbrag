<?php

class contest extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}


	/*public function contest_view()
	{
		include 'header_for_controller.php';
		$this->load->view('contest');
	}*/
	public function index()
	{
		include_once('header_for_controller.php');
		$this->load->view('calendar', $data);
	}

	public function christmas($date)
	{
		include_once('header_for_controller.php');
		$this->load->model('morder');
		$this->load->model('contestdb');
		$this->load->model('brag');
		$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
		$uid = $this->session->userdata('id');
		$data['base_url'] = base_url();
		$data['date'] = $date;
		$data['fprod'] = $this->contestdb->christmas_prod($date);
		//Fancy - Ananth
		$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
		//var_dump($fancy);
		$fancy_array = array();
		$i = 0;
		foreach ($fancy as $key => $val) {
			foreach ($val as $key => $prod_id) {
				//var_dump ($prod_id);
				$fancy_array[$i] = $prod_id;
				$i++;
			}
		}
		$fancied = array_unique($fancy_array);
		$fancied_prods = array_merge($fancied);
		foreach ($fancied_prods as $f_item) {
			$data['fancied_prods'][$f_item] = 1;
		}
		// END Fancy
		// INVITE FRIEND
		$this->load->model('contestdb');
		$invited = $this->contestdb->invitedFriends();
		if ($invited == '0')
			$exludedIds = '0';
		else {
			for ($i = 0; $i < count($invited); $i++) {
				$friendsUid[$i] = $invited[$i]['fb_uid'];
			}
			$exludedIds = implode(',', $friendsUid);
		}
		$data['exludedIds'] = $exludedIds;
		// END INVITE
		//Brag - Vignesh
		$user_bragged = $this->brag->user_brag_product($this->session->userdata('id'));
		for ($i = 0; $i < count($user_bragged); $i++) {
			$bragged[] = $user_bragged[$i]->product_id;
			$data['bragged_prods'][$user_bragged[$i]->product_id] = 1;
		}
		if (empty($bragged))
			$bragged = array();
		// END Brag - Vignesh

		//GAME RULE
		$contest_fancy_list = $this->contestdb->christmas_fancy($date);
		for ($i = 0; $i < count($contest_fancy_list); $i++)
			$contest_fancy[] = $contest_fancy_list[$i]->contest_fancy_product;

		$contest_brag_list = $this->contestdb->christmas_brag($date);
		for ($i = 0; $i < count($contest_brag_list); $i++)
			$contest_brag[] = $contest_brag_list[$i]->contest_brag_product;

		$contest_invite_list = $this->contestdb->christmas_invite($this->session->userdata('id'), $date);
		$data['fancy_game'] = array_diff($contest_fancy, $fancied);
		$data['brag_game'] = array_diff($contest_brag, $bragged);
		$data['invite_game'] = 10 - (int)$contest_invite_list[0]->invite;
		if (count($data['fancy_game']) < 1 && count($data['brag_game']) < 1 && $data['invite_game'] < 1) {
			$data['result'] = 1;
			$is_exist = $this->contestdb->is_christmas_winner();
			if ($is_exist == 0)
				$this->contestdb->christmas_winner();
		} else
			$data['result'] = 0;
		$this->load->model('contestdb');
		$invited = $this->contestdb->invitedFriends();
		if ($invited == '0')
			$exludedIds = '0';
		else {
			for ($i = 0; $i < count($invited); $i++) {
				$friendsUid[$i] = $invited[$i]['fb_uid'];
			}
			$exludedIds = implode(',', $friendsUid);
		}
		$data['exludedIds'] = $exludedIds;
//        echo count($data['brag_game']);
		$this->load->view('contest4', $data);
	}

	public function updateInvitedFriends()
	{
		$to = $this->input->get('to');
		$date = $this->input->get('date');
		$return = '';
		$this->load->model('contestdb');
		$toArray = explode(',', $to);
		foreach ($toArray as $fbUid) {
			$return = $this->contestdb->updateInvitedFriends($fbUid, $date);
		}
		echo $return;
	}

	public function badge_status($date)
	{
		$this->load->model('contestdb');
		$contest_fancy_list = $this->contestdb->christmas_fancy($date);
		for ($i = 0; $i < count($contest_fancy_list); $i++)
			$contest_fancy[] = $contest_fancy_list[$i]->contest_fancy_product;
		$contest_brag_list = $this->contestdb->christmas_brag($date);
		for ($i = 0; $i < count($contest_brag_list); $i++)
			$contest_brag[] = $contest_brag_list[$i]->contest_brag_product;
		$contest_invite_list = $this->contestdb->christmas_invite($this->session->userdata('id'), $date);
		$contest_fancy_result = count($this->contestdb->ajaxfancy($contest_fancy, $this->session->userdata('id')));
		$contest_brag_result = count($this->contestdb->ajaxbrag($contest_brag, $this->session->userdata('id')));
		$contest_invite_result = $contest_invite_list[0]->invite;
		if ($contest_fancy_result >= 5)
			$fancy_result = 1;
		else
			$fancy_result = 0;
		if ($contest_brag_result >= 5)
			$brag_result = 1;
		else
			$brag_result = 0;
		if ($contest_invite_result >= 10)
			$invite_result = 1;
		else
			$invite_result = 0;
		echo $fancy_result . '|' . $brag_result . '|' . $invite_result;

	}

}?>
