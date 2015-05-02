<?php
/**
 * Multi Threading 
 * @author Bijaya Kumar 
 * @email it.bijaya@gmail.com
 * @mobile +91 9911033016
 * @link http://www.digitalwebsolutions.in
**/
 
/* Tags name */
define ('THREAD_CALL_SIGNATURE_ID', 'ILOVEMYINDIA');
define('THREAD_TAG_BEG','[RESPONSE_'.md5(THREAD_CALL_SIGNATURE_ID).']');
define('THREAD_TAG_END','[/RESPONSE_'.md5(THREAD_CALL_SIGNATURE_ID).']');
/*
	class mThread
*/
class mThread  {
	
	//  thread responses
	static private $gThread_Responses = array();

	//  thread connections
	static private $gThread_Connections = array() ;
	
	/*
		funtion: thread_set_args
		@params: <mix> $val
		return: void
	*/
	public  static function set_args($val) { 
		$callback = array ( 'RETURN_ARGS' =>$val);
		echo (THREAD_TAG_BEG . serialize($callback) .THREAD_TAG_END );
		flush();
    	ob_flush();		
	}
	
	/*
		funtion: thread_invoke
		@params: none
		return: void
	*/
	public static function invoke() {
		$args =  func_get_args();
		if ( empty($args) )
			return ;
		
		$call_method =  array_shift($args);
		if ( !is_string( $call_method ) ) {
			return ;
		}
		$callback = array ( 'CALL_BACK' => $call_method, 'arags'=> $args);
		echo (THREAD_TAG_BEG . serialize($callback) .THREAD_TAG_END );
		flush();
        ob_flush();
		
	}


	/*
		funtion: __exec_thread_process
		@params: <array>  $buffers
		@params: <string> $skey
		return: void
	*/
	static private function __exec_thread_process (&$buffers, $skey ) {
		static $returns ;
		while ( true ) { 
			  //  
			  $tags_beg_pos = stripos ($buffers[$skey], THREAD_TAG_BEG ) ;
			  $tags_end_pos = stripos ($buffers[$skey], THREAD_TAG_END) ;
				  
			  // 
			  if (  FALSE === $tags_beg_pos  or FALSE === $tags_end_pos ) {
				  break;
			  }
			  
			  $response = array ();
			  $need_beg = $tags_beg_pos+ strlen(THREAD_TAG_BEG);
			  $need_end = $tags_end_pos;
			  
			  $response =  substr( $buffers[$skey],$need_beg, $need_end- $need_beg);
			  $buffers[$skey] =substr_replace ( $buffers[$skey], '*',$tags_beg_pos,  strlen(THREAD_TAG_BEG)+ strlen($response)+ strlen(THREAD_TAG_END)   ) ;
			  $response =  @unserialize($response);
			  
			  if ( !is_array($response) ) 
				  $response = array () ;
			  
			  
			  // 
			  if ( isset($response['error'])  ) {
				  $returns[$skey]['error'] = $response['error'];
				  return false;
			  }
			  
			  // print_r( $response);	  die;
			  
			  
			  
			  // 
			  if (  isset($response['CALL_BACK']) ) {
				  $cb = $response['CALL_BACK']  . '_onThreadCallback';
				  if ( is_callable( $cb)  ) {
					 call_user_func_array( $cb, isset($response['arags']) && is_array($response['arags'])  ? $response['arags']: array() );			
				
					 
				  }
			  }
			  
			  // update reference if any
			  if ( isset($response['RETURN_ARGS']) ) {
				 self::$gThread_Responses[$skey]  = $response['RETURN_ARGS']  ;
			  }
			  
		  }
		
		return true ;
						
	}
	
