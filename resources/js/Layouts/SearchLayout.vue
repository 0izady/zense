<script>
import { Link, useForm, usePage } from '@inertiajs/vue3';



export default {
    setup() {
        const { props } = usePage();

        return {
            authenticated: props.auth.user !== null,
            user: props.auth.user,
            logout: () => {
                axios.post('/logout')
                    .then(function () {
                        location.reload();
                    })
            }
        }
    }
};


</script>
<template>
    <nav class="border-gray-200">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4">
            <a href="/" class="flex items-center">
                <img src="/img/azar.png" alt="logo" class="w-40">
            </a>
            <div style="font-family: Vazirmatn" class="flex items-center md:order-2">
                <div v-if="authenticated">
                    <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                        class="flex items-center text-sm font-medium text-white rounded-full hover:text-primary dark:hover:text-blue-500 md:mr-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                        type="button">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 mr-2 rounded-full" :src="'/' + user.img" alt="user photo">
                        {{ user.name }}
                        <svg class="w-4 h-4 mx-1.5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownAvatarName"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div class="font-medium ">{{ user.name }}</div>
                            <div class="truncate"> {{ user.email }} </div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                            <li>
                                <a href="/dashboard"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">حساب
                                    کاربری</a>
                            </li>
                            <li>
                                <a href="/create"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">پست
                                    جدید</a>
                            </li>
                            <li>
                                <a href="/profile"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">ویرایش
                                    پروفایل</a>
                            </li>
                        </ul>
                        <div class="py-2">
                            <button @click="logout()"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">خروج</button>
                        </div>
                    </div>

                </div>
                <div v-else>
                    <a href="/login"
                        class="text-white hover:bg-gray-50 hover:text-gray-900 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">ورود</a>
                    <a href="/register"
                        class="text-white bg-primary font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 dark:bg-primary dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">ثبت
                        نام</a>
                </div>

                <button data-collapse-toggle="mega-menu" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mega-menu" aria-expanded="false">
                    <span class="sr-only">منو</span>
                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div id="mega-menu" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                <ul class="flex flex-col mt-4 font-medium md:flex-row md:space-x-8 md:mt-0">

                    <li>
                        <a href="/about"
                            class="block py-2 pl-3 pr-4 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">درباره
                            ما</a>
                    </li>
                    <li>
                        <a href="/contact"
                            class="block py-2 pl-3 pr-4 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">تماس
                            با ما</a>
                    </li>

                    <div class="dropdown dropdown-hover">
                        <button id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown"
                            class="flex items-center justify-between w-full py-2 pl-3 pr-4 font-medium text-white border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                            پست ها <svg aria-hidden="true" class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <a href="/top"
                                    class="text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-blue-500">
                                    سرچ های برتر
                                </a>
                            </li>
                            <li>
                                <a href="/top_posts"
                                    class="text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-blue-500">
                                    پست های برتر
                                </a>
                            </li>

                        </ul>
                    </div>

                    <li>
                        <a href="/"
                            class="block py-2 pl-3 pr-4 text-primary border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0 dark:text-blue-500 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"
                            aria-current="page">خانه</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
</template>

<style>
nav {
    /* From https://css.glass */
    background: rgba(0, 0, 0, 0.2);
    /* border-radius: 16px; */
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    /* border: 1px solid rgba(0, 0, 0, 0.3); */
}
</style>
