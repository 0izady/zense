<script setup>
import Layout from '@/Layouts/SearchLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue'


const props = defineProps(['key_word']);

const data = {
    okay: "",
    summarize: "",
    article: "",
    img: ""
}

async function search() {
    try {
        const response = await axios.get(`/api/search/${props.key_word}`).then(function (response) {
            document.getElementById('loading').classList.add('inactive');
            document.getElementById('summerize_content').classList.remove('inactive');

            watchEffect(() => {
                data.okay = response.data.okay;
                data.summarize = response.data.summarize;
                data.article = response.data.article;
                data.img = response.data.img;
                document.getElementById('contant').innerHTML = response.data.summarize;
                document.getElementById('img').src = response.data.img;
            })
        })
    } catch (error) {
        document.getElementById('loading').classList.add('inactive');
        document.getElementById('errorBox').classList.remove('inactive');
        document.getElementById('errorMessage').innerHTML = error.message;
    }
}

search()

let globalTarget = 'summerize';
let textToCopy = `
        ${data.summarize}

        ---------------------------------------------------------------

        ${data.article}
    `;

function changeTarget(target) {
    if (target == 'summerize') {
        document.getElementById('contant').innerHTML = data.summarize;
        globalTarget = 'summerize';
    } else {
        document.getElementById('contant').innerHTML = data.article;
        globalTarget = 'article';
    }


}

function useClipboard() {
    navigator.clipboard.writeText(textToCopy);
}

async function translate(lan) {
    try {
        if (globalTarget == 'summerize') {
            const response = await axios.get(`/api/translate/${lan}/${data.summarize}`);
            document.getElementById('contant').innerHTML = response.data;
            textToCopy = response.data;
        } else {
            const response = await axios.get(`/api/translate/${lan}/${data.article}`);
            document.getElementById('contant').innerHTML = response.data;
            textToCopy = response.data;
        }


    } catch (error) {
        console.error(error);
    }
}

</script>

<template>
    <Head>
        <title>{{ key_word }}</title>
    </Head>
    <Layout></Layout>

    <div id="loading">
        <span class="loading loading-dots loading-lg"></span>
    </div>

    <div class="alert alert-error inactive" id="errorBox">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span id="errorMessage"></span>
    </div>

    <div class="flex flex-wrap items-center max-w-screen-xl mx-auto p-4 ml-60 absolute right-0 mb-4">
        <button href="#summerize" class="link mr-5" id="summerize" @click="changeTarget('summerize')">
            خلاصه
        </button>
        <button href="#articel" class="link" id="articel" @click="changeTarget('articel')">
            مقاله
        </button>
    </div>
    <!-- {{ search() }} -->

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-gray-100 max:w-2/5 m-10 rounded-lg absolute right-0 mt-20 inactive"
        id="summerize_content">
        <div class="flex justify-between mx-auto max-w-screen-xl ">
            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue text-right">

                <header class="mb-4 lg:mb-b6 not-format mr-4">

                    <details class="dropdown">
                        <summary class="m-1 btn"><i class="fa-solid fa-ellipsis" style="color: #1463f3;"></i></summary>
                        <ul class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                            <li @click="useClipboard"><a><i class="fa-regular fa-copy" style="color: #1463f3;"></i>کپی</a>
                            </li>
                        </ul>
                    </details>

                    <details class="dropdown">
                        <summary class="m-1 btn">
                            <p class="text-gray-800">
                                ترجمه
                                <i class="fa-solid fa-caret-down" style="color: #1463f3;"></i>
                            </p>
                        </summary>
                        <ul class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                            <li><button @click="translate('fa')">فارسی</button></li>
                            <li><button @click="translate('en')">English</button></li>
                            <li><button @click="translate('ar')">عربي</button></li>
                            <li><button @click="translate('es')">Español</button></li>
                            <li><button @click="translate('ja')">日本</button></li>
                        </ul>
                    </details>


                    <h1 id="title" class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">
                    </h1>
                </header>

                <p id="contant" class="p-2">{{ data.summarize }}</p>

                <figure>
                    <img :src="data.img" alt="" class="my-8 rounded-lg w-96 h-96" id="img">
                </figure>

            </article>

        </div>
    </main>
</template>

<style>
#loading {
    position: absolute;
    top: 50%;
    left: 50%;
}

.inactive {
    display: none;
}
</style>
