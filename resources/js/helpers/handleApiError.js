import { useAuthStore } from '@/store/auth/auth'

export function handleError(response) {
  if (response && response.status == 401) {
    const authStore = useAuthStore()

    authStore.loggedAdmin = null
    authStore.accessToken = null
    authStore.loggedUser = null
    authStore.userToken = null
  }

  if (response && response.data.message) {
    throw new Error(response.data.message)
  }

  throw new Error('Something went wrong. Please try again.')
}
