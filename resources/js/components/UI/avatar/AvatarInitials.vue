<template>
  <div
    class="flex items-center justify-center bg-gray-200 font-medium uppercase"
    :class="[`avatar--${size} initials--${size}`, rounded ? 'rounded-full' : 'rounded-lg']"
  >
    <span>{{ initialsAvatar }}</span>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  initials: {
    type: Object,
    default() {
      return null
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

const initialsAvatar = computed(() => {
  return (
    props.initials &&
    `${props.initials?.first_name.charAt(0)}${props.initials?.last_name.charAt(0)}`
  )
})
</script>
