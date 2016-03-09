<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Comments extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
    }
    public function updateComments($ctype,$comments,$ts)
	{
        $data = array(
        				'ctype' => $ctype,
        				'comments' => $comments,
        				'ts' => $ts
        			);
        log_message("INFO", "DATA BEING RETURNED FROM(\$data) comments/updateComments IS_____".print_r($data, TRUE));
        return $this->db->insert('comments', $data);
        log_message( "INFO", "just ran the following query_____".PHP_EOL.$this->db->last_query());
	}
}
?>