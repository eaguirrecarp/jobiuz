<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('email','cookie','file'));
        $this->load->database('default');

	}

	public function index()
	{
		$this->load->helper(array('url','form','file'));
        $this->load->library('googlemaps');

	    $data['title']="Jobiuz";
	    $data['base']= $this->config->item('base_url');
	    $data['estilos']= $this->config->item('estilos');
	    // $data['bootstrap']= $this->config->item('bootstrap');
	    // $data['normalize']= $this->config->item('normalize');
	    // $data['bootstrap_theme']= $this->config->item('bootstrap_theme');

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

        $marker = array();
        $marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
        $this->googlemaps->add_marker($marker);
        $data['map'] = $this->googlemaps->create_map();


	    $this->load->view('web/home', $data);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */