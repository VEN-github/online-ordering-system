<template>
  <Teleport to="body">
    <BaseModal v-bind="$attrs">
      <div class="mb-3 flex justify-end">
        <BaseButton mode="flat-default" class="shadow-none" @click="emit('onClose')">
          <Icon icon="carbon:close-outline" class="h-5 w-5" />
        </BaseButton>
      </div>
      <div class="grid grid-cols-1 gap-y-5 gap-x-8 md:grid-cols-2">
        <div>
          <div class="mb-5">
            <h2 class="text-xl font-semibold text-slate-600">{{ product?.name }}</h2>
            <div v-if="product?.discounted_price" class="flex items-center space-x-2">
              <p class="text-sm text-slate-400 line-through">{{ formattedPrice }}</p>
              <p class="font-semibold text-slate-600">{{ formattedDiscountedPrice }}</p>
            </div>
            <p v-else class="font-semibold text-slate-600">{{ formattedPrice }}</p>
          </div>
          <div class="mb-5">
            <img
              class="w-full rounded-lg"
              :src="product?.highlight_image"
              :alt="product?.highlight_image"
            />
            <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-3">
              <img
                v-for="image in product?.images"
                :key="image"
                class="w-full rounded-lg"
                :src="image"
                :alt="image"
              />
            </div>
          </div>
          <div class="mb-2">
            <h4 class="text-lg font-semibold text-slate-600">Description</h4>
            <p class="text-sm text-slate-700" v-html="product?.description"></p>
          </div>
          <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
            <div>
              <h4 class="text-lg font-semibold text-slate-600">Category</h4>
              <p>{{ product?.category.name }}</p>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-slate-600">Supplier</h4>
              <p>{{ product?.supplier.name }}</p>
            </div>
          </div>
        </div>
        <div>
          <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
            <div class="rounded-lg bg-slate-200 py-3 px-5">
              <h4 class="text-base font-semibold text-slate-800">Standard Shipping Price</h4>
              <p>{{ formattedStandardShippingPrice }}</p>
            </div>
            <div class="rounded-lg bg-slate-200 py-3 px-5">
              <h4 class="text-base font-semibold text-slate-800">Express Shipping Price</h4>
              <p>{{ formattedExpressShippingPrice }}</p>
            </div>
            <div v-if="product?.stocks" class="rounded-lg bg-slate-200 py-3 px-5">
              <h4 class="text-base font-semibold text-slate-800">Product Stock</h4>
              <p>{{ product?.stocks }}</p>
            </div>
            <div v-if="product?.sku" class="rounded-lg bg-slate-200 py-3 px-5">
              <h4 class="text-base font-semibold text-slate-800">SKU (Stock Keeping Unit)</h4>
              <p>{{ product?.sku }}</p>
            </div>
            <div class="rounded-lg bg-slate-200 py-3 px-5">
              <h4 class="text-base font-semibold text-slate-800">Product Status</h4>
              <p class="badge" :class="[product?.is_active ? 'badge-success' : 'badge-error']">
                {{ product?.is_active ? 'Active' : 'Inactive' }}
              </p>
            </div>
            <div class="rounded-lg bg-slate-200 py-3 px-5">
              <h4 class="text-base font-semibold text-slate-800">Product State</h4>
              <p class="badge" :class="[product?.is_featured ? 'badge-success' : 'badge-default']">
                {{ product?.is_featured ? 'Featured' : 'Not featured' }}
              </p>
            </div>
          </div>
          <div v-if="product.variations.length" class="mt-5">
            <h4 class="mb-2 text-base font-semibold text-slate-800">Variations</h4>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
              <div
                v-for="variation in product.variations"
                :key="variation.id"
                class="rounded-lg bg-slate-200 py-3 px-5"
              >
                <p class="text-base font-semibold text-slate-800">
                  Size: <span class="font-normal">{{ variation.size }}</span>
                </p>
                <p class="text-base font-semibold text-slate-800">
                  Color: <span class="font-normal">{{ variation.color }}</span>
                </p>
                <p class="text-base font-semibold text-slate-800">
                  Stock: <span class="font-normal">{{ variation.stock }}</span>
                </p>
                <p class="text-base font-semibold text-slate-800">
                  SKU: <span class="font-normal">{{ variation.sku }}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseModal>
  </Teleport>
</template>

<script setup>
import { computed } from 'vue'

import BaseModal from '@/components/UI/modal/BaseModal.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const props = defineProps({
  product: {
    type: Object,
    default() {
      return null
    }
  }
})
const emit = defineEmits(['onClose'])

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

const formattedStandardShippingPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(props.product?.standard_shipping_price)
})

const formattedExpressShippingPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(props.product?.express_shipping_price)
})
</script>
