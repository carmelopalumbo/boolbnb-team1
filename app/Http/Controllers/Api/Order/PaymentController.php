<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Models\Property;
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
    public function makePayment(Request $request,  Gateway $gateway, Property $property){
        $form_data = $request->all();

        $id = $form_data['property_id'];
        $sponsor = Sponsor::find($request->sponsor);
        $property =Property::find($id);

        $request->validate([
            'token'=>'required',
            'sponsor'=>[
                'required',
                new ValidSponsor(),
            ],
        ]);
        $property->is_sponsored = 1;

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
            $property->update();
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

    public function update(Request $request, Property $property){
        $form_data = $request->all();
        $id = $form_data['property_id'];
        $property =Property::find($id);
        $property->is_sponsored = 1;
        dd($property);
        $property->update();
    }
}
