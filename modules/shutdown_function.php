<?php

	function shutdown(){
		if(constant("SAVE_ERRORS_TO_LOG_ON_SHUTDOWN_FUNCTION")===true){
			try{
				$error = error_get_last();
				if($error !== null){
					$error["datetime"] = date("Y-m-d H:i:s");
					$msg = "[SHUTDOWN] ".$err["message"]." in ".$err["file"]." line ".$err["line"];
					
					file_put_contents(__DIR__."/errors.log", print_r($error, true), FILE_APPEND);
					file_put_contents(__DIR__."/errors.log", $msg, FILE_APPEND);
					error_log($msg);
				}
			}catch(Throwable $e){
				echo $e;
			}			
		}
		
		try{
			if(function_exists('mysql_close_all_connections')){
				mysql_close_all_connections();
			}
		}catch(Exception $e){
			echo $e;
		}
	}
		
	register_shutdown_function('shutdown');
?>