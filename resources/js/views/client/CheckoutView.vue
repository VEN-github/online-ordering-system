<template>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <main class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="mx-auto max-w-2xl lg:max-w-none">
        <h1 class="sr-only">Checkout</h1>
        <form class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
          <div>
            <ContactInfo v-model="models.email" />
            <div class="mt-10 border-t border-gray-200 pt-10">
              <ShippingInfo v-model="models" />
            </div>
            <div class="mt-10 border-t border-gray-200 pt-10">
              <ShippingMethod v-model="models.shippingMethod" />
            </div>
            <div class="mt-10 border-t border-gray-200 pt-10">
              <PaymentMethod
                v-model="models.paymentMethod"
                :models="models"
                @payment-success="addOrder"
              />
            </div>
          </div>
          <div class="mt-10 lg:mt-0">
            <CheckoutSummary :models="models" @confirm-order="addOrder" />
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script setup>
import { reactive, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth/auth'
import { useProductStore } from '@/store/products/product'
import { useOrderStore } from '@/store/order/order'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import ContactInfo from '@/components/checkout/ContactInfo.vue'
import ShippingInfo from '@/components/checkout/ShippingInfo.vue'
import ShippingMethod from '@/components/checkout/ShippingMethod.vue'
import PaymentMethod from '@/components/checkout/PaymentMethod.vue'
import CheckoutSummary from '@/components/checkout/CheckoutSummary.vue'

const router = useRouter()
const authStore = useAuthStore()
const productStore = useProductStore()
const orderStore = useOrderStore()
const models = reactive({
  email: authStore.getLoggedUser?.email ?? '',
  firstName: '',
  lastName: '',
  address: '',
  city: '',
  country: '',
  province: '',
  postalCode: '',
  phone: '',
  shippingMethod: {
    name: '',
    price: 0
  },
  paymentMethod: '',
  saveInfo: 0
})

const cartItems = computed(() => {
  return productStore.cartItems
})

const payload = computed(() => {
  return {
    email: models.email,
    first_name: models.firstName,
    last_name: models.lastName,
    address: models.address,
    city: models.city,
    country: models.country,
    state: models.province,
    postal_code: models.postalCode,
    phone: models.phone,
    status: 'pending',
    shipping_method: models.shippingMethod.name,
    shipping_price: models.shippingMethod.price,
    payment_method: models.paymentMethod,
    payment_status: models.paymentMethod === 'cod' ? 'pending' : 'paid',
    items: cartItems.value.map((item) => {
      return {
        product_id: item.id,
        quantity: item.quantity,
        total_price: item.discounted_price
          ? item.discounted_price * item.quantity
          : item.orig_price * item.quantity
      }
    })
  }
})

async function addOrder(totalPrice) {
  try {
    await orderStore.addOrder({ ...payload.value, total_price: totalPrice })
    router.push('/order-confirmed')
  } catch ({ message }) {
    toast(message, {
      type: 'error',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_CENTER,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}
</script>
