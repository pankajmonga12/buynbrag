<?php if( ! defined ( 'BASEPATH' ) ) exit('403 Unauthorized');

class Enabledisable extends CI_Controller
{
	public $baseURL = NULL;
	public function __construct()
	{
		parent::__construct();
		$this->baseURL = base_url();
	}

	public function index()
	{
		?>
		<!DOCTYPE html>
		<html><head><title>BNB Enable / Disable dashboard </title>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script type="text/javascript">
		function changePassword() 
		{
		    var x = document.getElementById("userFilter");
	        var userFilter = x.value;
	        if (userFilter=='emailID') 
	        {
				var x = document.getElementById("idFilter");
				var emailID = x.value;
				var pass = document.getElementById("password");
				var password = pass.value;
				atpos = emailID.indexOf("@");
			    dotpos = emailID.lastIndexOf(".");
				if (atpos < 1 || ( dotpos - atpos < 2 )) 
				{
				alert("Please enter correct email ID");
				return false;
				}
				 else if( password==null || password=='')
                {
                 alert("Please enter password");
                 return false;
                }
				else
			   {
						console.log(emailID);
						console.log(password);
		                $.ajax
		                      ({
		                          url: "<?php echo $this->baseURL; ?>index.php/enabledisable/userPassChangebyemailID",
		                          data: {ID:encodeURIComponent(emailID),password:password},
		                          type: 'GET',
		                         success :   function(data){
		                         	$('#infoPara').html(data.info);
		                         }
		                       });
		    }

		}
            else if (userFilter=='userID')
            {
             	var y = document.getElementById("idFilter");
                var userID = y.value;
                var passchange = document.getElementById("password");
				var password = passchange.value;
                  
	            if ( userID==null || userID=='' ) 
	            {
                 alert("Please enter userID");
                 return false;
	            }
                 else if( password==null || password=='')
                {
                 alert("Please enter password");
                 return false;

                }
               else {
							console.log(emailID);
			                $.ajax
			                      ({
			                          url: "<?php echo $this->baseURL; ?>index.php/enabledisable/userPassChangebyuserID",
			                          data: {ID:userID,password:password},
			                          type: 'POST',
			                         success :   function(data){
			                         	$('#infoPara').html(data.info);
			                         }
			                       });
					}
             }
        }
             </script></head><body>
		<p><button onCLick="window.close(); return true;">CRM Home</button>
		<p><b><u>PLEASE NOTE:</u></b><i>Enter multiple IDs separated by commas</i></p>
		<p id="infoPara" style="background-color:beige;font-family:sans-serif"><?php if ( $this->session->userdata("CRM_ED_INFO_STR") !== FALSE ) {echo $this->session->userdata("CRM_ED_INFO_STR"); $this->session->unset_userdata("CRM_ED_INFO_STR");} ?></p>
		<p>Enable Store(s)</p>
		<p>
			<form action="<?php echo $this->baseURL; ?>index.php/enabledisable/storeEnable" method="POST">
			Store IDs <input type="text" name="IDs"><input type="submit" value="Enable">
			</form>
		</p>
		<p>Disable Store(s)</p>
		<p>
			<form action="<?php echo $this->baseURL; ?>index.php/enabledisable/storeDisable" method="POST">
			Store IDs <input type="text" name="IDs"><input type="submit" value="Disable">
			</form>
		</p>
		<p>Enable Product(s)</p>
		<p>
			<form action="<?php echo $this->baseURL; ?>index.php/enabledisable/productEnable" method="POST">
			Product IDs <input type="text" name="IDs"><input type="submit" value="Enable">
			</form>
		</p>
		<p>Disable Product(s)</p>
		<p>
			<form action="<?php echo $this->baseURL; ?>index.php/enabledisable/productDisable" method="POST">
			Product IDs <input type="text" name="IDs"><input type="submit" value="Disable">
			</form>
		</p>
		<p>User's Password Change</p>
		<div>
		    <select id="userFilter">
			<option value="emailID">Email ID</option>
			<option value="userID">UserID</option>
	        </select>
		    <input type="text"  name="email-userID" id="idFilter">
		    <input type="password" name="password" id="password" placeholder="Enter New Password">
		    <input type="submit" value="Change Password" onclick="changePassword()">
		</div>
		</body></html>
		<?php
	}
    
