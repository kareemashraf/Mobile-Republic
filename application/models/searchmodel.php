<?php
class SearchModel extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    public function get_brands(){
        // a Query to get all the brands
    	$this->db->select('phone,phone_id');
        $query   = $this->db->get('phones');
        $brands  = $query->result();
        return $brands;
        
    }
    
    public function get_brands_and_networks(){
        // a Query to get all the brands
        $this->db->select('phone,phone_id');
        $query   = $this->db->get('phones');
        $brands  = $query->result();

        $this->db->select('network_id,name');
        $query1     = $this->db->get('networks');
        $networks   = $query1->result();
        $data[]     = $networks;
        $data[]     = $brands;
        return $brands;
        
    }

    public function get_model($brand,$price){
        // a Query to get all the models for a selected brand
        // use the variable $price to query whithin the price range
        /*$query      = $this->db->get_where('phoneitems', array('phone_id' => $brand));
        $models     = $query->result();
        return $models;*/
         $sql = "SELECT  ph.* , pr.*  FROM phoneitems  ph , price pr  where pr.item_id = ph.item_id AND ph.phone_id = ".$brand." group by ph.type ";
         $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_numbers($model,$price,$brand){
        $price                    =  explode(";", $price);
        $min                      =  $price[0];
        $max                      =  $price[1];

        if (empty($model)) {
             $sql   = "SELECT COUNT(*) AS total FROM price pr , phoneitems ph , phones ps WHERE 
             pr.`item_id` = ph.`item_id`
             AND ps.`phone_id` = ph.`phone_id`  AND ph.`phone_id` = '".$brand."' ";
         }

        else {
        $sql   = "Select Count(*) as total from price where item_id = '".$model."' and price  between '".$min."' and '".$max."'   ";
        }
            $query = $this->db->query($sql);
            return $query->result();
    }

    public function get_results($brand,$model,$min,$max){
        // add the price in the where clause as well

          $sql = "SELECT  ph.* , pr.*  FROM phoneitems  ph , price pr  where pr.item_id = ph.item_id AND ph.phone_id = ".$brand." ";

        if (!empty($model)) {
        $sql .= " AND ph.item_id = '".$model."' ";
        }

       if (!empty($min) && !empty($max)) {
           $sql .= " AND pr.price between '".$min."' and '".$max."' ";
       }

       $this->session->set_userdata('brand',$brand);
       $this->session->set_userdata('model',$model);

//echo $sql;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function advanced_results($brand,$model,$price,$mobile_network,$mobile_contract,$minutes,$texts,$screen_size,$camera,$battery){
        
       $this->session->set_userdata('brand',$brand);
       $this->session->set_userdata('model',$model);

        $sql = "SELECT  ph.* , pr.*  FROM phoneitems  ph , price pr  where pr.item_id = ph.item_id AND ph.phone_id = ".$brand." ";

        if (!empty($model)) {
        $sql .= " AND ph.item_id = '".$model."' ";
        }

        if (!empty($price)) {
            $price = explode(";", $price);
            $sql .= " AND pr.price between '".$price[0]."' and '".$price[1]."' ";
        }

        if (!empty($mobile_network)) {
             $sql .= " AND pr.network_id = '".$mobile_network."' ";
        }

//echo $sql;
        $query = $this->db->query($sql);
        return $query->result();

      

    }

    public function result_update($minutes,$texts,$price,$duration){

        $brand       =  $this->session->userdata('brand');
        $model       =  $this->session->userdata('model');
        $minutes     =  explode(";", $minutes);
        $min_minutes =  $minutes[0];
        $max_minutes =  $minutes[1];
        $texts       =  explode(";", $texts);
        $min_texts   =  $texts[0];
        $max_texts   =  $texts[1];
        $price       =  explode(";", $price);
        $min_price   =  $price[0];
        $max_price   =  $price[1];
        $duration    =  explode(";", $duration);
        $min_duration=  $duration[0];
        $max_duration=  $duration[1];

        $sql = " SELECT * from price pr , phoneitems ph WHERE pr.item_id = ph.item_id AND pr.item_id = '".$model."' and pr.price between '".$min_price."' and '".$max_price."' and pr.contract_length between '".$min_duration."' and '".$max_duration."' and pr.minutes between ".$min_minutes." and ".$max_minutes." and pr.text between ".$min_texts." and ".$max_texts." " ;   
        
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
}
?>