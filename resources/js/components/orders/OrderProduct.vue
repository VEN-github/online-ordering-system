<template>
  <tr>
    <td class="py-6 pr-8">
      <div class="flex items-center">
        <img
          v-if="item?.product?.highlight_image"
          :src="item?.product?.highlight_image"
          :alt="item?.product?.highlight_image"
          class="mr-6 h-16 w-16 rounded object-cover object-center"
        />
        <img
          v-else
          src="../../../assets/images/no-image.png"
          alt="No image"
          class="mr-6 h-16 w-16 rounded object-cover object-center"
        />
        <div>
          <div class="font-medium text-gray-900">{{ item?.product?.name }}</div>
          <div class="mt-1 sm:hidden">
            <p v-if="!item?.product?.discounted_price">
              {{ formattedOrigPrice }}
            </p>
            <p v-else>
              <span class="text-gray-900">{{ formattedDiscountedPrice }}</span>
              <span class="ml-1 text-red-500 line-through">
                {{ formattedOrigPrice }}
              </span>
            </p>
          </div>
        </div>
      </div>
    </td>
    <td class="hidden py-6 pr-8 sm:table-cell">
      <p v-if="!item?.product?.discounted_price">
        {{ formattedOrigPrice }}
      </p>
      <p v-else>
        <span class="text-gray-900">{{ formattedDiscountedPrice }}</span>
        <span class="ml-1 text-red-500 line-through">
          {{ formattedOrigPrice }}
        </span>
      </p>
    </td>
    <td class="hidden py-6 pr-8 text-center sm:table-cell">{{ item?.quantity }}</td>
    <td class="whitespace-nowrap py-6 text-right font-medium">
      <RouterLink :to="`/product/${!item?.product?.slug}`" class="text-emerald-600">
        View<span class="hidden lg:inline"> Product</span>
      </RouterLink>
    </td>
  </tr>
</template>

<script setup>
import { computed } from 'vue'
import { RouterLink } from 'vue-router'

const props = defineProps({
  item: {
    type: Object,
    default() {
      return {}
    }
  }
})

const formattedOrigPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(props.item?.product?.orig_price)
})

const formattedDiscountedPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(props.item?.product?.discounted_price)
})
</script>
