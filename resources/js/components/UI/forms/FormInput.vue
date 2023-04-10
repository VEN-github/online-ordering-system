<template>
  <input
    :id="id"
    v-model="value"
    :type="isShow ? 'text' : type"
    class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
    :class="[isInvalid ? 'form-invalid' : 'form-input', type === 'password' ? 'peer pr-10' : '']"
    :placeholder="placeholder"
  />
  <div
    v-if="type === 'password'"
    class="absolute inset-y-0 right-0 flex cursor-pointer items-center pr-3 text-gray-300 peer-focus:text-slate-600"
    @click="showPassword"
  >
    <Icon v-if="isShow" icon="ic:baseline-remove-red-eye" class="text-lg" />
    <Icon v-else icon="mdi:eye-off" class="text-lg" />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

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

function showPassword() {
  isShow.value = !isShow.value
}
</script>
