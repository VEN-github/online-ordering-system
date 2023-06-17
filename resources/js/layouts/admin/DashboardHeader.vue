<template>
  <div
    class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8"
  >
    <button
      type="button"
      class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
      @click="emit('toggleSidebar')"
    >
      <span class="sr-only">Open sidebar</span>
      <Icon icon="solar:hamburger-menu-outline" class="h-6 w-6" />
    </button>
    <div class="flex flex-1 justify-end gap-x-4 self-stretch lg:gap-x-6">
      <div class="flex items-center gap-x-4 lg:gap-x-6">
        <div class="relative">
          <button
            type="button"
            class="profile-menu -m-1.5 flex items-center p-1.5"
            @click="toggleMenu = !toggleMenu"
          >
            <span class="sr-only">Open user menu</span>
            <BaseAvatar
              v-if="loggedAdmin?.avatar"
              :avatar="loggedAdmin?.avatar"
              size="sm"
              rounded
            />
            <AvatarInitials v-else :initials="loggedAdmin" size="sm" rounded />
            <span class="hidden lg:flex lg:items-center">
              <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">
                {{ loggedAdmin?.first_name }} {{ loggedAdmin?.last_name }}
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
                to="/profile"
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
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { RouterLink, useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth/auth'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import BaseAvatar from '@/components/UI/avatar/BaseAvatar.vue'
import AvatarInitials from '@/components/UI/avatar/AvatarInitials.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const emit = defineEmits(['toggleSidebar'])

const router = useRouter()
const authStore = useAuthStore()
const toggleMenu = ref(false)

const loggedAdmin = computed(() => {
  return authStore.getLoggedAdmin
})

watch(toggleMenu, (value) => {
  if (value) document.addEventListener('click', detectClickOutside)
})

function detectClickOutside(event) {
  if (!event.target.closest('.profile-menu')) toggleMenu.value = false
}

async function logout() {
  try {
    await authStore.adminLogout()
    router.replace('/admin/login')
    authStore.$reset()
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
