<script>
import Header from "./Partials/Header.vue";
import Footer from "./Partials/Footer.vue";

export default {
    name: "About",

    components: { Header, Footer },
};
</script>

<template>
    <Header />
        <main class="ofc">
            <div class="flex justify-center mt-5 text-3xl uppercase">
                <h1>Chi siamo</h1>
            </div>
            <div class="mx-auto h-5/6 w-5/6 mt-3 flex sd:flex-wrap justify-between ">

                <div class="w-1/5 mx-2 hover:scale-105 hover:shadow-lg transition duration-300 rounded-md border-[#4d1635] border-2">
                    <div class="rounded-full scale-75 border-[#4d1635] border-2 ">
                        <img class="rounded-full " src="https://cdn3.vectorstock.com/i/1000x1000/35/52/placeholder-rgb-color-icon-vector-32173552.jpg" alt="">
                    </div>
                    <div class="text-center text-xl ">
                        <p>Jessica Tartaglia</p>
                    </div>
                    <div class="text-lg m-5 p-3">
                        <a href="https://www.linkedin.com/in/jessica-tartaglia-jt/"><i class="text-2xl fa-brands fa-linkedin"></i> Lorem, ipsum  </a>
                        <br>
                        <a href="https://github.com/FRJess"><i class="text-2xl fa-brands fa-github"></i> FRJess </a>
                    </div>
                </div>
                <div class="w-1/5 mx-2 hover:scale-105 transition duration-300 rounded-md border-[#4d1635] border-2">
                    <div class="rounded-full scale-75 border-[#4d1635] border-2 ">
                        <img class="rounded-full " src="https://cdn3.vectorstock.com/i/1000x1000/35/52/placeholder-rgb-color-icon-vector-32173552.jpg" alt="">
                    </div>
                    <div class="text-center text-xl ">
                        <p>Michele Zancolò</p>
                    </div>
                    <div class="text-lg m-5 p-3">
                        <a href="https://www.linkedin.com/in/michele-zancol%C3%B2/"><i class="text-2xl fa-brands fa-linkedin"></i> Lorem, ipsum  </a>
                        <br>
                        <a href="https://github.com/mikzanco"><i class="text-2xl fa-brands fa-github"></i> mikzanco </a>
                    </div>
                </div>
                <div class="w-1/5 mx-2 hover:scale-105 transition duration-300 rounded-md border-[#4d1635] border-2">
                    <div class="rounded-full scale-75 border-[#4d1635] border-2 ">
                        <img class="rounded-full" src="https://cdn3.vectorstock.com/i/1000x1000/35/52/placeholder-rgb-color-icon-vector-32173552.jpg" alt="">
                    </div>
                    <div class="text-center text-xl ">
                        <p>Carmelo Palumbo</p>
                    </div>
                    <div class="text-lg m-5 p-3">
                        <a href="https://www.linkedin.com/in/carmelo-palumbo/"><i class="text-2xl fa-brands fa-linkedin"></i> Lorem, ipsum  </a>
                        <br>
                        <a href="https://github.com/carmelopalumbo"><i class="text-2xl fa-brands fa-github"></i> PALUC </a>
                    </div>
                </div>
                <div class="w-1/5 mx-2 hover:scale-105 transition duration-300 rounded-md border-[#4d1635] border-2">
                    <div class="rounded-full scale-75 border-[#4d1635] border-2 ">
                        <img class="rounded-full 5" src="https://cdn3.vectorstock.com/i/1000x1000/35/52/placeholder-rgb-color-icon-vector-32173552.jpg" alt="">
                    </div>
                    <div class="text-center text-xl">
                        <p>Eugenio Belardinelli</p>
                    </div>
                    <div class="text-lg m-5 p-3">
                        <a href="https://www.linkedin.com/in/eugenio-belardinelli/"><i class="text-2xl fa-brands fa-linkedin"></i> Lorem, ipsum  </a>
                        <br>
                        <a href="https://github.com/Eugenio2104"><i class="text-2xl fa-brands fa-github"></i> Eugenio2104 </a>
                    </div>
                </div>
                <div class="w-1/5 mx-2 hover:scale-105 transition duration-300 rounded-md border-[#4d1635] border-2">
                    <div class="rounded-full scale-75 border-[#4d1635] border-2 ">
                        <img class="rounded-full " src="https://cdn3.vectorstock.com/i/1000x1000/35/52/placeholder-rgb-color-icon-vector-32173552.jpg" alt="">
                    </div>
                    <div class="text-center text-xl">
                        <p>Carmelo Miuccio</p>
                    </div>
                    <div class="text-lg m-5 p-3">
                        <a href="https://www.linkedin.com/in/carmelo-miuccio-9662301b4/"><i class="text-2xl fa-brands fa-linkedin"></i> Lorem, ipsum  </a>
                        <br>
                        <a href="https://github.com/TheMrStraffy"><i class="text-2xl fa-brands fa-github"></i> TheMrStraffy </a>
                    </div>

                </div>

            </div>



        </main>

    <Footer />
</template>

<style>

.ofc{
    height: calc(100vh - 195px);
    overflow-y: scroll;
    /* margin-bottom: 20px; */
}

.custom-shadow {
  box-shadow: 0 0 0 3px rgba(77, 22, 53, 0.5);
}

.custom-shadow:hover {
  transform: scale(1.05);
}

</style>
