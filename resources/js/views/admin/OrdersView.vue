<template>
  <div class="flex items-center justify-between space-x-4 py-5 lg:py-6">
    <h2 class="text-xl font-medium text-slate-800 lg:text-2xl">Orders</h2>
  </div>
  <div class="mt-5 flow-root">
    <DataTable ref="table" :config="config">
      <template #table-head>
        <tr>
          <th>Order No.</th>
          <th>Name</th>
          <th>Payment Status</th>
          <th>Order Status</th>
          <th>Actions</th>
        </tr>
      </template>
    </DataTable>
  </div>
  <UpdateForm
    :is-show="showUpdateForm"
    :model-value="models"
    @on-close="showUpdateForm = false"
    @on-success="onSuccess"
  />
</template>

<script setup>
import { ref, computed } from 'vue'
import { useAuthStore } from '@/store/auth/auth'

import DataTable from '@/components/UI/table/DataTable.vue'
import UpdateForm from '@/components/orders/UpdateForm.vue'

const authStore = useAuthStore()
const table = ref(null)
const models = ref(null)
const showUpdateForm = ref(false)

const token = computed(() => {
  return authStore.getAccessToken
})

const config = computed(() => {
  return {
    serverSide: true,
    processing: true,
    ajax: {
      url: '/api/admin/orders',
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
        target: 1,
        createdCell: function (cell, _, rowData) {
          cell.innerHTML = `
            <p>${rowData.user.first_name} ${rowData.user.last_name}</p>
            <p class="text-sm">${rowData.email}</p>
          `
        }
      },
      {
        target: 2,
        createdCell: function (cell, _, rowData) {
          cell.innerHTML = `
            <p class="capitalize w-fit rounded py-0.5 px-2" style="background-color: ${checkStatusColor(
              rowData.payment_status
            )}20;color: ${checkStatusColor(rowData.payment_status)}">${rowData.payment_status}</p>
          `
        }
      },
      {
        target: 3,
        createdCell: function (cell, _, rowData) {
          cell.innerHTML = `
            <p class="capitalize w-fit rounded py-0.5 px-2" style="background-color: ${checkStatusColor(
              rowData.status
            )}20;color: ${checkStatusColor(rowData.status)}">${rowData.status}</p>
          `
        }
      },
      {
        target: 4,
        createdCell: function (cell, _, rowData) {
          cell.innerHTML = `
            <div class="flex">
              <button type="button" class="view btn btn-flat-success btn--md shadow-none">View</button>
              <div class="mx-4 my-1 w-px bg-slate-200"></div>
              <button type="button"class="update btn btn-flat-info btn--md shadow-none">Update</button>
            </div>
          `
          cell.onclick = (event) => {
            if (event.target.classList.contains('view')) {
              models.value = rowData
              return
            }
            if (event.target.classList.contains('update')) {
              models.value = rowData
              showUpdateForm.value = true
              return
            }
          }
        }
      }
    ],
    columns: [
      { data: 'ref_id' },
      { data: 'first_name' },
      { data: 'payment_status' },
      { data: 'status' },
      { data: null }
    ]
  }
})

function checkStatusColor(status) {
  switch (status) {
    case 'pending':
      return '#eab308'
    case 'processing':
      return '#0ea5e9'
    case 'confirmed':
      return '#84cc16'
    case 'shipped':
      return '#3b82f6'
    case 'completed':
    case 'paid':
      return '#22c55e'
    case 'cancelled':
    case 'failed':
      return '#ef4444'
    case 'refunded':
      return '#f97316'
    default:
      return '#334155'
  }
}

function onSuccess() {
  showUpdateForm.value = false
  table.value.reload()
}
</script>
