import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useProductStore = defineStore('product', {
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
        } = await api.get('/api/admin/products')
        this.products = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async addProduct(formData) {
      try {
        await api.post('/api/admin/products', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        })
      } catch ({ response }) {
        handleError(response)
      }
    },
    async editProduct(slug, formData) {
      try {
        await api.post(`/api/admin/products/${slug}`, formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        })
      } catch ({ response }) {
        handleError(response)
      }
    },
    async deleteProduct(slug) {
      try {
        await api.delete(`/api/admin/products/${slug}`)
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
