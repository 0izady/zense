<script setup>
import Layout from '@/Layouts/SearchLayout.vue';
import { Head } from '@inertiajs/vue3';
import moment from 'moment';
//   import Vue from 'vue'

function formatDate(value) {
  return moment(value).fromNow()
};

const tops = defineProps({
  tops: Object,
});

function getSearch(element, key) {
  axios.get(`/api/search/${key}`)
    .then(function (response) {
      document.getElementById(`summerize${element}`).innerHTML = response.data[0].summarize;
      document.getElementById(`image${element}`).src = response.data[0].img_src;
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
    <h1 class="text-2xl font-bold m-4">برترین سرچ های هفته</h1>
    <ul class="flex">
      <div v-if="tops.tops.length == 0">
        <h2 class="font-bold text-xl m-10">یه سرچ همچین پرطرفداری پیدا نشد</h2>
      </div>

      <div class="columns-3">
        <div v-for="value in tops.tops">
          <div class="w-[360px] h-[480px] rounded-xl justify-start items-start inline-flex m-4">
            <div
              class="w-[360px] h-[480px] rounded-xl  border border-stone-300 flex-col justify-center items-center inline-flex">
              <div class="self-stretch grow shrink basis-0 flex-col justify-start items-center inline-flex">

                <div class="w-[360px] h-[188px] justify-center items-center inline-flex">
                  <img class="w-[360px] h-[188px]" :src="value.img_src" />
                </div>
                <div class="self-stretch h-[220px] p-4 flex-col justify-start items-start gap-8 flex">
                  <div class="self-stretch h-11 flex-col justify-start items-start flex">
                    <div class="w-[328px] text-zinc-900 text-[16px] font-normal leading-normal tracking-wide">{{
                      value.key_word }}</div>
                  </div>
                  <div class="self-stretch text-zinc-700 text-[14px] font-normal leading-tight tracking-wide">{{
                    value.text }}</div>
                  <div class="self-stretch justify-end items-start gap-2 inline-flex">

                    <a
                      :href="`/search/${value.key_word}`"
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
      </div>



    </ul>
  </div>
</template>

<style>#vazir {
  font-family: Vazirmatn;
}
</style>
