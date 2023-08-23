<template>
  <div>
    <h2 class="text-lg font-medium text-gray-900">Contact information</h2>
    <div class="mt-4">
      <FormLabel label-id="email-address">Email address</FormLabel>
      <div class="mt-1">
        <FormInput id="email" v-model="value" type="email" disabled />
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'

const props = defineProps({
  modelValue: {
    type: String,
    default() {
      return ''
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
