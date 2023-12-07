<template>
  <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
    <div class="flex h-16 shrink-0 items-center">
      <img class="h-8 w-auto" src="../../../assets/images/logo/logo.svg" alt="Logo" />
    </div>
    <nav class="flex flex-1 flex-col">
      <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
          <ul role="list" class="-mx-2 space-y-1">
            <li v-for="list in lists" :key="list">
              <RouterLink
                :to="list.link"
                class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50"
                active-class="bg-gray-50"
              >
                <Icon :icon="list.icon" class="h-6 w-6 shrink-0 text-gray-400" />
                {{ list.name }}
              </RouterLink>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

const lists = ref([
  {
    name: 'Dashboard',
    link: '/dashboard',
    icon: 'mdi:monitor-dashboard'
  },
  {
    name: 'Orders',
    link: '/admin/orders',
    icon: 'material-symbols:shopping-bag-outline'
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
    name: 'Inventory',
    link: '/inventory',
    icon: 'material-symbols:inventory'
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