	public function storeEnable()
	{
		$ids = ( $this->input->post("IDs") !== FALSE && strcmp($this->input->post("IDs"), "") !== 0) ? $this->input->post("IDs"): NULL;
		log_message( 'DEBUG', "IDS = ".$ids );

		$ids = explode(",", $ids);
		log_message( 'DEBUG', "after explosion, IDS = \r\n".print_r( $ids, TRUE ) );
		
		foreach ($ids as $key => $value) // loop to trim all the white-spaces from values
		{
			$ids[$key] = trim( $value );
		}

		log_message('DEBUG', "after explosion and then trimming IDS = \r\n".print_r( $ids, TRUE ) );
		$infoStr = NULL;

		if( count($ids) > 0 )
		{
			$q1SQL = "UPDATE `store_info` SET `isPublished` = 1 WHERE `store_id` IN (".implode(",", $ids).")";
			$q1 = $this->db->query( $q1SQL );
			$t[] = $this->db->affected_rows();

			$q2SQL = "UPDATE `products` SET `status` = 1, `is_enable` = 0 WHERE `store_id` IN (".implode(",", $ids).")";
			$q2 = $this->db->query( $q2SQL );
			$t[] = $this->db->affected_rows();			

			$q3SQL = "UPDATE `productsNew` SET `status` = 1, `is_enable` = 0 WHERE `store_id` IN (".implode(",", $ids).")";
			$q3 = $this->db->query( $q3SQL );
			$t[] = $this->db->affected_rows();

			$infoStr = "<i>".$t[1]." products</i> enabled in <i>products</i> table<br/><i>".$t[2]." products</i> in <i>productsNew</i><br/><i>".$t[0]." stores</i> enabled!";
		}
		else
		{
			$infoStr = "<b style=\"color:red\">Invalid IDs provided</b>";
		}

		$this->session->set_userdata( 'CRM_ED_INFO_STR', $infoStr );
		$this->index();
	}

	public function storeDisable()
	{
		$ids = ( $this->input->post("IDs") !== FALSE && strcmp($this->input->post("IDs"), "") !== 0) ? $this->input->post("IDs"): NULL;
		log_message( 'DEBUG', "IDS = ".$ids );

		$ids = explode(",", $ids);
		log_message( 'DEBUG', "after explosion, IDS = \r\n".print_r( $ids, TRUE ) );
		
		foreach ($ids as $key => $value) // loop to trim all the white-spaces from values
		{
			$ids[$key] = trim( $value );
		}

		log_message('DEBUG', "after explosion and then trimming IDS = \r\n".print_r( $ids, TRUE ) );
		$infoStr = NULL;

		if( count($ids) > 0 )
		{
			$q1SQL = "UPDATE `store_info` SET `isPublished` = 0 WHERE `store_id` IN (".implode(",", $ids).")";
			$q1 = $this->db->query( $q1SQL );
			$t[] = $this->db->affected_rows();

			$q2SQL = "UPDATE `products` SET `status` = 0, `is_enable` = 1 WHERE `store_id` IN (".implode(",", $ids).")";
			$q2 = $this->db->query( $q2SQL );
			$t[] = $this->db->affected_rows();			

			$q3SQL = "UPDATE `productsNew` SET `status` = 0, `is_enable` = 1 WHERE `store_id` IN (".implode(",", $ids).")";
			$q3 = $this->db->query( $q3SQL );
			$t[] = $this->db->affected_rows();

			$infoStr = "<i>".$t[1]." products</i> disabled in <i>products</i> table<br/><i>".$t[2]." products</i> in <i>productsNew</i><br/><i>".$t[0]." stores</i> disabled!";
		}
		else
		{
			$infoStr = "<b style=\"color:red\">Invalid IDs provided</b>";
		}

		$this->session->set_userdata( 'CRM_ED_INFO_STR', $infoStr );
		$this->index();
	}

	public function productEnable()
	{
		$ids = ( $this->input->post("IDs") !== FALSE && strcmp($this->input->post("IDs"), "") !== 0) ? $this->input->post("IDs"): NULL;
		log_message( 'DEBUG', "IDS = ".$ids );

		$ids = explode(",", $ids);
		log_message( 'DEBUG', "after explosion, IDS = \r\n".print_r( $ids, TRUE ) );
		
		foreach ($ids as $key => $value) // loop to trim all the white-spaces from values
		{
			$ids[$key] = trim( $value );
		}

		log_message('DEBUG', "after explosion and then trimming IDS = \r\n".print_r( $ids, TRUE ) );
		$infoStr = NULL;

		if( count($ids) > 0 )
		{
			$q2SQL = "UPDATE `products` SET `status` = 1, `is_enable` = 0 WHERE `product_id` IN (".implode(",", $ids).")";
			$q2 = $this->db->query( $q2SQL );
			$t[] = $this->db->affected_rows();			

			$q3SQL = "UPDATE `productsNew` SET `status` = 1, `is_enable` = 0 WHERE `product_id` IN (".implode(",", $ids).")";
			$q3 = $this->db->query( $q3SQL );
			$t[] = $this->db->affected_rows();

			$infoStr = "<i>".$t[0]." products</i> enabled in <i>products</i> table<br/><i>".$t[1]." products</i> in <i>productsNew</i><br/>";
		}
		else
		{
			$infoStr = "<b style=\"color:red\">Invalid IDs provided</b>";
		}

		$this->session->set_userdata( 'CRM_ED_INFO_STR', $infoStr );
		$this->index();
	}

