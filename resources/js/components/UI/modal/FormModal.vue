<template>
  <Teleport to="body">
    <BaseModal v-bind="$attrs">
      <h2 class="my-3 text-center text-xl font-semibold text-slate-800">
        {{ title }}
      </h2>
      <form class="mt-8" @submit.prevent="emit('onSubmit')">
        <slot></slot>
      </form>
    </BaseModal>
  </Teleport>
</template>

<script setup>
import BaseModal from './BaseModal.vue'

defineProps({
  title: {
    type: String,
    default() {
      return ''
    }
  }
})
const emit = defineEmits(['onSubmit'])
</script>
