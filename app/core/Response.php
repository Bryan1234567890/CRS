<?php

class Response
{
	public static function output($error_code, $message)
	{
		
		
        if($error_code !== "200"){
            $response_code = -1;
            $array_response = self::err_messages($error_code, $message);
        }else{
			$array_response = ['response_code' => "200", 'message' => 'Success', 'data' => $message];
        }
		
       
		self::jsonExit($array_response);
	}

	protected static function err_messages($case_number, $message = '')
    {
		switch ($case_number) {
			case "400":
				$err_response = 'Bad Request.';
				break;
			case "204":
				$err_response = "No result";
				break;
		}

        return ['response_code' => $case_number, 'response_status' => $err_response, 'message' => $message];
	}

    private static function jsonExit($response)
	{
		header('content-type: application/json');
      	ob_start("ob_gzhandler");
      	exit(json_encode($response));  
	}
}

