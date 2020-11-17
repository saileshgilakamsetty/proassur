<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
    	parent::__construct();
    	$this->load->model('login_model'); 
    	$this->load->model('front_model'); 
    	$this->load->helper('front_helper');
	}
    
    public $users='tbl_users';


	public function index()	{
		$data['active']     = 'login';
		$user_id            = $this->session->userdata('user_id');
		if(!empty($user_id)) {
			redirect('dashboard','refresh');
		}
		else {   
			$login_arr           = $this->input->post();
			if(!empty($login_arr)) {				
                $isactive        = $this->login_model->IsUserActive();
				if($isactive) {			
					$admindata   = $this->login_model->AdminLogin();
					if($admindata) {
						redirect('dashboard','refresh');
					} else {
						$this->session->set_flashdata('error',getStaticContent('LOGIN_ERROR_MESSAGE'));
						redirect('/','refresh');
					}
				} 
				else {
					$this->session->set_flashdata('error',getStaticContent('LOGIN_DISABLE_MESSAGE'));
					redirect('/','refresh');
				}
			}
		}
		$this->load->view('front/include/head');
		$this->load->view('front/login');
		$this->load->view('front/include/foot');
	}

	public function my_account(){
		CheckLoginSession();
		$user_id                = $this->session->userdata('user_id');
		$data['ourWinners']     = $this->front_model->getLatestWinnersCollection($this->websites,3);
		$data['dataCollection'] = $this->website_model->getDataCollectionByID($this->users,$user_id);
		$data['myProjects']     = $this->website_model->getRecentDataCollection($this->websites,$user_id,3);

		$this->load->view('front/include/head',$data);
		$this->load->view('front/include/header_home',$data);
		$this->load->view('front/users/my-account',$data);
		$this->load->view('front/include/footer',$data);
		$this->load->view('front/include/model',$data);
		$this->load->view('front/include/foo',$data);
	}




	public function update_profile(){
		CheckLoginSession();
		$id = $this->session->userdata('user_id');
		$post_data = $this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');				
			$this->form_validation->set_rules('first_name', 'First Name', 'required');		
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');		
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|trim|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');	
			$this->form_validation->set_rules('site_location', 'Address', 'required|trim');				
			//$this->form_validation->set_rules('site_location', ' Address', 'required');
			$this->form_validation->set_rules('country', ' Country', 'required');
			$this->form_validation->set_rules('state', ' State', 'required');
			$this->form_validation->set_rules('city', ' City', 'required');
			$this->form_validation->set_rules('postal_code', ' Zip Code', 'required');	
			$this->form_validation->set_rules('description', 'about me', 'required');	
								
			if($this->form_validation->run() == FALSE) {   } else {
				
				$data = array(					
				'first_name' 	=> $this->input->post('first_name'),								
				'last_name'  	=> $this->input->post('last_name'),								
				'email'      	=> $this->input->post('email'),				
				'dob'        	=> $this->input->post('dob'),				
				'mobile'     	=> $this->input->post('mobile'),				
				'status'     	=> $this->input->post('status'),			        	             
				'gender'     	=> $this->input->post('gender'),			        	             
				'latitude'      => $this->input->post('latitude'),
				'longitude'     => $this->input->post('longitude'),
				'address'       => $this->input->post('site_location'),
				'country'       => $this->input->post('country'),
				'state'         => $this->input->post('state'),
				'city'          => $this->input->post('city'),
				'postal_code'   => $this->input->post('postal_code'),
				'about_me'      => $this->input->post('description')
				); 
		

				$id=$this->website_model->setUpdateData($this->users,$data,$id);
				if($_FILES["image"]["name"] != "") {
					$image=do_upload('user','image');
					$data_featured_img = array('image' => $image );
					$this->website_model->setUpdateData($this->users,$data_featured_img,$id);
				}
				$this->session->set_flashdata('message','Your profile has been update successfully');
		        redirect('update-profile','refresh');
		    }
        }
		$data['dataCollection']=$this->website_model->getDataCollectionByID($this->users,$id);
		//print_r($data['dataCollection']);
		$data['topData']=$this->website_model->getTopOFThisMonth(1);
		$data['latestWebsiteList']=$this->website_model->getLatestDataCollection($this->websites,3);
		$this->load->view('front/include/head',$data);
		$this->load->view('front/include/header_home',$data);
		$this->load->view('front/users/update-profile',$data);
		$this->load->view('front/include/footer',$data);
		$this->load->view('front/include/model',$data);
		$this->load->view('front/include/foo',$data);

	}

	public function register(){				
		$post_data=$this->input->post();
		if(!empty($post_data)) {        
			$this->form_validation->set_error_delimiters('<div>', '</div>');
			$this->form_validation->set_rules('fname', 'first name', 'required');
			$this->form_validation->set_rules('lname', 'last name', 'required');
			$this->form_validation->set_rules('useremail', 'email ID', 'trim|required|valid_email|is_unique['.$this->users.'.email]',array('is_unique' => getStaticContent('EMAIL_EXIT_MESSAGE')));
			$this->form_validation->set_rules('mobile', 'mobile', 'required');			
			if($this->form_validation->run() == FALSE) {
				echo '<div class="alert alert-danger">'.validation_errors().'</div>';
			} else {
				$data = array(
				'username' => $this->input->post('fname').' '.$this->input->post('lname'),
				'role' =>  '2',
				'first_name' => $this->input->post('fname'),
				'last_name' => $this->input->post('lname'),
				'email' => $this->input->post('useremail'),
				'mobile' => $this->input->post('mobile'),
				'created' => date('Y-m-d h:i:sa'),
				'password' => md5($this->input->post('password')),
				'status' => '2'	        	             
				); 
				$insert_id= $this->login_model->setInsertData($this->users, $data);
				if($insert_id>0) {
					echo $msg = '<div class="alert alert-success">'.getStaticContent('REGISTRATION_SUCCESS_MESSAGE').'</div>';
					$this->send_verification_email($insert_id);
			    } else  {
			    	echo $msg = '<div class="alert alert-danger">'.getStaticContent('REGISTRATION_ERROR_MESSAGE').'</div>';
			    }
			}
		}

	}

	public function logout()
	{   
		//$this->session->sess_destroy();
		$userdata = array(
		'user_id'    =>'',
		'role'    =>'',
		'front_name'    =>'',
		'front_email' =>''
		);
		$this->session->set_userdata($userdata);
		redirect('/','refresh');
	}


	public function frontlogin(){
     
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id)){
           echo '1';
		}
		else{   
			$login_arr=$this->input->post();			
			if(!empty($login_arr)){
				$userdata= $this->login_model->UserLogin();				
				if($userdata==1){
					echo $userdata;
				}elseif($userdata==2){
					echo '<div class="alert alert-danger">'.getStaticContent('LOGIN_DISABLE_MESSAGE').'</div>';
				}else{
					echo '<div class="alert alert-danger">'.getStaticContent('LOGIN_INVALID_DETAIL').'</div>';
				}					
				
			}
		}		
	}


	public function reset_password() {

		$user_id = $this->input->post('resetpassword');
		$password = $this->input->post('password');
		$rconpassword = $this->input->post('rconpassword');
		if($password==$rconpassword){
			$id=base64_decode($user_id);
			if($id >0) {  
			    $data = array('password' => md5($this->input->post('password')));
			    $insert_id=$this->login_model->setUpdateData($this->users,$data,$id); 
			    echo '<div class="success">'.getStaticContent('RESET_SUCCESSS').'</div>';
		    } else {
		    	echo '<div class="error">'.getStaticContent('INVALID_FORGOT').'</div>';
		    }
		} else {
			echo '<div class="error">'.getStaticContent('PASSWORD_MATCH_ERROR').'</div>';
		}

    }

	public function forget_password(){    	   
		$login_arr=$this->input->post('useremail');			
		if(!empty($login_arr)){
			$userdata= $this->login_model->UserForgot();
			if($userdata!='0')	{
				$status=$userdata->status;
				$id=$userdata->id;
				if($status==1) {
					echo '<div class="success">'.getStaticContent('FORGOT_SUCCESSS').'</div>';
	                $this->send_forgot_email($id);
				}
				elseif($status==2) {
					echo '<div class="success">'.getStaticContent('FORGOT_ACTIVE_SUCCESSS').'</div>';
				}
				else {
					echo '<div class="success">'.getStaticContent('INVALID_FORGOT').'</div>';
				}
			}
			else {
				echo '<div class="error">'.getStaticContent('INVALID_FORGOT').'</div>';
			}					
		}
	}

}
