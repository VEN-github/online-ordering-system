import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useFAQStore = defineStore('faq', {
  state: () => {
    return {
      faqs: [],
      featuredFaqs: []
    }
  },
  actions: {
    async getFAQs() {
      try {
        const {
          data: { data }
        } = await api.get('/api/faqs')
        this.faqs = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async getFeaturedFAQs() {
      try {
        const {
          data: { data }
        } = await api.get('/api/faqs/featured')
        this.featuredFaqs = data
      } catch ({ response }) {
        handleError(response)
      }
    },
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
