<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';






const article = useForm({
  search: '',
})

const summarize = useForm({
  search: '',
})

function onFileChange(event){
  var fileData =  event.target.files[0];
  var fileName = fileData.name;
  document.getElementById("fileName").innerHTML = fileName;
}

const form = useForm({
  title: '',
  summarize: '',
  article: '',
  img: ''
})


function submitSummarizeForm() {
  axios({

  method: 'post',
  url: '/create/'+summarize.search,

  method: 'get',
  url: '/api/chat/'+summarize.search,

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

  method: 'get',
  url: '/api/chat/'+article.search,

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
    form.post('/store', {
    });
};


</script>

<template>
  <Head title="ساخت پست" />


  <Layout></Layout>

  <br><br><br><br><br>

  <AuthenticatedLayout></AuthenticatedLayout>


  <div v-if="$page.props.flash.message">
        <div class="flex p-4 mb-4 w-11/12 ml-10 mt-2 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
          <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Info</span>
          <div>
            <span class="font-medium">
               {{ $page.props.flash.message }}
            </span>
          </div>
        </div>
  </div>





  <section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">پست جدید</h2>
      <form method="post" @submit.prevent="submit">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <!-- file input -->
              <div class="flex items-center justify-center w-11/12 mr-5 float-right mb-6">
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

              <div class="sm:col-span-2">
                  <InputError class="mt-2 ml-2" :message="form.errors.title" />
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">موضوع</label>
                  <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="موضوع را بنویس" v-model="form.title" required>
              </div>
              <div class="sm:col-span-2">
                  <InputError class="mt-2 p-2.5 w-11/12 mr-5 float-right" :message="form.errors.summarize" />
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">خلاصه متن</label>
                  <textarea  v-model="form.summarize" id="summarize" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="خلاصه متن را اینجا بنویس"></textarea>
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

                  <button type="submit" class="text-white absolute left-96 p-4 bottom-0.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-sm px-4">جستوجو</button>
                </div>
              </form>

              <div class="sm:col-span-2">
                  <InputError class="mt-2 p-2.5 w-11/12 mr-5 float-right" :message="form.errors.article" />
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">مقاله</label>
                  <textarea v-model="form.article" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="مقاله را اینجا بنویس"></textarea>
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

          </div>
          <button type="submit" class="btn btn-primary text-white">
              ارسال
          </button>
      </form>
  </div>
</section>

</template>

<style>
  * {
    font-family: Vazirmatn;
  }

</style>
