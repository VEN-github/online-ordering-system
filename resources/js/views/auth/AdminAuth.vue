<template>
  <div class="flex min-h-screen flex-col justify-center px-1 sm:px-0">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img class="mx-auto h-12 w-auto" src="../../../assets/images/logo.svg" alt="Logo" />
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
        Sign in to your account
      </h2>
    </div>
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
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
                type="password"
                placeholder="Enter your password"
                :is-invalid="v$.password.$error"
              />
            </div>
            <FormValidation v-if="v$.password.$error"> Password is required. </FormValidation>
          </div>
          <!-- <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input
                id="remember-me"
                name="remember-me"
                type="checkbox"
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
              />
              <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
            </div>
            <div class="text-sm">
              <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"
                >Forgot your password?</a
              >
            </div>
          </div> -->
          <div>
            <BaseButton type="submit" size="lg" is-full :disabled="isLoading">
              <Icon v-if="isLoading" icon="gg:spinner" class="animate-spin text-base" />
              {{ isLoading ? 'Loading...' : 'Sign in' }}
            </BaseButton>
          </div>
        </form>
      </BaseCard>
    </div>
    <Transition name="slide-fade">
      <div v-if="isError" class="fixed top-4 right-4">
        <AlertError :message="errorMsg" @close-alert="closeAlert" />
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { useVuelidate } from '@vuelidate/core'
import { required, email } from '@vuelidate/validators'
import { useAuthStore } from '@/store/auth'
import { useRouter } from 'vue-router'

import BaseCard from '@/components/UI/cards/BaseCard.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/buttons/BaseButton.vue'
import AlertError from '@/components/UI/errors/AlertError.vue'

const store = useAuthStore()
const router = useRouter()
const models = reactive({
  email: '',
  password: ''
})
const isLoading = ref(false)
const isError = ref(false)
const errorMsg = ref('')

const rules = computed(() => {
  return {
    email: { required, email },
    password: { required }
  }
})

const v$ = useVuelidate(rules, models)

async function login() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    isLoading.value = true
    await store.adminLogin(models)
    isLoading.value = false
    router.replace('/dashboard')
  } catch ({ message }) {
    isLoading.value = false
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
