<?php
namespace App\Http\Controllers\Merchant;
use Illuminate\Http\Request;
use App\Models\McmsTransactoin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
class CardTransfer extends Controller{
    public function cardTransfer(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'clientId'               => 'required|string',
                'terminalId'             => 'required|string',
                'tranDateTime'           => 'required|string',
                'systemTraceAuditNumber' => 'required|integer',
                'PAN'                    => 'required|string',
                'PIN'                    => 'required|string',
                'expDate'                => 'required|string',
                'tranCurrencyCode'       => 'required|string',
                'tranAmount'             => 'required|double',
                'toCard'                 => '',
                'track2'                 => 'required|string',
                'checkDuplicate'         => 'required|boolean',
                'tranAuthenticationType' => 'required|string',
            ]);
            if ($validator->fails()){
                return $this->sendError(102,'invalidData',$validator->errors());
            }
            $response = Http::post('http://127.0.0.1:8001/api/merchant/doCardTransfer',$request->all());
            return $response;
        }
        catch(\exception $e){
            return $e;
        }
    }
}