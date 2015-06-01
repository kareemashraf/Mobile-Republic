<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 *	[[],[],[]]
	 */
	public function index() {

		$this->load->model('SearchModel'); 

		$brands         =  $this->SearchModel->get_brands();
		$data['brands'] =  $brands;

        
        $this->load->view('search',$data);
	}

	public function model() {
    $brand          =  $this->input->post('brand');
    $price          =  $this->input->post('price');

    $this->load->model('SearchModel'); 
    $models         =  $this->SearchModel->get_model($brand,$price);
    echo json_encode($models);
	}

	public function numbers(){
    $price          =  $this->input->post('price');
    $model          =  $this->input->post('model');
    $brand          =  $this->input->post('brand');
    $this->load->model('SearchModel'); 
    $numbers        =  $this->SearchModel->get_numbers($model,$price,$brand);
    
    echo json_encode($numbers);

	}

	public function get_search(){
        $this->load->model('SearchModel'); 
		$brands         =  $this->SearchModel->get_brands_and_networks();
		$data['brands'] =  $brands;

        $this->load->view('advanced_search',$data);
	}

	public function result(){
        $submit  =   $this->input->post('submit');
        $brand   =   $this->input->post('hidden_brand');
        $model   =   $this->input->post('hidden_model');
        $price   =   $this->input->post('hidden_price');
      
		if (!empty($brand) && !empty($model) ) {
		$price                    =  explode(";", $price);
		$min                      =  $price[0];
		$max                      =  $price[1];
		$data['min']              =  $min;
		$data['max']              =  $max;  
        
        $this->load->model('SearchModel'); 
        $results                  =  $this->SearchModel->get_results($brand,$model,$min,$max);
        
        $data['brand']            =  $this->input->post('hidden_brand');
		$data['model']            =  $this->input->post('hidden_model');
        $data['results']          =  $results;

        $this->load->view('result',$data);

		} else {

			 	$this->session->set_userdata('sample','Please Select a brand and Model');
			 	redirect('home', 'refresh');
			 
		}

       
	}

	public function advanced_result(){
        $submit          =   $this->input->post('submit');

        $brand           =   $this->input->post('hidden_brand');
        $model           =   $this->input->post('hidden_model');
        $price           =   $this->input->post('hidden_price');
        $mobile_network  =   $this->input->post('hidden_network');
        $mobile_contract =   $this->input->post('hidden_contract');
        $minutes         =   $this->input->post('hidden_minutes');
        $texts           =   $this->input->post('hidden_texts');
        $screen_size     =   $this->input->post('hidden_screen');
        $camera          =   $this->input->post('hidden_camera');
        $battery         =   $this->input->post('hidden_battery');
      
		if (!empty($brand) ) {
		
		$this->load->model('SearchModel'); 
        $results                  =  $this->SearchModel->advanced_results($brand,$model,$price,$mobile_network,$mobile_contract,$minutes,$texts,$screen_size,$camera,$battery);
        
        $data['results']          =  $results;
        $this->load->view('result',$data);

		} else {

			 	$this->session->set_userdata('sample','Please Select a brand');
			 	redirect('home/get_search', 'refresh');
			 
		}

	}

	public function result_update(){

		$minutes  =  $this->input->post('minutes');
		$texts    =  $this->input->post('texts');
		$price    =  $this->input->post('price');
		$duration =  $this->input->post('duration');
		$this->load->model('SearchModel'); 
		$results  =  $this->SearchModel->result_update($minutes,$texts,$price,$duration);
 
		$data['results'] = $results;
        $this->load->view('ajaxview',$data);

        //echo json_encode($results);
		//return $results;
		
		}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */