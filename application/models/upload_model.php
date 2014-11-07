<?php
class Upload_model extends CI_Model {
	
	var $path;
	var $path_url;
	var $path_silhouette;
	var $user_type;
	var $dir;
	
	function __construct() {
		parent::__construct();

		$user_type = $this->session->userdata['user_type'];

		if($user_type==1)
		{
			$dir = 'users';
		}
		if($user_type==2)
		{
			$dir = 'employers';
		}

		$this->path = realpath(APPPATH . '../images/'.$dir.'/'.$this->session->userdata['user_id']);
		$this->path_url = base_url().'images/'.$dir.'/'.$this->session->userdata['user_id'].'/';
		$this->path_silhouette = base_url().'images/'.$dir.'/';
	}
	
	function do_upload() 
	{

		$config = array(
			'allowed_types' => 'jpg|jpeg', //|gif|png
			'upload_path' => $this->path,
			'max_size' => 2000,
			'file_name' => $this->session->userdata['user_id'],
			'overwrite' => TRUE
		);
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();

		// rename($image_data['file_name'], 'new_name'.$image_data['file_ext']); 
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->path . '/thumbs',
			'maintain_ration' => true,
			'width' => 74,
			'height' => 74,

		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		return $image_data;
	}
	
	function get_images() {
		$this->load->helper('file');
		$pathurl = $this->path.'/thumbs/'.$this->session->userdata['user_id'].'.jpg';
		$files = scandir($this->path);
		$files = array_diff($files, array('.', '..', 'thumbs'));
		$images = array();
		
		// foreach ($files as $file) {
		// 	$images []= array (
		// 		'url' => $this->path_url . $file,
		// 		'thumb_url' => $this->path_url . 'thumbs/' . $file
		// 	);
		// }
		if(file_exists($pathurl))
		{
			$images[] = array (
							'url' => $this->path_url . $this->session->userdata['user_id'],
							'thumb_url' => $this->path_url . 'thumbs/' . $this->session->userdata['user_id'] . '.jpg'
						);
		}
		else
		{
			$images[] = array (
							'url' => $this->path_url,
							'thumb_url' => $this->path_silhouette . 'silueta.jpg'
						);
		}	
		
		return $images;
	}
	
}



