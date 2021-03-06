<?php
namespace App\Http\Controllers\Merchant;
use Illuminate\Http\Request;
use App\Models\McmsTransactoin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
class CashOutVoucher extends Controller{
    public function cashOutVoucher(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'clientId'               => 'required|string',
                'terminalId'             => 'required|string',
                'tranDateTime'           => 'required|string',
                'systemTraceAuditNumber' => 'required|integer',
                'phoneNumber'            => 'required|string|regex:[0-9]?',
                'voucherNumber'          => 'required|numeric',
            ]);
            if ($validator->fails()){
                return $this->sendError(102,'invalidData',$validator->errors());
            }
            $response = Http::post('http://127.0.0.1:8001/api/merchant/cashOutVoucherOld',$request->all());
            return $response;
        }
        catch(\exception $e){
            return $e;
        }
    }
}