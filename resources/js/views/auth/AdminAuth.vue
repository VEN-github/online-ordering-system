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
        <form class="space-y-6">
          <div>
            <FormLabel labelId="email">Email Address</FormLabel>
            <div class="mt-2">
              <FormInput id="email" type="email" placeholder="Enter your email address" />
            </div>
          </div>
          <div>
            <FormLabel labelId="password">Password</FormLabel>
            <div class="relative mt-2">
              <FormInput id="password" type="password" placeholder="Enter your password" />
            </div>
          </div>
          <div class="flex items-center justify-between">
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
          </div>
          <div>
            <BaseButton type="submit" size="lg" is-full>Sign in</BaseButton>
          </div>
        </form>
      </BaseCard>
    </div>
  </div>
</template>

<script setup>
import BaseCard from '@/components/UI/cards/BaseCard.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import BaseButton from '@/components/UI/buttons/BaseButton.vue'
</script>
