<template>
  <div class="space-y-4">
    <BaseCard size="full">
      <h1 class="text-2xl font-semibold text-emerald-500">Welcome, {{ loggedAdmin }}</h1>
      <p class="mt-2 pb-5">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, quasi amet. Explicabo fugiat
        quisquam impedit. Officiis aliquid voluptates odit voluptatum.
      </p>
      <div class="flex items-center justify-between border-t pt-5">
        <div
          v-for="(data, index) in formattedDashboardData"
          :key="index"
          class="flex items-center gap-4"
        >
          <div class="flex h-full rounded-full bg-emerald-50 p-3">
            <Icon :icon="getIcon(index)" class="h-6 w-6 text-emerald-500" />
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">{{ data.title }}</p>
            <p class="text-3xl font-semibold text-slate-700">{{ data.value }}</p>
          </div>
        </div>
      </div>
    </BaseCard>
    <div class="grid grid-cols-12 gap-4">
      <div class="col-span-8">
        <BaseCard size="full">
          <apexchart type="area" height="500" :options="chartOptions" :series="series"></apexchart>
        </BaseCard>
      </div>
      <div class="col-span-4">
        <BaseCard size="full">
          <h2 class="font-medium text-slate-800 lg:text-lg">Top selling Products</h2>
          <DataTable ref="table" :config="config">
            <template #table-head>
              <tr>
                <th>Name</th>
              </tr>
            </template>
          </DataTable>
        </BaseCard>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useAuthStore } from '@/store/auth/auth'
import { useDashboardStore } from '@/store/dashboard/dashboard'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import BaseCard from '@/components/UI/card/BaseCard.vue'
import DataTable from '@/components/UI/table/DataTable.vue'

const authStore = useAuthStore()
const dashboardStore = useDashboardStore()
const dashboardData = ref(null)
const series = ref([{ data: [25, 30, 52, 58, 566, 78, 52] }])
const table = ref(null)

const loggedAdmin = computed(() => {
  return `${authStore.getLoggedAdmin?.first_name} ${authStore.getLoggedAdmin?.last_name}`
})

const formattedDashboardData = computed(() => {
  if (!dashboardData.value) return []

  const originalData = dashboardData.value

  const newObj = {
    sales: {
      title: 'Total Sales this month',
      value: formatPrice(originalData.total_sales_per_month[0].total_sales)
    },
    income: {
      title: 'Total Income this month',
      value: formatPrice(originalData.total_income_current_month)
    },
    pending: { title: 'Pending Orders', value: originalData.total_pending_orders },
    user: { title: 'No. of Users', value: originalData.total_registered_users }
  }

  return newObj
})

const token = computed(() => {
  return authStore.getAccessToken
})

const chartOptions = computed(() => {
  return {
    chart: {
      type: 'area'
    },
    dataLabels: {
      enabled: false
    },
    colors: ['#10b981'],
    stroke: {
      curve: 'smooth'
    },
    title: {
      text: 'Sales Overview',
      align: 'left'
    },
    tooltip: {
      enabled: false
    }
  }
})

const config = computed(() => {
  return {
    searching: false,
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
      }
    ],
    columns: [{ data: 'name' }]
  }
})

onMounted(async () => {
  await getDashboardData()
})

async function getDashboardData() {
  try {
    await dashboardStore.getDashboardData()
    dashboardData.value = dashboardStore.dashboardData
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

function formatPrice(price) {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(price)
}

function getIcon(icon) {
  switch (icon) {
    case 'sales':
      return 'mdi:cart-outline'
    case 'income':
      return 'icomoon-free:price-tags'
    case 'pending':
      return 'material-symbols:pending-actions'
    default:
      return 'ph:users-duotone'
  }
}
</script>
