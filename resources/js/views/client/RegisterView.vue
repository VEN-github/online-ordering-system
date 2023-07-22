<template>
  <section class="bg-white">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
      <aside class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6">
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
          <a class="block text-blue-600" href="/">
            <span class="sr-only">Home</span>
            <img class="h-8 sm:h-10" src="../../../assets/images/logo/logo.svg" alt="logo" />
          </a>
          <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">Welcome!</h1>
          <p class="mt-4 leading-relaxed text-gray-500">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi nam dolorum aliquam,
            quibusdam aperiam voluptatum.
          </p>
          <form action="#" class="mt-8 grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
              <FormLabel label-id="first-name">First Name</FormLabel>
              <div class="mt-2">
                <FormInput id="first-name" placeholder="Enter your first name" />
              </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <FormLabel label-id="last-name">Last Name</FormLabel>
              <div class="mt-2">
                <FormInput id="last-name" placeholder="Enter your last name" />
              </div>
            </div>
            <div class="col-span-6">
              <FormLabel label-id="email">Email address</FormLabel>
              <div class="mt-2">
                <FormInput id="email" type="email" placeholder="Enter your email address" />
              </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <FormLabel label-id="password">Password</FormLabel>
              <div class="relative mt-2">
                <FormPassword id="password" placeholder="Enter your password" />
              </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
              <FormLabel label-id="confirm-password">Confirm Password</FormLabel>
              <div class="relative mt-2">
                <FormPassword id="confirm-password" placeholder="Confirm your password" />
              </div>
            </div>
            <div class="col-span-6">
              <p class="text-sm text-gray-500">
                By creating an account, you agree to our
                <a href="#" class="text-gray-700 underline"> terms and conditions </a>
                and
                <a href="#" class="text-gray-700 underline">privacy policy</a>.
              </p>
            </div>
            <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
              <BaseButton type="submit" mode="primary" size="xl">Register</BaseButton>
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
import { RouterLink } from 'vue-router'

import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormPassword from '@/components/UI/forms/FormPassword.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
</script>
