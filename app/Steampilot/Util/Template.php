<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:39
 */

namespace Steampilot\Util;
use Steampilot\Util\Debug;


class Template {
    protected $viewFile = array();
	protected $viewVars;
	public function set($key, $value){
		$this->viewVars[$key] = $value;
	}
	public function render(){
		if (!empty($this->viewVars)) {
			extract($this->viewVars, EXTR_REFS);
		}
		Debug::dump($this->viewVars, 'View variables Should be like this');
		foreach ($this->viewFile as $fileName) {
            include $fileName;
        }
	}
    public function init(){
        $this->viewFile['head'] = __DIR__ .'/../../View/head.html.php';
        $this->viewFile['nav'] = __DIR__.'/../../View/nav.html.php';
        $this->viewFile['top'] = __DIR__.'/../../View/top.html.php';
        $this->viewFile['content'] = '';
        $this->viewFile['footer'] = __DIR__. '/../../View/footer.html.php';
    }
    public function setContent($viewFile){
        $this->viewFile['content'] = $viewFile;
    }
    public function setNav($viewFile) {
        $this->viewFile['nav'] = $viewFile;
    }
    public function setTop($viewFile) {
        $this->viewFile['top'] = $viewFile;
    }
}