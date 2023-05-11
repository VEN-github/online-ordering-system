const routes = [
  {
    path: '/admin',
    name: 'admin',
    component: () => import('@/layouts/admin/AdminLayout.vue'),
    redirect: '/dashboard',
    children: [
      {
        path: '/dashboard',
        component: () => import('@/views/admin/DashboardView.vue'),
        meta: {
          title: 'Dashboard'
        }
      },
      {
        path: '/profile',
        component: () => import('@/views/admin/ProfileView.vue'),
        meta: {
          title: 'Profile'
        }
      },
      {
        path: '/supplier',
        component: () => import('@/views/admin/SupplierView.vue'),
        meta: {
          title: 'Supplier'
        }
      },
      {
        path: '/faqs',
        component: () => import('@/views/admin/FAQsView.vue'),
        meta: {
          title: 'FAQs'
        }
      }
    ],
    meta: {
      title: 'Admin',
      requiresAuth: true
    }
  }
]

export default routes
