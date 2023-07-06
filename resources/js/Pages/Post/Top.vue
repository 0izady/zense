<script setup>
  import Layout from '@/Layouts/SearchLayout.vue';
  import { Head } from '@inertiajs/vue3';
  import moment from 'moment';

    function formatDate (value) {
        return moment(value).fromNow()
    };


 const tops = defineProps({
    tops: Object,
  });

function getPost(element, key) {
  axios.get(`/api/post/${key}`)
    .then(function (response) {
      document.getElementById(`summerize${element}`).innerHTML = response.data[0].summarize;
      document.getElementById(`image${element}`).src = response.data[0].img;
    })
    .catch(function (error) {
      // handle error
      console.log(error);
    })
}

</script>

<template>
  <Head title="جستوجو های برتر هفته" />

  <Layout></Layout>


<div id="vazir">
  <h1 class="text-2xl font-bold m-4">برترین پست های هفته</h1>
  <ul class="flex">
    <div v-if="tops.tops.length == 0">
        <h2 class="font-bold text-xl m-10">یه پست همچین پرطرفداری پیدا نشد</h2>
    </div>
    <div v-for="value in tops.tops">
      {{ getPost(value.id, value.key_word) }}
      <!-- <div class="m-5 mt-10 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <a href="#">
              <img class="rounded-t-lg w-full h-96" src="https://flowbite.com/docs/images/blog/image-1.jpg" alt="" :id="`image${value.id}`" />
          </a>
          <div class="p-5">
              <a href="#">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ value.key_word }}</h5>
              </a>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400" :id="`summerize${value.id}`">{{ result }}</p>
              <a :href="`/post/${value.key_word}`" class="btn btn-primary">
                  بیشتر بخوانید
                  <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </a>
          </div>
      </div> -->

      <div class="w-[360px] h-[480px] rounded-xl justify-start items-start inline-flex m-4">
            <div
              class="w-[360px] h-[480px] rounded-xl  border border-stone-300 flex-col justify-center items-center inline-flex">
              <div class="self-stretch grow shrink basis-0 flex-col justify-start items-center inline-flex">

                <div class="w-[360px] h-[188px] justify-center items-center inline-flex">
                  <img class="w-[360px] h-[188px] rounded-xl" :id="`image${value.id}`"/>
                </div>
                <div class="self-stretch h-[220px] p-4 flex-col justify-start items-start gap-8 flex">
                  <div class="self-stretch h-11 flex-col justify-start items-start flex">
                    <div class="w-[328px] text-zinc-900 text-[16px] font-normal leading-normal tracking-wide">{{
                      value.key_word }}</div>
                  </div>
                  <div class="self-stretch text-zinc-700 text-[14px] font-normal leading-tight tracking-wide" :id="`summerize${value.id}`">{{
                    result }}</div>
                  <div class="self-stretch justify-end items-start gap-2 inline-flex">

                    <a
                    :href="`/post/${value.key_word}`"
                      class="h-10 bg-orange-500 hover:bg-orange-600 rounded-[100px] flex-col justify-center items-center gap-2 inline-flex">
                      <div
                        class="self-stretch grow shrink basis-0 px-6 py-2.5 justify-center items-center gap-2 inline-flex">
                        <div class="text-center text-white text-[14px] font-medium leading-tight tracking-wide">بخوانید
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
      </div>

    </div>
  </ul>
</div>

</template>

<style>
 #vazir {
    font-family: Vazirmatn;
 }
</style>
