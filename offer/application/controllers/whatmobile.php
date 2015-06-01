<?php

class Whatmobile_Controller extends Home_Controller
{

	public $restful = true;

	/**
	 * Show Landing Page
	 * @param  string $lead Lead_generator name
	 */
	public function get_index($lead = null) {
		if($lead == 'index')
			$lead = URI::segment(3);

	
		Session::put('lead', $lead);


		

		$ip				= ($_SERVER['REMOTE_ADDR'] == '::1' ) ? '196.221.149.235' : $_SERVER['REMOTE_ADDR'];
		$ipdump 		= file_get_contents('http://www.telize.com/geoip/'.$ip);
		$ipinfo			= json_decode($ipdump, true);
		$key			= $ipinfo['country_code'];
		$country		= $ipinfo['country'];
        
        Session::put('country', $country);
        Session::put('key', $key);

		$fullname     = Session::get('fullname');
		$email        = Session::get('email');
		$postcode     = Session::get('postcode');
		$telephone    = Session::get('telephone');
		$address      = Session::get('address');

		//return View::make('whatmobile.index');

		 if(!empty($fullname) && !empty($email) && !empty($error)) {
			return View::make('whatmobile.index')->with('fullname', $fullname)
			->with('email', $email)
			->with('telephone', $telephone)
			->with('postcode', $postcode)
			->with('address', $address)
			->with('country', $country);
        }
		else {
			return View::make('whatmobile.index')
			->with('fullname', '')
			->with('email', '')
			->with('telephone', '')
			->with('postcode', '')
			->with('address', '')
			->with('country', $country);
		}
	
	}

