<template>
  <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 sm:px-6 md:grid-cols-3 lg:px-8">
    <div>
      <h2 class="text-base font-semibold leading-7 text-slate-900">Personal Information</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">
        Use a permanent address where you can receive mail.
      </p>
    </div>
    <form class="md:col-span-2" @submit.prevent="changeProfile">
      <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
        <div class="col-span-full flex items-center gap-x-8">
          <BaseAvatar v-if="loggedUser?.avatar" :avatar="loggedUser?.avatar" />
          <AvatarInitials v-else :initials="loggedUser" />
          <div>
            <label class="btn btn-default btn--md mr-3 cursor-pointer">
              <input
                tabindex="-1"
                type="file"
                class="pointer-events-none absolute inset-0 h-full w-full opacity-0"
                @change="changeAvatar"
              />
              <div class="flex items-center space-x-2">
                <Icon icon="mdi:library-edit" class="h-5 w-5" />
              </div>
            </label>
            <BaseButton v-if="loggedUser?.avatar" mode="danger" @click="deleteAvatar">
              <Icon icon="material-symbols:delete-outline" class="h-5 w-5" />
            </BaseButton>
            <p class="mt-2 text-xs leading-5 text-gray-600">JPG, GIF or PNG. 2MB max.</p>
          </div>
        </div>
        <div class="sm:col-span-3">
          <FormLabel label-id="first-name" :is-invalid="v$.firstName.$error">
            First Name
          </FormLabel>
          <div class="mt-2">
            <FormInput
              id="first-name"
              v-model="models.firstName"
              placeholder="Enter your first name"
              :is-invalid="v$.firstName.$error"
            />
          </div>
          <FormValidation v-if="v$.firstName.$error"> First name is required. </FormValidation>
        </div>
        <div class="sm:col-span-3">
          <FormLabel label-id="last-name" :is-invalid="v$.lastName.$error"> Last Name </FormLabel>
          <div class="mt-2">
            <FormInput
              id="last-name"
              v-model="models.lastName"
              placeholder="Enter your last name"
              :is-invalid="v$.lastName.$error"
            />
          </div>
          <FormValidation v-if="v$.lastName.$error"> Last name is required. </FormValidation>
        </div>
        <div class="col-span-full">
          <FormLabel label-id="email"> Email Address </FormLabel>
          <div class="mt-2">
            <FormInput
              id="email"
              v-model="models.email"
              placeholder="Enter your email address"
              disabled
            />
          </div>
        </div>
      </div>
      <div class="mt-8 flex">
        <BaseButton type="submit" mode="primary" :disabled="isLoading">
          <Icon v-if="isLoading" icon="gg:spinner" class="animate-spin text-base" />
          <span>{{ isLoading ? 'Saving...' : 'Save Changes' }}</span>
        </BaseButton>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import { useAuthStore } from '@/store/auth/auth'
import { useProfileStore } from '@/store/client/profile'
import { useVuelidate } from '@vuelidate/core'
import { required } from '@vuelidate/validators'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import BaseAvatar from '@/components/UI/avatar/BaseAvatar.vue'
import AvatarInitials from '@/components/UI/avatar/AvatarInitials.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'

const authStore = useAuthStore()
const profileStore = useProfileStore()
const models = reactive({
  firstName: '',
  lastName: '',
  email: ''
})
const isLoading = ref(false)

const loggedUser = computed(() => {
  return authStore.getLoggedUser
})

const rules = computed(() => {
  return {
    firstName: { required },
    lastName: { required }
  }
})

const v$ = useVuelidate(rules, models)

onMounted(() => {
  models.firstName = loggedUser.value.first_name
  models.lastName = loggedUser.value.last_name
  models.email = loggedUser.value.email
})

async function changeAvatar(event) {
  try {
    const avatar = event.target.files[0]
    let formData = new FormData()
    formData.append('file', avatar)
    await profileStore.changeAvatar(loggedUser.value.id, avatar)
    await profileStore.getUser(loggedUser.value.id)
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

async function deleteAvatar() {
  try {
    await profileStore.deleteAvatar(loggedUser.value.id)
    await profileStore.getUser(loggedUser.value.id)
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

async function changeProfile() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    isLoading.value = true
    await profileStore.changeProfile(loggedUser.value.id, models)
    await profileStore.getUser(loggedUser.value.id)
    isLoading.value = false
    toast('Profile updated successfully.', {
      type: 'success',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_RIGHT,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  } catch ({ message }) {
    isLoading.value = false
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
