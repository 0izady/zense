<script setup>
import Layout from '@/Layouts/SearchLayout.vue';
import { Head } from '@inertiajs/vue3';


</script>

<template>
    <Head title="مستندات" />
    <Layout class="w-full"></Layout>

    <div class="text-right">
        <h1 class="text-3xl font-bold m-5">استفاده از API</h1>

        <ul class="menu bg-base-200 w-56 rounded-box absolute right-0 m-5">
            <li><a href="#search">َAPI سرچ</a></li>
            <li><a href="#post">API پست</a></li>
            <li><a href="#chat">API چت</a></li>
        </ul>

        <div id="search">
            <h2 class="text-2xl font-normal mt-60 mr-5">های سرچ API</h2>

            <div>
                <p class="m-8">گرفتن تمامی سرچ ها</p>
                <div class="mockup-code w-96 ml-auto mr-8">
                    <pre
                        data-prefix="$"><code><span class="text-red-400">curl</span> 127.0.0.1:8000/api/searches</code></pre>
                </div>
            </div>

            <div>
                <p class="m-8">گرفتن برترین سرچ ها</p>
                <div class="mockup-code w-96 ml-auto mr-8">
                    <pre
                        data-prefix="$"><code><span class="text-red-400">curl</span> 127.0.0.1:8000/api/top_search</code></pre>
                </div>
            </div>

            <div>
                <p class="m-8">گرفتن یک سرچ مشخص</p>
                <div class="mockup-code w-96 ml-auto mr-8">
                    <pre
                        data-prefix="$"><code><span class="text-red-400">curl</span> 127.0.0.1:8000/search/api/<span class="text-yellow-400">{سرچ}</span></code></pre>
                </div>
            </div>
        </div>

        <div id="post">
            <h2 class="text-2xl font-normal mt-20 mr-5">های پست API</h2>

            <div>
                <p class="m-8">گرفتن تمامی پست ها</p>
                <div class="mockup-code w-96 ml-auto mr-8">
                    <pre data-prefix="$"><code><span class="text-red-400">curl</span> 127.0.0.1:8000/api/postes</code></pre>
                </div>
            </div>

            <div>
                <p class="m-8">گرفتن برترین پست ها</p>
                <div class="mockup-code w-96 ml-auto mr-8">
                    <pre
                        data-prefix="$"><code><span class="text-red-400">curl</span> 127.0.0.1:8000/api/top_post</code></pre>
                </div>
            </div>

            <div>
                <p class="m-8">گرفتن یک پست مشخص</p>
                <div class="mockup-code w-96 ml-auto mr-8">
                    <pre
                        data-prefix="$"><code><span class="text-red-400">curl</span> 127.0.0.1:8000/api/post/<span class="text-yellow-400">{پست}</span></code></pre>
                </div>
            </div>
        </div>

        <div id="chat">
            <h2 class="text-2xl font-normal mt-20 mr-5">چت API</h2>

            <div>
                <p class="m-8">chat GPT چت کردن با</p>
                <div class="mockup-code w-96 ml-auto mr-8">
                    <pre
                        data-prefix="$"><code><span class="text-red-400">curl</span> 127.0.0.1:8000/api/chat/<span class="text-yellow-400">{متن}</span></code></pre>
                </div>
            </div>
        </div>



    </div>
</template>

<style>
html {
    scroll-behavior: smooth;
}
</style>
