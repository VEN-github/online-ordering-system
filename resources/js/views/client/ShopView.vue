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
      <div>
        <!-- <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
          <div class="fixed inset-0 bg-black bg-opacity-25"></div>
          <div class="fixed inset-0 z-40 flex">
            <div
              class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl"
            >
              <div class="flex items-center justify-between px-4">
                <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                <button
                  type="button"
                  class="relative -mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                >
                  <span class="absolute -inset-0.5"></span>
                  <span class="sr-only">Close menu</span>
                  <svg
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
              <form class="mt-4 border-t border-gray-200">
                <h3 class="sr-only">Categories</h3>
                <ul role="list" class="px-2 py-3 font-medium text-gray-900">
                  <li>
                    <a href="#" class="block px-2 py-3">Totes</a>
                  </li>
                  <li>
                    <a href="#" class="block px-2 py-3">Backpacks</a>
                  </li>
                  <li>
                    <a href="#" class="block px-2 py-3">Travel Bags</a>
                  </li>
                  <li>
                    <a href="#" class="block px-2 py-3">Hip Bags</a>
                  </li>
                  <li>
                    <a href="#" class="block px-2 py-3">Laptop Sleeves</a>
                  </li>
                </ul>
              </form>
            </div>
          </div>
        </div> -->
        <main class="mx-auto">
          <section aria-labelledby="products-heading" class="pb-24 pt-6">
            <h2 id="products-heading" class="sr-only">Products</h2>
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
              <form class="hidden lg:block">
                <h3 class="sr-only">Categories</h3>
                <ul role="list" class="space-y-4 text-sm font-medium text-gray-900">
                  <li>
                    <a href="#">Totes</a>
                  </li>
                  <li>
                    <a href="#">Backpacks</a>
                  </li>
                  <li>
                    <a href="#">Travel Bags</a>
                  </li>
                  <li>
                    <a href="#">Hip Bags</a>
                  </li>
                  <li>
                    <a href="#">Laptop Sleeves</a>
                  </li>
                </ul>
              </form>
              <div
                ref="scrollComponent"
                class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:col-span-3 lg:grid-cols-3 lg:gap-x-8"
              >
                <ProductCard v-for="product in products" :key="product.id" :product="product" />
              </div>
            </div>
          </section>
        </main>
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
    products.value = [...products.value, ...productStore.guestProducts.data]
    currentPage.value = productStore.guestProducts.current_page
    lastPage.value = productStore.guestProducts.last_page
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
