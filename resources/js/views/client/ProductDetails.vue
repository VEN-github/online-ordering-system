<template>
  <div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
      <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
        <div class="flex flex-col-reverse">
          <div class="mx-auto mt-6 w-full max-w-2xl lg:max-w-none">
            <div
              class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
              aria-orientation="horizontal"
              role="tablist"
            >
              <button
                v-for="(image, index) in galleryImages"
                :key="index"
                class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4"
                role="tab"
                type="button"
                @click="highlightImage = image"
              >
                <span class="sr-only">Angled view</span>
                <span class="absolute inset-0 overflow-hidden rounded-md">
                  <img
                    :src="image"
                    alt="Image Gallery"
                    class="h-full w-full object-contain object-center"
                  />
                </span>
                <span
                  class="pointer-events-none absolute inset-0 rounded-md ring-2 ring-offset-2"
                  :class="[highlightImage == image ? 'ring-emerald-500' : 'ring-transparent']"
                  aria-hidden="true"
                ></span>
              </button>
            </div>
          </div>
          <div class="aspect-h-1 aspect-w-1 w-full">
            <div id="tabs-1-panel-1" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
              <img
                :src="highlightImage"
                alt="Highlight Image"
                class="h-[395px] w-full object-contain object-center sm:rounded-lg"
              />
            </div>
          </div>
        </div>
        <div class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0">
          <h1 class="text-3xl font-bold tracking-tight text-gray-900">Title Here</h1>
          <div class="mt-3">
            <h2 class="sr-only">Product information</h2>
            <p class="gap-2 text-3xl tracking-tight text-gray-900">$122</p>
            <p class="flex items-center gap-2 text-3xl tracking-tight text-gray-900">
              <span>$122</span>
              <span class="text-lg text-red-500 line-through">$12</span>
            </p>
          </div>
          <div class="mt-6">
            <h3 class="sr-only">Description</h3>
            <div class="space-y-6 text-base text-gray-700">
              <p>Description Here</p>
            </div>
          </div>
          <div class="mt-6">
            <div class="mt-10">
              <BaseButton mode="primary" size="xl" class="max-w-xs sm:w-full">
                <Icon class="h-5 w-5 text-white" icon="heroicons:shopping-bag" />
                <span> Add to Cart </span>
              </BaseButton>
            </div>
          </div>
          <section aria-labelledby="details-heading" class="mt-12">
            <h2 id="details-heading" class="sr-only">Additional details</h2>
            <div class="divide-y divide-gray-200 border-t">
              <div>
                <h3>
                  <button
                    type="button"
                    class="group relative flex w-full items-center justify-between py-6 text-left"
                    @click="toggleShippingDetails"
                  >
                    <span
                      class="text-sm font-medium"
                      :class="[showShippingDetails ? 'text-emerald-600' : 'text-gray-900']"
                      >Shipping</span
                    >
                    <span class="ml-6 flex items-center">
                      <svg
                        class="h-6 w-6 text-gray-400 group-hover:text-gray-500"
                        :class="[showShippingDetails ? 'hidden' : 'block']"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 4.5v15m7.5-7.5h-15"
                        />
                      </svg>
                      <svg
                        class="block h-6 w-6 text-emerald-400 group-hover:text-emerald-500"
                        :class="[showShippingDetails ? 'block' : 'hidden']"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                      >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                      </svg>
                    </span>
                  </button>
                </h3>
                <div v-if="showShippingDetails" class="px-6 text-sm">
                  <ul role="list" class="list-disc">
                    <li>Multiple strap configurations</li>
                    <li>Spacious interior with top zip</li>
                    <li>Leather handle and tabs</li>
                    <li>Interior dividers</li>
                    <li>Stainless strap loops</li>
                    <li>Double stitched construction</li>
                    <li>Water-resistant</li>
                  </ul>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

import BaseButton from '@/components/UI/button/BaseButton.vue'

const props = defineProps({
  slug: {
    type: String,
    default() {
      return ''
    }
  }
})

const highlightImage = ref(
  'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'
)
const galleryImages = ref([
  'https://images.unsplash.com/photo-1592078615290-033ee584e267?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=764&q=80',
  'https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80',
  'https://plus.unsplash.com/premium_photo-1678402545080-2353b489c0c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'
])
const showShippingDetails = ref(false)

onMounted(() => {
  console.log(props.slug)
})

function toggleShippingDetails() {
  showShippingDetails.value = !showShippingDetails.value
}
</script>
