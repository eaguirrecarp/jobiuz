<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends CI_Controller {

	public function __contruct()
	{
		parent::__CI_Controller();

    	$this->load->helper(array('email','cookie','file','form','url'));
        $this->load->library(array('form_validation'));
        $this->load->database('default');
	}
	public function index()
	{
		$this->register();
	}

	public function register()
	{
	    $data['base']= $this->config->item('base_url');
        $data['image']= $data['base'].'images/employers/logo.jpg';
	    $this->load->view('web/employer/register', $data);
	}

	public function login()
	{
	    $data['base']= $this->config->item('base_url');
	    $this->load->view('web/employer/login', $data);
	}

    public function home()
    {
        $this->load->model('user_model');
        $this->load->model('upload_model');

        $id = $this->session->userdata("user_id");
        $data['result'] = $this->user_model->get_user_account($id);
        $data['logo_business'] = base_url().'profile/employers/thumbs/'.$this->session->userdata('user_logo');
        $data['content'] = 'web/employer/home';
        $this->load->view('web/template/home', $data);    
    }

    public function profile()
    {
        $this->load->model('employer_model');
        $this->load->model('account_model');
        $this->load->model('user_model');
        $this->load->model('upload_model');
        $this->load->library('googlemaps');
        $this->load->library(array('form_validation'));
        
        $data['error'] = "";
        /*if (isset($_POST))
        {
            var_dump($_POST);
        }*/

        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('responsible', 'Responsible', 'tirm|required|xss_clean');
        $this->form_validation->set_rules('nit', 'NIT', 'tirm|required|xss_clean');
        $this->form_validation->set_rules('web', 'Business Web', 'tirm|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Business Phone', 'tirm|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'tirm|required|xss_clean');
        $this->form_validation->set_rules('country', 'Country', 'tirm|required|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'tirm|required|xss_clean');
        $this->form_validation->set_rules('area', 'Area', 'tirm|required|xss_clean');
        $this->form_validation->set_rules('description_address', 'Description Area', 'trim|required|xss_clean');
        $this->form_validation->set_rules('latitude', 'Latitud', 'trim|required|xss_clean');
        $this->form_validation->set_rules('longitude', 'Longitud', 'trim|required|xss_clean');

        if ($this->form_validation->run() === true)
        {

            $connect_facebook = ($this->input->post('connect_facebook') !== false ? '1' : '0');
            $publish_timeline_facebook = ($this->input->post('publish_timeline_facebook') !== false ? '1' : '0');
            $connect_google = ($this->input->post('connect_google') !== false ? '1' : '0');
            $publish_hangout_google = ($this->input->post('publish_hangout_google') !== false ? '1' : '0');

            $mail_company_connects = ($this->input->post('mail_company_connects') !== false ? '1' : '0');
            $mail_company_chat_you = ($this->input->post('mail_company_chat_you') !== false ? '1' : '0');
            $mail_company_favorite_add = ($this->input->post('mail_company_favorite_add') !== false ? '1' : '0');



            $data_user = array(
                            'nombre_cuenta' => $this->input->post('company_name'),
                            'email'=> $this->input->post('user_name'),
                            'connect_facebook'=>$connect_facebook,
                            // 'id_facebook'=>'',
                            // 'email_facebook'=>'',
                            'publish_timeline_facebook'=>$publish_timeline_facebook,
                            'connect_google'=>$connect_google,
                            // 'id_google'=>'',
                            // 'email_google'=>'',
                            'publish_hangout_google'=>$publish_hangout_google,
                            'mail_company_connects'=>$mail_company_connects,
                            'mail_company_chat_you'=>$mail_company_chat_you,
                            'mail_company_favorite_add'=>$mail_company_favorite_add
                            );
            $data_employer = array(
                                    'responsable'=>$this->input->post('responsible'),
                                    'nit'=>$this->input->post('nit'),
                                    'web'=>$this->input->post('web'),
                                    'telefono'=>$this->input->post('phone'),
                                    'descripcion'=>$this->input->post('description'),
                                    'direccion_pais'=>$this->input->post('country'),
                                    'direccion_ciudad'=>$this->input->post('city'),
                                    'direccion_area'=>$this->input->post('area'),
                                    'direccion_detalle'=>$this->input->post('description_address'),
                                    'direccion_latitud'=>$this->input->post('latitude'),
                                    'direccion_longitud'=>$this->input->post('longitude'),
                                );


            if ($this->user_model->update($data_user, $this->session->userdata('user_id')))
            {
                if($this->employer_model->update($data_employer,$this->session->userdata('user_id')))
                {
                    $this->session->set_userdata("user_name", $this->input->post('company_name'));
                    $data["error"] = "You are change update.";

                    /*if(($connect_facebook == 1) || ($publish_timeline_facebook == 1))
                        if ($this->user_model->null_apikey($id,"id_facebook"))
                            redirect(site_url("web/user/social_login/facebook"));

                    if(($connect_google == 1) || ($publish_hangout_google == 1))
                        if ($this->user_model->null_apikey($id,"id_google"))
                            redirect(site_url("web/user/social_login/google"));*/
                }
            }

        }



        $data['result'] = $this->employer_model->get_employer($this->session->userdata('user_id'));
        /*****************************************************/
        if (empty($data['result']['direccion_latitud']) && empty($data['result']['direccion_longitud']))
        {
            $config = array();
            $config['center'] = 'auto';
            $config['zoom'] = 17;
            $config['onboundschanged'] = 'if (!centreGot) {
                var mapCentre = map.getCenter();
                marker_0.setOptions({
                    position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
                });
            }
            centreGot = true;';
            $this->googlemaps->initialize($config);
               
            // set up the marker ready for positioning 
            // once we know the users location
            $marker = array();
            $marker['draggable'] = true;
            $marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
            $this->googlemaps->add_marker($marker);
            $data['gmap'] = $this->googlemaps->create_map();
            /*****************************************************/
        }
        else
        {
            $config = array();
            $config['center'] = $data['result']['direccion_latitud'].', '.$data['result']['direccion_longitud'];
            $config['zoom'] = 17;

            $this->googlemaps->initialize($config);
               
            $marker = array();
            $marker['draggable'] = true;
            $marker['position'] = $data['result']['direccion_latitud'].', '.$data['result']['direccion_longitud'];
            $this->googlemaps->add_marker($marker);
            $data['gmap'] = $this->googlemaps->create_map();
        }
            $data['scripts'] = array('template/js/AjaxUpload.2.0.min.js');
            $data['styles'] = array('template/css/style.css');
            $data['content'] = 'web/employer/profile';
            $this->load->view('web/template/home', $data);
    }

	public function social_login()
	{
        
        if( $this->uri->segment(3) !="" )
        {
            // $this->load->library('Opauth/Opauth', $this->config->item('opauth_config'), false);
            // $this->opauth->run();
            require(APPPATH .'libraries/Opauth/Opauth.php');
			$opauth = new Opauth($this->config->item('opauth_config'), false);
           	$opauth->run();
        }     
	}

	public function authenticate($social=NULL,$user=array())
	{		
       if (isset($_POST))
       {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        // $renember = $this->input->post('renember');
       }
       elseif (count($user))
       {
        $email = $user['email'];
        $password = $user['password']; 
       }
         $ret = FALSE;
    	
        if(!empty($email) && !empty($password))
        {
            
            $this->load->model('user_model','',TRUE);
            
            if ($response = $this->user_model->user_login($email,$password,$type=2))
            {
                $data['result']=$this->user_model->get_user_employer($response->id_cuenta);

                if (empty($response->nombre_cuenta))
                    $user_name = "Undefined";
                else
                    $user_name = $response->nombre_cuenta;
                
                $this->session->set_userdata("user_name", $user_name);
                $this->session->set_userdata("user_id", $response->id_cuenta);
                $this->session->set_userdata("user_logo", $data['result']["nombre_archivo"]);
                $this->session->set_userdata("user_type", $data['result']["tipo_cuenta"]);

                if ( $this->input->post('renember') )
                {
                   $this->input->set_cookie('user_cooke','123abc', 3600);

                    // $this->input->cookie($cookie);
                }

                $ret = TRUE;
            }

            
            // $this->input->set_cookie('user_cooke', $this->input->post('email'), 3600);
            // $this->input->cookie('user_cooke', TRUE);

        }
        // echo "<pre>";
        // var_dump($this->session->userdata["session_id"]);
        // echo "</pre>";
        
        if (isset($social) || isset($this->session->userdata["user_id"]) )
            $ret = TRUE;

        // var_dump($ret);
        // exit();
        if ($this->input->cookie("user_cooke"))
            $ret = TRUE;

	    if($ret)
        {
            redirect(site_url("web/employer/home"), "refresh");
        }
        else
        {
            redirect(site_url("web/employer/login"), "refresh");
        }
        

    }

    public function logout()
    {
        $this->load->helper("cookie");
    	$this->session->sess_destroy();

        $cookie = array(
                    "name"   => "user_cooke",
                    "value"  => "",
                    "expire" => 0,
                    );

        delete_cookie("user_cooke");
		redirect(site_url("web/employer/login"), "refresh");
    }

    public function insert()
    {
    	$this->load->model('user_model');
        $this->load->model('employer_model');
        
        $this->load->model('pictureuser_model');
    	$this->load->helper('email');
        $this->load->library(array('form_validation'));
        
        $data['error'] = "";

        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('responsible_name', 'Responsible', 'tirm|required|xss_clean');
    	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_exist_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('re_password', 'Re Password', 'trim|matches[password]|required|xss_clean');

        if ($this->form_validation->run() === true)
    	{
            $company_name = $this->input->post('company_name');
            $responsible_name = $this->input->post('responsible_name');
    		$email = $this->input->post('email');
			$password = $this->input->post('password');
			$provider = 1;
        
		    if ($this->user_model->exit_email($email))
	    	{
	    		$this->register();
	    	}
	    	else
	    	{
	    		date_default_timezone_set('UTC');
	    		$data = array( 
                            'nombre_cuenta'=>$company_name, 
                            'tipo_cuenta'=>2, 'email' => $email , 
                            'password' =>md5($password), 
                            'estado'=>1, 
                            'forma_registro'=>$provider, 
                            'fecha_alta'=> date('Y-m-d H:i:s')
                            );
                $id_cuenta = $this->user_model->insert($data);
	    		if (isset($id_cuenta))
                {
                    $data = array(
                                'id_cuenta'=>$id_cuenta, 
                                'responsable'=>$responsible_name
                                );
                    if($this->employer_model->insert($data))
                    {

                        $path = './profile/employers/';
                           if (!is_dir($path))
                           {
                            mkdir($path,0777);
                           }
                           if (!is_dir($path."thumbs/"))
                           {
                            mkdir($path."thumbs/",0777);
                           }
                            /*********Upload Image******/
                            $config = array(
                                'upload_path' => $path,
                                'allowed_types' => 'jpg|jpeg', //|gif|png
                                'max_size' => 2000,
                                'remove_spaces' => TRUE,
                                'overwrite' => TRUE
                            );
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            $this->upload->do_upload();
                            $image_data = $this->upload->data();
                            /**************************/
                            /*********Resize Image******/
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => $path . '/thumbs',
                                'maintain_ration' => true,
                                'width' => 74,
                                'height' => 74,

                            );
                            
                            $this->load->library('image_lib', $config);
                            $this->image_lib->resize();
                            /*************************/

                        $data = array(
                                    'id_cuenta'=>$id_cuenta,
                                    'ruta_server'=>'profile/employers/thumbs/'.$image_data['file_name'], 
                                    'nombre_archivo'=>$image_data['file_name'],
                                    'fecha_alta'=>date('Y-m-d H:i:s')
                                    );
                        if($this->pictureuser_model->insert($data))
                        {
                            $data["email"]=$email;
                            $data["password"]=$password;
                            $this->sendemail($email,$data);
                            $this->authenticate(NULL,$data);
                        }
                    }
                }
	    	}
		}

		$data['base']= $this->config->item('base_url');
        $data['image']= $data['base'].'images/employers/logo.jpg';
        $data['scripts'] = array();
        $data['styles'] = array('template/css/style.css');
        $data['content'] = 'web/employer/home';
        $this->load->view('template/main', $data);
    }

    public function delete()
    {
        $this->load->model('user_model');
        $this->load->helper('file');
        $this->load->helper('cookie');

        $tables = array('imagenes_cuenta', 'usuario', 'cuenta' );

        $id = $this->session->userdata['user_id'];
        $user_type = $this->session->userdata['user_type'];

        if($user_type==1)
            $dir = 'users';
        if($user_type==2)
            $dir = 'employers';

        $path = realpath(APPPATH . '../images/'.$dir.'/'.$id);
        $path_url = base_url().'images/'.$dir.'/'.$id.'/';

        delete_files($path);
        $this->user_model->delete($tables, $id);

        $this->session->sess_destroy();

        $cookie = array(
                    'name'   => 'user_cooke',
                    'value'  => '',
                    'expire' => 0,
                    );

        delete_cookie('user_cooke');

        redirect($this->register(), 'refresh');

    }

    public function social_data()
    {
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('pictureuser_model');

        if (isset($_POST['opauth']))
        {  
            $response = unserialize(base64_decode( $_POST['opauth'] ));
            if (isset($response["auth"]))
            {
                $api_key = $response["auth"]["uid"];
                $provider = $response["auth"]["provider"];
                if($provider == "Google")
                {
                    $provider = 3;
                    $data["key_google"] = $api_key;
                    $api_field = "id_google";
                    $email_field = "email_google";
                    $data["social"] = "Google";
                    $connect_social = "connect_google";
                    $publish_social = "publish_hangout_google";

                }
                    
                if($provider == "Facebook")
                {
                    $provider = 2;
                    $data["key_facebook"] = $api_key;
                    $api_field = "id_facebook";
                    $email_field = "email_facebook";
                    $data["social"] = "Facebook";
                    $connect_social = "connect_facebook";
                    $publish_social = "publish_timeline_facebook";
                }
                    

                $user_name = $response["auth"]["info"]["name"];
                $picture_url = $response["auth"]["info"]["image"];
                $gender = $response["auth"]["raw"]["gender"];
                switch ($gender) {
                            case 'male':
                                $gender = 1;
                                break;
                            case 'female':
                                $gender = 2;
                                break;
                            case 'other':
                                $gender = 3;
                                break;
                        }

                if(!empty($response["auth"]["info"]["email"]))
                    $email = $response["auth"]["info"]["email"];
                else
                    $email = "";

                // echo "<pre>";
                // var_dump($response);
                // echo "</pre>";
                // exit();


                if($this->user_model->exit_apikey($api_key,$api_field))
                {
                    
                    redirect(site_url("web/user/authenticate/social"), "refresh");
                }
                elseif(isset($this->session->userdata["user_id"]))
                {
                    
                    $data = array("nombre_cuenta"=>$user_name, $connect_social =>1, $publish_social=>1, $email_field => $email , $api_field=>md5($api_key));
                    $this->user_model->update($data, $this->session->userdata["user_id"]);

                    $data = array("genero" => $gender );
                    $this->account_model->update($data,$this->session->userdata["user_id"]);

                    $data_picture = array('ruta_server'=>$picture_url);
                    $this->pictureuser_model->update($data_picture, $this->session->userdata["user_id"]);

                    redirect(site_url("web/user/profile", "refresh"));
                }
                else
                {

                    date_default_timezone_set('UTC');
                    $data = array('nombre_cuenta'=>$user_name, $connect_social =>1, $publish_social=>1, 'tipo_cuenta'=>1, $email_field => $email , $api_field=>md5($api_key), 'estado'=>1, 'forma_registro'=>$provider, 'fecha_alta'=> date('Y-m-d H:i:s'));
                    $id = $this->user_model->insert($data);
                    if (isset($id))
                    {
                        
                        $data = array('id_cuenta'=>$id, 'genero'=>$gender);
                        
                        $data_picture = array('id_cuenta'=>$id, 'ruta_server'=>$picture_url, 'fecha_alta'=>date('Y-m-d H:i:s'));
                        if($this->account_model->insert($data) && $this->pictureuser_model->insert($data_picture))
                        {
                            $path = './images/users/'.$id.'/';
                            if(!file_exists($path))
                            {
                                mkdir($path,0777);
                                mkdir($path."thumbs/",0777);
                            }
                            $this->sendemail($email,$provider);
                            // $this->login();

                            redirect(site_url("web/user/login", "refresh"));
                        }
                    }

                }
            }

            redirect(site_url("web/user", "refresh"));
        }

    }


    public function sendemail($email,$data)
    {
        $config = Array(
                          'protocol' => 'smtp',
                          'smtp_host' => 'ssl://rosso.superdomainzone.com',
                          'smtp_port' => 465,
                          'smtp_user' => 'web@jobiuz.consorcio-creativo.com', // change it to yours
                          'smtp_pass' => 'JO20UZ14', // change it to yours
                          'mailtype' => 'html',
                          'charset' => 'iso-8859-1',
                          'wordwrap' => TRUE
                       );
        if($data==3)
            $message ="You are already part of JOBIUZ. Account created with Google";
        if($data==2)
            $message ="You are already part of JOBIUZ. Account created with Facebook";
        if(is_array($data))
            $message ="You are already part of JOBIUZ. Account created with JOBIUZ, your email is ".$data["email"]." and your password ".$data["password"];
        $this->load->library('email', $config);
        $this->email->from('jobiuz@jobiuz.com','JOBIUZ');
        $this->email->to($email);
        $this->email->subject('Registration');
        $this->email->message($message);
        $this->email->send();

    }

    function exist_email($email)
    {
        $this->load->model('user_model');
        if ($this->user_model->exit_email($email))
        {
            $this->form_validation->set_message('exist_email','The %s Address already exists.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */