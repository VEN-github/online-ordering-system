import { defineStore } from 'pinia'
import { AES, enc } from 'crypto-js'
import axios from 'axios'

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
    async adminLogin({ email, password }) {
      try {
        const {
          data: { data },
          status
        } = await axios.post('/api/admin/login', { email, password })
        if (status === 200) {
          this.loggedAdmin = AES.encrypt(JSON.stringify(data), this.ENCRYPTION_KEY).toString()
        }
      } catch ({ response }) {
        if (response.status === 404) {
          throw new Error(response.data.message)
        } else {
          throw new Error('Something went wrong. Please try again.')
        }
      }
    },
    async adminLogout(token) {
      try {
        const { status } = await axios.delete('/api/admin/logout', {
          headers: { Authorization: `Bearer ${token}` }
        })
        if (status === 200) {
          this.$reset()
        }
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    }
  },
  persist: {
    storage: localStorage,
    key: 'admin',
    paths: ['loggedAdmin']
  }
})
