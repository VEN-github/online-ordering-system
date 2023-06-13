<template>
  <table id="data-table" ref="dataTable" class="min-w-full divide-y divide-gray-300">
    <thead class="bg-gray-50">
      <slot name="table-head"></slot>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
      <slot name="table-body"></slot>
    </tbody>
  </table>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import DataTable from 'datatables.net-dt'

const props = defineProps({
  config: {
    type: Object,
    default() {
      return {}
    }
  }
})
const emit = defineEmits(['update:dataTable'])

const dataTable = ref(null)

onMounted(() => {
  dataTable.value = new DataTable('#data-table', {
    ...props.config,
    dom: '<"table-top"f><"table-wrapper"rt><"table-bottom"ip>',
    ordering: false,
    language: {
      searchPlaceholder: 'Type a keyword...'
    }
  })

  emit('update:dataTable', dataTable.value)
})
</script>
