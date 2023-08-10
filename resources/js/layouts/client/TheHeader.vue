<template>
  <header class="bg-white">
    <div class="mx-auto flex max-w-screen-2xl items-center justify-between px-4 md:px-8">
      <RouterLink to="/" aria-label="logo">
        <img class="h-auto sm:w-14" src="../../../assets/images/logo/logo.svg" alt="logo" />
      </RouterLink>
      <nav class="hidden gap-12 lg:flex 2xl:ml-16">
        <RouterLink
          v-for="navLink in navLinks"
          :key="navLink"
          :to="navLink.link"
          class="text-lg font-semibold text-gray-600 transition duration-100 hover:text-emerald-500"
          active-class="!text-emerald-500"
        >
          {{ navLink.name }}
        </RouterLink>
      </nav>
      <div class="flex">
        <RouterLink
          to="/login"
          class="flex h-12 w-12 flex-col items-center justify-center gap-1.5 transition duration-100 hover:bg-gray-100 sm:h-20 sm:w-20 md:h-24 md:w-24"
          active-class="bg-gray-100"
        >
          <Icon class="h-6 w-6 text-gray-800" icon="solar:user-linear" />
          <span class="hidden text-xs font-semibold text-gray-500 sm:block">Account</span>
        </RouterLink>
        <RouterLink
          to="/cart"
          class="relative flex h-12 w-12 flex-col items-center justify-center gap-1.5 transition duration-100 hover:bg-gray-100 sm:h-20 sm:w-20 md:h-24 md:w-24"
        >
          <Icon class="h-6 w-6 text-gray-800" icon="heroicons:shopping-bag" />
          <span
            class="absolute top-5 right-7 h-5 w-5 rounded-full bg-emerald-500 text-center text-sm text-white"
          >
            0
          </span>
          <span class="hidden text-xs font-semibold text-gray-500 sm:block">Cart</span>
        </RouterLink>
        <button
          type="button"
          class="flex h-12 w-12 flex-col items-center justify-center gap-1.5 transition duration-100 hover:bg-gray-100 active:bg-gray-200 sm:h-20 sm:w-20 md:h-24 md:w-24 lg:hidden"
        >
          <Icon class="h-6 w-6 text-gray-800" icon="ri:menu-2-fill" />
          <span class="hidden text-xs font-semibold text-gray-500 sm:block">Menu</span>
        </button>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

const navLinks = ref([
  {
    name: 'Home',
    link: '/'
  },
  {
    name: 'Shop',
    link: '/shop'
  },
  {
    name: 'About',
    link: '/about'
  },
  {
    name: 'Contact',
    link: '/contact'
  }
])
</script>
