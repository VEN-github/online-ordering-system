<template>
  <div ref="table"></div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Grid } from 'gridjs'
import 'gridjs/dist/theme/mermaid.css'

const props = defineProps({
  columns: {
    type: Array,
    default() {
      return []
    }
  },
  server: {
    type: Object,
    default() {
      return {}
    }
  },
  search: {
    type: Boolean,
    default() {
      return false
    }
  },
  sort: {
    type: Boolean,
    default() {
      return false
    }
  },
  pagination: {
    type: Boolean,
    default() {
      return false
    }
  },
  resizable: {
    type: Boolean,
    default() {
      return false
    }
  },
  autoWidth: {
    type: Boolean,
    default() {
      return false
    }
  }
})

const table = ref(null)

onMounted(() => {
  const grid = new Grid({
    columns: props.columns,
    server: props.server,
    search: props.search,
    sort: props.sort,
    pagination: props.pagination,
    resizable: props.resizable,
    autoWidth: props.autoWidth
  })
  grid.render(table.value)
})
</script>
