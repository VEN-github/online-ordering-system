<template>
  <input
    v-model="value"
    :id="id"
    :name="name"
    type="radio"
    class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-600"
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
  name: {
    type: String,
    default() {
      return null
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