	public function productDisable()
	{
		$ids = ( $this->input->post("IDs") !== FALSE && strcmp($this->input->post("IDs"), "") !== 0) ? $this->input->post("IDs"): NULL;
		log_message( 'DEBUG', "IDS = ".$ids );

		$ids = explode(",", $ids);
		log_message( 'DEBUG', "after explosion, IDS = \r\n".print_r( $ids, TRUE ) );
		
		foreach ($ids as $key => $value) // loop to trim all the white-spaces from values
		{
			$ids[$key] = trim( $value );
		}

		log_message('DEBUG', "after explosion and then trimming IDS = \r\n".print_r( $ids, TRUE ) );
		$infoStr = NULL;

		if( count($ids) > 0 )
		{
			$q2SQL = "UPDATE `products` SET `status` = 0, `is_enable` = 1 WHERE `product_id` IN (".implode(",", $ids).")";
			$q2 = $this->db->query( $q2SQL );
			$t[] = $this->db->affected_rows();			

			$q3SQL = "UPDATE `productsNew` SET `status` = 0, `is_enable` = 1 WHERE `product_id` IN (".implode(",", $ids).")";
			$q3 = $this->db->query( $q3SQL );
			$t[] = $this->db->affected_rows();

			$infoStr = "<i>".$t[0]." products</i> disabled in <i>products</i> table<br/><i>".$t[1]." products</i> in <i>productsNew</i><br/>";
		}
		else
		{
			$infoStr = "<b style=\"color:red\">Invalid IDs provided</b>";
		}

		$this->session->set_userdata( 'CRM_ED_INFO_STR', $infoStr );
		$this->index();
	}
	public function userPassChangebyemailID()
	{
		$emailID = ( $this->input->get("ID") !== FALSE) ? urldecode( $this->input->get("ID") ): NULL;
		
        $password = ( $this->input->get("password") !== FALSE && strcmp( $this->input->get("password"), "" ) !== 0 ) ? urldecode( $this->input->get("password") ): NULL;
        
        if ( !$emailID == NULL && !$password == NULL ) 
        {
        	$qSQL = "UPDATE `user_details` SET `password` = MD5( '".$password."' )  WHERE `email` = '".$emailID."'";
        	$q = $this->db->query( $qSQL );
        	$infoStr = "New password set to <i>".$password."</i> for user with email <i>".$emailID."</i>";
        }
        else
		{
			$infoStr = "<b style=\"color:red\">Invalid email provided</b>";
		}
        
        $this->session->set_userdata( 'CRM_ED_INFO_STR', $infoStr );
		//$this->index();
		$this->output->set_content_type('application/json');
		$this->output->set_output( json_encode( array( 'info' => $infoStr ) ) );
    }

	public function userPassChangebyuserID()
	{
		$userID = ( $this->input->post("ID") !== FALSE ) ? urldecode( $this->input->post("ID") ): NULL;
		
		$password = ( $this->input->get("password") !== FALSE && strcmp( $this->input->get("password"), "" ) !== 0 ) ? urldecode( $this->input->get("password") ): NULL;
		
		if ( !$userID == NULL && !$password == NULL ) 
		{
        	$qSQL = "UPDATE `user_details` SET `password` = MD5( '".$password."' )  WHERE `user_id` = ".$userID;
        	$q = $this->db->query( $qSQL );
        	$infoStr = "New Password set to <i>".$password."</i> for user with ID <i>".$userID."</i>";
        }
        else
		{
			$infoStr = "<b style=\"color:red\">Invalid userID provided</b>";
		}
        
        $this->session->set_userdata( 'CRM_ED_INFO_STR', $infoStr );
		//$this->index();
		$this->output->set_content_type('application/json');
		$this->output->set_output( json_encode( array( 'info' => $infoStr ) ) );
	}
}
?>