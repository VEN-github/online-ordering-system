<template>
  <RouterLink
    v-if="isLink"
    :to="link"
    :class="[
      `btn btn-${mode}`,
      `btn--${size}`,
      { 'w-full': isFull },
      { 'link--disabled': disabled }
    ]"
    :disabled="disabled"
  >
    <slot></slot>
  </RouterLink>
  <button
    v-else
    :type="type"
    :class="[
      `btn btn-${mode}`,
      `btn--${size}`,
      { 'w-full': isFull },
      { 'btn--disabled': disabled }
    ]"
    :disabled="disabled"
  >
    <slot></slot>
  </button>
</template>

<script setup>
import { RouterLink } from 'vue-router'

defineProps({
  isLink: {
    type: Boolean,
    default() {
      return false
    }
  },
  link: {
    type: String,
    default() {
      return '/'
    }
  },
  type: {
    type: String,
    default() {
      return 'button'
    }
  },
  mode: {
    type: String,
    default() {
      return 'default'
    }
  },
  size: {
    type: String,
    default() {
      return 'md'
    },
    validator: (value) => ['xs', 'sm', 'md', 'lg', 'xl'].includes(value)
  },
  isFull: {
    type: Boolean,
    default() {
      return false
    }
  },
  disabled: {
    type: Boolean,
    default() {
      return false
    }
  }
})
</script>
