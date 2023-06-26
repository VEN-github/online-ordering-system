<template>
  <div class="flex items-center justify-between space-x-4 py-5 lg:py-6">
    <h2 class="text-xl font-medium text-slate-800 lg:text-2xl">Products</h2>
    <BaseButton mode="primary" size="lg" link="/products/create" is-link>
      Add New Product
    </BaseButton>
  </div>
  <div class="mt-5 flow-root">
    <DataTable ref="table" :config="config">
      <template #table-head>
        <tr>
          <th>Product Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Overall Stocks</th>
          <th>Inventory Status</th>
          <th>Product Status</th>
          <th>Actions</th>
        </tr>
      </template>
    </DataTable>
  </div>
  <ConfirmationModal
    :is-show="showDeleteModal"
    modal-type="danger"
    title="Delete Product"
    message="Are you sure you want to delete this Product? This action cannot be undone."
    confirm-text="Delete"
    @on-close="toggleDeleteModal"
    @on-confirm="deleteProduct"
  />
</template>

<script setup>
import { ref, computed } from 'vue'
import { useAuthStore } from '@/store/auth/auth'
import { useProductStore } from '@/store/products/product'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import DataTable from '@/components/UI/table/DataTable.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import ConfirmationModal from '@/components/UI/modal/ConfirmationModal.vue'

const authStore = useAuthStore()
const productStore = useProductStore()
const table = ref(null)
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
      url: '/api/admin/products',
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
              src="${rowData.highlight_image}"
              alt="product image"
              class="w-20 h-20 object-cover rounded-md"
            >
          `
          const placeholder = `
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"><path fill="currentColor" d="M21 17.2L6.8 3H19c1.1 0 2 .9 2 2v12.2m-.3 4.8l-1-1H5c-1.1 0-2-.9-2-2V4.3l-1-1L3.3 2L22 20.7L20.7 22m-3.9-4l-3.9-3.9l-1.9 2.4l-2.5-3L5 18h11.8Z"/></svg>
          `
          cell.innerHTML = `
            <div class="flex items-center space-x-2">
              ${rowData.highlight_image ? image : placeholder}
              <p>${rowData.name}</p>
            </div>
          `
        }
      },
      {
        target: 2,
        createdCell: function (cell, _, rowData) {
          const formattedPrice = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP'
          }).format(rowData.orig_price)
          const formattedDiscountPrice = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP'
          }).format(rowData.discounted_price)

          if (rowData.discounted_price) {
            cell.innerHTML = `
              <div class="flex items-center space-x-2">
                <p class="line-through text-sm text-slate-400">${formattedPrice}</p>
                <p>${formattedDiscountPrice}</p>
              </div>
            `
          } else {
            cell.innerHTML = `
              <p>${formattedPrice}</p>
            `
          }
        }
      },
      {
        target: 3,
        createdCell: function (cell, _, rowData) {
          const variationStock = rowData.variations?.map((variation) => variation.stock)
          const allStocks = variationStock.reduce((acc, curr) => {
            return acc + curr
          }, 0)

          if (rowData.variations.length) {
            cell.innerHTML = `
              <p>${allStocks}</p>
            `
          } else {
            cell.innerHTML = `
              <p>${rowData.stocks}</p>
            `
          }
        }
      },
      {
        target: 4,
        createdCell: function (cell, _, rowData) {
          const variationStock = rowData.variations?.map((variation) => variation.stock)
          const allStocks = variationStock.reduce((acc, curr) => {
            return acc + curr
          }, 0)

          if (rowData.variations.length) {
            if (allStocks === 0) {
              cell.innerHTML = `
                <p class="text-sm font-medium text-red-500">Out of Stock</p>
              `
            } else if (allStocks <= 10) {
              cell.innerHTML = `
                <p class="text-sm font-medium text-yellow-500">Low Stock</p>
              `
            } else {
              cell.innerHTML = `
                <p class="text-sm font-medium text-emerald-500">In stock</p>
              `
            }
          } else {
            if (rowData.stocks === 0) {
              cell.innerHTML = `
                <p class="text-sm font-medium text-red-500">Out of Stock</p>
              `
            } else if (rowData.stocks <= 10) {
              cell.innerHTML = `
                <p class="text-sm font-medium text-yellow-500">Low Stock</p>
              `
            } else {
              cell.innerHTML = `
                <p class="text-sm font-medium text-emerald-500">In stock</p>
              `
            }
          }
        }
      },
      {
        target: 5,
        render: function (_, _2, rowData) {
          return `
            <span class="badge ${!rowData.is_active ? 'badge-error' : 'badge-success'}">
              ${!rowData.is_active ? 'Inactive' : 'Active'}
            </span>`
        }
      },
      {
        target: 6,
        createdCell: function (cell, _, rowData) {
          cell.innerHTML = `
            <div class="flex">
              <button type="button" class="preview btn btn-flat-default btn--md shadow-none">Preview</button>
              <div class="mx-4 my-1 w-px bg-slate-200"></div>
              <button type="button" class="edit btn btn-flat-info btn--md shadow-none">Edit</button>
              <div class="mx-4 my-1 w-px bg-slate-200"></div>
              <button type="button"class="delete btn btn-flat-danger btn--md shadow-none">Delete</button>
            </div>
          `
          cell.onclick = (event) => {
            if (event.target.classList.contains('edit')) {
              models.value = rowData
              // toggleEditForm()
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
    columns: [
      { data: 'name' },
      { data: 'category.name' },
      { data: 'orig_price' },
      { data: 'stocks' },
      { data: 'stocks' },
      { data: 'is_active' },
      { data: null }
    ]
  }
})

function toggleDeleteModal() {
  showDeleteModal.value = !showDeleteModal.value
}

async function deleteProduct() {
  try {
    await productStore.deleteProduct(models.value.slug)
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
