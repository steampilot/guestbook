<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 24.09.14
 * Time: 16:42
 */


namespace Steampilot\Util;

/**
 * Class ErrorWidget
 *
 * @package ViewElement
 */
class ErrorWidget {
	protected $title;
	protected $text;
	/**
	 * Creates an error panel
	 * @param string $title The title of the error message
	 * @param string $text The text of the error message
	 */
	public function __construct($title = 'ERROR',
	$text = 'Brace your selves. The end is near!') {
		$this->title = $title;
		$this->text = $text;
		echo $this->render();
	}
	public function render(){
		$html = ('
		');
		$return = sprintf($html,$this->title,$this->text);
		return $return;
	}
} 