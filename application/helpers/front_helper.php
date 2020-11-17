<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('CI')){
	function CI(){
		$CI =& get_instance(); 
		return $CI; 
	}
}


if ( ! function_exists('public_assets_url')) { 
    function public_assets_url(){  
       return  base_url().'assets/template/public/';
    }  
}


if(!function_exists('CheckUserLoginSession')){
	function CheckUserLoginSession(){
	  	$segment    = CI()->uri->segment(2); 
	   	$user_id   = CI()->session->userdata('user_id');
	  	if(empty($user_id)){
	    	redirect('','refresh');
	  	}
	  	else{
	    	return 1;
	  	}
	}
}


// function to get all smtp details
if ( ! function_exists('getRecordByImmatriculationNumber')) {
	function getRecordByImmatriculationNumber($title){
		$CI        = & get_instance();
	    $CI->db->where('immatriclulation', $title);
		$CI->db->from('tbl_vehicle_detail');
		$data=$CI->db->get();
		if($data->num_rows()>0) {
			$result = $data->result()[0];            
		  	return $result;
		}
		else { 
			return array();
		}
	}
}



// function added by Shiv to get area code
if ( ! function_exists('getAreaCode()')) {
	function getAreaCode(){
		$CI        = & get_instance();
	    $CI->db->where('name', 'area_code');
		$CI->db->from('tbl_settings');
		$data=$CI->db->get();
		if($data->num_rows()>0) {
		  	$value   = $data->row('value');                
		  	return $value;
		}
		else { 
			return '';
		}
	}
}

// function added by Shiv to get area code
if ( ! function_exists('getVideoUrl()')) {
	function getVideoUrl(){
		$CI        = & get_instance();
	    $CI->db->where('name', 'video_url');
		$CI->db->from('tbl_settings');
		$data=$CI->db->get();
		if($data->num_rows()>0) {
		  	$value   = $data->row('value');                
		  	return $value;
		}
		else { 
			return '';
		}
	}
}



// function to send smtp mail
if (!function_exists('send_smtp_mail')) {
     function send_smtp_mail($to="",$subject="",$message=""){
        $CI        = & get_instance();
        $config    = array(
	        'mailtype' => 'html',
	        'charset'  => 'utf-8',
	        'priority' => '1',
	        'newline'  => '\r\n'
        );
        $CI->load->library('email');
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = getSmtp('smtp_host'); //'ssl://smtp.gmail.com';
        $config['smtp_port']    = getSmtp('smtp_port');  //'465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = getSmtp('smtp_user');  //'sourcesoft.developer@gmail.com';
        $config['smtp_pass']    = getSmtp('smtp_pass');  //'!!#$124><RTTq1';
        //$config['charset']      = 'utf-8';
        //$config['newline']      = "\r\n";
        $CI->email->initialize($config);
        $CI->email->from('developers@sourcesoftsolutions.com', 'Proassur Website');
        $CI->email->to($to);
        $CI->email->subject($subject); 
        $CI->email->message($message); 
        if(!$CI->email->send()) {
            
        }
        return true;
    }
}

// function to compose the mail
if ( ! function_exists('email_compose')) {
	function email_compose($email_template,$templateTags) {
		$templateContents = file_get_contents( dirname(__FILE__) . '/email-templates/'.$email_template);
		return $message =  strtr($templateContents, $templateTags);
	}

}


// function to upload single file
if(!function_exists('do_upload')) {
 	function do_upload($folder="", $filename="") {
		$config['upload_path'] = './upload/'.$folder.'/'; // Added forward slash 
		$config['allowed_types'] = 'gif|jpg|png|jpeg'; 

		$uploaddir = 'upload/'.$folder.'/';
		if(!is_dir($uploaddir)) {
			mkdir($uploaddir);
		}
		$config['overwrite'] = TRUE;
		CI()->load->library('upload', $config);
		CI()->upload->initialize($config);
		$input = $filename; // on view the name <input type="file" name="userfile" size="20"/>

		if (!CI()->upload->do_upload($filename)) {
			return $CI->upload->display_errors();
			// return $CI->session->set_flashdata('error',$CI->upload->display_errors());
		//CI()->form_validation->set_message('do_upload', 'Post update should have something written or a photo or attach a file.');
		}
		else {
			// echo "sdsdsd";
			$upload_data = CI()->upload->data();
			$file_name = $upload_data['file_name'];
			$file_path=$uploaddir.$file_name;
			return $file_path;
		}
	}
}


// function to upload single file
if(!function_exists('do_upload_images')) {
 	function do_upload_images($folder="", $filename="") {
		$config['upload_path']    = './upload/'.$folder.'/'; // Added forward slash 
		$config['max_size']       = '1000000'; 
		$config['allowed_types']  = 'gif|jpg|png|jpeg'; 
		$uploaddir                = 'upload/'.$folder.'/';
 		
		if(!is_dir($uploaddir)) {
			mkdir($uploaddir);
		}
		$config['overwrite']      = TRUE;
		CI()->load->library('upload', $config);
		CI()->upload->initialize($config);
		$input                    = $filename; // on view the name <input type="file" name="userfile" size="20"/>
		if (!CI()->upload->do_upload($filename)) {
			CI()->session->set_flashdata('do_upload', CI()->upload->display_errors());
			return  false;
		}
		else {
			$upload_data    = CI()->upload->data();
			$file_name      = $upload_data['file_name'];
			$file_path      = $uploaddir.$file_name;
			return $file_path;
		}
	}
}



if(!function_exists('single_file_upload')) {
    function single_file_upload($path, $files) {
        $title = uniqid();
        
        $config['upload_path']   = APPPATH.'upload/'.$path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = 10000;

        CI()->load->library('upload', $config);       

        $_FILES['image']['name']= $files['name'];
        $_FILES['image']['type']= $files['type'];
        $_FILES['image']['tmp_name']= $files['tmp_name'];
        $_FILES['image']['error']= $files['error'];
        $_FILES['image']['size']= $files['size'];

        $fileName = $title .'_'. $_FILES['image']['name']; 

        $image = 'upload/'.$path.'/'.$fileName;

        $config['file_name'] = $fileName;

        CI()->upload->initialize($config);

        if (CI()->upload->do_upload('image')) {            

            CI()->upload->data();
            
        } else {
            return array('error' => CI()->upload->display_errors());
        }
        return $image;

    }
}




if(!function_exists('multiple_files_upload')) {
    function multiple_files_upload($path, $files) {
        $title = uniqid();
        
        $config['upload_path']   = APPPATH.'upload/'.$path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = 10000;

        CI()->load->library('upload', $config);       

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

             $fileName = $title .'_'. $image; 

            $images[] = 'upload/'.$path.'/'.$fileName;

            $config['file_name'] = $fileName;

            CI()->upload->initialize($config);

            if (CI()->upload->do_upload('images[]')) {            

                CI()->upload->data();
                
            } else {
                return array('error' => CI()->upload->display_errors());
            }

        }
        return $images;

    }
}


if(!function_exists('time_elapsed')){
	function time_elapsed($datetime, $full = false) {
		$now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }
	    $string = array_values($string);
	   
	    return isset($string[0])?$string[0]. ' ago':'Just Now' ;
	    
	}
}

// function to upload multiple files
if(!function_exists('do_multiupload')){
    function do_multiupload($id,$folder,$tbl){
		$table=$tbl;
		$data = array();
		if(!empty($_FILES['image']['name'])){
			$filesCount = count($_FILES['image']['name']);
		
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['image_name']['name'] = $_FILES['image']['name'][$i];
				$_FILES['image_name']['type'] = $_FILES['image']['type'][$i];
				$_FILES['image_name']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
				$_FILES['image_name']['error'] = $_FILES['image']['error'][$i];
				$_FILES['image_name']['size'] = $_FILES['image']['size'][$i];
				$uploadPath = 'upload/'.$folder.'/';
				if(!is_dir($uploadPath)) {
					mkdir($uploadPath);
				}
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				CI()->load->library('upload', $config);
				CI()->upload->initialize($config);
				if(CI()->upload->do_upload('image_name')) {
					$fileData = CI()->upload->data();
					$uploadData['image'] = $uploadPath.$fileData['file_name'];
					$uploadData['created_date'] = date("Y-m-d H:i:s");
					$uploadData['website_id'] = $id;
					setPicInsertData($table, $uploadData);
				} else {

					$save_img=CI()->input->post('save_img');
					//die();
					if($save_img!=""){
			        	$uploadData['image'] = $save_img;
						$uploadData['created_date'] = date("Y-m-d H:i:s");
						$uploadData['website_id'] = $id;
						setPicInsertData($table, $uploadData);
				    }
		        }
			}
		} 
	}
}

// function to insert files to db
if(!function_exists('setPicInsertData')){
	function setPicInsertData($table="",$data="") {
	    $CI =& get_instance();  
		$CI->db->insert($table, $data); 
	}
}

if(!function_exists('getOptions')){
	function getOptions($table, $type, $status=0) {
		$options = array(''=>$type);
		if($table){
			if($status==1){ 
			  CI()->db->where('status',1); 
			}
			$query = CI()->db->get($table);
			$skills =  $query->result();
			foreach ($skills as $value) {
				$options[$value->id] = $value->name;
			}
		}
		return $options;
	}
}






// function to get user name
if(!function_exists('getUserName')){
	function getUserName($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_users');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->first_name.' '.$res->last_name;						
		    } else {
		    	 $result='';
		    }
	    }
	    return $result;
	}
}

if(!function_exists('getAutomobileBranchId')){
	function getAutomobileBranchId(){
	    $result="";	    
	    CI()->db->where('name','AUTOMOBILE');
		$query = CI()->db->get('tbl_branch');
	    $count = $query->num_rows();
        if($count>0){        	
			$res =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result='';
	    }
	    
	    return $result;
	}
}



// function to get company
if(!function_exists('getCompanyInsuredFor')){
	function getCompanyInsuredFor($insured_id , $insurance_type_id , $table){
	    $result="";
	    if($insurance_type_id == 1) {// vehicle
		    CI()->db->where('vehicle_detail_id',$insured_id);

	    }
	    else if($insurance_type_id == 2) {//HEALTH
		    CI()->db->where('health_insurance_id',$insured_id);
	    }
	    else if($insurance_type_id == 3) {//TRAVEL
		    CI()->db->where('travel_id',$insured_id);
	    }
	    else if($insurance_type_id == 4) {//PROFESSIONAL MULTIRISK
		    CI()->db->where('proffesional_multirisk_quote_id',$insured_id);
	    }
	    else if($insurance_type_id == 5) {//INDIVIDUAL ACCIDENT
		    CI()->db->where('individual_insurance_option_details_id',$insured_id);
	    }
	    else if($insurance_type_id == 6) {//CREDIT
		    CI()->db->where('credit_detail_id',$insured_id);
	    }
	    else if($insurance_type_id == 7) {//HOUSING
		    CI()->db->where('house_detail_id',$insured_id);
	    }
			$query = CI()->db->get($table);
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->company_name;						
		    } else {
		    	 $result='';
		    }
	    return $result;
	}
}

// function to get user role Id
if(!function_exists('getUserRoleId')){
	function getUserRoleId(){
	    $result="";
	    CI()->db->where('name','Customer');
		$query = CI()->db->get('tbl_roles');
	    $count = $query->num_rows();
        if($count>0){        	
			$res =  $query->row();
			$result = $res->id;						
	    } else {
	    	 $result='';
	    }
	    return $result;
	}
}

// function added by Shiv to get user role Id by email
if(!function_exists('getUserRoleIdByEmail')){
	function getUserRoleIdByEmail($email){
	    $result="";
	    CI()->db->where('email',$email);
		$query = CI()->db->get('tbl_users');
	    $count = $query->num_rows();
        if($count>0){        	
			$res =  $query->row();
			$result = $res->role;						
	    } else {
	    	$result='';
	    }
	    return $result;
	}
}

// function added by Shiv to get user Id by email
if(!function_exists('getUserIdByEmail')){
	function getUserIdByEmail($email){
	    //$result = "";
	    CI()->db->where('email',$email);
		$query = CI()->db->get('tbl_users');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result = 0;
	    }
	    return $result;
	}
}

// function added by Shiv to get User mail id
if (!function_exists('getUserMailId')) {

    function getUserMailId($id) {
        $result = "";
        CI()->db->where('id', $id);
        $query = CI()->db->get('tbl_users');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->row();
            $result = $res->email;
        } else {
            $result = '';
        }
        return $result;
    }
}

if(!function_exists('getUserRoleIdByUserId')){
	function getUserRoleIdByUserId($id){
	    $result="";
	    CI()->db->where('id',$id);
		$query = CI()->db->get('tbl_users');
	    $count = $query->num_rows();
        if($count>0){        	
			$res =  $query->row();
			$result = $res->role;						
	    } else {
	    	$result='';
	    }
	    return $result;
	}
}


// function to get slider images
if(!function_exists('getSliderImages')){
	function getSliderImages($id=0){
	    $result    = "";
		    CI()->db->where('status',1);
        	CI()->db->order_by('order','asc');
			$query = CI()->db->get('tbl_slider');
		    $count = $query->num_rows();
	        if($count>0){        	
				$result =  $query->result();
				//$result = $res->first_name.' '.$res->last_name;			
		    } else {
		    	$result=array();
		    }
	    return $result;
	}
}


// function to check the id of user exists or not
if(!function_exists('checkUserExists')){
	function checkUserExists($id=0){
	    $result    = "";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_users');
		    $count = $query->num_rows();
	        if($count>0){        	
				$result =  true; // id exists					
		    } 
		    else {
		    	$result = false; // id does not exists
		    }
	    }
	    return $result;
	}
}


// function to check the email of user exists or not
if(!function_exists('checkUserEmailExists')){
	function checkUserEmailExists($email=0){
	    $result    = "";
	    if($email != "") {
		    CI()->db->where('email',$email);
			$query = CI()->db->get('tbl_users');
		    $count = $query->num_rows();
	        if($count>0){        	
				$result =  true; // email exists					
		    } 
		    else {
		    	$result = false; // email does not exists
		    }
	    }
	    return $result;
	}
}


// function to get created time of user account
if(!function_exists('getCreatedTime')){
	function getCreatedTime($id=0){
	    $result    = "";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_users');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result = $res->created;
		    } 
		    else {
		    	$result = '';
		    }
	    }
	    return $result;
	}
}

// function to check the status of user
if(!function_exists('checkUserStatus')){
	function checkUserStatus($id=0){
	    $result    = "";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_users');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result = $res->status;						
				// $result =  true; // id exists					
		    } 
		    else {
		    	$result = ''; // id does not exists
		    }
	    }
	    return $result;
	}
}

// function to get user name
if(!function_exists('getProfileActiveMessage')){
	function getProfileActiveMessage(){
	    $result="";
	    $user_id = CI()->input->get('verify-email'); 
	    $id=base64_decode($user_id);
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_users');
		    $count = $query->num_rows();
	        if($count>0){      
	            $data['status']=1;  	
				CI()->db->where('id',$id);  
		        CI()->db->update('tbl_users', $data);	
		        echo 'Your account has been activated now';				
		    } else {
		    	 $result='';
		    }
	    }
	    return $result;
	}
}

// function to get user image
if(!function_exists('getUserImage')){
	function getUserImage($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
		    CI()->db->where('image!=""');
			$query = CI()->db->get('tbl_users');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->image;	
				$result='<img src="'.base_url($result).'" class="">';					
		    } else {
		    	 $result='<img src="'.base_url('assets/front/images/profile.jpg').'" class="">';
		    }
	    }
	    return $result;
	}
}

if(!function_exists('getUserImageUrl')){
	function getUserImageUrl($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
		    CI()->db->where('image!=""');
			$query = CI()->db->get('tbl_users');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->image;	
				$result=base_url($result);					
		    } else {
		    	 $result=base_url('assets/front/images/profile.jpg');
		    }
	    }
	    return $result;
	}
}


// function to get user image
if(!function_exists('getUserImageNoResponsive')){
	function getUserImageNoResponsive($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
		    CI()->db->where('image!=""');
			$query = CI()->db->get('tbl_users');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->image;	
				$result= base_url($result);					
		    } else {
		    	 $result= base_url('assets/front/images/no_user.png');
		    }
	    }
	    return $result;
	}
}



// function to check user is login or not
if(!function_exists('CheckLoginSession')){
	function CheckLoginSession(){
	  	 
	   	$user_id = CI()->session->userdata('user_id');
	  	if(empty($user_id)){
	    	redirect(base_url(),'refresh');
	  	}
	  	else{
	    	return 1;
	  	}
	}
}

// function added by Shiv to get the insurance type id
if(!function_exists('getInsuranceTypeId')) {
	function getInsuranceTypeId($type) {
		CI()->db->where('type',$type);
		CI()->db->where('status',1);
		$query = CI()->db->get('tbl_insurance_type');
		if($query->num_rows() > 0) {
			$res    = $query->row();
			$result = $res->id;
		} else {
			$result = 0;
		}
		return $result;
	}
}

// function added by Shiv to get the insurance type  
if(!function_exists('getInsuranceType')) {
	function getInsuranceType($id) {
		CI()->db->where('id',$id);
		CI()->db->where('status',1);
		$query = CI()->db->get('tbl_insurance_type');
		if($query->num_rows() > 0) {
			$res    = $query->row();
			$result = $res->type;
		} else {
			$result = '';
		}
		return $result;
	}
}

//function for pagination
if(!function_exists('Jpagination')){
	function Jpagination($total_rows, $per_page, $limit){
	   
	  $config['use_page_numbers'] = TRUE; 
	  $config['num_links'] = 3;
	  $config['full_tag_open'] = '<ul class="pagination">';
	  $config['full_tag_close'] = '</ul>';
	  $config['first_link'] = 'First';
	  $config['first_tag_open'] = '<li>';
	  $config['first_tag_close'] = '</li>';
	  $config['last_link'] = 'Last';
	  $config['last_tag_open'] = '<li>';
	  $config['last_tag_close'] = '</li>';
	  $config['num_tag_open'] = '<li>';
	  $config['num_tag_close'] = '</li>';
	  $config['next_link'] = 'Next';
	  $config['next_tag_open'] = '<li>';
	  $config['next_tag_close'] = '</li>';
	  $config['prev_link'] = 'Prev';
	  $config['prev_tag_open'] = '<li>';
	  $config['prev_tag_close'] = '</li>';
	  $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0)">';
	  $config['cur_tag_close'] = '</a></li>';
	  $config['reuse_query_string'] = true;
	  CI()->pagination->initialize($config); 
	  $config = array();	  
	  $config["base_url"] = base_url().CI()->uri->segment(1);	  
	  $config["total_rows"] = $total_rows; 
	  $config["per_page"] = $per_page;  
	  CI()->pagination->initialize($config);
	  return CI()->pagination->create_links(); 
	}
}


// function to get multiple options
if(!function_exists('getMultipleOptions')){
	function getMultipleOptions($table, $type, $status=0) {
		if($table){
			if($status==1){ 
			  CI()->db->where('status',1); 
			}
			$query = CI()->db->get($table);
			$skills =  $query->result();
			foreach ($skills as $value) {
				// $options['']         = $type;
				$options[$value->id] = $value->name;
			}
		}
		return $options;
	}
}


// function added by Shiv to get company options
if(!function_exists('getCompanyOptions')){
	function getCompanyOptions($table, $type, $status=0) {
		if($table){
			if($status==1){ 
			  CI()->db->where('status',1); 
			}
			$query = CI()->db->get($table);
			$skills =  $query->result();
			foreach ($skills as $value) {
				$options['']         = $type;
				$options[$value->id] = $value->name;
			}
		}
		return $options;
	}
}


// function added by Shiv to get claim reimbursement rate for a policy coverage area id

if ( ! function_exists('getRateByPolicyCoveargeAreaId')) {
    function getRateByPolicyCoveargeAreaId($id=""){
        $table='tbl_claim_reimbursement_rate';
        $CI =& get_instance();
        $options=array('' =>'Select');

        $CI->db->where('policy_coverage_area_id',$id);
		//$CI->db->where('status',1); 
        $query = $CI->db->get($table);
        $result =  $query->result();
        foreach ($result as $value) {
        	$options[$value->rate] = $value->rate;
        }
        return $options;
    }
}


// function added by Shiv to get amount for a policy coverage area id

if ( ! function_exists('getAmountByPolicyCoveargeAreaId')) {
    function getAmountByPolicyCoveargeAreaId($id=""){
        $table  = 'tbl_policycoverage_area';
        $CI     = & get_instance();
        $CI->db->where('id',$id);
		//$CI->db->where('status',1); 	
        $query  = $CI->db->get($table);
        $result = $query->row();
        $amount = $result->amount;
        return $amount;
    }
}


// function added by Shiv to get policy coverage area id by Health Insurance Id
if ( ! function_exists('getPolicyCoveargeAreaIdByHealthInsuranceId')) {
	function getPolicyCoveargeAreaIdByHealthInsuranceId($id) {
		$table 				     = 'tbl_health_insurance_details';
		$CI    				     = & get_instance();
		$CI->db->select('policy_coverage_area_id');
		$CI->db->where('id',$id);
		$query  				 = $CI->db->get($table);
        $result 				 = $query->row();
        $policy_coverage_area_id = $result->policy_coverage_area_id;
        return $policy_coverage_area_id;
	}
}


// function added by Shiv to get claim reimbursement rate id by policy coverage area id
if ( ! function_exists('getClaimReimbursementRateIdByPolicyCoveargeAreaId')) {
	function getClaimReimbursementRateIdByPolicyCoveargeAreaId($id) {
		$table 	= 'tbl_claim_reimbursement_rate';
		$CI    	= & get_instance();
		$CI->db->select('id,rate');
		$CI->db->where('policy_coverage_area_id',$id);
		$query  = $CI->db->get($table);
        $result = $query->row();
      	return $result;
	}
}

// function to get all user name
if ( ! function_exists('getAllUserName')) {
	function getAllUserName($id=""){
		$CI =& get_instance();
	    $CI->db->where('username !=', 'admin');
		$CI->db->from('tbl_users');
		$data=$CI->db->get();
		if($data->num_rows()>0) {
		  	$results = $data->result();  
		  	foreach ($results as $result) {
		    	$options[''] =  'Choose User';   
		    	$options[$result->id] =  $result->username;   
			}              
		  	return $options;
		}
		else { 
			return array();
		}
	}
}

// function to get list of partners
if ( ! function_exists('getpartnersList')) {
	function getpartnersList($id=""){
		$CI =& get_instance();
		$CI->db->from('tbl_company');
		$data                = $CI->db->get();
		if($data->num_rows()>0) {
		  	$results         = $data->result();               
		  	return $results;
		}
		else { 
			return array();
		}
	}
}

// function to get testimonials
if ( ! function_exists('getTestimonials')) {
	function getTestimonials(){
		$CI =& get_instance();
		$CI->db->from('tbl_testimonial');
		$data                = $CI->db->get();
		if($data->num_rows()>0) {
		  	$results         = $data->result();               
		  	return $results;
		}
		else { 
			return array();
		}
	}
}




// function to get all user name
if ( ! function_exists('getStaticContent')) {
	function getStaticContent($title=""){
		$CI =& get_instance();
		if($title!=""){
		    $CI->db->where('name', $title);
			$CI->db->from('tbl_static_content');
			$data=$CI->db->get();
			if($data->num_rows()>0) {
			  	$description = $data->row('description');                
			  	return $description;
			}
			else { 
				return 'undefine';
			}
	    } else { 
			return 'undefine';
		}
	}
}

// function to get all smtp 
if ( ! function_exists('getSmtp')) {
	function getSmtp($title=""){
		$CI =& get_instance();
		if($title!=""){
		    $CI->db->where('name', $title);
			$CI->db->from('tbl_smtp_settings');
			$data=$CI->db->get();
			if($data->num_rows()>0) {
			  	$description = $data->row('value');                
			  	return $description;
			}
			else { 
				return 'undefine';
			}
	    } else { 
			return 'undefine';
		}
	}
}

// function to get all smtp 
if ( ! function_exists('getSettings')) {
	function getSettings($title=""){
		$CI =& get_instance();
		if($title!=""){
		    $CI->db->where('name', $title);
			$CI->db->from('tbl_settings');
			$data=$CI->db->get();
			if($data->num_rows()>0) {
			  	$description = $data->row('value');                
			  	return $description;
			}
			else { 
				return 'undefine';
			}
	    } else { 
			return 'undefine';
		}
	}
}

// function to get user info by attribute
if ( ! function_exists('getAdminInfo')) {
	function getAdminInfo($attr=""){
		$CI =& get_instance();
		if($attr!=""){
		    $CI->db->where('id',1);
			$CI->db->from('tbl_users');
			$data=$CI->db->get();
			if($data->num_rows()>0) {
			  	$description = $data->row($attr);                
			  	return $description;
			}
			else { 
				return 'undefine';
			}
	    } else { 
			return 'undefine';
		}
	}
}


// function to get User Role
if(!function_exists('getUserRoleName')){
	function getUserRoleName($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_roles');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result = $res->name;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}


// function to get new slug
if(!function_exists('getNewSlug')){
	function getNewSlug($id,$slug,$table){
	    $result="";
	    if($slug){
		    CI()->db->where('id!=',$id);
		    CI()->db->where('slug',$slug);
			$query = CI()->db->get($table);
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->slug;
				$result = $result.'-'.$id;
				 // $qw = explode($result, '_');
				 // $result = $qw;
		    } else {
		    	 $result=$slug;
		    }
	    }
	    return $result;
	}
}


// function to get admin mail id
if(!function_exists('getAdminEmail')){
	function getAdminEmail(){
	    $result="";
	    CI()->db->where('id',1);
		$query = CI()->db->get('tbl_users');
	    $count = $query->num_rows();
        if($count>0){        	
			$res =  $query->row();
			$result = $res->email;						
	    } else {
	    	 $result='';
	    }
	    return $result;
	}
}


// function to get Company mail id
if(!function_exists('getCompanyMailId')){
	function getCompanyMailId($id){
	    $result="";
	    CI()->db->where('id',$id);
		$query = CI()->db->get('tbl_company');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->email;						
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}



// function to get content in selected language
if(!function_exists('getContentLanguageSelected')){
	function getContentLanguageSelected($tittle,$language_id){
	    CI()->db->where('name',$tittle);
	    CI()->db->where('language_id',$language_id);
		$query      = CI()->db->get('tbl_static_content');
	    $count      = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->description;
	    } else {
	    	$result = $tittle;
	    }
	    return $result;
	}
}

// function to get defalt selected language
if(!function_exists('defaultSelectedLanguage')){
	function defaultSelectedLanguage(){
	    CI()->db->where('default','active');
		$query       = CI()->db->get('tbl_language');
	    $count       = $query->num_rows();
        if($count>0){        	
			$res     = $query->row();
			$result  = $res->id;
	    } else {
	    	$result  = "";
	    }
	    return $result;
	}
}

// function to get the social links
if(!function_exists('getSocialLinks')){
	function getSocialLinks($name=""){
	    $result="";
	    if($name!=''){
		    CI()->db->where('name',$name);
			$query = CI()->db->get('tbl_settings');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->value;						
		    } else {
		    	 $result='undefine';
		    }
	    }
	    return $result;
	}
}


// function to get  data by slug
if ( ! function_exists('getDataBySlug')) {
	function getDataBySlug($slug){
		$CI        = & get_instance();
		$result    = '';
		if($slug!= ""){
		    $CI->db->where('slug', $slug);
			$CI->db->from('tbl_pages');
			$data  = $CI->db->get();
			// return ($CI->db->last_query());
			if($data->num_rows()>0) {
			  	$result  = $data->row()->description;
			}
			else { 
				$result  = array();
			}
	    }
	    else {
	    	$result      = array();
	    }
		return $result;
	}
}

// function to get single options
if(!function_exists('getSingleOptions')){
	function getSingleOptions($table, $type, $status=0) {
		if($table){
			if($status==1){ 
			  CI()->db->where('status',1); 
			}
			CI()->db->order_by('name','asc'); 
			$query = CI()->db->get($table);
			$skills =  $query->result();
			foreach ($skills as $value) {
				$options['']         = $type;
				$options[$value->id] = $value->name;
			}
		}
		return $options;
	}
}

if(!function_exists('getAutomobileRisque')){
	function getAutomobileRisque(){
		CI()->db->where('status',1); 
		CI()->db->where('branch_id',getAutomobileBranchId()); 
		$query = CI()->db->get('tbl_risque');
		$skills =  $query->result();
		foreach ($skills as $value) {
			$options['']         = 'Select Risque';
			$options[$value->id] = $value->name;
		}
		return $options;
	}
}

// function to get Months interval (by Shiv)
if(!function_exists('getMonthOptions')) {
	function getMonthOptions() {
		$type = 'Select Month';
			if($status==1){ 
			  CI()->db->where('status',1); 
			}
			$query = CI()->db->get('tbl_house_month');
			$skills =  $query->result();
			foreach ($skills as $value) {
				$options['']         = $type;
				$options[$value->id] = $value->name;
			}
		return $options;
	}
}


