<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 17.09.14
 * Time: 15:28
 */


/**
 * Get HTML
 *
 * Encodes string to UTF-8 HTML and converts special chars to numeric entities.
 *
 * @param $string string The String to be encoded
 * @return mixed|string The encoded string
 */
function gh($string) {

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
function ph($string) {
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
function ghbr($string) {
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
 * @param $string string The HTML encoded string with <br> styled newlines
 */
function phbr($string) {
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
function gu($string) {
	return urldecode($string);
}

/**
 * Print URL
 *
 * Prints URL encoded string
 *
 * @param $string string The URL encoded string to be printed
 */
function pu($string) {
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
function ga($string) {
	return htmlspecialchars($string);
}

/**
 * Print Attribute
 *
 * Prints the encoded attribute string
 *
 * @param $string string The encoded attribute string to be printed
 */
function pa($string) {
	echo ga($string);
}

/**
 * Get Attribute Value
 */

function av(&$arr, $arr_keys, $default = '') {
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
function interpolate($message, array $context = array()) {
	$replace = array();
	foreach($context as $key => $value){
		$replace['{'.$key.'}'] = $value;
	}
	return strtr($message,$replace);
}
function quote($message = '', $delimiter = '\''){
	return $delimiter.$message.$delimiter;
}
/**
 * Embraces a string with brackets
 * @param string $string The String to be embraced;
 * @value 'round', 'square', 'curly', 'angle'
 * @param string $brackets The type of brackets possible values are: round, square, curly, angle
 * @return string
 */
function bracket($string = '', $brackets = "round"){
	$bracketList = array(
		'round'  => array ('(',')'),
		'square' => array ('[',']'),
		'curly'  => array ('{','}'),
		'angle'  => array ('<','>')
	);
	return $bracketList[$brackets][0] . $string . $bracketList[$brackets][1];
}
function generateRandomString($length = 10){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}
function debug_log($message = ''){
	file_put_contents('log.txt',$message,FILE_APPEND);
}


