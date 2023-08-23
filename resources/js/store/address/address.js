import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useAddressStore = defineStore('address', {
  state: () => {
    return {
      addressLists: []
    }
  },
  actions: {
    async getSavedAddress() {
      try {
        const {
          data: { data }
        } = await api.get('/api/addresses')
        this.addressLists = data
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
