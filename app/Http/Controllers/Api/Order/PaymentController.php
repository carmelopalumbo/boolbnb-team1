<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Rules\ValidSponsor;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function generate(Request $request, Gateway $gateway){

        $clientToken = $gateway->clientToken()->generate([
            "customerId" => Auth::user(),
        ]); //questo genera il primo token richiesto a BT Services
        // dd($gateway->clientToken()->generate());
        $data = [
            'success' => true,
            'token' => $clientToken
        ];
        return compact('clientToken');
    }
    public function makePayment(Request $request,  Gateway $gateway){
        $sponsor = Sponsor::find($request->sponsor);
        // dd($request);

        $request->validate([
            'token'=>'required',
            'sponsor'=>[
                'required',
                new ValidSponsor(),
            ],
        ]);

        //qui generiamo il pagamento
        $result = $gateway->transaction()->sale([
            'amount'=>$sponsor->price,

            //Genera il secondo token che inviera il frontend a questa chiamata per confermare la transazione
            'paymentMethodNonce'=>$request->token,

            'options'=>[
                'submitForSettlement'=>true
            ]
        ]);
        if($result->success){
            $data = [
                'success' => true,
                'message'=>'Transazione eseguita con successo!',
                'sponsorDetails'=>[
                    'name'=>$sponsor->name,
                    'price'=>$sponsor->price,
                    'duration'=>$sponsor->duration,
                ]
            ];
            return response()->json($data);
        } else{
            $data = [
                'success' => false,
                'message'=>'Transazione fallita!'
            ];
            return compact('data');
        }
        return 'Make Payment';
    }
}
