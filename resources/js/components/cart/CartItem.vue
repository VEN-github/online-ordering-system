<template>
  <li class="flex py-6 sm:py-10">
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
          <div v-if="item.selectedVariation" class="mt-1 flex text-sm">
            <p class="text-gray-500">{{ item.selectedVariation.size }}</p>
            <p class="ml-4 border-l border-gray-200 pl-4 text-gray-500">
              {{ item.selectedVariation.color }}
            </p>
          </div>
          <p v-if="!item.discounted_price" class="mt-1 text-sm font-medium text-gray-900">
            {{ formattedOrigPrice }}
          </p>
          <p v-else class="mt-1 text-sm font-medium">
            <span class="text-gray-900">{{ formattedDiscountedPrice }}</span>
            <span class="ml-1 text-red-500 line-through">
              {{ formattedOrigPrice }}
            </span>
          </p>
        </div>
        <div class="mt-4 sm:mt-0 sm:pr-9">
          <div class="w-[175px]">
            <QuantityInput
              v-model="quantity"
              :max-value="maxValue"
              @add="addQuantity"
              @subtract="subtractQuantity"
            />
          </div>
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
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useProductStore } from '@/store/products/product'

import QuantityInput from '@/components/UI/forms/QuantityInput.vue'

const props = defineProps({
  item: {
    type: Object,
    default() {
      return {}
    }
  },
  index: {
    type: Number,
    default() {
      return 0
    }
  }
})

const productStore = useProductStore()
const quantity = ref(1)
const maxValue = ref(1)

const formattedOrigPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(props.item?.orig_price)
})

const formattedDiscountedPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(props.item?.discounted_price)
})

onMounted(() => {
  quantity.value = props.item.quantity
  maxValue.value = props.item.stocks ?? props.item.selectedVariation.stock
})

function addQuantity() {
  quantity.value++
  productStore.increaseQuantity(props.index)
}

function subtractQuantity() {
  quantity.value--
  productStore.decreaseQuantity(props.index)
}

function removeItem(id) {
  productStore.removeFromCart(id)
}
</script>
