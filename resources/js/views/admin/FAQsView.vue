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
            <h3 class="text-base font-semibold leading-6 text-gray-900">Delete Q&A</h3>
            <div class="mt-2">
              <p class="text-sm text-gray-500">
                Are you sure you want to delete this Q&A? This action cannot be undone.
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
          {{ currentMode === 'add' ? 'Add New Q&A' : 'Edit Q&A' }}
        </h2>
        <form class="space-y-6" @submit.prevent="submitForm">
          <div>
            <FormLabel label-id="question" :is-invalid="v$.question.$error">Question</FormLabel>
            <div class="mt-2">
              <FormInput
                id="question"
                v-model="models.question"
                placeholder="Enter question"
                :is-invalid="v$.question.$error"
              />
            </div>
            <FormValidation v-if="v$.question.$error"> Question is required. </FormValidation>
          </div>
          <div>
            <FormLabel label-id="slug" :is-invalid="v$.slug.$error">Slug</FormLabel>
            <div class="mt-2">
              <FormInput
                id="slug"
                v-model="models.slug"
                placeholder="Enter slug"
                :is-invalid="v$.slug.$error"
              />
              <FormValidation v-if="v$.slug.$error"> Slug is required. </FormValidation>
            </div>
          </div>
          <div>
            <FormLabel label-id="answer" :is-invalid="v$.answer.$error">Answer</FormLabel>
            <div class="mt-2">
              <FormInput
                id="answer"
                v-model="models.answer"
                placeholder="Enter answer"
                :is-invalid="v$.answer.$error"
              />
            </div>
            <FormValidation v-if="v$.answer.$error"> Answer is required. </FormValidation>
          </div>
          <div>
            <FormSwitch v-model="models.active" label="Show on homepage" />
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
              {{ isLoading ? 'Loading...' : `${currentMode} Q&A` }}
            </BaseButton>
          </div>
        </form>
      </BaseCard>
    </BaseModal>
  </Teleport>
  <div class="flex items-center justify-between space-x-4 py-5 lg:py-6">
    <h2 class="text-xl font-medium text-slate-800 lg:text-2xl">Frequently Asked Question</h2>
    <BaseButton mode="primary" size="lg" @click="toggleForm('add')">Add Q&A</BaseButton>
  </div>
  <div class="mt-5 flow-root">
    <DataTable :config="config">
      <template #table-head>
        <tr>
          <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Question</th>
          <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Answer</th>
          <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
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
import { useFAQStore } from '@/store/faq'
import { useVuelidate } from '@vuelidate/core'
import { required } from '@vuelidate/validators'

import DataTable from '@/components/UI/table/DataTable.vue'
import BaseButton from '@/components/UI/buttons/BaseButton.vue'
import BaseModal from '@/components/UI/modal/BaseModal.vue'
import BaseCard from '@/components/UI/cards/BaseCard.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormSwitch from '@/components/UI/forms/FormSwitch.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import AlertError from '@/components/UI/errors/AlertError.vue'

const authStore = useAuthStore()
const faqStore = useFAQStore()
const isOpen = ref(false)
const currentMode = ref(null)
const isLoading = ref(false)
const models = reactive({
  question: '',
  slug: '',
  oldSlug: '',
  answer: '',
  active: 0
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
      url: '/api/admin/faqs',
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
        target: 0,
        render: function (_, _2, row) {
          return `<p class="truncate max-w-xs">${row.question}</p>`
        }
      },
      {
        target: 1,
        render: function (_, _2, row) {
          return `<p class="truncate max-w-xs">${row.answer}</p>`
        }
      },
      {
        target: 2,
        render: function (_, _2, row) {
          return `<span class="badge ${row.active === 0 ? 'badge-error' : 'badge-success'}">${
            row.active === 0 ? 'Inactive' : 'Active'
          }</span>`
        }
      },
      {
        target: 3,
        createdCell: function (cell, _, rowData) {
          cell.onclick = (event) => {
            if (event.target.id === 'edit') {
              editFAQ(rowData, 'edit')
              return
            }
            if (event.target.id === 'delete') {
              deleteFAQ(rowData, 'delete')
              return
            }
          }
        },
        render: function () {
          return `<div class="flex"><button id="edit" type="button" class="text-sky-500 hover:underline hover:text-sky-800">Edit</button><div class="mx-4 my-1 w-px bg-slate-200"></div><button id="delete" type="button"class="text-red-500 hover:underline hover:text-red-800">Delete</button></div>`
        }
      }
    ],
    columns: [{ data: 'question' }, { data: 'answer' }, { data: 'active' }, { data: null }]
  }
})

const rules = computed(() => {
  return {
    question: { required },
    slug: { required },
    answer: { required }
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
  models.question = ''
  models.slug = ''
  models.oldSlug = ''
  models.answer = ''
  models.active = 0
}

async function submitForm() {
  if (currentMode.value === 'delete') {
    try {
      await faqStore.deleteFAQ(models.slug, token.value)
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
      await faqStore.addFAQ(models, token.value)
    } else {
      await faqStore.editFAQ(models.oldSlug, models, token.value)
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

function editFAQ({ question, slug, answer, active }, mode) {
  currentMode.value = mode
  models.question = question
  models.slug = slug
  models.oldSlug = slug
  models.answer = answer
  models.active = active
  isOpen.value = true
}

function deleteFAQ({ slug }, mode) {
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
