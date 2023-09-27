<template>
  <form class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
    <section aria-labelledby="cart-heading" class="lg:col-span-7">
      <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>
      <ul
        role="list"
        class="divide-y divide-gray-200 border-b border-t border-gray-200 last:border-none"
      >
        <CartItem v-for="(item, index) in cartItems" :key="item.id" :item="item" :index="index" />
      </ul>
    </section>
    <CartSummary />
  </form>
</template>

<script setup>
import CartItem from './CartItem.vue'
import CartSummary from './CartSummary.vue'

defineProps({
  cartItems: {
    type: Array,
    default() {
      return []
    }
  }
})
</script>
