import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useInventoryStore = defineStore('inventory', {
  state: () => {
    return {
      products: []
    }
  },
  actions: {
    async getProducts() {
      try {
        const {
          data: { data }
        } = await api.get('/api/admin/inventory/products')
        this.products = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async addInventory(formData) {
      try {
        await api.post('/api/admin/inventories', formData)
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