	/*
		funtion: thread_is_runing
		@params: <int> $tv_se [0]
		@params: <int> $tv_usec [100000]		
		return: <bool> 
	*/
	public static function runing($tv_sec=0, $tv_usec=100000) { 
		static $buffers = array();
		static $buffers_headers_passed = array();
		
		/* internal call for reset of threads & connections */
		if ( $tv_sec  === '!@$%^&*()_+INTERNAL_THREAD_RESET!@$%^&*()_+' ) {
			$buffers = array();
			$buffers_headers_passed = array();
			self::$gThread_Connections = array();
			self::$gThread_Responses = array ();
			return true;
		}
			
		if ( empty(self::$gThread_Connections) ) {
			return false;
		}
				
		foreach (self::$gThread_Connections as $skey=>$fp) {
			$streams = array($fp);
			$write_stream = null;$read_stream = null;
			if (false === ($num_changed_streams = stream_select($streams, $write_stream, $read_stream, $tv_sec, $tv_usec))) {
				unset(self::$gThread_Connections[$skey], $buffers_headers_passed[$skey] , $buffers[$skey] );
				return !empty(self::$gThread_Connections);					
		} else if ($num_changed_streams  ) {
			$buffer = '';
			while (!feof($fp)) {
				$buffer = fread($fp, 9216);
				if (strlen($buffer)==0){
					break;
				}
				if ( isset($buffers[$skey]) )
					$buffers[$skey].= $buffer;
				else
					$buffers[$skey] = $buffer;
			}	
			
			// skiped header
			if ( !isset( $buffers_headers_passed[$skey] ) &&   ( $headers_l = stripos( $buffers[$skey], "\r\n\r\n") ) !== FALSE ) {
				$buffers[$skey] = substr($buffers[$skey], $headers_l+4);
				$buffers_headers_passed[$skey] = true;
			}
				
			// check every time
			if ( ! self::__exec_thread_process($buffers,$skey)  or feof($fp)  ) {
				fclose($fp);
				unset(self::$gThread_Connections[$skey], $buffers_headers_passed[$skey] , $buffers[$skey] );
				return !empty(self::$gThread_Connections);;
			}
			
		}
		
	}/* foreach */
	return true;
 }
	
	/*
		funtion: thread_start
		@params: none
		return: <bool> 
	*/
	public static function start() { 
		$args =  func_get_args();
		if ( empty($args) )
			return false ;
		
		$method =  array_shift($args);
		$call_method = $method;
		$skey = 'n/a';
		if ( is_array($method) ) {
			$call_method = $method[0];
			if ( count($method)>1 ) {
				$skey = md5($call_method);
				self::$gThread_Responses[$skey] = &$method[1] ;	
			}
		}
	
		// no need
		unset($method);
		if ( ! array_key_exists($skey,self::$gThread_Responses) ) {
			$skey = md5($call_method);
			self::$gThread_Responses[$skey] =NULL;
		}
		
		if ( !is_string( $call_method ) ) {
			return false;
		}
		
		
	
		$host =  'localhost';
		$port =  8080;
		$host_name = $_SERVER['HTTP_HOST'];
		$path = $_SERVER['REQUEST_URI'];
	
		//Start out with a blocking socket.
		$errno =0 ; $errstr ='';
		$fp = fsockopen($host,$port, $errno, $errstr,5);
		if (!$fp) {
			unset (self::$gThread_Responses[$skey]);
			return false;
		}
		
		//
		$params =  serialize($args);
		
		$xml_data = '<?xml version="1.0" encoding="ISO-8859-1"?>'. "\r\n";
		$xml_data .= "<THREAD_CALL>\r\n";
		
		$xml_data .= "\t<THREAD_CALL_SIGNATURE_ID>\r\n";
		$xml_data .= "<![CDATA[\r\n";
		$xml_data .= THREAD_CALL_SIGNATURE_ID ;					   
		$xml_data .= "\r\n]]>\r\n";
		$xml_data .= "\t</THREAD_CALL_SIGNATURE_ID>\r\n";
			
			
			
		$xml_data .= "\t<FUNCTION>\r\n";
		$xml_data .= "<![CDATA[\r\n";
		$xml_data .= $call_method ;					   
		$xml_data .= "\r\n]]>\r\n";
		$xml_data .= "\t</FUNCTION>\r\n";
		
		
		
		$xml_data .= "\t<ARGS>\r\n";
		$xml_data .= "<![CDATA[\r\n";
		$xml_data .= $params ;					   
		$xml_data .= "\r\n]]>\r\n";
		$xml_data .= "\t</ARGS>\r\n";
		
		
		
		$xml_data .= "</THREAD_CALL>";
		
		$header = "POST ".$path." HTTP/1.1\r\n";
		$header .= "Host: ".$host_name."\r\n";
		$header .= "Content-Type: application/xml\r\n";
		$header .= "Content-Length: ".strlen($xml_data)."\r\n";
		$header .= "Connection: Close\r\n\r\n";
		$header .= $xml_data;

		fputs($fp,$header);
		stream_set_blocking($fp, 0);
		
		self::$gThread_Connections[$skey] = $fp;
		return true;		
	}
	
