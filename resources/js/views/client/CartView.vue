<template>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <main class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Shopping Cart</h1>
      <form
        v-if="cartItems.length > 0"
        class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16"
      >
        <section aria-labelledby="cart-heading" class="lg:col-span-7">
          <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>
          <ul
            role="list"
            class="divide-y divide-gray-200 border-b border-t border-gray-200 last:border-none"
          >
            <li v-for="item in cartItems" :key="item.id" class="flex py-6 sm:py-10">
              <div class="flex-shrink-0">
                <img
                  v-if="item.highlight_image"
                  :src="item.highlight_image"
                  alt="Cart Item image"
                  class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48"
                />
                <img
                  v-else
                  src="../../../assets/images/no-image.png"
                  alt="No image"
                  class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48"
                />
              </div>
              <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                  <div>
                    <div class="flex justify-between">
                      <h3 class="text-sm font-medium text-gray-700">
                        {{ item.name }}
                      </h3>
                    </div>
                    <div class="mt-1 flex text-sm">
                      <p class="text-gray-500">Sienna</p>
                      <p class="ml-4 border-l border-gray-200 pl-4 text-gray-500">Large</p>
                    </div>
                    <p v-if="!item.discounted_price" class="mt-1 text-sm font-medium text-gray-900">
                      {{ formattedPrice(item.orig_price) }}
                    </p>
                    <p v-else class="mt-1 text-sm font-medium">
                      <span class="text-gray-900">{{ formattedPrice(item.discounted_price) }}</span>
                      <span class="text-red-500 line-through">
                        {{ formattedPrice(item.orig_price) }}
                      </span>
                    </p>
                  </div>
                  <div class="mt-4 sm:mt-0 sm:pr-9">
                    <label for="quantity-0" class="sr-only">Quantity, Basic Tee</label>
                    <select
                      id="quantity-0"
                      name="quantity-0"
                      class="max-w-full rounded-md border border-gray-300 py-1.5 text-left text-base font-medium leading-5 text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                    >
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                    </select>
                    <div class="absolute right-0 top-0">
                      <button
                        type="button"
                        class="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500"
                        @click="removeItem(item.id)"
                      >
                        <span class="sr-only">Remove</span>
                        <Icon icon="material-symbols:delete-outline" class="h-5 w-5" />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </section>
        <section
          aria-labelledby="summary-heading"
          class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8"
        >
          <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>
          <p class="text-sm text-gray-600">Shipping will be calculated at checkout.</p>
          <dl class="mt-6">
            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
              <dt class="text-base font-medium text-gray-900">Subtotal</dt>
              <dd class="text-base font-medium text-gray-900">{{ formattedPrice(subtotal) }}</dd>
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
      </form>
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
import { useAuthStore } from '@/store/auth/auth'
import { useProductStore } from '@/store/products/product'

import BaseButton from '@/components/UI/button/BaseButton.vue'

const authStore = useAuthStore()
const productStore = useProductStore()

const cartItems = computed(() => {
  return productStore.cartItems
})

const subtotal = computed(() => {
  return productStore.getCartItemsTotalPrice
})

const isUserAuthenticated = computed(() => {
  return authStore.isUserAuthenticated
})

function formattedPrice(price) {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(price)
}

function removeItem(id) {
  productStore.removeFromCart(id)
}
</script>
