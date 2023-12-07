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
            <p class="text-sm font-medium text-gray-500">
              {{ data.title }}
              <span v-if="index === 'sales' || index === 'income'">({{ currentMonth }})</span>
            </p>
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
                <th>Price</th>
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
import dayjs from 'dayjs'

import BaseCard from '@/components/UI/card/BaseCard.vue'
import DataTable from '@/components/UI/table/DataTable.vue'

const authStore = useAuthStore()
const dashboardStore = useDashboardStore()
const dashboardData = ref(null)
const table = ref(null)

const currentYear = computed(() => {
  return dayjs().format('YYYY')
})

const currentMonth = computed(() => {
  return dayjs().format('MMM YYYY')
})

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

const series = computed(() => {
  if (!dashboardData.value) return []

  return [{ data: dashboardData.value?.sales_overview }]
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
      text: `Sales Overview (${currentYear.value})`,
      align: 'left'
    },
    xaxis: {
      categories: [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sept',
        'Oct',
        'Nov',
        'Dec'
      ]
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
    paging: false,
    info: false,
    ajax: {
      url: '/api/admin/dashboard',
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
      dataSrc: 'data.top_selling_products'
    },
    columns: [{ data: 'name' }, { data: 'price' }]
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
