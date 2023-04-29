<template>
  <Teleport to="body">
    <div
      v-if="isOpen"
      class="relative z-50"
      aria-labelledby="modal-title"
      role="dialog"
      aria-modal="true"
    >
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 sm:p-0">
          <BaseCard v-if="currentMode === 'delete'">
            <div class="max-w-md sm:flex sm:items-start">
              <div
                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
              >
                <svg
                  class="h-6 w-6 text-red-600"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"
                  />
                </svg>
              </div>
              <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                <h3 id="modal-title" class="text-base font-semibold leading-6 text-gray-900">
                  Delete Supplier
                </h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">
                    Are you sure you want to delete this supplier? This action cannot be undone.
                  </p>
                </div>
              </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
              <button
                type="button"
                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"
                @click="submitForm"
              >
                Delete
              </button>
              <button
                type="button"
                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                @click="isOpen = false"
              >
                Cancel
              </button>
            </div>
          </BaseCard>
          <BaseCard v-else>
            <span class="flex cursor-pointer justify-end" @click="isOpen = false">X</span>
            <form class="space-y-6" @submit.prevent="submitForm">
              <div>
                <FormLabel label-id="supplier-name" :is-invalid="v$.name.$error">Name</FormLabel>
                <div class="mt-2">
                  <FormInput
                    id="supplier-name"
                    v-model="models.name"
                    placeholder="Enter supplier name"
                    :is-invalid="v$.name.$error"
                  />
                </div>
                <FormValidation v-if="v$.name.$error"> Name is required. </FormValidation>
              </div>
              <div>
                <FormLabel label-id="city" :is-invalid="v$.city.$error">City</FormLabel>
                <div class="mt-2">
                  <FormInput
                    id="city"
                    v-model="models.city"
                    placeholder="Enter city"
                    :is-invalid="v$.city.$error"
                  />
                </div>
                <FormValidation v-if="v$.city.$error"> City is required. </FormValidation>
              </div>
              <div>
                <FormLabel label-id="country" :is-invalid="v$.country.$error">Country</FormLabel>
                <div class="mt-2">
                  <FormInput
                    id="country"
                    v-model="models.country"
                    placeholder="Enter country"
                    :is-invalid="v$.country.$error"
                  />
                </div>
                <FormValidation v-if="v$.country.$error"> Country is required. </FormValidation>
              </div>
              <div>
                <BaseButton
                  type="submit"
                  size="lg"
                  is-full
                  :disabled="isLoading"
                  class="capitalize"
                >
                  <Icon v-if="isLoading" icon="gg:spinner" class="animate-spin text-base" />
                  {{ isLoading ? 'Loading...' : currentMode }}
                </BaseButton>
              </div>
            </form>
          </BaseCard>
        </div>
      </div>
    </div>
  </Teleport>
  <div class="flex items-center justify-between">
    <h1 class="text-3xl font-semibold leading-tight tracking-tight text-gray-700">Supplier</h1>
    <BaseButton size="lg" @click="toggleForm('add')">Add Supplier</BaseButton>
  </div>
  <div class="mt-10">
    <TheTable :columns="columns" :server="server" search sort pagination />
  </div>
  <Transition name="slide-fade">
    <div v-if="isError" class="fixed top-4 right-4 z-50">
      <AlertError :message="errorMsg" @close-alert="closeAlert" />
    </div>
  </Transition>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { useAuthStore } from '@/store/auth'
import { useSupplierStore } from '@/store/supplier'
import { useVuelidate } from '@vuelidate/core'
import { required } from '@vuelidate/validators'
import { h } from 'gridjs'

import TheTable from '@/components/UI/table/TheTable.vue'
import BaseButton from '@/components/UI/buttons/BaseButton.vue'
import BaseCard from '@/components/UI/cards/BaseCard.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import AlertError from '@/components/UI/errors/AlertError.vue'

const authStore = useAuthStore()
const supplierStore = useSupplierStore()
const isOpen = ref(false)
const currentMode = ref(null)
const isLoading = ref(false)
const models = reactive({
  id: '',
  name: '',
  city: '',
  country: ''
})
const isError = ref(false)
const errorMsg = ref('')
const columns = ref([
  {
    name: 'ID',
    hidden: true
  },
  'Name',
  'Address',
  {
    name: 'Actions',
    formatter: (_, row) => {
      return h('div', { className: 'grid grid-cols-2 divide-x' }, [
        h(
          'button',
          {
            className: 'text-sky-500 hover:underline hover:text-sky-800',
            onClick: () => editSupplier(row, 'edit')
          },
          'Edit'
        ),
        h(
          'button',
          {
            className: 'text-red-500 hover:underline hover:text-red-800',
            onClick: () => deleteSupplier(row, 'delete')
          },
          'Delete'
        )
      ])
    }
  }
])

const token = computed(() => {
  return authStore?.getLoggedAdmin?.token
})

const server = reactive({
  url: '/api/admin/suppliers',
  headers: {
    Authorization: `Bearer ${token.value}`
  },
  then: (data) =>
    data.data.map((supplier) => [
      supplier.id,
      supplier.name,
      supplier.city + ', ' + supplier.country
    ])
})

const rules = computed(() => {
  return {
    name: { required },
    city: { required },
    country: { required }
  }
})

const params = computed(() => {
  return {
    name: models.name || null,
    city: models.city || null,
    country: models.country || null
  }
})

const v$ = useVuelidate(rules, models)

function resetForm() {
  v$.value.$reset()
  models.id = ''
  models.name = ''
  models.city = ''
  models.country = ''
}

async function submitForm() {
  if (currentMode.value === 'delete') {
    try {
      await supplierStore.deleteSupplier(models.id, token.value)
      isOpen.value = false
      location.reload()
    } catch ({ message }) {
      isOpen.value = false
      isError.value = true
      errorMsg.value = message

      setTimeout(() => {
        isError.value = false
        errorMsg.value = ''
      }, 3000)
    }
    return
  }

  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  if (currentMode.value === 'add') {
    try {
      isLoading.value = true
      await supplierStore.addSupplier(models, token.value)
      isLoading.value = false
      isOpen.value = false
      location.reload()
    } catch ({ message }) {
      isLoading.value = false
      isOpen.value = false
      isError.value = true
      errorMsg.value = message

      setTimeout(() => {
        isError.value = false
        errorMsg.value = ''
      }, 3000)
    }
    return
  }
  if (currentMode.value === 'edit') {
    try {
      isLoading.value = true
      await supplierStore.editSupplier(models.id, token.value, params.value)
      isLoading.value = false
      isOpen.value = false
      location.reload()
    } catch ({ message }) {
      isLoading.value = false
      isOpen.value = false
      isError.value = true
      errorMsg.value = message

      setTimeout(() => {
        isError.value = false
        errorMsg.value = ''
      }, 3000)
    }
    return
  }
}

function editSupplier(row, mode) {
  currentMode.value = mode
  const address = row.cells[2].data.split(',')
  models.id = row.cells[0].data
  models.name = row.cells[1].data
  models.city = address[0]
  models.country = address[1]
  isOpen.value = true
}

function deleteSupplier(row, mode) {
  currentMode.value = mode
  models.id = row.cells[0].data
  isOpen.value = true
}

function closeAlert() {
  isError.value = false
}

function toggleForm(mode) {
  resetForm()
  currentMode.value = mode
  isOpen.value = !isOpen.value
}
</script>
