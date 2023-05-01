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
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
          <div class="col-span-full sm:flex sm:items-center sm:justify-between">
            <div class="flex items-center gap-x-8">
              <img
                v-if="loggedAdmin?.admin?.avatar"
                :src="loggedAdmin?.admin?.avatar"
                alt="Avatar"
                class="h-24 w-24 flex-none rounded-lg bg-gray-800 object-cover"
              />
              <div v-else class="flex-none rounded-lg bg-gray-200">
                <span
                  class="flex h-24 w-24 items-center justify-center text-3xl font-medium uppercase"
                >
                  {{ initialsAvatar }}
                </span>
              </div>
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
                <BaseButton v-if="models.avatar" mode="danger" @click="deleteAvatar">
                  <Icon icon="material-symbols:delete-outline" class="h-5 w-5" />
                </BaseButton>
                <p class="mt-2 text-xs leading-5 text-gray-600">JPG, GIF or PNG. 2MB max.</p>
              </div>
            </div>
            <BaseButton v-if="isChange" mode="primary" class="mt-2 sm:mt-0" @click="saveAvatar">
              Save
            </BaseButton>
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
            <FormLabel label-id="last-name" :is-invalid="v$.lastName.$error">Last Name</FormLabel>
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
            <FormLabel label-id="email">Email Address</FormLabel>
            <div class="mt-2">
              <FormInput id="email" v-model="models.email" type="email" disabled />
            </div>
          </div>
        </div>
        <div class="mt-8 flex">
          <BaseButton type="submit" mode="primary">Save Changes</BaseButton>
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
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
          <div class="col-span-full">
            <FormLabel label-id="current-password" :is-invalid="vv$.password.current.$error">
              Current Password
            </FormLabel>
            <div class="relative mt-2">
              <FormInput
                id="current-password"
                v-model="models.password.current"
                type="password"
                placeholder="Enter your current password"
                :is-invalid="vv$.password.current.$error"
              />
            </div>
            <FormValidation v-if="vv$.password.current.$error">
              Current password is required.
            </FormValidation>
          </div>
          <div class="col-span-full">
            <FormLabel label-id="new-password" :is-invalid="vv$.password.new.$error">
              New Password
            </FormLabel>
            <div class="relative mt-2">
              <FormInput
                id="new-password"
                v-model="models.password.new"
                type="password"
                placeholder="Enter your new password"
                :is-invalid="vv$.password.new.$error"
              />
            </div>
            <FormValidation v-if="vv$.password.new.$error && vv$.password.new.required.$invalid">
              New password is required.
            </FormValidation>
            <FormValidation v-if="vv$.password.new.$error && vv$.password.new.minLength.$invalid">
              New password must be at least 8 characters.
            </FormValidation>
          </div>
          <div class="col-span-full">
            <FormLabel label-id="confirm-password" :is-invalid="vv$.password.confirm.$error">
              Confirm Password
            </FormLabel>
            <div class="relative mt-2">
              <FormInput
                id="confirm-password"
                v-model="models.password.confirm"
                type="password"
                placeholder="Re-type your new password"
                :is-invalid="vv$.password.confirm.$error"
              />
            </div>
            <FormValidation
              v-if="vv$.password.confirm.$error && vv$.password.confirm.required.$invalid"
            >
              Confirm password is required.
            </FormValidation>
            <FormValidation
              v-if="vv$.password.confirm.$error && vv$.password.confirm.sameAs.$invalid"
            >
              Password does not match.
            </FormValidation>
          </div>
        </div>
        <div class="mt-8 flex">
          <BaseButton type="submit" mode="primary">Save Changes</BaseButton>
        </div>
      </form>
    </div>
  </div>
  <Transition name="slide-fade">
    <div v-if="isError" class="fixed top-4 right-4 z-50">
      <AlertError :message="errorMsg" @close-alert="closeAlert" />
    </div>
  </Transition>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, sameAs } from '@vuelidate/validators'
import { useAuthStore } from '@/store/auth'
import { useProfileStore } from '@/store/adminProfile'

import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/buttons/BaseButton.vue'
import AlertError from '@/components/UI/errors/AlertError.vue'

const store = useAuthStore()
const profileStore = useProfileStore()
const models = reactive({
  avatar: '',
  firstName: '',
  lastName: '',
  email: '',
  password: {
    current: '',
    new: '',
    confirm: ''
  }
})
const isChange = ref(false)
const isError = ref(false)
const errorMsg = ref('')

const token = computed(() => {
  return store?.getLoggedAdmin?.token
})

const loggedAdmin = computed(() => {
  return store.getLoggedAdmin
})

const initialsAvatar = computed(() => {
  return `${store.getLoggedAdmin?.admin?.first_name.charAt(
    0
  )}${store.getLoggedAdmin?.admin?.last_name.charAt(0)}`
})

const rules = computed(() => {
  return {
    firstName: { required },
    lastName: { required }
  }
})

const passwordRules = computed(() => {
  return {
    password: {
      current: { required },
      new: { required, minLength: minLength(8) },
      confirm: { required, sameAs: sameAs(models.password.new) }
    }
  }
})

const v$ = useVuelidate(rules, models)
const vv$ = useVuelidate(passwordRules, models)

onMounted(() => {
  models.avatar = loggedAdmin.value.admin.avatar
  models.firstName = loggedAdmin.value.admin.first_name
  models.lastName = loggedAdmin.value.admin.last_name
  models.email = loggedAdmin.value.admin.email
})

function changeAvatar(event) {
  models.avatar = event.target.files[0]
  isChange.value = true
}

async function saveAvatar() {
  try {
    await profileStore.changeAvatar(loggedAdmin.value.admin.id, models.avatar, token.value)
    await store.getAdmin(loggedAdmin.value.admin.id, token.value)
  } catch ({ message }) {
    isError.value = true
    errorMsg.value = message

    setTimeout(() => {
      isError.value = false
      errorMsg.value = ''
    }, 3000)
  }
}

async function deleteAvatar() {
  try {
    await profileStore.deleteAvatar(loggedAdmin.value.admin.id, token.value)
    await store.getAdmin(loggedAdmin.value.admin.id, token.value)
    models.avatar = null
  } catch ({ message }) {
    isError.value = true
    errorMsg.value = message

    setTimeout(() => {
      isError.value = false
      errorMsg.value = ''
    }, 3000)
  }
}

async function changeProfile() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    await profileStore.changeProfile(loggedAdmin.value.admin.id, token.value, models)
    await store.getAdmin(loggedAdmin.value.admin.id, token.value)
  } catch ({ message }) {
    isError.value = true
    errorMsg.value = message

    setTimeout(() => {
      isError.value = false
      errorMsg.value = ''
    }, 3000)
  }
}

async function changePassword() {
  const isFormCorrect = await vv$.value.$validate()

  if (!isFormCorrect) return

  try {
    await profileStore.changePassword(loggedAdmin.value.admin.id, token.value, models)
    await store.getAdmin(loggedAdmin.value.admin.id, token.value)
  } catch ({ message }) {
    isError.value = true
    errorMsg.value = message

    setTimeout(() => {
      isError.value = false
      errorMsg.value = ''
    }, 3000)
  }
}

function closeAlert() {
  isError.value = false
}
</script>
