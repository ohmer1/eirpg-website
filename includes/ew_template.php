<?php
/**
 * @category EW
 * @package Ew_Template
 * @copyright Copyright (c) 2008, Bellière Ludovic
 * @license http://opensource.org/licenses/mit-license.php MIT license
 */


class Ew_Template {
    /**
     *
     * @var array
     */
    protected $_files = array();

    /**
     *
     * @var string
     */
    protected $_templatePath;

    public function __construct($template_path='./templates') {
        $this->_templatePath = $template_path;
    }

    public function getTemplatePath() {
        return $this->_templatePath;
    }

    public function addFile($tag,$name) {
        $this->files[$tag] = $name;
    }

    public function render($tag) {
        if (!is_array($tag)) {
            ob_start();
            if (isset($this->_files['begin'])) && is_readable($this->_templatePath.$this->_files['begin'])) {
                include ($this->_templatePath.$this->_files['begin']);
            }
            include $this->_file($tag);
            if (isset($this->_files['end'])) && is_readable($this->_templatePath.$this->_files['end'])) {
                include ($this->_templatePath.$this->_files['end']);
            }
            return ob_end_clean();
        } else {
            ob_start();
            if (isset($this->_files['begin'])) && is_readable($this->_templatePath.$this->_files['begin'])) {
                include ($this->_templatePath.$this->_files['begin']);
            }
            $tags = $tag;
            foreach ($tags => $tag) {
                include $this->_file($tag);
            }
            if (isset($this->_files['end'])) && is_readable($this->_templatePath.$this->_files['end'])) {
                include ($this->_templatePath.$this->_files['end']);
            }
    }

    private function _file($tag) {
        if (is_readable($this->_templatePath.$this->_files[$tag])) {
            return $this->_templatePath.$this->_files[$tag];
        }
    }
}
