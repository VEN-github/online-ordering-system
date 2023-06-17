import { defineStore } from 'pinia'
import { AES, enc } from 'crypto-js'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useAuthStore = defineStore('auth', {
  state: () => {
    return {
      loggedAdmin: null,
      accessToken: null,
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
    getAccessToken({ accessToken }) {
      var decryptedData
      if (accessToken) {
        var bytes = AES.decrypt(accessToken, this.ENCRYPTION_KEY)
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
          data: {
            data: { admin, token }
          }
        } = await api.post('/api/admin/login', { email, password })
        this.loggedAdmin = AES.encrypt(JSON.stringify(admin), this.ENCRYPTION_KEY).toString()
        this.accessToken = AES.encrypt(JSON.stringify(token), this.ENCRYPTION_KEY).toString()
      } catch ({ response }) {
        handleError(response)
      }
    },
    async adminLogout() {
      try {
        await api.delete('/api/admin/logout')
      } catch ({ response }) {
        handleError(response)
      }
    }
  },
  persist: {
    storage: localStorage,
    key: 'admin',
    paths: ['loggedAdmin', 'accessToken']
  }
})
