<template>
  <img
    :src="avatar"
    alt="Avatar"
    :class="[`avatar avatar--${size}`, rounded ? 'rounded-full' : 'rounded-lg']"
  />
</template>

<script setup>
defineProps({
  avatar: {
    type: String,
    default() {
      return ''
    }
  },
  size: {
    type: String,
    default() {
      return 'md'
    },
    validator: (value) => ['sm', 'md'].includes(value)
  },
  rounded: {
    type: Boolean,
    default() {
      return false
    }
  }
})
</script>
