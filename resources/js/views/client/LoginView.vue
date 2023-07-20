<template>
  <section class="bg-white">
    <div class="min-h-screen lg:grid lg:grid-cols-12">
      <section
        class="relative flex h-[16rem] items-end bg-gray-900 lg:col-span-5 lg:h-full xl:col-span-6"
      >
        <img
          alt="Night"
          src="https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
          class="absolute inset-0 h-full w-full object-cover opacity-80"
        />
        <div class="hidden lg:relative lg:block lg:p-12">
          <RouterLink class="block text-white" to="/">
            <span class="sr-only">Home</span>
            <img class="h-8 sm:h-10" src="../../../assets/images/logo/logo.svg" alt="logo" />
          </RouterLink>
          <h2 class="mt-6 text-2xl font-bold text-white sm:text-3xl md:text-4xl">Welcome!</h2>
          <p class="mt-4 leading-relaxed text-white/90">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi nam dolorum aliquam,
            quibusdam aperiam voluptatum.
          </p>
        </div>
      </section>
      <main
        class="flex flex-col items-center justify-center px-8 py-8 sm:px-12 lg:relative lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6"
      >
        <div class="relative -mt-16 block lg:hidden">
          <RouterLink
            class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-white text-blue-600 sm:h-20 sm:w-20"
            to="/"
          >
            <span class="sr-only">Home</span>
            <img class="h-8 sm:h-10" src="../../../assets/images/logo/logo.svg" alt="logo" />
          </RouterLink>
          <h1 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">Welcome!</h1>
          <p class="mt-4 leading-relaxed text-gray-500">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi nam dolorum aliquam,
            quibusdam aperiam voluptatum.
          </p>
        </div>
        <form
          class="mt-8 w-full space-y-6 lg:absolute lg:top-2/4 lg:left-0 lg:mt-0 lg:w-2/4 lg:-translate-y-2/4 lg:translate-x-52"
          @submit.prevent="login"
        >
          <Transition name="fade">
            <BaseAlert v-if="isError" mode="error" class="mb-5 shadow">
              {{ errorMessage }}
            </BaseAlert>
          </Transition>
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
              <FormPassword
                id="password"
                v-model="models.password"
                placeholder="Enter your password"
                :is-invalid="v$.password.$error"
              />
            </div>
            <FormValidation v-if="v$.password.$error"> Password is required. </FormValidation>
          </div>
          <div>
            <BaseButton type="submit" mode="primary" size="lg" is-full :disabled="isLoading">
              <Icon v-if="isLoading" icon="gg:spinner" class="animate-spin text-base" />
              {{ isLoading ? 'Loading...' : 'Login' }}
            </BaseButton>
          </div>
        </form>
      </main>
    </div>
  </section>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { RouterLink, useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth/auth'
import { useVuelidate } from '@vuelidate/core'
import { required, email } from '@vuelidate/validators'

import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormPassword from '@/components/UI/forms/FormPassword.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import BaseAlert from '@/components/UI/alert/BaseAlert.vue'

const router = useRouter()
const authStore = useAuthStore()
const models = reactive({
  email: '',
  password: ''
})

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

async function login() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    clearTimeout(timeout)
    isError.value = false
    isLoading.value = true
    await authStore.userLogin(models)
    isLoading.value = false
    router.push('/')
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
