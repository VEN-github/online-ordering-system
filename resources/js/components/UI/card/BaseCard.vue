<template>
  <div class="w-full overflow-hidden rounded-lg bg-white shadow" :class="[`max-w-${size}`]">
    <div class="px-4 py-5 sm:p-6">
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
defineProps({
  size: {
    type: String,
    default() {
      return 'md'
    },
    validator: (value) => ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '7xl'].includes(value)
  }
})
</script>
