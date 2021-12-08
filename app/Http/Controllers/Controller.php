<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function sendResponse($result = null){
        $response = [
            'responseCode'    => 100,
            'responseMessage' => 'success',
        ];
        if (!empty($result)) {
            $response['data'] = $result;
        }
        return response()->json($response , 200);
    }
    public function sendError($code,$responseMessage , $errorMessage = null){
        $response = [
            'responseCode'    => $code,
            'responseMessage' => $responseMessage
        ];
        if (!empty($errorMessage)) {
            $response['errors'] = $errorMessage;
        }
        return response()->json($response , 404);
    }
    public function getData(){
        return 'amro';
    }
}