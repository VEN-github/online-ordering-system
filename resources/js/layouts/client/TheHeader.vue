<template>
  <header class="bg-white">
    <Transition name="fade-menu" mode="out-in">
      <div v-show="showSideMenu" class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black bg-opacity-25"></div>
        <div class="fixed inset-0 z-40 flex">
          <div
            class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl"
          >
            <div class="flex items-center justify-between px-4">
              <h2 class="text-lg font-medium text-gray-900">Menu</h2>
              <button
                type="button"
                class="relative -mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                @click="showSideMenu = false"
              >
                <span class="absolute -inset-0.5"></span>
                <span class="sr-only">Close menu</span>
                <svg
                  class="h-6 w-6"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            <form class="mt-4 border-t border-gray-200">
              <h3 class="sr-only">Links</h3>
              <ul role="list" class="space-y-4 px-4 py-3 font-medium text-gray-900">
                <li v-for="navLink in navLinks" :key="navLink">
                  <RouterLink
                    :to="navLink.link"
                    class="text-lg font-semibold text-gray-600 transition duration-100 hover:text-emerald-500"
                    active-class="!text-emerald-500"
                    @click="showSideMenu = false"
                  >
                    {{ navLink.name }}
                  </RouterLink>
                </li>
              </ul>
            </form>
          </div>
        </div>
      </div>
    </Transition>
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
      <div class="flex gap-2">
        <RouterLink
          v-if="!isUserAuthenticated"
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
            class="absolute top-[7%] right-[7%] h-5 w-5 rounded-full bg-emerald-500 text-center text-sm text-white sm:top-5 sm:right-7"
          >
            {{ cartItemsNumber }}
          </span>
          <span class="hidden text-xs font-semibold text-gray-500 sm:block">Cart</span>
        </RouterLink>
        <div v-if="isUserAuthenticated" class="relative self-center">
          <button
            type="button"
            class="profile-menu -m-1.5 flex items-center p-1.5"
            @click="toggleMenu = !toggleMenu"
          >
            <span class="sr-only">Open user menu</span>
            <BaseAvatar v-if="loggedUser?.avatar" :avatar="loggedUser?.avatar" size="sm" rounded />
            <AvatarInitials v-else :initials="loggedUser" size="sm" rounded />
            <span class="hidden lg:flex lg:items-center">
              <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">
                {{ loggedUser?.first_name }} {{ loggedUser?.last_name }}
              </span>
              <Icon icon="tabler:chevron-down" class="ml-2 h-5 w-5 text-gray-400" />
            </span>
          </button>
          <Transition name="dropdown">
            <div
              v-if="toggleMenu"
              class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right space-y-1.5 rounded-md bg-white p-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
            >
              <RouterLink
                to="/user-profile"
                class="inline-flex w-full items-center gap-x-2 rounded-md p-2 font-semibold leading-6 text-gray-700 hover:bg-gray-50"
              >
                <Icon icon="ph:user-bold" />
                Profile
              </RouterLink>
              <div class="my-4 h-px bg-slate-200"></div>
              <BaseButton is-full @click="logout">
                <Icon icon="material-symbols:logout-rounded" />
                Logout
              </BaseButton>
            </div>
          </Transition>
        </div>
        <button
          type="button"
          class="flex h-12 w-12 flex-col items-center justify-center gap-1.5 transition duration-100 hover:bg-gray-100 active:bg-gray-200 sm:h-20 sm:w-20 md:h-24 md:w-24 lg:hidden"
          @click="showSideMenu = true"
        >
          <Icon class="h-6 w-6 text-gray-800" icon="ri:menu-2-fill" />
          <span class="hidden text-xs font-semibold text-gray-500 sm:block">Menu</span>
        </button>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { RouterLink } from 'vue-router'
import { useAuthStore } from '@/store/auth/auth'
import { useProductStore } from '@/store/products/product'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import BaseAvatar from '@/components/UI/avatar/BaseAvatar.vue'
import AvatarInitials from '@/components/UI/avatar/AvatarInitials.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const authStore = useAuthStore()
const productStore = useProductStore()
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
const toggleMenu = ref(false)
const showSideMenu = ref(false)

const isUserAuthenticated = computed(() => {
  return authStore.isUserAuthenticated
})

const loggedUser = computed(() => {
  return authStore.getLoggedUser
})

const cartItemsNumber = computed(() => {
  return productStore.getCartItemsTotal
})

watch(toggleMenu, (value) => {
  if (value) document.addEventListener('click', detectClickOutside)
})

function detectClickOutside(event) {
  if (!event.target.closest('.profile-menu')) toggleMenu.value = false
}

async function logout() {
  try {
    await authStore.userLogout()
  } catch ({ message }) {
    toast(message, {
      type: 'error',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_RIGHT,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}
</script>
