<template>
  <div v-if="isOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/80"></div>
    <div class="fixed inset-0 flex">
      <div class="relative mr-16 flex w-full max-w-xs flex-1">
        <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
          <button type="button" class="-m-2.5 p-2.5" @click="toggleSidebar">
            <span class="sr-only">Close sidebar</span>
            <Icon icon="ph:x-circle-duotone" class="h-8 w-8 text-white hover:text-slate-200" />
          </button>
        </div>
        <TheSidebar />
      </div>
    </div>
  </div>
  <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
    <TheSidebar />
  </div>
  <div class="lg:pl-72">
    <DashboardHeader @toggle-sidebar="toggleSidebar" />
    <main class="py-10">
      <div class="px-4 sm:px-6 lg:px-8"><RouterView /></div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { RouterView } from 'vue-router'

import TheSidebar from './TheSidebar.vue'
import DashboardHeader from './DashboardHeader.vue'

const isOpen = ref(false)

function toggleSidebar() {
  isOpen.value = !isOpen.value
}
</script>
