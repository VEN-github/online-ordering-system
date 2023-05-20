<template>
  <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
    <div class="flex h-16 shrink-0 items-center">
      <img class="h-8 w-auto" src="../../../assets/images/logo.svg" alt="Logo" />
    </div>
    <nav class="flex flex-1 flex-col">
      <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
          <ul role="list" class="-mx-2 space-y-1">
            <li v-for="list in lists" :key="list">
              <RouterLink
                :to="list.link"
                class="sidebar-link group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50"
              >
                <Icon :icon="list.icon" class="h-6 w-6 shrink-0 text-gray-400" />
                {{ list.name }}
              </RouterLink>
            </li>
            <!-- <li>
              <div>
                <button
                  type="button"
                  class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50"
                  aria-controls="sub-menu-1"
                  aria-expanded="false"
                  @click="isOpen = !isOpen"
                >
                  <svg
                    class="h-6 w-6 shrink-0 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"
                    />
                  </svg>
                  Teams
                  <Icon
                    v-if="!isOpen"
                    icon="material-symbols:chevron-right"
                    class="ml-auto h-5 w-5 shrink-0 text-gray-400"
                  />
                  <Icon
                    v-else
                    icon="mdi:chevron-down"
                    class="ml-auto h-5 w-5 shrink-0 text-gray-400"
                  />
                </button>
                <ul id="sub-menu-1" class="mt-1 px-2" :class="{ hidden: !isOpen }">
                  <li>
                    <a
                      href="#"
                      class="block rounded-md py-2 pr-2 pl-9 text-sm leading-6 text-gray-700 hover:bg-gray-50"
                    >
                      Engineering
                    </a>
                  </li>
                  <li>
                    <a
                      href="#"
                      class="block rounded-md py-2 pr-2 pl-9 text-sm leading-6 text-gray-700 hover:bg-gray-50"
                    >
                      Human Resources
                    </a>
                  </li>
                  <li>
                    <a
                      href="#"
                      class="block rounded-md py-2 pr-2 pl-9 text-sm leading-6 text-gray-700 hover:bg-gray-50"
                    >
                      Customer Success
                    </a>
                  </li>
                </ul>
              </div>
            </li> -->
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

// const isOpen = ref(false)
const lists = ref([
  {
    name: 'Dashboard',
    link: '/dashboard',
    icon: 'mdi:monitor-dashboard'
  },
  {
    name: 'Categories',
    link: '/categories',
    icon: 'fluent-mdl2:product-variant'
  },
  {
    name: 'Products',
    link: '/products',
    icon: 'streamline:money-cashier-tag-codes-tags-tag-product-label'
  },
  {
    name: 'Supplier',
    link: '/supplier',
    icon: 'mdi:truck-outline'
  },
  {
    name: 'FAQs',
    link: '/faqs',
    icon: 'streamline:interface-help-question-circle-circle-faq-frame-help-info-mark-more-query-question'
  }
])
</script>
