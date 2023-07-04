<template>
  <div class="flex h-screen">
    <div class="m-auto text-center">
      <h1 class="mb-4 text-7xl font-extrabold tracking-tight text-emerald-600 lg:text-9xl">404</h1>
      <p class="mb-4 text-3xl font-bold tracking-tight text-slate-800 md:text-4xl">
        Something's missing.
      </p>
      <p class="mb-4 text-lg font-light text-gray-500">
        Sorry, we can't find that page. You'll find lots to explore on the home page.
      </p>
      <BaseButton mode="primary" size="lg" link="/dashboard" is-link>Back to Dashboard</BaseButton>
    </div>
  </div>
</template>

<script setup>
import BaseButton from '@/components/UI/button/BaseButton.vue'
</script>
