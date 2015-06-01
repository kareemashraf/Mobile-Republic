<?php

class Ipraynow_Controller extends Home_Controller
{

	public $restful = true;

	/**
	 * Show Landing Page
	 * @param  string $lead Lead_generator name
	 */
	public function get_index($lead = null) {

        if($lead == 'index') {
			$lead      = URI::segment(3);
			//die($lead);
		}
		 else {
		 	Session::put('lead', $lead);
		 } 


             return View::make('ipraynow.index'); 
          

	}

	public function post_index() {
    
         $lead 	     =  Session::get('lead');
         $telephone  = Input::get('telephone');

         $ip			= ($_SERVER['REMOTE_ADDR'] == '::1' ) ? '196.221.149.235' : $_SERVER['REMOTE_ADDR'];
		 $ipdump 	= file_get_contents('http://www.telize.com/geoip/'.$ip);
		 $ipinfo		= json_decode($ipdump, true);
		 $key 		= $ipinfo['country_code'];
		 $country	= $ipinfo['country'];

		 if(!empty($lead)) {
			$generator = 'SISTERS_ipraynow_phone_'.$lead.'_UK';
		 }
		  else {
			$generator = 'SISTERS_ipraynow_phone_UK';
		 }

		 if(!is_numeric($telephone) || empty($telephone)) {
			Session::put('error', 'Please type your phone number');	
			$error  = Session::get('error');
			return View::make('ipraynow.index')->with('telephone', $telephone)->with('error', $error);                                    
        }

        $valuelen = strlen($telephone);
		
		if($valuelen < 10 || $valuelen > 11) {
			Session::put('error', 'Please make sure that you inserted the correct phone number');
			$error  = Session::get('error');
			return View::make('ipraynow.index')->with('telephone', $telephone)->with('error', $error);  
		}

		if($telephone[0] == 0 && !in_array($telephone[1], array(1, 2, 7, 8))) {
            Session::put('error', 'Please make sure that you inserted the correct phone number');
			$error  = Session::get('error');
			return View::make('ipraynow.index')->with('telephone', $telephone)->with('error', $error);  
		}

	   $data	= array();
	   $id		= DB::table('lead')->where('mobile','=',$telephone)->only('lead_id');
	   //die($id);
	   
	   if(empty($id)){
			$data['title']			= 'Mrs';
			$data['mobile'] 		= $telephone;
			$data['lead_generator']	= $generator;
			$data['county']			= $country;
			$data['ip'] 			= $_SERVER['REMOTE_ADDR'];
			$data['date_added']		= date('Y-m-d H:i:s');

            $id = DB::table('lead')->insert_get_id($data);
            Session::put('id', $id);
	   }
	   else{
	     	$data['title']			= 'Mrs';
			$data['mobile'] 		= $telephone;
			$data['lead_generator']	= $generator;
			$data['county']			= $country;
			$data['ip'] 			= $_SERVER['REMOTE_ADDR'];
			$data['date_added']		= date('Y-m-d H:i:s');
           
            $id = DB::table('lead_dup')->insert_get_id($data);
            Session::put('id', $id);
	   }
	   return Redirect::to_action('ipraynow.thanks');
	}

	public function get_thanks(){

		$id 	    = Session::get('id');
       
        if (!empty($id)) {
        	
        	if (!empty($error)) {
           return View::make('ipraynow.thanks')->with('error', $error); 
            }
            else {
             return View::make('ipraynow.thanks');
            }
        }

        return Redirect::to_action('ipraynow.index');

	}

	public function post_thanks(){

		$id         =  Session::get('id');
		$name 		=  explode(' ', Input::get('fullname'));
        $email	    =  Input::get('email');
        
        $firstname 	= $name[0];
        $lead 		= Session::get('lead');

		$ip			= $_SERVER['REMOTE_ADDR'];
		$ipdump 	= file_get_contents('http://www.telize.com/geoip/'.$ip);
		$ipinfo		= json_decode($ipdump, true);
		$key 		= $ipinfo['country_code'];
		$country	= $ipinfo['country'];

		if (strlen($lead) > 20) {
				$lead = '';
			}
        if(!empty($name[1])){
				$lastname 	= $name[1];
			}else{
				$lastname 	= '';
			}

			Session::put('name', $name);
			Session::put('email', $email);
        
        if(!empty($lead)) {
			$generator = 'SISTERS_ipraynow_'.$lead.'_UK';
		 }
		  else {
			$generator = 'SISTERS_ipraynow_UK';
		 }

		 if (!ctype_alpha($firstname) || !ctype_alpha($lastname) || empty($firstname) || empty($lastname)) {
				Session::put('error', 'Please make sure that you inserted your full name correctly');
                $error  = Session::get('error');
			    return View::make('ipraynow.thanks')->with('fullname', $name)
			                                        ->with('email', $email);
	    }

	    if (empty($email)) {
			Session::put('error', 'Please type your email address');
			$error  = Session::get('error');	
            return View::make('ipraynow.thanks')->with('fullname', $name)
			                                    ->with('email', $email);
		}

		if(!filter_var($email , FILTER_VALIDATE_EMAIL)) {
			Session::put('error', 'Please make sure that you inserted correct email address');
			$error  = Session::get('error');
            return View::make('ipraynow.thanks')->with('fullname', $name)
			                                    ->with('email', $email);
		}

		$id                         = DB::table('lead')->where('lead_id','=',$id)->only('lead_id');
		$data 					    = array();
			$data['firstname'] 		= $firstname;
			$data['lastname'] 		= $lastname;
			$data['email'] 	    	= $email;
			$data['lead_generator']	= $generator;
			$data['county']			= $country;
        
        if(empty($id)){
				$user_id = DB::table('lead_dup')->where('lead_id','=',$id)->update($data);
	    }else{
				$user_id = DB::table('lead')->where('lead_id','=',$id)->update($data);
			}
        Session::forget('email');
        Session::forget('lead');
		Session::forget('id');
		Session::forget('name');
		Session::forget('error');

		return Redirect::to_action('ipraynow.index');

	}
	
}
?>