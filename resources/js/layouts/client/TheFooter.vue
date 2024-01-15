<template>
  <div class="bg-white pt-4 sm:pt-10 lg:pt-12">
    <footer class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div
        class="mb-16 grid grid-cols-2 gap-12 border-t pt-10 md:grid-cols-4 lg:grid-cols-6 lg:gap-8 lg:pt-12"
      >
        <div class="col-span-full lg:col-span-2">
          <div class="mb-4 lg:-mt-2">
            <RouterLink to="/" aria-label="logo">
              <img class="h-auto sm:w-14" src="../../../assets/images/logo/logo.svg" alt="logo" />
            </RouterLink>
          </div>
          <p class="mb-6 text-gray-500 sm:pr-8">Crafting Comfort and Style for Every Room</p>
        </div>
        <div>
          <div class="mb-4 font-bold uppercase tracking-widest text-gray-800">Products</div>
          <nav class="flex flex-col gap-4">
            <div>
              <RouterLink
                to="#"
                class="text-gray-500 transition duration-100 hover:text-emerald-500"
                active-class="text-emerald-500"
              >
                Overview
              </RouterLink>
            </div>
            <div>
              <RouterLink
                to="#"
                class="text-gray-500 transition duration-100 hover:text-emerald-500"
                active-class="text-emerald-500"
              >
                Categories
              </RouterLink>
            </div>
          </nav>
        </div>
        <div>
          <div class="mb-4 font-bold uppercase tracking-widest text-gray-800">Company</div>
          <nav class="flex flex-col gap-4">
            <div>
              <RouterLink
                to="/about"
                class="text-gray-500 transition duration-100 hover:text-emerald-500"
                active-class="text-emerald-500"
              >
                About
              </RouterLink>
            </div>
            <div>
              <RouterLink
                to="#"
                class="text-gray-500 transition duration-100 hover:text-emerald-500"
                active-class="text-emerald-500"
              >
                Blog
              </RouterLink>
            </div>
          </nav>
        </div>
        <div>
          <div class="mb-4 font-bold uppercase tracking-widest text-gray-800">Support</div>
          <nav class="flex flex-col gap-4">
            <div>
              <RouterLink
                to="/contact"
                class="text-gray-500 transition duration-100 hover:text-emerald-500"
                active-class="text-emerald-500"
              >
                Contact
              </RouterLink>
            </div>
            <div>
              <RouterLink
                to="/faq"
                class="text-gray-500 transition duration-100 hover:text-emerald-500"
                active-class="text-emerald-500"
              >
                FAQ
              </RouterLink>
            </div>
          </nav>
        </div>
        <div>
          <div class="mb-4 font-bold uppercase tracking-widest text-gray-800">Legal</div>
          <nav class="flex flex-col gap-4">
            <div>
              <RouterLink
                to="#"
                class="text-gray-500 transition duration-100 hover:text-emerald-500"
                active-class="text-emerald-500"
              >
                Terms of Service
              </RouterLink>
            </div>
            <div>
              <RouterLink
                to="#"
                class="text-gray-500 transition duration-100 hover:text-emerald-500"
                active-class="text-emerald-500"
              >
                Privacy Policy
              </RouterLink>
            </div>
          </nav>
        </div>
      </div>
      <div class="border-t py-8 text-center text-sm text-gray-400">
        © 2023 - Present. All rights reserved.
      </div>
    </footer>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
</script>
