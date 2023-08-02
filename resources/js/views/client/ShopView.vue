<template>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="mb-10 md:mb-16">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Shop</h2>
        <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
          This is a section of some simple filler text, also known as placeholder text. It shares
          some characteristics of a real written text but is random or otherwise generated.
        </p>
      </div>
      <div
        ref="scrollComponent"
        class="grid gap-x-4 gap-y-8 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-3 xl:grid-cols-4"
      >
        <ProductCard v-for="product in products" :key="product.id" :product="product" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useProductStore } from '@/store/products/product'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import ProductCard from '@/components/products/product/ProductCard.vue'

const productStore = useProductStore()
const scrollComponent = ref(null)
const products = ref([])
const currentPage = ref(1)
const lastPage = ref(1)

onMounted(async () => {
  await getProducts()
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})

async function getProducts() {
  try {
    await productStore.getGuestProducts(currentPage.value)
    products.value = [...products.value, ...productStore.products.data]
    currentPage.value = productStore.products.current_page
    lastPage.value = productStore.products.last_page
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

function handleScroll() {
  let element = scrollComponent.value
  if (element.getBoundingClientRect().bottom < window.innerHeight) {
    if (currentPage.value < lastPage.value) {
      currentPage.value++
      getProducts()
    }
  }
}
</script>
