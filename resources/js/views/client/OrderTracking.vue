<template>
  <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Order #{{ id }}</h1>
    <section aria-labelledby="products-heading" class="mt-6">
      <div class="space-y-8">
        <div class="border-b border-t border-gray-200 bg-white shadow-sm sm:rounded-lg sm:border">
          <div class="px-4 py-6 sm:px-6 lg:grid lg:grid-cols-3 lg:gap-x-8 lg:p-8">
            <div class="mt-6 lg:col-span-5 lg:mt-0">
              <dl class="grid grid-cols-1 gap-6 text-sm sm:grid-cols-3">
                <div>
                  <dt class="font-medium text-gray-900">Delivery address</dt>
                  <dd class="mt-3 text-gray-500">
                    <span class="block">{{ order?.first_name }} {{ order?.last_name }}</span>
                    <span class="block">{{ order?.address }}</span>
                    <span class="block">{{ order?.city }}, {{ order?.country }}</span>
                  </dd>
                </div>
                <div>
                  <dt class="font-medium text-gray-900">Payment Information</dt>
                  <dd class="mt-2 space-y-2 sm:flex sm:space-x-4 sm:space-y-0">
                    <div class="flex-none">
                      <Icon
                        v-if="
                          order?.payment_method == 'paypal' ||
                          order?.payment_method == 'credit card'
                        "
                        icon="logos:paypal"
                        class="h-6 w-auto"
                      />
                      <Icon v-else icon="icon-park-solid:delivery" class="h-6 w-auto" />
                    </div>
                    <div class="flex-auto">
                      <p
                        v-if="
                          order?.payment_method == 'paypal' ||
                          order?.payment_method == 'credit card'
                        "
                        class="text-gray-900"
                      >
                        PayPal
                      </p>
                      <p v-else class="text-gray-900">Cash on Delivery</p>
                    </div>
                  </dd>
                </div>
                <div class="divide-y divide-gray-200 text-sm">
                  <div class="flex items-center justify-between pb-4">
                    <dt class="text-gray-600">Shipping Method</dt>
                    <dd class="font-medium capitalize text-gray-900">
                      {{ order?.shipping_method }}
                    </dd>
                  </div>
                  <div class="flex items-center justify-between py-4">
                    <dt class="text-gray-600">Shipping Price</dt>
                    <dd class="font-medium text-gray-900">{{ order?.shipping_price }}</dd>
                  </div>
                  <div class="flex items-center justify-between pt-4">
                    <dt class="font-medium text-gray-900">Order total</dt>
                    <dd class="font-medium text-emerald-600">{{ order?.total_price }}</dd>
                  </div>
                </div>
              </dl>
            </div>
          </div>
          <div class="border-t border-gray-200 px-4 py-6 sm:px-6 lg:p-8">
            <h4 class="sr-only">Status</h4>
            <div class="mt-6" aria-hidden="true">
              <div class="overflow-hidden rounded-full bg-gray-200">
                <div
                  class="h-2 rounded-full"
                  :class="[order?.status === 'cancelled' ? 'bg-red-600' : 'bg-emerald-600']"
                  :style="{ width: `calc((1 * ${widthSize} + 1) / 8 * 100%)` }"
                ></div>
              </div>
              <div class="mt-6 grid grid-cols-4 text-sm font-medium text-gray-600">
                <div
                  :class="[
                    { 'text-emerald-600': order?.status === 'pending' },
                    { 'opacity-0': order?.status === 'cancelled' }
                  ]"
                >
                  Order placed
                </div>
                <div
                  class="text-center"
                  :class="[
                    { 'text-emerald-600': order?.status === 'processing' },
                    { 'opacity-0': order?.status === 'cancelled' }
                  ]"
                >
                  Processing
                </div>
                <div
                  v-show="order?.status !== 'cancelled'"
                  class="text-center"
                  :class="[
                    { 'text-emerald-600': order?.status === 'shipped' },
                    { 'opacity-0': order?.status === 'cancelled' }
                  ]"
                >
                  Shipped
                </div>
                <div
                  v-if="order?.status !== 'cancelled'"
                  class="text-right"
                  :class="{ 'text-emerald-600': order?.status === 'completed' }"
                >
                  Delivered
                </div>
                <div
                  v-if="order?.status === 'cancelled'"
                  class="text-right"
                  :class="{ 'text-red-600': order?.status === 'cancelled' }"
                >
                  Cancelled
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useOrderStore } from '@/store/order/order'

const props = defineProps({
  id: {
    type: String,
    default() {
      return ''
    }
  }
})

const router = useRouter()
const orderStore = useOrderStore()
const order = ref(null)
const isLoading = ref(false)

const widthSize = computed(() => {
  if (order.value?.status === 'completed' || order.value?.status === 'cancelled') {
    return 8
  }
  if (order.value?.status === 'shipped') {
    return 4
  }
  if (order.value?.status === 'processing') {
    return 2
  }

  return 0
})

onMounted(async () => {
  isLoading.value = true
  await getOrder()
  isLoading.value = false
})

async function getOrder() {
  try {
    await orderStore.getOrder(props.id)
    order.value = orderStore.order
  } catch ({ message }) {
    router.push('/404')
  }
}
</script>
