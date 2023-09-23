<template>
  <div
    v-if="!isLoading && addressLists.length == 0"
    class="flex flex-col items-center justify-center gap-4"
  >
    <img
      class="w-96 max-w-full"
      src="../../../assets/images/illustrations/address.svg"
      alt="Address"
    />
    <p class="text-lg font-semibold text-slate-800">No address yet</p>
    <BaseButton mode="primary" size="xl" @click="showAddForm = true">Add Address</BaseButton>
  </div>
  <template v-else>
    <div class="ml-auto w-fit">
      <BaseButton mode="primary" size="xl" @click="showAddForm = true">Add New Address</BaseButton>
    </div>
    <ul
      v-if="addressLists.length"
      role="list"
      class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
    >
      <AddressCard
        v-for="address in addressLists"
        :key="address"
        :address="address"
        @on-edit="toggleEditModal"
        @on-delete="toggleDeleteModal"
      />
    </ul>
  </template>
  <AddForm :is-show="showAddForm" @on-close="showAddForm = false" @on-success="onSuccess" />
  <EditForm
    :is-show="showEditForm"
    :model-value="models"
    @on-close="showEditForm = false"
    @on-success="onSuccess"
  />
  <ConfirmationModal
    :is-show="showDeleteModal"
    modal-type="danger"
    title="Delete Address"
    message="Are you sure you want to delete this Address? This action cannot be undone."
    confirm-text="Delete"
    @on-close="showDeleteModal = false"
    @on-confirm="deleteAddress"
  />
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAddressStore } from '@/store/address/address'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import AddressCard from '@/components/address/AddressCard.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import AddForm from '@/components/address/AddForm.vue'
import EditForm from '@/components/address/EditForm.vue'
import ConfirmationModal from '@/components/UI/modal/ConfirmationModal.vue'

const addressStore = useAddressStore()
const addressLists = ref([])
const showAddForm = ref(false)
const showEditForm = ref(false)
const showDeleteModal = ref(false)
const addressId = ref(null)
const models = ref(null)
const isLoading = ref(false)

onMounted(async () => {
  isLoading.value = true
  await getAddress()
  isLoading.value = false
})

async function onSuccess() {
  showAddForm.value = false
  showEditForm.value = false
  models.value = null
  await getAddress()
}

function toggleEditModal(address) {
  showEditForm.value = true
  models.value = address
}

function toggleDeleteModal(id) {
  showDeleteModal.value = true
  addressId.value = id
}

async function getAddress() {
  try {
    await addressStore.getSavedAddress()
    addressLists.value = addressStore.addressLists
  } catch ({ message }) {
    toast(message, {
      type: 'error',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_RIGHT,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}

async function deleteAddress() {
  try {
    showDeleteModal.value = false
    await addressStore.deleteAddress(addressId.value)
    await getAddress()
    addressId.value = null
    toast('Successfully Deleted', {
      type: 'success',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_CENTER,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  } catch ({ message }) {
    showDeleteModal.value = false
    toast(message, {
      type: 'error',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_RIGHT,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}
</script>
