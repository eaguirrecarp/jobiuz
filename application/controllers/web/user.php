<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __contruct()
	{
		parent::__CI_Controller();

    	$this->load->helper(array('email','cookie','file'));
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
	    $this->load->view('web/user/register', $data);
	}

	public function login()
	{
	    $data['base']= $this->config->item('base_url');
	    $this->load->view('web/user/login', $data);
	}

    public function home()
    {
        $this->load->model('user_model');
        $this->load->model('upload_model');
        $this->load->library('googlemaps');

        $id = $this->session->userdata["user_id"];
        $data['result']=$this->user_model->get_user_account($id);

        $latitude = $data['result']['direccion_latitud'];
        $longitude = $data['result']['direccion_longitud'];

        $icon_url = site_url('template/images/locado32.png');
        // var_dump($icon_url);exit();
        
        if( ! empty($latitude) && ! empty($longitude))
        {
            $position_calculated = $this->user_model->calculate_distance_employer($latitude,$longitude);
            // var_dump($position_calculated);
            // exit();

            $data['count_posit_cal'] = count($position_calculated);
            for ($i=0; $i < $data['count_posit_cal'] ; $i++)
            {
                if($i<6)
                {
                    $config['center'] = $latitude.', '.$longitude;
                    $config['zoom'] = 15;
                    $config['scrollwheel'] = FALSE;
                    $config['map_name'] = 'map_'.$i;
                    $config['map_div_id'] = 'map_canvas_'.$i;
                    $this->googlemaps->initialize($config);
                    $marker = array();
                    $marker['position'] = $position_calculated[$i]->direccion_latitud.', '.$position_calculated[$i]->direccion_longitud;
                    // $marker['infowindow_content'] = "I'm on Map";
                    // $marker['onclick'] =  'window.open("profile")';
                    $marker['onclick'] = '$(location).attr("href","company_information/'.$position_calculated[$i]->id_empleador.'")';
                    $marker['icon'] = $icon_url;
                    $this->googlemaps->add_marker($marker);
                    $data['gmap']['map_'.$i] = $this->googlemaps->create_map();
                    $data['gmap']['map_'.$i]['company_name']            = $position_calculated[$i]->nombre_cuenta;
                    $data['gmap']['map_'.$i]['responsible']             = $position_calculated[$i]->responsable;
                    $data['gmap']['map_'.$i]['email']                   = $position_calculated[$i]->email;
                    $data['gmap']['map_'.$i]['message']                 = $position_calculated[$i]->mensaje;
                    $data['gmap']['map_'.$i]['wage']                    = $position_calculated[$i]->salario;
                    $data['gmap']['map_'.$i]['time_day_initial']        = $position_calculated[$i]->horario_dia_inicial;
                    $data['gmap']['map_'.$i]['time_day_end']            = $position_calculated[$i]->horario_dia_final;
                    $data['gmap']['map_'.$i]['schedule_time_initial']   = $position_calculated[$i]->horario_hora_inicial;
                    $data['gmap']['map_'.$i]['schedule_time_end']       = $position_calculated[$i]->horario_hora_final;
                }
                else
                {
                    break;
                }
                
            }
        }
        

        $data['base']= $this->config->item('base_url');
        $data['images'] = $this->upload_model->get_images();
        $data['result']['picture']=$data['images'][0]["thumb_url"];    
        $this->load->view('web/home', $data);
    }

    public function profile()
    {
        $this->load->helper(array('url','form','file'));
        $this->load->model('user_model');
        $this->load->model('upload_model');
        $this->load->model('account_model');
        $this->load->library('googlemaps');

        $id = $this->session->userdata["user_id"];

        $data["message"] = array();
        $data['base']= $this->config->item('base_url');

        if($this->input->post('datauser_submit'))
        {
            $nombre_cuenta = $this->input->post('full_name');
            $nickname = $this->input->post('user_name');
            $email = $this->input->post('email');
            $genero = $this->input->post('gender');


            $connect_facebook = ($this->input->post('connect_facebook') !== false ? '1' : '0');
            $publish_timeline_facebook = ($this->input->post('publish_timeline_facebook') !== false ? '1' : '0');
            $connect_google = ($this->input->post('connect_google') !== false ? '1' : '0');
            $publish_hangout_google = ($this->input->post('publish_hangout_google') !== false ? '1' : '0');

            $mail_company_connects = ($this->input->post('mail_company_connects') !== false ? '1' : '0');
            $mail_company_chat_you = ($this->input->post('mail_company_chat_you') !== false ? '1' : '0');
            $mail_company_favorite_add = ($this->input->post('mail_company_favorite_add') !== false ? '1' : '0');

            
            
            // $cumpleanio = $this->input->post('genero');
            // $telefono = $this->input->post('genero');
            // $activa_modo_fantasma = $this->input->post('genero');
            // $direccion_pais = $this->input->post('genero');
            // $direccion_ciudad = $this->input->post('genero');
            // $direccion_area = $this->input->post('genero');
            // $direccion_detalle = $this->input->post('genero');
            $direccion_latitud = $this->input->post('latitude');
            $direccion_longitud = $this->input->post('longitude');

            $data_user = array(
                            'nombre_cuenta' => $nombre_cuenta,
                            'email'=> $email,
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
            switch ($genero) {
                case 'MAL':
                    $genero = 1;
                    break;
                
                case 'FEM':
                    $genero = 2;
                    break;

                case 'OTH':
                    $genero = 3;
                    break;
            }
            $data_account = array(
                                    'nickname'=> $nickname,
                                    'genero'=> $genero,
                                    // 'cumpleanio'=> '',
                                    // 'telefono'=> '',
                                    // 'activa_modo_fantasma'=> '',
                                    // 'direccion_pais'=> '',
                                    // 'direccion_ciudad'=> '',
                                    // 'direccion_area'=> '',
                                    // 'direccion_detalle'=> '',
                                    'direccion_latitud'=> $direccion_latitud,
                                    'direccion_longitud'=>$direccion_longitud
                                );


            if ($this->user_model->update($data_user, $id))
            {
                if($this->account_model->update($data_account,$id))
                {
                    $this->session->set_userdata("user_name", $nombre_cuenta);
                    $data["message"] = array("success" => "You are change update.");

                    if(($connect_facebook == 1) || ($publish_timeline_facebook == 1))
                        if ($this->user_model->null_apikey($id,"id_facebook"))
                            redirect(site_url("web/user/social_login/facebook"));

                    if(($connect_google == 1) || ($publish_hangout_google == 1))
                        if ($this->user_model->null_apikey($id,"id_google"))
                            redirect(site_url("web/user/social_login/google"));
                }
            }

        }

        if($this->input->post("changepass_submit"))
        {

            $password_old = $this->input->post("password_old");
            $password = $this->input->post("password");

            if($this->user_model->get_password($password_old, $id))
            {
                $data = array("password"=>md5($password));
                if($this->user_model->set_password($data,$id))
                {
                    $data["message"] = array("success"=>"Password change");
                    $data['base']= $this->config->item('base_url');
                }
            }
            else
            {
                $data["message"] = array("error"=>"Old password is incorret");
            }
        }

        $data['result']=$this->user_model->get_user_account($id);

        // var_dump($data['result']);exit();

        $config = array();
        $latitude  = $data['result']['direccion_latitud'];
        $longitude = $data['result']['direccion_longitud'];
        if( empty($latitude) && empty($longitude))
        {
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
               
            $marker = array();
            $marker['draggable'] = true;
            $marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
            $this->googlemaps->add_marker($marker);
            $data['map'] = $this->googlemaps->create_map();
        }
        else
        {
            $config['center'] = $latitude.', '.$longitude;
            $config['zoom'] = 17;

            $this->googlemaps->initialize($config);
               
            $marker = array();
            $marker['draggable'] = true;
            $marker['position'] = $latitude.', '.$longitude;
            $this->googlemaps->add_marker($marker);
            $data['map'] = $this->googlemaps->create_map();
        }
        

        if ($this->input->post('upload'))
        {
            $this->upload_model->do_upload();
            $data["message"] = array("success" => "Change your are image.");
        }
        
        $data['images'] = $this->upload_model->get_images();


        $path = "./images/users/".$id."/";
        if(!file_exists($path))
        {
            mkdir($path,0777);
            mkdir($path."thumbs/",0777);
        }
        $data['result']['picture']=$data['images'][0]["thumb_url"];
        // echo "<pre>";
        // var_dump($data['result']["picture"]);
        // echo "</pre>";

        $data["password_old"] = array(
                                "name"=>"password_old",
                                "id"=>"password_old",
                                 "class"=>"form-control profile"
                            );
       $data["password"] = array(
                                "name"=>"password",
                                "id"=>"password",
                                 "class"=>"form-control valid profile"
                            );
        $data["confirm_password"] = array(
                                "name"=>"confirm_password",
                                "id"=>"confirm_password",
                                "class"=>"form-control valid profile"
                            );
        // echo "<pre>";
        // var_dump($data);
        // echo "</pre>";
        $this->load->view('web/user/profile', $data);
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

	public function authenticate($social=NULL)
	{		
       
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        // $renember = $this->input->post('renember');

         $ret = FALSE;
    	
        if(!empty($email) && !empty($password))
        {
            
            $this->load->model('user_model','',TRUE);
            
            if ($this->user_model->user_login($email,$password))
            {
                $response = $this->user_model->user_login($email,$password);
                $data['result']=$this->user_model->get_user_account($response->id_cuenta);

                if (empty($response->nombre_cuenta))
                    $user_name = "Undefined";
                else
                    $user_name = $response->nombre_cuenta;
                
                $this->session->set_userdata("user_name", $user_name);
                $this->session->set_userdata("user_id", $response->id_cuenta);
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
            redirect(site_url("web/user/home"), "refresh");
        }
        else
        {
            redirect(site_url("web/user/login"), "refresh");
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
		redirect(site_url("web/user/login"), "refresh");
    }

    public function insert()
    {
    	
    	$this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('pictureuser_model');
    	$this->load->helper('email');

    	if ($_POST)
    	{
    		$email = $this->input->post('email');
			$password = $this->input->post('password');
			$provider = 1;
    	}

		if (valid_email($email))
		{
		    if ($this->user_model->exit_email($email))
	    	{
	    		$this->register();
	    	}
	    	else
	    	{
	    		date_default_timezone_set('UTC');
	    		$data = array( 'tipo_cuenta'=>1, 'email' => $email , 'password' =>md5($password), 'estado'=>1, 'forma_registro'=>$provider, 'fecha_alta'=> date('Y-m-d H:i:s'));
                $id_cuenta = $this->user_model->insert($data);
	    		if (isset($id_cuenta))
                {
                    $data = array('id_cuenta'=>$id_cuenta);
                    if($this->account_model->insert($data))
                    {
                        $path = './images/users/'.$id_cuenta.'/';
                        if(!file_exists($path))
                        {
                            mkdir($path,0777);
                            mkdir($path."thumbs/",0777);
                        }
                        $data = array('id_cuenta'=>$id_cuenta, 'fecha_alta'=>date('Y-m-d H:i:s'));
                        if($this->pictureuser_model->insert($data))
                        {
                            $data["email"]=$email;
                            $data["password"]=$password;
                            $this->sendemail($email,$data);
                            $this->login();
                        }
                    }
                }
	    	}
		}
		else
		{
		    $this->register();
		}
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

    public function company_information()
    {
        $this->load->model('user_model');
        $this->load->model('employer_model');
        $this->load->model('upload_model');
        $this->load->library('googlemaps');

        $id_empl = $this->uri->segment(4);

        $id = $this->session->userdata["user_id"];
        $data['result']=$this->user_model->get_user_account($id);

        $latitude = $data['result']['direccion_latitud'];
        $longitude = $data['result']['direccion_longitud'];

        $icon_url = site_url('template/images/locado32.png');
        // var_dump(site_url());
        // exit();

        if( ! empty($latitude) && ! empty($longitude))
        {
            // $position_calculated = $this->user_model->calculate_distance_employer($latitude,$longitude);

            $company = $this->employer_model->company($id_empl);

            $config['center'] = $latitude.', '.$longitude;
            $config['zoom'] = 15;
            $config['scrollwheel'] = FALSE;
            $config['map_name'] = 'map';
            $config['map_div_id'] = 'map_canvas';
            $this->googlemaps->initialize($config);
            $marker = array();
            $marker['position'] = $company['direccion_latitud'].', '.$company['direccion_longitud'];
            // $marker['infowindow_content'] = "I'm on Map";
            $marker['onclick'] =  'window.location.replace("'.site_url("web/user/company_map").'")';
            // $marker['onclick'] = '$(location).attr("href","company_map")';
            $marker['icon'] = $icon_url;
            $this->googlemaps->add_marker($marker);
            $data['map'] = $this->googlemaps->create_map();
            $data['map']['company_name']            = $company['nombre_cuenta'];
            $data['map']['responsible']             = $company['responsable'];
            $data['map']['email']                   = $company['email'];
            $data['map']['message']                 = $company['mensaje'];
            $data['map']['wage']                    = $company['salario'];
            $data['map']['time_day_initial']        = $company['horario_dia_inicial'];
            $data['map']['time_day_end']            = $company['horario_dia_final'];
            $data['map']['schedule_time_initial']   = $company['horario_hora_inicial'];
            $data['map']['schedule_time_end']       = $company['horario_hora_final'];
  
        }

        $data['images'] = $this->upload_model->get_images();
        $data['result']['picture']=$data['images'][0]["thumb_url"]; 

        $data['base']= $this->config->item('base_url');
        $this->load->view('web/user/company', $data);
    }

    public function company_map()
    {
        $this->load->model('user_model');
        $this->load->model('employer_model');
        $this->load->model('upload_model');
        $this->load->library('googlemaps');

        $id = $this->session->userdata["user_id"];
        $data['result']=$this->user_model->get_user_account($id);

        $latitude = $data['result']['direccion_latitud'];
        $longitude = $data['result']['direccion_longitud'];

        $icon_url_comp = site_url('template/images/locado32.png');
        $icon_url_acc = site_url('template/images/locador32.png');

        if( ! empty($latitude) && ! empty($longitude))
        {
            $position_calculated = $this->user_model->calculate_distance_employer($latitude,$longitude);
            // var_dump($position_calculated);
            // exit();
            $config['center'] = $latitude.', '.$longitude;
            $config['zoom'] = 16;
            $this->googlemaps->initialize($config);

            $marker = array();
            $marker['position'] = $latitude.', '.$longitude;
            $marker['infowindow_content'] = "Current location";
            $marker['icon'] = $icon_url_acc;
            $this->googlemaps->add_marker($marker);

            $data['count_posit_cal'] = count($position_calculated);
            for ($i=0; $i < $data['count_posit_cal'] ; $i++)
            {
                    
                    $marker = array();
                    $marker['position'] = $position_calculated[$i]->direccion_latitud.', '.$position_calculated[$i]->direccion_longitud;
                    // $marker['infowindow_content'] = "I'm on Map";
                    $marker['icon'] = $icon_url_comp;
                    $this->googlemaps->add_marker($marker);
            }
            $data['map'] = $this->googlemaps->create_map();
        }

        

        $data['base']= $this->config->item('base_url');
        $this->load->view('web/user/company_map', $data);
    }

    public function message()
    {
        $this->load->model('upload_model');
        $this->load->model('notice_model');

        $id = $this->session->userdata["user_id"];


        $data["message"] = array();

        $data['images'] = $this->upload_model->get_images();
        $data['result']['picture']=$data['images'][0]["thumb_url"];

        $data['base']= $this->config->item('base_url');
        $this->load->view('web/user/message', $data);
    }

    public function list_favorites()
    {
        $this->load->model('upload_model');
        $this->load->model('notice_model');

        $id = $this->session->userdata["user_id"];


        $data["message"] = array();

        $data['images'] = $this->upload_model->get_images();
        $data['result']['picture']=$data['images'][0]["thumb_url"];

        $data['base']= $this->config->item('base_url');
        $this->load->view('web/user/list_favorites', $data);
    }

    public function list_notices()
    {
        $this->load->model('upload_model');
        $this->load->model('notice_model');

        $id = $this->session->userdata["user_id"];


        $data["message"] = array();

        $data['images'] = $this->upload_model->get_images();
        $data['result']['picture']=$data['images'][0]["thumb_url"];

        $data['base']= $this->config->item('base_url');
        $this->load->view('web/user/list_notices', $data);
    }

    public function filters()
    {
        $this->load->model('upload_model');
        $this->load->model('notice_model');

        $id = $this->session->userdata["user_id"];


        $data["message"] = array();

        $data['images'] = $this->upload_model->get_images();
        $data['result']['picture']=$data['images'][0]["thumb_url"];

        $data['base']= $this->config->item('base_url');
        $this->load->view('web/user/filters', $data);
    }


}

/* End of file user.php */
/* Location: ./application/controllers/user.php */