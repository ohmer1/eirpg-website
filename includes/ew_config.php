<?php
/**
 * @category EW
 * @package Ew_Config
 * @copyright Copyright (c) 2008, Bellière Ludovic
 * @license http://opensource.org/licenses/mit-license.php MIT license
 */

/**
 * @author Bellière Ludovic
 * @category EW
 * @package Ew_Config
 * @copyright Copyright (c) 2008, Bellière Ludovic
 * @license http://opensource.org/licenses/mit-license.php MIT license
 */
class ew_config implements Countable, Iterator {
	/**
	 * Allow the modification in-memory
	 *
	 * @var boolean
	 */
	protected $_allow_modification;

	/**
	 * The array configuration data
	 *
	 * @var array
	 */
	protected $_data;

	/**
	 * Number of elements
	 *
	 * @var interger
	 */
	protected $_count;

	/**
	 * Iteration index
	 *
	 * @var integer
	 */
	protected $_index;
	
	function __construct($array,$allow_modification=false) {
		$this->_allow_modification = (boolean) $allow_modification;
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$this->_data[$key] = new ew_config($value, $this->_allow_modification);
			} else {
				$this->_data[$key] = $value;
			}
		}

		$this->_count = count($this->_data);
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
	
	/**
	 * Defined by Countable interface
	 *
	 * @return int
	 */
	public function count() {
		return $this->_count;
	}

	/**
	 * Defined by Iterator interface
	 *
	 * @return mixed
	 */
	public function current() {
		return current($this->_data);
	}

	/**
	 * Defined by Iterator interface
	 *
	 * @return mixed
	 */
	public function key() {
		return key($this->_data);
	}

	/**
	 * Defined by Iterator interface
	 *
	 */
	public function next() {
		next($this->_data);
		$this->_index++;
	}

	/**
	 * Defined by Iterator interface
	 *
	 */
	public function rewind() {
		reset($this->_data);
		$this->_index = 0;
	}

	/**
	 * Defined by Iterator interface
	 *
	 * @return boolean
	 */
	public function valid() {
		return $this->_index < $this->_count;
	}

	public function merge(ew_config $merge) {
		foreach ($merge as $key => $value) {
			if(array_key_exists($key, $this->_data)) {
				if ($value instanceof ew_config && $this->$key instanceof ew_config) {
					$this->$key = $this->$key->merge($value);
				} else {
					$this->$key = $value;
				}
			} else {
				$this->$key = $value;
			}
		}
		return $this;
	}
}

?>