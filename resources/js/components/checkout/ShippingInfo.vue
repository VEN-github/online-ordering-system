<template>
  <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>
  <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
    <div v-if="addressLists.length" class="sm:col-span-2">
      <FormLabel label-id="saved-address">Saved Address</FormLabel>
      <div class="mt-1">
        <FormSelect id="saved-address" class="!mt-0">
          <option value="" disabled>Saved Address</option>
          <option v-for="address in addressLists" :key="address" :value="address">
            {{ address.country }}
          </option>
        </FormSelect>
      </div>
    </div>
    <div>
      <FormLabel label-id="first-name">First name</FormLabel>
      <div class="mt-1">
        <FormInput id="first-name" v-model="models.firstName" />
      </div>
    </div>
    <div>
      <FormLabel label-id="last-name">Last name</FormLabel>
      <div class="mt-1">
        <FormInput id="last-name" v-model="models.lastName" />
      </div>
    </div>
    <div class="sm:col-span-2">
      <FormLabel label-id="address">Address</FormLabel>
      <div class="mt-1">
        <FormInput id="address" v-model="models.address" />
      </div>
    </div>
    <div>
      <FormLabel label-id="city">City</FormLabel>
      <div class="mt-1">
        <FormInput id="city" v-model="models.city" />
      </div>
    </div>
    <div>
      <FormLabel label-id="country">Country</FormLabel>
      <div class="mt-1">
        <FormSelect id="country" v-model="models.country" class="!mt-0">
          <option value="" disabled>Select country</option>
          <option v-for="country in countries" :key="country.code" :value="country.name">
            {{ country.name }}
          </option>
        </FormSelect>
      </div>
    </div>
    <div>
      <FormLabel label-id="province">Province</FormLabel>
      <div class="mt-1">
        <FormInput id="province" v-model="models.province" />
      </div>
    </div>
    <div>
      <FormLabel label-id="postal-code">Postal code</FormLabel>
      <div class="mt-1">
        <FormInput id="postal-code" v-model="models.postalCode" />
      </div>
    </div>
    <div class="sm:col-span-2">
      <FormLabel label-id="phone">Phone</FormLabel>
      <div class="mt-1">
        <FormInput id="phone" v-model="models.phone" />
      </div>
    </div>
    <div class="sm-col-span-2">
      <FormCheckbox
        id="save-info"
        v-model="models.saveInfo"
        label="Save this information for next time"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useAddressStore } from '@/store/address/address'
import { useCountryStore } from '@/store/common/country'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormSelect from '@/components/UI/forms/FormSelect.vue'
import FormCheckbox from '@/components/UI/forms/FormCheckbox.vue'

const props = defineProps({
  modelValue: {
    type: [String, Object],
    default() {
      return {}
    }
  }
})
const emit = defineEmits(['update:modelValue'])

const addressStore = useAddressStore()
const countryStore = useCountryStore()
const addressLists = ref([])
const countries = ref([])

const models = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})

onMounted(async () => {
  await getSavedAddress()
  await getCountries()
})

async function getSavedAddress() {
  try {
    await addressStore.getSavedAddress()
    addressLists.value = addressStore.addressLists
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
</script>
