import { defineStore } from 'pinia'
import { useAuthStore } from '../auth/auth'
import { AES } from 'crypto-js'
import api from '@/config/axios'
import { handleError } from '@/composables/handleApiError'

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
    }
    // async changeAvatar(id, avatar, token) {
    //   try {
    //     let formData = new FormData()
    //     formData.append('file', avatar)
    //     await axios.post(
    //       `/api/admin/avatar/${id}`,
    //       { avatar },
    //       {
    //         headers: {
    //           Authorization: `Bearer ${token}`,
    //           'Content-Type': 'multipart/form-data'
    //         }
    //       }
    //     )
    //   } catch ({ response }) {
    //     if (response.status !== 404) {
    //       throw new Error(response.data.message)
    //     } else {
    //       throw new Error('Something went wrong. Please try again.')
    //     }
    //   }
    // },
    // async deleteAvatar(id, token) {
    //   try {
    //     await axios.delete(`/api/admin/avatar/${id}`, {
    //       headers: { Authorization: `Bearer ${token}` }
    //     })
    //   } catch ({ response }) {
    //     if (response.status !== 404) {
    //       throw new Error(response.data.message)
    //     } else {
    //       throw new Error('Something went wrong. Please try again.')
    //     }
    //   }
    // },
    // async changeProfile(id, token, { firstName, lastName, email }) {
    //   try {
    //     await axios.patch(
    //       `/api/admin/profile/${id}`,
    //       {},
    //       {
    //         headers: { Authorization: `Bearer ${token}` },
    //         params: { first_name: firstName, last_name: lastName, email: email }
    //       }
    //     )
    //   } catch ({ response }) {
    //     if (response.status !== 404) {
    //       throw new Error(response.data.message)
    //     } else {
    //       throw new Error('Something went wrong. Please try again.')
    //     }
    //   }
    // },
    // async changePassword(id, token, { password }) {
    //   try {
    //     await axios.patch(
    //       `/api/admin/password/${id}`,
    //       {},
    //       {
    //         headers: { Authorization: `Bearer ${token}` },
    //         params: {
    //           current_password: password.current,
    //           password: password.new,
    //           password_confirmation: password.confirm
    //         }
    //       }
    //     )
    //   } catch ({ response }) {
    //     if (response.status !== 404) {
    //       throw new Error(response.data.message)
    //     } else {
    //       throw new Error('Something went wrong. Please try again.')
    //     }
    //   }
    // }
  }
})
