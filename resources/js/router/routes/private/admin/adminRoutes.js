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
        path: '/categories',
        component: () => import('@/views/admin/CategoriesView.vue'),
        meta: {
          title: 'Categories'
        }
      },
      {
        path: '/products',
        component: () => import('@/views/admin/ProductsView.vue'),
        meta: {
          title: 'Products'
        }
      },
      {
        path: '/product/create',
        component: () => import('@/views/admin/CreateProduct.vue'),
        meta: {
          title: 'Add Product'
        }
      },
      {
        path: '/product/:slug/edit',
        component: () => import('@/views/admin/EditProduct.vue'),
        props: true,
        meta: {
          title: 'Edit Product'
        }
      },
      {
        path: '/inventory',
        component: () => import('@/views/admin/InventoryView.vue'),
        meta: {
          title: 'Inventory'
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
      },
      {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: () => import('@/views/errors/404View.vue'),
        meta: {
          title: 'Not Found'
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
