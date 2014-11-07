<?php

class Job_ajax extends CI_Controller {


	function __construct() 
	{

		parent::__construct();

		$this->load->database();

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$this->isAjax = true;
		}

		else
		{
			$this->isAjax = false;
		}

		if(!$this->isAjax)
		{
			/*show_404();
			exit;*/
		}

	}

	public function upload_image()
	{
		$this->load->model('upload_model');
		if ($this->session->userdata['user_type'] == 1)
		{
			$this->load->model('user_model');
			$file = $this->handle_upload();
			$ret = $this->user_model->update_profile($this->session->userdata['user_id'],$data);
		}
		elseif ($this->session->userdata['user_type'] == 2)
		{
			$this->load->model('employer_model');
			$file = $this->handle_upload();
			$data = array(
						'ruta_server' =>$file['file_path'],
						'nombre_archivo' =>$file['file_name'],
			 			);
			$ret = $this->employer_model->update_profile($this->session->userdata['user_id'],$data);
		}
		if ($ret)
		{
			$res = array(
						'error' => 0, 
						'message'=>'Uploaded success.',
						'filename'=>$file['file_name']
						);
			echo json_encode($res);
		}
		else
		{
			$res = array(
						'error' => 0, 
						'message'=>'done');
			echo json_encode($res);
		}
	}
	private function handle_upload($path='')
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
        return $image_data;
	}
}