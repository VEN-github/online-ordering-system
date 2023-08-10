<template>
  <div class="flex items-center justify-between space-x-4 py-5 lg:py-6">
    <h2 class="text-xl font-medium text-slate-800 lg:text-2xl">Categories</h2>
    <BaseButton mode="primary" size="lg" @click="toggleAddForm">Add Category</BaseButton>
  </div>
  <div class="mt-5 flow-root">
    <DataTable ref="table" :config="config">
      <template #table-head>
        <tr>
          <th>Name</th>
          <th>Slug</th>
          <th>Actions</th>
        </tr>
      </template>
    </DataTable>
  </div>
  <CategoryAddForm :is-show="showAddForm" @on-close="toggleAddForm" @on-success="onSuccess" />
  <CategoryEditForm
    :is-show="showEditForm"
    :model-value="models"
    @on-close="toggleEditForm"
    @on-success="onSuccess"
  />
  <ConfirmationModal
    :is-show="showDeleteModal"
    modal-type="danger"
    title="Delete Category"
    message="Are you sure you want to delete this Category? This action cannot be undone."
    confirm-text="Delete"
    @on-close="toggleDeleteModal"
    @on-confirm="deleteCategory"
  />
</template>

<script setup>
import { ref, computed } from 'vue'
import { useAuthStore } from '@/store/auth/auth'
import { useCategoryStore } from '@/store/products/category'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import DataTable from '@/components/UI/table/DataTable.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import CategoryAddForm from '@/components/products/category/CategoryAddForm.vue'
import CategoryEditForm from '@/components/products/category/CategoryEditForm.vue'
import ConfirmationModal from '@/components/UI/modal/ConfirmationModal.vue'

const authStore = useAuthStore()
const categoryStore = useCategoryStore()
const table = ref(null)
const showAddForm = ref(false)
const showEditForm = ref(false)
const showDeleteModal = ref(false)
const models = ref(null)

const token = computed(() => {
  return authStore.getAccessToken
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
        target: 0,
        createdCell: function (cell, _, rowData) {
          const image = `
            <img
              src="${rowData.image}"
              alt="product image"
              class="w-20 h-20 object-cover rounded-md"
            >
          `
          const placeholder = `
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"><path fill="currentColor" d="M21 17.2L6.8 3H19c1.1 0 2 .9 2 2v12.2m-.3 4.8l-1-1H5c-1.1 0-2-.9-2-2V4.3l-1-1L3.3 2L22 20.7L20.7 22m-3.9-4l-3.9-3.9l-1.9 2.4l-2.5-3L5 18h11.8Z"/></svg>
          `
          cell.innerHTML = `
            <div class="flex items-center space-x-2">
              ${rowData.image ? image : placeholder}
              <p>${rowData.name}</p>
            </div>
          `
        }
      },
      {
        target: 2,
        createdCell: function (cell, _, rowData) {
          cell.innerHTML = `
            <div class="flex">
              <button type="button" class="edit btn btn-flat-info btn--md shadow-none">Edit</button>
              <div class="mx-4 my-1 w-px bg-slate-200"></div>
              <button type="button"class="delete btn btn-flat-danger btn--md shadow-none">Delete</button>
            </div>
          `
          cell.onclick = (event) => {
            if (event.target.classList.contains('edit')) {
              models.value = rowData
              toggleEditForm()
              return
            }
            if (event.target.classList.contains('delete')) {
              models.value = rowData
              toggleDeleteModal()
              return
            }
          }
        }
      }
    ],
    columns: [{ data: 'name' }, { data: 'slug' }, { data: null }]
  }
})

function toggleAddForm() {
  showAddForm.value = !showAddForm.value
}

function toggleEditForm() {
  showEditForm.value = !showEditForm.value
}

function toggleDeleteModal() {
  showDeleteModal.value = !showDeleteModal.value
}

function onSuccess() {
  showAddForm.value = false
  showEditForm.value = false
  table.value.reload()
}

async function deleteCategory() {
  try {
    await categoryStore.deleteCategory(models.value.slug)
    showDeleteModal.value = false
    toast('Successfully Deleted', {
      type: 'success',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_CENTER,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
    table.value.reload()
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
