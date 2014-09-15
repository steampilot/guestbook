<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:39
 */

namespace Steampilot\Util;
use Steampilot\Util\Debug;

Debug::dump(__VIEW__);
class Template {
	protected $htmlHeader;
	protected $htmlFooter;
    protected $viewFile = array();
	protected $viewVars;

	public function __construct(){
		$this->htmlHeader = __VIEW__.'head.html.php';
		$this->htmlFooter = __VIEW__.'footer.html.php';
	}
	public function setViewVars($key, $value){
		$this->viewVars[$key] = $value;
	}
	public function render(){
		if (!empty($this->viewVars)) {
			extract($this->viewVars, EXTR_REFS);
		}
		Debug::dump($this->viewVars);
		include $this->htmlHeader;
		foreach ($this->viewFile as $fileName) {
			if(!empty($fileName)) {
				include $fileName;
			}
		}
		include $this->htmlFooter;
	}
    public function addViewFile($view,$viewFile){
        $this->viewFile[$view] = $viewFile;
    }
}