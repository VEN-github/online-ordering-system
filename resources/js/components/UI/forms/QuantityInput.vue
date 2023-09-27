<template>
  <div class="flex rounded-md border border-gray-500 shadow-sm">
    <button
      type="button"
      class="group py-2 px-4 disabled:pointer-events-none disabled:select-none disabled:opacity-40"
      :disabled="value == 1"
      @click="emit('subtract')"
    >
      <Icon class="h-5 w-5 group-hover:text-emerald-500" icon="ic:round-minus" />
    </button>
    <input
      v-model="value"
      min="1"
      :max="maxValue"
      class="pointer-events-none block w-full py-2 px-4 text-center"
    />
    <button
      type="button"
      class="group py-2 px-4 disabled:pointer-events-none disabled:select-none disabled:opacity-40"
      :disabled="value == maxValue"
      @click="emit('add')"
    >
      <Icon class="h-5 w-5 group-hover:text-emerald-500" icon="ic:round-plus" />
    </button>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  modelValue: {
    type: Number,
    default() {
      return 1
    }
  },
  maxValue: {
    type: Number,
    default() {
      return 1
    }
  }
})
const emit = defineEmits(['update:modelValue', 'add', 'subtract'])

const value = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  }
})
</script>
