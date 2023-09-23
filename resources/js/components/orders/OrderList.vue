<template>
  <div>
    <div
      class="rounded-lg bg-gray-50 px-4 py-6 sm:flex sm:items-center sm:justify-between sm:space-x-6 sm:px-6 lg:space-x-8"
    >
      <dl
        class="flex-auto space-y-6 divide-y divide-gray-200 text-sm text-gray-600 sm:grid sm:grid-cols-3 sm:gap-x-6 sm:space-y-0 sm:divide-y-0 lg:w-1/2 lg:flex-none lg:gap-x-8"
      >
        <div class="flex justify-between sm:block">
          <dt class="font-medium text-gray-900">Date placed</dt>
          <dd class="sm:mt-1">
            <time>{{ formattedDate }}</time>
          </dd>
        </div>
        <div class="flex justify-between pt-6 sm:block sm:pt-0">
          <dt class="font-medium text-gray-900">Order number</dt>
          <dd class="sm:mt-1">#{{ order.ref_id }}</dd>
        </div>
        <div class="flex justify-between pt-6 font-medium text-gray-900 sm:block sm:pt-0">
          <dt>Total amount</dt>
          <dd class="sm:mt-1">{{ order.total_price }}</dd>
        </div>
      </dl>
      <BaseButton mode="primary" size="xl" is-link link="#" class="mt-6 w-full sm:mt-0 sm:w-auto">
        Track Order
      </BaseButton>
    </div>
    <table class="mt-4 w-full text-gray-500 sm:mt-6">
      <thead class="sr-only text-left text-sm text-gray-500 sm:not-sr-only">
        <tr>
          <th scope="col" class="py-3 pr-8 font-normal sm:w-2/5 lg:w-1/3">Product</th>
          <th scope="col" class="hidden w-1/5 py-3 pr-8 font-normal sm:table-cell">Price</th>
          <th scope="col" class="hidden py-3 pr-8 text-center font-normal sm:table-cell">
            Quantity
          </th>
          <th scope="col" class="w-0 py-3 text-right font-normal">Info</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 border-b border-gray-200 text-sm sm:border-t">
        <OrderProduct v-for="item in order.items" :key="item.id" :item="item" />
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import * as dayjs from 'dayjs'

import OrderProduct from './OrderProduct.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const props = defineProps({
  order: {
    type: Object,
    default() {
      return {}
    }
  }
})

const formattedDate = computed(() => {
  return dayjs(props.order?.created_at).format('MMMM DD, YYYY')
})
</script>
