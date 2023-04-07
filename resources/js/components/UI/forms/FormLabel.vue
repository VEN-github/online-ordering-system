<template>
  <label
    :for="labelId"
    class="block text-sm font-medium leading-6"
    :class="[isInvalid ? 'text-red-600' : 'text-gray-900']"
  >
    <slot></slot>
  </label>
</template>

<script setup>
defineProps({
  labelId: {
    type: String,
    default() {
      return null
    }
  },
  isInvalid: {
    type: Boolean,
    default() {
      return false
    }
  }
})
</script>
