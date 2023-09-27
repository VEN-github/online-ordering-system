<template>
  <fieldset>
    <legend class="text-lg font-medium text-gray-900">Delivery method</legend>
    <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
      <label
        class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none"
        :class="[
          models.name === 'standard'
            ? 'border-transparent ring-2 ring-emerald-500'
            : 'border-gray-300 hover:border-emerald-400'
        ]"
      >
        <input
          v-model="models"
          type="radio"
          name="delivery-method"
          :value="{ name: 'standard', price: productStore.getStandardShippingFee }"
          class="sr-only"
          aria-labelledby="delivery-method-0-label"
          aria-describedby="delivery-method-0-description-1"
        />
        <span class="flex flex-1">
          <span class="flex flex-col">
            <span id="delivery-method-0-label" class="block text-sm font-medium text-gray-900">
              Standard
            </span>
            <span
              id="delivery-method-0-description-1"
              class="mt-6 text-sm font-medium text-gray-900"
            >
              {{ standardShipping }}
            </span>
          </span>
        </span>
        <Icon
          icon="icon-park-solid:check-one"
          class="h-5 w-5 text-emerald-600"
          :class="{ hidden: models.name !== 'standard' }"
        />
        <span
          class="pointer-events-none absolute -inset-px rounded-lg"
          aria-hidden="true"
          :class="[
            models.name === 'standard' ? 'border border-emerald-500' : 'border-2 border-transparent'
          ]"
        ></span>
      </label>
      <label
        class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none"
        :class="[
          models.name === 'express'
            ? 'border-transparent ring-2 ring-emerald-500'
            : 'border-gray-300 hover:border-emerald-400'
        ]"
      >
        <input
          v-model="models"
          type="radio"
          name="delivery-method"
          :value="{ name: 'express', price: productStore.getExpressShippingFee }"
          class="sr-only"
          aria-labelledby="delivery-method-1-label"
          aria-describedby="delivery-method-1-description-1"
        />
        <span class="flex flex-1">
          <span class="flex flex-col">
            <span id="delivery-method-1-label" class="block text-sm font-medium text-gray-900">
              Express
            </span>
            <span
              id="delivery-method-1-description-1"
              class="mt-6 text-sm font-medium text-gray-900"
            >
              {{ expressShipping }}
            </span>
          </span>
        </span>
        <Icon
          icon="icon-park-solid:check-one"
          class="h-5 w-5 text-emerald-600"
          :class="{ hidden: models.name !== 'express' }"
        />
        <span
          class="pointer-events-none absolute -inset-px rounded-lg"
          aria-hidden="true"
          :class="[
            models.name === 'express' ? 'border border-emerald-500' : 'border-2 border-transparent'
          ]"
        ></span>
      </label>
    </div>
  </fieldset>
</template>

<script setup>
import { computed } from 'vue'
import { useProductStore } from '@/store/products/product'

const props = defineProps({
  modelValue: {
    type: [String, Object],
    default() {
      return {}
    }
  }
})
const emit = defineEmits(['update:modelValue'])

const productStore = useProductStore()

const standardShipping = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(productStore.getStandardShippingFee)
})

const expressShipping = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(productStore.getExpressShippingFee)
})

const models = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})
</script>
