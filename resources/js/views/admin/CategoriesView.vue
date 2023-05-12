<template>
  <Teleport to="body">
    <BaseModal v-if="isOpen">
      <BaseCard v-if="currentMode === 'delete'">
        <div class="max-w-md sm:flex sm:items-start">
          <div
            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
          >
            <Icon icon="material-symbols:warning-rounded" class="h-6 w-6 text-red-600" />
          </div>
          <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Delete Category</h3>
            <div class="mt-2">
              <p class="text-sm text-gray-500">
                Are you sure you want to delete this supplier? This action cannot be undone.
              </p>
            </div>
          </div>
        </div>
        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
          <BaseButton mode="danger" class="w-full sm:ml-3 sm:w-auto" @click="submitForm">
            Delete
          </BaseButton>
          <BaseButton
            mode="outline-default"
            class="mt-3 w-full sm:mt-0 sm:w-auto"
            @click="isOpen = false"
          >
            Cancel
          </BaseButton>
        </div>
      </BaseCard>
      <BaseCard v-else>
        <div class="flex justify-end">
          <BaseButton mode="outline-default" @click="isOpen = false">
            <Icon icon="ph:x-bold" class="h-4 w-4" />
          </BaseButton>
        </div>
        <h2 class="my-3 text-center text-xl font-semibold text-slate-800">
          {{ currentMode === 'add' ? 'Add New Category' : 'Edit Category' }}
        </h2>
        <form class="space-y-6" @submit.prevent="submitForm">
          <div>
            <FormLabel label-id="category-name" :is-invalid="v$.name.$error">Name</FormLabel>
            <div class="mt-2">
              <FormInput
                id="category-name"
                v-model="models.name"
                placeholder="Enter category name"
                :is-invalid="v$.name.$error"
              />
            </div>
            <FormValidation v-if="v$.name.$error"> Name is required. </FormValidation>
          </div>
          <div>
            <FormLabel label-id="category-slug">Slug</FormLabel>
            <div class="mt-2">
              <FormInput
                id="category-slug"
                v-model="models.slug"
                placeholder="Enter slug (optional)"
              />
            </div>
          </div>
          <div>
            <BaseButton
              type="submit"
              mode="primary"
              size="lg"
              is-full
              :disabled="isLoading"
              class="capitalize"
            >
              <Icon v-if="isLoading" icon="gg:spinner" class="animate-spin text-base" />
              {{ isLoading ? 'Loading...' : `${currentMode} Category` }}
            </BaseButton>
          </div>
        </form>
      </BaseCard>
    </BaseModal>
  </Teleport>
  <div class="flex items-center justify-between space-x-4 py-5 lg:py-6">
    <h2 class="text-xl font-medium text-slate-800 lg:text-2xl">Categories</h2>
    <BaseButton mode="primary" size="lg" @click="toggleForm('add')">Add Category</BaseButton>
  </div>
  <div class="mt-5 flow-root">
    <DataTable :config="config">
      <template #table-head>
        <tr>
          <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
          <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Slug</th>
          <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
        </tr>
      </template>
    </DataTable>
  </div>
  <Transition name="slide-fade">
    <div v-if="isError" class="fixed top-4 right-4 z-50">
      <AlertError :message="errorMsg" @close-alert="closeAlert" />
    </div>
  </Transition>
</template>

<script setup>
import { ref, reactive, computed, watch, onUnmounted } from 'vue'
import { useAuthStore } from '@/store/auth'
import { useCategoryStore } from '@/store/category'
import { useVuelidate } from '@vuelidate/core'
import { required } from '@vuelidate/validators'

import DataTable from '@/components/UI/table/DataTable.vue'
import BaseButton from '@/components/UI/buttons/BaseButton.vue'
import BaseModal from '@/components/UI/modal/BaseModal.vue'
import BaseCard from '@/components/UI/cards/BaseCard.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import AlertError from '@/components/UI/errors/AlertError.vue'

const authStore = useAuthStore()
const categoryStore = useCategoryStore()
const isOpen = ref(false)
const currentMode = ref(null)
const isLoading = ref(false)
const models = reactive({
  name: '',
  slug: '',
  oldSlug: ''
})
const isError = ref(false)
const errorMsg = ref('')

const token = computed(() => {
  return authStore?.getLoggedAdmin?.token
})

const config = computed(() => {
  return {
    serverSide: true,
    processing: true,
    ajax: {
      url: '/api/admin/categories',
      headers: {
        Authorization: `Bearer ${token.value}`
      },
      dataFilter: function (d) {
        const json = JSON.parse(d)
        const { data } = json
        json.recordsTotal = data.total
        json.recordsFiltered = data.total
        json.data = data

        return JSON.stringify(json)
      },
      data: function (d) {
        d.page = Math.ceil((d.start + 1) / d.length)
        d.per_page = d.length
      },
      dataSrc: 'data.data'
    },
    columnDefs: [
      {
        target: 2,
        createdCell: function (cell, _, rowData) {
          cell.onclick = (event) => {
            if (event.target.id === 'edit') {
              editCategory(rowData, 'edit')
              return
            }
            if (event.target.id === 'delete') {
              deleteCategory(rowData, 'delete')
              return
            }
          }
        },
        render: function () {
          return `<div class="flex"><button id="edit" type="button" class="text-sky-500 hover:underline hover:text-sky-800">Edit</button><div class="mx-4 my-1 w-px bg-slate-200"></div><button id="delete" type="button"class="text-red-500 hover:underline hover:text-red-800">Delete</button></div>`
        }
      }
    ],
    columns: [{ data: 'name' }, { data: 'slug' }, { data: null }]
  }
})

const rules = computed(() => {
  return {
    name: { required }
  }
})

const v$ = useVuelidate(rules, models)

watch(isOpen, (value) => {
  if (value) document.addEventListener('click', detectClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', detectClickOutside)
})

function resetForm() {
  v$.value.$reset()
  models.name = ''
  models.slug = ''
  models.oldSlug = ''
}

async function submitForm() {
  if (currentMode.value === 'delete') {
    try {
      await categoryStore.deleteCategory(models.slug, token.value)
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

  try {
    isLoading.value = true
    if (currentMode.value === 'add') {
      await categoryStore.addCategory(models, token.value)
    } else {
      await categoryStore.editCategory(models, token.value)
    }
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
}

function editCategory({ name, slug }, mode) {
  currentMode.value = mode
  models.name = name
  models.slug = slug
  models.oldSlug = slug
  isOpen.value = true
}

function deleteCategory({ slug }, mode) {
  currentMode.value = mode
  models.slug = slug
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

function detectClickOutside(event) {
  if (event.target.classList.contains('modal-overlay')) {
    resetForm()
    isOpen.value = false
    isLoading.value = false
  }
}
</script>
