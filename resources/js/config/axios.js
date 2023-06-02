import axios from 'axios'
import { useAuthStore } from '@/store/auth/auth'

const api = axios.create({
  headers: { 'Content-Type': 'application/json' }
})

api.interceptors.request.use(function (config) {
  const store = useAuthStore()
  const token = store.getAccessToken
  config.headers.Authorization = token ? `Bearer ${token}` : ''
  return config
})

export default api
