import { useAuthStore } from '@/store/auth/auth'

const routes = [
  {
    path: '/client-profile',
    name: 'client-profile',
    component: () => import('@/layouts/client/ProfileLayout.vue'),
    redirect: '/user-profile',
    children: [
      {
        path: '/user-profile',
        name: 'user-profile',
        component: () => import('@/views/client/ProfileView.vue')
      },
      {
        path: '/orders',
        name: 'orders',
        component: () => import('@/views/client/OrderHistory.vue'),
        meta: {
          title: 'Orders'
        }
      },
      {
        path: '/address',
        name: 'address',
        component: () => import('@/views/client/AddressView.vue'),
        meta: {
          title: 'Address'
        }
      },
      {
        path: '/profile-security',
        name: 'profile-security',
        component: () => import('@/views/client/SecurityView.vue')
      }
    ],
    meta: {
      title: 'User Profile'
    },
    beforeEnter: (_, _2, next) => {
      const store = useAuthStore()
      if (store.isUserAuthenticated) {
        next()
      } else {
        next('/login')
      }
    }
  }
]

export default routes
