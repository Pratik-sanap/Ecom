<?php
//output buffing
ob_start();
//session starting
session_start();


// define replacement callback (safe: only if not already defined)
if (!function_exists('replace_currency')) {
    /**
     * Replace Yen symbols/entities with the Indian Rupee symbol in final output.
     * Runs on the output buffer so templates and data don't need editing.
     */
    function replace_currency($buffer) {
        $search = [
            '¥',        // literal Yen sign
            '&yen;',    // HTML entity (named)
            '&#165;',   // decimal numeric entity for ¥
            '&#x00A5;'  // hex numeric entity for ¥
        ];
        $replace = [
            '₹',        // literal Rupee sign
            '&#8377;',  // HTML numeric entity for ₹
            '&#8377;',
            '&#8377;'
        ];
        return str_replace($search, $replace, $buffer);
    }
}

// start output buffering with the replacement callback
ob_start('replace_currency');



//************************************************************************
//(i)session ending "by the way there are predefined in the system" 
//(ii)usually used for debugging  purposes
//NOTE:BE CAREFUL WITH THIS FUNCTION
//session_destroy();
//************************************************************************



//########################################################
//files information
defined("DS")?null:define("DS",DIRECTORY_SEPARATOR);
defined('TEMPLATE_FRONT')?null:define('TEMPLATE_FRONT',__DIR__.DS.'ktemplates\frontend');
defined('TEMPLATE_BACK')?null:define('TEMPLATE_BACK',__DIR__.DS.'ktemplates\backend');
defined('UPLOAD_DIRECTORY')?null:define('UPLOAD_DIRECTORY',__DIR__.DS.'uploads');

//########################################################

//########################################################
//database information
defined("DB_HOST")?null:define("DB_HOST","localhost");
defined("DB_USER")?null:define("DB_USER","root");
defined("DB_PASS")?null:define("DB_PASS","");
defined("DB_NAME")?null:define("DB_NAME","ecom_db");
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
require_once("functions.php");
require_once("cart.php");
//########################################################

?>