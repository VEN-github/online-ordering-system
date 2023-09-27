<template>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <main class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Shopping Cart</h1>
      <CartList v-if="cartItems.length > 0" :cart-items="cartItems" />
      <div v-else class="mt-12 flex flex-col items-center justify-center gap-4">
        <img
          class="w-96 max-w-full"
          src="../../../assets/images/illustrations/empty-state.svg"
          alt="Empty State"
        />
        <p class="text-lg font-semibold text-slate-800">You cart is empty.</p>
        <BaseButton mode="primary" size="xl" is-link link="/shop">Shop Now</BaseButton>
      </div>
    </main>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useProductStore } from '@/store/products/product'

import CartList from '@/components/cart/CartList.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const productStore = useProductStore()

const cartItems = computed(() => {
  return productStore.cartItems
})
</script>
