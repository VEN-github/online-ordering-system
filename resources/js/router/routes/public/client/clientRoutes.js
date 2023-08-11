import ClientLayout from '@/layouts/client/ClientLayout.vue'

const routes = [
  {
    path: '/home',
    name: 'home',
    component: ClientLayout,
    redirect: '/',
    children: [
      {
        path: '/',
        component: () => import('@/views/client/HomeView.vue'),
        meta: {
          title: 'Home'
        }
      },
      {
        path: '/shop',
        component: () => import('@/views/client/ShopView.vue'),
        meta: {
          title: 'Shop'
        }
      },
      {
        path: '/shop/:category',
        component: () => import('@/views/client/ShopView.vue'),
        meta: {
          title: 'Shop'
        },
        props: true
      },
      {
        path: '/product/:slug',
        component: () => import('@/views/client/ProductDetails.vue'),
        meta: {
          title: 'Product Details'
        },
        props: true
      },
      {
        path: '/about',
        name: 'about',
        component: () => import('@/views/client/AboutView.vue'),
        meta: {
          title: 'About'
        }
      },
      {
        path: '/contact',
        name: 'contact',
        component: () => import('@/views/client/ContactView.vue'),
        meta: {
          title: 'Contact'
        }
      },
      {
        path: '/faq',
        name: 'faq',
        component: () => import('@/views/client/FaqView.vue'),
        meta: {
          title: 'FAQ'
        }
      },
      {
        path: '/cart',
        name: 'cart',
        component: () => import('@/views/client/CartView.vue'),
        meta: {
          title: 'Cart'
        }
      },
      {
        path: '/checkout',
        name: 'checkout',
        component: () => import('@/views/client/CheckoutView.vue'),
        meta: {
          title: 'Checkout'
        }
      }
    ]
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/client/LoginView.vue'),
    meta: {
      title: 'Login'
    }
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('@/views/client/RegisterView.vue'),
    meta: {
      title: 'Register'
    }
  },
  {
    path: '/order-confirmed',
    name: 'order-confirmed',
    component: () => import('@/views/client/OrderSuccessView.vue'),
    meta: {
      title: 'Order Confirmed'
    }
  }
]

export default routes
