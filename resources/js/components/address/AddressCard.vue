<template>
  <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white/80 shadow-md">
    <div class="p-6">
      <div class="truncate">
        <div class="flex items-center space-x-3">
          <h3 class="truncate text-sm font-medium text-gray-900">
            {{ address.first_name }} {{ address.last_name }}
          </h3>
          <span
            v-if="address.is_primary"
            class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20"
          >
            Default
          </span>
        </div>
        <div class="mt-1 truncate text-sm text-gray-500">
          <p class="truncate">{{ address.address }}</p>
          <p class="truncate">
            {{ address.city }} {{ address.postal_code }}, {{ address.state }}
            {{ address.country }}
          </p>
          <p class="truncate">{{ address.phone }}</p>
        </div>
      </div>
    </div>
    <div>
      <div class="-mt-px flex divide-x divide-gray-200">
        <div class="flex w-0 flex-1">
          <button
            type="button"
            class="group relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900 hover:text-sky-600"
            @click="emit('onEdit', address)"
          >
            <Icon icon="bxs:edit" class="h-5 w-5 text-gray-400 group-hover:text-sky-600" />
            <span>Edit</span>
          </button>
        </div>
        <div class="-ml-px flex w-0 flex-1">
          <button
            type="button"
            class="group relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900 hover:text-red-600"
            @click="emit('onDelete', address.id)"
          >
            <Icon icon="ic:outline-delete" class="h-5 w-5 text-gray-400 group-hover:text-red-600" />
            <span>Delete</span>
          </button>
        </div>
      </div>
    </div>
  </li>
</template>

<script setup>
defineProps({
  address: {
    type: Object,
    default() {
      return {}
    }
  }
})
const emit = defineEmits(['onEdit', 'onDelete'])
</script>
