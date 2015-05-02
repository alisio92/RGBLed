<?php
	/**
	 * Multi Threading 
	 * @author Bijaya Kumar 
	 * @email it.bijaya@gmail.com
	 * @mobile +91 9911033016
	 * @link http://www.digitalwebsolutions.in
	**/
	
	
	
	/*
		function : doSleep
	*/
	function doSleep ($sleep, $mrs  ) {
		//mThread::invoke ('doSleep_showProgress',"Hello <b>$mrs</b> i'm going to sleep for $sleep secs from now "  . date('Y-m-d H:i:s') ) ;
		//sleep( $sleep );
		//mThread::invoke ('doSleep_showProgress',"Hello <b>$mrs</b> i'm sorry for sleeping for $sleep secs now "  . date('Y-m-d H:i:s') ) ;
		//mThread::set_args($sleep);

        while(true){
            sleep( $sleep );
        }
		
	}
	/*
		function : doSleep1
	*/
	function doSleep1 ($sleep, $mrs  ) {
		doSleep ( $sleep, $mrs ) ;
	}
	/*
		function : doSleep2
	*/
	function doSleep2 ($sleep, $mrs  ) {
		doSleep ( $sleep, $mrs ) ;
	}	
	/*
		function : doSleep_showProgress_onThreadCallback
	*/
	function doSleep_showProgress_onThreadCallback ($message  ) {
		echo "<br /> Recevive Response [" . date('Y-m-d H:i:s') . "] :";
		print_r ( $message );
		echo "<br />";		
	}
?>