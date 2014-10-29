<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 17.09.14
 * Time: 15:28
 *
 * This file contains useful tools that will be used in many other applications as well.
 * Mainly it is designed for string manipulation and convenience
 */




/**
 * Get HTML
 *
 * Encodes string to UTF-8 HTML and converts special chars to numeric entities.
 *
 * @param $string string The String to be encoded
 * @return mixed|string The encoded string
 */
function gh($string)
{

	//skip empty string
	if ($string === null || $string === '') {
		$string = '';
	} else {

		//convert to utf-8
		if (!mb_check_encoding($string, 'UTF-8')) {
			$string = mb_convert_encoding($string, 'UTF-8');
		}

		// convert special chars to numeric entity
		$string = preg_replace_callback('/[^a-z0-9A-Z ]/u', function ($match) {
			return mb_encode_numericentity($match[0], array(0x0, 0xffff, 0, 0xffff), 'UTF-8');
		}, $string);

	}
	return $string;
}

/**
 * Print HTML
 *
 * Prints HTML encoded string
 *
 * @param $string string The HTML encoded string to be printed
 */
function ph($string)
{
	echo gh($string);
}

/**
 * Get HTML with NEWLINE
 *
 * Gets HTML encoded string where new lines are converted to HTML <br> tags.
 *
 * @param $string string The string to be converted and encoded
 * @return string string The encoded and converted string
 */
function ghbr($string)
{
	// skip empty string
	if ($string === null || $string === '') {
		$string = '';
	} else {
		//convert new lines
		$arr = explode('\n', $string);
		if (!empty($arr) && is_array($arr)) {
			foreach ($arr as $str_key => $str_row) {
				$arr[$str_key] = gh($str_row);
			}
			$string = implode('<br>', $arr);
		}
	}
	return $string;
}

/**
 * Print HTML
 *
 * Prints a HTML encoded string with new lines replaced by <pr>
 *
 * @param $string string The HTML encoded string with <br> styled newlines
 */
function phbr($string)
{
	echo ghbr($string);
}

/**
 * Get HTML
 *
 * Gets the encoded URL string
 *
 * @param $string string The URL string to be encoded
 * @return string string The encoded URL string
 */
function gu($string)
{
	return urldecode($string);
}

/**
 * Print URL
 *
 * Prints URL encoded string
 *
 * @param $string string The URL encoded string to be printed
 */
function pu($string)
{
	echo gu($string);
}

/**
 * Get Attribute
 *
 * Gets the encoded HTML attribute
 *
 * @param $string string The attribute string to be encoded
 * @return string string The encoded attribute string
 */
function ga($string)
{
	return htmlspecialchars($string);
}

/**
 * Print Attribute
 *
 * Prints the encoded attribute string
 *
 * @param $string string The encoded attribute string to be printed
 */
function pa($string)
{
	echo ga($string);
}

/**
 * Get Attribute Value
 */

function av(&$arr, $arr_keys, $default = '')
{
	$return = $default;
	if (!empty($arr)) {
		foreach ($arr_keys as $index) {
			if (isset($arr[$index])) {
				array_shift($arr_keys);
				if (empty($arr_keys)) {
					$return = $arr[$index];
				} else {
					$return = av($arr[$index], $arr_keys, $default);
				}
			}
		}
	}
	return $return;
}

/**
 * Interpolate a string
 * @param $message string The string where the placeholder have to be filled
 * @param array $context The context to fill the placeholders
 * @return string $The new string with swapped placeholders
 */
function interpolate( $message, array $context = array())
{
	$replace = array();
	foreach ($context as $key => $value) {
		$replace['{' . $key . '}'] = $value;
	}
	// swap the placeholders with the string from the context
	return strtr($message, $replace);
}

/**
 * Quote a string
 *
 * @param string $message The string to be quoted
 * @param string $delimiter The quoting character to use. Defaults to a single '
 * @return string The Quoted string
 */
function quote($message = '', $delimiter = '\'')
{
	return $delimiter . $message . $delimiter;
}

/**
 * Embraces a string with brackets
 *
 * @param string $string The String to be embraced;
 * @value 'round', 'square', 'curly', 'angle'
 * @param string $brackets The type of brackets possible values are: round, square, curly, angle
 * @return string
 */
function bracket($string = '', $brackets = "round")
{
	$bracketList = array(
		'round' => array('(', ')'),
		'square' => array('[', ']'),
		'curly' => array('{', '}'),
		'angle' => array('<', '>')
	);
	return $bracketList[$brackets][0] . $string . $bracketList[$brackets][1];
}

/**
 * Generates a random string
 *
 * @param int $length The length of the generated string
 * @return string The generated string
 */
function generateRandomString($length = 10)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

function now(){
	return date('Y-m-d h:m:s');
}
/**
 * Writes a log message into the log.txt file
 *
 * @param string $message The message to be logged
 */
function debug_log($message = '')
{

	file_put_contents('log.txt', now().': '.$message.'\n', FILE_APPEND);
}

function create_password_hash($strPassword, $numAlgo = 1, $arrOptions = array())
{
	if (function_exists('password_hash')) {
		// php >= 5.5
		$hash = password_hash($strPassword, $numAlgo, $arrOptions);
	} else {
		$salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
		$salt = base64_encode($salt);
		$salt = str_replace('+', '.', $salt);
		$hash = crypt($strPassword, '$2y$10$' . $salt . '$');
	}
	return $hash;
}

function verify_password_hash($strPassword, $strHash)
{
	if (function_exists('password_verify')) {
		// php >= 5.5
		$boolReturn = password_verify($strPassword, $strHash);
	} else {
		$strHash2 = crypt($strPassword, $strHash);
		$boolReturn = $strHash == $strHash2;
	}
	return $boolReturn;
}


