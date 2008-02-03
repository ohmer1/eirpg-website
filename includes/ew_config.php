<?php

class ew_config extends Countable {
	protected $_allow_modification;
	protected $_data;
	protected $_count;
	
	function __construct($array,$allow_modification=null) {
		$this->_allow_modification = (boolean) $allow_modification;
		foreach ($source as $key => $value) {
			if (is_array($value)) {
				$this->_data[$key] = new ew_config($value);
			} else {
				$this->_data[$key] = $value;
			}
		}
	}
	
	function get($key,$default=false) {
		if (array_key_exists($key,$this->_data)) {
			return $this->_data[$key];
		}
		return $default;
	}
	
	public function __get($key) {
		return self::get($key);
	}
	
	public function __set($name,$value) {
		if ($this->_allow_modification) {
			if (is_array($value)) {
				$this->_data[$name] = new Zend_Config($value, true);
			} else {
				$this->_data[$name] = $value;
			}
			$this->_count = count($this->_data);
		} else {
			throw new Exception('Config is read only');
		}
	}
	
	protected function __isset($name) {
		return isset($this->_data[$name]);
	}
	
	public function count() {
		return $this->_count;
	}
}

?>