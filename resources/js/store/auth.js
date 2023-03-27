import { defineStore } from 'pinia'
import { AES, enc } from 'crypto-js'

export const useAuthStore = defineStore('auth', {
  state: () => {
    return {
      loggedUser: null,
      ENCRYPTION_KEY: import.meta.env.VITE_ENCRYPTION_KEY
    }
  },
  getters: {
    getLoggedUser({ loggedUser }) {
      var bytes = AES.decrypt(loggedUser, this.ENCRYPTION_KEY)
      var decryptedData = JSON.parse(bytes.toString(enc.Utf8))
      return decryptedData
    },
    isAuthenticated({ loggedUser }) {
      return !!loggedUser
    }
  },
  actions: {
    storeUser(user) {
      this.loggedUser = AES.encrypt(JSON.stringify(user), this.ENCRYPTION_KEY).toString()
    }
  },
  persist: {
    storage: sessionStorage,
    key: 'user',
    paths: ['loggedUser']
  }
})
