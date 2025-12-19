import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      redirect: 'products',
    },
    {
      path: '/products',
      name: 'products',
      component: () => import('@/pages/Products'),
    },
    {
      name: 'product',
      path: '/products/:id',
      component: () => import('@/pages/Products/ProductPage.vue'),
      props: true,
    },
    {
      path: '/checkout',
      name: 'checkout',
      component: () => import('@/pages/Checkout'),
    },
  ],
})

export default router
