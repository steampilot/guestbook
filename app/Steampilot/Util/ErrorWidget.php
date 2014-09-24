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
		<div class="container">
			<div class="panel panel-danger">
				<div class="panel-heading" >
					<div class="panel-title"><h3>%s</h3></div>
				</div>
				<div class="panel-body">
					<div class="alert alert-danger" role="alert"><p>%s</p></div>
				</div>
			</div>
		</div>
		');
		$return = sprintf($html,$this->title,$this->text);
		return $return;
	}
} 