<script>
import Layout from "./Layouts/Layout.vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import { initDropdowns } from "flowbite";
import axios from "axios";

export default {
    name: "Sponsor",
    layout: Layout,
    props: {
        properties: Object,
        sponsors: Object,
    },
    tokenApi: "",

    data() {
        return {
            sponsBought: 1,
            sponsName: "bronze",
            showType: true,
            isLoading: false,
        };
    },

    methods: {
        sponsorsValue(id, name) {
            this.sponsBought = id;
            this.sponsName = name;
        },

        async generateToken() {
            const response = await axios
                .get("http://127.0.0.1:8000/api/payment/generate")
                .then((res) => {
                    this.tokenApi = res.data.clientToken;
                });
        },
        getPayment(id) {
            const form = document.getElementById("payment-form-" + id);

            braintree.dropin
                .create({
                    // Step three: get client token from your server, such as via
                    //    templates or async http request
                    authorization: this.tokenApi,
                    container: "#dropin-container-" + id,
                })
                .then((dropinInstance) => {
                    this.showType = false;
                    console.log("entrati in dropinstance");
                    form.addEventListener("submit", (event) => {
                        event.preventDefault();
                        console.log("cliccato dentro drop instance");

                        dropinInstance
                            .requestPaymentMethod()
                            .then((payload) => {
                                console.log("DENTRO METODO PAYMENT");
                                this.isLoading = true;
                                document.getElementById("nonce-" + id).value =
                                    payload.nonce;
                                form.submit();
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                    });
                    // Use `dropinInstance` here
                    // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.generateToken();
        initDropdowns();
    },
};
</script>

<template>
    <Head title="BOOST"></Head>
    <div class="flex justify-center mx-auto">
        <div class="pt-6 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h2
                    class="text-center font-black text-4xl pb-8 uppercase text-[#4d1635]"
                >
                    <i class="fa-solid fa-rocket"></i>
                    <span class="px-3">benvenuto in boost</span>
                    <i class="fa-solid fa-rocket"></i>
                </h2>
            </div>

            <div class="flex justify-between container py-6">
                <p class="w-1/2">
                    In questa sezione hai la possibilitá di mettere in risalto
                    la tua proprietá. Abbiamo messo a disposizione per te tre
                    pacchetti. Acquistando uno di questi otterrai un badge e la
                    tua proprietá sará in cima alle ricerche degli utenti!
                    Scegli il pacchetto che preferisci e procedi con il
                    pagamento.
                </p>
                <button
                    v-if="showType"
                    id="dropdownHoverButton"
                    data-dropdown-toggle="dropdownHover"
                    data-dropdown-trigger="hover"
                    class="text-white bg-[#4d1635] hover:bg-[#89275e] focus:ring-4 focus:outline-none font-bold rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center"
                    type="button"
                >
                    SCEGLI BOOST
                    <svg
                        class="w-4 h-4 ml-2"
                        aria-hidden="true"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        ></path>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div
                    id="dropdownHover"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
                >
                    <ul
                        class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownHoverButton"
                    >
                        <li
                            class="hover:bg-gray-100"
                            v-for="sponsor in sponsors"
                            :key="sponsor.id"
                        >
                            <p
                                @click="sponsorsValue(sponsor.id, sponsor.name)"
                                class="uppercase py-3 text-center cursor-pointer font-bold text-[#4d1635]"
                            >
                                {{ sponsor.name }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="flex container my-20 border-2 p-10 rounded-lg"
                v-for="property in properties.data"
                :key="property.id"
            >
                <form
                    class="flex justify-between w-full"
                    :id="'payment-form-' + property.id"
                    action="/api/payment/make/payment"
                    method="post"
                    @submit.prevent="submit"
                >
                    <div class="space-x-4">
                        <span class="uppercase font-bold text-xl">{{
                            property.name
                        }}</span>
                        <span
                            v-if="property.is_sponsored"
                            class="bg-[#ebb733] text-[#89275e] text-sm font-bold mr-2 px-2.5 py-0.5 rounded-full uppercase"
                            >boost <i class="fa-solid fa-rocket"></i>
                        </span>
                    </div>

                    <div class="flex space-x-4">
                        <input
                            type="hidden"
                            name="property_id"
                            id="property_id"
                            :value="property.id"
                        />

                        <input
                            type="hidden"
                            name="sponsor"
                            id="sponsor"
                            :value="sponsBought"
                        />
                        <input
                            type="hidden"
                            name="token"
                            id="token"
                            value="fake-valid-nonce"
                        />

                        <div :id="'dropin-wrapper-' + property.id">
                            <div :id="'checkout-message-' + property.id"></div>
                            <div :id="'dropin-container-' + property.id"></div>

                            <button
                                class="bg-[#ebb733] hover:bg-[#ebb733b7] text-[#4d1635] font-bold py-2 px-4 rounded uppercase"
                                :id="'submit-button-' + property.id"
                                :disabled="isLoading"
                                @click="getPayment(property.id)"
                            >
                                paga {{ sponsName }}
                            </button>

                            <input
                                type="hidden"
                                :id="'nonce-' + property.id"
                                name="payment_method_nonce"
                            />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div
        class="flex justify-center pb-3 text-[#4d1635] text-lg font-bold space-x-6"
    >
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in properties.links"
            :key="link.id"
            :href="link.url"
            v-html="link.label"
            :class="{
                'text-gray-400': !link.url,
                'border border-1 rounded-xl px-3 border-[#4d1635]': link.active,
            }"
        >
        </Component>
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
