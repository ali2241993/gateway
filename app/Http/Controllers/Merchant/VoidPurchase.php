<?php
namespace App\Http\Controllers\Merchant;
use Illuminate\Http\Request;
use App\Models\McmsTransactoin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
class VoidPurchase extends Controller{
    public function voidPurchase(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'clientId'                           => 'required|string',
                'terminalId'                         => 'required|string',
                'tranDateTime'                       => 'required|string',
                'systemTraceAuditNumber'             => 'required|integer',
                'PAN'                                => 'required|string|regex:[0-9]?',
                'expDate'                            => 'required|string',
                'originalTranSystemTraceAuditNumber' => 'required|numeric',
                'originalTranReferenceNumber'        => 'required|numeric',
                'checkDuplicate'                     => 'required|boolean',
            ]);
            if ($validator->fails()){
                return $this->sendError(102,'invalidData',$validator->errors());
            }
            $response = Http::post('http://127.0.0.1:8001/api/merchant/Void',$request->all());
            return $response;
        }
        catch(\exception $e){
            return $e;
        }
    }
}