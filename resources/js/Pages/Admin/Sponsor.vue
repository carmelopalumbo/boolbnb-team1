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
            tokenGenerated: false,
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
                    console.log(this.tokenApi);
                    this.tokenGenerated = true;
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
                    class="text-center font-black text-4xl pb-8 uppercase text-[#4d1635] dark:text-[#89275e]"
                >
                    <i class="fa-solid fa-rocket"></i>
                    <span class="px-3">benvenuto in boost</span>
                    <i class="fa-solid fa-rocket"></i>
                </h2>
            </div>

            <div
                class="flex flex-col items-center md:justify-between md:flex-row container py-6"
            >
                <p class="w-1/2 mb-6">
                    In questa sezione hai la possibilit?? di mettere in risalto
                    la tua propriet??. Abbiamo messo a disposizione per te tre
                    pacchetti. Acquistando uno di questi otterrai un badge e la
                    tua propriet?? sar?? in cima alle ricerche degli utenti!
                    Scegli il pacchetto che preferisci e procedi con il
                    pagamento. <br><br> I boost disponibili sono:
                    <ul class="py-1">
                        <li>
                            2,99 ??? per 24 ore di sponsorizzazione
                        </li>
                        <li>
                            5.99 ??? per 72 ore di sponsorizzazione
                        </li>
                        <li>
                            9.99 ??? per 144 ore di sponsorizzazione
                        </li>
                    </ul>
                </p>
                <button
                    v-if="showType"
                    id="dropdownHoverButton"
                    data-dropdown-toggle="dropdownHover"
                    data-dropdown-trigger="hover"
                    class="text-white uppercase bg-[#4d1635] hover:bg-[#89275e] dark:bg-[#89275e] dark:hover:bg-[#4d1635] focus:ring-4 focus:outline-none font-bold rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center w-1/4 md:w-1/6"
                    type="button"
                >
                    scegli boost
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
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-400"
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
                                {{ sponsor.name }} | {{ sponsor.price }} ???
                            </p>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="flex container my-20 border-2 p-10 rounded-lg w-2/3 md:w-full"
                v-for="property in properties.data"
                :key="property.id"
            >
                <form
                    class="flex justify-between flex-col md:flex-row w-full mx-auto"
                    :id="'payment-form-' + property.id"
                    action="/api/payment/make/payment"
                    method="post"
                    @submit.prevent="submit"
                >
                    <div class="space-x-4 flex flex-col md:flex-row">
                        <span
                            class="uppercase font-bold text-xl text-center md:text-left"
                            >{{ property.name }}</span
                        >
                        <span
                            v-if="property.is_sponsored"
                            class="bg-[#ebb733] text-[#89275e] text-sm font-bold mr-2 px-2.5 py-0.5 h-6 rounded-full uppercase text-center my-4 md:my-0"
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
                                class="bg-[#ebb733] hover:bg-[#ebb733b7] text-[#4d1635] font-bold py-2 px-4 rounded uppercase disabled:opacity-80 disabled:hover:bg-[#ebb733]"
                                :id="'submit-button-' + property.id"
                                :disabled="
                                    (isLoading || property.is_sponsored) &&
                                    tokenGenerated
                                "
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
        v-if="properties.links.length > 3"
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
                'border border-1 rounded-xl px-3 border-[#4d1635] bg-[#4d1635] text-white': link.active,
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
