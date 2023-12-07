<template>
  <div class="flex items-center justify-between space-x-4 py-5 lg:py-6">
    <h2 class="text-xl font-medium text-slate-800 lg:text-2xl">Inventory</h2>
    <BaseButton mode="primary" size="lg" @click="toggleAddForm">Add Inventory</BaseButton>
  </div>
  <div class="mt-5 flow-root">
    <DataTable ref="table" :config="config">
      <template #table-head>
        <tr>
          <th>Product Name</th>
          <th>Added Stock</th>
          <th>Added By</th>
          <th>Date & Time</th>
        </tr>
      </template>
    </DataTable>
  </div>
  <InventoryAddForm
    :is-show="showAddForm"
    :products="products"
    @on-close="toggleAddForm"
    @submit-form="toggleConfirmation"
  />
  <ConfirmationModal
    :is-show="showConfirmation"
    modal-type="info"
    title="Add Inventory"
    message="Are you sure you want to add stock to this product? This action cannot be undone."
    confirm-text="Confirm"
    @on-close="toggleConfirmation"
    @on-confirm="addInventory"
  />
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useAuthStore } from '@/store/auth/auth'
import { useInventoryStore } from '@/store/inventory/inventory'
import dayjs from 'dayjs'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import DataTable from '@/components/UI/table/DataTable.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import InventoryAddForm from '@/components/inventory/InventoryAddForm.vue'
import ConfirmationModal from '@/components/UI/modal/ConfirmationModal.vue'

const authStore = useAuthStore()
const inventoryStore = useInventoryStore()
const table = ref(null)
const products = ref([])
const showAddForm = ref(false)
const showConfirmation = ref(false)
const models = ref(null)

const token = computed(() => {
  return authStore.getAccessToken
})

const config = computed(() => {
  return {
    serverSide: true,
    processing: true,
    ajax: {
      url: '/api/admin/inventories',
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
        render: function (_, _2, rowData) {
          return `${rowData.added_by.first_name} ${rowData.added_by.last_name}`
        }
      },
      {
        target: 3,
        render: function (_, _2, rowData) {
          return dayjs(rowData.created_at).format('MMMM DD, YYYY hh:mm A')
        }
      }
    ],
    columns: [
      { data: 'product.name' },
      { data: 'added_stock' },
      { data: 'added_by' },
      { data: 'created_at' }
    ]
  }
})

onMounted(async () => {
  await getProducts()
})

async function getProducts() {
  try {
    await inventoryStore.getProducts()
    products.value = inventoryStore.products
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

function toggleAddForm() {
  showAddForm.value = !showAddForm.value
}

function toggleConfirmation(formData) {
  models.value = formData
  showAddForm.value = false
  showConfirmation.value = !showConfirmation.value
}

async function addInventory() {
  try {
    showConfirmation.value = false
    await inventoryStore.addInventory(models.value)
    toast('Successfully Added', {
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
      position: toast.POSITION.TOP_CENTER,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}
</script>
