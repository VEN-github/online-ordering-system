import { defineStore } from 'pinia'
import api from '@/config/axios'
import { handleError } from '@/helpers/handleApiError'

export const useProductStore = defineStore('product', {
  state: () => {
    return {
      cartItems: [],
      products: [],
      product: null,
      featuredProducts: [],
      guestProducts: [],
      guestProduct: null
    }
  },
  getters: {
    getCartItemsTotal({ cartItems }) {
      return cartItems.reduce((acc, item) => acc + item.quantity, 0)
    },
    getCartItemsTotalPrice({ cartItems }) {
      return cartItems.reduce(
        (acc, item) =>
          acc +
          (item.discounted_price
            ? item.quantity * item.discounted_price
            : item.quantity * item.orig_price),
        0
      )
    }
  },
  actions: {
    async getProducts() {
      try {
        const {
          data: { data }
        } = await api.get('/api/admin/products')
        this.products = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async getProduct(slug) {
      try {
        const {
          data: { data }
        } = await api.get(`/api/admin/products/${slug}`)
        this.product = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async addProduct(formData) {
      try {
        await api.post('/api/admin/products', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        })
      } catch ({ response }) {
        handleError(response)
      }
    },
    async editProduct(slug, formData) {
      try {
        await api.post(`/api/admin/products/${slug}?_method=PATCH`, formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        })
      } catch ({ response }) {
        handleError(response)
      }
    },
    async deleteProduct(slug) {
      try {
        await api.delete(`/api/admin/products/${slug}`)
      } catch ({ response }) {
        handleError(response)
      }
    },
    async getFeaturedProducts() {
      try {
        const {
          data: { data }
        } = await api.get('/api/products/featured')
        this.featuredProducts = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async getGuestProducts(page = 1) {
      try {
        const {
          data: { data }
        } = await api.get(`/api/products?page=${page}`)
        this.guestProducts = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async getGuestProductsByCategory(page = 1, categorySlug) {
      try {
        const {
          data: { data }
        } = await api.get(`/api/category/${categorySlug}/products?page=${page}`)
        this.guestProducts = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    async getGuestProduct(slug) {
      try {
        const {
          data: { data }
        } = await api.get(`/api/products/${slug}`)
        this.guestProduct = data
      } catch ({ response }) {
        handleError(response)
      }
    },
    addToCart(item) {
      let exists

      if (item.selectedVariation) {
        exists = this.cartItems.find(
          (cart) => cart.id == item.id && cart.selectedVariation.id == item.selectedVariation.id
        )
      } else {
        exists = this.cartItems.find((cart) => cart.id == item.id)
      }

      if (exists) {
        exists.quantity++
        return
      }
      this.cartItems.push({ ...item })
    },
    removeFromCart(id) {
      const index = this.cartItems.findIndex((item) => item.id == id)
      this.cartItems.splice(index, 1)
    },
    increaseQuantity(index) {
      this.cartItems[index].quantity++
    },
    decreaseQuantity(index) {
      this.cartItems[index].quantity--
    }
  },
  persist: {
    storage: localStorage,
    key: 'cart',
    paths: ['cartItems']
  }
})
