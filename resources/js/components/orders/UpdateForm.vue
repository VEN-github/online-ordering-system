<template>
  <FormModal title="Update Order Status" :is-show="isShow" @on-submit="updateOrder">
    <Transition name="fade">
      <BaseAlert v-if="isError" mode="error" class="mb-5">{{ errorMessage }}</BaseAlert>
    </Transition>
    <div>
      <FormLabel label-id="category-name" :is-invalid="v$.status.$error">Order Status</FormLabel>
      <div class="mt-2">
        <FormSelect id="country" v-model="models.status" :is-invalid="v$.status.$error">
          <option value="" disabled>Select status</option>
          <option value="pending">Pending</option>
          <option value="processing">Processing</option>
          <option value="confirmed">Confirmed</option>
          <option value="shipped">Shipped</option>
          <option value="completed">Completed</option>
          <option value="cancelled">Cancelled</option>
          <option value="refunded">Refunded</option>
        </FormSelect>
      </div>
      <FormValidation v-if="v$.status.$error"> Please select a status. </FormValidation>
    </div>
    <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:justify-end">
      <BaseButton
        mode="outline-default"
        size="lg"
        class="order-2 w-full sm:order-1 sm:w-auto"
        :disabled="isLoading"
        @click="onClose"
      >
        Cancel
      </BaseButton>
      <BaseButton
        type="submit"
        mode="primary"
        size="lg"
        class="order-1 w-full sm:order-2 sm:w-auto"
        :disabled="isLoading"
      >
        <Icon v-if="isLoading" icon="gg:spinner" class="animate-spin text-base" />
        {{ isLoading ? 'Loading...' : `Update Order` }}
      </BaseButton>
    </div>
  </FormModal>
</template>

<script setup>
import { ref, reactive, computed, watchEffect } from 'vue'
import { useOrderStore } from '@/store/order/order'
import { useVuelidate } from '@vuelidate/core'
import { required } from '@vuelidate/validators'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import FormModal from '@/components/UI/modal/FormModal.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormSelect from '@/components/UI/forms/FormSelect.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import BaseAlert from '@/components/UI/alert/BaseAlert.vue'

const props = defineProps({
  isShow: {
    type: Boolean,
    default() {
      return false
    }
  },
  modelValue: {
    type: Object,
    default() {
      return null
    }
  }
})
const emit = defineEmits(['onClose', 'onSuccess'])

const orderStore = useOrderStore()
const models = reactive({
  status: ''
})
const isLoading = ref(false)
const isError = ref(false)
const errorMessage = ref('')
let timeout

const rules = computed(() => {
  return {
    status: { required }
  }
})

const v$ = useVuelidate(rules, models)

watchEffect(() => {
  initModels()
})

function initModels() {
  models.status = props.modelValue?.status || ''
}

async function updateOrder() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    clearTimeout(timeout)
    isLoading.value = true
    isError.value = false
    await orderStore.updateOrder({ ref_id: props.modelValue?.ref_id, status: models })
    isLoading.value = false
    resetForm()
    toast('Successfully Updated', {
      type: 'success',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_CENTER,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
    emit('onSuccess')
  } catch ({ message }) {
    isLoading.value = false
    isError.value = true
    errorMessage.value = message
    clearErrorMessage()
  }
}

function clearErrorMessage() {
  timeout = setTimeout(() => {
    isError.value = false
    errorMessage.value = ''
  }, 5000)
}

function resetForm() {
  v$.value.$reset()
  models.status = ''
}

function onClose() {
  v$.value.$reset()
  initModels()
  emit('onClose')
}
</script>
