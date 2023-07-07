<script setup>
import Layout from '@/Layouts/SearchLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="درباره ما" />
    <Layout></Layout>

    <!-- Container for demo purpose -->
<div class="container my-24 px-6 mx-auto">

<!-- Section: Design Block -->
<section class="mb-32 text-gray-800">

  <div class="relative overflow-hidden bg-no-repeat bg-cover"
    style="background-position: 50%; background-image: url('/img/conatct.jpg'); height: 300px;">
  </div>
  <div class="container text-gray-800 px-4 md:px-12">
    <div class="block rounded-lg shadow-lg py-10 md:py-12 px-2 md:px-6"
      style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8); backdrop-filter: blur(30px);">
      <div class="flex flex-wrap">

        <div class="grow-0 shrink-0 basis-auto w-full xl:w-7/12">
          <div class="flex flex-wrap">
            <div class="mb-12 grow-0 shrink-0 basis-auto w-full md:w-6/12 px-3 lg:px-6">
              <div class="flex items-start">
                <div class="shrink-0">
                  <div class="p-4 bg-blue-600 rounded-md shadow-md w-14 h-14 flex items-center justify-center">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="headset" class="w-5 text-white"
                      role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path fill="currentColor"
                        d="M192 208c0-17.67-14.33-32-32-32h-16c-35.35 0-64 28.65-64 64v48c0 35.35 28.65 64 64 64h16c17.67 0 32-14.33 32-32V208zm176 144c35.35 0 64-28.65 64-64v-48c0-35.35-28.65-64-64-64h-16c-17.67 0-32 14.33-32 32v112c0 17.67 14.33 32 32 32h16zM256 0C113.18 0 4.58 118.83 0 256v16c0 8.84 7.16 16 16 16h16c8.84 0 16-7.16 16-16v-16c0-114.69 93.31-208 208-208s208 93.31 208 208h-.12c.08 2.43.12 165.72.12 165.72 0 23.35-18.93 42.28-42.28 42.28H320c0-26.51-21.49-48-48-48h-32c-26.51 0-48 21.49-48 48s21.49 48 48 48h181.72c49.86 0 90.28-40.42 90.28-90.28V256C507.42 118.83 398.82 0 256 0z">
                      </path>
                    </svg>
                  </div>
                </div>
                <div class="grow ml-6">
                  <p class="font-bold mb-1">پشتیبانی</p>
                  <p class="text-gray-500">mo22ham29mad@gmail.com</p>
                  <p class="text-gray-500">9036132164</p>
                </div>
              </div>
            </div>
            <div class="mb-12 grow-0 shrink-0 basis-auto w-full md:w-6/12 px-3 lg:px-6">
              <div class="flex items-start">
                <div class="shrink-0">
                  <div class="p-4 bg-blue-600 rounded-md shadow-md w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin text-white"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  </div>
                </div>
                <div class="grow ml-6">
                  <p class="font-bold mb-1">محل دفتر</p>
                  <p class="text-gray-500">ایران،کردستان</p>
                  <p class="text-gray-500">9036132164</p>
                </div>
              </div>
            </div>
            <div class="mb-12 md:mb-0 grow-0 shrink-0 basis-auto w-full md:w-6/12 px-3 lg:px-6">
              <div class="flex align-start">
                <div class="shrink-0">
                  <div class="p-4 bg-blue-600 rounded-md shadow-md w-14 h-14 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-phone text-white" viewBox="0 0 16 16"> <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/> <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/> </svg>
                  </div>
                </div>
                <div class="grow ml-6">
                  <p class="font-bold mb-1">تماس</p>
                  <p class="text-gray-500"></p>
                  <p class="text-gray-500">+98 903-613-2164</p>
                </div>
              </div>
            </div>
            <div class="grow-0 shrink-0 basis-auto w-full md:w-6/12 px-3 lg:px-6">
              <div class="flex align-start">
                <div class="shrink-0">
                  <div class="p-4 bg-blue-600 rounded-md shadow-md w-14 h-14 flex items-center justify-center">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bug" class="w-5 text-white"
                      role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path fill="currentColor"
                        d="M511.988 288.9c-.478 17.43-15.217 31.1-32.653 31.1H424v16c0 21.864-4.882 42.584-13.6 61.145l60.228 60.228c12.496 12.497 12.496 32.758 0 45.255-12.498 12.497-32.759 12.496-45.256 0l-54.736-54.736C345.886 467.965 314.351 480 280 480V236c0-6.627-5.373-12-12-12h-24c-6.627 0-12 5.373-12 12v244c-34.351 0-65.886-12.035-90.636-32.108l-54.736 54.736c-12.498 12.497-32.759 12.496-45.256 0-12.496-12.497-12.496-32.758 0-45.255l60.228-60.228C92.882 378.584 88 357.864 88 336v-16H32.666C15.23 320 .491 306.33.013 288.9-.484 270.816 14.028 256 32 256h56v-58.745l-46.628-46.628c-12.496-12.497-12.496-32.758 0-45.255 12.498-12.497 32.758-12.497 45.256 0L141.255 160h229.489l54.627-54.627c12.498-12.497 32.758-12.497 45.256 0 12.496 12.497 12.496 32.758 0 45.255L424 197.255V256h56c17.972 0 32.484 14.816 31.988 32.9zM257 0c-61.856 0-112 50.144-112 112h224C369 50.144 318.856 0 257 0z">
                      </path>
                    </svg>
                  </div>
                </div>
                <div class="grow ml-6">
                  <p class="font-bold mb-1">گزارش باگ</p>
                  <p class="text-gray-500">mo22ham29mad@gmail.com</p>
                  <p class="text-gray-500">9036132164</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- Section: Design Block -->

</div>
<!-- Container for demo purpose -->
</template>
