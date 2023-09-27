<template>
  <h2 class="text-lg font-medium text-gray-900">Payment</h2>
  <fieldset class="mt-4">
    <legend class="sr-only">Payment type</legend>
    <label
      class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none"
      :class="[
        model === 'cash on delivery'
          ? 'border-transparent ring-2 ring-emerald-500'
          : 'border-gray-300 hover:border-emerald-400'
      ]"
    >
      <input
        v-model="model"
        type="radio"
        name="payment-method"
        value="cash on delivery"
        class="sr-only"
        aria-labelledby="payment-method-0-label"
      />
      <span class="flex flex-1">
        <span class="flex flex-col">
          <span id="payment-method-0-label" class="block text-lg font-medium text-gray-900">
            Cash on Delivery
          </span>
        </span>
      </span>
      <Icon
        icon="icon-park-solid:check-one"
        class="h-5 w-5 text-emerald-600"
        :class="{ hidden: model !== 'cash on delivery' }"
      />
      <span
        class="pointer-events-none absolute -inset-px rounded-lg"
        aria-hidden="true"
        :class="[
          model === 'cash on delivery' ? 'border border-emerald-500' : 'border-2 border-transparent'
        ]"
      ></span>
    </label>
    <div class="my-4 flex items-center space-x-3">
      <div class="dark:bg-navy-500 h-px flex-1 bg-slate-200"></div>
      <p>OR</p>
      <div class="dark:bg-navy-500 h-px flex-1 bg-slate-200"></div>
    </div>
    <div ref="paypal"></div>
  </fieldset>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useProductStore } from '@/store/products/product'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const props = defineProps({
  modelValue: {
    type: String,
    default() {
      return {}
    }
  },
  models: {
    type: Object,
    default() {
      return {}
    }
  }
})
const emit = defineEmits(['update:modelValue', 'paymentSuccess'])

const productStore = useProductStore()
const paypal = ref(null)
const script = ref(null)

const model = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})

const totalPrice = computed(() => {
  return productStore.getCartItemsTotalPrice + props.models.shippingMethod.price
})

onMounted(() => {
  script.value = document.createElement('script')
  script.value.src =
    'https://www.paypal.com/sdk/js?client-id=AZ-U3v_K9xCzc6n01bcMwoBJ5PXlgUEEuNDhfOQb1s0I2nsk8A2FqXppCVURjWYiawWXK5WLm0fQUIzR&currency=PHP'
  script.value.addEventListener('load', initPaypal)
  document.body.appendChild(script.value)
})

onUnmounted(() => {
  script.value.removeEventListener('load', initPaypal)
  document.body.removeChild(script.value)
})

function initPaypal() {
  window.paypal
    .Buttons({
      createOrder: function (_, actions) {
        return actions.order.create({
          purchase_units: [
            {
              amount: {
                value: totalPrice.value
              }
            }
          ]
        })
      },
      onApprove: function (_, actions) {
        return actions.order.capture().then(function () {
          toast('Payment successful!', {
            type: 'success',
            theme: 'colored',
            hideProgressBar: true,
            multiple: false,
            transition: toast.TRANSITIONS.SLIDE,
            position: toast.POSITION.TOP_CENTER,
            pauseOnHover: false,
            pauseOnFocusLoss: false
          })
          emit('update:modelValue', 'paypal')
          emit(
            'paymentSuccess',
            productStore.getCartItemsTotalPrice + props.models.shippingMethod.price
          )
        })
      },
      onClick: function (_, actions) {
        if (
          props.models.firstName == '' ||
          props.models.lastName == '' ||
          props.models.address == '' ||
          props.models.city == '' ||
          props.models.country == '' ||
          props.models.province == '' ||
          props.models.postalCode == '' ||
          props.models.phone == ''
        ) {
          toast('Please fill up the missing fields.', {
            type: 'error',
            theme: 'colored',
            hideProgressBar: true,
            multiple: false,
            transition: toast.TRANSITIONS.SLIDE,
            position: toast.POSITION.TOP_CENTER,
            pauseOnHover: false,
            pauseOnFocusLoss: false
          })
          return actions.reject()
        }
        if (props.models.shippingMethod.name === '' && props.models.shippingMethod.price === 0) {
          toast('Please select a delivery method.', {
            type: 'error',
            theme: 'colored',
            hideProgressBar: true,
            multiple: false,
            transition: toast.TRANSITIONS.SLIDE,
            position: toast.POSITION.TOP_CENTER,
            pauseOnHover: false,
            pauseOnFocusLoss: false
          })
          return actions.reject()
        }
        emit('update:modelValue', '')
      },
      onCancel() {
        emit('update:modelValue', '')
      }
    })
    .render(paypal.value)
}
</script>
