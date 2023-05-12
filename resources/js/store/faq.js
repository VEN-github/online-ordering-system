import { defineStore } from 'pinia'

export const useFAQStore = defineStore('faq', {
  actions: {
    async addFAQ(models, token) {
      try {
        await axios.post('/api/admin/faqs', models, {
          headers: { Authorization: `Bearer ${token}` }
        })
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    },
    async editFAQ(slug, models, token) {
      try {
        await axios.patch(`/api/admin/faqs/${slug}`, models, {
          headers: { Authorization: `Bearer ${token}` }
        })
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    },
    async deleteFAQ(slug, token) {
      try {
        await axios.delete(`/api/admin/faqs/${slug}`, {
          headers: { Authorization: `Bearer ${token}` }
        })
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    }
  }
})
