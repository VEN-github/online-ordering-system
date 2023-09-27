import { defineStore } from 'pinia'
import { useAuthStore } from '../auth/auth'
import { AES } from 'crypto-js'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useProfileStore = defineStore('profile', {
  actions: {
    async getUser(id) {
      try {
        const {
          data: { data }
        } = await api.get(`/api/profile/${id}`)
        const authStore = useAuthStore()
        authStore.$patch((state) => {
          state.loggedUser = AES.encrypt(JSON.stringify(data), authStore.ENCRYPTION_KEY).toString()
        })
      } catch ({ response }) {
        handleError(response)
      }
    },
    async changeAvatar(id, avatar) {
      try {
        await api.post(
          `/api/avatar/${id}`,
          { avatar },
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
        )
      } catch ({ response }) {
        handleError(response)
      }
    },
    async deleteAvatar(id) {
      try {
        await api.delete(`/api/avatar/${id}`)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async changeProfile(id, { firstName, lastName }) {
      try {
        await api.patch(
          `/api/profile/${id}`,
          {},
          {
            params: { first_name: firstName, last_name: lastName }
          }
        )
      } catch ({ response }) {
        handleError(response)
      }
    },
    async changePassword(id, password) {
      try {
        await api.patch(
          `/api/password/${id}`,
          {},
          {
            params: {
              current_password: password.current,
              password: password.new,
              password_confirmation: password.confirm
            }
          }
        )
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
