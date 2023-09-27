<template>
  <section
    aria-labelledby="summary-heading"
    class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8"
  >
    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>
    <p class="text-sm text-gray-600">Shipping will be calculated at checkout.</p>
    <dl class="mt-6">
      <div class="flex items-center justify-between border-t border-gray-200 pt-4">
        <dt class="text-base font-medium text-gray-900">Subtotal</dt>
        <dd class="text-base font-medium text-gray-900">{{ subtotal }}</dd>
      </div>
    </dl>
    <div class="mt-6">
      <BaseButton
        v-if="isUserAuthenticated"
        class="px-4 py-3 text-base"
        mode="primary"
        size="xl"
        link="/checkout"
        is-link
        is-full
      >
        Checkout
      </BaseButton>
      <BaseButton
        v-else
        class="px-4 py-3 text-base"
        mode="primary"
        size="xl"
        link="/login?page=cart"
        is-link
        is-full
      >
        Checkout
      </BaseButton>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'
import { useAuthStore } from '@/store/auth/auth'
import { useProductStore } from '@/store/products/product'

import BaseButton from '@/components/UI/button/BaseButton.vue'

const authStore = useAuthStore()
const productStore = useProductStore()

const subtotal = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(productStore.getCartItemsTotalPrice)
})

const isUserAuthenticated = computed(() => {
  return authStore.isUserAuthenticated
})
</script>
