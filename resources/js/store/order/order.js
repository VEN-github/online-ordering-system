import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useOrderStore = defineStore('order', {
  state: () => {
    return {
      orders: []
    }
  },
  actions: {
    async getOrders() {
      try {
        const {
          data: { data }
        } = await api.get('/api/orders')
        this.orders = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async addOrder(payload) {
      try {
        await api.post('/api/orders', payload)
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
