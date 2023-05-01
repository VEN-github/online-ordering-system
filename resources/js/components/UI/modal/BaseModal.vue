<template>
  <div class="relative z-50">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
      <div class="modal-overlay flex min-h-full items-center justify-center p-4 sm:p-0">
        <slot></slot>
      </div>
    </div>
  </div>
</template>
