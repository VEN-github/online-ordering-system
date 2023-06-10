<template>
  <div class="divide-slate/5 divide-y rounded-lg bg-white shadow">
    <div
      class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8"
    >
      <div>
        <h2 class="text-slate-60 text-base font-semibold leading-7">Personal Information</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
          Use a permanent address where you can receive mail.
        </p>
      </div>
      <form class="md:col-span-2" @submit.prevent="changeProfile">
        <Transition name="fade">
          <BaseAlert v-if="avatar.error" mode="error" class="mb-5">
            {{ avatar.errorMessage }}
          </BaseAlert>
        </Transition>
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
          <div class="col-span-full">
            <div class="flex items-center gap-x-8">
              <BaseAvatar v-if="loggedAdmin?.avatar" :avatar="loggedAdmin?.avatar" />
              <AvatarInitials v-else :initials="loggedAdmin" />
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
                <BaseButton v-if="loggedAdmin?.avatar" mode="danger" @click="deleteAvatar">
                  <Icon icon="material-symbols:delete-outline" class="h-5 w-5" />
                </BaseButton>
                <p class="mt-2 text-xs leading-5 text-gray-600">JPG, GIF or PNG. 2MB max.</p>
              </div>
            </div>
          </div>
          <div v-if="profile.error" class="col-span-full">
            <Transition name="fade">
              <BaseAlert mode="error">{{ profile.errorMessage }}</BaseAlert>
            </Transition>
          </div>
          <div v-if="profile.success" class="col-span-full">
            <Transition name="fade">
              <BaseAlert mode="success">{{ profile.successMessage }}</BaseAlert>
            </Transition>
          </div>
          <div class="sm:col-span-3">
            <FormLabel label-id="first-name" :is-invalid="profileValidate.firstName.$error">
              First Name
            </FormLabel>
            <div class="mt-2">
              <FormInput
                id="first-name"
                v-model="profileModels.firstName"
                placeholder="Enter your first name"
                :is-invalid="profileValidate.firstName.$error"
              />
            </div>
            <FormValidation v-if="profileValidate.firstName.$error">
              First name is required.
            </FormValidation>
          </div>
          <div class="sm:col-span-3">
            <FormLabel label-id="last-name" :is-invalid="profileValidate.lastName.$error">
              Last Name
            </FormLabel>
            <div class="mt-2">
              <FormInput
                id="last-name"
                v-model="profileModels.lastName"
                placeholder="Enter your last name"
                :is-invalid="profileValidate.lastName.$error"
              />
            </div>
            <FormValidation v-if="profileValidate.lastName.$error">
              Last name is required.
            </FormValidation>
          </div>
          <div class="col-span-full">
            <FormLabel label-id="email">Email Address</FormLabel>
            <div class="mt-2">
              <FormInput id="email" v-model="profileModels.email" type="email" disabled />
            </div>
          </div>
        </div>
        <div class="mt-8 flex">
          <BaseButton type="submit" mode="primary" :disabled="profile.loading">
            <Icon v-if="profile.loading" icon="gg:spinner" class="animate-spin text-base" />
            {{ profile.loading ? 'Saving...' : 'Save Changes' }}
          </BaseButton>
        </div>
      </form>
    </div>
    <div
      class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8"
    >
      <div>
        <h2 class="text-base font-semibold leading-7 text-slate-600">Change password</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
          Update your password associated with your account.
        </p>
      </div>
      <form class="md:col-span-2" @submit.prevent="changePassword">
        <Transition name="fade">
          <BaseAlert v-if="password.error" mode="error" class="mb-5">
            {{ password.errorMessage }}
          </BaseAlert>
        </Transition>
        <Transition name="fade">
          <BaseAlert v-if="password.success" mode="success" class="mb-5">
            {{ password.successMessage }}
          </BaseAlert>
        </Transition>
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
          <div class="col-span-full">
            <FormLabel label-id="current-password" :is-invalid="passwordValidate.current.$error">
              Current Password
            </FormLabel>
            <div class="mt-2">
              <FormPassword
                id="current-password"
                v-model="passwordModels.current"
                placeholder="Enter your current password"
                :is-invalid="passwordValidate.current.$error"
              />
            </div>
            <FormValidation v-if="passwordValidate.current.$error">
              Current password is required.
            </FormValidation>
          </div>
          <div class="col-span-full">
            <FormLabel label-id="new-password" :is-invalid="passwordValidate.new.$error">
              New Password
            </FormLabel>
            <div class="mt-2">
              <FormPassword
                id="new-password"
                v-model="passwordModels.new"
                placeholder="Enter your new password"
                :is-invalid="passwordValidate.new.$error"
              />
            </div>
            <FormValidation
              v-if="passwordValidate.new.$error && passwordValidate.new.required.$invalid"
            >
              New password is required.
            </FormValidation>
            <FormValidation
              v-if="passwordValidate.new.$error && passwordValidate.new.minLength.$invalid"
            >
              New password must be at least 8 characters.
            </FormValidation>
          </div>
          <div class="col-span-full">
            <FormLabel label-id="confirm-password" :is-invalid="passwordValidate.confirm.$error">
              Confirm Password
            </FormLabel>
            <div class="mt-2">
              <FormPassword
                id="confirm-password"
                v-model="passwordModels.confirm"
                placeholder="Re-type your new password"
                :is-invalid="passwordValidate.confirm.$error"
              />
            </div>
            <FormValidation
              v-if="passwordValidate.confirm.$error && passwordValidate.confirm.required.$invalid"
            >
              Confirm password is required.
            </FormValidation>
            <FormValidation
              v-if="passwordValidate.confirm.$error && passwordValidate.confirm.sameAs.$invalid"
            >
              Password does not match.
            </FormValidation>
          </div>
        </div>
        <div class="mt-8 flex">
          <BaseButton type="submit" mode="primary" :disabled="password.loading">
            <Icon v-if="password.loading" icon="gg:spinner" class="animate-spin text-base" />
            {{ password.loading ? 'Saving...' : 'Save Changes' }}
          </BaseButton>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive, computed, onMounted } from 'vue'
