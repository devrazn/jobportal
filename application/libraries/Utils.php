<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Utils
{


    static public function get_from_GET($field_name)
    {
        $CI = get_instance();
        $field_data = $CI->input->get($field_name, TRUE);

        if ($field_data == FALSE)
        {
            $field_data = "";
        }

        return $field_data;
    }


    static public function get_from_POST($field_name)
    {
        $CI = get_instance();
        $field_data = $CI->input->post($field_name, TRUE);

        if ($field_data === FALSE)
        {
            $field_data = "";
        }

        return $field_data;
    }


    static public  function changeNullStringToEmpty($string)
    {

        if (($string===NULL) ||($string=="(NULL)") ||($string=="NULL"))
        {
            $string = " ";
        }

        return $string;
    }

    static public  function changeNullsToEmptyInArray($array)
    {
        foreach ($array as $key => $value)
        {
            if ($value === NULL)
            {
                $array[$key] = "";
            }
        }

        return $array;
    }


    public function getArrayValue($key, $array, $default_value = "")
    {
        if (array_key_exists($key, $array))
        {
            if ($array[$key] == NULL)
            {
                return $default_value;
            }
            else
            {
                return $array[$key];
            }
        }
        else
        {
            return $default_value;
        }
    }


    public function addToArrayIfNotEmpty($value, $key, &$array)
    {
        if ($value != "")
        {
            $array[$key] = $value;
        }
    }


    /**
     * This compares two arrays, a params list and a mandatory params list
     *
     * @category Utils
     * @author Created By: Manuel Maguina
     * @author Last Modified By: Manuel Maguina, 2012-12-21
     * @return Array $result
     * @return Boolean $result['success'], valid or not
     * @return Array $result['missing'], list of missing params
     */
    public function check_mandatory($params, $mandatory)
    {
        $result = array('success' => FALSE);

        // checking arguments
        if (! is_array($params) || ! is_array($mandatory) || empty($params))
        {
            $result['missing'] = $mandatory;
            return $result;
        }

        $fields_missing = array();
        // looping through params
        foreach ($mandatory as $m_param)
        {

            if (! isset($params[$m_param]))
            {
                $fields_missing[] = $m_param;
            }
            else
            {
                // NOTE: 0 == "" evaluates to TRUE
                // see http://www.php.net/manual/en/types.comparisons.php
                if ($params[$m_param] == "")
                {
                    $fields_missing[] = $m_param;
                }
            }
        }
        // building result
        $result = array();
        $result['success'] = empty($fields_missing);
        $result['missing'] = $fields_missing;

        return $result;
    }


    public function generate_hash()
    {
        $upper_alphabets = range('A', 'Z');
        shuffle($upper_alphabets);
        return substr(md5(time()), 0, 8) . end($upper_alphabets);
    }


    static public function getCurlOutput($url, $cookies = FALSE, $moreHeaders = "", $timeout = "")
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($timeout == "")
        {
            $timeout = 0;
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        // Adding Headers and Cookies
        self::_addRestHeadersToCurl($ch, $cookies, $moreHeaders);

        $output = curl_exec($ch);
        curl_close($ch);

        /*
        if (DEBUG_PRINT_CURL_OUTPUT)
        {
            error_log("CURL URL -> " . $url);
            error_log("CURL OUTPUT ->" . $output);
        }
        */
        return $output;
    }


    static public function addUserCookiesToCurl($curlHandle)
    {
        // Setting Cookies
        $all_headers = getallheaders();
        $headers = array();

        if (! empty($all_headers['Cookie']))
        {
            $headers[] = "Cookie: " . $all_headers['Cookie'];
        }
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers);
    }


    static public function _addRestHeadersToCurl($curlHandle, $addCookies = FALSE, $moreHeaders = "")
    {
        // exists only when php installed as an apache module
        if (function_exists('getallheaders'))
        {

            $all_headers = getallheaders();

            $headers_ws = array();

            $headers_passthrough = array();
            $headers_passthrough[] = 'Referer';
            $headers_passthrough[] = 'X-Forwarded-For';
            $headers_passthrough[] = 'Client-IP';
            if ($addCookies)
            {
                $headers_passthrough[] = 'Cookie';
            }

            foreach ($headers_passthrough as $h)
            {
                if (!isset($all_headers[$h]))
                {
                    continue;
                }
                $v = @$all_headers[$h];
                if (! $v)
                {
                    continue;
                }

                if ($addCookies)
                {
                    if ('Cookie' == $h)
                    {
                        $v = preg_replace('/\\s*EC=\\S+(;\\s|$)/', '$1', $v);
                        $v = preg_replace('/\\s*S=\\S+(;\\s|$)/', '$1', $v);
                    }
                }

                $headers_ws[] = $h . ": " . $v;
            }

            $headers_ws[] = "RemoteIP: " . getenv('REMOTE_ADDR');

            if (is_array($moreHeaders))
            {

                $header_titles = array_keys($moreHeaders);
                foreach ($header_titles as $thisHeader)
                {
                    $headers_ws[] = "{$thisHeader}: " . $moreHeaders[$thisHeader];
                }
            }

            curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers_ws);
        }
    }


    static public function getCurlPostOutput($url, $postFields, $cookies = FALSE, $moreHeaders = "", $timeout = "")
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($timeout == "")
        {
            $timeout = CURL_TIMEOUT;
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        // Adding Headers and Cookies
        self::_addRestHeadersToCurl($ch, $cookies, $moreHeaders);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

        $output = curl_exec($ch);

        /*
         * TODO:: if (curl_errno($ch)) { error_log("ERROR in curl_fetch
         *[$url]"); error_log("curl_fetch() error: ".curl_error($ch)); return
         * FALSE; } else return $result;
         */

        curl_close($ch);

        if (DEBUG_PRINT_CURL_OUTPUT)
        {
            $print_postfields = print_r($postFields, TRUE);

            error_log("CURL URL -> " . $url);
            error_log("CURL POST FIELDS ->" . $print_postfields);
            error_log("CURL OUTPUT ->" . $output);
        }

        return $output;
    }


    static function isEmailValid($email_address)
    {
        return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email_address);
    }


    static function _REQUEST($fieldname, $default_value = "", $allowed_tags = "<br><b><i><strong><u><ul><ol><li><dl><dt><dd><p><h1><h2><h3><h4><h5><h6><pre>")
    {
        if (array_key_exists($fieldname, $_REQUEST))
        {
            $raw_data = $_REQUEST[$fieldname];

            if (is_array($raw_data))
            {
                $data = $raw_data;
            }
            else
            {
                if ($allowed_tags == "all")
                {
                    $data = rtrim(ltrim($raw_data));
                }
                else
                {
                    $raw_data = strip_tags($raw_data, $allowed_tags);
                    $data = rtrim(ltrim($raw_data));
                }
            }
        }
        else
        {
            $data = $default_value;
        }

        return $data;
    }


    static public function checkExistenceAndGetDataFromArray($key, $array, $default_value = "")
    {
        if (array_key_exists($key, $array))
        {
            return $array[$key];
        }
        else
        {
            return $default_value;
        }
    }


    static public function crypt_password($password)
    {
        $CI = get_instance();
        $user_password_salt = $CI->config->item('user_password_salt');
        $crypted_password = md5($password . $user_password_salt);
        return $crypted_password;
    }

    /**
    * secure_crypt_password - use crypto for password, not
    * md5
    * @author ernst
    * @param password - cleart-text password
    * @param salt - password salt
    * @return string containing encrypted password
    */
    static public function secure_crypt_password($password, $salt)
    {
		/*
		$options =[
            'salt' => hex2bin($salt),
        ];*/
        $options =array();
        $options['salt'] = hex2bin($salt);
      
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, $options);
        return $passwordHash;
    }

    /**
    * get_salt - create crypto salt
    *
    * @author ernst
    * @return string containing salt
    */
    static public function get_salt()
    {
        $salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
        return bin2hex($salt);
    }



    static public function addToArrayIfNotBlank($keyname, $key_value, &$array_to_add_to)
    {
        if ($key_value != "")
        {
            $array_to_add_to[$keyname] = $key_value;
        }
    }


    static public function redirect($url)
    {
        // echo $url;
        header("Location: $url");
    }


    static function is_utf8($string)
    {
        // From http://w3.org/International/questions/qa-forms-utf-8.html
        // http://www.faqs.org/rfcs/rfc3629.html specifies 0x00-0x7F as UTF-8
        return preg_match('%^(?:
           [\x00-\x7F]                        # ASCII
            |[\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
            |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
            |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
            |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
            |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
            |[\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
            |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
       )*$%xs', $string);
    } // function is_utf8
    static public function isValidXML($xml)
    {
        try
        {
            $check = @new SimpleXMLElement($xml);
            return TRUE;
        }
        catch(Exception $e)
        {
            return FALSE;
        }
    }


    static function findTimeDifferenceMinutes($start_date,$start_time,$end_date,$end_time)
    {
        $start_date_ts = strtotime($start_date." ".$start_time);
        $end_date_ts = strtotime($end_date." ".$end_time);

        $time_diff_mins =($end_date_ts - $start_date_ts)/60;

        return $time_diff_mins;
    }

    // This method takes in a start_date, start_time and timezone
    // Changes the it to a UTC timestamp and finds the time left from now to get to that time in it's timezone
    static function getTimePeriodLeftForEvent($start_date,$start_time,$timezone,$return_mins=TRUE)
    {

        // Setting Timezone to Passed Timezone
        date_default_timezone_set($timezone);
        $datetime = new DateTime($start_date." ".$start_time);
        $datetime_in_timezone = new DateTime($start_date." ".$start_time);

        // Finding the passed date in UTC TIME
        $ts_utc = $datetime->getTimestamp();

        // NOW in Universal time
        $now = time();
        $td = $ts_utc - $now;

        $time_diff_seconds = $td;

        date_default_timezone_set("GMT");

        if ($return_mins)
        {
            return $time_diff_seconds/60;
        }
        else
        {
            return $time_diff_seconds;
        }
    }



    static public function getGermanDayName($english_day_name)
    {
        $english_day_name = strtolower($english_day_name);

        switch($english_day_name)
        {
            case 'monday' :
                $german_day_name = "montag";
                break;

            case 'tuesday' :
                $german_day_name = "dienstag";
                break;

            case 'wednesday' :
                $german_day_name = "mittwoch";
                break;

            case 'thursday' :
                $german_day_name = "donnerstag";
                break;

            case 'friday' :
                $german_day_name = "freitag";
                break;

            case 'saturday' :
                $german_day_name = "samstag";
                break;

            case 'sunday' :
                $german_day_name = "sonntag";
                break;

            default :
                $german_day_name = "";
                break;
        }

        return ucfirst($german_day_name);
    }


    static public function getGermanDate($date,$format=DEFAULT_DATE_FORMAT)
    {
        $newLocale = setlocale(LC_TIME, 'de_DE', 'de_DE.UTF-8');
        $formatted_date = date($format,strtotime($date));
        return $formatted_date;
    }

    static public function getFormattedCurrency($amount,$locale_language="de")
    {
        if ($locale_language == API_LOCALE_GERMAN)
        {
            $dec_separator = ",";
            $thousands_separator = " ";
        }
        else
        {
            $dec_separator = ".";
            $thousands_separator = ",";
        }


        $formatted_currency = number_format(floatval($amount), 2, $dec_separator, $thousands_separator);

        return $formatted_currency;

    }

    static public function getGermanMonthName($english_month_name)
    {
        $english_month_name = strtolower($english_month_name);

        switch($english_month_name)
        {
            case 'january' :
                $german_month_name = "januar";
                break;

            case 'february' :
                $german_month_name = "februar";
                break;

            case 'march' :
                $german_month_name = "märz";
                break;

            case 'april' :
                $german_month_name = "april";
                break;

            case 'may' :
                $german_month_name = "mai";
                break;

            case 'june' :
                $german_month_name = "juni";
                break;

            case 'july' :
                $german_month_name = "juli";
                break;

                case 'august' :
                    $german_month_name = "august";
                    break;

                case 'september' :
                    $german_month_name = "september";
                    break;

                case 'october' :
                    $german_month_name = "oktober";
                    break;

                case 'november' :
                    $german_month_name = "november";
                    break;

                case 'december' :
                    $german_month_name = "dezember";
                    break;



            default :
                $german_month_name = "";
                break;
        }

        return ucfirst($german_month_name);
    }

    static public function getDateTimeConcatStringForS3()
    {
        return gmdate("Ymd/H/i");
    }


    static public function getDateTime()
    {
        return gmdate("Y-m-d H:i:s");
    }


    static public function getGMTUnixTimeStamp()
    {
        return time();
    }


    static public function getTimeStamp()
    {
        // return time();
        return gmdate("Y-m-d H:i:s");
    }


    static public function getTimeFromNowDaysAgo($days_ago = 14, $date_format = "Y-m-d")
    {
        $date = gmdate($date_format);
        $week_ago_time = strtotime(("-{$days_ago} Day " . $date));
        $new_date = date($date_format, $week_ago_time);

        return $new_date;
    }


    static public function getTimeFromNowInFuture($days_in_future = 30, $date_format = "Y-m-d")
    {
        $date = gmdate($date_format);
        $week_future_time = strtotime(("+ {$days_in_future} Day " . $date));
        $new_date = date($date_format, $week_future_time);

        return $new_date;
    }


    static public function getClientIpAddress()
    {
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
            if (strpos($ip, ',') !== FALSE)
            {
                $ip = substr($ip, 0, strpos($ip, ','));
            }
            return $ip;
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
            if (strpos($ip, ',') !== FALSE)
            {
                $ip = substr($ip, 0, strpos($ip, ','));
            }
            return $ip;
        }
    }


    static public function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }


    static public function changeGMTToLocalTime($gmtDateTime)
    {
        $utctime = self::getUnixTimeStampFromGMTTime($gmtDateTime);
        $local_time = strftime("%Y-%m-%d %H:%M:%S", $utctime);
        return $local_time;
    }


    static public function getUnixTimeStampFromGMTTime($gmtDateTime)
    {
        list($date, $time) = explode(" ", $gmtDateTime);
        list($year, $month, $day) = explode("-", $date);
        list($hour, $minute, $seconds) = explode(":", $time);
        $utctime = gmmktime($hour, $minute, $seconds, $month, $day, $year);

        return $utctime;
    }


    public static function outputGenericXMLHeaders()
    {
        header("Content-type: text/xml; charset=UTF-8");
        header("Cache-Control: max-age=0");
    }


    /**
     * validateDate() takes a string with "yyyy-mm-dd" format and checks
     * if its a valid date.
     * <p>
     *
     * @param string $date
     *            "yyyy-mm-dd" string
     * @return boolean TRUE if its a valid date, otherwise FALSE
     */
    public static function isDateFormatValid($date)
    {
        $tokens = explode("-", $date);
        if (count($tokens) == 3 && checkdate($tokens[1], $tokens[2], $tokens[0]))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }


    /**
     * validateTime() takes a string with "hh:mm:ss" format where hh is[0-23]
     * and checks if its a valid time.
     * <p>
     *
     * @param string $time
     *            "hh:mm:ss" string
     * @return boolean TRUE if its a valid date, otherwise FALSE
     */
    public static function isTimeFormatValid($time)
    {
        $return = TRUE;
        $tokens = explode(":", $time);

        if (count($tokens) != 3)
        {
            $return = FALSE;
        }
        else
        {
            $hh = $tokens[0];
            if ($hh < 0 || $hh > 23)
            {
                $return = FALSE;
            }

            $mm = $tokens[1];
            if ($mm < 0 || $mm > 59)
            {
                $return = FALSE;
            }

            $ss = $tokens[2];
            if ($ss < 0 || $ss > 59)
            {
                $return = FALSE;
            }
        }

        return $return;
    }


    public static function normalize_string($tag)
    {
        // anything that's not word or digits, replace with nothing and
        // lowercase
        return strtolower(preg_replace('/[^\w\d]+/', '', $tag));
    }


    public static function stripInvalidASCIICharacters($str)
    {
        $cacheId = "invalidasciicharsarray";
        $cachedData = apc_fetch($cacheId);
        if (! $cachedData)
        {
            $arrayToReplace = array();
            for ($a = 0; $a <= 31; $a ++)
            {
                $arrayToReplace[] = chr($a);
            }

            $status = apc_store($cacheId, $arrayToReplace);
        }
        else
        {
            $arrayToReplace = $cachedData;
        }

        $cleanString = str_replace($arrayToReplace, '', $str);
        return $cleanString;
    }


    public static function getOptionalItemFromRequest($fieldname, $default_value = "")
    {
        if (array_key_exists($fieldname, $_REQUEST))
        {
            $data = $_REQUEST[$fieldname];
        }
        else
        {
            $data = $default_value;
        }

        return $data;
    }


    static public function getDataFromArray($key, $array, $default_value = "")
    {
        if (array_key_exists($key, $array))
        {
            return $array[$key];
        }
        else
        {
            return $default_value;
        }
    }


    static public function appendPrefixToCSV($prefix, $csv_str)
    {
        $tokens = explode(",", $csv_str);
        $new_token_array = array();

        foreach ($tokens as $token)
        {
            $new_token_array[] = $prefix . $token;
        }

        return implode(",", $new_token_array);
    }


    public static function getCurrentGetString($exclude_params = array(), $external_params_array = array())
    {
        $request_uri = $_SERVER["REQUEST_URI"];
        $get_string = parse_url($request_uri, PHP_URL_QUERY);
        parse_str($get_string, $get_string_array);

        for ($a = 0; $a < count($exclude_params); $a ++)
        {
            unset($get_string_array[$exclude_params[$a]]);
        }

        $new_get_string = http_build_query($get_string_array);

        if ($new_get_string == "")
        {
            $new_get_string = "1=1";
        }

        if (count($external_params_array) > 0)
        {
            foreach ($external_params_array as $key => $value)
            {
                $new_get_string .= "&" . $key . "=" . urlencode($value);
            }
        }

        return $new_get_string;
    }


    public static function convertCurrentGetStringIntoPost($exclude_params = array())
    {
        $request_uri = $_SERVER["REQUEST_URI"];
        $get_string = parse_url($request_uri, PHP_URL_QUERY);
        parse_str($get_string, $get_string_array);

        for ($a = 0; $a < count($exclude_params); $a ++)
        {
            unset($get_string_array[$exclude_params[$a]]);
        }

        $html = "";

        foreach ($get_string_array as $k => $v)
        {
            $html .= "<input type=\"hidden\" name=\"{$k}\" value=\"{$v}\">\n";
        }

        return $html;
    }


    function fixGmail($emailaddy)
    {
        if (eregi('@gmail.com', $emailaddy))
        {
            // $emailaddy is an '@gmail.com'-address
            // make lowercase, strip out periods(but fix gmailcom)
            $emailaddy = str_replace("@gmailcom", "@gmail.com", str_replace(".", "", strtolower($emailaddy)));

            // a plus sign is found in $emailaddy
            if (eregi('\+', $emailaddy))
            {
                // grab the substring from the start up to the first plus sign
                // and add @gmail.com
                $emailaddy = substr($emailaddy, 0, strpos($emailaddy, "+")) . "@gmail.com";
            }
        }
        return $emailaddy;
    }


    public function string_replace_template($replace_array, $string)
    {
        foreach ($replace_array as $ori => $replace)
        {

            $string = str_replace($ori, $replace, $string);
        }

        return $string;
    }


    public static function timeAgo($time)
    {
        $delta = time() - $time;
        if ($delta < 60)
        {
            return 'less than a minute ago.';
        }
        else if ($delta < 120)
        {
            return 'about a minute ago.';
        }
        else if ($delta <(45 * 60))
        {
            return floor($delta / 60) . ' minutes ago.';
        }
        else if ($delta <(90 * 60))
        {
            return 'about an hour ago.';
        }
        else if ($delta <(24 * 60 * 60))
        {
            return 'about ' . floor($delta / 3600) . ' hours ago.';
        }
        else if ($delta <(48 * 60 * 60))
        {
            return '1 day ago.';
        }
        else
        {
            return floor($delta / 86400) . ' days ago.';
        }
    }


}

/* End of file Someclass.php */
