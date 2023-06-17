<template>
  <div class="relative">
    <FormInput
      :id="id"
      v-model="value"
      :type="isShow ? 'text' : 'password'"
      :placeholder="placeholder"
      :is-invalid="isInvalid"
      :disabled="disabled"
    />
    <div
      class="absolute inset-y-0 right-0 flex cursor-pointer items-center pr-3 text-gray-300 peer-focus:text-slate-600"
      @click="togglePassword"
    >
      <Icon :icon="isShow ? 'ic:baseline-remove-red-eye' : 'mdi:eye-off'" class="text-lg" />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

import FormInput from './FormInput.vue'

const props = defineProps({
  modelValue: {
    type: String,
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

const isShow = ref(false)

const value = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})

function togglePassword() {
  isShow.value = !isShow.value
}
</script>
