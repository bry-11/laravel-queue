<?php

namespace App\Traits;

trait ServerResponse
{
    /**
     * Core of response
     * 
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode  
     * @param   boolean         $isSuccess
     */
    private function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        // Check the params
        if(!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if($isSuccess) {
            return response()->json([
                'message' => $message,
                'error' => false,
                'code' => $statusCode,
                'data' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode,
                'errors' => $data
            ], $statusCode);
        }
    }

    /**
     * Send any success response to client
     * 
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode
     */
    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    /**
     * Send any error response to client
     * 
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode    
     */
    public function error($message, $data,$statusCode = 500)
    {
        return $this->coreResponse($message, $data, $statusCode, false);
    }

    /**
     * Send any response to controller
     * 
     * @param   boolean              $hasErrors
     * @param   array|object|null    $data
     * @param   string               $message
     * @param   integer              $statusCode    
     */
    public function response($hasErrors, $data , $message , $statusCode) {
        $response["code"] = $statusCode;
        $response["message"] = $message;
        $response["data"] = $data;
        $response["error"] = $hasErrors;
        return $response;
    }
}