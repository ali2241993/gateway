<?php
namespace App\Http\Controllers\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
class Purchase extends Controller{
    public function purchase(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'clientId'               => 'required|string',
                'terminalId'             => 'required|string',
                'tranDateTime'           => 'required|string',
                'systemTraceAuditNumber' => 'required|integer',
                'PAN'                    => 'required|string|regex:[0-9]?',
                'PIN'                    => 'required|string',
                'expDate'                => 'required|string',
                'tranCurrencyCode'       => 'required|string|digit:3',
                'tranAmount'             => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'additionalAmount'       => '',
                'track2'                 => 'required|string|min:33|max:37',
                'checkDuplicate'         => 'required|boolean',
                'tranAuthenticationType' => 'required|string',
            ]);
            if ($validator->fails()){
                return $this->sendError(102,'invalidData',$validator->errors());
            }
            $response = Http::post('http://127.0.0.1:8001/api/merchant/purchase',$request->all());
            return $response;
        }
        catch(\exception $e){
            return $e;
        }
    }
}