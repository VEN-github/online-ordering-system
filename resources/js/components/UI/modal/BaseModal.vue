<template>
  <div class="relative" :class="{ 'z-50': isShow }">
    <Transition name="modal-fade">
      <div v-show="isShow" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    </Transition>
    <div v-show="isShow" class="fixed inset-0 z-10 overflow-y-auto">
      <div class="modal-overlay flex min-h-full items-center justify-center p-4 sm:p-0">
        <Transition name="modal-show">
          <BaseCard v-show="isShow">
            <slot></slot>
          </BaseCard>
        </Transition>
      </div>
    </div>
  </div>
</template>

<script setup>
import BaseCard from '@/components/UI/card/BaseCard.vue'

defineProps({
  isShow: {
    type: Boolean,
    default() {
      return false
    }
  }
})
</script>
