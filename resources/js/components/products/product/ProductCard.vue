<template>
  <div>
    <a
      href="#"
      class="group relative mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3"
    >
      <img
        src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?auto=format&q=75&fit=crop&crop=top&w=600&h=700"
        loading="lazy"
        alt="Photo by Austin Wade"
        class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
      />

      <div class="absolute left-0 bottom-2 flex gap-2">
        <span
          class="rounded-r-lg bg-red-500 px-3 py-1.5 text-sm font-semibold uppercase tracking-wider text-white"
        >
          -50%
        </span>
        <span
          class="rounded-lg bg-white px-3 py-1.5 text-sm font-bold uppercase tracking-wider text-gray-800"
        >
          New
        </span>
      </div>
    </a>
    <div class="flex items-start justify-between gap-2 px-2">
      <div class="flex flex-col">
        <a
          href="#"
          class="text-lg font-bold text-gray-800 transition duration-100 hover:text-gray-500 lg:text-xl"
        >
          Fancy Outfit
        </a>
        <span class="text-gray-500">by Fancy Brand</span>
      </div>
      <div class="flex flex-col items-end">
        <span class="font-bold text-gray-600 lg:text-lg">$19.99</span>
        <span class="text-sm text-red-500 line-through">$39.99</span>
      </div>
    </div>
    <div class="mt-2 flex flex-col justify-between gap-2 sm:flex-row">
      <BaseButton mode="outline-default" class="order-2 sm:order-1" @click="toggleProductQuickView">
        <Icon class="h-6 w-6 text-gray-800" icon="carbon:view" />
        <span> Quick View </span>
      </BaseButton>
      <BaseButton mode="primary" class="order-1 sm:order-2">
        <Icon class="h-6 w-6 text-white" icon="heroicons:shopping-bag" />
        <span> Add to Cart </span>
      </BaseButton>
    </div>
  </div>
  <ProductQuickView
    :is-show="showProductQuickView"
    size="2xl"
    @on-close="showProductQuickView = false"
  />
</template>

<script setup>
import { ref } from 'vue'

import BaseButton from '@/components/UI/button/BaseButton.vue'
import ProductQuickView from './ProductQuickView.vue'

const showProductQuickView = ref(false)

function toggleProductQuickView() {
  showProductQuickView.value = !showProductQuickView.value
}
</script>
