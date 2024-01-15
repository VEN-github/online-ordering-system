<template>
  <section class="bg-white">
    <div class="min-h-screen lg:grid lg:grid-cols-12">
      <aside class="relative block h-[16rem] lg:order-last lg:col-span-5 lg:h-full xl:col-span-6">
        <img
          alt="Pattern"
          src="https://images.unsplash.com/photo-1618220179428-22790b461013?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=627&q=80"
          class="absolute inset-0 h-full w-full object-cover"
        />
      </aside>
      <main
        class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6"
      >
        <div class="max-w-xl lg:max-w-3xl">
          <RouterLink class="block" to="/">
            <span class="sr-only">Home</span>
            <img class="h-8 sm:h-10" src="../../../assets/images/logo/logo.svg" alt="logo" />
          </RouterLink>
          <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">Welcome!</h1>
          <p class="mt-4 leading-relaxed text-gray-500">
            Create an Account and Begin Your Journey to a Cozier, Stylish Home
          </p>
          <Transition name="fade">
            <BaseAlert v-if="isError" mode="error" class="my-5 shadow">
              {{ errorMessage }}
            </BaseAlert>
          </Transition>
          <form class="mt-8 grid grid-cols-6 gap-6" @submit.prevent="register">
            <div class="col-span-6 sm:col-span-3">
              <FormLabel label-id="first-name" :is-invalid="v$.first_name.$error">
                First Name
              </FormLabel>
              <div class="mt-2">
                <FormInput
                  id="first-name"
                  v-model="models.first_name"
                  placeholder="Enter your first name"
                  :is-invalid="v$.first_name.$error"
                />
              </div>
              <FormValidation v-if="v$.first_name.$error"> First name is required. </FormValidation>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <FormLabel label-id="last-name" :is-invalid="v$.last_name.$error">
                Last Name
              </FormLabel>
              <div class="mt-2">
                <FormInput
                  id="last-name"
                  v-model="models.last_name"
                  placeholder="Enter your last name"
                  :is-invalid="v$.last_name.$error"
                />
              </div>
              <FormValidation v-if="v$.last_name.$error"> Last name is required. </FormValidation>
            </div>
            <div class="col-span-6">
              <FormLabel label-id="email" :is-invalid="v$.email.$error">Email address</FormLabel>
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
            <div class="col-span-6 sm:col-span-3">
              <FormLabel label-id="password" :is-invalid="v$.password.$error">Password</FormLabel>
              <div class="relative mt-2">
                <FormPassword
                  id="password"
                  v-model="models.password"
                  placeholder="Enter your password"
                  :is-invalid="v$.password.$error"
                />
              </div>
              <FormValidation v-if="v$.password.$error && v$.password.required.$invalid">
                Password is required.
              </FormValidation>
              <FormValidation v-if="v$.password.$error && v$.password.minLength.$invalid">
                Password must be at least 8 characters.
              </FormValidation>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <FormLabel label-id="confirm-password" :is-invalid="v$.password_confirmation.$error">
                Confirm Password
              </FormLabel>
              <div class="relative mt-2">
                <FormPassword
                  id="confirm-password"
                  v-model="models.password_confirmation"
                  placeholder="Confirm your password"
                  :is-invalid="v$.password_confirmation.$error"
                />
              </div>
              <FormValidation
                v-if="v$.password_confirmation.$error && v$.password_confirmation.required.$invalid"
              >
                Confirm password is required.
              </FormValidation>
              <FormValidation
                v-if="v$.password_confirmation.$error && v$.password_confirmation.sameAs.$invalid"
              >
                Passwords must match.
              </FormValidation>
            </div>
            <div class="col-span-6">
              <p class="text-sm text-gray-500">
                By creating an account, you agree to our
                <a href="#" class="text-gray-700 underline"> terms and conditions</a>
                and
                <a href="#" class="text-gray-700 underline">privacy policy</a>.
              </p>
            </div>
            <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
              <BaseButton type="submit" mode="primary" size="xl" :disabled="isLoading">
                <Icon v-if="isLoading" icon="gg:spinner" class="animate-spin text-base" />
                {{ isLoading ? 'Loading...' : 'Register' }}
              </BaseButton>
              <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                Already have an account?
                <RouterLink to="login" class="text-emerald-700 underline">Log in</RouterLink>.
              </p>
            </div>
          </form>
        </div>
      </main>
    </div>
  </section>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { RouterLink, useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth/auth'
import { useVuelidate } from '@vuelidate/core'
import { required, email, minLength, sameAs } from '@vuelidate/validators'

import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormPassword from '@/components/UI/forms/FormPassword.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import BaseAlert from '@/components/UI/alert/BaseAlert.vue'

const router = useRouter()
const authStore = useAuthStore()
const models = reactive({
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  password_confirmation: ''
})
const isLoading = ref(false)
const isError = ref(false)
const errorMessage = ref('')
let timeout

const rules = computed(() => {
  return {
    first_name: { required },
    last_name: { required },
    email: { required, email },
    password: { required, minLength: minLength(8) },
    password_confirmation: { required, sameAs: sameAs(models.password) }
  }
})

const v$ = useVuelidate(rules, models)

async function register() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    clearTimeout(timeout)
    isError.value = false
    isLoading.value = true
    await authStore.userRegister(models)
    router.push('/')
    isLoading.value = false
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