import { useAuthStore } from '@/store/auth/auth'
import { useProfileStore } from '@/store/admin/profile'
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, sameAs } from '@vuelidate/validators'

import BaseAvatar from '@/components/UI/avatar/BaseAvatar.vue'
import AvatarInitials from '@/components/UI/avatar/AvatarInitials.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormPassword from '@/components/UI/forms/FormPassword.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import BaseAlert from '@/components/UI/alert/BaseAlert.vue'

const authStore = useAuthStore()
const profileStore = useProfileStore()
const avatar = reactive({
  loading: false,
  error: false,
  errorMessage: '',
  timeout: undefined
})
const profileModels = reactive({
  firstName: '',
  lastName: '',
  email: ''
})
const profile = reactive({
  loading: false,
  error: false,
  errorMessage: '',
  success: false,
  successMessage: '',
  timeout: undefined
})
const passwordModels = reactive({
  current: '',
  new: '',
  confirm: ''
})
const password = reactive({
  loading: false,
  error: false,
  errorMessage: '',
  success: false,
  successMessage: '',
  timeout: undefined
})

const loggedAdmin = computed(() => {
  return authStore.getLoggedAdmin
})

const profileRules = computed(() => {
  return {
    firstName: { required },
    lastName: { required }
  }
})

const passwordRules = computed(() => {
  return {
    current: { required },
    new: { required, minLength: minLength(8) },
    confirm: { required, sameAs: sameAs(passwordModels.new) }
  }
})

const profileValidate = useVuelidate(profileRules, profileModels)
const passwordValidate = useVuelidate(passwordRules, passwordModels)

onMounted(() => {
  profileModels.firstName = loggedAdmin.value.first_name
  profileModels.lastName = loggedAdmin.value.last_name
  profileModels.email = loggedAdmin.value.email
})

async function changeAvatar(event) {
  try {
    const avatar = event.target.files[0]
    let formData = new FormData()
    formData.append('file', avatar)
    await profileStore.changeAvatar(loggedAdmin.value.id, avatar)
    await profileStore.getAdmin(loggedAdmin.value.id)
  } catch ({ message }) {
    avatar.error = true
    avatar.errorMessage = message
    clearAvatarErrorMessage()
  }
}

async function deleteAvatar() {
  try {
    clearTimeout(avatar.timeout)
    await profileStore.deleteAvatar(loggedAdmin.value.id)
    await profileStore.getAdmin(loggedAdmin.value.id)
  } catch ({ message }) {
    avatar.error = true
    avatar.errorMessage = message
    clearAvatarErrorMessage()
  }
}

function clearAvatarErrorMessage() {
  avatar.timeout = setTimeout(() => {
    avatar.error = false
    avatar.errorMessage = ''
  }, 5000)
}

async function changeProfile() {
  const isFormCorrect = await profileValidate.value.$validate()

  if (!isFormCorrect) return

  try {
    clearTimeout(profile.timeout)
    profile.loading = true
    profile.error = false
    profile.success = false
    await profileStore.changeProfile(loggedAdmin.value.id, profileModels)
    await profileStore.getAdmin(loggedAdmin.value.id)
    profile.loading = false
    profile.success = true
    profile.successMessage = 'Profile updated successfully.'
    clearProfileSuccessMessage()
  } catch ({ message }) {
    profile.loading = false
    profile.error = true
    profile.errorMessage = message
    clearProfileErrorMessage()
  }
}

function clearProfileErrorMessage() {
  profile.timeout = setTimeout(() => {
    profile.error = false
    profile.errorMessage = ''
  }, 5000)
}

function clearProfileSuccessMessage() {
  profile.timeout = setTimeout(() => {
    profile.success = false
    profile.successMessage = ''
  }, 5000)
}

async function changePassword() {
  const isFormCorrect = await passwordValidate.value.$validate()

  if (!isFormCorrect) return

  try {
    clearTimeout(password.timeout)
    password.loading = true
    password.error = false
    password.success = false
    await profileStore.changePassword(loggedAdmin.value.id, passwordModels)
    await profileStore.getAdmin(loggedAdmin.value.id)
    password.loading = false
    password.success = true
    password.successMessage = 'Password updated successfully.'
    passwordValidate.value.$reset()
    passwordModels.current = ''
    passwordModels.new = ''
    passwordModels.confirm = ''
    clearPasswordSuccessMessage()
  } catch ({ message }) {
    password.loading = false
    password.error = true
    password.errorMessage = message
    clearPasswordErrorMessage()
  }
}

function clearPasswordErrorMessage() {
  password.timeout = setTimeout(() => {
    password.error = false
    password.errorMessage = ''
  }, 5000)
}

function clearPasswordSuccessMessage() {
  password.timeout = setTimeout(() => {
    password.success = false
    password.successMessage = ''
  }, 5000)
}
</script>