// function added by Shiv to get registered user options
if(!function_exists('getEndUserOptions')){
	function getEndUserOptions($table, $type, $status=0) {
		if($table){
			if($status==1){ 
			  CI()->db->where('status',1); 
			}
			  CI()->db->where('role',2); 
			$query = CI()->db->get($table);
			$skills =  $query->result();
			foreach ($skills as $value) {
				$options['']         = $type;
				$options[$value->id] = $value->first_name;
			}
		}
		return $options;
	}
}

// function added by Shiv to get activity options for Individual Accident Quote
if(!function_exists('getIndividualAccidentActivityOptions')){
	function getIndividualAccidentActivityOptions($table, $type, $status=0) {
		if($table){
			if($status==1){ 
			  CI()->db->where('status',1); 
			}
			$query = CI()->db->get($table);
			$skills =  $query->result();
			foreach ($skills as $value) {
				$options['']         = $type;
				$options[$value->id] = $value->name;
			}
		}
		return $options;
	}
}



// function added by Shiv to get the accident activity id for Individual Accident Insurance Get Quote
if(!function_exists('getIndividualAccidentPersonDetails')) {
	function getIndividualAccidentPersonDetails($id) {
		if($id) {
			CI()->db->where('id',$id);
			CI()->db->select('individual_accident_activity_id');
			$query = CI()->db->get('tbl_individual_accident_quote_personal_details');
			if($query->num_rows() > 0) {
				$res = $query->row();
				$result = $res->individual_accident_activity_id;
			} else {
				$result = '';
			}
			return $result;
		}
	}
}


// function added by Shiv to get the selected activity id for Proffesional Multi Risk Get Quote
if(!function_exists('getProffesionalMultiRiskPersonDetails')) {
	function getProffesionalMultiRiskPersonDetails($id) {
		if($id) {
			CI()->db->where('id',$id);
			CI()->db->select('activity_id');
			$query = CI()->db->get('tbl_proffesional_multirisk_quote_personal_details');
			if($query->num_rows() > 0) {
				$res    = $query->row();
				$result = $res->activity_id;
			} else {
				$result = '';
			}
			return $result;
		}
	}
}


// function added by Shiv to get the companies detail for the selected activity 
if(!function_exists('getCompaniesIdByIndividualAccidentActivityId')) {
	function getCompaniesIdByIndividualAccidentActivityId($id) {
		CI()->db->where('individual_accident_activity_id',$id);
		$query      = CI()->db->get('tbl_company_individual_accident_activity');
		$count      = $query->num_rows();
	    if($count>0){
			$result = $query->result();
		    foreach ($result as $key => $value) {
		    	$data[] = $value->company_id;
		    }
	 		return $data;
		}
		else{
	    	return array();
	    } 
	}
}



// function added by Shiv to get the companies detail for the selected activity 
if(!function_exists('getCompaniesIdByProffesionalMultiRiskActivityId')) {
	function getCompaniesIdByProffesionalMultiRiskActivityId($id) {
		CI()->db->where('individual_accident_activity_id',$id);
		$query      = CI()->db->get('tbl_company_individual_accident_activity');
		$count      = $query->num_rows();
	    if($count>0){
			$result = $query->result();
		    foreach ($result as $key => $value) {
		    	$data[] = $value->company_id;
		    }
	 		return $data;
		}
		else{
	    	return array();
	    } 
	}
}


