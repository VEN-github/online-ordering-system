<template>
  <div class="rounded-md p-4 text-sm" :class="[`alert-${mode}`]">
    <slot></slot>
  </div>
</template>

<script setup>
defineProps({
  mode: {
    type: String,
    default() {
      return 'primary'
    }
  }
})
</script>
