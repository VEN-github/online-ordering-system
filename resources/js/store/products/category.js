import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useCategoryStore = defineStore('category', {
  state: () => {
    return {
      categories: [],
      guestCategories: [],
      guestFeaturedCategories: []
    }
  },
  actions: {
    async getGuestCategories() {
      try {
        const {
          data: { data }
        } = await api.get('/api/categories')
        this.guestCategories = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async getGuestFeaturedCategories() {
      try {
        const {
          data: { data }
        } = await api.get('/api/categories/featured')
        this.guestFeaturedCategories = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async getCategories() {
      try {
        const {
          data: { data }
        } = await api.get('/api/admin/product/categories')
        this.categories = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async addCategory(formData) {
      try {
        await api.post('/api/admin/categories', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        })
      } catch ({ response }) {
        handleError(response)
      }
    },
    async editCategory(slug, formData) {
      try {
        await api.post(`/api/admin/categories/${slug}?_method=PATCH`, formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        })
      } catch ({ response }) {
        handleError(response)
      }
    },
    async deleteCategory(slug) {
      try {
        await api.delete(`/api/admin/categories/${slug}`)
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