// function added by Shiv to get proffessional multirisk branch id
if(!function_exists('getProffesionalBranchId()')){
	function getProffesionalBranchId(){
	    $result="";
	    CI()->db->where('name','Professional Multi Risk');
		$query = CI()->db->get('tbl_branch');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}

// function added by Shiv to get credit branch id
if(!function_exists('getCreditBranchId()')){
	function getCreditBranchId(){
	    $result="";
	    CI()->db->where('name','CREDIT');
		$query = CI()->db->get('tbl_branch');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}

// function added by Shiv to get housing branch id
if(!function_exists('getHousingBranchId()')){
	function getHousingBranchId(){
	    $result="";
	    CI()->db->where('name','Housing');
		$query = CI()->db->get('tbl_branch');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}

if(!function_exists('getIndividualAccidentBranchId')) {
	function getIndividualAccidentBranchId() {
		$result="";
	    CI()->db->where('name','Individual Accident');
		$query = CI()->db->get('tbl_branch');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}


// function to get housing risque id
if(!function_exists('getHousingRisqueId()')){
	function getHousingRisqueId(){
	    $result="";
	    CI()->db->where('name','Multi-Risk Housing');
		$query = CI()->db->get('tbl_risque');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}


// function added by Shiv to get credit risque id
if(!function_exists('getCreditRisqueId()')){
	function getCreditRisqueId(){
	    $result="";
	    CI()->db->where('name','Credit Insurance');
		$query = CI()->db->get('tbl_risque');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}


// function added by Shiv to get the company id by credit id
if (!function_exists('getCompanyIdByCreditId')) {
	function getCompanyIdByCreditId($credit_id) {
		CI()->db->where('id',$credit_id);
		$query = CI()->db->get('tbl_credit_detail');
		$count = $query->num_rows();
		if ($count>0) {
			$res    = $query->row();
			$result = $res->company_selected;
		}
		else {
			$result = '';
		}
		return $result;
	}
}

// get record for house detail id
if(!function_exists('getHouseDetailRecordByDetailId')){
	function getHouseDetailRecordByDetailId($house_detail_id=0){
	    $result=array();
	    if($house_detail_id>0){
		    CI()->db->where('id',$house_detail_id);
			$query = CI()->db->get('tbl_house_detail');
		    $count = $query->num_rows();
	        if($count>0){        	
				$result    =  $query->row_array();	
		    }
	    }
	    return $result;
	}
}



// function added by Shiv to get proffessional multi risk risque id
if(!function_exists('getProffesionalRisqueId()')){
	function getProffesionalRisqueId(){
	    $result="";
	    CI()->db->where('name','Multi Risk');
		$query = CI()->db->get('tbl_risque');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}


// function added by Shiv to get the company id by proffesional multi risk id
if (!function_exists('getCompanyIdByProffesionalMultiRiskId')) {
	function getCompanyIdByProffesionalMultiRiskId($proffesional_multirisk_quote_id) {
		CI()->db->where('id',$proffesional_multirisk_quote_id);
		$query = CI()->db->get('tbl_proffesional_multirisk_quote_personal_details');
		$count = $query->num_rows();
		if ($count>0) {
			$res    = $query->row();
			$result = $res->company_selected;
		}
		else {
			$result = '';
		}
		return $result;
	}
}


// function added by Shiv to get user id from insurance details table\
if(!function_exists('getUserIdFromInsuranceDetails')) {
	function getUserIdFromInsuranceDetails($id="",$table) {
		CI()->db->where('id',$id);
		$query = CI()->db->get($table);
		if($query->num_rows() > 0) {
			$res    = $query->row();
			$result = $res->user_id;
		} else {
			$result = '';
		}
		return $result;
	}
}

// function to get days from Vehicle Detail Id
if(!function_exists('getDaysFromVehicleDetailId')) {
	function getDaysFromVehicleDetailId($id="",$table) {
		CI()->db->where('vehicle_detail_id',$id);
		$query = CI()->db->get($table);
		if($query->num_rows() > 0) {
			$res      = $query->row();
			$from     = strtotime($res->from_);
			$to       = strtotime($res->to_);
			$datediff = $to - $from;
			$result   = round($datediff / (60 * 60 * 24));
		} else {
			$result = 0;
		}
		return $result;
	}
}

// function to get the premium rate via companyid and number of Days
if(!function_exists('getPremiumRateViaCompanyDays')) {
	function getPremiumRateViaCompanyDays($days,$company_id) {
		CI()->db->where('min_days <=',$days);
		CI()->db->where('max_days >=',$days);
		CI()->db->where('company_id',$company_id);
		$query = CI()->db->get('tbl_policy_duration');
		if($query->num_rows() > 0) {
			$res        = $query->row();
			$result     = $res->premium_rate;
		} else {
			$result = 0;
		}
		return $result;
	}
}



// function added by Shiv to get the individual accident quote id by accident activity id
if(!function_exists('getActivtiyIdByAccidentQuoteId')) {
	function getActivtiyIdByAccidentQuoteId($accident_quote_id) {
		CI()->db->where('id',$accident_quote_id);
		$query = CI()->db->get('tbl_individual_accident_quote_personal_details');
		if($query->num_rows() > 0) {
			$result = $query->row();
		}
		return $result->individual_accident_activity_id;
	}
}


// function added by Shiv to get the individual accident insurance options for the selected activity and company
if(!function_exists('getAccidentInsuranceOptions')) {

	function getAccidentInsuranceOptions($activity_id,$selected_company_id) { 
		CI()->db->where('individual_accident_activity_id',$activity_id);
		CI()->db->where('company_id',$selected_company_id);
		$query  = CI()->db->get('tbl_individual_accident_insurance_options');
		$count = $query->num_rows();
		if($count > 0) {
			$result = $query->result();
		} else {
			$result = '';
		}
		return $result;
	}
}


// function to get all designation for a brand id

if ( ! function_exists('getDesignationByBrandId')) {
    function getDesignationByBrandId($id=""){
    	// return $id;
        $table='tbl_vehicle_designation';
        $CI =& get_instance();
        $options=array('' =>getContentLanguageSelected('SELECT_DESIGNATION',defaultSelectedLanguage()));

        $CI->db->where('vehicle_make_id',$id);
        $CI->db->order_by('name',asc);
        $query = $CI->db->get($table);
        $result =  $query->result();
      
        foreach ($result as $value) {
        	$options[$value->id] = $value->name;
        }
        return $options;
    }
}


// function to get company name
if(!function_exists('getCompanyName')){
	function getCompanyName($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_company');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->name;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}



// function added by Shiv to get branch Name
if(!function_exists('getBranchName')){
	function getBranchName($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_branch');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result = $res->name;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}


// function added by Shiv to get risque Name
if(!function_exists('getRisqueName')){
	function getRisqueName($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_risque');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result = $res->name;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}


// function to get body work options
if(!function_exists('getBodyWorkOptions')){
	function getBodyWorkOptions($table, $type, $status=0) {
		if($table){
			if($status==1){ 
			  CI()->db->where('status',1); 
			}
			$query = CI()->db->get($table);
			$skills =  $query->result();
			foreach ($skills as $value) {
				$options['']         = $type;
				$options[$value->id] = $value->name;
			}
		}
		return $options;
	}
}


// function to get Region options
if(!function_exists('getRegionOptions')){
	function getRegionOptions($table, $type, $status=0) {
		if($table){
			if($status==1){ 
			  CI()->db->where('status',1); 
			}
			$query = CI()->db->get($table);
			$skills =  $query->result();
			foreach ($skills as $value) {
				$options['']         = $type;
				$options[$value->id] = $value->name;
			}
		}
		return $options;
	}
}

// function to get all department by a region id

if ( ! function_exists('getDepartmentByRegionId')) {
    function getDepartmentByRegionId($id=""){
        $table='tbl_department';
        $CI =& get_instance();
        $options=array('' =>'Select Department');

        $CI->db->where('region_id',$id);
		$CI->db->where('status',1); 
        $query = $CI->db->get($table);
        $result =  $query->result();
        foreach ($result as $value) {
        	$options[$value->id] = getName($value->id,'tbl_department');
        	// $options[$value->id] = getName($value->id,'tbl_department');
        }
        return $options;
    }
}

// function to get name
if(!function_exists('getName')){
	function getName($id=0,$table=""){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get($table);
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->name;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}


// function added by Shiv to get title
if(!function_exists('getTitle')){
	function getTitle($id=0,$table=""){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get($table);
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->title;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}

// function to get all commune by a department id

if ( ! function_exists('getCommuneByDepartmentId')) {
    function getCommuneByDepartmentId($id=""){
        $table='tbl_commune';
        $CI =& get_instance();
        $options=array('' =>'Select Commune');
        $CI->db->where('department_id',$id);
		$CI->db->where('status',1); 
        $query = $CI->db->get($table);
        $result =  $query->result();
        foreach ($result as $value) {
        	$options[$value->id] = getName($value->id,'tbl_commune');
        }
        return $options;
    }
}

// function to get question options
if(!function_exists('getVehiclePermitOption')){
	function getVehiclePermitOption($table, $type, $status=0) {
		if($table){
			if($status==1){ 
			  CI()->db->where('status',1); 
			}
			$query = CI()->db->get($table);
			$skills =  $query->result();
			foreach ($skills as $value) {
				$options['']         = $type;
				// $options[$value->id] = word_limiter($value->question, 6 ,'..') ;
				$options[$value->id] = $value->name ;
			}
		}
		return $options;
	}
}


// function to get user role options
if(!function_exists('getUserRoleOptionForSignup')){
	function getUserRoleOptionForSignup() {
		CI()->db->where('status',1); 
		CI()->db->where('id!=',1); 
		$query   = CI()->db->get('tbl_roles');
		$skills  =  $query->result();
		foreach ($skills as $value) {
			$options['']         = 'Select User Role';
			if($value->id != 4) { // Insurance CompanyId
				$options[$value->id] = $value->name;
			}
		}
		
		return $options;
	}
}



// function to get branch id by name
if(!function_exists('getBranchIdByName')){
	function getBranchIdByName(){
	    $result="";
	    CI()->db->where('name','AUTOMOBILE');
	    CI()->db->or_where('name','automobile');
		$query = CI()->db->get('tbl_branch');
	    $count = $query->num_rows();
        if($count>0){        	
			$res =  $query->row();
			$result = $res->id;						
	    } else {
	    	 $result='';
	    }
	    return $result;
	}
}


// function to get the company id by vehicle detail id
if (!function_exists('getCompanyIdByVehicleDetailId')) {
	function getCompanyIdByVehicleDetailId($vehicle_detail_id) {
		$companyVehicleQuoteId = getCompanyVehicleQuoteId($vehicle_detail_id);
		if ($companyVehicleQuoteId!='') {
			CI()->db->where('id',$companyVehicleQuoteId);
			$query = CI()->db->get('tbl_company_vehicle_quote');
			$count = $query->num_rows();
			if ($count>0) {
				$res    = $query->row();
				$result = $res->company_id;
			}
			else {
				$result = '';
			}
		}
		else {
			$result = '';
		}
		return $result;
	}
}

// function to get the Company id By Company vehicle quote id
function getCompanyIdByCompanyVehicleQuoteId($companyVehicleQuoteId) {
	CI()->db->where('id',$companyVehicleQuoteId);
	$query = CI()->db->get('tbl_company_vehicle_quote');
	$count = $query->num_rows();
	if ($count>0) {
		$res = $query->row();
		$result = $res->company_id;
		// echo $result;
	}
	else {
		$result = '';
	}
	return $result;
}


// function to get the company vehicle quote id
function getCompanyVehicleQuoteId($vehicle_detail_id) {
	CI()->db->where('id',$vehicle_detail_id);
	$query = CI()->db->get('tbl_vehicle_detail');
	$count = $query->num_rows();
	if ($count>0) {
		$res = $query->row();
		$result = $res->company_vehicle_quote_id;
		// echo $result;
	}
	else {
		$result = '';
	}
	return $result;
}

// function to get the company id by vehicle detail id
if (!function_exists('getRisqueIdByVehicleDetailId')) {
	function getRisqueIdByVehicleDetailId($vehicle_detail_id) {
			CI()->db->where('id',$vehicle_detail_id);
			$query = CI()->db->get('tbl_vehicle_detail');
			$count = $query->num_rows();
			if ($count>0) {
				$res    = $query->row();
				$result = $res->risque_id;
			}
			else {
				$result = '';
			}
		return $result;
	}
}

// function to get the risque id by House Id
if (!function_exists('getRisqueIdByHouseId')) {
	function getRisqueIdByHouseId($house_id) {
			CI()->db->where('id',$house_id);
			$query = CI()->db->get('tbl_house_detail');
			// echo CI()->db->last_query();
			// die();
			$count = $query->num_rows();
			if ($count>0) {
				$res    = $query->row();
				$result = $res->risque_id;
			}
			else {
				$result = '';
			}
		return $result;
	}
}


// function added by Shiv to get the risque id by Credit Id
if (!function_exists('getRisqueIdByCreditId')) {
	function getRisqueIdByCreditId($credit_id) {
		CI()->db->where('id',$credit_id);
		$query = CI()->db->get('tbl_credit_detail');
		$count = $query->num_rows();
		if ($count>0) {
			$res    = $query->row();
			$result = $res->risque_id;
		}
		else {
			$result = '';
		}
		return $result;
	}
}


// function to get warranty Name
if(!function_exists('getWarrantyName')){
	function getWarrantyName($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_warranty_name');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result = $res->name;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}

// function to get Insurance Type Name
if(!function_exists('getInsuranceTypeName')){
	function getInsuranceTypeName($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_insurance_type');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result = $res->type;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}


// function to get Payment Id by Insurance type and insurer id
if(!function_exists('getPaymentIdByInsurerIdInsuranceType')){
	function getPaymentIdByInsurerIdInsuranceType($insured_id, $insurance_type_id){
	    CI()->db->where('insured_id',$insured_id);
	    CI()->db->where('insurance_type_id',$insurance_type_id);
		$query      = CI()->db->get('tbl_payment');
	    $count      = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}

// function to get the estimation amount from insurer id and insurance type id
if(!function_exists('getEstimationAmountByInsurerIdInsuranceType')){
	function getEstimationAmountByInsurerIdInsuranceType($insured_id, $insurance_type_id){
	    CI()->db->where('insured_id',$insured_id);
	    CI()->db->where('insurance_type_id',$insurance_type_id);
		$query      = CI()->db->get('tbl_payment');
	    $count      = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->total_estimation;						
	    } else {
	    	$result = 0;
	    }
	    return $result;
	}
}

// function to get franchise Name
if(!function_exists('getFranchiseName')){
	function getFranchiseName($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_franchise_name');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result = $res->name;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}

// function to get discount and year
if(!function_exists('getDiscountAndYear')){
	function getDiscountAndYear($company_id,$branch_id){
	    $result="";
	    CI()->db->select('id,year,discount');
	    CI()->db->where('company_id',$company_id);
	    CI()->db->or_where('branch_id',$branch_id);
		$query = CI()->db->get('tbl_bonus');
	    $count = $query->num_rows();
        if($count>0){        	
			$res =  $query->result();
			$result = $res;						
	    } else {
	    	 $result=array();
	    }
	    return $result;
	}
}


// function to get name
if(!function_exists('getUsageByVehicleDetailId')){
	function getUsageByVehicleDetailId($id=0,$table=""){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get($table);
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->usage;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}

// function to get name
if(!function_exists('getResqueIdByVehicleDetailId')){
	function getResqueIdByVehicleDetailId($id=0,$table=""){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get($table);
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->risque_id;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}

// function to get name
if(!function_exists('getVehicleBasicInfoIdByVehicleDetailId')){
	function getVehicleBasicInfoIdByVehicleDetailId($id=0,$table=""){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get($table);
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->vehicle_basic_info_id;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}


if(!function_exists('getTrailerByVehicleBasicInfoId')){
	function getTrailerByVehicleBasicInfoId($id=0,$table=""){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get($table);
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->trailer;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}

// franchise value will be deducted from 

		   	// function to get the warranty detail of selected companies
	if(!function_exists('getSelectedDatRecordsForSelectedCompany')) {
		function getSelectedDatRecordsForSelectedCompany($warranty_array,$company_array,$franchise_array,$selected_transported_person,$vehicle_detail_id) {
			$fleet_vehicle_count   = getFleetVehicleCount($vehicle_detail_id);
			$record                = array ();
			$usage_id   		   = getUsageByVehicleDetailId($vehicle_detail_id,'tbl_vehicle_detail');
			$risque_id 			   = getResqueIdByVehicleDetailId($vehicle_detail_id,'tbl_vehicle_detail');
			$vehicle_basic_info_id = getVehicleBasicInfoIdByVehicleDetailId($vehicle_detail_id,'tbl_vehicle_detail');
			$trailer   			   = getTrailerByVehicleBasicInfoId($vehicle_basic_info_id,'tbl_vehicle_basic_info');


			$i 	= 0;
			foreach ($company_array as $company_id) {


				if(!empty($warranty_array)) {
					foreach ($warranty_array as $warranty_id) {
						$warranty_total = 0;
						CI()->db->where('company_id',$company_id);
						CI()->db->where('warranty_name_id',$warranty_id);
						$query        = CI()->db->get('tbl_warranty');
						$count        = $query->num_rows();
						if($count>0) {
							$res      = $query->row();
							if ($res->fixed == 1 && $res->actual_catalogue == 0 ) {
								if($fleet_vehicle_count > 0) {
									$warranty_total += (1+$fleet_vehicle_count)*doubleval($res->fixed_value);
								} else {
									$warranty_total += doubleval($res->fixed_value);
								}
								//$warranty_total += doubleval($res->fixed_value);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								if($fleet_vehicle_count > 0) {
									$record[$warranty_id][$i]['value']      = (1+$fleet_vehicle_count)*doubleval($res->fixed_value);
								} else {
									$record[$warranty_id][$i]['value']      = doubleval($res->fixed_value);	
								}
								//$record[$warranty_id][$i]['value']      = doubleval($res->fixed_value);
							}
							else {
								$detail_id = CI()->uri->segment(3);
								if($fleet_vehicle_count > 0) {
									$warranty_total += (1+$fleet_vehicle_count)*getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								} else {
									$warranty_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								}
								//$warranty_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								if($fleet_vehicle_count > 0) {
									$record[$warranty_id][$i]['value']      = (1+$fleet_vehicle_count)*getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								} else {
									$record[$warranty_id][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								}
								//$record[$warranty_id][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							}
							$record[$warranty_id][$i]['warranty_name_id'] = $warranty_id;
							$record[$warranty_id][$i]['company_id']      = $res->company_id;
						}
						else {
							$record[$warranty_id][$i]['warranty_name_id'] = $warranty_id;

							$warranty_total += 0;
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;

							$record[$warranty_id][$i]['value']      = "Not Available";
							$record[$warranty_id][$i]['company_id']      = $company_id;
						}
					}
				}

				// loop over the franchises
				if (!empty($franchise_array)) {
					foreach ($franchise_array as $franchise_id) {
						$franchise_total = 0;
						CI()->db->where('company_id',$company_id);
						CI()->db->where('franchise_name_id',$franchise_id);
						$query        = CI()->db->get('tbl_franchise');
						$count        = $query->num_rows();
						if($count>0) {
							$res      = $query->row();
							if($res->fixed == 1 && $res->actual_catalogue == 0 ) {
								if($fleet_vehicle_count > 0) {
									$franchise_total += (1+$fleet_vehicle_count)*doubleval($res->fixed_value);
								} else {
									$franchise_total += doubleval($res->fixed_value);
								}
								//$franchise_total += doubleval($res->fixed_value);
								$record_total_franchise[$company_id]['franchise_total'] += $franchise_total;
								$record_total_company[$company_id]['company_total'] -= $franchise_total;
								if($fleet_vehicle_count > 0) {
									$record_franchise[$franchise_id][$i]['value']      = (1+$fleet_vehicle_count)*$res->fixed_value;
								} else {
									$record_franchise[$franchise_id][$i]['value']      = $res->fixed_value;
								}
								// $record_franchise[$franchise_id][$i]['value']      = $res->fixed_value;
							}
							else {
								$detail_id = CI()->uri->segment(3);
								if($fleet_vehicle_count > 0) {
									$franchise_total += (1+$fleet_vehicle_count)*getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								} else {
									$franchise_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);	
								}
								//$franchise_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								$record_total_franchise[$company_id]['franchise_total'] += $franchise_total;
								$record_total_company[$company_id]['company_total'] -= $franchise_total;
								if($fleet_vehicle_count > 0) {
									$record_franchise[$franchise_id][$i]['value']      = (1+$fleet_vehicle_count)*getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								} else {
									$record_franchise[$franchise_id][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								}
								// $record_franchise[$franchise_id][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							}
							$record_franchise[$franchise_id][$i]['franchise_name_id'] = $franchise_id;
							$record_franchise[$franchise_id][$i]['company_id']      = $res->company_id;
						}
						else {
							$record_franchise[$franchise_id][$i]['franchise_name_id'] = $franchise_id;

							$franchise_total += 0;
								$record_total_franchise[$company_id]['franchise_total'] += $franchise_total;
								$record_total_company[$company_id]['company_total'] -= $franchise_total;
							$record_franchise[$franchise_id][$i]['value']      = "Not Available";
							$record_franchise[$franchise_id][$i]['company_id']      = $company_id;
						}
					}
				}


				// for the transported person insurance
				if(!empty($selected_transported_person)) {
					CI()->db->where('id',$selected_transported_person);
					// CI()->db->where('company_id',$company_id);
					$query        = CI()->db->get('tbl_vehicle_trans_person_insurance');
					$count        = $query->num_rows();
					if($count>0) {
						$res      = $query->result();

						foreach ($res as $value) {
							$record_total_trans[$company_id]['trans_total'] = $value->amount_to_pay;
							$record_trans[$selected_transported_person][$i]['amount_to_pay'] = $value->amount_to_pay;
							$record_total_company[$company_id]['company_total'] +=$value->amount_to_pay;
							$record_trans[$selected_transported_person][$i]['id'] = $value->title;
						}
					}
					else {
						$record_trans[$selected_transported_person][$i]['amount_to_pay'] = "Not Available";
						$record_total_trans[$company_id]['trans_total'] = 0;
						$record_total_company[$company_id]['company_total'] +=0;
						$record_trans[$selected_transported_person][$i]['id'] = "Not Available";
					}	
				}


				// for the required fields
				$companyVehicleQuoteId  = getCompanyVehicleQuoteId($vehicle_detail_id);
				$fiscial_power_selected = getFiscialPowerByCompanyVehicleQuoteId($companyVehicleQuoteId);
				$fuel_type_selected     = getFuelTypeByCompanyVehicleQuoteId($companyVehicleQuoteId);
				// print_r($fiscial_power_selected);

				CI()->db->where('fiscal_power',$fiscial_power_selected);
				CI()->db->where('fuel_type',$fuel_type_selected);
				CI()->db->where('company_id',$company_id);
				CI()->db->where('usage',$usage_id);
				CI()->db->where('risque_id',$risque_id);
				CI()->db->where('trailer',$trailer);
				
				$query        = CI()->db->get('tbl_company_vehicle_quote');
				$count        = $query->num_rows();
				if($count>0) {
					$res      = $query->result();
					foreach ($res as $value) {

					$total = 0;
						$total+= doubleval($value->amount);
						if($fleet_vehicle_count > 0) {
							$record_total_company_quote[$company_id]['quote_total'] = (1+$fleet_vehicle_count)*$value->amount;
						} else {
							$record_total_company_quote[$company_id]['quote_total'] = $value->amount;
						}
						// $record_total_company_quote[$company_id]['quote_total'] = $value->amount;
						$record_total_company[$company_id]['company_total'] +=$total;

					}
				}
				else {
					$record_total_company_quote[$company_id]['quote_total'] = 0;
					$record_total_company[$company_id]['company_total'] +=0;
				}


				// Bonus Reduction 

				$selected_bonus_option = getSelectedBonusOptionId($vehicle_detail_id);
				if($selected_bonus_option > 0) {
					CI()->db->where('id',$selected_bonus_option);
					$query = CI()->db->get('tbl_bonus');
					$res   = $query->row();
					$count = $query->num_rows();
					if($count > 0) {
						$record_selected_bonus[$company_id]['bonus_reduction'] = $res->discount;
					} else {
						$record_selected_bonus[$company_id]['bonus_reduction'] = 0;
					}
				} else {
					$record_selected_bonus[$company_id]['bonus_reduction'] = 0;
				}

				// For Fleet Reduction
				$vehicle_fleet_option = getVehicleFleetOption($vehicle_detail_id);
				//print_r($vehicle_fleet_option);
				if(!empty($vehicle_fleet_option)) {
					$record_selected_fleet[$company_id]['fleet_reduction'] = $vehicle_fleet_option['fleet_percentage'];
				}


				// Policy Duration
				$record_policy_duration = getDaysFromVehicleDetailId($vehicle_detail_id,'tbl_selected_premium');
				$record_selected_premium[$company_id] = getPremiumRateViaCompanyDays($record_policy_duration,$company_id);
				$i++;
			}
			
// html start from here

			$html = "";
			$html.= '<div class="col-xs-12 policyCalc">';    
			$html.= '<div class="table-responsive tableTopFix">';    
			$html.= '<table class="table table-bordered">';    
			$html.= '<tbody>';    
			$html.= '<tr>';    
			$html.= '<td width="40%">';    
			$html.= 'Company';    
			$html.= '</td>';    
			

            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%" rowspan="2">';    
				$html.= '<div class="selectPlan tabelPlan">';    
				$html.= '<label>';    
				$html.= '<input type="radio" name="company_id" id="company_id_'.$data.'" value="'.$data.'" >';       
				$html.= '<h3>';    
				$html.= getCompanyName($data);    
				$html.= '</h3>';    
				// $html.= '<p class="planName">234,151</p>';    
				$html.= '</label>';    
				$html.= '</div>';    
				$html.= '</td>';   
            }

            $html.= '</tr>';            
            $html.= '<tr>';            
            $html.= '<td>';
            $html.= '<strong>';
            $html.= 'Total estimation per company';
            $html.= '</strong>';
            $html.= '</td>';            
            $html.= '</tr>';            
            $html.= '</tbody>';            
            $html.= '</table>';            
            $html.= '</div>'; 



            $html.= '<div class="table-responsive">';
            $html.= '<table class="table table-bordered">';
            $html.= '<tbody>';
            $html.= '<tr class="headTitl">';
            $html.= '<td width="40%">';
            $html.= ' <strong>';
            $html.= ' Civil responsability warranty: mandatory (A)';
            $html.= '</strong>';
            $html.= '</td>';


            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%">';
	            $html.= '<h3>';
				$html.= getCompanyName($data);    
	            $html.= '</h3>';
	            $html.= '</td>'; 
            }

            $html.= '</tr>';
            $html.= '<tr class="alignBottom">
                     <td>Its the amount of premium to pay to one company to insure a vehicule  having these specifics caracteristics value (fiscal power, gas, usage, tariff, trailor or not) </td>';
            foreach ($record_total_company_quote as $key => $value) {
	            $html.=    		'<td>';
	            $html.=    		$value['quote_total'];
	            $html.=    		'</td>';
            }
            $html.= '</tr>';
            $html.= '</tr>';
            $html.= '<td><h3>Total Civil responsability warranty</h3>
                     </td>';
            foreach ($record_total_company_quote as $key => $value) {
	            $html.= '<td>';
	            $html.= ' <h3>';
	            $html.= $value['quote_total'];
	            $html.= ' </h3>';
	            $html.= '</td>';
            }   
            $html.= '</tr>';
            $html.= '</tbody>';
            $html.= '</table>';
         	$html.= '</div>';


         	// Loop for Showing Bonus Reduction 

         	$html.= '<div class="table-responsive">';
            $html.= '<table class="table table-bordered">';
            $html.= '<tbody>';
            $html.= '<tr class="headTitl">';
            $html.= '<td width="40%">';
            $html.= ' <strong>';
            $html.= ' Bonus Reduction';
            $html.= '</strong>';
            $html.= '</td>';


            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%">';
	            $html.= '<h3>';
				$html.= getCompanyName($data);    
	            $html.= '</h3>';
	            $html.= '</td>'; 
            }

            $html.= '</tr>';
            $html.= '<tr class="alignBottom">
                     <td>Bonus Reduction </td>';
            foreach ($record_selected_bonus as $key => $value) {
	            $html.=    		'<td>';
	            $html.=    		$value['bonus_reduction']."%";
	            $html.=    		'</td>';
            }
            $html.= '</tr>';
            $html.= '</tr>';
            $html.= '<td><h3>Amount after Bonus Reduction</h3>
                     </td>';
            foreach ($company_array as $company_id) {
            	$quote_total            = $record_total_company_quote[$company_id]['quote_total'];
				$bonus_reduction        = $record_selected_bonus[$company_id]['bonus_reduction'];
				$bonus_reduction_amount = ($bonus_reduction*$quote_total)/100;
				$amount_after_bonus_reduction = ($quote_total - $bonus_reduction_amount);

	            $html.= '<td>';
	            $html.= ' <h3>';
	            $html.= $amount_after_bonus_reduction;
	            $html.= ' </h3>';
	            $html.= '</td>';
            }   
            $html.= '</tr>';
            $html.= '</tbody>';
            $html.= '</table>';
         	$html.= '</div>';


         	// Table to show trans person insurance option
            $html.= '<div class="table-responsive">';
            $html.= '<table class="table table-bordered">';
            $html.= '<tbody>';
            $html.= '<tr class="headTitl">';    
            $html.= ' <td width="40%">';
            $html.= '<strong>';
            $html.= 'Persons transported Warranties: optional (B)';
            $html.= '</strong>';
            $html.= '</td>'; 


            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%">';
	            $html.= '<h3>';
				$html.= getCompanyName($data);    
	            $html.= '</h3>';
	            $html.= '</td>'; 
            }

            $html.= '</tr>'; 

			$html.= '<tr>';
			// loop for the transported person insurance
    		foreach ($record_trans as $key => $data) {

	            $html.= '<td>';
	            $html.= getTransportedPersonInsuranceTitle($key);
	            //$html.= '<div class="selectRadioR"><label><input type="radio" name="2" value="no" ></label></div>';
	            $html.= '</td>';
	            foreach ($data as $key => $record_data) {
		            $html.= '<td>';
		            $html.=  $record_data['amount_to_pay']; 	
		            $html.= '</td>';
	            }
	            $html.= '</tr>';
    		}
	        $html.= '</tr>';

            $html.= '<tr>';
            $html.= '<td>';
            $html.= '<h3>';
            $html.= 'Total Persons transported Warranties';
            $html.= '</h3>';
            $html.= '</td>';


            foreach ($record_total_trans as $key => $data) {
	            $html.= '<td>';
	            $html.= '<h3>';
	            $html.= $data['trans_total'];
	            $html.= '</h3>';
	            $html.= '</td>';
        	}

            $html.= '</tbody>';
            $html.= '</table>';
            $html.= '</div>';




            $html.= '<div class="table-responsive">';
            $html.= '<table class="table table-bordered">';
            $html.= '<tbody>';
            $html.= '<tr class="headTitl">';               
            $html.= '<td width="40%">';
            $html.= '<strong>';
            $html.= 'Others Warranties: optional ( C )';
            $html.= '</strong>';
            $html.= '</td>';               
  
            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%">';
	            $html.= '<h3>';
				$html.= getCompanyName($data);    
	            $html.= '</h3>';
	            $html.= '</td>'; 
            }
            $html.= '</tr>';               
            $html.= '<tr>';


			foreach ($record as $key => $data) {
	            $html.= '<td>';
	            $html.= getWarrantyName($key);
	            $html.= '</td>';
	            foreach ($data as $company => $record_data) {
		            $html.= '<td class=warranty_value_'.$record_data['company_id'].'>';
		            $html.= $record_data['value'];
		            $html.= '</td>';
	            }
	            $html.='</tr>';
			}
	        $html.= '</tr>';
              
            $html.= '<tr>
                     <td>
                        <h3>Total others vehicule warranties (E)</h3>
                     </td>';

            foreach ($record_total_warranty as $key => $data) {
		            $html.=         '<td>';
		            $html.=         '<h3>';
		            $html.=         $data['warranty_total'];
		            $html.=         '</h3>';
		            $html.=         '</td>';
        	}
            $html.= '</tr>';
            $html.= '</tbody>';
            $html.= '</table>';
            $html.= '</div>'; 






            // Loop for Showing Fleet Reduction 

         	$html.= '<div class="table-responsive">';
            $html.= '<table class="table table-bordered">';
            $html.= '<tbody>';
            $html.= '<tr class="headTitl">';
            $html.= '<td width="40%">';
            $html.= ' <strong>';
            $html.= ' Fleet Reduction';
            $html.= '</strong>';
            $html.= '</td>';


            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%">';
	            $html.= '<h3>';
				$html.= getCompanyName($data);    
	            $html.= '</h3>';
	            $html.= '</td>'; 
            }

            $html.= '</tr>';
            $html.= '<tr class="alignBottom">
                     <td>Fleet Reduction </td>';
            foreach ($record_selected_fleet as $key => $value) {
	            $html.=    		'<td>';
	            $html.=    		$value['fleet_reduction']."%";
	            $html.=    		'</td>';
            }
            $html.= '</tr>';
            $html.= '</tr>';
            $html.= '<td><h3>Fleet Reduction Amount</h3></td>';
            foreach ($company_array as $company_id) {
            	$quote_total            = $record_total_company_quote[$company_id]['quote_total'];
            	$warranty_total         = $record_total_warranty[$company_id]['warranty_total'];
            	$fleet_percentage       = $record_selected_fleet[$company_id]['fleet_reduction'];
            	$fleet_reduction_amount = (($quote_total + $warranty_total)*$fleet_percentage)/100;

	            $html.= '<td>';
	            $html.= ' <h3>';
	            $html.= $fleet_reduction_amount;
	            $html.= ' </h3>';
	            $html.= '</td>';
            }   
            $html.= '</tr>';
            $html.= '</tbody>';
            $html.= '</table>';
         	$html.= '</div>';


            $html.= '<div class="table-responsive">';
            $html.= '<table class="table table-bordered">';
            $html.= '<tbody>';
            $html.= '<tr class="headTitl">';               
            $html.= '<td width="40%">';
            $html.= '<strong>';
            $html.= 'Optional franchises (D)';
            $html.= '</strong>';
            $html.= '</td>'; 



            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%">';
	            $html.= '<h3>';
				$html.= getCompanyName($data);    
	            $html.= '</h3>';
	            $html.= '</td>'; 
            }
            $html.= '</tr>';   

            $html.= '<tr>';
    		foreach ($record_franchise as $key => $data) {
	            $html.= '<td>';
	            $html.= getFranchiseName($key);
	            $html.= '</td>';

	            foreach ($data as $key => $record_data) {
		            $html.= '<td>';
		            $html.= $record_data['value'];
		            $html.= '</td>';
	            }
	            $html.= '</tr>';
    		}
	        $html.= '</tr>';


            $html.= '<tr>
                     <td>
                        <h3>Total others vehicule franchise (F)</h3>
                     </td>';


            foreach ($record_total_franchise as $key => $data) {
		            $html.=         '<td>';
		            $html.=         '<h3>';
		           $html.=         $data['franchise_total'];
		            $html.=         '</h3>';
		            $html.=         '</td>';
        	}

            $html.= '</tr>';
            $html.= '</tbody>';
            $html.= '</table>';
            $html.= '</div>'; 

            $html.= '<div class="table-responsive">';
            $html.= '<table class="table table-bordered">';
            $html.= '<tbody>';
            $html.= '<tr class="headTitl">';               
            $html.= '<td width="40%">';
            $html.= '<strong>';
            $html.= 'Company';
            $html.= '</strong>';
            $html.= '</td>'; 


            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%">';
	            $html.= '<h3>';
				$html.= getCompanyName($data);    
	            $html.= '</h3>';
	            $html.= '</td>'; 
            }
            $html.= '</tr>'; 
            $html.= '<tr>'; 
            $html.= ' <td>
                        <h3>Total estimation per company</h3>
                     </td>';
			foreach ($record_total_company as $key => $data) {

		            $html.=         '<td id="total_estimation_'.$key.'" estimation="'.($data['company_total'] - $bonus_reduction_amount - $fleet_reduction_amount).'">';
		            $html.=         '<h3>';
		            $html.=         $data['company_total'] - $bonus_reduction_amount - $fleet_reduction_amount;
		            $html.=         '</h3>';
		            $html.=         '</td>';
        	}

            $html.= '</tr>';

            $html.= '<tr>';
            $html.= ' <td>
                        <h3>Applied Premium Rate</h3>
                     </td>';

            foreach ($record_total_company as $key => $data) {
                 	$html.= '<td>';
                 	$html.= '<h3>';
                 	$html.= $record_selected_premium[$key]."%";
                 	$html.= '</h3>';
            }     
            $html.= '</tr>';

            $html.= '</tr>';

            $html.= '<tr>';
            $html.= ' <td>
                        <h3>Policy Premium Duration</h3>
                     </td>';

            foreach ($record_total_company as $key => $data) {
                 	$html.= '<td>';
                 	$html.= '<h3>';
                 	$html.= $record_policy_duration." days";
                 	$html.= '</h3>';
            }     
            $html.= '</tr>';

            $html.= '<tr>';
            $html.= ' <td>
                        <h3>Total Estimation after applying the Policy Premium Duration</h3>
                     </td>';

            foreach ($record_total_company as $key => $data) {
                 	$html.= '<td>';
                 	$html.= '<h3>';
                 	// $html.= ($record_selected_premium[$company_id])*($record_policy_duration);
                 	$html.= ($data['company_total'] - $bonus_reduction_amount - $fleet_reduction_amount)*($record_selected_premium[$company_id]/100);
                 	$html.= '</h3>';
            }     
            $html.= '</tr>';

            $html.= '</tbody>';
            $html.= '</table>';
            $html.= '</div>'; 


            $html.= '<div class="col-xs-12 text-center"><button class="subBtn" id="finalize_company">';
            $html.= getContentLanguageSelected("FINIALIZE_COMPANY",defaultSelectedLanguage());
            $html.='</button></div> ';
            $html.= '</div>';            
		   	return $html;		
		}
	}


// function to get the fiscial Power By Company vehicle quote id
function getFiscialPowerByCompanyVehicleQuoteId($companyVehicleQuoteId) {
	CI()->db->where('id',$companyVehicleQuoteId);
	$query = CI()->db->get('tbl_company_vehicle_quote');
	$count = $query->num_rows();
	if ($count>0) {
		$res = $query->row();
		$result = $res->fiscal_power;
	}
	else {
		$result = '';
	}
	return $result;
}


// function to get the fiscial Power By Company vehicle quote id
function getFuelTypeByCompanyVehicleQuoteId($companyVehicleQuoteId) {
	CI()->db->where('id',$companyVehicleQuoteId);
	$query = CI()->db->get('tbl_company_vehicle_quote');
	$count = $query->num_rows();
	if ($count>0) {
		$res = $query->row();
		$result = $res->fuel_type;
	}
	else {
		$result = '';
	}
	return $result;
}


	// function to get discount and year
if(!function_exists('getValueForPercent')){
	function getValueForPercent($percent,$type_of_vehicle,$detail_id){
	    $result="";
	    CI()->db->where('id',$detail_id);
		$query = CI()->db->get('tbl_vehicle_detail');
	    $count = $query->num_rows();
        if($count>0){        	
			$res        =  $query->row();
			if($type_of_vehicle == 0) {
				$result =  ($percent * $res->catalogue_value)/100;						
			}
			else {
				$result =  ($percent * $res->current_value)/100;						
			}
	    } else {
	    	 $result    = 0.00;
	    }
	    return $result;
	}

}

	if(!function_exists('getFinalForSelectedCompany')) {
		function getFinalForSelectedCompany($franchise_array,$warranty_array,$company_array,$vehicle_detail_id) {
			//print_r($vehicle_detail_id);
			$record = array();
			$i      = 0;
			foreach ($company_array as $company_id) {

				foreach ($warranty_array as $warranty_id) {
					CI()->db->where('company_id',$company_id);
					CI()->db->where('warranty_name_id',$warranty_id);
					$query        = CI()->db->get('tbl_warranty');
					$count        = $query->num_rows();
					if($count>0) {
						$res      = $query->row();
						if ($res->fixed == 1 && $res->actual_catalogue == 0 ) {
							$record[$i]['value']      = doubleval($res->fixed_value);
							$record[$i]['type']         = 'warranties';
							$record[$i]['name']         = getWarrantyName($warranty_id);
							$record[$i]['company_id']   = $company_id;
							$record[$i]['company_name']   = getCompanyName($company_id);
							$record[$i]['vehicle_detail_id']   = $vehicle_detail_id;
						}
						else {
							$detail_id = CI()->uri->segment(3);
							$record[$i]['value']             = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							$record[$i]['type']              = 'warranties';
							$record[$i]['name']              = getWarrantyName($warranty_id);
							$record[$i]['company_id']        = $company_id;
							$record[$i]['company_name']      = getCompanyName($company_id);
							$record[$i]['vehicle_detail_id'] = $vehicle_detail_id;
						}
					}
					else {
						$record[$i]['value']             = "Not Available";
						$record[$i]['type']              = 'warranties';
						$record[$i]['name']              = getWarrantyName($warranty_id);
						$record[$i]['company_id']        = $company_id;
						$record[$i]['company_name']      = getCompanyName($company_id);
						$record[$i]['vehicle_detail_id'] = $vehicle_detail_id;
					}
				$i++;
				}




//check the values once
// loop over the franchises
				foreach ($franchise_array as $franchise_id) {
					CI()->db->where('company_id',$company_id);
					CI()->db->where('franchise_name_id',$franchise_id);
					$query        = CI()->db->get('tbl_franchise');
					$count        = $query->num_rows();


					if($count>0) {
						$res      = $query->row();
						if($res->fixed == 1 && $res->actual_catalogue == 0 ) {
							$record[$i]['value']               = $res->fixed_value;
							$record[$i]['name']                = getFranchiseName($franchise_id);
							$record[$i]['company_id']          = $company_id;
							$record[$i]['company_name']        = getCompanyName($company_id);
							$record[$i]['type']                = 'franchise';
							$record[$i]['vehicle_detail_id']   = $vehicle_detail_id;
						}
						else {
							$detail_id = CI()->uri->segment(3);
							// echo "string";
							
							$record[$i]['value']      		 = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							$record[$i]['name'] 			 = getFranchiseName($franchise_id);
							$record[$i]['company_id']   	 = $company_id;
							$record[$i]['company_name']      = getCompanyName($company_id);
							$record[$i]['type']              = 'franchise';
							$record[$i]['vehicle_detail_id'] = $vehicle_detail_id;
						}
					}
					else {
						$record[$i]['name'] = getFranchiseName($franchise_id);
						$record[$i]['value']             = "Not Available";
						$record[$i]['company_id']   = $company_id;
						$record[$i]['company_name']      = getCompanyName($company_id);
						$record[$i]['type']              = 'franchise';
						$record[$i]['vehicle_detail_id'] = $vehicle_detail_id;

					}
					$i++;

				}

				// for the transported person insurance
				CI()->db->where('company_id',$company_id);
				$query        = CI()->db->get('tbl_vehicle_trans_person_insurance');
				$count        = $query->num_rows();
				if($count>0) {
					$res      = $query->result();
					foreach ($res as $value) {
						$record_total_trans[$company_id]['trans_total'] = $value->amount_to_pay;
						$record[$i]['value']             = $value->amount_to_pay;
						$record[$i]['name']              = $value->title;
						$record[$i]['company_id']        = $company_id;
						$record[$i]['company_name']      = getCompanyName($company_id);
						$record[$i]['type']              = 'trans_person';
						$record[$i]['vehicle_detail_id'] = $vehicle_detail_id;
					}
					$i++;
				}


				// for bonus reduction
				$selected_bonus_option   = getSelectedBonusOptionId($vehicle_detail_id);
				if($selected_bonus_option > 0) {
					CI()->db->where('id',$selected_bonus_option);
					$query_bonus  		 = CI()->db->get('tbl_bonus');
					$result_bonus 		 = $query_bonus->row();
					if($query_bonus->num_rows() > 0) {
						$bonus_reduction = $result_bonus->discount;
					} else {
						$bonus_reduction = 0;
					}
				} else {
					$bonus_reduction 	 = 0;
				}

				// for the required fields
				$companyVehicleQuoteId  = getCompanyVehicleQuoteId($vehicle_detail_id);
				$fiscial_power_selected = getFiscialPowerByCompanyVehicleQuoteId($companyVehicleQuoteId);
				$fuel_type_selected     = getFuelTypeByCompanyVehicleQuoteId($companyVehicleQuoteId);
				CI()->db->where('fiscal_power',$fiscial_power_selected);
				CI()->db->where('fuel_type',$fuel_type_selected);
				CI()->db->where('company_id',$company_id);
				
				$query        = CI()->db->get('tbl_company_vehicle_quote');
				$count        = $query->num_rows();
				if($count>0) {
					$res      = $query->result();
					foreach ($res as $value) {
						$amount_after_bonus_reduction = $value->amount - (($value->amount*$bonus_reduction)/100);
						$record[$i]['name']         = 'Required';
						// $record[$i]['value']             = $value->amount;
						$record[$i]['value'] 		= $amount_after_bonus_reduction;
						$record[$i]['company_id']   = $company_id;
						$record[$i]['company_name'] = getCompanyName($company_id);
						$record[$i]['type']         = 'required_data';
						$record[$i]['vehicle_detail_id'] = $vehicle_detail_id;
					}
					$i++;
				}
			}
			return $record;
		}
	}





// function added by Shiv to get the details for finalize company foer proffesional multi risk quote 
	if(!function_exists('getFinalForSelectedCompanyProffesionalMultiRisk')) {
		function getFinalForSelectedCompanyProffesionalMultiRisk($franchise_array,$warranty_array,$company_array,$professional_multirisk_quote_id) {
			$record = array();
			$i      = 0;
			foreach ($company_array as $company_id) {
				foreach ($warranty_array as $warranty_id) {
					CI()->db->where('company_id',$company_id);
					CI()->db->where('warranty_name_id',$warranty_id);
					$query        = CI()->db->get('tbl_warranty');
					$count        = $query->num_rows();
					if($count>0) {
						$res      = $query->row();
						if ($res->fixed == 1 && $res->actual_catalogue == 0 ) {
							$record[$i]['value']                    = doubleval($res->fixed_value);
							$record[$i]['type']        			    = 'warranties';
							$record[$i]['name']         			= getWarrantyName($warranty_id);
							$record[$i]['company_id']   			= $company_id;
							$record[$i]['company_name']   			= getCompanyName($company_id);
							$record[$i]['professional_multirisk_quote_id']   = $professional_multirisk_quote_id;
						}
						else {
							$detail_id = CI()->uri->segment(4);
							$record[$i]['value']                    = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							$record[$i]['type']                     = 'warranties';
							$record[$i]['name']                     = getWarrantyName($warranty_id);
							$record[$i]['company_id']   			= $company_id;
							$record[$i]['company_name'] 		    = getCompanyName($company_id);
							$record[$i]['professional_multirisk_quote_id']   = $professional_multirisk_quote_id;
						}
					}
					else {
						$record[$i]['value']         = "Not Available";
						$record[$i]['type']          = 'warranties';
						$record[$i]['name']          = getWarrantyName($warranty_id);
						$record[$i]['company_id']   			= $company_id;
						$record[$i]['company_name']    = getCompanyName($company_id);
						$record[$i]['professional_multirisk_quote_id']   = $professional_multirisk_quote_id;
					}
					$i++;
				}

				foreach ($franchise_array as $franchise_id) {
					CI()->db->where('company_id',$company_id);
					CI()->db->where('franchise_name_id',$franchise_id);
					$query        = CI()->db->get('tbl_franchise');
					$count        = $query->num_rows();


					if($count>0) {
						$res      = $query->row();
						if($res->fixed == 1 && $res->actual_catalogue == 0 ) {
							$record[$i]['value']               		= $res->fixed_value;
							$record[$i]['name']                		= getFranchiseName($franchise_id);
							$record[$i]['company_id']   			= $company_id;
							$record[$i]['company_name']        		= getCompanyName($company_id);
							$record[$i]['type']                		= 'franchise';
							$record[$i]['professional_multirisk_quote_id']   = $professional_multirisk_quote_id;
						}
						else {
							$detail_id = CI()->uri->segment(4);
							
							$record[$i]['value']      		        = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							$record[$i]['name'] 		            = getFranchiseName($franchise_id);
							$record[$i]['company_id']   			= $company_id;
							$record[$i]['company_name']        		= getCompanyName($company_id);
							$record[$i]['type']                		= 'franchise';
							$record[$i]['professional_multirisk_quote_id']   = $professional_multirisk_quote_id;
						}
					}
					else {
						$record[$i]['name'] 	    = getFranchiseName($franchise_id);
						$record[$i]['value']        = "Not Available";
						$record[$i]['company_id']   = $company_id;
						$record[$i]['company_name'] = getCompanyName($company_id);
						$record[$i]['type']         = 'franchise';
						$record[$i]['professional_multirisk_quote_id'] = $professional_multirisk_quote_id;

					}
					$i++;
				}

				// selected option
	             $proffesional_multirisk_quote_data = getProffesionalMultiRiskDetailRecordByDetailId($proffesional_multirisk_quote_id);
				if (!empty($proffesional_multirisk_quote_data)) {
					$value = $proffesional_multirisk_quote_data;
					$record[$i]['name'] = 'Required';
					$record[$i]['value'] = $value->capital_insured;
					$record[$i]['company_id'] = $company_id;
					$record[$i]['company_name'] = getCompanyName($company_id);
					$record[$i]['type'] = 'required_data';
					$record[$i]['proffesional_multirisk_quote_id'] = $proffesional_multirisk_quote_id;
				}
				$i++;
			}
			return $record;
		}
	}




// function to get accessories Id
if(!function_exists('getAccessoriesId')){
	function getAccessoriesId($net_premium,$company_id,$branch_id){
	    $result="";
	   	// $branch_id = getBranchIdByName();
	   	CI()->db->where('minimum_premium<=',$net_premium);
	    CI()->db->where('maximum_premium>=',doubleval($net_premium));
	    CI()->db->where('company_id',$company_id);
	    CI()->db->where('branch_id',$branch_id);
		$query = CI()->db->get('tbl_accessories');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->id;						
	    } else {
	    	$result = 0;
	    }
	    return $result;
	}
}

// function to get accessories Value
if(!function_exists('getAccessoriesValue')){
	function getAccessoriesValue($net_premium,$company_id,$branch_id){
	    $result="";
	   	// $branch_id = getBranchIdByName();
	   	CI()->db->where('minimum_premium<=',$net_premium);
	    CI()->db->where('maximum_premium>=',doubleval($net_premium));
	    CI()->db->where('company_id',$company_id);
	    CI()->db->where('branch_id',$branch_id);
		CI()->db->where('status',1); 
		$query = CI()->db->get('tbl_accessories');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->amount;						
	    } else {
	    	$result = 0;
	    }
	    return $result;
	}
}


// function added by Shiv to get tax amount
if (!function_exists('getTaxAmount')) {

    function getTaxAmount($net_premium_total_amount,$company_id,$branch_id) {
        CI()->db->where('company_id', $company_id);
        CI()->db->where('branch_id', $branch_id);
        $query = CI()->db->get('tbl_accessories');
        $count = $query->num_rows();
        if ($count > 0) {
            $res = $query->row();
            $result = ($res->tax_percent * $net_premium_total_amount) / 100;
        } else {
            $result = 0;
        }
        return $result;
    }
}

// function to get Transorted Person Insurance Title
if(!function_exists('getTransportedPersonInsuranceTitle')){
	function getTransportedPersonInsuranceTitle($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			CI()->db->where('status',1); 
			$query = CI()->db->get('tbl_vehicle_trans_person_insurance');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->title;						
		    } else {
		    	$result='';
		    }
	    }
	    return $result;
	}
}



// function added by Shiv to get people insured options in travel insurance module
if(!function_exists('getPeopleOptions')) {
	function getPeopleOptions($type) {
		$options['']          = $type;
		$options['1']         = 1;
		$options['2']         = 2;
		$options['3']         = 3;
		$options['4']         = 4;
		$options['5']         = 5;
		$options['6']         = 6;
		$options['7']         = 7;
		$options['8']         = 8;
		$options['9']         = 9;
		$options['10']        = 10;
		return $options;
	}
}

// function added by Shiv to get the no of persons insured options
if(!function_exists('getPersonsOptions')) {
	function getPersonsOptions($type) {
		$options['']         = $type;
		$options['1']         = 1;
		$options['2']         = 2;
		$options['3']         = 3;
		$options['4']         = 4;
		$options['5']         = 5;
		$options['6']         = 6;
		$options['7']         = 7;
		$options['8']         = 8;
		$options['9']         = 9;
		$options['10']        = 10;
		return $options;
	}
}


// function added by Shiv to get total number of travelers in travel insurance module
if(!function_exists('getTravelerOptions')) {
	function getTravelerOptions($type) {
		$options['']         = $type;
		$options['1']         = 1;
		$options['2']         = 2;
		$options['3']         = 3;
		$options['4']         = 4;
		$options['5']         = 5;
		$options['6']         = 6;
		$options['7']         = 7;
		$options['8']         = 8;
		$options['9']         = 9;
		$options['10']        = 10;
		return $options;
	}
}

// function added by Shiv to get travel examination list
if(!function_exists('getTravelExaminationList')){
	function getTravelExaminationList() {
	    // $result="";
		CI()->db->where('status',1); 
		$query = CI()->db->get('tbl_travel');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->result();
			foreach ($res as $value) {
				$result[] = $value->id;						
			}
	    } else {
	    	$result = array();
	    }
	    return $result;
	}
}


// function added by Shiv to get individual accident examination list
if(!function_exists('getIndividualAccidentExaminationList')){
	function getIndividualAccidentExaminationList(){
		CI()->db->where('status',1); 
		$query = CI()->db->get('tbl_individual_accident_insurance_options');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->result();
			foreach ($res as $value) {
				$result[] = $value->id;						
			}
	    } else {
	    	$result = array();
	    }
	    return $result;
	}
}



// function added by Shiv to get health insurence examination list
if(!function_exists('getHealthInsuranceExaminationList')){
	function getHealthInsuranceExaminationList(){
		CI()->db->where('status',1); 
		$query = CI()->db->get('tbl_health_insurance');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->result();
			foreach ($res as $value) {
				$result[] = $value->id;						
			}
	    } else {
	    	$result = array();
	    }
	    return $result;
	}
}


// function added by Shiv to get the health insurance type id
if(!function_exists('getHealthInsuranceTypeId')) {
	function getHealthInsuranceTypeId($id) {
		CI()->db->where('id',$id);
		$query = CI()->db->get('tbl_health_insurance_details');
		if($query->num_rows() > 0) {
			$res 	= $query->row();
			$result = $res->health_insurance_type_id;
		} else {
			$result = '';
		}
		return $result;
	}
}

	
	
// function added by Shiv to get the no of persons insured
if(!function_exists('getNumberOfPersonsInsuredByHealthInsuranceId')) {
	function getNumberOfPersonsInsuredByHealthInsuranceId($id) {
		CI()->db->where('id',$id);
		$query = CI()->db->get('tbl_health_insurance_details');
		if($query->num_rows() > 0) {
			$res 	= $query->row();
			$result = $res->persons_insured;
		} else {
			$result = '';
		}
		return $result;
	}
}


// function added by Shiv to get company ids
if(!function_exists('getCompanyIds')){
	function getCompanyIds() {
		// if($table){
			// if($status==1){ 
			  CI()->db->where('status',1); 
			// }
			$query = CI()->db->get('tbl_company');
			$skills =  $query->result();
			foreach ($skills as $value) {
				$options[] = $value->id;
			}
		// }
		return $options;
	}
}


// function added by Shiv to get the warranty detail of selected companies
	if(!function_exists('getTravelInsuranceCompanyComparision')) {
		function getTravelInsuranceCompanyComparision($travel_examination_list_array = "",$company_array="",$travel_detail_id) {
			$record = array();
			$i      = 0;
			foreach ($company_array as $company_id) {
				// loop over the tracel examinationList
				if(!empty($company_array)) {

					$days_to_travel      = getNumberOfDaysToTravel($travel_detail_id);
				    $travel_quote_record = getTravelQuoteRecordByCompanyId($company_id,$days_to_travel);
				    $agesOfInsuredPerson = getAgesOfInsuredPersonTravelByTravelId($travel_detail_id);
				    $company_name        = getCompanyName($company_id);
				    $amount['child'][$i]    = 0;
				    $amount['adult'][$i]    = 0;
				    $amount['surprime'][$i] = 0;
				    $total_person_amount[$i] = 0;
				    foreach ($agesOfInsuredPerson as $value) {
				        if (!empty($travel_quote_record)) {
							if($value <= $travel_quote_record->child_below_age  ) {
								$amount['child'][$i] += $travel_quote_record->amount_child_below_age;
								$total_person_amount[$i] += $travel_quote_record->amount_child_below_age;
								$record_total_company[$company_id]['total_person_amount'] += $travel_quote_record->amount_child_below_age;
								$person['child'] += 1;
							} else if($value >= $travel_quote_record->adult_above_age && $value <=$travel_quote_record->surprime_above_age) {
					            $amount['adult'][$i] += $travel_quote_record->amount_adult_above_age;
					            $total_person_amount[$i] += $travel_quote_record->amount_adult_above_age;
					            $record_total_company[$company_id]['total_person_amount'] += $travel_quote_record->amount_adult_above_age;
					            $person['adult'] += 1;
				         	} else {
					            $amount['surprime'][$i] += $travel_quote_record->amount_surprime_above_age;
					            $total_person_amount[$i] += $travel_quote_record->amount_surprime_above_age;
					            $record_total_company[$company_id]['total_person_amount'] += $travel_quote_record->amount_surprime_above_age;
					            $person['surprime'] += 1;
					 		}
						}
					    else {
							$amount['child'][$i]      = 0;
							$amount['adult'][$i]      = 0;
							$amount['surprime'][$i]   = 0;
							$total_person_amount[$i]  = 0;
							$record_total_company[$company_id]['total_person_amount'] = 0;
				        }
				    }
			
					// Calculating Estimation Amount for the companies    
					foreach ($travel_examination_list_array as $travel_id) {
						$examination_total = 0;
						CI()->db->where('company_id',$company_id);
						CI()->db->where('id',$travel_id);
						$query        = CI()->db->get('tbl_travel');
						$count        = $query->num_rows();
						if($count>0) {
							$res      = $query->row();
							$examination_total += doubleval($res->amount);
							$record_total_examination_list[$company_id]['examination_total'] += $examination_total;
							$record_total_company[$company_id]['company_total'] += $examination_total;
							$record[$travel_id][$i]['value']      = doubleval($res->amount);
							$record[$travel_id][$i]['value']      = $res->amount;;
							$record[$travel_id][$i]['travel_id']  = $travel_id;
							$record[$travel_id][$i]['company_id'] = $res->company_id;
						}
						else {
							$record[$travel_id][$i]['travel_id']  = $travel_id;
							$record[$travel_id][$i]['value']      = "Not Available";
							$record[$travel_id][$i]['company_id'] = $company_id;
							$examination_total += 0;
							$record_total_examination_list[$company_id]['examination_total'] += $examination_total;
							$record_total_company[$company_id]['company_total'] += $examination_total;
						}
					}
				}	
				$i++;
			}

			$y = 0;
 			foreach ($record_total_company as $key => $data) {
 				$amountof['required_amount'][$y] = $data['company_total'] + $data['total_person_amount'];
 				$y++;
 			}


			// html start from here

			$html = "";
		
            // Table for Person Amount 


            $html.= '<div class="table-responsive ">';
            $html.= '<table id="example2" class="table table-bordered">';
            $html.= '<thead>';
            $html.= '<tr>';
            $html.= '<th>LIST</th>';    
            	// loop for company name     
           	foreach ($company_array as $key => $data) {       
           		if($record_total_company[$data]['total_person_amount'] != 0) {
					$html.= '<th>';
					$html.= getCompanyName($data);
					$html.= '</th>';
           		}
           	}
           	$html.= '</tr>';
            $html.= '</thead>';

            $html.= '<tbody>';
          	$html.= '<tr><td></td></tr>';

            $html.= '<tr>';

 			// print_r($amount['child']);
 		
 			
        	foreach ($amount as $key => $data) {
	            $html.=         '<td>';
	            $html.=         $key;
	            $html.=         '</td>';
	            foreach ($data as $key => $record_data) {

	            	if($amountof['required_amount'][$key] != 0) {
		            	$html.=  '<td>';
		           	 	$html.=  $record_data;
		            	$html.=  '</td>';
		        	}
	            }
            	$html.= '</tr>';
            }

          	$html.= '<tr><td></td></tr>';
			// showing the over all result of company 
            $html.= '<tr>';
            $html.= '<td class="make_bold"><strong>Total Person Amount per company</strong></td>';
			foreach ($total_person_amount as $key => $data) {
				if( ($amountof['required_amount'][$key]) != 0 ) {
		            $html.=  '<td class="make_bold">';
		            $html.=	 '<h3>';
		            $html.=  $data;
		            $html.=	 '</h3>';
		            $html.=  '</td>';
				}
        	}
            $html.= '</tr>';

            $html.= '<tr><td></td></tr>';
			// showing the net premium for the company 
            $html.= '<tr>';
            $html.= '<td class="make_bold"><strong>Net Premium per company</strong></td>';
			foreach ($record_total_company as $key => $data) {
				if(($data['company_total'] + $data['total_person_amount']) != 0 ) {
		            $html.= '<td class="make_bold">';
		            $html.=	'<h3>';
		            $html.= $data['company_total'] + $data['total_person_amount'];
		            $html.=	'</h3>';
		            $html.= '</td>';					
				}
        	}
            $html.= '</tr>';
          	$html.= '</tbody>';
            $html.= '</table>';
            $html.= '</div>';



            // Showing Estimation covered for the companies
            $html.= '<div class="table-responsive">';
            $html.= '<table id="example2" class="table table-bordered">';
            $html.= '<thead>';
            $html.= '<tr>';
            $html.= '<th>LIST</th>';    
            	// loop for company name     
           	foreach ($company_array as $key => $data) { 
           		if($amountof['required_amount'][$key] != 0) {    
					$html.= '<th>';
					$html.= '<input value="'.$data.'" type="radio" name="company_id" class="selected_company_travel"/>';
					$html.= getCompanyName($data);
					$html.= '</th>';
				}
           	}
           	$html.= '</tr>';
            $html.= '</thead>';
            $html.= '<tbody>';
          	$html.= '<tr><td></td></tr>';

            $html.= '<tr>';
        	foreach ($record as $key => $data) {
	            $html.=         '<td>';
	            $html.=         getName($key,'tbl_travel');
	            $html.=         '</td>';
	            
	            foreach ($data as $key => $record_data) {
		            if($amountof['required_amount'][$key] != 0) {
			            $html.=  '<td>';
			            $html.=  $record_data['value'];
			            $html.=  '</td>';
		            }
	            }
            $html.= '</tr>';
            }

          	$html.= '<tr><td></td></tr>';
			// showing the over all result of company 
            $html.= '<tr>';
            $html.= '<td class="make_bold"><strong>Total Estimation per company</strong></td>';
			foreach ($record_total_company as $key => $data) {
				if(($data['company_total'] + $data['total_person_amount']) != 0) {
					$html.=  '<td class="make_bold">';
	           	 	$html.=	 '<h3>';
	            	$html.=  $data['company_total'];
	            	$html.=	 '</h3>';
	            	$html.=  '</td>';	
				}
	            
        	}
            $html.= '</tr>';
            $html.= '</tbody>';
            $html.= '</table>';
            $html.= '</div>';




		return $html;
	}
}



// function added by Shiv to get the warranty detail of selected companies
	if(!function_exists('getIndividualAccidentCompanyComparision')) {
		function getIndividualAccidentCompanyComparision($individual_accident_examination_list_array = "",$company_array="") {
			$record = array();
			$i      = 0;
			foreach ($company_array as $company_id) {
				// loop over the tracel examinationList
				if(!empty($company_array)) {
					foreach ($individual_accident_examination_list_array as $individual_accident_insurance_option_id) {
						// print_r($travel_id);
						$examination_total = 0;
						CI()->db->where('company_id',$company_id);
						CI()->db->where('id',$individual_accident_insurance_option_id);
						$query        = CI()->db->get('tbl_individual_accident_insurance_options');
						$count        = $query->num_rows();
						if($count>0) {
							$res      = $query->row();
							$examination_total += doubleval($res->amount_to_pay);
							$record_total_examination_list[$company_id]['examination_total'] += $examination_total;
							$record_total_company[$company_id]['company_total'] += $examination_total;
							$record[$individual_accident_insurance_option_id][$i]['value']      = doubleval($res->amount_to_pay);
							$record[$individual_accident_insurance_option_id][$i]['value']      = $res->amount_to_pay;;
							$record[$individual_accident_insurance_option_id][$i]['individual_accident_insurance_option_id']  = $individual_accident_insurance_option_id;
							$record[$individual_accident_insurance_option_id][$i]['company_id'] = $res->company_id;
						}
						else {
							$record[$individual_accident_insurance_option_id][$i]['individual_accident_insurance_option_id']  = $individual_accident_insurance_option_id;
							$record[$individual_accident_insurance_option_id][$i]['value']      = "Not Available";
							$record[$individual_accident_insurance_option_id][$i]['company_id'] = $company_id;
							$examination_total += 0;
							$record_total_examination_list[$company_id]['examination_total'] += $examination_total;
							$record_total_company[$company_id]['company_total'] += $examination_total;
						}
					}
				}	
				$i++;
			}
			// html start from here

			$html = "";
			/*$html.= '<div class="col-xs-12 policyCalc">';*/
            $html.= '<div class="table-responsive tableTopFix">';
            $html.= '<table id="example2" class="table table-bordered">';
            $html.= '<thead>';
            $html.= '<tr>';
            $html.= '<th>LIST</th>';    
            	// loop for company name     
           	foreach ($company_array as $key => $data) {    
           		if($record_total_company[$data]['company_total'] != 0) {
           			$html.= '<th>';
					$html.= '<input value="'.$data.'" type="radio" name="company_id" class="selected_company_individual_accident"/>';
					$html.= getCompanyName($data);
					$html.= '</th>';
           		}   
           	}
           	$html.= '</tr>';
            $html.= '</thead>';
            $html.= '<tbody>';
          	$html.= '<tr><td></td></tr>';

            $html.= '<tr>';
        	foreach ($record as $key => $data) {
	            $html.=         '<td>';
	            $html.=         getTitle($key,'tbl_individual_accident_insurance_options');
	            $html.=         '</td>';
	            foreach ($data as $key => $record_data) {
	            	if($record_total_company[$record_data['company_id']]['company_total'] != 0) {
		            	$html.=         '<td>';
		            	$html.=         $record_data['value'];
		            	$html.=         '</td>';
		        	}	
	            }
            $html.= '</tr>';
            }

          	$html.= '<tr><td></td></tr>';
			// showing the over all result of company 
            $html.= '<tr>';
            $html.= '<td class="make_bold"><strong>Total Estimation per company</strong></td>';
			foreach ($record_total_company as $key => $data) {
				if($data['company_total'] != 0) {
		            $html.=         '<td class="make_bold">';
		            $html.=			'<h3>';
		            $html.=         $data['company_total'];
		            $html.=			'</h3>';
		            $html.=         '</td>';
				}
        	}
            $html.= '</tr>';
            $html.= '</tbody>';
            $html.= '</table>';
            $html.= '</div>';
            /*$html.= '</div>';*/
		return $html;
	}
}


// function added by Shiv to get the health insurance estimations of selected companies
	if(!function_exists('getHealthInsuranceCompanyComparision')) {
		function getHealthInsuranceCompanyComparision($health_insurance_examination_list_array = "",$company_array="",$health_insurance_detail_id) {
			$record = array();
			$i      = 0;
			foreach ($company_array as $company_id) {
				// loop over the tracel examinationList
				if(!empty($company_array)) {

					$days_to_health_insurance = getNumberOfDaysToHealthInsurance($health_insurance_detail_id);

				    $health_quote_record      = getHealthInsuranceQuoteRecordByCompanyId($company_id,$days_to_health_insurance);
  
   					$agesOfInsuredPerson 	  = getAgesOfInsuredPersonHealthByHealthId($health_insurance_detail_id);
				    $company_name             = getCompanyName($company_id);
				    $amount['child'][$i]    = 0;
				    $amount['adult'][$i]    = 0;
				    $amount['surprime'][$i] = 0;
				    $total_person_amount[$i] = 0;
				    foreach ($agesOfInsuredPerson as $value) {
				        if (!empty($health_quote_record)) {
							if($value <= $health_quote_record->child_below_age  ) {
								$amount['child'][$i] += $health_quote_record->amount_child_below_age;
								$total_person_amount[$i] += $health_quote_record->amount_child_below_age;
								$record_total_company[$company_id]['total_person_amount'] += $health_quote_record->amount_child_below_age;
								$person['child'] += 1;
							} else if($value >= $health_quote_record->adult_above_age && $value <=$health_quote_record->surprime_above_age) {
					            $amount['adult'][$i] += $health_quote_record->amount_adult_above_age;
					            $total_person_amount[$i] += $health_quote_record->amount_adult_above_age;
					            $record_total_company[$company_id]['total_person_amount'] += $health_quote_record->amount_adult_above_age;
					            $person['adult'] += 1;
				         	} else {
					            $amount['surprime'][$i] += $health_quote_record->amount_surprime_above_age;
					            $total_person_amount[$i] += $health_quote_record->amount_surprime_above_age;
					            $record_total_company[$company_id]['total_person_amount'] += $health_quote_record->amount_surprime_above_age;
					            $person['surprime'] += 1;
					 		}
						}
					    else {
							$amount['child'][$i]      = 0;
							$amount['adult'][$i]      = 0;
							$amount['surprime'][$i]   = 0;
							$total_person_amount[$i]  = 0;
							$record_total_company[$company_id]['total_person_amount'] = 0;
				        }
				    } 

					// Calculating the estimation amount for the companies
					foreach ($health_insurance_examination_list_array as $health_insurance_id) {
						// print_r($travel_id);
						$examination_total = 0;
						CI()->db->where('company_id',$company_id);
						CI()->db->where('id',$health_insurance_id);
						$query        = CI()->db->get('tbl_health_insurance');
						$count        = $query->num_rows();
						if($count>0) {
							$res      = $query->row();
							$examination_total += doubleval($res->amount);
							$record_total_examination_list[$company_id]['examination_total'] += $examination_total;
							$record_total_company[$company_id]['company_total'] += $examination_total;
							$record[$health_insurance_id][$i]['value']      = doubleval($res->amount);
							$record[$health_insurance_id][$i]['value']      = $res->amount;;
							$record[$health_insurance_id][$i]['health_insurance_id']  = $health_insurance_id;
							$record[$health_insurance_id][$i]['company_id'] = $res->company_id;
						}
						else {
							$record[$health_insurance_id][$i]['health_insurance_id']  = $health_insurance_id;
							$record[$health_insurance_id][$i]['value']      = "Not Available";
							$record[$health_insurance_id][$i]['company_id'] = $company_id;
							$examination_total += 0;
							$record_total_examination_list[$company_id]['examination_total'] += $examination_total;
							$record_total_company[$company_id]['company_total'] += $examination_total;
						}
					}
				}	
				$i++;
			}
			// html start from here

			$y = 0;
 			foreach ($record_total_company as $key => $data) {
 				$amountof['required_amount'][$y] = $data['company_total'] + $data['total_person_amount'];
 				$y++;
 			}

			$html = "";
			/*$html.= '<div class="col-xs-12 policyCalc">';*/
            $html.= '<div class="table-responsive">';
            $html.= '<table id="example2" class="table table-bordered">';
            $html.= '<thead>';
            $html.= '<tr>';
            $html.= '<th>LIST</th>';    
            	// loop for company name     
           	foreach ($company_array as $key => $data) {       
           		if($amountof['required_amount'][$key] != 0) {
           			$html.= '<th>';
					$html.= '<input value="'.$data.'" type="radio" name="company_id" class="selected_company_health_insurance"/>';
					$html.= getCompanyName($data);
					$html.= '</th>';
           		}
           	}
           	$html.= '</tr>';
            $html.= '</thead>';
            $html.= '<tbody>';
          	$html.= '<tr><td></td></tr>';

            $html.= '<tr>';
        	foreach ($record as $key => $data) {
	            $html.=         '<td>';
	            $html.=         getName($key,'tbl_health_insurance');
	            $html.=         '</td>';
	            foreach ($data as $key => $record_data) {
	            	if($amountof['required_amount'][$key] != 0) {
			            $html.=         '<td>';
			            $html.=         $record_data['value'];
			            $html.=         '</td>';
			        }
	            }
            $html.= '</tr>';
            }

          	$html.= '<tr><td></td></tr>';
			// showing the over all result of company 
            $html.= '<tr>';
            $html.= '<td class="make_bold"><strong>Total Estimation per company</strong></td>';
			foreach ($record_total_company as $key => $data) {
				if( ($data['company_total'] + $data['total_person_amount']) != 0) {
					$html.=         '<td class="make_bold">';
		            $html.=			'<h3>';
		            $html.=         $data['company_total'];
		            $html.=			'</h3>';
		            $html.=         '</td>';
				}
        	}
            $html.= '</tr>';
            $html.= '</tbody>';
            $html.= '</table>';
            $html.= '</div>';
            /*$html.= '</div>';*/

            // Table for Person Amount 

            $html.= '<div class="table-responsive ">';
            $html.= '<table id="example2" class="table table-bordered">';
            $html.= '<thead>';
            $html.= '<tr>';
            $html.= '<th>LIST</th>';    
            	// loop for company name     
           	foreach ($company_array as $key => $data) { 
           		if($amountof['required_amount'][$key] != 0) {
					$html.= '<th>';
					$html.= getCompanyName($data);
					$html.= '</th>';           			
           		}      
           	}
           	$html.= '</tr>';
            $html.= '</thead>';

            $html.= '<tbody>';
          	$html.= '<tr><td></td></tr>';

            $html.= '<tr>';
        	foreach ($amount as $key => $data) {
	            $html.=         '<td>';
	            $html.=         $key;
	            $html.=         '</td>';
	            foreach ($data as $key => $record_data) {
	            	if($amountof['required_amount'][$key] != 0) {
	            		$html.=         '<td>';
		            	$html.=         $record_data;
		            	$html.=         '</td>';
	            	}
	            }
            	$html.= '</tr>';
            }

          	$html.= '<tr><td></td></tr>';
			// showing the over all result of company 
            $html.= '<tr>';
            $html.= '<td class="make_bold"><strong>Total Person Amount per company</strong></td>';
			foreach ($total_person_amount as $key => $data) {
				if($amountof['required_amount'][$key] != 0) {
		            $html.=         '<td class="make_bold">';
		            $html.=			'<h3>';
		            $html.=         $data;
		            $html.=			'</h3>';
		            $html.=         '</td>';
				}
        	}
            $html.= '</tr>';

            $html.= '<tr><td></td></tr>';
            
			// showing the net premium for the company 
            $html.= '<tr>';
            $html.= '<td class="make_bold"><strong>Net Premium per company</strong></td>';
			foreach ($record_total_company as $key => $data) {
				if( ($data['company_total'] + $data['total_person_amount']) > 0) {
		            $html.= '<td class="make_bold">';
		            $html.=	'<h3>';
		            // $html.= $data['company_total'] + $data['total_person_amount'];
		            $html.= $data['total_person_amount'];
		            $html.=	'</h3>';
		            $html.= '</td>';
				}
        	}
            $html.= '</tr>';
          	$html.= '</tbody>';
            $html.= '</table>';
            $html.= '</div>';

		return $html;
	}
}








// function added by Shiv to get data for selected company for proffesional multirisk 

	if(!function_exists('getSelectedDatRecordsForSelectedCompanyForProffesionalMultiRisk')) {
		function getSelectedDatRecordsForSelectedCompanyForProffesionalMultiRisk($warranty_array,$company_array,$franchise_array,$professional_multirisk_quote_id) {
			$record = array();
			$i      = 0;
			foreach ($company_array as $company_id) {
				// loop over the warranty
				if(!empty($company_array)) {
					foreach ($warranty_array as $warranty_id) {
						//print_r($warranty_id);
						$warranty_total = 0;
						CI()->db->where('company_id',$company_id);
						CI()->db->where('warranty_name_id',$warranty_id);
						$query        = CI()->db->get('tbl_warranty');
						$count        = $query->num_rows();
						if($count>0) {
							$res      = $query->row();
							if ($res->fixed == 1 && $res->actual_catalogue == 0 ) {
								$warranty_total += doubleval($res->fixed_value);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								$record[$warranty_id][$i]['value']      = doubleval($res->fixed_value);
							}
							else {
								$detail_id = CI()->uri->segment(4);
								$warranty_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								$record[$warranty_id][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							}
							$record[$warranty_id][$i]['warranty_name_id'] = $warranty_id;
							$record[$warranty_id][$i]['company_id']      = $res->company_id;
						}
						else {
							$record[$warranty_id][$i]['warranty_name_id'] = $warranty_id;

							$warranty_total += 0;
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;

							$record[$warranty_id][$i]['value']      = "Not Available";
							$record[$warranty_id][$i]['company_id']      = $company_id;
						}
					}
				}	

				// loop over the franchises
				if (!empty($franchise_array)) {
					foreach ($franchise_array as $franchise_id) {
						$franchise_total = 0;
						CI()->db->where('company_id',$company_id);
						CI()->db->where('franchise_name_id',$franchise_id);
						$query        = CI()->db->get('tbl_franchise');
						$count        = $query->num_rows();
						if($count>0) {
							$res      = $query->row();
							if($res->fixed == 1 && $res->actual_catalogue == 0 ) {
								$franchise_total += doubleval($res->fixed_value);
								$record_total_franchise[$company_id]['franchise_total'] += $franchise_total;
								$record_total_company[$company_id]['company_total'] -= $franchise_total;
								$record_franchise[$franchise_id][$i]['value']      = $res->fixed_value;
							}
							else {
								$detail_id = CI()->uri->segment(4);
								$franchise_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								$record_total_franchise[$company_id]['franchise_total'] += $franchise_total;
								$record_total_company[$company_id]['company_total'] -= $franchise_total;
								$record_franchise[$franchise_id][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							}
							$record_franchise[$franchise_id][$i]['franchise_name_id'] = $franchise_id;
							$record_franchise[$franchise_id][$i]['company_id']      = $res->company_id;
						}
						else {
							$record_franchise[$franchise_id][$i]['franchise_name_id'] = $franchise_id;

							$franchise_total += 0;
								$record_total_franchise[$company_id]['franchise_total'] += $franchise_total;
								$record_total_company[$company_id]['company_total'] -= $franchise_total;
							$record_franchise[$franchise_id][$i]['value']      = "Not Available";
							$record_franchise[$franchise_id][$i]['company_id']      = $company_id;
						}
					}
				}

				$professional_multirisk_quote_data = getProffesionalMultiRiskDetailRecordByDetailId($professional_multirisk_quote_id);
				if(!empty($professional_multirisk_quote_data)) {
					$value = $professional_multirisk_quote_data;
					if($value->company_selected == $company_id) {
						$record_total_company[$company_id]['company_total'] += $value->capital_insured;
							
						$result_data__[$professional_multirisk_quote_id][$i]['amount']     = $value->capital_insured;
					}
					else {
					
						$result_data__[$professional_multirisk_quote_id][$i]['amount']     = "Not Available";
						$record_total_company[$company_id]['company_total'] += 0;
					}
				}
				/*if (!empty($proffesional_multirisk_quote_data)) {
					$i      = 0;
					$result = $proffesional_multirisk_quote_data;
					foreach ($result as $value) {
						$record_total_company[$company_id]['company_total'] += $value->capital_insured;
						
						$result_data__[$proffesional_multirisk_quote_id][$i]['amount']     = $value->capital_insured;
					}
				}*/
				$i++;
			}


// html start from here

			$html = "";
			$html.= '<div class="col-xs-12 policyCalc">
                  <div class="table-responsive tableTopFix">
                    <table class="table table-bordered">
                        <tbody>
                           	<tr>
                            	<td width="40%">Company</td>';    
                            	// loop for company name     
                           	foreach ($company_array as $key => $data) {       
            					$html.= '<td width="12%" rowspan="2">';
            					$html.= '<div class="selectPlan tabelPlan">';    
								$html.= '<label>';   
            					$html.= '<input value="'.$data.'" type="radio" name="company_id" id="company_id_professional_multirisk_'.$data.'" class="selected_companyR"/>';
            					$html.= '<h3>';
            					$html.= getCompanyName($data);
            					$html.= '</h3>';
            					$html.= '</label>';
            					$html.= '</div>';
            					$html.= '</td>';
                           	}
                           	$html.= '</tr>';
				$html.= '<tr>';            
            	$html.= '<td>';
            	$html.= '<strong>';
            	$html.= 'Total estimation per company';
            	$html.= '</strong>';
            	$html.= '</td>';            
            	$html.= '</tr>';            
            	$html.= '</tbody>';            
            	$html.= '</table>';  
            	$html.= '</div>';



            	$html.= '<div class="table-responsive">';
	            $html.= '<table class="table table-bordered">';
	            $html.= '<tbody>';
	            $html.= '<tr class="headTitl">';               
	            $html.= '<td width="40%">';
	            $html.= '<strong>';
	            $html.= 'Others Warranties: optional ( C )';
	            $html.= '</strong>';
	            $html.= '</td>';  

	            // loop for company name     
	            foreach ($company_array as $key => $data) {       
					$html.= '<td width="12%">';
		            $html.= '<h3>';
					$html.= getCompanyName($data);    
		            $html.= '</h3>';
		            $html.= '</td>'; 
	            }
	            $html.= '</tr>';

//loop for the total of warranties 
					$html.= '<tr>';

            		foreach ($record as $key => $data) {
			            $html.= '<td>';
			            $html.= getWarrantyName($key);
			            $html.= '</td>';
			            foreach ($data as $company => $record_data) {
				            $html.= '<td class=warranty_value_'.$record_data['company_id'].'>';
				            $html.= $record_data['value'];
				            	
				            $html.= '</td>';
			            }
			            $html .= '</tr>';
            		}
					$html.= '</tr>';

					$html.= '<tr>';
					$html.= '<td>';
					$html.= '<h3>Total others warranties (E)</h3>';
					$html.= '</td>';
// for sum the warranty on basis of the warranty
		            foreach ($record_total_warranty as $key => $data) {
				        $html.= '<td>';
				        $html.= '<h3>';
			            $html.= $data['warranty_total'];
				        $html.= '</h3>';
			            $html.= '</td>';
		        	}

					$html.= '</tr>';
					$html.= '</tbody>';
           			$html.= '</table>';
            		$html.= '</div>';



            		$html .= '<div class="table-responsive">';
		            $html .= '<table class="table table-bordered">';
		            $html .= '<tbody>';
		            $html .= '<tr class="headTitl">';               
		            $html .= '<td width="40%">';
		            $html .= '<strong>';
		            $html .= 'Others Franchise : optional(D)';
		            $html .= '</strong>';
		            $html .= '</td>'; 
		            // loop for company name     
		            foreach ($company_array as $key => $data) {       
						$html .= '<td width="12%">';
			            $html .= '<h3>';
						$html .= getCompanyName($data);    
			            $html .= '</h3>';
			            $html .= '</td>'; 
		            }
		            $html .= '</tr>'; 

// showing the franchises and their value
					$html .=    		'<tr>';
            		foreach ($record_franchise as $key => $data) {
			            $html .= '<td>';
			            $html .= getFranchiseName($key);
			            $html .= '</td>';

			            foreach ($data as $key => $record_data) {
				            $html .= '<td>';
				            $html .= $record_data['value'];
				             	
				            $html .= '</td>';
			            }
			            $html .= '</tr>';
            		}
					$html .= '</tr>';

					$html .= '<tr>';
		            $html .= '<td>';
		            $html .= '<h3>';
		            $html .= 'Total others Franchise (F)';
		            $html .= '</h3>';
		            $html .= '</td>';
// showing the total of franchise
		            foreach ($record_total_franchise as $key => $data) {
			            $html .= '<td>';
			            $html .= '<h3>';
			            $html .= $data['franchise_total'];
	            		$html .= '</h3>';
			            $html .= '</td>';
		        	}

		        	$html.= '</tr>';
		            $html.= '</tbody>';
		            $html.= '</table>';
		            $html.= '</div>';


		            $html.= '<div class="table-responsive">';
		            $html.= '<table class="table table-bordered">';
		            $html.= '<tbody>';
		            $html.= '<tr class="headTitl">';               
		            $html.= '<td width="40%">';
		            $html.= '<strong>';
		            $html.= 'Company';
		            $html.= '</strong>';
		            $html.= '</td>';

		            // loop for company name     
		            foreach ($company_array as $key => $data) {       
						$html.= '<td width="12%">';
			            $html.= '<h3>';
						$html.= getCompanyName($data);    
			            $html.= '</h3>';
			            $html.= '</td>'; 
		            }
		            $html.= '</tr>'; 
		           

// showing the over all result of company 
        			$html .= '<tr>';
        			$html .= '<td>
        						<h3>Total Estimation per company</h3>
        					</td>';
					foreach ($record_total_company as $key => $data) {
			            $html .= '<td>';
			            $html .= '<h3>';
			            $html .= $data['company_total'];
			            $html .= '</h3>';
			            $html .= '</td>';
			        }

					$html.= '</tr>';
					$html.= '</tbody>';
					$html.= '</table>';
					$html.= '</div>'; 


					$html.= '<div class="col-xs-12 text-center"><button class="subBtn" id="finalize_company_professional_multirisk">';
		            $html.= getContentLanguageSelected("FINIALIZE_COMPANY",defaultSelectedLanguage());
		            $html.='</button></div> ';
		            $html.= '</div>';        
		//print_r($record);
		   	return $html;
		}
	}











// House Insurance
if(!function_exists('getSelectedDatRecordsForSelectedCompanyForHouse')) {
		function getSelectedDatRecordsForSelectedCompanyForHouse($warranty_array,$company_array,$franchise_array,$house_detail_id) {
			$record = array();
			$i      = 0;
			foreach ($company_array as $company_id) {
				// loop over the warranty
				if(!empty($company_array)) {
					foreach ($warranty_array as $warranty_id) {
						$warranty_total = 0;
						CI()->db->where('company_id',$company_id);
						CI()->db->where('warranty_name_id',$warranty_id);
						$query        = CI()->db->get('tbl_warranty');
						$count        = $query->num_rows();
						if($count>0) {
							$res      = $query->row();
							if ($res->fixed == 1 && $res->actual_catalogue == 0 && $res->type_value_vehicle == 0) {
								$warranty_total += doubleval($res->fixed_value);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								$record[$warranty_id][$i]['value']      = doubleval($res->fixed_value);
							}
							else if ($res->fixed == 1 && $res->actual_catalogue == 0 && $res->type_value_vehicle == 2) {
								$warranty_total += doubleval($res->fixed_value);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								$record[$warranty_id][$i]['value']      = doubleval($res->fixed_value);
							}
							else if(($res->fixed == 0 && $res->actual_catalogue == 1 && $res->type_value_vehicle == 1)){
								$detail_id = CI()->uri->segment(4);
								$warranty_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								$record[$warranty_id][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							}
							else if(($res->fixed == 0 && $res->actual_catalogue == 1 && $res->type_value_vehicle == 2)){
								$detail_id = CI()->uri->segment(4);
								$warranty_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								$record[$warranty_id][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							}
							$record[$warranty_id][$i]['warranty_name_id'] = $warranty_id;
							$record[$warranty_id][$i]['company_id']      = $res->company_id;
						}
						/*else {
							$record[$warranty_id][$i]['warranty_name_id'] = $warranty_id;

							$warranty_total += 0;
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;

							$record[$warranty_id][$i]['value']      = "Not Available";
							$record[$warranty_id][$i]['company_id']      = $company_id;
						}*/
					}
				}	

				// loop over the franchises
				if (!empty($franchise_array)) {
					foreach ($franchise_array as $franchise_id) {
						$franchise_total = 0;
						CI()->db->where('company_id',$company_id);
						CI()->db->where('franchise_name_id',$franchise_id);
						$query        = CI()->db->get('tbl_franchise');
						$count        = $query->num_rows();
						if($count>0) {
							$res      = $query->row();
							if($res->fixed == 1 && $res->actual_catalogue == 0 ) {
								$franchise_total += doubleval($res->fixed_value);
								$record_total_franchise[$company_id]['franchise_total'] += $franchise_total;
								$record_total_company[$company_id]['company_total'] -= $franchise_total;
								$record_franchise[$franchise_id][$i]['value']      = $res->fixed_value;
							}
							else {
								$detail_id = CI()->uri->segment(4);
								$franchise_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								$record_total_franchise[$company_id]['franchise_total'] += $franchise_total;
								$record_total_company[$company_id]['company_total'] -= $franchise_total;
								$record_franchise[$franchise_id][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							}
							$record_franchise[$franchise_id][$i]['franchise_name_id'] = $franchise_id;
							$record_franchise[$franchise_id][$i]['company_id']      = $res->company_id;
						}
						else {
							$record_franchise[$franchise_id][$i]['franchise_name_id'] = $franchise_id;

							$franchise_total += 0;
								$record_total_franchise[$company_id]['franchise_total'] += $franchise_total;
								$record_total_company[$company_id]['company_total'] -= $franchise_total;
							$record_franchise[$franchise_id][$i]['value']      = "Not Available";
							$record_franchise[$franchise_id][$i]['company_id']      = $company_id;
						}
					}
				}

				$house_data = getHouseDetailRecordByDetailId($house_detail_id);
				CI()->db->select('id,company_id,amount');
				CI()->db->where('insurer_quality_id',$house_data['insurer_quality_id']);
				
				CI()->db->where('minimum_room <',$house_data['room']);
	            CI()->db->where('maximum_room >',$house_data['room']);

	            CI()->db->where('minimum_monthly_rent <',$house_data['monthly_rent']);
	            CI()->db->where('maximum_monthly_rent >',$house_data['monthly_rent']);
	            
	            CI()->db->where('minimum_content_value <',$house_data['content_value']);
	            CI()->db->where('maximum_content_value >',$house_data['content_value']);
	            
	            CI()->db->where('minimum_building_value <',$house_data['building_value']);
	            CI()->db->where('maximum_building_value >',$house_data['building_value']);
	            
	            CI()->db->where('minimum_superficy <',$house_data['superficy']);
	            CI()->db->where('maximum_superficy >',$house_data['superficy']); 

				CI()->db->where('house_type_id',$house_data['house_type_id']);
				CI()->db->where('company_id',$company_id);
				CI()->db->where('house_category_id',$house_data['house_category_id']);
				CI()->db->where('month_id',$house_data['month_id']);
				CI()->db->where('risque_id',$house_data['risque_id']);
				$query  = CI()->db->get('tbl_house_tarification');
				$count  = $query->num_rows();
				if ($count>0) {
					$i      = 0;
					$result = $query->result();
					foreach ($result as $value) {
						$record_total_company[$company_id]['company_total'] += $value->amount;
						//$result_data__[$i]['company_id'] = $value->company_id;
						$result_data__[$house_detail_id][$i]['amount']     = $value->amount;
					}
				}
				else {
					// $result_data__[$i]['company_id'] = $company_id;
					$result_data__[$house_detail_id][$i]['amount']     = "Not Available";
					$record_total_company[$company_id]['company_total'] += 0;
				}
				$i++;
			}


// html start from here

			$html = "";
			$html.= '<div class="col-xs-12 policyCalc">
                  <div class="table-responsive tableTopFix">
                    <table class="table table-bordered">
                        <tbody>
                           	<tr>
                            	<td width="40%">Company</td>';    
                            	// loop for company name     
                           	foreach ($company_array as $key => $data) {       
            					$html.= '<td width="12%" rowspan="2">';
            					$html.= '<div class="selectPlan tabelPlan">';    
								$html.= '<label>';   
            					$html.= '<input value="'.$data.'" type="radio" name="company_id" id="company_id_house_'.$data.'" class="selected_companyR"/>';
            					$html.= '<h3>';
            					$html.= getCompanyName($data);
            					$html.= '</h3>';
            					$html.= '</label>';
            					$html.= '</div>';
            					$html.= '</td>';
                           	}
                           	$html.= '</tr>';
				$html.= '<tr>';            
            	$html.= '<td>';
            	$html.= '<strong>';
            	$html.= 'Total estimation per company';
            	$html.= '</strong>';
            	$html.= '</td>';            
            	$html.= '</tr>';            
            	$html.= '</tbody>';            
            	$html.= '</table>';  
            	$html.= '</div>';



            	$html.= '<div class="table-responsive">';
	            $html.= '<table class="table table-bordered">';
	            $html.= '<tbody>';
	            $html.= '<tr class="headTitl">';               
	            $html.= '<td width="40%">';
	            $html.= '<strong>';
	            $html.= 'Others Warranties: optional ( C )';
	            $html.= '</strong>';
	            $html.= '</td>';  

	            // loop for company name     
	            foreach ($company_array as $key => $data) {       
					$html.= '<td width="12%">';
		            $html.= '<h3>';
					$html.= getCompanyName($data);    
		            $html.= '</h3>';
		            $html.= '</td>'; 
	            }
	            $html.= '</tr>';

//loop for the total of warranties 
					$html.= '<tr>';

            		foreach ($record as $key => $data) {
			            $html.= '<td>';
			            $html.= getWarrantyName($key);
			            $html.= '</td>';
			            foreach ($data as $company => $record_data) {
				            $html.= '<td class=warranty_value_'.$record_data['company_id'].'>';
				            $html.= $record_data['value'];
				            	
				            $html.= '</td>';
			            }
			            $html .= '</tr>';
            		}
					$html.= '</tr>';

					$html.= '<tr>';
					$html.= '<td>';
					$html.= '<h3>Total others warranties (E)</h3>';
					$html.= '</td>';
// for sum the warranty on basis of the warranty
		            foreach ($record_total_warranty as $key => $data) {
				        $html.= '<td>';
				        $html.= '<h3>';
			            $html.= $data['warranty_total'];
				        $html.= '</h3>';
			            $html.= '</td>';
		        	}

					$html.= '</tr>';
					$html.= '</tbody>';
           			$html.= '</table>';
            		$html.= '</div>';



            		$html .= '<div class="table-responsive">';
		            $html .= '<table class="table table-bordered">';
		            $html .= '<tbody>';
		            $html .= '<tr class="headTitl">';               
		            $html .= '<td width="40%">';
		            $html .= '<strong>';
		            $html .= 'Others Franchise : optional(D)';
		            $html .= '</strong>';
		            $html .= '</td>'; 
		            // loop for company name     
		            foreach ($company_array as $key => $data) {       
						$html .= '<td width="12%">';
			            $html .= '<h3>';
						$html .= getCompanyName($data);    
			            $html .= '</h3>';
			            $html .= '</td>'; 
		            }
		            $html .= '</tr>'; 

// showing the franchises and their value
					$html .=    		'<tr>';
            		foreach ($record_franchise as $key => $data) {
			            $html .= '<td>';
			            $html .= getFranchiseName($key);
			            $html .= '</td>';

			            foreach ($data as $key => $record_data) {
				            $html .= '<td>';
				            $html .= $record_data['value'];
				             	
				            $html .= '</td>';
			            }
			            $html .= '</tr>';
            		}
					$html .= '</tr>';

					$html .= '<tr>';
		            $html .= '<td>';
		            $html .= '<h3>';
		            $html .= 'Total others Franchise (F)';
		            $html .= '</h3>';
		            $html .= '</td>';
// showing the total of franchise
		            foreach ($record_total_franchise as $key => $data) {
			            $html .= '<td>';
			            $html .= '<h3>';
			            $html .= $data['franchise_total'];
	            		$html .= '</h3>';
			            $html .= '</td>';
		        	}

		        	$html.= '</tr>';
		            $html.= '</tbody>';
		            $html.= '</table>';
		            $html.= '</div>';


		            $html.= '<div class="table-responsive">';
		            $html.= '<table class="table table-bordered">';
		            $html.= '<tbody>';
		            $html.= '<tr class="headTitl">';               
		            $html.= '<td width="40%">';
		            $html.= '<strong>';
		            $html.= 'Company';
		            $html.= '</strong>';
		            $html.= '</td>';

		            // loop for company name     
		            foreach ($company_array as $key => $data) {       
						$html.= '<td width="12%">';
			            $html.= '<h3>';
						$html.= getCompanyName($data);    
			            $html.= '</h3>';
			            $html.= '</td>'; 
		            }
		            $html.= '</tr>'; 
		           

// showing the over all result of company 
        			$html .= '<tr>';
        			$html .= '<td>
        						<h3>Total Estimation per company</h3>
        					</td>';
					foreach ($record_total_company as $key => $data) {
			            $html .= '<td>';
			            $html .= '<h3>';
			            $html .= $data['company_total'];
			            $html .= '</h3>';
			            $html .= '</td>';
			        }

					$html.= '</tr>';
					$html.= '</tbody>';
					$html.= '</table>';
					$html.= '</div>'; 


					$html.= '<div class="col-xs-12 text-center"><button class="subBtn" id="finalize_company_house">';
		            $html.= getContentLanguageSelected("FINIALIZE_COMPANY",defaultSelectedLanguage());
		            $html.='</button></div> ';
		            $html.= '</div>';        
		//print_r($record);
		   	return $html;
		}
	}




	// Credit Insurance )(copy)
if(!function_exists('getSelectedDatRecordsForSelectedCompanyForCredit')) {
		function getSelectedDatRecordsForSelectedCompanyForCredit($warranty_array,$company_array,$credit_detail_id) {
			$record = array();
			$i      = 0;
			foreach ($company_array as $company_id) {
				// loop over the warranty
				if(!empty($company_array)) {
					foreach ($warranty_array as $warranty_id) {
						$warranty_total = 0;
						CI()->db->where('company_id',$company_id);
						CI()->db->where('warranty_name_id',$warranty_id['warranty_name_id']);
						$query        = CI()->db->get('tbl_warranty');
						$count        = $query->num_rows();
						if($count>0) {
							$res      = $query->row();
							if ($res->fixed == 1 && $res->actual_catalogue == 0 && $res->type_value_vehicle == 0) {
								$warranty_total += doubleval($res->fixed_value);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								$record[$warranty_id["warranty_name_id"]][$i]['value']      = doubleval($res->fixed_value);
							}
							else if ($res->fixed == 1 && $res->actual_catalogue == 0 && $res->type_value_vehicle == 2) {
								$warranty_total += doubleval($res->fixed_value);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								$record[$warranty_id["warranty_name_id"]][$i]['value']      = doubleval($res->fixed_value);
							}
							else if(($res->fixed == 0 && $res->actual_catalogue == 1 && $res->type_value_vehicle == 1)){
								$detail_id = CI()->uri->segment(4);
								$warranty_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								$record[$warranty_id["warranty_name_id"]][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							}
							else if(($res->fixed == 0 && $res->actual_catalogue == 1 && $res->type_value_vehicle == 2)){
								$detail_id = CI()->uri->segment(4);
								$warranty_total += getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;
								$record[$warranty_id["warranty_name_id"]][$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							}
							$record[$warranty_id["warranty_name_id"]][$i]['warranty_name_id'] = $warranty_id;
							$record[$warranty_id["warranty_name_id"]][$i]['company_id']      = $res->company_id;
						}
						else {
							$record[$warranty_id["warranty_name_id"]][$i]['warranty_name_id'] = $warranty_id;

							$warranty_total += 0;
								$record_total_warranty[$company_id]['warranty_total'] += $warranty_total;
								$record_total_company[$company_id]['company_total'] += $warranty_total;

							$record[$warranty_id["warranty_name_id"]][$i]['value']      = "Not Available";
							$record[$warranty_id["warranty_name_id"]][$i]['company_id']      = $company_id;
						}
					}
				}	

				$credit_data = getCreditDetailRecordByDetailId($credit_detail_id);
				CI()->db->select('id,company_id,insurance_rate');
				CI()->db->where('company_id',$company_id);
				CI()->db->where('min_loan_amount <=',$credit_data['credit_insurance_loan_amount']);
				CI()->db->where('max_loan_amount >=',$credit_data['credit_insurance_loan_amount']);

				CI()->db->where('loan_duration',$credit_data['credit_insurance_loan_duration']);

				CI()->db->where('insurance_rate',$credit_data['credit_insurance_rate']);

				CI()->db->where('loan_size',$credit_data['credit_insurance_loan_size']);

				CI()->db->where('min_age <=',$credit_data['credit_insurance_customer_age']);
				CI()->db->where('max_age >=',$credit_data['credit_insurance_customer_age']);
				$query  		  = CI()->db->get('tbl_credit_tarification');
				$count  		  = $query->num_rows();
				$amountforcompany = getAmountByInsuraneRateId($credit_data,$company_id);
				if ($count>0) {
					//$i      = 0;
					$result = $query->result();
					foreach ($result as $value) {
						$value->amount_details = $amountforcompany;
						$value->amount = $amountforcompany['total_amount'];

						$record_total_company[$company_id]['company_total'] += $value->amount;
						$result_data__[$credit_detail_id][$i]['amount_details'] = $value->amount_details;
						$result_data__[$credit_detail_id][$i]['amount']     = $value->amount;
					}
				}
				else {
					$result_data__[$credit_detail_id][$i]['amount']     = "Not Available";
					$record_total_company[$company_id]['company_total'] += 0;
				}
				$i++;
			}

// html start from here

			$html = "";
			$html.= '<div class="col-xs-12 policyCalc">
              <div class="table-responsive tableTopFix">
                <table class="table table-bordered">
                    <tbody>
                       	<tr>
                        	<td width="40%">Company</td>';    
                        	// loop for company name     
                       	foreach ($company_array as $key => $data) {       
        					$html.= '<td width="12%" rowspan="2">';
        					$html.= '<div class="selectPlan tabelPlan">';    
							$html.= '<label>'; 
        					$html.= '<input value="'.$data.'" type="radio" name="company_id" id="company_id_credit_'.$data.'" class="selected_companyR"/>';
        					$html.= '<h3>';
        					$html.= getCompanyName($data);
        					$html.= '</h3>';
        					$html.= '</label>';
        					$html.= '</div>';
        					$html.= '</td>';
                       	}
                       	$html.= '</tr>';
            $html.= '<tr>';            
        	$html.= '<td>';
        	$html.= '<strong>';
        	$html.= 'Total estimation per company';
        	$html.= '</strong>';
        	$html.= '</td>';            
        	$html.= '</tr>';            
        	$html.= '</tbody>';            
        	$html.= '</table>';  
        	$html.= '</div>';


        	$html.= '<div class="table-responsive">';
            $html.= '<table class="table table-bordered">';
            $html.= '<tbody>';
            $html.= '<tr class="headTitl">';               
            $html.= '<td width="40%">';
            $html.= '<strong>';
            $html.= 'Company';
            $html.= '</strong>';
            $html.= '</td>';

            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%">';
	            $html.= '<h3>';
				$html.= getCompanyName($data);    
	            $html.= '</h3>';
	            $html.= '</td>'; 
            }
            $html.= '</tr>'; 

			$html.= 		'<tr>
			<td class="make_bold">
			</td>
			</tr>';          
			$html.=    		'<tr>';

			// loop for the company

			foreach ($result_data__ as $key => $data) {
			$html.=         '<td>';
			$html.=         "Rate Calculation Amount";
			$html.=         '</td>';
			foreach ($data as $key => $record_data) {
			$html.=         '<td>';
			$html.=         $record_data['amount']; 	
			$html.=         '</td>';
			}
			$html.=         '</tr>';
			}
			$html.=         '</tr>';
			$html.=		'</tbody>';
            $html.= '</table>';            
            $html.= '</div>';     



        	// Loop to show optional warranties
        	$html.= '<div class="table-responsive">';
            $html.= '<table class="table table-bordered">';
            $html.= '<tbody>';
            $html.= '<tr class="headTitl">';               
            $html.= '<td width="40%">';
            $html.= '<strong>';
            $html.= 'Others Warranties: optional ( C )';
            $html.= '</strong>';
            $html.= '</td>';  

            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%">';
	            $html.= '<h3>';
				$html.= getCompanyName($data);    
	            $html.= '</h3>';
	            $html.= '</td>'; 
            }
            $html.= '</tr>';


//loop for the total of warranties 



	        $html.=    		'<tr>';

    		foreach ($record as $key => $data) {
	            $html.=         '<td>';
	            $html.=         getWarrantyName($key);
	            $warranty_typeid = $data[0]['warranty_name_id']['type_of_warranties_id'];
	            if($warranty_typeid == 2) {
	            	$html.= ' (Exclusion Of Warranties)';
	            } else if($warranty_typeid == 1) {
	            	$html.= ' (Optional Warranty)';
	            } else {
	            	$html.= ' (Mandatory Warranty)';
	            }
	            $html.=         '</td>';
	            foreach ($data as $company => $record_data) {;
		            $html.= '<td class=warranty_value_'.$record_data['company_id'].'>';
		            
		            // $html.=         gettype($record_data['value']).$record_data['value'];
		            $html.= $record_data['value'];	
		            $html.= '</td>';
	            }
	            $html.= '</tr>';
    		}
            $html.= '</tr>';


            $html.= '<tr>';
			$html.= '<td>';
			$html.= '<h3>Total others warranties (E)</h3>';
			$html.= '</td>';
// for sum the warranty on basis of the warranty
            foreach ($record_total_warranty as $key => $data) {
		        $html.= '<td>';
			    $html.= '<h3>';
		        $html.= $data['warranty_total'];
			    $html.= '</h3>';
		        $html.= '</td>';
        	}
            $html.= '</tr>';
			$html.= '</tbody>';
   			$html.= '</table>';
    		$html.= '</div>';


    		$html.= '<div class="table-responsive">';
            $html.= '<table class="table table-bordered">';
            $html.= '<tbody>';
            $html.= '<tr class="headTitl">';               
            $html.= '<td width="40%">';
            $html.= '<strong>';
            $html.= 'Company';
            $html.= '</strong>';
            $html.= '</td>';

            // loop for company name     
            foreach ($company_array as $key => $data) {       
				$html.= '<td width="12%">';
	            $html.= '<h3>';
				$html.= getCompanyName($data);    
	            $html.= '</h3>';
	            $html.= '</td>'; 
            }
            $html.= '</tr>'; 

            // showing the over all result of company 
			$html .= '<tr>';
			$html .= '<td>
						<h3>Total Estimation per company</h3>
					</td>';
			foreach ($record_total_company as $key => $data) {
	            $html .= '<td>';
	            $html .= '<h3>';
	            $html .= $data['company_total'];
	            $html .= '</h3>';
	            $html .= '</td>';
	        }

			$html.= '</tr>';
			$html.= '</tbody>';
			$html.= '</table>';
			$html.= '</div>'; 

			$html.= '<div class="col-xs-12 text-center"><button class="subBtn" id="finalize_company_credit">';
            $html.= getContentLanguageSelected("FINIALIZE_COMPANY",defaultSelectedLanguage());
            $html.='</button></div> ';
            $html.= '</div>';              
		//print_r($record);
		   	return $html;
		}
	}


// function added by Shiv to get the rate calculation amount
if(!function_exists('getRateCalculationAmount')) {
	function getRateCalculationAmount($credit_detail_id) {
		CI()->db->where('credit_detail_id',$credit_detail_id); 
		$query = CI()->db->get('tbl_credit_calculation_rate_details');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->result();
			foreach ($res as $value) {
				$result = $value->rate_calculation_amount;						
			}
	    } else {
	    	$result = array();
	    }
	    return $result;
	}
}



// get record for credit detail id (by Shiv)
if(!function_exists('getCreditDetailRecordByDetailId')){
	function getCreditDetailRecordByDetailId($credit_detail_id=0){
	    $result=array();
	    if($credit_detail_id>0){
		    CI()->db->where('id',$credit_detail_id);
			$query = CI()->db->get('tbl_credit_detail');
		    $count = $query->num_rows();
	        if($count>0){        	
				$result    =  $query->row_array();	
		    }
	    }
	    return $result;
	}
}


// function added by Shiv to get insurance rate for the selected company
if(!function_exists('getAmountByInsuraneRateId')) {
	function getAmountByInsuraneRateId($credit_details,$company_id) {
		$rate_calculation_type = getCreditRateCalculationType($credit_details['id']);
		$loan_initial_amount   = $credit_details['credit_insurance_loan_amount'];
		$loan_duration         = $credit_details['credit_insurance_loan_duration'];
		$loan_monthly_pay      = $credit_details['credit_bank_loan_monthly_payment'];

		$credit_tarification_id = getCreditTarificationId($credit_details['id']);
		$credit_insurance_rate = getCreditInsuranceRate($credit_tarification_id,$company_id);


		if($rate_calculation_type == 0) {
			$amount_years            = ($credit_details['credit_insurance_loan_amount']*$credit_insurance_rate)/100;
			$rate_calculation_amount = array (
				'rate_calculation_type' => $rate_calculation_type,
				'total_amount'			=> $amount_years
			);
		} else {
			$amount_years = 0;
			for($j = 1;$j <= $loan_duration;$j++) {
				$amount_year = 0;
				for($i = 12*($j-1);$i < 12*($j);$i++) {
					$amount_month  = ($loan_initial_amount - ($loan_monthly_pay)*($i))*($credit_insurance_rate/100);
					$amount_year += $amount_month;
				}
				$amount_years += $amount_year;
				$amount_by_year[$j] = $amount_year;
			}

			$rate_calculation_amount = array (
				'rate_calculation_type' => $rate_calculation_type,
				'amount_by_year'        => $amount_by_year,
				'total_amount'          => $amount_years
			);
		}
		return $rate_calculation_amount;
	}
}


// function added by Shiv to get the credit insurance rate for the selected company
if(!function_exists('getCreditInsuranceRate')) {
	function getCreditInsuranceRate($credit_tarification_id,$company_id) {
		CI()->db->where('id',$credit_tarification_id);
		CI()->db->where('company_id',$company_id);
		$query = CI()->db->get('tbl_credit_tarification');
		$count = $query->num_rows();
		if($count > 0) {
			$res = $query->row();
			$result = $res->insurance_rate;
		} else {
			$result = 0;
		}
		return $result;
	}
}



// function added by Shiv to get the credit rate calculation calculation type (fixed/variable)
if(!function_exists('getCreditRateCalculationType')) {
	function getCreditRateCalculationType($credit_detail_id) {
		CI()->db->where('credit_detail_id',$credit_detail_id);
		$query = CI()->db->get('tbl_credit_calculation_rate_details');
		$count = $query->num_rows();
		if($count > 0) {
			$res = $query->row();
			$result = $res->rate_calculation_type;
		} else {
			$result = '';
		}
		return $result;
	}
}


// function added by Shiv to get credit tarification id
if(!function_exists('getCreditTarificationId')) {
	function getCreditTarificationId($credit_detail_id) {
		CI()->db->where('id',$credit_detail_id);
		$query = CI()->db->get('tbl_credit_detail');
		$count = $query->num_rows();
		if($count > 0) {
			$res = $query->row();
			$result = $res->credit_tarification_id;
		} else {
			$result = '';
		}
		return $result;
	}
}

// function to get the details (by Shiv)
	if(!function_exists('getFinalForSelectedCompanyHouse')) {
		function getFinalForSelectedCompanyHouse($franchise_array,$warranty_array,$company_array,$house_detail_id) {
			//print_r($vehicle_detail_id);
			$record = array();
			$i      = 0;
			foreach ($company_array as $company_id) {
				foreach ($warranty_array as $warranty_id) {
					CI()->db->where('company_id',$company_id);
					CI()->db->where('warranty_name_id',$warranty_id);
					$query        = CI()->db->get('tbl_warranty');
					$count        = $query->num_rows();
					if($count>0) {
						$res      = $query->row();
						if ($res->fixed == 1 && $res->actual_catalogue == 0 ) {
							$record[$i]['value']           = doubleval($res->fixed_value);
							$record[$i]['type']            = 'warranties';
							$record[$i]['name']            = getWarrantyName($warranty_id);
							$record[$i]['company_id']      = $company_id;
							$record[$i]['company_name']    = getCompanyName($company_id);
							$record[$i]['house_detail_id'] = $house_detail_id;
						}
						else {
							$detail_id = CI()->uri->segment(4);
							$record[$i]['value']      = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							$record[$i]['type']            = 'warranties';
							$record[$i]['name']            = getWarrantyName($warranty_id);
							$record[$i]['company_id']      = $company_id;
							$record[$i]['company_name']    = getCompanyName($company_id);
							$record[$i]['house_detail_id'] = $house_detail_id;
						}
					}
					else {
						$record[$i]['value']           = "Not Available";
						$record[$i]['type']            = 'warranties';
						$record[$i]['name']            = getWarrantyName($warranty_id);
						$record[$i]['company_id']      = $company_id;
						$record[$i]['company_name']    = getCompanyName($company_id);
						$record[$i]['house_detail_id'] = $house_detail_id;
					}
					$i++;
				}

				foreach ($franchise_array as $franchise_id) {
					CI()->db->where('company_id',$company_id);
					CI()->db->where('franchise_name_id',$franchise_id);
					$query        = CI()->db->get('tbl_franchise');
					$count        = $query->num_rows();


					if($count>0) {
						$res      = $query->row();
						if($res->fixed == 1 && $res->actual_catalogue == 0 ) {
							$record[$i]['value']           = $res->fixed_value;
							$record[$i]['name']            = getFranchiseName($franchise_id);
							$record[$i]['company_id']      = $company_id;
							$record[$i]['company_name']    = getCompanyName($company_id);
							$record[$i]['type']            = 'franchise';
							$record[$i]['house_detail_id'] = $house_detail_id;
						}
						else {
							$detail_id = CI()->uri->segment(4);
							
							$record[$i]['value']           = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
							$record[$i]['name'] 		   = getFranchiseName($franchise_id);
							$record[$i]['company_id']      = $company_id;
							$record[$i]['company_name']    = getCompanyName($company_id);
							$record[$i]['type']            = 'franchise';
							$record[$i]['house_detail_id'] = $house_detail_id;
						}
					}
					else {
						$record[$i]['name'] 		   = getFranchiseName($franchise_id);
						$record[$i]['value']           = "Not Available";
						$record[$i]['company_id']      = $company_id;
						$record[$i]['company_name']    = getCompanyName($company_id);
						$record[$i]['type']            = 'franchise';
						$record[$i]['house_detail_id'] = $house_detail_id;

					}
					$i++;
				}

// selected option

				$house_data = getHouseDetailRecordByDetailId($house_detail_id);
				CI()->db->select('id,company_id,amount');
				CI()->db->where('insurer_quality_id',$house_data['insurer_quality_id']);
				
				CI()->db->where('minimum_room <',$house_data['room']);
	            CI()->db->where('maximum_room >',$house_data['room']);

	            CI()->db->where('minimum_monthly_rent <',$house_data['monthly_rent']);
	            CI()->db->where('maximum_monthly_rent >',$house_data['monthly_rent']);
	            
	            CI()->db->where('minimum_content_value <',$house_data['content_value']);
	            CI()->db->where('maximum_content_value >',$house_data['content_value']);
	            
	            CI()->db->where('minimum_building_value <',$house_data['building_value']);
	            CI()->db->where('maximum_building_value >',$house_data['building_value']);
	            
	            CI()->db->where('minimum_superficy <',$house_data['superficy']);
	            CI()->db->where('maximum_superficy >',$house_data['superficy']); 
				
				CI()->db->where('house_type_id',$house_data['house_type_id']);
				CI()->db->where('company_id',$company_id);
				CI()->db->where('house_category_id',$house_data['house_category_id']);
				CI()->db->where('month_id',$house_data['month_id']);
				CI()->db->where('risque_id',$house_data['risque_id']);
				$query  = CI()->db->get('tbl_house_tarification');
				$count  = $query->num_rows(); 
				if($count>0) {
					$res      = $query->result();
					foreach ($res as $value) {
						$record[$i]['name']            = 'Required';
						$record[$i]['value']           = $value->amount;
						$record[$i]['company_id']      = $company_id;
						$record[$i]['company_name']    = getCompanyName($company_id);
						$record[$i]['type']            = 'required_data';
						$record[$i]['house_detail_id'] = $house_detail_id;
					}
					$i++;
				}
			}
			return $record;
		}
	}




// function added by Shiv to get the details 
	if(!function_exists('getFinalForSelectedCompanyCredit')) {
		function getFinalForSelectedCompanyCredit($warranty_array,$company_array,$credit_detail_id,$rate_calculation_amount) {
		//print_r($vehicle_detail_id);
		$record = array();
		$i      = 0;
		foreach ($company_array as $company_id) {
			foreach ($warranty_array as $warranty_id) {
				CI()->db->where('company_id',$company_id);
				CI()->db->where('warranty_name_id',$warranty_id);
				$query        = CI()->db->get('tbl_warranty');
				$count        = $query->num_rows();
				if($count>0) {
					$res      = $query->row();
					if ($res->fixed == 1 && $res->actual_catalogue == 0 ) {
						$record[$i]['value']             = doubleval($res->fixed_value);
						$record[$i]['type']              = 'warranties';
						$record[$i]['name']              = getWarrantyName($warranty_id);
						$record[$i]['company_id']        = $company_id;
						$record[$i]['company_name']      = getCompanyName($company_id);
						$record[$i]['credit_detail_id']  = $credit_detail_id;
					}
					else {
						$detail_id = CI()->uri->segment(4);
						$record[$i]['value']            = getValueForPercent($res->percent,$res->type_value_vehicle,$detail_id);
						$record[$i]['type']             = 'warranties';
						$record[$i]['name']             = getWarrantyName($warranty_id);
						$record[$i]['company_id']        = $company_id;
						$record[$i]['company_name']     = getCompanyName($company_id);
						$record[$i]['credit_detail_id'] = $credit_detail_id;
					}
				}
				else {
					$record[$i]['value']            = "Not Available";
					$record[$i]['type']             = 'warranties';
					$record[$i]['name']             = getWarrantyName($warranty_id);
					$record[$i]['company_id']        = $company_id;
					$record[$i]['company_name']     = getCompanyName($company_id);
					$record[$i]['credit_detail_id'] = $credit_detail_id;
				}
				$i++;
			}


// selected option

			$credit_data = getCreditDetailRecordByDetailId($credit_detail_id);
			CI()->db->select('id,company_id');
			CI()->db->where('min_loan_amount <=',$credit_data['credit_insurance_loan_amount']);
			CI()->db->where('max_loan_amount >=',$credit_data['credit_insurance_loan_amount']);

			CI()->db->where('loan_duration',$credit_data['credit_insurance_loan_duration']);

			CI()->db->where('insurance_rate',$credit_data['credit_insurance_rate']);

			CI()->db->where('loan_size',$credit_data['credit_insurance_loan_size']);

			CI()->db->where('min_age <=',$credit_data['credit_insurance_customer_age']);
			CI()->db->where('max_age >=',$credit_data['credit_insurance_customer_age']);
			$query  = CI()->db->get('tbl_credit_tarification');
			$count  = $query->num_rows(); 
			if($count>0) {
				$res      = $query->result();
				foreach ($res as $value) {
					$value->amount = $rate_calculation_amount;
					$record[$i]['name']             = 'Required';
					$record[$i]['value']             = $value->amount;
					$record[$i]['company_id']        = $company_id;
					$record[$i]['company_name']      = getCompanyName($company_id);
					$record[$i]['type']              = 'required_data';
					$record[$i]['credit_detail_id'] = $credit_detail_id	;
				}
				$i++;
			}
		}
		// print_r($record);
	    return $record;
	}
}





// get record for proffesional multirisk detail id
if(!function_exists('getProffesionalMultiRiskDetailRecordByDetailId')){
	function getProffesionalMultiRiskDetailRecordByDetailId($proffesional_multirisk_quote_id=0){
	    $result=array();
	    if($proffesional_multirisk_quote_id>0){
		    CI()->db->where('id',$proffesional_multirisk_quote_id);
			$query = CI()->db->get('tbl_proffesional_multirisk_quote_personal_details');
		    $count = $query->num_rows();
	        if($count>0){        	
				$result    =  $query->row();	
		    }
	    }
	    return $result;
	}
}


// function added by Shiv to get the claim reimburse rates of the selected companies
if(!function_exists('getClaimReimbursementRates')) {
	function getClaimReimbursementRates($health_insurance_examination_list_array,$claim_reimbursement_details,$company_array) {
		$i = 0;
		foreach ($company_array as $key=>$company_id) {
			if(!empty($company_array)) {
				CI()->db->where('company_id',$company_id);
				CI()->db->where('claim_reimbursement_rate_id',$claim_reimbursement_details->id);
				$query        = CI()->db->get('tbl_company_claim_reimbursement');
				$count        = $query->num_rows();
				$result       = $query->row();
				if($count > 0) {
					$record[$key]['company_id'] = $result->company_id;
					$record[$key]['rate']       = $claim_reimbursement_details->rate;
				} else { 
					$record[$key]['company_id'] = $company_id;
					$record[$key]['rate']       = 0;
				}
				
				foreach ($health_insurance_examination_list_array as $health_insurance_id) {
					$examination_total = 0;
					CI()->db->where('company_id',$company_id);
					CI()->db->where('id',$health_insurance_id);
					$query1        = CI()->db->get('tbl_health_insurance');
					$count1        = $query1->num_rows();
					if($count1>0) {
						$res      = $query1->row();
						$examination_total += doubleval($res->amount);
						$record_total_examination_list[$company_id]['examination_total'] += $examination_total;
						$record_total_company[$company_id]['company_total'] += $examination_total;
						$records[$health_insurance_id][$i]['value']      = doubleval($res->amount);
						$records[$health_insurance_id][$i]['value']      = $res->amount;;
						$records[$health_insurance_id][$i]['health_insurance_id']  = $health_insurance_id;
						$records[$health_insurance_id][$i]['company_id'] = $res->company_id;
					}
					else {
						$records[$health_insurance_id][$i]['health_insurance_id']  = $health_insurance_id;
						$records[$health_insurance_id][$i]['value']      = "Not Available";
						$records[$health_insurance_id][$i]['company_id'] = $company_id;
						$examination_total += 0;
						$record_total_examination_list[$company_id]['examination_total'] += $examination_total;
						$record_total_company[$company_id]['company_total'] += $examination_total;
					}
				}
					
				$i++;

			}
		}

		// html start from here

			$html = "";
            $html.= '<div class="table-responsive tableTopFix">';
            $html.= '<table id="example2" class="table table-bordered">';
            $html.= '<thead>';
            $html.= '<tr>';
            $html.= '<th>AVAILABLE RATE</th>';    
            
            // loop for company name     
           	foreach ($company_array as $key => $data) {   
           		if($record[$key]['rate'] != 0) {    
					$html.= '<th>';
					$html.= getCompanyName($data);
					$html.= '</th>';
				}
           	}

           	$html.= '</tr>';
            $html.= '</thead>';
            $html.= '<tbody>';
          	$html.= '<tr><td></td></tr>';

            $html.= '<tr>';
            $html.= '<th>CLAIM REIMBURSEMENT RATE</th>';
        	foreach ($record as $key => $data) {
        	 	if($data['rate'] != 0) {	
	            	$html.= '<td>';
	            	$html.= ($data['rate'])?$data['rate']."%" :"Not Available";
	            	$html.= '</td>';
	            }
            }

            $html.= '</tr>';

          	$html.= '<tr><td></td></tr>';
          	
          	$html.= '<tr>';
          	$html.= '<td>TERRITORIAL AREA</td>';
          	foreach ($record as $key => $data) {
          		if($data['rate'] != 0) {
          			$html.= '<td>';
          			$total_amount = $record_total_company[$data['company_id']]['company_total'];
          			$html.= $total_amount - ($data['rate']*100);
	            	$html.= '</td>';
	            }	
          	}
          	$html.= '</tr>';
            $html.= '</tbody>';
            $html.= '</table>';
            $html.= '</div>';
			return $html;
	}
}


// function added by Shiv to get the company id by travel id
if (!function_exists('getBranchIdByTravelId')) {
	function getBranchIdByTravelId($travel_id) {
		CI()->db->where('travel_id',$travel_id);
		$query = CI()->db->get('tbl_travel_finalize_company');
		$count = $query->num_rows();
		if ($count>0) {
			$res    = $query->row();
			$result = $res->branch_id;
		}
		else {
			$result = '';
		}
		return $result;
	}
}


// function added by Shiv to get the company id by health insurance id
if (!function_exists('getBranchIdByHealthInsuranceId')) {
	function getBranchIdByHealthInsuranceId($health_insurance_id) {
		CI()->db->where('health_insurance_id',$health_insurance_id);
		$query = CI()->db->get('tbl_health_insurance_finalize_company');
		$count = $query->num_rows();
		if ($count>0) {
			$res    = $query->row();
			$result = $res->branch_id;
		}
		else {
			$result = '';
		}
		return $result;
	}
}



// function added by Shiv to get the company id by travel id
if (!function_exists('getCompanyIdByTravelId')) {
	function getCompanyIdByTravelId($travel_id) {

		CI()->db->where('travel_id',$travel_id);
		$query = CI()->db->get('tbl_travel_finalize_company');
		$count = $query->num_rows();
		if ($count>0) {
			$res    = $query->row();
			$result = $res->company_id;
		}
		else {
			$result = '';
		}
		return $result;
	}
}

// function to get the company id by health insurance id
if (!function_exists('getCompanyIdByHealthInsuranceId')) {
	function getCompanyIdByHealthInsuranceId($health_insurance_id) {

		CI()->db->where('health_insurance_id',$health_insurance_id);
		$query = CI()->db->get('tbl_health_insurance_finalize_company');
		$count = $query->num_rows();
		if ($count>0) {
			$res    = $query->row();
			$result = $res->company_id;
		}
		else {
			$result = '';
		}
		return $result;
	}
}

// function to get the company id by travel id
if (!function_exists('getCompanyIdByIndividualInsuranceOptionDetailsId')) {
	function getCompanyIdByIndividualInsuranceOptionDetailsId($id) {

		CI()->db->where('individual_insurance_option_details_id',$id);
		$query = CI()->db->get('tbl_individual_accident_finalize_company');
		$count = $query->num_rows();
		if ($count>0) {
			$res    = $query->row();
			$result = $res->company_id;
		}
		else {
			$result = '';
		}
		return $result;
	}
}


// function to get the company id by house id
if (!function_exists('getCompanyIdByHouseId')) {
	function getCompanyIdByHouseId($house_id) {
		CI()->db->where('id',$house_id);
		$query = CI()->db->get('tbl_house_detail');
		$count = $query->num_rows();
		if ($count>0) {
			$res    = $query->row();
			$result = $res->company_selected;
		}
		else {
			$result = '';
		}
		return $result;
	}
}

// function added by Shiv to get accessories Id
if(!function_exists('getNumberOfDaysToTravel')){
	function getNumberOfDaysToTravel($travel_id){
	    $result="";
	   	CI()->db->where('people_insured_id',$travel_id);
		$query = CI()->db->get('tbl_travel_destination_details');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$start_date = $res->travel_start_date;						
			$end_date = $res->travel_end_date;	
			$result = dateDiffInDays($start_date, $end_date);
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}


// function to get accessories Id for Health Insurance
if(!function_exists('getNumberOfDaysToHealthInsurance')) {
	function getNumberOfDaysToHealthInsurance($health_insurance_id){
	    $result="";
	   	CI()->db->where('id',$health_insurance_id);
		$query = CI()->db->get('tbl_health_insurance_details');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$start_date = $res->start_date;						
			$end_date = $res->end_date	;
			$result = dateDiffInDays($start_date, $end_date);	
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}


// function added by Shiv to get the diffrence of days between two dates
if(!function_exists('dateDiffInDays')){
	function dateDiffInDays($date1, $date2)  
	{ 
	    $diff = strtotime($date2) - strtotime($date1); 
	    return abs(round($diff / 86400)); 
	} 
}


// function added by Shiv to get the travel starting and travel end date
if(!function_exists('getTravelStartEndDate')){
	function getTravelStartEndDate($travel_id){
	    $result="";
	    CI()->db->select('travel_start_date');
	    CI()->db->select('travel_end_date');
	   	CI()->db->where('people_insured_id',$travel_id);
		$query = CI()->db->get('tbl_travel_destination_details');
	    $count = $query->num_rows();
        if($count>0){        	
			$result =  $query->row();
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}

// function added by Shiv to get the credit starting and travel end date
if(!function_exists('getCreditStartEndDate')){
	function getCreditStartEndDate($credit_id){
	    $result="";
	    CI()->db->select('credit_insurance_start_date');
	    CI()->db->select('credit_insurance_expiry_date');
	   	CI()->db->where('id',$tcredit_id);
		$query = CI()->db->get('tbl_credit_detail');
	    $count = $query->num_rows();
        if($count>0){        	
			$result =  $query->row();
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}

// function added by Shiv to get the health starting and travel end date
if(!function_exists('getHealthStartEndDate')) {
	function getHealthStartEndDate($health_insurance_id) {
	    CI()->db->select('start_date');
	    CI()->db->select('end_date');
	   	CI()->db->where('id',$health_insurance_id);
		$query = CI()->db->get('tbl_health_insurance_details');
	    $count = $query->num_rows();
        if($count>0){        	
			$result =  $query->row();
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}

// function added by Shiv to get the vehicle starting and travel end date
if(!function_exists('getVehicleStartEndDate')) {
	function getVehicleStartEndDate($vehicle_detail_id) {
	   	CI()->db->where('id',$vehicle_detail_id);
		$query = CI()->db->get('tbl_vehicle_detail');
	    $count = $query->num_rows();
        if($count > 0) {        	
			$res 				= $query->row();
			$result->start_date = $res->insurance_registeration_date;
			$result->end_date   = date("Y-m-d H:i:s", strtotime("+1 years", strtotime($res->insurance_registeration_date)));
	    } else {
	    	$result = '';
	    }
	    return $result;
	}
}


// function added by Shiv to get travel Quote Record By CompanyId
if(!function_exists('getTravelQuoteRecordByCompanyId')){
	function getTravelQuoteRecordByCompanyId($company_id="",$days_to_travel=""){
	    // $result="";
		CI()->db->where('company_id',$company_id); 
		CI()->db->where('min_days<=',$days_to_travel);
	    CI()->db->where('max_days>=',$days_to_travel);
		CI()->db->where('status',1); 
		$query = CI()->db->get('tbl_travel_quote');
	    $count = $query->num_rows();
        if($count>0){        	
			$result =  $query->row();
	    } else {
	    	$result = array();
	    }
	    return $result;
	}
}


// function added by Shiv to get Health Insurance Quote Record By CompanyId
if(!function_exists('getHealthInsuranceQuoteRecordByCompanyId')){
	function getHealthInsuranceQuoteRecordByCompanyId($company_id="",$days_to_health_insurance=""){
		CI()->db->where('company_id',$company_id); 
		CI()->db->where('min_days<=',$days_to_health_insurance);
	    CI()->db->where('max_days>=',$days_to_health_insurance);
		CI()->db->where('status',1); 
		$query = CI()->db->get('tbl_health_insurance_quote');
	    $count = $query->num_rows();
        if($count>0){        	
			$result =  $query->row();
	    } else {
	    	$result = array();
	    }
	    return $result;
	}
}


// function to get ages of insured Person Travel By TravelId
if(!function_exists('getAgesOfInsuredPersonTravelByTravelId')){
	function getAgesOfInsuredPersonTravelByTravelId($travel_id=""){
		CI()->db->where('people_insured_id',$travel_id); 
		$query = CI()->db->get('tbl_travel_people_details');
	    $count = $query->num_rows();
        if($count>0){        	
			$res =  $query->result();
			foreach ($res as $key => $value) {
				$result[] = $value->age;
			}
	    } else {
	    	$result = array();
	    }
	    return $result;
	}
}

if(!function_exists('getUserDetailByUserId')){
	function getUserDetailByUserId($id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
			$query = CI()->db->get('tbl_users');
		    $count = $query->num_rows();
	        if($count>0){        	
				$result    =  $query->row_array();						
		    } else {
		    	$result    = array();
		    }
	    }
	    return $result;
	}
}

if(!function_exists('getPartnerCommissionShareByUserId')){
	function getPartnerCommissionShareByUserId($id){
		/*print_r($id);
		die();*/
	    $result="";
	    if($id>0){
		    CI()->db->where('user_id',$id);
			$query = CI()->db->get('tbl_partner_share');
		    $count = $query->num_rows();
	        if($count>0){        	
				$result    =  $query->row_array();						
		    } else {
		    	$result    = array();
		    }
	    }
	    return $result;
	}
}





// function added by Shiv to get ages of insured Person Heatlh By Health Insurance Id
if(!function_exists('getAgesOfInsuredPersonHealthByHealthId')){
	function getAgesOfInsuredPersonHealthByHealthId($health_insurance_id=""){
		CI()->db->where('id',$health_insurance_id);
		$query  = CI()->db->get('tbl_health_insurance_details');
		$res    = $query->row();
		if($res->health_insurance_type_id == 2) {
			$result[] = $res->age;
		} else {
			$res_chief[] = $res->age;
			CI()->db->where('persons_insured_id',$health_insurance_id);
			$query_family = CI()->db->get('tbl_health_insurance_person_details');
			$count_family = $query_family->num_rows();
			if($count_family>0) {        	
				$res_family   = $query_family->result();
				foreach ($res_family as $key => $value) {
					$result_family[] = $value->age;
				}
				$result = array_merge($res_chief,$result_family);
		    } else {
		    	$result = array();
		    }
		}
	    return $result;
	}
}

if(!function_exists('getCreatedAndExpirationDate')) {
	function getCreatedAndExpirationDate($insurance_type_id,$insured_id) {
		if($insurance_type_id == 1) { //VEHICLE
			$vehicle_detail_id = $insured_id;
			$record['start']  = '';
			$record['end']    = '';
		}
		if($insurance_type_id == 2) { //HEALTH
			$health_insurance_id = $insured_id;
			CI()->db->where('id',$health_insurance_id);
			CI()->db->from('tbl_health_insurance_details');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result()[0];    

			  	$record['start']  = date('d M Y', strtotime($result->start_date));
			  	$record['end']  = date('d M Y', strtotime($result->end_date));
			  	return $record;
			}
			else { 
				return array();
			}
		}
		if($insurance_type_id == 3) { //TRAVEL
			$travel_id =  $insured_id;
			CI()->db->where('people_insured_id',$travel_id);
			CI()->db->from('tbl_travel_destination_details');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result()[0];            
			  	$record['start']  = date('d M Y', strtotime($result->travel_start_date));
			  	$record['end']    = date('d M Y', strtotime($result->travel_end_date));
			  	return $record;
			}
			else { 
				return array();
			}
		}
		if($insurance_type_id == 4) { //PROFESSIONAL MULTIRISK
			$professional_multirisk_quote_id =  $insured_id;
			CI()->db->where('id',$professional_multirisk_quote_id);
			CI()->db->from('tbl_proffesional_multirisk_quote_personal_details');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result()[0];            
			  	$record['start']  = '';
			  	$record['end']    = '';
			  	return $record;
			}
			else { 
				return array();
			}

		}
		if($insurance_type_id == 5) { //INDIVIDUAL ACCIDENT
			$individual_insurance_option_details_id =  $insured_id;
			$record['start']  = '';
			$record['end']    = '';
			return $record;

		}
		if($insurance_type_id == 6) { //CREDIT
			$credit_detail_id =  $insured_id;
			CI()->db->where('id',$credit_detail_id);
			CI()->db->from('tbl_credit_detail');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result()[0];            
			  	$record['start']  = date('d M Y', strtotime($result->credit_insurance_start_date));
			  	$record['end']    = date('d M Y', strtotime($result->credit_insurance_expiry_date));
			  	return $record;
			}
			else { 
				return array();
			}
		}
		if($insurance_type_id == 7) { //HOUSING
			$house_detail_id =  $insured_id;
			CI()->db->where('id',$house_detail_id);
			CI()->db->from('tbl_house_detail');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result()[0];            
			  	$record['start']  = date('d M Y', strtotime($result->from));
			  	$record['end']    = date('d M Y', strtotime($result->to));
			  	return $record;
			}
			else { 
				return array();
			}
		}
	}
}
if(!function_exists('getNetPremiumAccessoriesAndTax')) {
	function getNetPremiumAccessoriesAndTax($insurance_type_id,$insured_id) {

		if($insurance_type_id == 1) { //VEHICLE
			$vehicle_detail_id = $vehicle_detail_id;
			CI()->db->where('vehicle_detail_id',$vehicle_detail_id);
			CI()->db->from('tbl_finalize_vehicle_insurance');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result(); 
	
				foreach ($result as $value) {
					if($value->name == 'net_premium') {
						// print_r($value->value);
						$rec['net_premium'] = $value->value;
					}
					if($value->name == 'accessories') {
						$rec['accessories'] = $value->value;	
					}
					if($value->name == 'tax') {
						$rec['tax'] = $value->value;	
					}
				}           
			  	return $rec;
			}
			else { 
				return array();
			}
		}
		if($insurance_type_id == 2) { //HEALTH
			$health_insurance_id = $insured_id;
			CI()->db->where('health_insurance_id',$health_insurance_id);
			CI()->db->from('tbl_health_insurance_finalize_company');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result(); 
				//print_r($result);
				foreach ($result as $value) {
					if($value->name == 'net_premium') {
						// print_r($value->value);
						$rec['net_premium'] = $value->amount;
					}
					if($value->name == 'accessories') {
						$rec['accessories'] = $value->amount;	
					}
					if($value->name == 'tax') {
						$rec['tax'] = $value->amount;	
					}
				}           
			  	return $rec;
			}
			else { 
				return array();
			}
		}
		if($insurance_type_id == 3) { //TRAVEL
			$travel_id =  $insured_id;
			CI()->db->where('travel_id',$travel_id);
			CI()->db->from('tbl_travel_finalize_company');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result(); 
				foreach ($result as $value) {
					if($value->name == 'net_premium') {
						// print_r($value->value);
						$rec['net_premium'] = $value->amount;
					}
					if($value->name == 'accessories') {
						$rec['accessories'] = $value->amount;	
					}
					if($value->name == 'tax') {
						$rec['tax'] = $value->amount;	
					}
				}           
			  	return $rec;
			}
			else { 
				return array();
			}
		}
		if($insurance_type_id == 4) { //PROFESSIONAL MULTIRISK
			$professional_multirisk_quote_id =  $insured_id;
			CI()->db->where('proffesional_multirisk_quote_id',$professional_multirisk_quote_id);
			CI()->db->from('tbl_finalize_proffesional_multirisk_insurance');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result(); 
				foreach ($result as $value) {
					if($value->name == 'net_premium') {
						// print_r($value->value);
						$rec['net_premium'] = $value->value;
					}
					if($value->name == 'accessories') {
						$rec['accessories'] = $value->value;	
					}
					if($value->name == 'tax') {
						$rec['tax'] = $value->value;	
					}
				}           
			  	return $rec;
			}
			else { 
				return array();
			}

		}
		if($insurance_type_id == 5) { //INDIVIDUAL ACCIDENT

			$individual_insurance_option_details_id =  $insured_id;
			CI()->db->where('individual_insurance_option_details_id',getIndividualInsuranceOptionDetailId($insured_id));

			CI()->db->from('tbl_individual_accident_finalize_company');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result(); 
				foreach ($result as $value) {
					if($value->title == 'net_premium') {
						$rec['net_premium'] = $value->amount_to_pay;
					}
					if($value->title == 'accessories') {
						$rec['accessories'] = $value->amount_to_pay;	
					}
					if($value->title == 'tax') {
						$rec['tax'] = $value->amount_to_pay;	
					}
				}           
			  	return $rec;
			}
			else { 
				return array();
			}

		}
		if($insurance_type_id == 6) { //CREDIT
			$credit_detail_id =  $insured_id;
			CI()->db->where('credit_detail_id',$credit_detail_id);
			CI()->db->from('tbl_finalize_credit_insurance');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result(); 
				foreach ($result as $value) {
					if($value->name == 'net_premium') {
						// print_r($value->value);
						$rec['net_premium'] = $value->value;
					}
					if($value->name == 'accessories') {
						$rec['accessories'] = $value->value;	
					}
					if($value->name == 'tax') {
						$rec['tax'] = $value->value;	
					}
				}           
			  	return $rec;
			}
			else { 
				return array();
			}
		}
		if($insurance_type_id == 7) { //HOUSING
			$house_detail_id =  $insured_id;
			CI()->db->where('house_detail_id',$house_detail_id);
			CI()->db->from('tbl_finalize_housing_insurance');
			$data=CI()->db->get();
			if($data->num_rows()>0) {
				$result = $data->result(); 
				foreach ($result as $value) {
					if($value->name == 'net_premium') {
						// print_r($value->value);
						$rec['net_premium'] = $value->value;
					}
					if($value->name == 'accessories') {
						$rec['accessories'] = $value->value;	
					}
					if($value->name == 'tax') {
						$rec['tax'] = $value->value;	
					}
				}           
			  	return $rec;
			}
			else { 
				return array();
			}
		}	

	}
}

if(!function_exists('getIndividualAccidentQuoteId')) {
	function getIndividualAccidentQuoteId($id) {
		CI()->db->where('id',$id);
		$query = CI()->db->get('tbl_individual_insurance_option_details');
		if($query->num_rows() > 0) {
			$res    = $query->row();
			$result = $res->individual_accident_quote_id;
		} else {
			$result = 0;
		}
		return $result;
	}
}


// function added by Shiv to get individual accident option details id
if(!function_exists('getIndividualInsuranceOptionDetailId')) {
	function getIndividualInsuranceOptionDetailId($insured_id) {
		CI()->db->where('individual_accident_quote_id',$insured_id);
		$query = CI()->db->get('tbl_individual_insurance_option_details');
		if($query->num_rows() > 0) {
			$res    = $query->row();
			$result = $res->id;
		} else {
			$result = 0;
		}
		return $result;
	}
}


// function to get the unique policy id
if(!function_exists('getPolicyId')) {
	function getPolicyId() {
		for ($i = 0; $i<2; $i++) {
    		$a .= mt_rand(0,1);
		}
		$number = checkUniquePolicyId($a);
		return $number;
		// print_r($number);
	}
}

// recursive function to check unique policy id in table payment
if(!function_exists('checkUniquePolicyId')) {
	function checkUniquePolicyId($a) {
		CI()->db->where('policy_number',$a);
		$query = CI()->db->get('tbl_payment');
	    $count = $query->num_rows();
        if($count>0){        	
	    	return checkUniquePolicyId($a+1);
	    } else {
			return $a;					
	    }
	}
}


// function to check unique policy id in the policy table
if(!function_exists('checkUniquePolicyNumber')) {
	function checkUniquePolicyNumber($a) {
		CI()->db->where('policy_number',$a);
		CI()->db->where('insurance_type_id',2); // Health Insurance
		$query = CI()->db->get('tbl_payment');
	    $count = $query->num_rows();
        if($count>0){        	
	    	return $query->row()->id;
	    } else {
			return 0;					
	    }
	}
}

// function added by Shiv to get the payment data 
if(!function_exists('getPaymentData')) {
	function getPaymentData($insurance_type_id,$insured_id) {
		CI()->db->where("insurance_type_id",$insurance_type_id);
		CI()->db->where("insured_id",$insured_id);
		$query = CI()->db->get('tbl_payment');
		if($query->num_rows() > 0) {
			$payment_data = $query->result();
			// echo"<pre>";
 			// print_r($payment_data);die;
			foreach($payment_data as $key => $value) {
				/*payment_status condition start*/
				if($value->payment_status == 0) {
					$payment_status = "Pending";
				}
				else if($value->payment_status == 1) {
					$payment_status = "Fail";
				}
				else if($value->payment_status == 2) {
					$payment_status = "Success";
				}
				else {
					$payment_status = "Expired";
				}
				CI()->db->where('policy_number',$value->policy_number);
				$query2 = CI()->db->get('tbl_quittance');
				// echo"<pre>";
 				// print_r($query2->row());die;	
				/*payment_status condition ends*/

				$result['payment_details']['Name']           = getUserName($value->user_id); 
				$result['payment_details']['Address']           = getUserDetailByUserId($value->user_id)['address']; 
				$result['payment_details']['Insurance Type'] = getInsuranceTypeName($value->insurance_type_id);
				$result['payment_details']['Company Name'] = getCompanyName($value->company_id);  
				$result['payment_details']['Quittance Number'] = $query2->row()->id; 
				//$result['payment_details']['insured_id']        = $value->insured_id; 
				$result['payment_details']['Policy Number']     = $value->policy_number; 
				$result['payment_details']['Transaction Id']    = $value->transaction_id; 
				$result['payment_details']['Payment Method']    = getPaymentMode($value->payment_method); 
				$result['payment_details']['Payment Status']    = $payment_status; 
				$result['payment_details']['policy_start_date'] = $value->policy_start_date;
                $result['payment_details']['policy_end_date']   = $value->policy_end_date;
                $result['payment_details']['policy_creation_date'] = $value->policy_cration_date;
				//$result['payment_details']['amount']            = $value->amount; 
				// Vehicle Insurance Data
				if($value->insurance_type_id == 1) {
					// data of finalize company
					CI()->db->where('vehicle_detail_id',$value->insured_id);
					$query1 = CI()->db->get('tbl_finalize_vehicle_insurance');
					if($query1->num_rows() > 0) {
						foreach ($query1->result() as $data_final) {
							if($data_final->type == 'warranties') {
								$result['vehicle_warranties'][$data_final->name] = $data_final->value;
							} else if($data_final->type == 'franchise') {
								$result['vehicle_franchises'][$data_final->name] = $data_final->value;
							} else {
								$result['data_final']['Selected Company'] = $data_final->company_name;
								$result['data_final'][$data_final->name] = $data_final->value;
								$result['data_final']['Admin Policy Commission'] = $value->admin_policy_commission; 
                                $result['data_final']['Partner Policy Commission'] = $value->partner_policy_commission; 
							}
						}
					}

					// data of vehicle detail
					CI()->db->where('id',$value->insured_id);
					$query2 = CI()->db->get('tbl_vehicle_detail');
					if($query2->num_rows() > 0) {
						foreach ($query2->result() as $key => $vehicle_detail) {
							// $result['vehicle_detail']['user_id']   = $vehicle_detail->user_id;
							// $result['vehicle_detail']['vehicle_basic_info_id']            = $vehicle_detail->vehicle_basic_info_id;
							$result['vehicle_detail']['Tvv']       = $vehicle_detail->tvv;
							$result['vehicle_detail']['Risque Name'] = getRisqueName($vehicle_detail->risque_id);
							$result['vehicle_detail']['Insurance Registeration Date']     = $vehicle_detail->insurance_registeration_date;
							// $result['vehicle_detail']['company_vehicle_quote_id']         = $vehicle_detail->company_vehicle_quote_id;
							$result['vehicle_detail']['Immatriclulation']                 = $vehicle_detail->immatriclulation;
							$result['vehicle_detail']['Registeration Number']             = $vehicle_detail->registeration_number;
							$result['vehicle_detail']['Catalogue Value']                  = $vehicle_detail->catalogue_value;
							$result['vehicle_detail']['Vehicle Identification']           = $vehicle_detail->vehicle_identification;
							// $result['vehicle_detail']['date_release_certificate']         = $vehicle_detail->date_release_certificate;
							$result['vehicle_detail']['Engine Displacement']              = $vehicle_detail->engine_displacement;
							$result['vehicle_detail']['Vehicle Category']                 = $vehicle_detail->vehicle_category;
							$result['vehicle_detail']['Chasis Number']                                  = $vehicle_detail->chasis_number;
							$result['vehicle_detail']['Authroise Weight']                 = $vehicle_detail->authroise_weight;
							$result['vehicle_detail']['Vehicle Type']                                   = getName($vehicle_detail->vehicle_type,'tbl_vehicle_type');
							$result['vehicle_detail']['Gear Box']  = $vehicle_detail->gear_box;
							$result['vehicle_detail']['Tax_bonus'] = $vehicle_detail->tax_bonus;
							$result['vehicle_detail']['Registeration Date']               = $vehicle_detail->registeration_date;
							$result['vehicle_detail']['Current Value']                                  = $vehicle_detail->current_value;
							$result['vehicle_detail']['Previous Register Date']           = $vehicle_detail->previous_register_date;
							$result['vehicle_detail']['Date Of First Release']                 = $vehicle_detail->date_first_release;
							$result['vehicle_detail']['Engine Number']                                    = $vehicle_detail->engine_number;
							$result['vehicle_detail']['Usage']       = $vehicle_detail->usage;
							$result['vehicle_detail']['Body Work']   = $vehicle_detail->body_work;
							$result['vehicle_detail']['Load Weight'] = $vehicle_detail->load_weight;
							$result['vehicle_detail']['Tariff Code'] = $vehicle_detail->tariff_code;
							$result['vehicle_detail']['Seating Capacity']  = $vehicle_detail->seating_capacity;
						}
					}

					// data of vehicle owner 
					CI()->db->where('vehicle_detail_id',$value->insured_id);
					$query3 = CI()->db->get('tbl_vehicle_owner_detail');
					if($query3->num_rows() > 0) {
						foreach ($query3->result() as $vehicle_owner_detail) {
							$result['vehicle_owner_detail']['owner']                = $vehicle_owner_detail->owner;
							$result['vehicle_owner_detail']['address']               = $vehicle_owner_detail->address;
							$result['vehicle_owner_detail']['region_id']     = $vehicle_owner_detail->region_id;
							$result['vehicle_owner_detail']['department_id'] = $vehicle_owner_detail->department_id;
							$result['vehicle_owner_detail']['commune_id']    = $vehicle_owner_detail->commune_id;
							$result['vehicle_owner_detail']['document']              = $vehicle_owner_detail->document;
						}
					}
					

					// data of secondary driver
					CI()->db->where('vehicle_detail_id',$value->insured_id);
					$query4 = CI()->db->get('tbl_vehicle_secondry_driver');
					if($query4->num_rows() > 0) {
						foreach ($query4->result() as $vehicle_secondry_driver) {
							$result['vehicle_secondry_driver']['owner']                    = $vehicle_secondry_driver->owner;
							$result['vehicle_secondry_driver']['name']                     = $vehicle_secondry_driver->name;
							$result['vehicle_secondry_driver']['issue_date_license']  = $vehicle_secondry_driver->issue_date_license;
							$result['vehicle_secondry_driver']['year_license_expire'] = $vehicle_secondry_driver->year_license_expire;
							$result['vehicle_secondry_driver']['license_number']      = $vehicle_secondry_driver->license_number;
							$result['vehicle_secondry_driver']['permit_id']           = $vehicle_secondry_driver->permit_id;
							$result['vehicle_secondry_driver']['double_command']      = $vehicle_secondry_driver->double_command;	
						}
					}


					// data of bonus 
					CI()->db->where('vehicle_detail_id',$value->insured_id);
					$query5 = CI()->db->get('tbl_selected_bonus');
					if($query5->num_rows() > 0) {
						foreach ($query5->result() as $vehicle_selected_bonus) {
							$result['vehicle_selected_bonus']['value_selected_bonus_option'] = $vehicle_selected_bonus->value_selected_bounus_option;	
							$result['vehicle_selected_bonus']['document_image']              = $vehicle_selected_bonus->document_image;	
							$result['vehicle_selected_bonus']['approved_status']             = $vehicle_selected_bonus->approved_status;	
						}
					}

					// data of premium duration
					CI()->db->where('vehicle_detail_id',$value->insured_id);
					$query6 = CI()->db->get('tbl_selected_premium');
					
					if($query6->num_rows() > 0) {
						foreach ($query6->result() as $vehicle_selected_premium) {
							# code...
							$result['vehicle_selected_premium']['premium_id']   = $vehicle_selected_premium->premium_id;
							$result['vehicle_selected_premium']['from_']        = $vehicle_selected_premium->from_;
							$result['vehicle_selected_premium']['to_']              = $vehicle_selected_premium->to_;
							$result['vehicle_selected_premium']['tacit_policy'] = $vehicle_selected_premium->tacit_policy;
						}

					}
					return $result;	
					// print_r($result);
				}

				// Health Insurance Data 
				else if($value->insurance_type_id == 2) {

					// data of finalize company
					CI()->db->where('health_insurance_id',$value->insured_id);
					$query1 = CI()->db->get('tbl_health_insurance_finalize_company');
					if($query1->num_rows() > 0) {
						foreach ($query1->result() as $data_final_health) {
							$result['data_final_health']['Selected Company'] = getCompanyName($data_final_health->company_id);
							$result['data_final_health'][$data_final_health->name] = $data_final_health->amount;
							$result['data_final_health']['Admin Policy Commission'] = $value->admin_policy_commission; 
                            $result['data_final_health']['Partner Policy Commission'] = $value->partner_policy_commission; 
						}
					}

					// data of health insurance detail
					CI()->db->where('id',$value->insured_id);
					$query2 = CI()->db->get('tbl_health_insurance_details');
					if($query2->num_rows() > 0) {
						foreach ($query2->result() as $health_insurance_detail) {
							// $result['health_insurance_detail']['user_id'] = $health_insurance_detail->user_id;
							$result['health_insurance_detail']['Health Insurance Type'] = getName($health_insurance_detail->health_insurance_type_id,'tbl_health_insurance_type');
							if($health_insurance_detail->health_insurance_type_id == 1) {
								$result['health_insurance_detail']['Name Of Chief'] = $health_insurance_detail->name_of_chief;
								$result['health_insurance_detail']['Age Of Chief'] = $health_insurance_detail->age_of_chief;
								$result['health_insurance_detail']['No Of Persons to be Insured'] = $health_insurance_detail->persons_insured;
							} else {
								$result['health_insurance_detail']['First Name'] = $health_insurance_detail->first_name;
								$result['health_insurance_detail']['Last Name'] = $health_insurance_detail->last_name;
								// $result['health_insurance_detail']['Age Of Person'] = $health_insurance_detail->age_person;
								$result['health_insurance_detail']['Age Of Person'] = $health_insurance_detail->age;
							}
							
							$result['health_insurance_detail']['Insurance Start Date'] = $health_insurance_detail->start_date;
							$result['health_insurance_detail']['Insurance End Date'] = $health_insurance_detail->end_date;
							$result['health_insurance_detail']['Policy Coverage Area'] = getName($health_insurance_detail->policy_coverage_area_id,'tbl_policycoverage_area');
							$result['health_insurance_detail']['Claim Reimbursement Rate'] = $health_insurance_detail->claim_reimbursement_rate;
							$result['health_insurance_detail']['Amount To Pay'] = $health_insurance_detail->amount_to_pay;
							if($health_insurance_detail->health_insurance_type_id == 1) {
								CI()->db->where('persons_insured_id',$value->insured_id);
								$query3 = CI()->db->get('tbl_health_insurance_person_details');
								if($query3->num_rows() > 0) {
									$k = 1;
									foreach($query3->result() as $health_insurance_person_details) {
										// $result['health_insurance_person_details']['persons_insured_id']   = $health_insurance_person_details->persons_insured_id;
										$result['health_insurance_person_details']['Full Name Of Person '.$k] = $health_insurance_person_details->full_name;
										// $result['health_insurance_person_details']['Age of Each Person']   = $health_insurance_person_details->age_of_each_person;
										$result['health_insurance_person_details']['Age Of Person '.$k]       = $health_insurance_person_details->age;
										$k++;
									}
								}
							}
						}
					}
				}

				// Travel Insurance Data
				else if($value->insurance_type_id == 3) {

					// data of finalize company
					CI()->db->where('travel_id',$value->insured_id);
					$query1 = CI()->db->get('tbl_travel_finalize_company');
					
					if($query1->num_rows() > 0) {
						foreach ($query1->result() as $data_final_travel) {
							$result['data_final_travel']['Selected Company'] = getCompanyName($data_final_travel->company_id);
							$result['data_final_travel'][$data_final_travel->name] = $data_final_travel->amount;
							$result['data_final_travel']['Admin Policy Commission'] = $value->admin_policy_commission; 
                            $result['data_final_travel']['Partner Policy Commission'] = $value->partner_policy_commission; 
						}
					}

					// data of travel people insured
					CI()->db->where('id',$value->insured_id);
					$query2 = CI()->db->get('tbl_travel_people_insured');
					
					if($query2->num_rows() > 0) {
						foreach ($query2->result() as $travel_people_insured) {
							// $result['travel_people_insured']['user_id'] = $travel_people_insured->user_id;
							$result['travel_people_insured']['No Of People To Be Insured'] = $travel_people_insured->people_insured;
						}
					}

					// data of insured people details 
					CI()->db->where('people_insured_id',$value->insured_id);
					$query3 = CI()->db->get('tbl_travel_people_details');
					if($query3->num_rows() > 0) {
						$l = 1; 
						foreach ($query3->result() as $travel_people_details) {
							$result['travel_people_details']['First Name Of People '.$l] = $travel_people_details->first_name;
							$result['travel_people_details']['Last Name Of People '.$l] = $travel_people_details->last_name;
							// $result['travel_people_details']['Age Of People '.$l]         = $travel_people_details->age_of_person;
							$result['travel_people_details']['Age Of People '.$l]         = $travel_people_details->age;
							$l++;
						}
					}

					// data of travel destination 
					CI()->db->where('people_insured_id',$value->insured_id);
					$query4 = CI()->db->get('tbl_travel_destination_details');
					if($query4->num_rows() > 0) {
						foreach ($query4->result() as $travel_destination_details) {
							$result['travel_destination_details']['Travel Start Date']   = $travel_destination_details->travel_start_date;
							$result['travel_destination_details']['Travel End Date']     = $travel_destination_details->travel_end_date;
							$result['travel_destination_details']['Destination Of Trip'] = $travel_destination_details->destination_of_trip;
							$result['travel_destination_details']['Total No Of Travelers']     = $travel_destination_details->total_travelers;
						}
					}
				}

				// Professional Multirisk Insurance Data
				else if($value->insurance_type_id == 4) {

					// data of finalize company
					CI()->db->where('proffesional_multirisk_quote_id',$value->insured_id);
					$query1 = CI()->db->get('tbl_finalize_proffesional_multirisk_insurance');
					if($query1->num_rows() > 0) {
						foreach ($query1->result() as $data_final_professional_multirisk) {
							if($data_final_professional_multirisk->type == 'warranties') {
								$result['professional_multirisk_warranties'][$data_final_professional_multirisk->name] = $data_final_professional_multirisk->value;
							} else if($data_final_professional_multirisk->type == 'franchise') {
								$result['professional_multirisk_franchises'][$data_final_professional_multirisk->name] = $data_final_professional_multirisk->value;
							}
							$result['data_final_professional_multirisk'][$data_final_professional_multirisk->name] = $data_final_professional_multirisk->value;
							$result['data_final_professional_multirisk']['Admin Policy Commission'] = $value->admin_policy_commission; 
                            $result['data_final_professional_multirisk']['Partner Policy Commission'] = $value->partner_policy_commission; 
						}
					}

					// data of professional multirisk quote
					CI()->db->where('id',$value->insured_id);
					$query2 = CI()->db->get('tbl_proffesional_multirisk_quote_personal_details');
					if($query2->num_rows() > 0) {
						foreach ($query2->result() as $proffesional_multirisk_quote_details) {
							if($professional_multirisk_quote_details->document == '') {
								$document = 'Not Available';
							} else {
								$document = $professional_multirisk_quote_details->document;
							}

							if($professional_multirisk_quote_details->tacit_policy == 0) {
								$tacit_policy = 'No';
							} else {
								$tacit_policy = 'Yes';
							}

							$result['proffesional_multirisk_quote_details']['Address'] = $proffesional_multirisk_quote_details->address;
							$result['proffesional_multirisk_quote_details']['Business Address'] = $proffesional_multirisk_quote_details->business_address;
							$result['proffesional_multirisk_quote_details']['Dial Code'] = $proffesional_multirisk_quote_details->dial_code;
							$result['proffesional_multirisk_quote_details']['Contact Number'] = $proffesional_multirisk_quote_details->contact_number;
							$result['proffesional_multirisk_quote_details']['Document'] = $document;
							$result['proffesional_multirisk_quote_details']['Tacit Policy'] = $tacit_policy;
							$result['proffesional_multirisk_quote_details']['Selected Activity Name'] = getName($proffesional_multirisk_quote_details->activity_id,'tbl_activity');
							$result['proffesional_multirisk_quote_details']['Capital Insured'] = $proffesional_multirisk_quote_details->capital_insured;
							$result['proffesional_multirisk_quote_details']['Selected Company'] = getCompanyName($proffesional_multirisk_quote_details->company_selected);
							$result['proffesional_multirisk_quote_details']['Branch Name'] = getBranchName(getProffesionalBranchId());
							$result['proffesional_multirisk_quote_details']['Risque Name'] = getRisqueName(getProffesionalRisqueId());
						}
					}
				}

				// Individual Accident Insurance Data
				else if($value->insurance_type_id == 5) {
					
					// data of individual insurance option details
					CI()->db->where('individual_accident_quote_id',$value->insured_id);
					$query1 = CI()->db->get('tbl_individual_insurance_option_details');
					if($query1->num_rows() > 0) {
						$individual_insurance_option_details = $query1->row();
						// print_r($individual_insurance_option_details);
						// data of finalize company
						CI()->db->where('individual_insurance_option_details_id',$individual_insurance_option_details->id);
						$query2 = CI()->db->get('tbl_individual_accident_finalize_company');
						if($query2->num_rows() > 0) {
							foreach ($query2->result() as $data_final_individual_accident) {
								$result['data_final_individual_accident']['Selected Company'] = getCompanyName($data_final_individual_accident->company_id);
								$result['data_final_individual_accident'][$data_final_individual_accident->title] = $data_final_individual_accident->amount_to_pay;
								$result['data_final_individual_accident']['Admin Policy Commission'] = $value->admin_policy_commission; 
                                $result['data_final_individual_accident']['Partner Policy Commission'] = $value->partner_policy_commission; 
							}
						}
					}	

					
					// data of individual accident quote personal details
					CI()->db->where('id',$value->insured_id);
					$query3 = CI()->db->get('tbl_individual_accident_quote_personal_details');
					if($query2->num_rows() > 0) {
						foreach ($query3->result() as $individual_accident_person_details) {
							if($individual_accident_person_details->document == '') {
								$document = 'Not Available';
							} else {
								$document = $individual_accident_person_details->document;
							}

							if($individual_accident_person_details->tacit_policy == 0) {
								$tacit_policy = 'No';
							} else {
								$tacit_policy = 'Yes';
							}
							// $result['individual_accident_person_details']['user_id'] = $individual_accident_person_details->user_id;
							$result['individual_accident_person_details']['Selected Activity Name'] = getName($individual_accident_person_details->individual_accident_activity_id,'tbl_activity');
							$result['individual_accident_person_details']['Name'] = $individual_accident_person_details->name;
							$result['individual_accident_person_details']['Address'] = $individual_accident_person_details->address;
							$result['individual_accident_person_details']['Business Address'] = $individual_accident_person_details->business_address;
							$result['individual_accident_person_details']['Dial Code'] = $individual_accident_person_details->dial_code;
							$result['individual_accident_person_details']['Contact Number'] = $individual_accident_person_details->contact_number;
							$result['individual_accident_person_details']['Document'] = $document;
							$result['individual_accident_person_details']['Tacit Policy'] = $tacit_policy;
						}
					}
				}

				// Credit Insurance Data
				else if($value->insurance_type_id == 6) {

					// data of finalize company_id
					CI()->db->where('credit_detail_id',$value->insured_id);
					$query1 = CI()->db->get('tbl_finalize_credit_insurance');
					if($query1->num_rows() > 0) {
						foreach ($query1->result() as $data_final_credit) {
							if($data_final_credit->type == 'warranties') {
								$result['credit_warranties'][$data_final_credit->name] = $data_final_credit->value;
							}
							else {
								$result['data_final_credit'][$data_final_credit->name] = $data_final_credit->value;
								$result['data_final_credit']['Admin Policy Commission'] = $value->admin_policy_commission; 
                                $result['data_final_credit']['Partner Policy Commission'] = $value->partner_policy_commission; 
							}
						}
					}
					// data of credit insurance detail
					CI()->db->where('id',$value->insured_id);
					$query2 = CI()->db->get('tbl_credit_detail');
					
					if($query2->num_rows() > 0) {
						foreach ($query2->result() as $credit_detail) {
							// $result['credit_detail']['user_id']   = $credit_detail->user_id;
							$result['credit_detail']['Insurance Start Date']     = $credit_detail->credit_insurance_start_date;
							$result['credit_detail']['Insurance Expiry Date']    = $credit_detail->credit_insurance_expiry_date;
							$result['credit_detail']['Insurance Loan Amount']    = $credit_detail->credit_insurance_loan_amount;
							$result['credit_detail']['Insurance Loan Duration']  = $credit_detail->credit_insurance_loan_duration;
							$result['credit_detail']['Insurance Rate']           = $credit_detail->credit_insurance_rate;
							$result['credit_detail']['Insurance Loan Size']      = $credit_detail->credit_insurance_loan_size;
							$result['credit_detail']['Bank Loan Monthly Payment'] = $credit_detail->credit_bank_loan_monthly_payment;
							// $result['credit_detail']['Date Of Birth Of Customer'] = $credit_detail->credit_insurance_customer_dob;
							$result['credit_detail']['Age Of Customer']    = $credit_detail->credit_insurance_customer_age;
							$result['credit_detail']['Risque Name']        = getRisqueName($credit_detail->risque_id);
							// $result['credit_detail']['credit_tarification_id']           = $credit_detail->credit_tarification_id;
							$result['credit_detail']['Selected Company']     = getCompanyName($credit_detail->company_selected);
						}
					}

					// data of credit calculation rate
					CI()->db->where('credit_detail_id',$value->insured_id);
					$query3 = CI()->db->get('tbl_credit_calculation_rate_details');
					if($query3->num_rows() > 0) {
						foreach ($query3->result() as $credit_calculation_rate_details) {
							if($credit_calculation_rate_details->rate_calculation_type == 0) {
								$rate_calculation_type = 'Fixed';
							} else {
								$rate_calculation_type = 'Variable';
							}
							$result['credit_calculation_rate_details']['Rate Calculation Type']   = $rate_calculation_type;
							$result['credit_calculation_rate_details']['Rate Calculation Amount'] = $credit_calculation_rate_details->rate_calculation_amount;
							
							// check whether the rate calculation is fixed or variable (1 => Variable, 0 => Fixed)
							if($credit_calculation_rate_details->rate_calculation_type == 1) {
								CI()->db->where('credit_calculation_rate_details_id',$credit_calculation_rate_details->id);
								$query4 = CI()->db->get('tbl_credit_calculation_rate_details_by_year');
								if($query4->num_rows() > 0) {
									$i = 1;
									foreach($query4->result() as $credit_calculation_rate_details_by_year) {
										// $result['credit_calculation_rate_details_by_year']['credit_calculation_rate_details_id_'.$i] = $credit_calculation_rate_details_by_year->credit_calculation_rate_details_id;
										// $result['credit_calculation_rate_details_by_year']['credit_amount_year_'.$i] = $credit_calculation_rate_details_by_year->credit_amount_year;
										$result['credit_calculation_rate_details_by_year']['Credit Amount Of Year '.$i] = $credit_calculation_rate_details_by_year->credit_amount_value;
										$i++;
									}
								}	
							}
						}
					}

					// data of credit insurance optional warranties
					CI()->db->where('credit_detail_id',$value->insured_id);
					$query5 = CI()->db->get('tbl_selected_optional_warranty_credit');
					if($query5->num_rows() > 0) {
						$j = 0;
						foreach ($query5->result() as $selected_optional_warranty_credit) {
							$result['selected_optional_warranty_credit']['optional_warranty_id'][$j] = $selected_optional_warranty_credit->optional_warranty_id;
							$result['selected_optional_warranty_credit']['type_of_warranties_id'][$j] = $selected_optional_warranty_credit->type_of_warranties_id;
							$j++;
						}
					}
				}

				// House Insurance Data
				else if($value->insurance_type_id == 7) {
					// data of finalize company
					CI()->db->where('house_detail_id',$value->insured_id);
					$query1 = CI()->db->get('tbl_finalize_housing_insurance');
					if($query1->num_rows() > 0) {
						foreach ($query1->result() as $data_final_house) {
							if($data_final_house->type == 'warranties') {
								$result['house_warranties'][$data_final_house->name] = $data_final_house->value;
							} else if($data_final_house->type == 'franchise') {
								$result['house_franchises'][$data_final_house->name] = $data_final_house->value;
							} else {
								$result['data_final_house'][$data_final_house->name] = $data_final_house->value;
								$result['data_final_house']['Admin Policy Commission'] = $value->admin_policy_commission; 
                                $result['data_final_house']['Partner Policy Commission'] = $value->partner_policy_commission; 
							}
						}
					}

					// data of house detail
					CI()->db->where('id',$value->insured_id);
					$query2 = CI()->db->get('tbl_house_detail');
					if($query2->num_rows() > 0) {
						foreach ($query2->result() as $house_detail) {
							// $result['house_detail']['user_id'] = $house_detail->user_id;
							$result['house_detail']['Insurer Quality']           = getName($house_detail->insurer_quality_id,'tbl_insurer_quality');
							$result['house_detail']['Room']    = $house_detail->room;
							$result['house_detail']['Monthly Rent'] = $house_detail->monthly_rent;
							$result['house_detail']['Content Value'] = $house_detail->content_value;
							$result['house_detail']['Building Value'] = $house_detail->building_value;
							$result['house_detail']['Superficy'] = $house_detail->superficy;
							$result['house_detail']['House Type'] = getName($house_detail->house_type_id,'tbl_house_type');
							$result['house_detail']['House Category'] = getName($house_detail->house_category_id,'tbl_house_category');
							$result['house_detail']['Time Interval'] = getName($house_detail->month_id,'tbl_house_month');
							$result['house_detail']['From']           = $house_detail->from;
							$result['house_detail']['To']           = $house_detail->to;
							$result['house_detail']['Risque Name']         = getRisqueName($house_detail->risque_id);
							$result['house_detail']['Selected Company'] = getCompanyName($house_detail->company_selected);
							// $result['house_detail']['house_tarification_id']          = $house_detail->house_tarification_id;
						}
					}
				}
			}
		} else {
			$result = '';
		}
		return $result;
	}
}



if(!function_exists('getCompanyNameByInsuranceTypeAndInsuredId')){
	function getCompanyNameByInsuranceTypeAndInsuredId($insurance_type_id,$insured_id){
		if ($insurance_type_id == 1) { // vehicle
		   	CI()->db->where('vehicle_detail_id',$insured_id);
			$query = CI()->db->get('tbl_finalize_vehicle_insurance');
			$count = $query->num_rows();
			if ($count>0) {
				$res    = $query->row();
				$result = getCompanyLogo($res->company_name);
			}
			else {
				$result = '';
			}
			return $result;
 	
		}
		else if($insurance_type_id == 2) { // health
		    CI()->db->where('health_insurance_id',$insured_id);
			$query = CI()->db->get('tbl_health_insurance_finalize_company');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result = getCompanyLogo($res->company_id);
		    } else {
		    	$result = '';
		    }
		    return $result;
		}    
		else if($insurance_type_id == 3) { // travel	
		    CI()->db->where('travel_id',$insured_id);
			$query = CI()->db->get('tbl_travel_finalize_company');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result =  getCompanyLogo($res->company_id);
		    } else {
		    	$result = '';
		    }
		    return $result;
		}    
		else if($insurance_type_id == 4) { // professional
			CI()->db->where('proffesional_multirisk_quote_id',$insured_id);
			$query = CI()->db->get('tbl_finalize_proffesional_multirisk_insurance');
		    $count = $query->num_rows();
	        if($count>0){        	
				$res    =  $query->row();
				$result = getCompanyLogo($res->company_id);
		    } else {
		    	$result = '';
		    }
		    return $result;

		}    
		else if($insurance_type_id == 5) { // individual accident
			CI()->db->where('individual_insurance_option_details_id',$insured_id);
			$query = CI()->db->get('tbl_individual_accident_finalize_company');
			$count = $query->num_rows();
			if ($count>0) {
				$res    = $query->row();
				$result = getCompanyLogo($res->company_id);
			}
			else {
				$result = '';
			}
			return $result;

		}    
		else if($insurance_type_id == 6) { // credit

			CI()->db->where('credit_detail_id',$insured_id);
			$query = CI()->db->get('tbl_finalize_credit_insurance');
			$count = $query->num_rows();
			if ($count>0) {
				$res    = $query->row();
				$result = getCompanyLogo($res->company_name);
			}
			else {
				$result = '';
			}
			return $result;

		}    
		else if($insurance_type_id == 7) { // Housing
			CI()->db->where('house_detail_id',$insured_id);
			$query = CI()->db->get('tbl_finalize_housing_insurance');
			$count = $query->num_rows();
			if ($count>0) {
				$res    = $query->row();
				$result = getCompanyLogo($res->company_name);
			}
			else {
				$result = '';
			}
			return $result;
		}
	}
}

// function to get company name
if(!function_exists('getCompanyLogo')){
	function getCompanyLogo($id){
	    $result="";
	    CI()->db->where('id',$id);
		$query       = CI()->db->get('tbl_company');
	    $count       = $query->num_rows();
        if($count>0){        	
			$res     =  $query->row();

			$image   = $res->image;	
			if(!empty($image)) {
				$result  = base_url($image)	;				
			} else {
	    		$result  = base_url('assets/admin/images/no_image.jpg');
			}
	    } else {
	    	$result  = base_url('assets/admin/images/no_image.jpg');
	    }
	
	    return $result;
	}
}


// function added by Shiv to get companyid by User Id
if(!function_exists('getCompanyIdByUserId')) {
	function getCompanyIdByUserId($user_id) {
		CI()->db->where('user_id',$user_id);
		$query = CI()->db->get('tbl_company');
		if($query->num_rows() > 0) {
			$res = $query->row();
			$result = $res->id;
		} else {
			$result = 0;
		}
		return $result;
	}
}

// function added by Shiv to get userid by Company Id
if(!function_exists('getUserIdByCompanyId')) {
	function getUserIdByCompanyId($id) {
		CI()->db->where('id',$id);
		$query = CI()->db->get('tbl_company');
		if($query->num_rows() > 0) {
			$res = $query->row();
			$result = $res->user_id;
		} else {
			$result = 0;
		}
		return $result;
	}
}

if(!function_exists('getInsuranceTypeIds')) {
	function getInsuranceTypeIds() {
		$query = CI()->db->get('tbl_insurance_type');
		if($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($res as $key => $value) {
				$result[$key] = $value->id;
			}
		} else {
			$result = 0;
		}
		return $result;
	}
}


if(!function_exists('getFinalizedInsuranceDetails')) {
	function getFinalizedInsuranceDetails($insured_id,$insurance_type_id) {
		if($insurance_type_id == 1) { // VEHICLE
			CI()->db->where('vehicle_detail_id',$insured_id);
			$query = CI()->db->get('tbl_finalize_vehicle_insurance');
			if($query->num_rows() > 0) {
				$res = $query->result();
				foreach ($res as $key => $value) {
					$result['company_id'] = $value->company_id;
					$result['branch_id']  = getBranchIdByName();
					$result['risque_id']  = getRisqueIdByVehicleDetailId($insured_id);
					$result['user_id']    = getUserIdFromInsuranceDetails($insured_id,'tbl_vehicle_detail');
					$result[$value->name] = $value->value;
					$insurance_dates      = getVehicleStartEndDate($insured_id);
					$result['policy_start_date'] = $insurance_dates->start_date;
					$result['policy_end_date']   = date("Y-m-d H:i:s", strtotime("+1 years", strtotime($insurance_dates->start_date)));
				}
			}
		} else if($insurance_type_id == 2) { //HEALTH
			CI()->db->where('health_insurance_id',$insured_id);
			$query = CI()->db->get('tbl_health_insurance_finalize_company');
			if($query->num_rows() > 0) {
				$res = $query->result();
				foreach ($res as $key => $value) {
					$result['company_id'] = $value->company_id;
					$result['branch_id']  = $value->branch_id;
					$result['risque_id']  = $value->risque_name;
					$result['user_id']    = getUserIdFromInsuranceDetails($insured_id,'tbl_health_insurance_details');
					$result[$value->name] = $value->amount;
					$insurance_dates      = getHealthStartEndDate($insured_id);
					$result['policy_start_date'] = $insurance_dates->start_date;
					$result['policy_end_date']   = $insurance_dates->end_date;
				}
			}
		} else if($insurance_type_id == 3) { //TRAVEL
			CI()->db->where('travel_id',$insured_id);
			$query = CI()->db->get('tbl_travel_finalize_company');
			if($query->num_rows() > 0) {
				$res = $query->result();
				foreach ($res as $key => $value) {
					$result['company_id'] = $value->company_id;
					$result['branch_id']  = $value->branch_id;
					$result['risque_id']  = $value->risque_name;
					$result['user_id']    = getUserIdFromInsuranceDetails($insured_id,'tbl_travel_people_insured');
					$result[$value->name] = $value->amount;
					$insurance_dates      = getTravelStartEndDate($insured_id);
					$result['policy_start_date'] = $insurance_dates->travel_start_date;
					$result['policy_end_date']   = $insurance_dates->travel_end_date;
				}
			}
		} else if($insurance_type_id == 4) { // PROFESSIONAL MULTIRISK
			CI()->db->where('proffesional_multirisk_quote_id',$insured_id);
			$query = CI()->db->get('tbl_finalize_proffesional_multirisk_insurance');
			if($query->num_rows() > 0) {
				$res = $query->result();
				foreach ($res as $key => $value) {
					$result['company_id'] = $value->company_id;
					$result['branch_id']  = getProffesionalBranchId();
					$result['risque_id']  = getProffesionalRisqueId();
					$result['user_id']    = getUserIdFromInsuranceDetails($insured_id,'tbl_proffesional_multirisk_quote_personal_details');
					$result[$value->name] = $value->value;
					$result['policy_start_date'] = date("Y-m-d H:i:s");
					$result['policy_end_date']   = date("Y-m-d H:i:s", strtotime("+1 years", strtotime($result['policy_start_date'])));

				}
			}
		} else if($insurance_type_id == 5) { // INDIVIDUAL ACCIDENT
			CI()->db->where('individual_accident_quote_id',$insured_id);
			$query = CI()->db->get('tbl_individual_insurance_option_details');
			$res = $query->row();
			if($query->num_rows() > 0) {
				CI()->db->where('individual_insurance_option_details_id',$res->id);
				$query_final = CI()->db->get('tbl_individual_accident_finalize_company');

				if($query_final->num_rows() > 0) {
					$res_final = $query_final->result();
					foreach ($res_final as $key => $value) {
						$result['company_id'] = $value->company_id;
						$result['branch_id']  = getIndividualAccidentBranchId();
						$result['risque_id']  = getIndividualAccidentRisqueId();
						$result['user_id']    = getUserIdFromInsuranceDetails($insured_id,'tbl_individual_accident_quote_personal_details');
						$result[$value->title] = $value->amount_to_pay;
						$result['policy_start_date'] = date("Y-m-d H:i:s");
						$result['policy_end_date']   = date("Y-m-d H:i:s", strtotime("+1 years", strtotime($result['policy_start_date'])));
					}
				}
			}
		} else if($insurance_type_id == 6) { // CREDIT
			CI()->db->where('credit_detail_id',$insured_id);
			$query = CI()->db->get('tbl_finalize_credit_insurance');
			if($query->num_rows() > 0) {
				$res = $query->result();
				foreach ($res as $key => $value) {
					$result['company_id'] = $value->company_id;
					$result['branch_id']  = getCreditBranchId();
					$result['risque_id']  = getRisqueIdByCreditId($insured_id);
					$result['user_id']    = getUserIdFromInsuranceDetails($insured_id,'tbl_credit_detail');
					$result[$value->name] = $value->value;
					$insurance_dates      = getCreditStartEndDate($insured_id);
					$result['policy_start_date'] = $insurance_dates->credit_insurance_start_date;
					$result['policy_end_date']   = $insurance_dates->credit_insurance_expiry_date;
				}
			}
		} else { // HOUSE
			CI()->db->where('house_detail_id',$insured_id);
			$query = CI()->db->get('tbl_finalize_housing_insurance');	
			if($query->num_rows() > 0) {
				$res = $query->result();
				foreach ($res as $key => $value) {
					$result['company_id'] = $value->company_id;
					$result['branch_id']  = getHousingBranchId();
					$result['risque_id']  = getRisqueIdByHouseId($insured_id);
					$result['user_id']    = getUserIdFromInsuranceDetails($insured_id,'tbl_house_detail');
					$result[$value->name] = $value->value;
					$result['policy_start_date'] = date("Y-m-d H:i:s");
					$result['policy_end_date']   = date("Y-m-d H:i:s", strtotime("+1 years", strtotime($result['policy_start_date'])));
				}
			}
		}

		return $result;
	}
}


// function added by Shiv to get the admin and company share in the accessories amount
if(!function_exists('getAccessoriesAmountShare')) {
	function getAccessoriesAmountShare($accessories_id) {
		CI()->db->select('amount,admin_share,company_share');
		CI()->db->where('id',$accessories_id);
		$query = CI()->db->get('tbl_accessories');
		$count = $query->num_rows();
		if($count > 0) {
			$res = $query->row();
			$result['accessories_admin_share']   = ($res->amount*$res->admin_share)/100;
			$result['accessories_company_share'] = ($res->amount*$res->company_share)/100;
		} else {
			$result = '';
		}
		return $result;
	}
}

if(!function_exists('getAdminPolicyShare')) {
	function getAdminPolicyShare($accessories_id) {
		CI()->db->select('admin_policy_share');
		CI()->db->where('id',$accessories_id);
		$query = CI()->db->get('tbl_accessories');
		$count = $query->num_rows();
		if($count > 0) {
			$res = $query->row();
			$result = $res->admin_policy_share;
		} else {
			$result = '';
		}
		return $result;
	}
}


if(!function_exists('getPaymentMode')) {
	function getPaymentMode($id) {
		CI()->db->where('method_id',$id);
		$query = CI()->db->get('tbl_payment_method');
		$res = $query->row();
		if($query->num_rows() > 0) {
			$result = $res->name;	
		} else {
			$result = '';
		}
		return $result;
	}	
}

// function to get the years
if(!function_exists('getYears')) {
	function getYears() {
        $years = array('' => 'Please Select') + array_combine(range(date("Y"), 1945), range(date("Y"), 1945));
        return $years;
    }
}

// function to get the months
if(!function_exists('getMonths')) {
	function getMonths() {
	$month = array( ""    => "Please Select",
                    "JAN" => "January", 
                    "FEB" => "February", 
                    "MAR" => "March", 
                    "APR" => "April",
                    "MAY" => "May", 
                    "JUN" => "June", 
                    "JUL" => "July", 
                    "AUG" => "August",
                    "SEP" => "September", 
                    "OCT" => "October", 
                    "NOV" => "November", 
                    "DEC" => "December",
                );
        return $month;
    }
}

// function to get the slips created by
if(!function_exists('getCreatedBy')) {
	function getCreatedBy() {
	$created_by = array( ""    => "Please Select",
                         "1"   => "Admin", 
                         "4"   => "Company", 
                );
        return $created_by;
    }
}

// function to get the slips created by for partner
if(!function_exists('getCreatedByForPartner')) {
	function getCreatedByForPartner() {
	$created_by = array( ""    => "Please Select",
                         "1"   => "Admin", 
                         "3"   => "Partner", 
                );
        return $created_by;
    }
}

// function to get the policy numbers for a slip number
if(!function_exists('getPolicyNumbersForSlip')) {
	function getPolicyNumbersForSlip($slip) {
		$options = array();	 
		CI()->db->where('slip_name',$slip);  
		$query   = CI()->db->get('tbl_slip_policy');
		$skills  =  $query->result();
		foreach ($skills as $value) {
			$options[$value->policy_number] = $value->policy_number;
		}
		return $options;
	}
}


if(!function_exists('getSlipNumber()')){
	function getSlipNumber(){
	    $result="";
		CI()->db->order_by('id',"desc");
        CI()->db->limit(1);
		$query = CI()->db->get('tbl_slip_data');
	    $count = $query->num_rows();
        if($count>0){        	
			$res    =  $query->row();
			$result = $res->slip_number;						
	    } else {
	    	$result = 001;
	    }
	    return $result;
	}
}



if(!function_exists('download_file')) {
	function download_file() {

		if(!empty($_GET['file'])){
   			$fileName = basename($_GET['file']);
    		$filePath = 'files/'.$fileName;
    		if(!empty($fileName) && file_exists($filePath)){
		        // Define headers
		        header("Cache-Control: public");
		        header("Content-Description: File Transfer");
		        header("Content-Disposition: attachment; filename=$fileName");
		        header("Content-Type: application/zip");
		        header("Content-Transfer-Encoding: binary");
		        // Read the file
		        readfile($filePath);
        		exit;
    		}
    		else{
        		echo 'The file does not exist.';
    		}	
		}
	}
}


if(!function_exists('getSelectedBonusOptionId')) {
	function getSelectedBonusOptionId($vehicle_detail_id){
		CI()->db->where('vehicle_detail_id',$vehicle_detail_id);
		$query = CI()->db->get('tbl_selected_bonus');
		$res   = $query->row();
		if($query->num_rows() > 0) {
			$result = $res->value_selected_bounus_option;
		} else {
			$result = 0;
		}
		return $result;
	}
}


// function added by Shiv to get the share of partner in the policy
if(!function_exists('getPartnerPolicyShare')) {
	function getPartnerPolicyShare($insurance_type_id,$user_id) {
		CI()->db->where('user_id',$user_id);
		$query = CI()->db->get('tbl_partner_share');
		$res   = $query->row();
		if($query->num_rows() > 0) {
			if($insurance_type_id == 1) {
				$result = $res->motar_commission;
			} else if($insurance_type_id == 2) {
				$result = $res->health_commission;
			} else if($insurance_type_id == 3) {
				$result = $res->travel_commission;
			} else if($insurance_type_id == 4) {
				$result = $res->professional_commission;
			} else if($insurance_type_id == 5) {
				$result = $res->individual_accident_commission;
			} else if($insurance_type_id == 6) {
				$result = $res->credit_commission;
			} else {
				$result = $res->house_commission;
			} 
		} else {
			$result = 0;
		}
		return $result;
	}
}



// function added by Shiv to get the fleet vehicle option
if(!function_exists('getVehicleFleetOption')) {
	function getVehicleFleetOption($vehicle_detail_id) {
		CI()->db->where('vehicle_detail_id',$vehicle_detail_id);
		$query = CI()->db->get('tbl_vehicle_fleet');
		$res   = $query->row();
		if($query->num_rows() > 0) {
			$result = array (
				'fleet_option' 	   => $res->fleet_option,
				'fleet_percentage' => $res->fleet_percentage
			);
		} else {
			$result = array ();
		}
		return $result;
	}
} 


// function added by Shiv to get the fleet vehicle option
if(!function_exists('getFleetVehicleCount')) {
	function getFleetVehicleCount($vehicle_detail_id) {
		CI()->db->where('parent_id',$vehicle_detail_id);
		$query = CI()->db->get('tbl_vehicle_detail');
		$count = $query->num_rows();
		if($count > 0) {
			$result = $count;
		} else {
			$result = 0;
		}
		return $result;
	}
} 


if(!function_exists('getInsuranceCardDetails')) {
	function getInsuranceCardDetails($policy_number) {
		CI()->db->select('*');
		CI()->db->from('tbl_quittance');
		CI()->db->join('tbl_payment','tbl_quittance.policy_number = tbl_payment.policy_number');
		CI()->db->join('tbl_company','tbl_quittance.company_id = tbl_company.id');
		CI()->db->where('tbl_quittance.policy_number',$policy_number);
		$query = CI()->db->get();
		$res   = $query->row();
		if($query->num_rows() > 0) {
			$result->user_data 	   = getUserDetailByUserId($res->user_id);
			$result->user_name 	   = getUserName($res->user_id);
			$result->user_image    = getUserImageUrl($res->user_id);
			$result->policy_number = $res->policy_number;
			$result->company_id    = $res->company_id;
			$result->company_name  = $res->name;
			$result->company_logo  = getImageUrl('tbl_company',$res->company_id);
			$result->insured_id    = $res->insured_id;
			$result->insurance_type_id = $res->insurance_type_id;
			if($result->insurance_type_id == 2) {
				$result->insurance_dates = getHealthStartEndDate($result->insured_id);
				$healthdetails 		= getHealthInsuranceDetailsById($res->insured_id);
				if($healthdetails->health_insurance_type_id == 1) {
					$result->dob_of_person = $healthdetails->age_of_chief;
				} else {
					$result->dob_of_person = $healthdetails->age_person;
				}
				$result->insurance_reimbursement_rate = $healthdetails->claim_reimbursement_rate;
			} else {
				$result->insurance_dates = getVehicleStartEndDate($result->insured_id);
				$vehicledetails          = getVehicleDetailsById($result->insured_id);
				$vehiclebasicinfo        = getVehicleBasicInfo($vehicledetails->vehicle_basic_info_id);
				$result->vehicle_plate   = $vehicledetails->immatriclulation;
				$result->vehicle_type    = getName($vehicledetails->vehicle_type,'tbl_vehicle_type');
				$result->vehicle_make    = getName($vehiclebasicinfo->make_id,'tbl_vehicle_make');
			}
		} else {
			$result = '';
		}
		return $result;
	}
}

if(!function_exists('getHealthInsuranceDetailsById')) {
	function getHealthInsuranceDetailsById($id) {
		CI()->db->where('id',$id);
		$query = CI()->db->get('tbl_health_insurance_details');
		if($query->num_rows() > 0) {
			$result = $query->row();
		} else {
			$result = '';
		}
		return $result;
	}
}


if(!function_exists('getVehicleBasicInfo')) {
	function getVehicleBasicInfo($id) {
		CI()->db->where('id',$id);
		$query = CI()->db->get('tbl_vehicle_basic_info');
		$res   = $query->row();
		if($query->num_rows() > 0) {
			$result = $res;
		} else {
			$result = '';
		}
		return $result;
	}
}

if(!function_exists('getVehicleDetailsById')) {
	function getVehicleDetailsById($id) {
		CI()->db->where('id',$id);
		$query = CI()->db->get('tbl_vehicle_detail');
		if($query->num_rows() > 0) {
			$result = $query->row();
		} else {
			$result = '';
		}
		return $result;
	}
}


// function to get image
if(!function_exists('getImage')){
	function getImage($table="",$id=0){
	    $html="";
	    CI()->db->where('id',$id);
	    CI()->db->where('image!=""');
		$query = CI()->db->get($table);
	    $count = $query->num_rows();
        if($count>0){
			$result =  $query->row();			
			$image = $result->image;
			$html.='<img src="'.base_url($image).'" height="80" />';			
	    } else {
			$html.='<img src="'.base_url('assets/admin/images/no_image.jpg').'" width="80" />';			
	    }
	    return $html;
	}
}


if(!function_exists('getImageUrl')){
	function getImageUrl($table,$id=0){
	    $result="";
	    if($id>0){
		    CI()->db->where('id',$id);
		    CI()->db->where('image!=""');
			$query = CI()->db->get($table);
		    $count = $query->num_rows();
	        if($count>0){        	
				$res =  $query->row();
				$result = $res->image;	
				$result=base_url($result);					
		    } else {
		    	$result=base_url('assets/front/images/no_image.jpg');
		    }
	    }
	    return $result;
	}
}


// function added by Arvind to encrypt a string
if(!function_exists('encrypt')) {
	function encrypt($string = NULL) {
		$result = '';
		for ($i = 0, $k = strlen($string); $i < $k; $i++) {
			$char 	 = substr($string, $i, 1);
			$keychar = substr(E_KEY, ($i % strlen(E_KEY)) - 1, 1);
			$char 	 = chr(ord($char) + ord($keychar));
			$result .= $char;
		}
		return rtrim(base64_encode($result), "==");
	}
}

// function added by Arvind to decrypt a string
if(!function_exists('decrypt')) {
	function decrypt($string = NULL) {
		$result = '';
		$string = base64_decode($string);
		for ($i = 0, $k = strlen($string); $i < $k; $i++) {
			$char 	 = substr($string, $i, 1);
			$keychar = substr(E_KEY, ($i % strlen(E_KEY)) - 1, 1);
			$char 	 = chr(ord($char) - ord($keychar));
			$result .= $char;
		}
		return $result;
	}
}


// function added by Shiv to get the policy holder name options
if(!function_exists('getPolicyHolderNameOptions')) {
    function getPolicyHolderNameOptions($table,$type,$status = 0) {
        CI()->db->select('id,policy_number,user_id');
        CI()->db->from($table);
        CI()->db->where('insurance_type_id',2);
        CI()->db->where('payment_status',2);
        $query = CI()->db->get();
        $res = $query->result();
        if($query->num_rows() > 0) {
            foreach ($res as $key => $value) {
                $options['']         = $type;
                $options[$value->id] = getUserName($value->user_id)."-".$value->policy_number;
            }
        }
        return $options;
    }
}

if(!function_exists('getPolicyHolderData')) {
    function getPolicyHolderData($id) {
        CI()->db->where('id',$id);
        $query = CI()->db->get('tbl_payment');
        if($query->num_rows() > 0) {
            $result = $query->row();
        } else {
            $result = '';
        }
        return $result;
    }
}



if(!function_exists('getHospitalizationDataForReport')) {
	function getHospitalizationDataForReport($id) {
		CI()->db->select('*');
		CI()->db->from('tbl_hospitalization');
		CI()->db->join('tbl_payment','tbl_payment.id = tbl_hospitalization.policy_holder_name_id','left');
		CI()->db->where('tbl_hospitalization.id',$id);
		$query = CI()->db->get();
		if($query->num_rows() > 0) {
			$res = $query->row();
			$result['Policy Holder Name']		 = getUserName($res->user_id);
			$result['Policy Number']     		 = $res->policy_number;
			$result['Insurance Company Name'] 	 = getCompanyName($res->insurance_company_id);
			$result['The Patient Name']  	     = $res->the_patient_name;
			$result['Health Care Provider Name'] = getName($res->healthcareprovider_name_id,'tbl_healthcareprovider_name');
			$result['Provider Person Name'] 	 =$res->provider_person_name;
			$result['Dial Code'] 		 		 = $res->dial_code;
			$result['Provider Contact Number'] 	 = $res->provider_contact_number;
			$result['Provider Address']  		 = $res->provider_address;
			$result['Approval Status']  		 = ($res->approved_status)?'Approved':'Not Approved';
		} else {
			$result = '';
		}
		return $result;
	}
}

if(!function_exists('checkEmailSubscribed')) {
	function checkEmailSubscribed($email) {
		CI()->db->where('email',$email);
		$query = CI()->db->get('tbl_news_letter');
		if($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}

// function added by Shiv to get Quittance Status options
if (!function_exists('getQuittanceStatusOptions')) {

    function getQuittanceStatusOptions($type) {
        $options[''] = $type;
        $options[0] = 'Active';
        $options[1] = 'Inactive';
        $options[2] = 'Paid';
        $options[3] = 'Arrears';
        return $options;
    }

}

// function added by Shiv to get Quittance Status options
if (!function_exists('getPaymentStatusOptions')) {

    function getPaymentStatusOptions($type) {
        $options[''] = $type;
        $options[0] = 'Pending';
        $options[1] = 'Failed';
        $options[2] = 'Success';
		$options[3] = 'Expired';
		$options[4] = 'Cancelled';
        return $options;
    }

}


// function added by Shiv to get the policy no code for the specific company
if(!function_exists('getPolicyCodeForCompany')) {
    function getPolicyCodeForCompany($company_id) {
        CI()->db->where('company_id',$company_id);
        $query = CI()->db->get('tbl_policy_no_codification');
        if($query->num_rows() > 0) {
            $res = $query->row();
            $result = $res->policy_no_code;
        } else {
            $result = '';
        }
        return $result;
    }
}

// function added by Shiv to get the autogenerated policy number for the specific company
if(!function_exists('getAutogeneratedPolicyNumber')) {
    function getAutogeneratedPolicyNumber($company_id) {
        CI()->db->select('policy_number');
        CI()->db->from('tbl_payment');
        CI()->db->where('company_id',$company_id);
        CI()->db->order_by('created_date',desc);
        CI()->db->limit(1,1);
        $query = CI()->db->get();
        if($query->num_rows() > 0) {
            $res         = $query->row();
            $policy_code = getPolicyCodeForCompany($company_id);
            if(strpos($res->policy_number,'/') !== false) {
                $policy_no = explode("/",$res->policy_number);
                $policy_no_val = str_pad($policy_no[1] + 1, strlen($policy_no[1]), 0, STR_PAD_LEFT);
                $policy_number = $policy_code."/".$policy_no_val;
            } else {
                $policy_number = $policy_code."/"."0001"; 
            }
        } else {
            $policy_number = $policy_code."0001"; 
        }
        return $policy_number;
    }
}
