import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useDashboardStore = defineStore('dashboard', {
  state: () => {
    return {
      dashboardData: []
    }
  },
  actions: {
    async getDashboardData() {
      try {
        const {
          data: { data }
        } = await api.get('/api/admin/dashboard')
        this.dashboardData = data
      } catch ({ response }) {
        handleError(response)
      }
    }
  }
})
