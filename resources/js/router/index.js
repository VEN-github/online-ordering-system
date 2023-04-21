import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/store/auth'

import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin',
      name: 'admin',
      component: () => import('../layouts/AdminLayout.vue'),
      redirect: '/dashboard',
      children: [
        {
          path: '/dashboard',
          component: () => import('../views/admin/DashboardView.vue'),
          meta: {
            title: 'Dashboard'
          }
        },
        {
          path: '/supplier',
          component: () => import('../views/admin/SupplierView.vue'),
          meta: {
            title: 'Supplier'
          }
        }
      ],
      meta: {
        title: 'Admin',
        requiresAuth: true
      }
    },
    {
      path: '/admin/login',
      name: 'admin-login',
      component: () => import('../views/auth/AdminAuth.vue'),
      beforeEnter: (_, _2, next) => {
        const store = useAuthStore()
        if (!store.isAdminAuthenticated) {
          next()
        } else {
          next('/admin')
        }
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
  ],
  linkActiveClass: 'active'
})

const DEFAULT_TITLE = 'Online Ordering System'
router.beforeEach((to, _, next) => {
  document.title = to.meta.title || DEFAULT_TITLE
  const store = useAuthStore()
  if (to.meta.requiresAuth && !store.isAdminAuthenticated) {
    next('/admin/login')
  } else {
    next()
  }
})

export default router
