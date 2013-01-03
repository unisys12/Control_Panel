<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validate extends CI_Model{

	function __construct(){
		parent::__construct();

		$this->load->library('form_validation');

	}

	public function registration()
	{
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required|min_length[5]|max_length[25]|xss_clean');

		$this->form_validation->set_rules('username', 'username', 
											'trim|required|min_length[5]|max_length[25]|xss_clean');

		$this->form_validation->set_rules('password', 'password', 
											'trim|required|min_length[5]|max_length[12]|matches[password_conf]|xss_clean|sha1');

		$this->form_validation->set_rules('password_conf', 'password_conf', 
											'trim|required|min_length[5]|max_length[25]|xss_clean|sha1');

		$this->form_validation->set_rules('email', 'email', 
											'trim|required|min_length[5]|max_length[35]|valid_email|xss_clean');
		
		$this->form_validation->run();

	}

}