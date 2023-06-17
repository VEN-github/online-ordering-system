import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useCategoryStore = defineStore('category', {
  actions: {
    async addCategory(formData) {
      try {
        await api.post('/api/admin/categories', formData)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async editCategory(slug, formData) {
      try {
        await api.patch(`/api/admin/categories/${slug}`, formData)
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
