<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->library(array('parser'));

	}

	/**
	 * Index Page for this controller
	 */
	public function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('username', 'Username:',
											'trim|required|min_length[5]|max_length[25]');

		$this->form_validation->set_rules('password', 'Password:',
											'trim|required|min_length[5]|max_length[42]');

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$valid_session = $this->users->check_session($username);

		$data = array(
			'title' => 'Rayco Administration Panel',
			'name' => '',
			'css' => base_url('css/style.css')
			);

		if($this->form_validation->run() == FALSE || $valid_session == FALSE)
		{
			$this->load->view('includes/head', $data);
			$this->load->view('admin/login_view', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			$email = $this->users->users_email($username);
			$session = array(
			'username' => $username,
			'email' => $email
			);
			$this->session->set_userdata($session);

			$cookie = array(
				'name' => 'Rayco_Supper_Chocalote_Chip',
				'value' => $this->input->post('username'),
				'expire' => '720000',
				'domain' => 'raycocopiers.com',
				'path' => '/',
				'prefix' => 'Rayco_',
				'secure' => TRUE
				);

			$this->input->set_cookie($cookie);

			$this->home_panel();
		}
	}

	public function home_panel()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->users->users_email($username);
		$valid_user = $this->users->check_users($username, $password);
		$valid_session = $this->users->check_session($username);

		$data = array(
			'title' => 'Rayco Administration Panel for ',
			'name' => $this->users->users_name($username),
			'css' => base_url('css/style.css'),
			'message' => 'The username and password you entered is invaild!',
			'instructions' => "The username you enter was " . $username . '<br>' . 'and the password was ' . $password .'.'
			);

		if($valid_user == TRUE || $valid_session == TRUE)
		{
		 	{
				$this->load->view('includes/head', $data);
				$this->load->view('includes/header');
				$this->load->view('admin/admin_view', $data);
				$this->load->view('includes/footer');
			}
		}
		else
		{
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->parser->parse('templates/user_confirmation', $data);
			$this->load->view('includes/footer');
		}
	}

	/**
	 * Registration Page for the site
	 */
	public function register()
	{
		$data = array(
			'title' => 'Registration',
			'css' => base_url('css/style.css')
			);

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('name', 'Full Name:', 'trim|required|min_length[5]|max_length[25]|xss_clean');

		$this->form_validation->set_rules('username', 'Username:',
											'trim|required|min_length[5]|max_length[25]|xss_clean');

		$this->form_validation->set_rules('password', 'Password:',
											'trim|required|min_length[5]|max_length[42]|matches[password_conf]|sha1');

		$this->form_validation->set_rules('password_conf', 'Confirm Password:',
											'trim|required|min_length[5]|max_length[42]|sha1');

		$this->form_validation->set_rules('email', 'Email:',
											'trim|required|min_length[5]|max_length[35]|valid_email|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->load->view('admin/register');
			$this->load->view('includes/footer');
		}
		else
		{
			$this->registered();
		}
	}

	/**
	 * Registration Confirmation
	 */
	public function registered()
	{
		$data = array(
			'title' => 'Welcome Aboard!',
			'css' => base_url('css/style.css'),
			'message' => 'Thanks for registering',
			'instructions' => 'Your username and password will be sent to you, but you can login right now and get started!'
			);

		$name = $this->input->post('name');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');

		$add_user = $this->users->add_user($name, $username, $password, $email);

		if($add_user == TRUE){
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->parser->parse('templates/user_confirmation', $data);
			$this->load->view('includes/footer');
		}else{
			$this->register();
		}

	}

	/**
	 * Fetch users password
	 */
	public function fetch()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('name', 'What is your name:', 'trim|required|min_length[5]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('email', 'What is your E-Mail:',
											'trim|required|min_length[5]|max_length[35]|valid_email|xss_clean');

		$data = array(
			'title' => 'Retrieve Password',
			'css' => base_url('css/style.css'),
			);

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->load->view('admin/fetch');
			$this->load->view('includes/footer');
		}
		else
		{
			$this->fetched();
		}

	}

	/**
	 * Retrieve password to user
	 */
	public function fetched()
	{

		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->users->retrieve_password($name, $email);

		$data = array(
			'css' => base_url('css/style.css'),
			'title' => 'Password Retrieved',
			'message' => 'Your password was retrieved!',
			//'instructions' => 'Check your email, get your password and try logging in again',
			'instructions' => 'Name: ' . $name . '<br>' . 'Email: ' . $email . '<br>' . 'Password: ' . $password
			);

		$this->load->view('includes/head', $data);
		$this->load->view('includes/header');
		$this->parser->parse('templates/user_confirmation', $data);
		$this->load->view('includes/footer');
	}

	/**
	 * Working on this. I get an error stating that the user as to log in first.
	 *
	 */
	public function email_password()
	{
		$this->load->library('email');

		$body = array(
			'message' => 'Your password was retrieved!',
			'instructions' => $name . '<br>' . $email . '<br>' . $password
			);

		$message = $this->parser->parse('templates/user_confirmation', $body);

		$this->email->from('admin@raycocopiers.com', 'Rayco Employee Control Panel');
		$this->email->to($email);
		$this->email->subject('Password Request');
		$this->email->message($message);
		$this->email->send();
		$this->email->print_debugger();

	}

	public function logout()
	{
		$this->session->sess_destroy();

		$data = array(
			'css' => base_url('css/style.css'),
			'title' => 'Logged Out of Rayco Admin Panel',
			'message' => 'You have logged out!',
			//'instructions' => 'Check your email, get your password and try logging in again',
			'instructions' => 'Thank you and come again!'
			);

		$this->index();
	}
/**
 * End of File
 */
}