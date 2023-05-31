<template>
  <div class="flex min-h-screen flex-col justify-center px-1 sm:px-0">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img class="mx-auto h-12 w-auto" src="../../../assets/images/logo/logo.svg" alt="Logo" />
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
        Sign in to your account
      </h2>
    </div>
    <div class="mx-auto mt-8 w-full max-w-md">
      <Transition name="fade">
        <BaseAlert v-if="isError" mode="error" class="mb-5 shadow">{{ errorMessage }}</BaseAlert>
      </Transition>
      <BaseCard>
        <form class="space-y-6" @submit.prevent="login">
          <div>
            <FormLabel label-id="email" :is-invalid="v$.email.$error">Email Address</FormLabel>
            <div class="mt-2">
              <FormInput
                id="email"
                v-model="models.email"
                type="email"
                placeholder="Enter your email address"
                :is-invalid="v$.email.$error"
              />
            </div>
            <FormValidation v-if="v$.email.$error && v$.email.required.$invalid">
              Email address is required.
            </FormValidation>
            <FormValidation v-if="v$.email.$error && v$.email.email.$invalid">
              Email address is not valid.
            </FormValidation>
          </div>
          <div>
            <FormLabel label-id="password" :is-invalid="v$.password.$error">Password</FormLabel>
            <div class="relative mt-2">
              <FormInput
                id="password"
                v-model="models.password"
                :type="isShowPassword ? 'text' : 'password'"
                placeholder="Enter your password"
                class="peer pr-10"
                :is-invalid="v$.password.$error"
              />
              <div
                class="absolute inset-y-0 right-0 flex cursor-pointer items-center pr-3 text-gray-300 peer-focus:text-slate-600"
                @click="togglePassword"
              >
                <Icon
                  :icon="isShowPassword ? 'ic:baseline-remove-red-eye' : 'mdi:eye-off'"
                  class="text-lg"
                />
              </div>
            </div>
            <FormValidation v-if="v$.password.$error"> Password is required. </FormValidation>
          </div>
          <div>
            <BaseButton type="submit" mode="primary" size="lg" is-full :disabled="isLoading">
              <Icon v-if="isLoading" icon="gg:spinner" class="animate-spin text-base" />
              {{ isLoading ? 'Loading...' : 'Sign in' }}
            </BaseButton>
          </div>
        </form>
      </BaseCard>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth/auth'
import { useVuelidate } from '@vuelidate/core'
import { required, email } from '@vuelidate/validators'

import BaseCard from '@/components/UI/card/BaseCard.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import BaseAlert from '@/components/UI/alert/BaseAlert.vue'

const router = useRouter()
const store = useAuthStore()
const models = reactive({
  email: '',
  password: ''
})
const isShowPassword = ref(false)
const isLoading = ref(false)
const isError = ref(false)
const errorMessage = ref('')
let timeout

const rules = computed(() => {
  return {
    email: { required, email },
    password: { required }
  }
})

const v$ = useVuelidate(rules, models)

function togglePassword() {
  isShowPassword.value = !isShowPassword.value
}

async function login() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    clearTimeout(timeout)
    isError.value = false
    isLoading.value = true
    await store.adminLogin(models)
    isLoading.value = false
    router.replace('/dashboard')
  } catch ({ message }) {
    isLoading.value = false
    isError.value = true
    errorMessage.value = message
    clearErrorMessage()
  }
}

function clearErrorMessage() {
  timeout = setTimeout(() => {
    isError.value = false
    errorMessage.value = ''
  }, 5000)
}
</script>
