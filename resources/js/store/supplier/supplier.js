import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useSupplierStore = defineStore('supplier', {
  actions: {
    async addSupplier(formData) {
      try {
        await api.post('/api/admin/suppliers', formData)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async editSupplier(id, { name, city, country }) {
      try {
        await api.put(
          `/api/admin/suppliers/${id}`,
          {},
          {
            params: { name: name, city: city, country: country }
          }
        )
      } catch ({ response }) {
        handleError(response)
      }
    },
    async deleteSupplier(id) {
      try {
        await api.delete(`/api/admin/suppliers/${id}`)
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
