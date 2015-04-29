<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		$this->load->model('Friend');
		$this->load->library("form_validation");
	}

	public function index()
	{
		$this->session->unset_userdata('id');
		$this->load->view('login');
	}
	public function main($id = NULL)
	{
		if($id == NULL)
		{
			$id = $this->session->userdata['id'];
		}
		$user_data['user'] = $this->Friend->get_user_by_id($id);
		$user_data['friends'] = $this->Friend->get_friends($id);
		$user_data['all'] = $this->Friend->not_friends($id);
		if($user_data['friends']){	
			$not_friends = "";
			$new = array();
			foreach($user_data['friends'] as $friends)
			{
				$not_friends = $friends['id'];
				echo"friends";
				var_dump($friends);
				foreach($user_data['all'] as $all) 
				{
					echo "all";
					var_dump($all);
					if($all['ID'] !== $not_friends)
					{
						$nf = $all['ID'];
						if(!in_array($nf, $new))
						{
							$new[] =$nf;
						}
						elseif($key = array_search($nf, $new) !== false) 
						{
    						unset($new[$key]);

						}

					}
					echo "new";
					var_dump($new);
					
				}
				
			}	
			

			foreach($new as $user)
			{
				$id = $user;
				$user_data['not'][] = $this->Friend->get_user_by_id($id);
			}	
			
		}
		else
		{
			$user_data['not'] = $this->Friend->all_users($id);
		}	
		$this->load->view('display_friends', $user_data);
	}
	public function add_friend($id)
	{
		$data['user_id'] = $id;
		$data['friend_id'] = $this->input->post('friend_id');
		$this->Friend->add_friend($data);
		$data2['user_id'] = $this->input->post('friend_id');
		$data2['friend_id'] = $id;
		$this->Friend->add_friend($data2);
		redirect('/friends/main');
	}
	public function delete_friend($id)
	{
		$data['user_id'] = $this->session->userdata['id'];
		$data['friend_id'] = $id;
		$this->Friend->delete_friend($data);
		$data2['user_id'] = $id;
		$data2['friend_id'] = $this->session->userdata['id'];
		$this->Friend->delete_friend($data2);
		redirect('/friends/main');
	}
	public function profile($id)
	{
		$user['user'] = $this->Friend->get_user_by_id($id);
		$this->load->view('view_profile', $user);
		// redirect('/friends/main');
	}
	public function login()
	{
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$login_user['user'] = $this->Friend->check($data);
		if(empty($data['email'] || $data['password']))
		{
			$error['errors'] = "You're user name or password cannot be empty!!!";	
			$this->load->view('register', $error);
		}
		elseif(empty($login_user['user']))
		{
			$error['errors'] = "User not found!!!";	
			$this->load->view('login', $error);
		}	
		elseif($login_user['user']['email'] == $data['email'] && $login_user['user']['password'] == $data['password'])
		{	
			$user_id = $login_user['user']['ID'];
			$this->session->set_userdata('id', $user_id);
			redirect('/friends/main');
		}
		else
		{
			$error['errors'] = "You're user name and password do not match!!!";	
		}
		
	}
	public function registration()
	{
		$data['name'] = $this->input->post('name');
		$data['alias'] = $this->input->post('alias');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['confirm'] = $this->input->post('confirm');
		$data['birthdate'] = $this->input->post('birthdae');
		$this->form_validation->set_rules("name", "Name", "trim|required");
		$this->form_validation->set_rules("alias", "Alias", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required|is_unique[users.email]|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm", "Confirm Password", "trim|required|min_length[8]|matches[password]");
		$this->form_validation->set_rules("birthdate", "Birthdate", "trim|required");
		
		if($this->form_validation->run())
		{
		    $new_user = $this->Friend->add($data);
		    $login_user['user'] = $this->Friend->check($data);
		    $user_id = $login_user['user']['ID'];
			$this->session->set_userdata('id', $user_id);
			redirect('friends/main');
		}
		else
		{

		    $view_data["errors"] = validation_errors();
		    $this->load->view('login', $view_data);
		}
	}

}
//end of main controller