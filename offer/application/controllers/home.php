<?php

class Home_Controller extends Base_Controller {

	public $restful = true;
 
    /**
     *  fields of form not in lead table
     *  @param string $page_name page name to load
     * @return array form fields
     */
    public function fields($page_name)
    {
        return Config::get("$page_name.form_fields");
    }

    /**
     * validate form fields
     * @param  array $input  form fields
     * @return mixed         Laravel Validator Class
     */
    public function validate($input, $page_name)
    {
        $rules = Config::get("$page_name.form_rules");

        return Validator::make($input,$rules);
    }

    /**
     * Add Lead to Database after Checking Input
     * @param  string $home_url         Home URL "Full Path"
     * @param  string $thanks_url       Thanks URL "Full Path"
     * @param  string $lead_generator   Lead Generator Name
     * @param  string $campaign         Campaign Name
     * @param  string $country          Country Name
     * @param  string $page_name        Landing Page Name [any name except 'post' , 'default' used for normal settings]
     * @param  string $title            Title default 'Mrs'
     * @param  string $type             Type of return ['redirect' - 'ajax']
     */
    public function addlead($home_url, $thanks_url, $lead_generator, $campaign, $country, $page_name = 'default' , $title = 'Mrs', $type = 'redirect')
    {
        // Lead or Lead Dup Instance 
        $leadInstance = null;
        
        // Set Post String Config names
        $postStrings = array('post', 'new_post');
        // get form elements from input
        $form = array_only(Input::all(), $this->fields($page_name));

        //validate form
        $validform = $this->validate($form, $page_name);

        if ($validform->fails())
        {
                // return $home_url on redirect request
            if ($type == 'redirect') {
				$uri = $_SERVER['REQUEST_URI']; $uri = explode("/", $uri);

				if($uri[3] == 'acerz3') {
					if($uri[4] == 'c4p') {
						$home_url = $home_url.'/'.$uri[4].'/'.$uri[5];
					}
				}

                return Redirect::to($home_url)->with_errors($validform)->with_input('except', array('captcha'));
                // return errors on ajax request
            }
			else if ($type == 'ajax')
                return $validform->errors;
        }

        // get lead values from input
        $lead = array_only(Input::all(), Lead::columns($page_name));

        //Default values for landing pages
        if (!in_array($page_name, $postStrings))
        {
            //default values for lead values that doesn't come from landing page
            $lead['title'] = strlen(Input::get('title', '')) ? Input::get('title') : $title;
            $lead['lead_generator'] = strlen(Input::get('lead', '')) ? Input::get('lead') : $lead_generator;
            $lead['campaign'] = strlen(Input::get('campaign', '')) ? Input::get('campaign') : $campaign;
            $lead['dob'] = strlen(Input::get('dob', '')) ? Input::get('dob') : '1980-01-01';
            $lead['city'] = strlen(Input::get('city', '')) ? Input::get('city') : '';
            $lead['county'] = strlen(Input::get('county', '')) ? Input::get('county') : $country;
            $lead['date_added'] = date("Y-m-d H:i:s");
            $lead['ip'] = getenv("REMOTE_ADDR");
            $lead['notes'] = Input::get('notes');
			
			$detect = Mobile::make('freeissue51');
			
			if($detect == 'freeissue51m')
				$lead['extra4'] = 'mobile';
        }

        //Default Values form Post String
        else
        {
            $lead['title'] = strlen(Input::get('title', '')) ? Input::get('title') : $title;
            $lead['county'] = strlen(Input::get('county', '')) ? Input::get('county') : $country;
            $lead['date_added'] = date("Y-m-d H:i:s");
            $lead['ip'] = getenv("REMOTE_ADDR");
            $lead['extra2'] = 'laravel post string';
        }
        //validate lead values
        $validlead = Lead::validate($lead, $page_name);

        if ($validlead->fails()){
            if ($type == 'redirect')
                return Redirect::to($home_url)->with_errors($validlead)->with_input('except', array('captcha'));
            else if ($type == 'ajax')
                return $validlead->errors;
        }
		
		//Check if landing page is free issue 51 then send email
		$landing_page = str_replace('_rules', '', $page_name);
		
		/*	if($landing_page == 'freeissue51' || $landing_page == 'freeissue51f') {
			$name 		= explode(' ', Input::get('fullname'));
			$firstname 	= $name[0];
	
			if(!empty($name[1]))
				$lastname 	= $name[1];
			else
				$lastname 	= '';
			
				
			//Send email to the lead
			$email 		= Input::get('email');
			$token 		= sha1(uniqid($email, true));
			$url 		= 'http://sisters-magazine.com/offer/public/freeissue51/file/'.$token;
			$message 	= sprintf(Config::get('freeissue51.email_content'), $firstname, $url);
			
			Session::put('firstname',$firstname);
			Session::put('lastname',$lastname);
			Session::put('email',$email);
			Session::put('thanks', 'yes');
			
			Mailer::$protocol  	= Config::get('mail.protocol');
			Mailer::$parameter 	= Config::get('mail.parameter');
			Mailer::$hostname  	= Config::get('mail.hostname');
			Mailer::$username  	= Config::get('mail.username');
			Mailer::$password  	= Config::get('mail.password');
			Mailer::$port      	= Config::get('mail.port')  ;
			Mailer::$timeout   	= Config::get('mail.timeout');
			Mailer::setFrom(Config::get('mail.username'));
			//Mailer::setSender('<'.Config::get('mail.hostname').'>');
			Mailer::setSender(Config::get('mail.username'));
			Mailer::setSubject(Config::get('freeissue51.email_subject'));
			Mailer::setHtml(html_entity_decode($message));
			Mailer::setTo($email);
			Mailer::send();
			
			DB::table('landing_pages_tokens')->insert(array('firstname' => $firstname, 'lastname' => $lastname,'email' => $email,'token' => $token, 'tstamp' => $_SERVER["REQUEST_TIME"]));
			//////////////////////////////////////
		}
		else {
			//Send email to the lead
			$email 				= Input::get('email');
			$email_encoded 		= urlencode(Input::get('email'));
			$message 			= sprintf(Config::get('email.email_content'), $email, $email, $email_encoded);

			Mail::$protocol  	= Config::get('mail2.protocol');
			Mail::$parameter 	= Config::get('mail2.parameter');
			Mail::$hostname  	= Config::get('mail2.hostname');
			Mail::$username  	= Config::get('mail2.username');
			Mail::$password  	= Config::get('mail2.password');
			Mail::$port      	= Config::get('mail2.port')  ;
			Mail::$timeout   	= Config::get('mail2.timeout');
			Mail::setFrom(Config::get('mail2.username'));
			Mail::setSender('Sisters Magazine <'.Config::get('mail2.hostname').'>');
			Mail::setSubject(Config::get('email.email_subject'));
			Mail::setHtml(html_entity_decode($message));
			Mail::setTo($email);
			Mail::send();
		}*/
		
        //Update lead and campaign
        $lead['lead_generator'] = Config::get('lead_names.' . $lead['lead_generator'], $lead['lead_generator']);
        $lead['campaign'] = Config::get('lead_campaigns.' . $lead['lead_generator'], $lead['campaign']);

        // [Biz-Consumer] Filter to Lead Generator Names
        if(isset($lead['lead_type']) && $lead['lead_type'] == 'biz'){
            $lead['lead_generator'] .= '_biz';
        }
        unset($lead['lead_type']);

        //check duplicates "database view"
        $min_last_date = date("Y-m-d h:i:s",strtotime("-3 months",time()));

		if($landing_page == 'backup' || $landing_page == 'nocreditcheck'){
			$found = Lead::where_telephone_and_campaign($lead['email'], $lead['campaign'])->where('date_added', '>', $min_last_date )->count();
		}
		else
			$found = Lead::where_telephone_and_campaign($lead['telephone'], $lead['campaign'])->where('date_added', '>', $min_last_date )->count();

        if ($found){
            $leadInstance = Leaddup::create($lead);
            $leadInstance->table = 'Leaddup';

			Session::put('lead_id_desktop',$leadInstance->id);
			Session::put('lead_table', 'lead_dup');
						
            //forget download session for duplicates on landing page
            Session::forget('submit');
        }
        else{
            $leadInstance = Lead::create($lead);
            $leadInstance->table = 'Lead';
			
			Session::put('lead_id_desktop',$leadInstance->id);
			Session::put('lead_table', 'lead');
        }

		if($landing_page == 'backup')
			Session::put('backup_lead_id', $leadInstance->id);
		elseif($landing_page == 'nocreditcheck')
			Session::put('nocreditcheck_lead_id', $leadInstance->id);

        //check duplicates "provider response view"
        //insert unique lead phone and email
        try {
            Uniqueemail::create(array('email' => $lead['email']));
			
			if($landing_page != 'backup' || $landing_page != 'nocreditcheck')
				Uniquephone::create(array('telephone' => $lead['telephone']));
        }
        catch (Exception $e)
        {
            //landing page ends here
            if (! in_array($page_name, $postStrings))
            {
                if ($type == 'redirect')
                    return Redirect::to($thanks_url);
                else
                    return array('inserted' => true, 'lead_table'=> $leadInstance->table, 'leadId' => $leadInstance->id);
            }

            //create Duplicate Error Message
            $errors = new stdClass();
            $errors->messages = array(array('Duplicate Email or Phone Number'));
            return $errors;
        }
			
        if ($type == 'redirect')
            return Redirect::to($thanks_url);
        else
            return array('inserted' => true, 'lead_table'=> $leadInstance->table, 'leadId' => $leadInstance->id);
    }

