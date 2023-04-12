import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/store/auth'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin',
      name: 'admin',
      component: () => import('../views/auth/AdminAuth.vue'),
      meta: {
        title: 'Admin',
        hideHomeNavbar: true
      },
      beforeEnter: (_, _2, next) => {
        const store = useAuthStore()
        if (!store.isAdminAuthenticated) {
          next()
        } else {
          next('/dashboard')
        }
      }
    },
    {
      path: '/admin/login',
      name: 'admin-login',
      redirect: '/admin'
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/admin/DashboardView.vue'),
      meta: {
        title: 'Dashboard',
        hideHomeNavbar: true,
        requiresAuth: true
      }
    },
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    }
  ]
})

const DEFAULT_TITLE = 'Online Ordering System'
router.beforeEach((to, _, next) => {
  document.title = to.meta.title || DEFAULT_TITLE
  const store = useAuthStore()
  if (to.meta.requiresAuth && !store.isAdminAuthenticated) {
    next('/admin')
  } else {
    next()
  }
})

export default router
