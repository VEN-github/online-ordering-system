import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useCountryStore = defineStore('country', {
  state: () => {
    return {
      countries: []
    }
  },
  actions: {
    async getCountries() {
      try {
        const {
          data: { data }
        } = await api.get('/api/countries')
        this.countries = data
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
