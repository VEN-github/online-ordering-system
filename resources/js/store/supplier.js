import { defineStore } from 'pinia'
import axios from 'axios'

export const useSupplierStore = defineStore('supplier', {
  actions: {
    async addSupplier(models, token) {
      try {
        await axios.post('/api/admin/suppliers', models, {
          headers: { Authorization: `Bearer ${token}` }
        })
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    },
    async editSupplier(id, token, { name, city, country }) {
      try {
        await axios.put(
          `/api/admin/suppliers/${id}`,
          {},
          {
            headers: { Authorization: `Bearer ${token}` },
            params: { name: name, city: city, country: country }
          }
        )
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    },
    async deleteSupplier(id, token) {
      try {
        await axios.delete(`/api/admin/suppliers/${id}`, {
          headers: { Authorization: `Bearer ${token}` }
        })
      } catch (error) {
        throw new Error('Something went wrong. Please try again.')
      }
    }
  }
})
