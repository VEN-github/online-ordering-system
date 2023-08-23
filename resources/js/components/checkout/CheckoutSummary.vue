<template>
  <h2 class="text-lg font-medium text-gray-900">Order summary</h2>
  <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
    <h3 class="sr-only">Items in your cart</h3>
    <ul role="list" class="divide-y divide-gray-200">
      <li v-for="item in cartItems" :key="item.id" class="flex px-4 py-6 sm:px-6">
        <div class="flex-shrink-0">
          <img
            v-if="item.highlight_image"
            :src="item.highlight_image"
            alt="Cart Item image"
            class="h-20 w-20 rounded-md object-cover object-center"
          />
          <img
            v-else
            src="../../../assets/images/no-image.png"
            alt="No image"
            class="h-20 w-20 rounded-md object-cover object-center"
          />
        </div>
        <div class="ml-6 flex flex-1 flex-col">
          <div class="flex">
            <div class="min-w-0 flex-1">
              <h4 class="text-sm">{{ item.name }}</h4>
              <div v-if="item.selectedVariation" class="mt-1 flex text-sm">
                <p class="text-gray-500">{{ item.selectedVariation.size }}</p>
                <p class="ml-4 border-l border-gray-200 pl-4 text-gray-500">
                  {{ item.selectedVariation.color }}
                </p>
              </div>
            </div>
          </div>
          <div class="flex flex-1 items-end justify-between pt-2">
            <p v-if="!item.discounted_price" class="mt-1 text-sm font-medium text-gray-900">
              {{ formattedPrice(item.orig_price) }}
            </p>
            <p v-else class="mt-1 text-sm font-medium">
              <span class="text-gray-900">{{ formattedPrice(item.discounted_price) }}</span>
              <span class="ml-1 text-red-500 line-through">
                {{ formattedPrice(item.orig_price) }}
              </span>
            </p>
            <span class="text-sm">Qty: {{ item.quantity }}</span>
          </div>
        </div>
      </li>
    </ul>
    <dl class="space-y-6 border-t border-gray-200 px-4 py-6 sm:px-6">
      <div class="flex items-center justify-between">
        <dt class="text-sm">Subtotal</dt>
        <dd class="text-sm font-medium text-gray-900">{{ subtotal }}</dd>
      </div>
      <div class="flex items-center justify-between">
        <dt class="text-sm">Shipping</dt>
        <dd class="text-sm font-medium text-gray-900">
          {{ shippingFee }}
        </dd>
      </div>
      <div class="flex items-center justify-between border-t border-gray-200 pt-6">
        <dt class="text-base font-medium">Total</dt>
        <dd class="text-base font-medium text-gray-900">{{ total }}</dd>
      </div>
    </dl>
    <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
      <BaseButton
        mode="primary"
        size="xl"
        is-full
        class="px-4 py-3 text-base"
        :disabled="disabled"
        @click="
          emit('confirmOrder', productStore.getCartItemsTotalPrice + models.shippingMethod.price)
        "
      >
        Confirm Order
      </BaseButton>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useProductStore } from '@/store/products/product'

import BaseButton from '@/components/UI/button/BaseButton.vue'

const props = defineProps({
  models: {
    type: Object,
    default() {
      return {}
    }
  }
})
const emit = defineEmits(['confirmOrder'])

const productStore = useProductStore()

const cartItems = computed(() => {
  return productStore.cartItems
})

const subtotal = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(productStore.getCartItemsTotalPrice)
})

const shippingFee = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(props.models.shippingMethod.price)
})

const total = computed(() => {
  const totalPrice = productStore.getCartItemsTotalPrice + props.models.shippingMethod.price
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(totalPrice)
})

const disabled = computed(() => {
  if (
    props.models.firstName == '' ||
    props.models.lastName == '' ||
    props.models.address == '' ||
    props.models.city == '' ||
    props.models.country == '' ||
    props.models.province == '' ||
    props.models.postalCode == '' ||
    props.models.phone == '' ||
    props.models.shippingMethod.name == '' ||
    props.models.shippingMethod.price == 0 ||
    props.models.paymentMethod == ''
  ) {
    return true
  }
  return false
})

function formattedPrice(price) {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(price)
}
</script>
