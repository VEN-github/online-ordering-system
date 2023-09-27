<template>
  <select
    :id="id"
    v-model="value"
    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 ring-1 ring-inset focus:ring-2 sm:text-sm sm:leading-6"
    :class="[isInvalid ? 'form-invalid' : 'form-input']"
  >
    <slot></slot>
  </select>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  modelValue: {
    type: [String, Number, Object],
    default() {
      return ''
    }
  },
  label: {
    type: String,
    default() {
      return null
    }
  },
  id: {
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
const emit = defineEmits(['update:modelValue'])

const value = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})
</script>
