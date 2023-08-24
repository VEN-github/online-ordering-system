<template>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="divide-y divide-gray-900/10">
        <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">
          Frequently asked questions
        </h2>
        <dl ref="scrollComponent" class="mt-10 space-y-6 divide-y divide-gray-900/10">
          <FAQItem v-for="faq in faqs" :key="faq.id" :faq="faq" />
        </dl>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useFAQStore } from '@/store/faq/faq'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import FAQItem from '@/components/faq/FAQItem.vue'

const faqStore = useFAQStore()
const faqs = ref([])
const currentPage = ref(1)
const lastPage = ref(1)
const scrollComponent = ref(null)

onMounted(async () => {
  await getFAQs()
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})

async function getFAQs() {
  try {
    await faqStore.getFAQs(currentPage.value)
    faqs.value = [...faqs.value, ...faqStore.faqs.data]
    currentPage.value = faqStore.faqs.current_page
    lastPage.value = faqStore.faqs.last_page
  } catch ({ message }) {
    toast(message, {
      type: 'error',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_CENTER,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}

async function handleScroll() {
  let element = scrollComponent.value
  if (element.getBoundingClientRect().bottom < window.innerHeight) {
    if (currentPage.value < lastPage.value) {
      currentPage.value++
      await getFAQs()
    }
  }
}
</script>
