<?php

	Final Class Util{
		
		private function __construct(){
			## Can never be instanciated
		}
		
		public static function process_argc_array($argv){

			$params = array();
			$last_flag = NULL;

			for($ii = 0; $ii < count($argv); $ii++){

				## Have we found a new param?
				if(preg_match('@^--@i', $argv[$ii])){
					$last_flag = trim($argv[$ii], '-');
					$params[$last_flag] = NULL;
				}

				## It must belong to the last flag
				elseif($last_flag) $params[$last_flag] = $argv[$ii];

			}

			return $params;
		}
		
	}


