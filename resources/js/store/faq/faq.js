import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/composables/handleApiError'

export const useFAQStore = defineStore('faq', {
  actions: {
    async addFAQ(formData) {
      try {
        await api.post('/api/admin/faqs', formData)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async editFAQ(slug, formData) {
      try {
        await api.patch(`/api/admin/faqs/${slug}`, formData)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async deleteFAQ(slug) {
      try {
        await api.delete(`/api/admin/faqs/${slug}`)
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
