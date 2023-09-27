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
    },
    async addAddress(formData) {
      try {
        await api.post('/api/addresses', formData)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async editAddress(formData) {
      try {
        await api.post(`/api/addresses/${formData.id}?_method=PATCH`, formData)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async deleteAddress(id) {
      try {
        await api.delete(`/api/addresses/${id}`)
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
