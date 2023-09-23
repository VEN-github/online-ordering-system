<template>
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl">
      <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Order history</h1>
      <p class="mt-1 text-sm text-gray-500">Check the status of recent orders.</p>
    </div>
    <section aria-labelledby="recent-heading" class="mt-16">
      <h2 id="recent-heading" class="sr-only">Recent orders</h2>
      <div v-if="orders.length" class="space-y-20">
        <div>
          <h3 class="sr-only">Order placed on <time>January 22, 2021</time></h3>
          <div
            class="rounded-lg bg-gray-50 px-4 py-6 sm:flex sm:items-center sm:justify-between sm:space-x-6 sm:px-6 lg:space-x-8"
          >
            <dl
              class="flex-auto space-y-6 divide-y divide-gray-200 text-sm text-gray-600 sm:grid sm:grid-cols-3 sm:gap-x-6 sm:space-y-0 sm:divide-y-0 lg:w-1/2 lg:flex-none lg:gap-x-8"
            >
              <div class="flex justify-between sm:block">
                <dt class="font-medium text-gray-900">Date placed</dt>
                <dd class="sm:mt-1">
                  <time>January 22, 2021</time>
                </dd>
              </div>
              <div class="flex justify-between pt-6 sm:block sm:pt-0">
                <dt class="font-medium text-gray-900">Order number</dt>
                <dd class="sm:mt-1">WU88191111</dd>
              </div>
              <div class="flex justify-between pt-6 font-medium text-gray-900 sm:block sm:pt-0">
                <dt>Total amount</dt>
                <dd class="sm:mt-1">$104.00</dd>
              </div>
            </dl>
            <BaseButton
              mode="primary"
              size="xl"
              is-link
              link="#"
              class="mt-6 w-full sm:mt-0 sm:w-auto"
            >
              Track Order
            </BaseButton>
          </div>
          <table class="mt-4 w-full text-gray-500 sm:mt-6">
            <caption class="sr-only">
              Products
            </caption>
            <thead class="sr-only text-left text-sm text-gray-500 sm:not-sr-only">
              <tr>
                <th scope="col" class="py-3 pr-8 font-normal sm:w-2/5 lg:w-1/3">Product</th>
                <th scope="col" class="hidden w-1/5 py-3 pr-8 font-normal sm:table-cell">Price</th>
                <th scope="col" class="hidden py-3 pr-8 font-normal sm:table-cell">Status</th>
                <th scope="col" class="w-0 py-3 text-right font-normal">Info</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 border-b border-gray-200 text-sm sm:border-t">
              <tr>
                <td class="py-6 pr-8">
                  <div class="flex items-center">
                    <img
                      src="https://tailwindui.com/img/ecommerce-images/order-history-page-04-product-01.jpg"
                      alt="Black tee with intersecting red, white, and green curved lines on front."
                      class="mr-6 h-16 w-16 rounded object-cover object-center"
                    />
                    <div>
                      <div class="font-medium text-gray-900">Men&#039;s 3D Glasses Artwork Tee</div>
                      <div class="mt-1 sm:hidden">$36.00</div>
                    </div>
                  </div>
                </td>
                <td class="hidden py-6 pr-8 sm:table-cell">$36.00</td>
                <td class="hidden py-6 pr-8 sm:table-cell">Delivered Jan 25, 2021</td>
                <td class="whitespace-nowrap py-6 text-right font-medium">
                  <RouterLink to="#" class="text-emerald-600">
                    View<span class="hidden lg:inline"> Product</span>
                  </RouterLink>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div v-else class="flex flex-col items-center justify-center gap-4">
        <img
          class="w-96 max-w-full"
          src="../../../assets/images/illustrations/empty-state.svg"
          alt="Empty State"
        />
        <p class="text-lg font-semibold text-slate-800">No orders yet</p>
        <BaseButton mode="primary" size="xl" is-link link="/shop">Shop Now</BaseButton>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import { useOrderStore } from '@/store/order/order'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import BaseButton from '@/components/UI/button/BaseButton.vue'

const orderStore = useOrderStore()
const orders = ref([])

onMounted(async () => {
  await getOrders()
})

async function getOrders() {
  try {
    await orderStore.getOrders()
    orders.value = orderStore.orders
  } catch ({ message }) {
    toast(message, {
      type: 'error',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_RIGHT,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}
</script>
