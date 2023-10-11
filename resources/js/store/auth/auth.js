import { defineStore } from 'pinia'
import { AES, enc } from 'crypto-js'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useAuthStore = defineStore('auth', {
  state: () => {
    return {
      loggedAdmin: null,
      accessToken: null,
      loggedUser: null,
      userToken: null,
      ENCRYPTION_KEY: '12345678'
    }
  },
  getters: {
    getLoggedAdmin({ loggedAdmin }) {
      return loggedAdmin ? this.decryptData(loggedAdmin) : null
    },
    getAccessToken({ accessToken }) {
      return accessToken ? this.decryptData(accessToken) : null
    },
    isAdminAuthenticated({ loggedAdmin }) {
      return !!loggedAdmin
    },
    getLoggedUser({ loggedUser }) {
      return loggedUser ? this.decryptData(loggedUser) : null
    },
    getUserToken({ userToken }) {
      return userToken ? this.decryptData(userToken) : null
    },
    isUserAuthenticated({ loggedUser }) {
      return !!loggedUser
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
        this.loggedAdmin = this.encryptData(admin)
        this.accessToken = this.encryptData(token)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async adminLogout() {
      try {
        await api.delete('/api/admin/logout')
        this.loggedAdmin = null
        this.accessToken = null
      } catch ({ response }) {
        handleError(response)
      }
    },
    async userRegister(formData) {
      try {
        const {
          data: {
            data: { user, token }
          }
        } = await api.post('/api/register', formData)
        this.loggedUser = this.encryptData(user)
        this.userToken = this.encryptData(token)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async userLogin(formData) {
      try {
        const {
          data: {
            data: { user, token }
          }
        } = await api.post('/api/login', formData)
        this.loggedUser = this.encryptData(user)
        this.userToken = this.encryptData(token)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async userLogout() {
      try {
        await api.delete('/api/logout')
        this.loggedUser = null
        this.userToken = null
      } catch ({ response }) {
        handleError(response)
      }
    },
    encryptData(data) {
      return AES.encrypt(JSON.stringify(data), this.ENCRYPTION_KEY).toString()
    },
    decryptData(data) {
      var bytes = AES.decrypt(data, this.ENCRYPTION_KEY)
      return JSON.parse(bytes.toString(enc.Utf8))
    }
  },
  persist: {
    storage: localStorage,
    key: 'auth',
    paths: ['loggedAdmin', 'accessToken', 'loggedUser', 'userToken']
  }
})
