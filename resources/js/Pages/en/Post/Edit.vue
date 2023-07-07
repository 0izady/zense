z<script setup>
import Layout from '@/Layouts/SearchLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const post = defineProps({
   post: Object,
});

const summarize = useForm({
  search: '',
})

const article = useForm({
  search: '',
})

function onFileChange(event){
  var fileData =  event.target.files[0];
  var fileName = fileData.name;
  document.getElementById("fileName").innerHTML = fileName;
  console.log(form);
}

const form = useForm(post.post);


function submitSummarizeForm() {
  axios({
  method: 'post',
  url: '/create/'+summarize.search,
})
.then(function (response) {
    let text_area = document.getElementById('summarize');
    form.summarize = text_area.value + ' ' + response.data;
  })
  .catch(function (error) {
    console.error(error);
  })
}

function submitArticleForm() {
  axios({
  method: 'post',
  url: '/create/'+article.search,
})
.then(function (response) {
    let text_area = document.getElementById('summarize');
    form.article = text_area.value + ' ' + response.data;
  })
  .catch(function (error) {
    console.error(error);
  })
}

const submit = () => {
  form.post(`/update/${post.post.id}/`, {
    _method: 'put',
  });
};


</script>

<template>
  <Head title="ساخت پست" />

  <Layout></Layout>

  <br><br><br><br><br>

  <div v-if="$page.props.flash.message">
    <div class="alert alert-success">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span>{{ $page.props.flash.message }}</span>
    </div>
  </div>

  <form method="post" @submit.prevent="submit">

    <!-- title -->
    <InputError class="mt-2 ml-2" :message="form.errors.title" />
    <div class="m-8 ml-10">
      <label for="website" class="block mb-2 text-sm font-medium text-gray-900">عنوان موضوع</label>
      <input type="text" id="website" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-11/12 p-2.50y-600r-gray-400-blue-500er-blue-500" placeholder="مثلا فیریک" v-model="form.title" required>
    </div>

    <!-- image upload -->
    <div class="flex items-center justify-center w-11/12 ml-5 float-left mb-6">
          <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-34 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                  <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                  <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">برای بارگذاری کلیک کنید</span> یا فایل را به اینجا بکشید</p>
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

    <br><br><br><br><br><br><br><br>


    <div class="ml-10 mb-5">
      <InputError class="mt-2 p-2.5 w-11/12 mr-5 float-right" :message="form.errors.summarize" />
      <label for="message" class="block mb-2 text-sm font-medium text-gray-900">خلاصه ای در مورد موضوع</label>
      <textarea v-model="form.summarize" id="summarize" rows="4" class="block p-2.5 w-10/12 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-5000y-600r-gray-400-blue-500er-blue-500" placeholder="خلاصه ای در مورد موضوع"></textarea>
    </div>

    <form v-on:submit.prevent="submitSummarizeForm" method="post">
      <div class="relative ml-10 mb-5">
        <input
          type="search"
          id="default-search"
          v-model="summarize.search"
          class="block w-96 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-l-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-5000y-600r-gray-400-blue-500er-blue-500"
          placeholder="هر چیزی که میخواهی بگو تا آن را در متنت توضیح دهیم"
          required
        >

        <button type="submit" class="text-white absolute left-96 p-4 bottom-0.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-sm px-4 bg-blue-700">جستوجو</button>
      </div>
    </form>

    <div class="ml-10 mb-5">
      <InputError class="mt-2 p-2.5 w-11/12 mr-5 float-right" :message="form.errors.article" />
      <label for="message" class="block mb-2 text-sm font-medium text-gray-900">مقاله ای در مورد موضوع</label>
      <textarea v-model="form.article" rows="4" class="block p-2.5 w-10/12 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-5000y-600r-gray-400-blue-500er-blue-500" placeholder="مقاله ای در مورد موضوع"></textarea>
    </div>

    <form v-on:submit.prevent="submitArticleForm" method="post">
      <div class="relative ml-10 mb-5">
        <input
          type="search"
          id="default-search"
          v-model="article.search"
          class="block w-96 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-l-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-5000y-600r-gray-400-blue-500er-blue-500"
          placeholder="هر چیزی که میخواهی بگو تا آن را در متنت توضیح دهیم"
          required
        >

        <button type="submit" class="text-white absolute left-96 p-4 bottom-0.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-sm px-4 bg-blue-700">جستوجو</button>
      </div>
    </form>

    <button type="submit" class="ml-10 mb-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      تمام شد
    </button>


  </form>
</template>

<style>
  * {
    font-family: Vazirmatn;
  }
</style>
