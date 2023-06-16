import { defineStore } from 'pinia'
import { useAuthStore } from '../auth/auth'
import { AES } from 'crypto-js'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useProfileStore = defineStore('profile', {
  state: () => {
    return {
      admin: null
    }
  },
  actions: {
    async getAdmin(id) {
      try {
        const {
          data: { data }
        } = await api.get(`/api/admin/profile/${id}`)
        const authStore = useAuthStore()
        authStore.$patch((state) => {
          state.loggedAdmin = AES.encrypt(JSON.stringify(data), authStore.ENCRYPTION_KEY).toString()
        })
      } catch ({ response }) {
        handleError(response)
      }
    },
    async changeAvatar(id, avatar) {
      try {
        await api.post(
          `/api/admin/avatar/${id}`,
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
        await api.delete(`/api/admin/avatar/${id}`)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async changeProfile(id, { firstName, lastName, email }) {
      try {
        await api.patch(
          `/api/admin/profile/${id}`,
          {},
          {
            params: { first_name: firstName, last_name: lastName, email: email }
          }
        )
      } catch ({ response }) {
        handleError(response)
      }
    },
    async changePassword(id, password) {
      try {
        await api.patch(
          `/api/admin/password/${id}`,
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
