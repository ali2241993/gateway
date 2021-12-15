<?php
namespace App\Http\Controllers\Merchant;
use Illuminate\Http\Request;
use App\Models\McmsTransactoin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
class CashOutVoucherWithAmount extends Controller{
    public function cashOutVoucherWithAmount(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'clientId'               => 'required|string',
                'terminalId'             => 'required|string',
                'tranDateTime'           => 'required|string',
                'systemTraceAuditNumber' => 'required|integer',
                'phoneNumber'            => '',
                'voucherNumber'          => '',
                'tranAmount'             => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            ]);
            if ($validator->fails()){
                return $this->sendError(102,'invalidData',$validator->errors());
            }
            $response = Http::post('http://127.0.0.1:8001/api/merchant/cashOutVoucher',$request->all());
            return $response;
        }
        catch(\exception $e){
            return $e;
        }
    }
}