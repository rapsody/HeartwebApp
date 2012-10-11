<?php
// Database login settings.
/**#@+
* @access public
* @var constant
*/
/*Please group each modules constants together in that module section*/
//if($_GET['debug'] ==1) error_reporting(E_ALL);
//else 

function json_decode($json){
        $comment = false;
        $out = '$x=';
        for ($i=0; $i<strlen($json); $i++)
        {
            if (!$comment)
            {
                if (($json[$i] == '{') || ($json[$i] == '['))
                    $out .= ' array(';
                else if (($json[$i] == '}') || ($json[$i] == ']'))
                    $out .= ')';
                else if ($json[$i] == ':')
                    $out .= '=>';
                else
                    $out .= $json[$i];
            }
            else
                $out .= $json[$i];
            if ($json[$i] == '"' && $json[($i-1)]!="\\")
                $comment = !$comment;
        }
        eval($out . ';');
        return $x;
   
}


    function json_encode($a=false)
    {
        // Some basic debugging to ensure we have something returned
        if (is_null($a)) return 'null';
        if ($a === false) return 'false';
        if ($a === true) return 'true';
        if (is_scalar($a))
        {
            if (is_float($a))
            {
                // Always use '.' for floats.
                return floatval(str_replace(',', '.', strval($a)));
            }
            if (is_string($a))
            {
                static $jsonReplaces = array(array('\\', '/', "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
                return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
            }
            else
                return $a;
        }
        $isList = true;
        for ($i = 0, reset($a); true; $i++) {
            if (key($a) !== $i)
            {
                $isList = false;
                break;
            }
        }
        $result = array();
        if ($isList)
        {
            foreach ($a as $v) $result[] = json_encode($v);
            return '[' . join(',', $result) . ']';
        }
        else
        {
            foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
            return '{' . join(',', $result) . '}';
        }
    }


error_reporting(E_ALL);

date_default_timezone_set('Australia/Sydney');

/*Loacl database constants*/
define('DB_HOST',"localhost");
define('DB_USERNAME',"root");
define('DB_PASSWORD',"heartweb_3");
define('DB_DATABASE',"heartweb");//information_schema


/*Loacl database constants*/
define('DB_USER_HOST',"50.56.212.172");
define('DB_USER_USERNAME',"heartweb3");
define('DB_USER_PASSWORD',"heartwebX123");
define('DB_USER_DATABASE',"heartweb");//information_schema


/*Users levels constants*/
define('ADMIN_LEVEL', 'A');/*It's abbreviation is "A"*/
define('USER_LEVEL', 'U');/*It's abbreviation is "U"*/

/*Site email related constants*/
define('ADMIN_EMAIL',"admin@heartweb.net");

/*Site related constants*/
define('SITE_NAME',"Heartweb");

define('SITE_URL',"http://108.171.185.56/");

define('FORM_MEDIA_URL', SITE_URL . "uploads/formdata/");

define('SITE_ORG_PHONE',"");
define('SITE_ORG_FAX',"");


/*Copyright */
define('COPY_RIGHT',"Copyright 2009-".date("Y").", always. All rights reserved.");

/*Base path of the directory*/
define('BASE_PATH', str_replace('\\','/',dirname(__FILE__) ));

/*SMTP realted constants*/
define('SMTP_HOST', 'pod51003.outlook.com');
define('SMTP_USER', 'iHeartScan@Heartweb.com');
define('SMTP_PASSWORD', 'Cardigan123');
define('SMTP_AUTH', true);
define('SMTP_PORT', '587');
define('SITE_NAME_FOR_EMAIL','http:\//*****.net');

/*directory seprator*/
define('DS', "/");

/*Base path of the directory*/
//define('ROOT_DIR', "PATH_TO_THE_APPLICATION");
define('ROOT_DIR', realpath(dirname(__FILE__) . '/../') . DIRECTORY_SEPARATOR);

define('INAPP_HIT_URL', 'https://sandbox.itunes.apple.com/verifyReceipt');

define('INAPP_PASSWORD', '0e23aad0893b4f1496453cf9d95adfaa');

define('PDF_PATH', ROOT_DIR."/pdf/");

/*Relative directory path for smarty files*/
define('SMARTY_DIR',ROOT_DIR."/plugins/Smarty".DS);

/*Relative directory path for php files*/
define('PHP_DIR',ROOT_DIR."/modules/".dirname(__FILE__).DS);

define ('MODEL_DIR', ROOT_DIR . "models" . DS);

/*Relative directory path for includes files*/
define('INCLUDES_DIR',ROOT_DIR."includes".DS);

/*Relative directory path for images*/
define('IMAGES_DIR',ROOT_DIR."/web/images".DS);

/*Relative directory path for javascript*/
define('JS_DIR',ROOT_DIR."/web/js".DS);

/*Relative directory path for css*/
define('CSS_DIR',ROOT_DIR."/web/css".DS);

/*Relative directory path for fonts files*/
define('FONT_DIR',ROOT_DIR."fonts".DS);


define('FORM_MEDIA_PATH',ROOT_DIR."/uploads/formdata".DS);

/*Relative directory path for xml files*/
define('XML_DIR', ROOT_DIR."xml_files".DS);

/*Relative directory path for uploaded general images */
define('UPLOADED_IMAGES_DIR',ROOT_DIR."/data/uploads".DS);

/* Custom error page */
define('ERROR_NOT_FOUND',PHP_DIR."404_error.php");


/* max file upload constants*/
define('MAX_FILE_UPLOAD',"4");

/*Constants for the tables used in the website */
define('TBL_GROUPS', "groups");
define('TBL_USERS', "users");	
define('TBL_COUNTRIES_LIST', "countries_list");   
define('TBL_FORM_USER_DATA', "form_user_data");
define('TBL_LOGIN_KEYS','login_keys');


