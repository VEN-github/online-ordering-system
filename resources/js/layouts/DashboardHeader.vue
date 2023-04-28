<template>
  <div
    class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8"
  >
    <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="toggleSidebar">
      <span class="sr-only">Open sidebar</span>
      <Icon icon="solar:hamburger-menu-outline" class="h-6 w-6" />
    </button>
    <div class="flex flex-1 justify-end gap-x-4 self-stretch lg:gap-x-6">
      <div class="flex items-center gap-x-4 lg:gap-x-6">
        <div class="relative">
          <button
            id="user-menu-button"
            type="button"
            class="-m-1.5 flex items-center p-1.5"
            aria-expanded="false"
            aria-haspopup="true"
            @click="toggleMenu = !toggleMenu"
          >
            <span class="sr-only">Open user menu</span>
            <img
              class="h-8 w-8 rounded-full bg-gray-50"
              :src="loggedAdmin?.admin?.avatar"
              alt="Admin Avatar"
            />
            <span class="hidden lg:flex lg:items-center">
              <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">
                {{ loggedAdmin?.admin?.first_name }} {{ loggedAdmin?.admin?.last_name }}
              </span>
              <Icon icon="tabler:chevron-down" class="ml-2 h-5 w-5 text-gray-400" />
            </span>
          </button>
          <div
            v-if="toggleMenu"
            class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="user-menu-button"
            tabindex="-1"
          >
            <a
              id="user-menu-item-0"
              href="#"
              class="block px-3 py-1 text-sm leading-6 text-gray-900"
              role="menuitem"
              tabindex="-1"
            >
              Your profile
            </a>
            <a
              id="user-menu-item-1"
              href="#"
              class="block px-3 py-1 text-sm leading-6 text-gray-900"
              role="menuitem"
              tabindex="-1"
              @click="logout"
            >
              Logout
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth'

const emit = defineEmits(['toggleSidebar'])

const router = useRouter()
const store = useAuthStore()
const toggleMenu = ref(false)

const loggedAdmin = computed(() => {
  return store.getLoggedAdmin
})

function toggleSidebar() {
  emit('toggleSidebar')
}

async function logout() {
  try {
    const token = loggedAdmin.value.token
    await store.adminLogout(token)
    router.replace('/admin/login')
  } catch (error) {
    console.error(error)
  }
}
</script>
