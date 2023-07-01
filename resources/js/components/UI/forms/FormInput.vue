<template>
  <input
    :id="id"
    v-model="value"
    :type="type"
    :placeholder="placeholder"
    class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
    :class="[isInvalid ? 'form-invalid' : 'form-input', { 'form--disabled': disabled }]"
    :disabled="disabled"
  />
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  modelValue: {
    type: [String, Number],
    default() {
      return ''
    }
  },
  id: {
    type: String,
    default() {
      return null
    }
  },
  type: {
    type: String,
    default() {
      return 'text'
    }
  },
  placeholder: {
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
  },
  disabled: {
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