	public function post_index() {
		$lead 			= Session::get('lead');
		$key 			= Session::get('key');
		$country    	= Session::get('country');

		$fullname 		= Input::get('fullname');
		$fullname1      = explode(' ', $fullname);
		$firstname 		= $fullname1[0];
		$telephone		= Input::get('telephone');
		$postcode		= Input::get('postcode');
		$email			= Input::get('email');
		$address		= Input::get('address');
		$campaign       = 'Mobile_republic';
		




		if(!empty($fullname1[1]))
			$lastname 	= $fullname1[1];
		else
			$lastname 	= '';
				
		if(!empty($lead))
			$generator = 'Mobile_republic_whatmobile_'.$lead.'_UK';
		else
			$generator = 'Mobile_republic_whatmobile_UK';

        //Session::put('submit', Hash::make('yes'));
/*        return $this->addlead(URL::to_action('whatmobile.index'), URL::to_action("whatmobile.thanks"), $generator, 'Mobile_republic', 'United Kingdom', 'whatmobile');
*/      
        if (empty($country)) {
		   	 $country = 'United Kingdome';
		   }
		   
		   if(empty($key)){
             $key = 'UK';
		   }

		Session::put('fullname' , $fullname);
		Session::put('email' , $email);
		Session::put('postcode' , $postcode);
		Session::put('telephone', $telephone);
		Session::put('address', $address);

		 if (!empty($lead)) {
		  	$generator = $campaign.'_whatmobile_'.$lead.'_'.$key;
		  } else {
		  	$generator = $campaign.'_whatmobile_'.$key;
		  }

		  if (!ctype_alpha($firstname) || !ctype_alpha($lastname) || empty($firstname) || empty($lastname)) {
			Session::put('error', 'Please make sure that you inserted your full name');
			$error  = Session::get('error');
				return View::make('whatmobile.index')->with('fullname', $fullname)
			->with('email', $email)
			->with('telephone', $telephone)
			->with('postcode', $postcode)
			->with('address', $address)
			->with('country', $country)
			->with('error', $error);
		}

		if (empty($email)) {
			Session::put('error', 'Please type your email address');
			$error  = Session::get('error');	
				return View::make('whatmobile.index')->with('fullname', $fullname)
			->with('email', $email)
			->with('telephone', $telephone)
			->with('postcode', $postcode)
			->with('address', $address)
			->with('country', $country)
			->with('error', $error);
		}

		if(!filter_var($email , FILTER_VALIDATE_EMAIL)) {
			Session::put('error', 'Please make sure that you inserted correct email address');
			$error  = Session::get('error');	
				return View::make('whatmobile.index')->with('fullname', $fullname)
			->with('email', $email)
			->with('telephone', $telephone)
			->with('postcode', $postcode)
			->with('address', $address)
			->with('country', $country)
			->with('error', $error);
		}

		
		if (empty($address)) {
			Session::put('error', 'Please make sure that you inserted the Address');
			$error  = Session::get('error');	
				return View::make('whatmobile.index')->with('fullname', $fullname)
			->with('email', $email)
			->with('telephone', $telephone)
			->with('postcode', $postcode)
			->with('address', $address)
			->with('country', $country)
			->with('error', $error);
		}
		
		if(empty($postcode)) {
			Session::put('error', 'Please type your postcode');	
			$error  = Session::get('error');
			return View::make('whatmobile.index')->with('fullname', $fullname)
			->with('email', $email)
			->with('telephone', $telephone)
			->with('postcode', $postcode)
			->with('address', $address)
			->with('country', $country)
			->with('error', $error);
		}
		
		if(empty($telephone)) {
			Session::put('error', 'Please type your phone number');	
			$error  = Session::get('error');
			return View::make('whatmobile.index')->with('fullname', $fullname)
			->with('email', $email)
			->with('telephone', $telephone)
			->with('postcode', $postcode)
			->with('address', $address)
			->with('country', $country)
			->with('error', $error);
		}

		if (!is_numeric($telephone)) {
			Session::put('error', 'Please make sure that you inserted the correct phone number');
			$error  = Session::get('error');	
			     return View::make('whatmobile.index')->with('fullname', $fullname)
			->with('email', $email)
			->with('telephone', $telephone)
			->with('postcode', $postcode)
			->with('address', $address)
			->with('country', $country)
			->with('error', $error);
		}

		

       $data	= array();
	   $id		= DB::table('lead')->where('email','=',$email)->only('lead_id');
		
		if(empty($id)){
			$data['title']			= 'Mr';
			$data['firstname'] 		= $firstname;
			$data['lastname']		= $lastname;
			$data['email']			= $email;
			$data['mobile']			= $telephone;
			$data['address1']       = $address;
			$data['lead_generator']	= $generator;
			$data['postcode']		= $postcode;
			$data['campaign']		= $campaign;
			$data['county']			= $country;
			$data['ip'] 			= $_SERVER['REMOTE_ADDR'];
			$data['date_added']		= date('Y-m-d H:i:s');
		
			$id = DB::table('lead')->insert_get_id($data);
		}
		else {
			$data['title']			= 'Mr';
			$data['firstname'] 		= $firstname;
			$data['lastname']		= $lastname;
			$data['email']			= $email;
			$data['mobile']			= $telephone;
			$data['address1']       = $address;
			$data['lead_generator']	= $generator;
			$data['postcode']		= $postcode;
			$data['campaign']		= $campaign;
			$data['county']			= $country;
			$data['ip'] 			= $_SERVER['REMOTE_ADDR'];
			$data['date_added']		= date('Y-m-d H:i:s');
		
			$id = DB::table('lead_dup')->insert_get_id($data);
		}

		Session::put('submit', Hash::make('yes'));

		
		return View::make('whatmobile.thanks');
       
	}

	public function get_thanks() {
		Session::forget('lead');
        Session::forget('fullname');
		Session::forget('telephone');
		Session::forget('postcode');
		Session::forget('email');
		Session::forget('address');
		Session::forget('country');
		Session::forget('error');
		Session::forget('key');
		return View::make('whatmobile.thanks');
	}


	public function get_download()
	{
		//Hash Check For form Submit Session
		if (Hash::check('yes', Session::get('submit')))
		{
			// Full URL to File to Download
			$file = 'http://sisters-magazine.com/offer/public/inc_freeissue/file/complimentary_issue.pdf';

			// Remove Session to Prevent Many Downloads
			Session::forget('submit');

			// Redirect to File Download or Landing page URL
			return $this->downloadfile($file, URL::to_action('whatmobile.index'));
		}

		//Redirect to Index again
		return Redirect::to_action('whatmobile.index');
	}

	/**
	 * Add lead "form Submit"
	 */
	
}
?>