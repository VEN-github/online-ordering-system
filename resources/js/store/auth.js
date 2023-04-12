import { defineStore } from 'pinia'
// import { AES, enc } from 'crypto-js'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
  state: () => {
    return {
      loggedAdmin: null
      // ENCRYPTION_KEY: import.meta.env.VITE_ENCRYPTION_KEY
    }
  },
  getters: {
    // getLoggedUser({ loggedUser }) {
    //   var bytes = AES.decrypt(loggedUser, this.ENCRYPTION_KEY)
    //   var decryptedData = JSON.parse(bytes.toString(enc.Utf8))
    //   return decryptedData
    // },
    isAdminAuthenticated({ loggedAdmin }) {
      return !!loggedAdmin
    }
  },
  actions: {
    // storeUser(user) {
    //   this.loggedUser = AES.encrypt(JSON.stringify(user), this.ENCRYPTION_KEY).toString()
    // },
    async adminLogin({ email, password }) {
      try {
        const {
          data: { data },
          status
        } = await axios.post('/api/admin/login', { email, password })
        if (status === 200) {
          this.loggedAdmin = data
        }
      } catch ({ response }) {
        if (response.status === 404) {
          throw new Error(response.data.message)
        } else {
          throw new Error('Something went wrong. Please try again.')
        }
      }
    }
  },
  persist: {
    storage: localStorage,
    key: 'admin',
    paths: ['loggedAdmin']
  }
})
