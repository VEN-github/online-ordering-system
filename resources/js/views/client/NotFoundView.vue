<template>
  <div class="flex min-h-full flex-col bg-white pb-12 pt-16">
    <main class="mx-auto flex w-full max-w-7xl flex-grow flex-col justify-center px-6 lg:px-8">
      <div class="flex flex-shrink-0 justify-center">
        <RouterLink to="/" class="inline-flex">
          <span class="sr-only">Your Company</span>
          <img class="h-12 w-auto" src="../../../assets/images/logo/logo.svg" alt="Logo" />
        </RouterLink>
      </div>
      <div class="py-16">
        <div class="text-center">
          <p class="text-base font-semibold text-emerald-600">404</p>
          <h1 class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
            Page not found.
          </h1>
          <p class="mt-2 text-base text-gray-500">
            Sorry, we couldn’t find the page you’re looking for.
          </p>
          <div class="mt-6">
            <button
              type="button"
              class="text-base font-medium text-emerald-600 hover:text-emerald-500"
              @click="goBack"
            >
              Go back
              <span aria-hidden="true"> &rarr;</span>
            </button>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { RouterLink, useRouter } from 'vue-router'

const router = useRouter()

onMounted(() => {
  document.documentElement.classList.add('h-full')
  document.body.classList.add('h-full')
  document.getElementById('app').classList.add('h-full')
})

function goBack() {
  router.go(-1)
}
</script>
