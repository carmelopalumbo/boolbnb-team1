<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Sponsor;
use App\Rules\ValidSponsor;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function generate(Request $request, Gateway $gateway)
    {

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
    public function makePayment(Request $request,  Gateway $gateway, Property $property)
    {
        $form_data = $request->all();

        $id = $form_data['property_id'];
        $sponsor = Sponsor::find($request->sponsor);
        $property = Property::find($id);

        $request->validate([
            'token' => 'required',
            'sponsor' => [
                'required',
                new ValidSponsor(),
            ],
        ]);

        //qui generiamo il pagamento
        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->price,

            //Genera il secondo token che inviera il frontend a questa chiamata per confermare la transazione
            'paymentMethodNonce' => $request->token,

            'options' => [
                'submitForSettlement' => true
            ]
        ]);


        if ($result->success) {
            $property->update([
                'is_sponsored' => 1
            ]);

            $property->sponsors()->attach($sponsor->id, [
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()
            ]);

            return to_route('sponsors')->with('infoMessage', 'TRANSAZIONE ESEGUITA CON SUCCESSO!');
        } else {
            return to_route('sponsors')->with('infoMessage', 'TRANSAZIONE FALLITA, RIPROVA!');
        }
        return 'Make Payment';
    }
}