	/*
		funtion: thread_reset
		@params: none
		return: <bool> 
	*/
	public static function reset() {
		return self::runing('!@$%^&*()_+INTERNAL_THREAD_RESET!@$%^&*()_+');		
	}

	/*
		funtion: __handle_thread_calll
		@params: none
		return:  <void> 
	*/
	public static function listen() {
		global  $HTTP_RAW_POST_DATA; 
		$content_type =  isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
		if ( $content_type === 'application/xml'  &&  $_SERVER['REQUEST_METHOD']=='POST' && ($postText =  isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA :  file_get_contents('php://input')) !='' ) {
		
			
			
			$gXml = new domDocument(); 
			$gXml->strictErrorChecking = false; 
			$gXml->preserveWhiteSpace = true; 
			$gXml->loadXML($postText);
			$gXpath = new DOMXPath($gXml);
			$query = "//THREAD_CALL";
			
			
			
			
			$query = "//THREAD_CALL/THREAD_CALL_SIGNATURE_ID";
			$THREAD_CALL_SIGNATURE_ID = $gXpath->query($query);
			
			
			$query = "//THREAD_CALL/FUNCTION";
			$FUNCTION = $gXpath->query($query);
			
			
			$query = "//THREAD_CALL/ARGS";
			$ARGS = $gXpath->query($query);
			
			
			// clean of ob_start 
			while( ob_get_level() >0 ) ob_end_clean();
			
			
			//
			ob_implicit_flush();
						
			
			if(  !$THREAD_CALL_SIGNATURE_ID->length or !$FUNCTION->length ) {
				echo ( THREAD_TAG_BEG . serialize(array('error'=>'NOT_FOUND_THREAD_CALL_SIGNATURE_ID')) . THREAD_TAG_END );
				exit ;				
			}
			
			
			$THREAD_CALL_SIGNATURE_ID = trim( $THREAD_CALL_SIGNATURE_ID->item(0)->nodeValue);
			$FUNCTION = trim($FUNCTION->item(0)->nodeValue);
			
			
			if ( $ARGS->length )
				$ARGS = unserialize( trim( $ARGS->item(0)->nodeValue));
			else
				$ARGS = array ();
			
			
			//
			if ( $THREAD_CALL_SIGNATURE_ID !=  THREAD_CALL_SIGNATURE_ID  ) {
				echo ( THREAD_TAG_BEG  . serialize(array('error'=>'THREAD_CALL_SIGNATURE_ID')) . THREAD_TAG_END  );
				exit ;	
			}
						
			
			if ( !is_callable($FUNCTION) ) {
				echo ( THREAD_TAG_BEG . serialize(array('error'=>'NOT_CALLABLE')) . THREAD_TAG_END  );
				exit ;	
			}
			
			
			//
			call_user_func_array( $FUNCTION ,$ARGS);
			
			//
			exit ;
			
			
		}

		
		
	 }
	 
}


?>