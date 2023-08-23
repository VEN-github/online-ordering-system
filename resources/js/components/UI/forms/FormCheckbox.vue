<template>
  <div class="flex items-center">
    <input
      :id="id"
      v-model="value"
      type="checkbox"
      true-value="1"
      false-value="0"
      class="h-4 w-4 cursor-pointer rounded border-gray-300 bg-gray-100 text-emerald-600 focus:ring-2 focus:ring-emerald-500"
    />
    <FormLabel v-if="label" :for="id" class="ml-2 cursor-pointer select-none">
      {{ label }}
    </FormLabel>
  </div>
</template>

<script setup>
import { computed } from 'vue'

import FormLabel from '@/components/UI/forms/FormLabel.vue'

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
