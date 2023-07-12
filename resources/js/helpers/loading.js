import { ref, onMounted, nextTick } from 'vue'
import { useRouter } from 'vue-router'

export function useLoading() {
  const router = useRouter()
  const isLoading = ref(false)

  router.beforeEach(() => {
    isLoading.value = true
  })

  router.afterEach(() => {
    isLoading.value = false
  })

  onMounted(async () => {
    isLoading.value = true
    await nextTick()

    setTimeout(() => {
      isLoading.value = false
    }, 500)
  })

  return { isLoading }
}
