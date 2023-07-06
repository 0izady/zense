<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import axios from 'axios';

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    user: Object
});

function onFileChange(event) {
    var fileData = event.target.files[0];
    var fileName = fileData.name;
    document.getElementById("fileName").innerHTML = fileName;
}

const form = useForm({
    email: props.user.email,
    name: props.user.name,
    password: props.user.password,
    phoneNumber: props.user.phoneNumber,
    gender: props.user.gender,
    img: props.user.img,
})


const submit = () => {
    form.post('/profile', {
        _method: 'put',
    });
};

</script>

<template>
    <Head title="نمایه" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">نمایه</h2>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <section class="bg-gray-50 dark:bg-gray-900 text-right mt-20">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        تکمیل اطلاعات
                    </h1>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">

                        <!-- file input -->
                        <div class="flex items-center justify-center w-11/12 mr-5 float-right mb-6">
              <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-34 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                  <div class="flex flex-col items-center justify-center pt-5 pb-6">
                      <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                      <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">برای بارگذاری عکس پروفایل کلیک کنید</span> یا فایل را به اینجا بکشید</p>
                      <p class="text-xs text-gray-500 dark:text-gray-400" id="fileName">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                  </div>
                  <TextInput
                    id="dropzone-file"
                    name="img"
                    type="file"
                    class="hidden"
                    @input="form.img = $event.target.files[0]"
                    @change="onFileChange"/>
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                      {{ form.progress.percentage }}%
                    </progress>
                    <InputError class="mt-2" :message="form.errors.img" />
              </label>
              </div>
                       <!-- <TextInput
                            type="file"
                            @input="form.img = $event.target.files[0]"
                            @change="onFileChange"
                       /> -->
                        <!-- <p id="fileName"></p> -->

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ایمیل
                                شما</label>
                            <input type="email" name="email" id="email" v-model="form.email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com" required="">
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام
                                شما</label>
                            <input type="text" name="name" id="name" placeholder="••••••••" v-model="form.name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">رمز
                                عبور</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                v-model="form.password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </div>
                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شماره
                                شما</label>
                            <input type="text" name="phone" id="phone" v-model="form.phoneNumber"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="09036132164">
                        </div>
                        <div class="flex items-end">
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-light text-gray-500 dark:text-gray-300 mr-5">جنسیت : </label>
                            </div>

                            <div class="flex flex-wrap">
                                <div class="flex items-center mr-4">
                                    <input id="red-radio" type="radio" value="woman" name="colored-radio"
                                        v-model="form.gender"
                                        class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="red-radio"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">خانم</label>
                                </div>

                                <div class="flex items-center mr-4">
                                    <input id="green-radio" type="radio" value="man" name="colored-radio"
                                        v-model="form.gender"
                                        class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="green-radio"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">آقا</label>
                                </div>
                            </div>
                        </div>

                        <button type="submite"
                            class="btn btn-primary">ذخیره</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
.personal-image {
    text-align: center;
}

.personal-image input[type="file"] {
    display: none;
}

.personal-figure {
    position: relative;
    width: 120px;
    height: 120px;
}

.personal-avatar {
    cursor: pointer;
    width: 120px;
    height: 120px;
    box-sizing: border-box;
    border-radius: 100%;
    border: 2px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
    transition: all ease-in-out .3s;
    margin-left: 10px;
}

.personal-avatar:hover {
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
}

.personal-figcaption {
    cursor: pointer;
    position: absolute;
    top: 0px;
    left: 10px;
    width: inherit;
    height: inherit;
    border-radius: 100%;
    opacity: 0;
    background-color: rgba(0, 0, 0, 0);
    transition: all ease-in-out .3s;
}

.personal-figcaption:hover {
    opacity: 1;
    background-color: rgba(0, 0, 0, .5);
}

.personal-figcaption>img {
    margin-top: 32.5px;
    width: 50px;
    height: 50px;
    margin-left: 10px;
}
</style>
