<?php
class Validator extends Laravel\Validator {     
        /**
        * check if email address is active or not
        * @param  mixed  $attribute 
        * @param  string $value     E-mail Address
        * @return bool                   true if email vaild and vice versa
        */
        public function validate_active_email($attribute, $value)
        {
            $domains = array('hotmail.com', 'hotmail.co.uk','live.com', 'live.co.uk', 'outlook.com', 'outlook.co.uk');
            $email = 'bondo2.91@gmail.com';
            list($username,$domain)=explode('@',$email);
            if(checkdnsrr($domain,'MX'))
            {
                if (!in_array($domain, $domains))
                {
                    $smtp = new SMTP();
                    $sender = 'itsupport@smhm.co.uk';
                    $results = @$smtp->validate(array($email), $sender);
                    if (isset($results[$email]) and $results[$email])
                        return true;
                    else
                        return false;
                }
                return true;
            }
        }
        
        /**
        * check title
        * @return bool              true
        */
        public static function validate_title($attribute, $value){
            return true;
        }
        /**
        * check if valid uk postcode
        * @param  mixed  $attribute 
        * @param  string $value     UK Post Code
        * @param  array $parameters array(0 => country name)
        * @return bool              true if uk post code and vice versa 
        */
        public static function validate_postcode($attribute, $value, $parameters)
        {
            $country = strtolower($parameters[0]);

             if($country == "%s")
                $country = strtolower(Session::get('country'));

            if ($country == 'united kingdom')
            {
                        //list of some special cases
                $special_cases = array('GIR 0AA','TDCU 1ZZ','ASCN 1ZZ','BIQQ 1ZZ','BBND 1ZZ','FIQQ 1ZZ','PCRN 1ZZ','STHL 1ZZ','SIQQ 1ZZ','TKCA 1ZZ');

                // trim all spaces
                $value = str_replace(' ', '', $value);

                // get the lenght after trim
                $valuelen = strlen($value);

                // if less than 5 or greater than 7 
                if ($valuelen < 5 || $valuelen > 7)
                    return false;
                else
                {
                // part 1 the Outward of PostCode
                    $part1 = substr($value,0 ,$valuelen - 3);

                // part 2 is the inward of PostCode
                    $part2 = substr($value, $valuelen - 3);

                // add Space in the PostCode 
                    $value = $part1 . ' ' . $part2;

                //All Characters Should be Upper case
                    $value = strtoupper($value);

                //Special Cases
                    if (in_array($value, $special_cases))
                        return true;

                   //Regex Check For The PostCode
                    $regex = "([A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]|[A-HK-Y][0-9]([0-9]|[ABEHMNPRV-Y]))|[0-9][A-HJKS-UW]) [0-9][ABD-HJLNP-UW-Z]{2})";
                    return (preg_match($regex, $value) == 1) ? true: false;
                }
            }
            else
                return true;
        }

        /**
         * check if valid uk phone
         * @param  mixed  $attribute 
         * @param  string $value     Uk Phone Number
         * @param  array $parameters array(0 => country name)
         * @return [type]            true if uk phone number and vice versa
         */
        public static function validate_phone($attribute, $value, $parameters)
        {
            $country = strtolower($parameters[0]);
            
            if($country == "%s")
                $country = strtolower(Session::get('country'));

            $valuelen = strlen($value);

            if ($country == 'united kingdom')
            {
                if ($valuelen == 11 && $value[0] == 0)
                    return in_array($value[1], array(1, 2, 7));
                else
                    return false;
            }

            else if ($country == 'united states' || $country == 'canada')
            {
                if ($valuelen == 10 && $value[0] != 0 )
                    return true;
                else if ($valuelen == 11 && $value[0] = 1)
                    return true;
            }

            else if ($country == 'australia')
            {
                if ($valuelen == 10 && $value[0] = 0 && in_array( $value[1], array(1,2,3,4,5,7,8)))
                    return true;
                else if ($valuelen == 8 && $value[0] != 0) 
                    return true;
                else
                    return false;
            }

            else if ($country == 'egypt')
            {
                if ($valuelen == 11 && $value[0] == 0 && $value[1] == 1 && in_array($value[2], array(0,1,2)) && in_array($value[3], array(0,1,2,4,6,7,8,9)))
                    return true;
                else
                    return false;
            }
            return true;
        }

        /**
         * check if within our country list
         * @param  string $attribute  
         * @param  string $value      Country name
         * @return bool               true if in our list and vice versa
         */
        public function validate_country($attribute, $value)
        {
            $countries = array_map('strtolower', Config::get('countries'));

            return in_array(strtolower($value), $countries);
        }

        /**
         * check if user is adult
         * @param  string $attribute 
         * @param  string $value     User date of birth
         * @return bool              true if adult
         */
        public function validate_adult($attribute, $value)
        {
            if (!$this->validate_date_format($attribute, $value))
                return FALSE;
            if (! $this->validate_date_value($attribute, $value))
                return FALSE;

            list($year,$month,$day) = explode('-', $value);
            return (date('Y') - $year) > 17;
        }

        /**
         * check if date is in (yyyy-mm-dd) format
         * @param  string $attribute  
         * @param  string $value      date of birth
         * @return bool               true if valid format
         */
        public function validate_date_format($attribute, $value)
        {
            return preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $value); 
        }

        /**
         * check if date is valid value
         * @param  string $attribute  
         * @param  string $value      date of birth
         * @return bool               true if valid date value
         */
        public function validate_date_value($attribute, $value)
        {
            if (!$this->validate_date_format($attribute, $value))
                return FALSE;
            list($year, $month, $day) = explode('-', $value);
            return checkdate($month, $day, $year);
        }
    }
    ?>