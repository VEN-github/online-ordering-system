import { defineStore } from 'pinia'

export const useProductStore = defineStore('product', {
  state: () => {
    return {
      categories: null,
      suppliers: null
    }
  },
  actions: {
    async getCategories(token) {
      try {
        const {
          status,
          data: { data }
        } = await axios.get('/api/admin/product/categories', {
          headers: { Authorization: `Bearer ${token}` }
        })
        if (status === 200) {
          this.categories = data
        }
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    },
    async getSuppliers(token) {
      try {
        const {
          status,
          data: { data }
        } = await axios.get('/api/admin/product/suppliers', {
          headers: { Authorization: `Bearer ${token}` }
        })
        if (status === 200) {
          this.suppliers = data
        }
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    },
    async addProduct(models, token) {
      try {
        const res = await axios.post('/api/admin/products', models, {
          headers: { Authorization: `Bearer ${token}`, 'Content-Type': 'multipart/form-data' }
        })
        console.log(res)
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    }
  }
})
