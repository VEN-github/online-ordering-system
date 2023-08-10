import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useProductStore = defineStore('product', {
  state: () => {
    return {
      products: [],
      product: null,
      featuredProducts: [],
      guestProducts: [],
      guestProduct: null
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
    async getProduct(slug) {
      try {
        const {
          data: { data }
        } = await api.get(`/api/admin/products/${slug}`)
        this.product = data
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
        await api.post(`/api/admin/products/${slug}?_method=PATCH`, formData, {
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
    },
    async getFeaturedProducts() {
      try {
        const {
          data: { data }
        } = await api.get('/api/products/featured')
        this.featuredProducts = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async getGuestProducts(page = 1) {
      try {
        const {
          data: { data }
        } = await api.get(`/api/products?page=${page}`)
        this.guestProducts = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async getGuestProduct(slug) {
      try {
        const {
          data: { data }
        } = await api.get(`/api/products/${slug}`)
        this.guestProduct = data
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
