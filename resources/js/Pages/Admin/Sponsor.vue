<script>
import Layout from "./Layouts/Layout.vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import axios from 'axios';
export default {
    name: "Sponsor",
    layout: Layout,

        token: '',
        sponsor: '',
    data(){
        return{
        }
    },
    methods:{

        async getPayment(){
            const response = await axios.post(
                'http://127.0.0.1:8000/payment/make/payment'
                //vediamo quello che torna nel res
            ).then((res)=>{
                console.log(res);
            })
        },
        async generateToken(){
            const response = await axios.get(
                'http://127.0.0.1:8000/api/payment/generate'
            )
            .then((res) =>{
                this.token = res.data.clientToken
                console.log(this.token);
            })
        },
        getPayment(){
            const form = document.getElementById('payment-form');

            braintree.dropin.create({
            // Step three: get client token from your server, such as via
            //    templates or async http request
            authorization: this.token,
            container: '#dropin-container'
            }).then((dropinInstance) => {
                console.log('entrati in dropinstance');
                form.addEventListener('submit',(event)=>{
                    event.preventDefault();

                    console.log('cliccato dentro drop instance');

                    dropinInstance.requestPaymentMethod().then((payload)=>{
                        console.log('DENTRO METODO PAYMENT');
                        console.log(payload);
                        // document.getElementById('nonce').value = payload.nonce;
                        form.submit();
                    }).catch((error)=>{throw error});
                });
            // Use `dropinInstance` here
            // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
            }).catch((error) => { console.log(error);});
        },
         submit(){
            router.post('/api/payment/make/payment', useForm);
            console.log('submitted');
        },
    },
    mounted(){
        this.generateToken();

    }
};
</script>

<template>
    <Head title="BOOST"></Head>
    <div class="flex justify-center mx-auto">
        <div class="py-6 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h1 class="text-center font-bold text-2xl py-6 uppercase">
                    BENVENUTO IN BOOST
                </h1>
                <p>
                    In questa sezione hai la possibilitá di mettere in risalto
                    la tua proprietá. Abbiamo messo a disposizione per te tre
                    pacchetti. Acquistando uno di questi otterrai un badge e la
                    tua proprietá sará in cima alle ricerche degli utenti!
                    Scegli il pacchetto che preferisci e procedi con il
                    pagamento.
                </p>
            </div>

<form  id="payment-form" action="/api/payment/make/payment" method="post" @submit.prevent="submit">

        <div id="dropin-wrapper">
            <div id="checkout-message"></div>
            <div id="dropin-container"></div>


            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="submit-button" @click="getPayment" >Submit payment</button>

             <input type="submit" />
             <input type="hidden" id="nonce" name="payment_method_nonce"/>
        </div>

</form>



        </div>
    </div>
</template>

<style>
.button {
  cursor: pointer;
  font-weight: 500;
  left: 3px;
  line-height: inherit;
  position: relative;
  text-decoration: none;
  text-align: center;
  border-style: solid;
  border-width: 1px;
  border-radius: 3px;
  display: inline-block;
}

.button--small {
  padding: 10px 20px;
  font-size: 0.875rem;
}

.button--green {
  outline: none;
  background-color: #64d18a;
  border-color: #64d18a;
  color: white;
  transition: all 200ms ease;
}

.button--green:hover {
  background-color: #8bdda8;
  color: white;
}
</style>
