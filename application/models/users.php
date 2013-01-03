<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {

	function __construct(){
		parent::__construct();

	}	

	public function check_users($username, $password)
	{
		$q = $this->db
			->where('username', $username)
			->where('password', sha1($password))
			->get('users');
		
		if($q->num_rows > 0)
		{
			return $q->row();
		}
		else
		{
			return FALSE;
		}
		
			
	}

	public function check_session()
	{
		$username = $this->session->userdata('username');

		if(isset($username))
		{
			return TRUE;
		}
	}

	public function add_user($name, $username, $password, $email)
	{
		$data = array(
			'name' => $name,
			'username' => $username,
			'password' => $password,
			'email' => $email			
			);

		$query = $this->db->insert('users', $data);
	}

	public function delete_user($id)
	{
		$this->db->delete('users', array('id' => $id));
	}

	public function update_user()
	{
		// Update a User
	}

	public function retrieve_password($name, $email)
	{
		$data = array(
			'name' => $name,
			'email' => $email
			);

		$query = $this->db->select('password')->where($data)->get('users');
		if($query->num_rows() > 0)
		{
			$retrieved = $query->row();
			return $retrieved->password;
		}
	}

	public function users_email($username)
	{
		$query = $this->db
				->select('email')
				->where('username', $username)
				->get('users');

		if($query->num_rows > 0){
			$retrieved = $query->row(); 
			return $retrieved->email;
		}
	}

	public function users_name($username)
	{
		$query = $this->db
				->select('name')
				->where('username', $username)
				->get('users');

		if($query->num_rows > 0){
			$retrieved = $query->row(); 
			return $retrieved->name;
		}
	}

}