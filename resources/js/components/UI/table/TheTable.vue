<template>
  <table ref="table">
    <slot></slot>
  </table>
  <div ref="tableWrapper"></div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { Grid } from 'gridjs'
import 'gridjs/dist/theme/mermaid.css'

const props = defineProps({
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
const tableWrapper = ref(null)

watch(
  tableWrapper,
  (value) => {
    const grid = new Grid({
      from: table.value,
      search: props.search,
      sort: props.sort,
      pagination: props.pagination,
      resizable: props.resizable,
      autoWidth: props.autoWidth
    })
    grid.render(value)
  },
  { deep: true }
)
</script>
