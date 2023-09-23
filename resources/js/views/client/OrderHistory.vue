<template>
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl">
      <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Order history</h1>
      <p class="mt-1 text-sm text-gray-500">Check the status of recent orders.</p>
    </div>
    <section aria-labelledby="recent-heading" class="mt-16">
      <div
        v-if="!isLoading && orders.length === 0"
        class="flex flex-col items-center justify-center gap-4"
      >
        <img
          class="w-96 max-w-full"
          src="../../../assets/images/illustrations/empty-state.svg"
          alt="Empty State"
        />
        <p class="text-lg font-semibold text-slate-800">No orders yet</p>
        <BaseButton mode="primary" size="xl" is-link link="/shop">Shop Now</BaseButton>
      </div>
      <div v-else ref="scrollComponent" class="space-y-20">
        <OrderList v-for="order in orders" :key="order.id" :order="order" />
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useOrderStore } from '@/store/order/order'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import OrderList from '@/components/orders/OrderList.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const orderStore = useOrderStore()
const orders = ref([])
const currentPage = ref(1)
const lastPage = ref(1)
const isLoading = ref(false)
const scrollComponent = ref(null)

onMounted(async () => {
  isLoading.value = true
  await getOrders()
  isLoading.value = false
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})

async function getOrders() {
  try {
    await orderStore.getOrders(currentPage.value)
    orders.value = [...orders.value, ...orderStore.orders.data]
    currentPage.value = orderStore.orders.current_page
    lastPage.value = orderStore.orders.last_page
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

async function handleScroll() {
  let element = scrollComponent.value
  if (element.getBoundingClientRect().bottom < window.innerHeight) {
    if (currentPage.value < lastPage.value) {
      currentPage.value++
      await getOrders()
    }
  }
}
</script>
