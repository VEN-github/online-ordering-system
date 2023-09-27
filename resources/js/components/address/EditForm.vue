<template>
  <FormModal title="Edit Address" size="xl" :is-show="isShow" @on-submit="editAddress">
    <Transition name="fade">
      <BaseAlert v-if="isError" mode="error" class="mb-5">{{ errorMessage }}</BaseAlert>
    </Transition>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <div>
        <FormLabel label-id="first-name" :is-invalid="v$.firstName.$error">First Name</FormLabel>
        <div class="mt-2">
          <FormInput
            id="first-name"
            v-model="models.firstName"
            placeholder="Enter first name"
            :is-invalid="v$.firstName.$error"
          />
          <FormValidation v-if="v$.firstName.$error"> First name is required. </FormValidation>
        </div>
      </div>
      <div>
        <FormLabel label-id="last-name" :is-invalid="v$.lastName.$error">Last Name</FormLabel>
        <div class="mt-2">
          <FormInput
            id="last-name"
            v-model="models.lastName"
            placeholder="Enter last name"
            :is-invalid="v$.lastName.$error"
          />
          <FormValidation v-if="v$.lastName.$error"> Last name is required. </FormValidation>
        </div>
      </div>
    </div>
    <div class="mt-5">
      <FormLabel label-id="address" :is-invalid="v$.address.$error">Address</FormLabel>
      <div class="mt-2">
        <FormInput
          id="address"
          v-model="models.address"
          placeholder="Enter address"
          :is-invalid="v$.address.$error"
        />
        <FormValidation v-if="v$.address.$error"> Address is required. </FormValidation>
      </div>
    </div>
    <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
      <div>
        <FormLabel label-id="city" :is-invalid="v$.city.$error">City</FormLabel>
        <div class="mt-2">
          <FormInput
            id="city"
            v-model="models.city"
            placeholder="Enter city"
            :is-invalid="v$.city.$error"
          />
          <FormValidation v-if="v$.city.$error"> City is required. </FormValidation>
        </div>
      </div>
      <div>
        <FormLabel label-id="postal-code" :is-invalid="v$.postalCode.$error">Postal Code</FormLabel>
        <div class="mt-2">
          <FormInput
            id="postal-code"
            v-model="models.postalCode"
            placeholder="Enter postal code"
            :is-invalid="v$.postalCode.$error"
          />
          <FormValidation v-if="v$.postalCode.$error"> Postal code is required. </FormValidation>
        </div>
      </div>
    </div>
    <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
      <div>
        <FormLabel label-id="province" :is-invalid="v$.province.$error">Province</FormLabel>
        <div class="mt-2">
          <FormInput
            id="province"
            v-model="models.province"
            placeholder="Enter province"
            :is-invalid="v$.province.$error"
          />
          <FormValidation v-if="v$.province.$error"> Province is required. </FormValidation>
        </div>
      </div>
      <div>
        <FormLabel label-id="country" :is-invalid="v$.country.$error">Country</FormLabel>
        <div class="mt-2">
          <FormSelect
            id="country"
            v-model="models.country"
            class="!mt-0"
            :is-invalid="v$.country.$error"
          >
            <option value="" disabled>Select country</option>
            <option v-for="country in countries" :key="country.code" :value="country.name">
              {{ country.name }}
            </option>
          </FormSelect>
          <FormValidation v-if="v$.country.$error"> Country is required. </FormValidation>
        </div>
      </div>
    </div>
    <div class="mt-5">
      <FormLabel label-id="phone" :is-invalid="v$.phone.$error">Phone Number</FormLabel>
      <div class="mt-2">
        <FormInput
          id="phone"
          v-model="models.phone"
          placeholder="Enter phone number"
          :is-invalid="v$.phone.$error"
        />
        <FormValidation v-if="v$.phone.$error"> Phone Number is required. </FormValidation>
      </div>
    </div>
    <div class="mt-5">
      <FormCheckbox id="save-info" v-model="models.saveInfo" label="Set as primary address" />
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
        {{ isLoading ? 'Loading...' : `Submit` }}
      </BaseButton>
    </div>
  </FormModal>
</template>

<script setup>
import { ref, reactive, computed, watchEffect, onMounted } from 'vue'
import { useAddressStore } from '@/store/address/address'
import { useCountryStore } from '@/store/common/country'
import { useVuelidate } from '@vuelidate/core'
import { required } from '@vuelidate/validators'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import FormModal from '@/components/UI/modal/FormModal.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import BaseAlert from '@/components/UI/alert/BaseAlert.vue'
import FormSelect from '@/components/UI/forms/FormSelect.vue'
import FormCheckbox from '@/components/UI/forms/FormCheckbox.vue'

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

const addressStore = useAddressStore()
const countryStore = useCountryStore()
const countries = ref([])
const models = reactive({
  firstName: '',
  lastName: '',
  address: '',
  city: '',
  country: '',
  province: '',
  postalCode: '',
  phone: '',
  saveInfo: 0
})
const isLoading = ref(false)
const isError = ref(false)
const errorMessage = ref('')
let timeout

const formData = computed(() => {
  return {
    id: props.modelValue?.id,
    first_name: models.firstName,
    last_name: models.lastName,
    address: models.address,
    city: models.city,
    country: models.country,
    state: models.province,
    postal_code: models.postalCode,
    phone: models.phone,
    is_primary: models.saveInfo
  }
})

const rules = computed(() => {
  return {
    firstName: { required },
    lastName: { required },
    address: { required },
    city: { required },
    country: { required },
    province: { required },
    postalCode: { required },
    phone: { required }
  }
})

const v$ = useVuelidate(rules, models)

watchEffect(() => {
  initModels()
})

function initModels() {
  models.firstName = props.modelValue?.first_name || ''
  models.lastName = props.modelValue?.last_name || ''
  models.address = props.modelValue?.address || ''
  models.city = props.modelValue?.city || ''
  models.country = props.modelValue?.country || ''
  models.province = props.modelValue?.state || ''
  models.postalCode = props.modelValue?.postal_code || ''
  models.phone = props.modelValue?.phone || ''
  models.saveInfo = props.modelValue?.is_primary || 0
}

onMounted(async () => {
  await getCountries()
})

async function getCountries() {
  try {
    await countryStore.getCountries()
    countries.value = countryStore.countries
  } catch ({ message }) {
    toast(message, {
      type: 'error',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_RIGHT,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}

async function editAddress() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    clearTimeout(timeout)
    isLoading.value = true
    isError.value = false
    await addressStore.editAddress(formData.value)
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
  models.firstName = ''
  models.lastName = ''
  models.address = ''
  models.city = ''
  models.country = ''
  models.province = ''
  models.postalCode = ''
  models.phone = ''
  models.saveInfo = 0
}

function onClose() {
  resetForm()
  initModels()
  emit('onClose')
}
</script>
