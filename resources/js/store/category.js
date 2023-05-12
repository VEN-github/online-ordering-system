import { defineStore } from 'pinia'

export const useCategoryStore = defineStore('category', {
  actions: {
    async addCategory(models, token) {
      try {
        await axios.post('/api/admin/categories', models, {
          headers: { Authorization: `Bearer ${token}` }
        })
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    },
    async editCategory(models, token) {
      try {
        await axios.patch(
          `/api/admin/categories/${models.oldSlug}`,
          {
            name: models.name,
            slug: models.slug
          },
          {
            headers: { Authorization: `Bearer ${token}` }
          }
        )
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    },
    async deleteCategory(id, token) {
      try {
        await axios.delete(`/api/admin/categories/${id}`, {
          headers: { Authorization: `Bearer ${token}` }
        })
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    }
  }
})
