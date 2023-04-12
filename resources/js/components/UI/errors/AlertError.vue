<template>
  <div class="rounded-md bg-red-50 p-4">
    <div class="flex">
      <div class="flex-shrink-0">
        <Icon icon="ph:x-circle-fill" class="text-lg text-red-400" />
      </div>
      <div class="ml-3">
        <p class="text-sm font-medium text-red-800">{{ message }}</p>
      </div>
      <div class="ml-auto pl-3">
        <div class="-mx-1.5 -my-1.5">
          <button
            type="button"
            class="inline-flex rounded-md bg-red-50 p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50"
            @click="emit('closeAlert')"
          >
            <span class="sr-only">Dismiss</span>
            <Icon icon="ph:x-bold" class="text-lg" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  message: {
    type: String,
    default() {
      return 'Error'
    }
  }
})

const emit = defineEmits(['closeAlert'])
</script>
