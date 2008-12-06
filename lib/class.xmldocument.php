<?php
 
	Class XMLDocument extends DOMDocument{
		
		private $_errorLog;
		
		public function __construct($version='1.0', $encoding='utf-8'){
			parent::__construct($version, $encoding);
			$this->preserveWhitespace = false;
			$this->formatOutput = false;
			$this->_errorLog = array();
		}
  
		public function xpath($query){    
			$xpath = new DOMXPath($this);
			return $xpath->query($query);
		}
		
		public function flushLog(){
			$this->_errorLog = array();
		}
		
		public function loadXML($xml){
			
			$this->flushLog();
			
			$html_errors = ini_set('html_errors', false);
			set_error_handler(array(&$this, '__errorHandler'));
 
			if(!$result = parent::loadXML($xml)) throw new Exception('Loading XML failed');
			
			ini_set('html_errors', $html_errors);
			restore_error_handler();
			
			return $result;
		}
		
		static public function setAttributeArray(DOMElement $obj, array $attr){
 
			if(empty($attr)) return;
 
			foreach($attr as $key => $val)
			  $obj->setAttribute($key, $val);
 
		}
		
		public function __errorHandler($errno, $errstr, $errfile, $errline){
			$this->_errorLog[] = array(
			               'number' => $errno, 
			               'message' => str_replace('DOMDocument::', NULL, $errstr), 
			               'file' => $errfile, 
			               'line' => $errline);      
		}
		
		public function hasErrors(){
			return (is_array($this->_errorLog) && !empty($this->_errorLog));
		}
  
		public function getErrors(){
			return $this->_errorLog;
		}
			
	}
	