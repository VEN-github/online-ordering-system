<template>
  <table id="data-table" class="min-w-full divide-y divide-gray-300">
    <thead class="bg-gray-50">
      <slot name="table-head"></slot>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
      <slot name="table-body"></slot>
    </tbody>
  </table>
</template>

<script setup>
import { onMounted } from 'vue'
import DataTable from 'datatables.net-dt'

const props = defineProps({
  config: {
    type: Object,
    default() {
      return {}
    }
  }
})

onMounted(() => {
  new DataTable('#data-table', {
    ...props.config,
    dom: '<"table-top"f><"table-wrapper"rt><"table-bottom"ip>',
    ordering: false,
    language: {
      searchPlaceholder: 'Type a keyword...'
    }
  })
})
</script>
