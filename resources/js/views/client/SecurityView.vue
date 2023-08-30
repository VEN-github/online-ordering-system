<template>
  <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 sm:px-6 md:grid-cols-3 lg:px-8">
    <div>
      <h2 class="text-base font-semibold leading-7 text-slate-900">Change password</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">
        Update your password associated with your account.
      </p>
    </div>
    <form class="md:col-span-2" @submit.prevent="changePassword">
      <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
        <div class="col-span-full">
          <FormLabel label-id="current-password" :is-invalid="v$.current.$error">
            Current Password
          </FormLabel>
          <div class="mt-2">
            <FormPassword
              id="current-password"
              v-model="models.current"
              placeholder="Enter your current password"
              :is-invalid="v$.current.$error"
            />
          </div>
          <FormValidation v-if="v$.current.$error"> Current password is required. </FormValidation>
        </div>
        <div class="col-span-full">
          <FormLabel label-id="new-password" :is-invalid="v$.new.$error"> New Password </FormLabel>
          <div class="mt-2">
            <FormPassword
              id="new-password"
              v-model="models.new"
              placeholder="Enter your new password"
              :is-invalid="v$.new.$error"
            />
          </div>
          <FormValidation v-if="v$.new.$error && v$.new.required.$invalid">
            New password is required.
          </FormValidation>
          <FormValidation v-if="v$.new.$error && v$.new.minLength.$invalid">
            New password must be at least 8 characters.
          </FormValidation>
        </div>
        <div class="col-span-full">
          <FormLabel label-id="confirm-password" :is-invalid="v$.confirm.$error">
            Confirm Password
          </FormLabel>
          <div class="mt-2">
            <FormPassword
              id="confirm-password"
              v-model="models.confirm"
              placeholder="Re-type your new password"
              :is-invalid="v$.confirm.$error"
            />
          </div>
          <FormValidation v-if="v$.confirm.$error && v$.confirm.required.$invalid">
            Confirm password is required.
          </FormValidation>
          <FormValidation v-if="v$.confirm.$error && v$.confirm.sameAs.$invalid">
            Password does not match.
          </FormValidation>
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
import { ref, reactive, computed } from 'vue'
import { useAuthStore } from '@/store/auth/auth'
import { useProfileStore } from '@/store/client/profile'
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, sameAs } from '@vuelidate/validators'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormPassword from '@/components/UI/forms/FormPassword.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const profileStore = useProfileStore()
const authStore = useAuthStore()
const models = reactive({
  current: '',
  new: '',
  confirm: ''
})
const isLoading = ref(false)

const loggedUser = computed(() => {
  return authStore.getLoggedUser
})

const rules = computed(() => {
  return {
    current: { required },
    new: { required, minLength: minLength(8) },
    confirm: { required, sameAs: sameAs(models.new) }
  }
})

const v$ = useVuelidate(rules, models)

async function changePassword() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    isLoading.value = true
    await profileStore.changePassword(loggedUser.value.id, models)
    await profileStore.getUser(loggedUser.value.id)
    isLoading.value = false
    resetForm()
    toast('Password updated successfully.', {
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

function resetForm() {
  v$.value.$reset()
  models.current = ''
  models.new = ''
  models.confirm = ''
}
</script>
