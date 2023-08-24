<template>
  <main class="relative lg:min-h-full">
    <div class="h-80 overflow-hidden lg:absolute lg:h-full lg:w-1/2 lg:pr-4 xl:pr-12">
      <img
        src="https://images.unsplash.com/photo-1618220179428-22790b461013?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=627&q=80"
        alt="TODO"
        class="h-full w-full object-cover object-center"
      />
    </div>
    <div>
      <div
        class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8 lg:py-32 xl:gap-x-24"
      >
        <div class="lg:col-start-2">
          <h1 class="text-sm font-medium text-emerald-600">Order successful</h1>
          <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
            Thanks for ordering
          </p>
          <p class="mt-2 text-base text-gray-500">
            We appreciate your order, we’re currently processing it. So hang tight and we’ll send
            you confirmation very soon!
          </p>
          <dl class="mt-16 text-sm font-medium">
            <dt class="text-gray-900">Order number</dt>
            <dd class="mt-2 text-emerald-600">#{{ order.ref_id }}</dd>
          </dl>
          <ul
            role="list"
            class="mt-6 divide-y divide-gray-200 border-t border-gray-200 text-sm font-medium text-gray-500"
          >
            <li v-for="item in order.cartItems" :key="item.id" class="flex space-x-6 py-6">
              <img
                v-if="item.highlight_image"
                :src="item.highlight_image"
                alt="Item Image"
                class="h-24 w-24 flex-none rounded-md bg-gray-100 object-cover object-center"
              />
              <img
                v-else
                src="../../../assets/images/no-image.png"
                alt="No image"
                class="h-24 w-24 flex-none rounded-md bg-gray-100 object-cover object-center"
              />
              <div class="flex-auto space-y-1">
                <h3 class="text-gray-900">{{ item.name }}</h3>
                <template v-if="item.selectedVariation">
                  <p>{{ item.selectedVariation.size }}</p>
                  <p>{{ item.selectedVariation.color }}</p>
                </template>
                <p>Qty: {{ item.quantity }}</p>
              </div>
              <p class="flex-none font-medium text-gray-900">
                <span v-if="item.discounted_price">{{ formatPrice(item.discounted_price) }}</span
                ><span v-else>{{ formatPrice(item.orig_price) }}</span>
              </p>
            </li>
          </ul>
          <dl class="space-y-6 border-t border-gray-200 pt-6 text-sm font-medium text-gray-500">
            <div class="flex justify-between">
              <dt>Subtotal</dt>
              <dd class="text-gray-900">{{ formatPrice(subtotal) }}</dd>
            </div>
            <div class="flex justify-between">
              <dt>Shipping</dt>
              <dd class="text-gray-900">{{ order.shipping_price }}</dd>
            </div>
            <div
              class="flex items-center justify-between border-t border-gray-200 pt-6 text-gray-900"
            >
              <dt class="text-base">Total</dt>
              <dd class="text-base">{{ order.total_price }}</dd>
            </div>
          </dl>
          <dl class="mt-16 grid grid-cols-2 gap-x-4 text-sm text-gray-600">
            <div>
              <dt class="font-medium text-gray-900">Shipping Address</dt>
              <dd class="mt-2">
                <address class="not-italic">
                  <span class="block">{{ order.first_name }} {{ order.last_name }}</span>
                  <span class="block">{{ order.address }}</span>
                  <span class="block">{{ order.city }}, {{ order.country }}</span>
                </address>
              </dd>
            </div>
            <div>
              <dt class="font-medium text-gray-900">Payment Information</dt>
              <dd class="mt-2 space-y-2 sm:flex sm:space-x-4 sm:space-y-0">
                <div class="flex-none">
                  <Icon
                    v-if="order.payment_method == 'paypal'"
                    icon="logos:paypal"
                    class="h-6 w-auto"
                  />
                  <Icon v-else icon="icon-park-solid:delivery" class="h-6 w-auto" />
                </div>
                <div class="flex-auto">
                  <p v-if="order.payment_method == 'paypal'" class="text-gray-900">PayPal</p>
                  <p v-else class="text-gray-900">Cash on Delivery</p>
                </div>
              </dd>
            </div>
          </dl>
          <div class="mt-16 border-t border-gray-200 py-6 text-right">
            <RouterLink
              to="/shop"
              class="text-sm font-medium text-emerald-600 hover:text-emerald-500"
            >
              Continue Shopping
              <span aria-hidden="true"> &rarr;</span>
            </RouterLink>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { computed, onUnmounted } from 'vue'
import { RouterLink } from 'vue-router'
import { useOrderStore } from '@/store/order/order'

const orderStore = useOrderStore()

const order = computed(() => {
  return orderStore.newOrder
})

const subtotal = computed(() => {
  return order.value.cartItems.reduce((acc, item) => {
    if (item.discounted_price) {
      return acc + item.discounted_price * item.quantity
    }
    return acc + item.orig_price * item.quantity
  }, 0)
})

onUnmounted(() => {
  orderStore.newOrder = null
})

function formatPrice(price) {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(price)
}
</script>
