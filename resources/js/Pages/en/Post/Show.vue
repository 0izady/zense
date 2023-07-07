<script setup>
import Layout from '@/Layouts/SearchLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';


const post = defineProps({
  post: Object,
  user: Object,
  created: Object,
  status: Boolean
});

const form = useForm({

})

const destroy = () => {
  form.delete(`/delete/${post.post.id}`, {

  });
};

</script>

<template>
  <Head :title="post.post.title" />
  <Layout></Layout>

  <br><br><br><br>

  <div v-if="$page.props.flash.message">
    <div class="alert alert-success">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span>{{ $page.props.flash.message }}</span>
    </div>
  </div>

  <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white">
    <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
      <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue">
        <header class="mb-4 lg:mb-6 not-format">
          <address class="flex items-center mb-6 not-italic">
            <div class="inline-flex items-center mr-3 text-sm text-gray-900">
              <div>
                <p href="#" rel="author" class="text-xl font-bold text-gray-900">{{ user.name }}</p>
                <p class="text-base font-light text-gray-500">{{ created }}</p>
              </div>
            </div>
          </address>
          <a :href="'/search/' + post.post.title" class="btn btn-secondary rounded-full">همین را سرچ کن</a>
          <br><br>
          <div v-if="status" class="flex flex-row mb-5">
            <a :href="'/edit/' + post.post.title + '/'" class="btn btn-primary rounded-full mr-5">
              ویرایش
            </a>
            <button @click="destroy(post.post.id)" class="btn btn-error rounded-full">
              حذف
            </button>
          </div>
          <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">{{ post.post.title }}
          </h1>
        </header>

        <p>{{ post.post.summarize }}</p>


        <figure>
          <img :src="'/' + post.post.img" alt="" class="my-8 rounded-lg">
          <!-- <figcaption>Digital art by Anonymous</figcaption> -->
        </figure>

        <p>{{ post.post.article }}</p>
      </article>

    </div>
  </main>

  <br><br>
</template>

<style>
* {
  font-family: Vazirmatn;
}
</style>
