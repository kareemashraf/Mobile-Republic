<?php

class Vfcb_Controller extends Home_Controller
{

	public $restful = true;

	/**
	 * Show Landing Page
	 * @param  string $lead Lead_generator name
	 */
	public function get_index($lead = null) {

        if($lead == 'index') {
			$lead      = URI::segment(3);
		}
		 else {
		 	Session::put('lead', $lead);
		 }   

		    $telephone = Session::get('telephone');
		if(!empty($telephone)) {
			return View::make('vfcb.index')->with('telephone', $telephone);
		} 
		  else {
             return View::make('vfcb.index');
          }

	}

	public function post_index(){
		die("test");

		$lead 	    = Session::get('lead');
		$telephone  = Input::get('telephone');
		//die($telephone);

		$ip			= $_SERVER['REMOTE_ADDR'];
		$ipdump 	= file_get_contents('http://www.telize.com/geoip/'.$ip);
		$ipinfo		= json_decode($ipdump, true);
		$key 		= $ipinfo['country_code'];
		$country	= $ipinfo['country'];
		
		Session::put('country', $country);
		Session::put('telephone', $telephone);

		
		if ($key != '') {
			$country_code = '_'.$key;
		}
		else {
			$country_code = '';
		}

		if(!empty($lead)) {
			$generator = 'mobilerepublic_VFCB_phone_'.$lead.$country_code;
		}
		else {
			$generator = 'mobilerepublic_VFCB_phone_'.$country_code;
		}

		if(empty($telephone)) {
			Session::put('error', 'Please type your phone number');	
			$error  = Session::get('error');
			return View::make('vfcb.index')->with('telephone', $telephone);                                    
        }
		
	   $data	= array();
	   $id		= DB::table('lead')->where('email','=',$email)->only('lead_id');
	   
	   if(empty($id)){
			$data['title']			= 'Mr';
			$data['mobile'] 		= $telephone;
			$data['lead_generator']	= $generator;
			$data['county']			= $country;
			$data['ip'] 			= $_SERVER['REMOTE_ADDR'];
			$data['date_added']		= date('Y-m-d H:i:s');

            $id = DB::table('lead')->insert_get_id($data);
            Session::put('id', $id);
             //return View::make('vfcb.form');
	   }
	   else{
	     	$data['title']			= 'Mr';
			$data['mobile'] 		= $telephone;
			$data['lead_generator']	= $generator;
			$data['county']			= $country;
			$data['ip'] 			= $_SERVER['REMOTE_ADDR'];
			$data['date_added']		= date('Y-m-d H:i:s');
           
            $id = DB::table('lead')->insert_get_id($data);
            Session::put('id', $id);
             //return View::make('vfcb.form');
	   }
    
    return View::make('vfcb.form');

         
		//return $this->addlead(URL::to_action('vfcb.index'), URL::to_action("vfcb.form"), $generator, 'mobilerepublic', $country, 'vfcb');

	}
    
    public function get_form(){
    	$lead 	    = Session::get('lead');
		$telephone  = Input::get('telephone');
		$country    = Session::get('country');
        
        $fullname   = Session::get('fullname');

        return View::make('vfcb.form');
          


    }

    public function post_form(){

    	    $id         = Session::get('id');


        	$name 		= explode(' ', Input::get('fullname'));
        	$b_name     = Input::get('bfullname');
        	$postcode	= Input::get('postcode');
        	$email	    = Input::get('email');



			$firstname 	= $name[0];
			$lead 		= Session::get('lead');
			$ip			= $_SERVER['REMOTE_ADDR'];
			$ipdump 	= file_get_contents('http://www.telize.com/geoip/'.$ip);
			$ipinfo		= json_decode($ipdump, true);
			$key 		= $ipinfo['country_code'];
			$country	= $ipinfo['country'];
			
			if ($key != '')
				$country_code = '_'.$key;
			else
				$country_code = '';

			if (strlen($lead) > 20) {
				$lead = '';
			}
			
			if(!empty($name[1]))
				$lastname 	= $name[1];
			else
				$lastname 	= '';


			Session::put('firstname', $firstname);
			Session::put('business', $business);
			Session::put('postcode', $postcode);
			Session::put('email', $email);

			if(!empty($lead))
				$generator = 'mobilerepublic_VFCB_uk_'.$lead.$country_code;
			else
				$generator = 'mobilerepublic_VFCB_uk'.$country_code;

			if (!ctype_alpha($firstname) || !ctype_alpha($lastname) || empty($firstname) || empty($lastname)) {
				Session::put('error', 'Please make sure that you inserted you full name correctly');
                $error  = Session::get('error');
			    return View::make('vfcb.form')->with('fullname', $fullname)
			                                  ->with('bfullname', $b_name)
			                                  ->with('postcode', $postcode)
			                                  ->with('email', $email)
			                                  ->with('error', $error);   

			}

			if (empty($email)) {
			Session::put('error', 'Please type your email address');
			$error  = Session::get('error');	
				return View::make('vfcb.form')->with('fullname', $fullname)
			                                        ->with('email', $email)
			                                        ->with('postcode', $postcode)
			                                        ->with('error', $error);
		}

		if(!filter_var($email , FILTER_VALIDATE_EMAIL)) {
			Session::put('error', 'Please make sure that you inserted correct email address');
			$error  = Session::get('error');	
				return View::make('vfcb.form')->with('fullname', $fullname)
			                                        ->with('email', $email)
			                                        ->with('postcode', $postcode)
			                                        ->with('error', $error);
		}
       
            if(empty($postcode)) {
			Session::put('error', 'Please type your postcode');	
			$error  = Session::get('error');
			return View::make('vfcb.form')->with('fullname', $fullname)
			                                    ->with('email', $email)
			                                    ->with('postcode', $postcode)
			                                    ->with('error', $error);
		}

		$id                         = DB::table('lead')->where('lead_id','=',$lid)->only('lead_id');
		$data 					    = array();
			$data['firstname'] 		= $firstname;
			$data['lastname'] 		= $lastname;
			$data['email'] 	    	= $email;
			$data['postcode'] 		= $postcode;
			$data['lead_generator']	= $generator;
			$data['county']			= $country;


        
        if(empty($id)){
				$user_id = DB::table('lead_dup')->where('lead_id','=',$id)->update($data);
	    }else{
				$user_id = DB::table('lead')->where('lead_id','=',$id)->update($data);
			}
	return View::make('vfcb.thanks');

    }






}
?>