<script>

export default {
    name:"PropertyCard",
    props: {
        property: Object,
        media_property: Object
    }

}
</script>

<template>

<div class="group container flex justify-center max-w-sm  items-center bg-white border-2 rounded-xl border-[#4d1635] m-5 content-div">
    <div class="image-cover">
        <!-- <img class="rounded-t-lg group-hover:opacity-25" src="http://[::1]:5173/storage/app/public/uploads/EANf81bSGpqKbxHaF1Bnb8hvdb3Ui6Pp4FIo9S7X.png" alt="" /> -->
    </div>

    <div class="p-5 group-hover:opacity-25 text-white">
        <h5 class="text-2xl font-bold tracking-tight uppercase">Nome proprietà</h5>
        <div class="text-xs mb-2">Città, Paese</div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Prezzo</p>
    </div>
    <div class="absolute opacity-0 fd-sh group-hover:opacity-100">
       <div class="pt-8 text-center">
           <button class="text-center text-white rounded-lg p-4 font-bold text-lg bg-[#89275e]">Learn more
            <i class=" ml-2 fa-solid fa-arrow-right"></i>
           </button>
        </div>
    </div>
</div>

</template>


<style>
.content-div{
  background-image:url('https://images.unsplash.com/photo-1522093007474-d86e9bf7ba6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&q=80');
  background-repeat: no-repeat;
  background-size: cover;
  background-position:center;
}
  .content-div:hover{
    background-image:
    linear-gradient(to right,
     rgba(126, 213, 111, 0.801), hsla(160, 64%, 43%, 0.801) ),
     url('https://images.unsplash.com/photo-1522093007474-d86e9bf7ba6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&q=80');
    }

    .image-cover  {
      height:260px;
    }
  /*
  -remove the classes below if you have the 'group-hover'property added in your tailwind config file
  -also remove the class from the html template
  */
    .content-div:hover .fd-cl{
 opacity: 0.25;
    }
    .content-div:hover .fd-sh{
 opacity: 1;
    }

</style>
