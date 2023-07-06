<script setup>
import Layout from '@/Layouts/SearchLayout.vue';
import { useForm } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';
import axios from 'axios';

const history = defineProps({
    historys: Object,
});
let txt = ""
let randomNumber = "url(/backgrounds/" + parseInt(Math.floor((Math.random() * 12) + 1)) + ".jpg)";
const form = useForm({
    search: '',
})

function submitForm() {
    window.location.href = '/search/' + form.search;
}
async function getSearch() {
    try {
        const response = await axios.get(`/api/GetSearch/${form.search}`);
        if (response.data.summarize) {
            txt = response.data.summarize;
            document.getElementById('summerizeAjaxSearchContant').classList.remove('inactive');
            var i = 0;
            var speed = 50;

            function typeWriter() {
                if (i < txt.length) {
                    document.getElementById("summerizeAjaxSearchContant").innerHTML += txt.charAt(i);
                    i++;
                    setTimeout(typeWriter, speed);
                }
            }
            typeWriter()
        } else {
            txt = "";
            document.getElementById("summerizeAjaxSearchContant").innerHTML = '';
            document.getElementById('summerizeAjaxSearchContant').classList.add('inactive');
        }
    } catch (error) {
        console.error(error);
    }
}

document.getElementById('body').style.backgroundImage = randomNumber;

</script>

<template background-color="blue">
    <Head title="خانه" />
    <Layout class="w-full"></Layout>

    <div class="center">
        <form v-on:submit.prevent="submitForm" method="get" class="rounded-full p-2 text-xl leading-5 bg-white">
            <div>

                <a :href="`/search/${form.search}`" class="search-icon">
                    <i class="fa-solid fa-magnifying-glass fa-xl" style="color: #fc6600;"></i>
                </a>

                <input type="text" class="w-[584px] h-[44px] border-none bg-none focus:ring-0 text-right"
                    placeholder="هرچی دلت میخواد بنویس" id="search-input" v-model="form.search" @keyup.enter="submit"
                    @input="onChange" @keydown.down="onArrowDown" @keydown.up="onArrowUp" @keydown.enter="onEnter"
                    @keyup="getSearch">

            </div>
        </form>
        <div class="mt-20 glass p-5 w-96 h-auto max-w-lg text-white inactive" id="summerizeAjaxSearchContant">
            <p id="summerizeAjaxSearch">
                {{ ajaxSearch }}
            </p>
        </div>
    </div>


    <!-- </div> -->
</template>

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html,
body {
    margin: 0;
    height: 100%;
    overflow: hidden
}

body {
    /* background-image: url("https://source.unsplash.com/random/?4k wallpaper"); */
    background-repeat: no-repeat;
    display: block;
    width: 100%;
    height: 100vh;
    background-position: center;
    background-size: cover;
    font-size: 12px;
}

.center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}


.inactive {
    display: none;
}

@media only screen and (max-width: 480px) {
    * {
        box-sizing: border-box;
    }

    body {
        font-size: 14px;
    }
}
</style>
