<script>
import Header from "./Partials/Header.vue";
import Footer from "./Partials/Footer.vue";

export default {
    name: "About",

    components: { Header, Footer },
};
</script>

<template>
    <Head title="CHI SIAMO" />
    <Header />
    <main class="ofc dark:bg-[#111827] dark:text-white py-8">
        <div class="flex justify-center m-9 text-3xl uppercase text-[#4d1635]">
            <i class="fa-solid fa-people-group"></i>
            <h1 class="px-4 font-bold">Chi siamo</h1>
            <i class="fa-solid fa-people-group"></i>
        </div>
        <div class="flex flex-col">
            <div
                class="mt-3 flex lg:flex-row flex-col columns-3 justify-between flex-wrap w-full lg:space-x-4 space-y-10 lg:space-y-0 px-10"
            >
                <div
                    class="w-full lg:w-1/6 hover:scale-105 transition duration-300 rounded-md border-[#4d1635] border-2"
                >
                    <div
                        class="rounded-full scale-75 border-[#4d1635] border-2"
                    >
                        <img
                            class="rounded-full"
                            src="https://media.licdn.com/dms/image/D4D03AQHtoJEa__BfSA/profile-displayphoto-shrink_800_800/0/1675531887713?e=1683158400&v=beta&t=GozYAPM7HLLUg-BQWeiswYEQXDK8uxajGvirO83A2UU"
                            alt=""
                        />
                    </div>
                    <div class="text-center text-xl">
                        <p>Jessica Tartaglia</p>
                    </div>
                    <div
                        class="text-lg p-3 text-[#4d1635] text-center font-bold"
                    >
                        <a
                            target="_blank"
                            href="https://www.linkedin.com/in/jessica-tartaglia-jt/"
                            ><i class="text-2xl fa-brands fa-linkedin pb-2"></i>
                            Visita il profilo</a
                        >
                        <br />
                        <a target="_blank" href="https://github.com/FRJess"
                            ><i class="text-2xl fa-brands fa-github"></i> FRJess
                        </a>
                    </div>
                </div>
                <div
                    class="w-full lg:w-1/6 hover:scale-105 transition duration-300 rounded-md border-[#4d1635] border-2"
                >
                    <div
                        class="rounded-full scale-75 border-[#4d1635] border-2"
                    >
                        <img
                            class="rounded-full"
                            src="https://media.licdn.com/dms/image/D4D03AQFfbqU0LQuYnw/profile-displayphoto-shrink_800_800/0/1677487021905?e=1683158400&v=beta&t=1b3eq1j18F-d9u_a90Ny2GwVU-zkdg7MIdjcpBkBAP4"
                            alt=""
                        />
                    </div>
                    <div class="text-center text-xl">
                        <p>Michele Zancolò</p>
                    </div>
                    <div
                        class="text-lg p-3 text-[#4d1635] text-center font-bold"
                    >
                        <a
                            target="_blank"
                            href="https://www.linkedin.com/in/michele-zancol%C3%B2/"
                            ><i class="text-2xl fa-brands fa-linkedin pb-2"></i>
                            Visita il profilo
                        </a>
                        <br />
                        <a target="_blank" href="https://github.com/mikzanco"
                            ><i class="text-2xl fa-brands fa-github"></i>
                            mikzanco
                        </a>
                    </div>
                </div>
                <div
                    class="w-full lg:w-1/6 hover:scale-105 transition duration-300 rounded-md border-[#4d1635] border-2"
                >
                    <div
                        class="rounded-full scale-75 border-[#4d1635] border-2"
                    >
                        <img
                            class="rounded-full"
                            src="https://media.licdn.com/dms/image/D4E03AQG6Rd-HaTSySg/profile-displayphoto-shrink_800_800/0/1675518344230?e=1683158400&v=beta&t=cJDyPf7CT019VpgXbO2JmAJcKIq5WF66pPy-nJjtibs"
                            alt=""
                        />
                    </div>
                    <div class="text-center text-xl">
                        <p>Carmelo Palumbo</p>
                    </div>
                    <div
                        class="text-lg p-3 text-[#4d1635] text-center font-bold"
                    >
                        <a
                            target="_blank"
                            href="https://www.linkedin.com/in/carmelo-palumbo/"
                            ><i class="text-2xl fa-brands fa-linkedin pb-2"></i>
                            Visita il profilo
                        </a>
                        <br />
                        <a
                            target="_blank"
                            href="https://github.com/carmelopalumbo"
                            ><i class="text-2xl fa-brands fa-github"></i> PALUC
                        </a>
                    </div>
                </div>
                <div
                    class="w-full lg:w-1/6 hover:scale-105 transition duration-300 rounded-md border-[#4d1635] border-2"
                >
                    <div
                        class="rounded-full scale-75 border-[#4d1635] border-2"
                    >
                        <img
                            class="rounded-full"
                            src="https://media.licdn.com/dms/image/D4D03AQGGJmXBOgcVjQ/profile-displayphoto-shrink_800_800/0/1677249743869?e=1683158400&v=beta&t=eC_iyuzZ2dfQW_PWPm42Led0IsvlcySeBUk48yLeVIs"
                            alt=""
                        />
                    </div>
                    <div class="text-center text-xl">
                        <p>Eugenio Belardinelli</p>
                    </div>
                    <div
                        class="text-lg p-3 text-[#4d1635] text-center font-bold"
                    >
                        <a
                            target="_blank"
                            href="https://www.linkedin.com/in/eugenio-belardinelli/"
                            ><i class="text-2xl fa-brands fa-linkedin pb-2"></i>
                            Visita il profilo
                        </a>
                        <br />
                        <a target="_blank" href="https://github.com/Eugenio2104"
                            ><i class="text-2xl fa-brands fa-github"></i>
                            Eugenio2104
                        </a>
                    </div>
                </div>
                <div
                    class="w-full lg:w-1/6 hover:scale-105 transition duration-300 rounded-md border-[#4d1635] border-2"
                >
                    <div
                        class="rounded-full scale-75 border-[#4d1635] border-2"
                    >
                        <img
                            class="rounded-full"
                            src="https://media.licdn.com/dms/image/D4D03AQF7pBADbgRbIQ/profile-displayphoto-shrink_800_800/0/1675442747948?e=1683158400&v=beta&t=4hGCoj-IgKCDhuxOyd1LeR020YNZLrAcqwb0P7sMBLs"
                            alt=""
                        />
                    </div>
                    <div class="text-center text-xl">
                        <p>Carmelo Miuccio</p>
                    </div>
                    <div
                        class="text-lg p-3 text-[#4d1635] text-center font-bold"
                    >
                        <a
                            target="_blank"
                            href="https://www.linkedin.com/in/carmelo-miuccio-9662301b4/"
                            ><i class="text-2xl fa-brands fa-linkedin pb-2"></i>
                            Visita il profilo
                        </a>
                        <br />
                        <a
                            target="_blank"
                            href="https://github.com/TheMrStraffy"
                            ><i class="text-2xl fa-brands fa-github"></i>
                            TheMrStraffy
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="mx-auto w-5/6 mt-7 rounded-md border-[#4d1635] border-2 my-4"
            >
                <p class="p-3">
                    Siamo lieti di esprimere la nostra gratitudine nei confronti
                    di Boolean Careers per l'opportunità che ci hanno offerto di
                    partecipare al loro corso di Full Stack Developer. Grazie
                    alla loro formazione, supporto e guida, siamo riusciti a
                    realizzare il nostro progetto BoolBnB, una replica di
                    AirBnb. <br />
                    <br />
                    Il corso di Web Developer che abbiamo frequentato con
                    Boolean Careers è stato un'esperienza incredibile, sia per
                    la qualità del programma di studio che per l'efficienza dei
                    loro docenti e tutor. Siamo rimasti particolarmente colpiti
                    dalla loro professionalità, competenza e disponibilità
                    nell'aiutarci ad acquisire le competenze tecniche necessarie
                    per costruire il nostro sito web. <br />
                    <br />
                    Il nostro team desidera ringraziare tutti i docenti e i
                    tutor che hanno lavorato con noi durante il corso. Siamo
                    grati per il loro impegno, pazienza e dedizione
                    nell'aiutarci ad affrontare le difficoltà e superare gli
                    ostacoli che abbiamo incontrato lungo il percorso. <br />
                    <br />
                    Ovunque arriveremo in futuro, non scorderemo mai da dove
                    siamo partiti. <br />
                    <br />
                    Il team BoolBnB &hearts; .
                </p>
            </div>
        </div>
    </main>

    <Footer />
</template>

<style>
.ofc {
    height: calc(100vh - 160px);
    overflow-y: scroll;
    /* margin-bottom: 20px; */
}
</style>
