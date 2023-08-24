import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

import { useProductStore } from '../products/product'

export const useOrderStore = defineStore('order', {
  state: () => {
    return {
      orders: [],
      newOrder: null
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
      const productStore = useProductStore()

      try {
        const {
          data: { data }
        } = await api.post('/api/orders', payload)
        this.newOrder = { ...data, cartItems: productStore.cartItems }
        productStore.cartItems = []
      } catch ({ response }) {
        handleError(response)
      }
    }
  },
  persist: {
    storage: localStorage,
    key: 'newOrder',
    paths: ['newOrder']
  }
})
