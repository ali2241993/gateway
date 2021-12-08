<?php
namespace App\Http\Controllers\Merchant;
use Illuminate\Http\Request;
use App\Models\McmsTransactoin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
class GenerateVoucher extends Controller{
    public function generateVoucher(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'clientId'               => 'required|string',
                'terminalId'             => 'required|string',
                'tranDateTime'           => 'required|string',
                'systemTraceAuditNumber' => 'required|integer',
                'PAN'                    => 'required|string',
                'PIN'                    => 'required|string',
                'expDate'                => 'required|string',
                'phoneNumber'            => 'required',
                'tranCurrencyCode'       => 'required|string',
                'tranAmount'             => 'required|double',
                'track2'                 => 'required|string',
                'checkDuplicate'         => 'required|boolean',
                'tranAuthenticationType' => 'required|string',
            ]);
            if ($validator->fails()){
                return $this->sendError(102,'invalidData',$validator->errors());
            }
            $response = Http::post('http://127.0.0.1:8001/api/merchant/generateVoucher',$request->all());
            return $response;
        }
        catch(\exception $e){
            return $e;
        }
    }
}