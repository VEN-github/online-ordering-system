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
  }
]

export default routes