    /**
     * Update Lead to Database after Checking Input
     * @param  string $leadId           The Lead Id to Update
     * @param  string $table            Table Model Name (Lead or LeadDup)
     * @param  string $page_name        Landing Page Name [any name except 'post' , 'default' used for normal settings]
     */
    public function updatelead($leadId, $table, $page_name)
    {
        // get lead values from input
        $lead = array_only(Input::all(), Lead::columns($page_name, 'extra_columns'));

        //validate lead values
        $validlead = Lead::validate($lead, $page_name, 'extra_rules');

        if ($validlead->fails()){
            return $validlead->errors;
        }
        else{
            $table = Input::get('table', $table);
            $lead = $table::where('lead_id', '=' , $leadId)->update($lead);
            return array('updated' => true);
        }
    }

    /**
     * Download File or Redirect to Landing Page
     * @param  string $file     File Link "Full Path"
     * @param  string $home_url Home Url  "Full Path"
     */
    public function downloadfile($file,$home_url)
    {
        return is_null($file) ? Redirect::to($home_url) : Redirect::to($file);
    }

	/* Check if email is valid */
	public function get_isEmail($email = NULL) {
		return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
	}
	
	/* Check if an email address exists. */
	function jValidateEmailUsingSMTP($sToEmail, $sFromDomain = "yourdomain.com", $sFromEmail = "sample@yourdomain.com", $bIsDebug = false) {
		$bIsValid 		= true; // assume the address is valid by default..
		$aEmailParts 	= explode("@", $sToEmail); // extract the user/domain..
		
		getmxrr($aEmailParts[1], $aMatches); // get the mx records..

		if (sizeof($aMatches) == 0) {
			return false; // no mx records..
		}

		foreach ($aMatches as $oValue) {
			if ($bIsValid && !isset($sResponseCode)) {
				// open the connection..
				$oConnection = @fsockopen($oValue, 25, $errno, $errstr, 30);
				$oResponse = @fgets($oConnection);

				if (!$oConnection) {
					$aConnectionLog['Connection'] = "ERROR";
					$aConnectionLog['ConnectionResponse'] = $errstr;
					$bIsValid = false; // unable to connect..
				} 
				else {
					$aConnectionLog['Connection'] = "SUCCESS";
					$aConnectionLog['ConnectionResponse'] = $errstr;
					$bIsValid = true; // so far so good..
				}

				if (!$bIsValid) {
					if ($bIsDebug) print_r($aConnectionLog);
					return false;
				}

				// say hello to the server..
				fputs($oConnection, "HELO $sFromDomain\r\n");
				$oResponse = fgets($oConnection);
				$aConnectionLog['HELO'] = $oResponse;

				// send the email from..
				fputs($oConnection, "MAIL FROM: <$sFromEmail>\r\n");
				$oResponse = fgets($oConnection);
				$aConnectionLog['MailFromResponse'] = $oResponse;

				// send the email to..
				fputs($oConnection, "RCPT TO: <$sToEmail>\r\n");
				$oResponse = fgets($oConnection);
				$aConnectionLog['MailToResponse'] = $oResponse;

				// get the response code..
				$sResponseCode = substr($aConnectionLog['MailToResponse'], 0, 3);
				$sBaseResponseCode = substr($sResponseCode, 0, 1);

				// say goodbye..
				fputs($oConnection,"QUIT\r\n");
				$oResponse = fgets($oConnection);

				// get the quit code and response..
				$aConnectionLog['QuitResponse'] = $oResponse;
				$aConnectionLog['QuitCode'] = substr($oResponse, 0, 3);

				if ($sBaseResponseCode == "5") {
					$bIsValid = false; // the address is not valid..
				}

				// close the connection..
				@fclose($oConnection);
			}
		}

		if ($bIsDebug) {
			print_r($aConnectionLog); // output debug info..
		}

		return $bIsValid;
	}
}