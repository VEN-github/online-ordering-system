<template>
  <Teleport to="body">
    <BaseModal v-bind="$attrs">
      <div class="max-w-md sm:flex sm:items-start">
        <div
          class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10"
          :class="bgClass"
        >
          <Icon :icon="icon" class="h-6 w-6" :class="textClass" />
        </div>
        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
          <h3 class="text-base font-semibold leading-6 text-gray-900">{{ title }}</h3>
          <div v-if="message" class="mt-2">
            <p class="text-sm text-gray-500">
              {{ message }}
            </p>
          </div>
        </div>
      </div>
      <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
        <BaseButton
          :mode="modalType"
          size="lg"
          class="w-full sm:ml-3 sm:w-auto"
          @click="emit('onConfirm')"
        >
          {{ confirmText }}
        </BaseButton>
        <BaseButton
          mode="outline-default"
          size="lg"
          class="mt-3 w-full sm:mt-0 sm:w-auto"
          @click="emit('onClose')"
        >
          {{ cancelText }}
        </BaseButton>
      </div>
    </BaseModal>
  </Teleport>
</template>

<script setup>
import { computed } from 'vue'

import BaseModal from './BaseModal.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const props = defineProps({
  modalType: {
    type: String,
    default() {
      return 'info'
    },
    validator: (value) => {
      return ['info', 'warning', 'danger'].includes(value)
    }
  },
  title: {
    type: String,
    default() {
      return ''
    }
  },
  message: {
    type: String,
    default() {
      return null
    }
  },
  cancelText: {
    type: String,
    default() {
      return 'Cancel'
    }
  },
  confirmText: {
    type: String,
    default() {
      return 'Confirm'
    }
  }
})
const emit = defineEmits(['onClose', 'onConfirm'])

const icon = computed(() => {
  switch (props.modalType) {
    case 'warning':
    case 'danger':
      return 'ph:warning-duotone'
    default:
      return 'ep:question-filled'
  }
})

const bgClass = computed(() => {
  switch (props.modalType) {
    case 'warning':
      return 'bg-yellow-100'
    case 'danger':
      return 'bg-red-100'
    default:
      return 'bg-sky-100'
  }
})

const textClass = computed(() => {
  switch (props.modalType) {
    case 'warning':
      return 'text-yellow-600'
    case 'danger':
      return 'text-red-600'
    default:
      return 'text-sky-600'
  }
})
</script>
