<template>
  <div class="space-y-4">
    <BaseCard size="full">
      <h1 class="text-2xl font-semibold text-emerald-500">Welcome, {{ loggedAdmin }}</h1>
      <p class="mt-2 pb-5">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, quasi amet. Explicabo fugiat
        quisquam impedit. Officiis aliquid voluptates odit voluptatum.
      </p>
      <div class="flex items-center justify-between border-t pt-5">
        <div v-for="i in 4" :key="i" class="flex items-center gap-4">
          <div class="flex h-full rounded-full bg-emerald-50 p-3">
            <Icon icon="mdi:cart-outline" class="h-6 w-6 text-emerald-500" />
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Total Sales this month</p>
            <p class="text-3xl font-semibold text-slate-700">10000</p>
          </div>
        </div>
      </div>
    </BaseCard>
    <BaseCard size="full">
      <apexchart type="area" height="350" :options="chartOptions" :series="series"></apexchart>
    </BaseCard>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useAuthStore } from '@/store/auth/auth'

import BaseCard from '@/components/UI/card/BaseCard.vue'

const authStore = useAuthStore()
const series = ref([{ data: [25, 30, 52, 58, 566, 78, 52] }])

const loggedAdmin = computed(() => {
  return `${authStore.getLoggedAdmin?.first_name} ${authStore.getLoggedAdmin?.last_name}`
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
</script>
