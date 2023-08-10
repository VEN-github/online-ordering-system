<template>
  <div>
    <RouterLink
      :to="`/product/${product.slug}`"
      class="group relative mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3"
    >
      <img
        v-if="product.highlight_image"
        :src="product.highlight_image"
        loading="lazy"
        :alt="product.name"
        class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
      />
      <img
        v-else
        src="../../../../assets/images/no-image.png"
        loading="lazy"
        alt="No image available"
        class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
      />
    </RouterLink>
    <div class="flex items-start justify-between gap-2 px-2">
      <div class="flex flex-col">
        <RouterLink
          :to="`/product/${product.slug}`"
          class="text-base font-bold text-gray-800 transition duration-100 hover:text-gray-500"
        >
          {{ product.name }}
        </RouterLink>
      </div>
      <div v-if="product.discounted_price" class="flex flex-col items-end">
        <span class="font-bold text-gray-600 lg:text-lg">{{ formattedDiscountedPrice }}</span>
        <span class="text-sm text-red-500 line-through">{{ formattedPrice }}</span>
      </div>
      <div v-else class="flex flex-col items-end">
        <span class="font-bold text-gray-600 lg:text-lg">{{ formattedPrice }}</span>
        <span class="pointer-events-none text-sm opacity-0">N/A</span>
      </div>
    </div>
    <!-- <div class="mt-2 flex flex-col justify-between gap-2 sm:flex-row">
      <BaseButton mode="outline-default" class="order-2 sm:order-1" @click="toggleProductQuickView">
        <Icon class="h-6 w-6 text-gray-800" icon="carbon:view" />
        <span> Quick View </span>
      </BaseButton>
      <BaseButton mode="primary" class="order-1 sm:order-2">
        <Icon class="h-6 w-6 text-white" icon="heroicons:shopping-bag" />
        <span> Add to Cart </span>
      </BaseButton>
    </div> -->
  </div>
  <!-- <ProductQuickView
    :is-show="showProductQuickView"
    size="2xl"
    @on-close="showProductQuickView = false"
  /> -->
</template>

<script setup>
import { computed } from 'vue'
import { RouterLink } from 'vue-router'

// import BaseButton from '@/components/UI/button/BaseButton.vue'
// import ProductQuickView from './ProductQuickView.vue'

const props = defineProps({
  product: {
    type: Object,
    default() {
      return {}
    }
  }
})

// const showProductQuickView = ref(false)

const formattedPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(props.product?.orig_price)
})

const formattedDiscountedPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(props.product?.discounted_price)
})

// function toggleProductQuickView() {
//   showProductQuickView.value = !showProductQuickView.value
// }
</script>
