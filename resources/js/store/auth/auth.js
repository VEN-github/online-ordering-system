import { defineStore } from 'pinia'
import { AES, enc } from 'crypto-js'
import api from '@/config/axios'
import { handleError } from '@/composables/handleApiError'

export const useAuthStore = defineStore('auth', {
  state: () => {
    return {
      loggedAdmin: null,
      ENCRYPTION_KEY: import.meta.env.VITE_ENCRYPTION_KEY
    }
  },
  getters: {
    getLoggedAdmin({ loggedAdmin }) {
      var decryptedData
      if (loggedAdmin) {
        var bytes = AES.decrypt(loggedAdmin, this.ENCRYPTION_KEY)
        decryptedData = JSON.parse(bytes.toString(enc.Utf8))
      }
      return decryptedData
    },
    isAdminAuthenticated({ loggedAdmin }) {
      return !!loggedAdmin
    }
  },
  actions: {
    // async getAdmin(id, token) {
    //   try {
    //     const {
    //       data: { data },
    //       status
    //     } = await axios.get(`/api/admin/profile/${id}`, {
    //       headers: { Authorization: `Bearer ${token}` }
    //     })
    //     if (status === 200) {
    //       this.loggedAdmin = AES.encrypt(
    //         JSON.stringify({ token: token, admin: data }),
    //         this.ENCRYPTION_KEY
    //       ).toString()
    //     }
    //   } catch (error) {
    //     throw new Error('Something went wrong. Please try again.')
    //   }
    // },
    async adminLogin({ email, password }) {
      try {
        const {
          data: { data }
        } = await api.post('/api/admin/login', { email, password })
        this.loggedAdmin = AES.encrypt(JSON.stringify(data), this.ENCRYPTION_KEY).toString()
      } catch ({ response }) {
        handleError(response)
      }
    }
    // async adminLogout(token) {
    //   try {
    //     const { status } = await axios.delete('/api/admin/logout', {
    //       headers: { Authorization: `Bearer ${token}` }
    //     })
    //     if (status === 200) {
    //       this.$reset()
    //     }
    //   } catch (error) {
    //     throw new Error('Something went wrong. Please try again.')
    //   }
    // }
  },
  persist: {
    storage: localStorage,
    key: 'admin',
    paths: ['loggedAdmin']
  }
})
