<template>
  <label class="relative inline-flex cursor-pointer items-center">
    <input v-model="value" type="checkbox" class="peer sr-only" true-value="1" false-value="0" />
    <div
      class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:top-[2px] after:left-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-emerald-600 peer-checked:after:translate-x-full peer-checked:after:border-white"
    ></div>
    <span v-if="label" class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
      {{ label }}
    </span>
  </label>
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
