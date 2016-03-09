<?php
class Poll extends CI_Controller
{
	private $userid = "";

	//private $userdetails = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->library('javascript');
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Kolkata');


	}

	public function create_poll()
	{
		include 'header_for_controller.php';
		// User Info
		$uid = $this->session->userdata('id');
		$this->load->model('user_info_model');
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		// End of User Info
		$this->load->model('poll_model');
		$this->load->model('friends_follow_model');
		$data['poll_products'] = $this->poll_model->fetch_poll_products($this->session->userdata('id'));
		$data['categories'] = $this->poll_model->fetch_categories();
		$data['friends'] = $this->friends_follow_model->get_friends($this->session->userdata('id'));
		//$data['friends']= $this->friends_follow_model->get_all_users();
		//var_dump($data['close_date']);
		// Badges
		$this->load->model('badges');
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++) {
				if ($data['user_badge'][$i]->badge_type == 1) {
					$temp = array('img' => "view/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 2) {
					$temp = array('img' => "poll/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 3) {
					$temp = array('img' => "fstore/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 4) {
					$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 5) {
					$temp = array('img' => "brag/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 6) {
					$temp = array('img' => "buy/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72) {
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73) {
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74) {
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75) {
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8) {
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9) {
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}

			}
		}

		//End of Badges
		$data['countfprod'] = count($this->morder->cfprod($this->session->userdata('id')));
		$this->load->view('create_poll', $data);
	}

	public function poll_shared()
	{
		include 'header_for_controller.php';
		$uid = $this->session->userdata('id');
		$this->load->model('user_info_model');
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$this->load->model('poll_model');
		$this->load->model('friends_follow_model');
		$data['test'][0] = $this->input->post('poll_quest');
		if ($data['test'][0] == "") $data['test'][0] = "Help me Choose";
		$data['test'][1] = $this->input->post('poll_type');
		$data['test'][2] = $this->input->post('no_of_items');
		$data['test'][3] = $this->input->post('p_id_1');
		$data['test'][4] = $this->input->post('p_id_2');
		$data['test'][5] = $this->input->post('p_id_3');
		$data['test'][6] = $this->input->post('poll_category');
		$data['close_date'] = strtotime("+" . $this->input->post('poll_close_date') . " day");
		$data['close_time'] = mdate('%H') . ":" . mdate('%i') . ":" . mdate('%s');
		$data['test'][7] = strftime("%Y-%m-%d", $data['close_date']) . " " . $data['close_time'];
		$poll_id = $this->poll_model->save_poll($this->session->userdata('id'), $data['test']);
		$friends = $this->friends_follow_model->get_friends($this->session->userdata('id'));

		//$friends= $this->friends_follow_model->get_all_users($this->session->userdata('id'));
		if ($this->input->post('check_all') == 1) $status = 1; else $status = 0;
		foreach ($friends as $items) {
			if (($this->input->post('user_' . $items['user_id']) == 1) or ($status == 1))
				$friends_shared[] = array($this->input->post('user_' . $items['user_id']), $items['user_id']);
		}

		$success = $this->poll_model->poll_friends($friends_shared, $poll_id);

		if ($success) {
			$base_url = base_url();
			$poll_owner = $data['userinfo'][0]->full_name;

			$pid = array(array(0, 0, 'Prod1'), array(0, 0, 'Prod2'), array(0, 0, 'Prod3'));
			$prod1 = (int)$this->input->post('p_id_1');
			$prod2 = (int)$this->input->post('p_id_2');
			$prod3 = (int)$this->input->post('p_id_3');

			if (!empty($prod1)) {
				$pid[0] = $this->poll_model->prod_info($prod1);
			}
			if (!empty($prod2)) {
				$pid[1] = $this->poll_model->prod_info($prod2);
			}
			if (!empty($prod3)) {
				$pid[2] = $this->poll_model->prod_info($prod3);
			}


			foreach ($friends_shared as $poll_mail) {

				$poll_receipent = $this->user_info_model->userdetails($poll_mail[1]);
				$poll_receipent_id = $poll_receipent[0]->email . ',' . $poll_receipent_id;

			}

			$poll_question = $this->input->post('poll_quest');
			if ($poll_question == "") $poll_question = "Help me Choose";
			$poll_message = '';
			include 'mail_8.php';
			//Poll Email
			$this->load->library('email');
			$this->email->from('support@buyandbrag.in', 'BuynBrag');
			$this->email->to($poll_receipent_id);
			$this->email->bcc('bnb.vitallabs@gmail.com');
			$this->email->subject("BuynBrag:New Poll started by $poll_owner");
			$this->email->message($poll_message);
			$this->email->set_newline("\r\n");
			if ($this->email->send())
				log_message('Info', "Poll mail sent successfully to $poll_receipent_id for poll id: $poll_id");
			else
				log_message('Info', "Poll mail sending failed to $poll_receipent_id for poll id: $poll_id");
		}

		if (isset($data['test']))
			header('Location: ' . base_url() . 'index.php/poll/my_polls');

	}

	function my_polls()
	{
		include 'header_for_controller.php';
		$uid = $this->session->userdata('id');
		$this->load->model('user_info_model');
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$this->load->model('poll_model');
		$this->load->model('friends_follow_model');
		$data['poll_cat'] = $this->poll_model->my_poll_categories($this->session->userdata('id'));
		$data['poll_subcat'] = $this->poll_model->my_poll_items($this->session->userdata('id'));
		$data['latest_poll'] = $this->poll_model->latest_poll($this->session->userdata('id'));
		$data['pending_polls'] = $this->poll_model->pending_polls($this->session->userdata('id'));
		if (count($data['latest_poll']) == 1) {
			$data['votes_1'] = $this->poll_model->poll_votes($data['latest_poll'][0]->poll_id, 1);
			$data['votes_2'] = $this->poll_model->poll_votes($data['latest_poll'][0]->poll_id, 2);
			$data['votes_3'] = $this->poll_model->poll_votes($data['latest_poll'][0]->poll_id, 3);
			$data['votes_9'] = $this->poll_model->poll_votes($data['latest_poll'][0]->poll_id, 9);
			if ($data['latest_poll'][0]->product_id_1 > 0)
				$data['latest_prod1'] = $this->poll_model->poll_products($data['latest_poll'][0]->product_id_1);
			if ($data['latest_poll'][0]->product_id_2 > 0)
				$data['latest_prod2'] = $this->poll_model->poll_products($data['latest_poll'][0]->product_id_2);
			if ($data['latest_poll'][0]->product_id_3 > 0)
				$data['latest_prod3'] = $this->poll_model->poll_products($data['latest_poll'][0]->product_id_3);
		}
		//else header('Location: '.base_url().'index.php/poll/create_poll');
		//var_dump($data['pending_polls']);
		//badge popup

		$data['countfprod'] = count($this->morder->cfprod($this->session->userdata('id')));
		// Badges
		$this->load->model('badges');
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++) {
				if ($data['user_badge'][$i]->badge_type == 1) {
					$temp = array('img' => "view/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 2) {
					$temp = array('img' => "poll/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 3) {
					$temp = array('img' => "fstore/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 4) {
					$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 5) {
					$temp = array('img' => "brag/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 6) {
					$temp = array('img' => "buy/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72) {
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73) {
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74) {
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75) {
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8) {
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9) {
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}

			}
		}

		//End of Badges
		$this->load->view('poll', $data);
	}

	function vote($poll_id = 0)
	{
		include 'header_for_controller.php';
		$this->load->model('poll_model');
		$uid = $this->session->userdata('id');
		$this->load->model('user_info_model');
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$this->load->model('friends_follow_model');
		$data['poll_cat'] = $this->poll_model->my_poll_categories($this->session->userdata('id'));
		$data['poll_subcat'] = $this->poll_model->my_poll_items($this->session->userdata('id'));
		$data['pending_polls'] = $this->poll_model->pending_polls($this->session->userdata('id'));

		$status = $this->poll_model->vote_status($poll_id, $this->session->userdata('id'));

		if (count($status) > 0) {
			$data['this_poll'] = $this->poll_model->poll_details($poll_id);

			if ($data['this_poll'][0]->product_id_1 > 0) {
				$data['poll_prod1'] = $this->poll_model->poll_products($data['this_poll'][0]->product_id_1);
				$data['votes1'] = $this->poll_model->poll_votes($poll_id, 1);
				$data['votes9'] = $this->poll_model->poll_votes($poll_id, 9);
			}
			if ($data['this_poll'][0]->no_of_items > 1) {
				$data['poll_prod2'] = $this->poll_model->poll_products($data['this_poll'][0]->product_id_2);
				$data['votes2'] = $this->poll_model->poll_votes($poll_id, 2);
			}
			if ($data['this_poll'][0]->no_of_items > 2) {
				$data['poll_prod3'] = $this->poll_model->poll_products($data['this_poll'][0]->product_id_3);
				$data['votes3'] = $this->poll_model->poll_votes($poll_id, 3);
			}
		} else {
			header('Location: ' . base_url() . 'index.php/poll/my_polls');
		}
		//var_dump($data['temp']);
		// Badges
		$this->load->model('badges');
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++) {
				if ($data['user_badge'][$i]->badge_type == 1) {
					$temp = array('img' => "view/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 2) {
					$temp = array('img' => "poll/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 3) {
					$temp = array('img' => "fstore/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 4) {
					$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 5) {
					$temp = array('img' => "brag/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 6) {
					$temp = array('img' => "buy/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72) {
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73) {
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74) {
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75) {
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8) {
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9) {
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}

			}
		}

		//End of Badges
		$data['countfprod'] = count($this->morder->cfprod($this->session->userdata('id')));
		$this->load->view('poll_friend', $data);

	}

	public function poll_page()
	{
		include 'header_for_controller.php';
		$this->load->model('poll_model');

		$uid = $this->session->userdata('id');

		$latest_poll = $this->poll_model->latest_poll($uid);
		if (count($latest_poll) == 1) $p1 = 1; else $p1 = 0;

		$pending_polls = $this->poll_model->pending_polls($uid);
		if (count($pending_polls) > 0) $p2 = 1; else $p2 = 0;

		if ($p1 == 0 and $p2 == 0)
			header('Location: ' . base_url() . 'index.php/poll/create_poll');
		elseif ($p1 == 0 and $p2 == 1) {
			$poll_id = $pending_polls[0]->poll_id;
			header('Location: ' . base_url() . 'index.php/poll/vote/' . $poll_id);
		} else
			header('Location: ' . base_url() . 'index.php/poll/my_polls');
	}


}


?>
