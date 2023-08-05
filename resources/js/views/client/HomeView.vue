<template>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <section class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="mb-8 flex flex-wrap justify-between md:mb-16">
        <div class="mb-6 sm:mb-12 lg:mb-0 lg:w-1/3 lg:pt-48 lg:pb-24">
          <h1 class="text-black-800 mb-4 text-4xl font-bold sm:text-5xl md:mb-8 md:text-6xl">
            Find your<br />furniture style
          </h1>
          <p class="mb-5 max-w-md leading-relaxed text-gray-500 xl:text-lg">
            This is a section of some simple filler text, also known as placeholder text. It shares
            characteristics of real text.
          </p>
          <BaseButton mode="primary" size="lg" is-link link="/shop">
            <span>Shop Now</span><Icon icon="ion:cart" class="h-5 w-5" />
          </BaseButton>
        </div>
        <div class="mb-12 flex w-full md:mb-16 lg:w-2/3">
          <div
            class="relative top-12 left-12 z-10 -ml-12 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:top-16 md:left-16 lg:ml-0"
          >
            <img
              src="https://images.unsplash.com/photo-1606744824163-985d376605aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1632&q=80"
              loading="lazy"
              alt="Photo by Kaung Htet"
              class="h-full w-full object-cover object-center"
            />
          </div>
          <div class="overflow-hidden rounded-lg bg-gray-100 shadow-lg">
            <img
              src="https://images.unsplash.com/photo-1596179141065-81fc52bec5ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1083&q=80"
              loading="lazy"
              alt="Photo by Manny Moreno"
              class="h-full w-full object-cover object-center"
            />
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="mb-10 md:mb-16">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">
          Feature Products
        </h2>
        <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
          This is a section of some simple filler text, also known as placeholder text. It shares
          some characteristics of a real written text but is random or otherwise generated.
        </p>
      </div>
      <div class="grid gap-x-4 gap-y-8 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-3 xl:grid-cols-4">
        <ProductCard v-for="product in featuredProducts" :key="product.id" :product="product" />
      </div>
    </div>
  </div>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="mb-10 md:mb-16">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">
          Shop by Category
        </h2>
        <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
          This is a section of some simple filler text, also known as placeholder text. It shares
          some characteristics of a real written text but is random or otherwise generated.
        </p>
      </div>
      <div class="grid gap-6 sm:grid-cols-2">
        <a
          v-for="category in categories"
          :key="category.id"
          href="#"
          class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg"
        >
          <img
            v-if="category.image"
            :src="category.image"
            loading="lazy"
            alt="Category Image"
            class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
          />
          <img
            v-else
            src="../../../assets/images/no-image.png"
            loading="lazy"
            alt="Image Placeholder"
            class="absolute inset-0 h-full w-full object-contain object-center transition duration-200 group-hover:scale-110"
          />
          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50"
          ></div>
          <div class="relative flex flex-col">
            <span class="text-lg font-semibold text-white lg:text-xl">{{ category.name }}</span>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="mb-10 md:mb-16">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">
          Frequently asked questions
        </h2>
        <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
          This is a section of some simple filler text, also known as placeholder text. It shares
          some characteristics of a real written text but is random or otherwise generated.
        </p>
      </div>
      <div class="grid gap-8 sm:grid-cols-2 sm:gap-y-10 xl:grid-cols-3">
        <div v-for="faq in faqs" :key="faq" class="relative rounded-lg bg-gray-100 p-5 pt-8">
          <span
            class="absolute -top-4 left-4 inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white"
          >
            <Icon icon="material-symbols:question-mark" class="h-5 w-5" />
          </span>
          <h3 class="mb-3 text-lg font-semibold text-emerald-500 md:text-xl">
            {{ faq.question }}
          </h3>
          <p class="text-gray-500">
            {{ faq.answer }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useProductStore } from '@/store/products/product'
import { useCategoryStore } from '@/store/products/category'
import { useFAQStore } from '@/store/faq/faq'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import ProductCard from '@/components/products/product/ProductCard.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const productStore = useProductStore()
const categoryStore = useCategoryStore()
const faqStore = useFAQStore()
const featuredProducts = ref([])
const categories = ref([])
const faqs = ref([])

onMounted(async () => {
  await getFeaturedProducts()
  await getCategories()
  await getFaqs()
})

async function getFeaturedProducts() {
  try {
    await productStore.getFeaturedProducts()
    featuredProducts.value = productStore.featuredProducts
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

async function getCategories() {
  try {
    await categoryStore.getGuestCategories()
    categories.value = categoryStore.guestCategories
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

async function getFaqs() {
  try {
    await faqStore.getFAQs()
    faqs.value = faqStore.faqs
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
</script>
