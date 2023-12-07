<template>
  <Teleport to="body">
    <BaseModal v-bind="$attrs">
      <div class="mb-3 flex justify-end">
        <BaseButton mode="flat-default" class="shadow-none" @click="emit('onClose')">
          <Icon icon="carbon:close-outline" class="h-5 w-5" />
        </BaseButton>
      </div>
      <div class="grid grid-cols-1 gap-y-5 gap-x-8 md:grid-cols-2">
        <div>
          <div class="mb-5">
            <h2 class="text-lg text-slate-600">
              Order #: <span class="font-semibold">{{ order?.ref_id }}</span>
            </h2>
            <p class="text-lg text-slate-600">
              Total Price: <span class="font-semibold">{{ order?.total_price }}</span>
            </p>
          </div>
          <div>
            <h2 class="mb-1.5 text-lg font-semibold text-slate-600">Shipping Details:</h2>
            <div class="grid grid-cols-2">
              <div>
                <p class="text-sm">{{ order?.first_name }} {{ order?.last_name }}</p>
                <p class="text-sm capitalize">{{ order?.address }}</p>
                <p class="text-sm capitalize">{{ order?.city }}, {{ order?.postal_code }}</p>
                <p class="text-sm capitalize">{{ order?.state }}, {{ order?.country }}</p>
                <p class="text-sm">{{ order?.phone }}</p>
              </div>
              <div>
                <p class="text-sm">
                  Shipping Method:
                  <span class="font-semibold capitalize">{{ order?.shipping_method }}</span>
                </p>
                <p class="text-sm">
                  Shipping Fee: <span class="font-semibold">{{ order?.shipping_price }}</span>
                </p>
              </div>
            </div>
          </div>
          <div class="mt-2">
            <h2 class="mb-1.5 text-lg font-semibold text-slate-600">Payment Details:</h2>
            <p class="text-sm">
              Payment Method:
              <span class="font-semibold capitalize">{{ order?.payment_method }}</span>
            </p>
            <p class="text-sm">
              Payment Status:
              <span
                class="font-semibold capitalize"
                :style="`color: ${checkStatusColor(order?.payment_status)}`"
              >
                {{ order?.payment_status }}
              </span>
            </p>
          </div>
        </div>
        <div>
          <h2 class="mb-1.5 text-lg font-semibold text-slate-600">Items</h2>
          <div class="scrollbar-sm h-[250px] space-y-3 overflow-y-auto rounded-lg border p-2">
            <div
              v-for="item in order?.items"
              :key="item.id"
              class="flex items-center gap-2 border-b pb-1 last:border-b-0 last:pb-0"
            >
              <img
                v-if="item.product?.highlight_image"
                class="w-48 rounded-lg object-cover"
                :src="item.product?.highlight_image"
                :alt="item.product?.highlight_image"
              />
              <svg
                v-else
                xmlns="http://www.w3.org/2000/svg"
                width="64"
                height="64"
                viewBox="0 0 24 24"
              >
                <path
                  fill="#64748b"
                  d="M21 17.2L6.8 3H19c1.1 0 2 .9 2 2v12.2m-.3 4.8l-1-1H5c-1.1 0-2-.9-2-2V4.3l-1-1L3.3 2L22 20.7L20.7 22m-3.9-4l-3.9-3.9l-1.9 2.4l-2.5-3L5 18h11.8Z"
                />
              </svg>
              <div>
                <h2>{{ item.product.name }}</h2>
                <p class="text-sm">
                  Qty: <span>{{ item.quantity }}</span>
                </p>
                <p class="font-medium">{{ item.total_price }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseModal>
  </Teleport>
</template>

<script setup>
import BaseModal from '@/components/UI/modal/BaseModal.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

defineProps({
  order: {
    type: Object,
    default() {
      return null
    }
  }
})
const emit = defineEmits(['onClose'])

function checkStatusColor(status) {
  switch (status) {
    case 'pending':
      return '#eab308'
    case 'processing':
      return '#0ea5e9'
    case 'confirmed':
      return '#84cc16'
    case 'shipped':
      return '#3b82f6'
    case 'completed':
    case 'paid':
      return '#22c55e'
    case 'cancelled':
    case 'failed':
      return '#ef4444'
    case 'refunded':
      return '#f97316'
    default:
      return '#334155'
  }
}
</script>
