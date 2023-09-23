<template>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8 lg:flex lg:gap-x-16">
      <aside
        class="mb-5 flex overflow-x-auto border-b border-gray-900/5 lg:mb-0 lg:block lg:w-64 lg:flex-none lg:border-0"
      >
        <nav class="flex-none px-4 sm:px-6 lg:px-0">
          <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap lg:flex-col">
            <li>
              <RouterLink
                to="/user-profile"
                class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-emerald-600"
                active-class="!bg-gray-50 !text-emerald-600"
              >
                <Icon icon="ph:user" class="h-6 w-6 shrink-0 group-hover:text-emerald-600" />
                General
              </RouterLink>
            </li>
            <li>
              <RouterLink
                to="/orders"
                class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-emerald-600"
                active-class="!bg-gray-50 !text-emerald-600"
              >
                <Icon
                  icon="fluent-mdl2:activate-orders"
                  class="h-6 w-6 shrink-0 group-hover:text-emerald-600"
                />
                Orders
              </RouterLink>
            </li>
            <li>
              <RouterLink
                to="/address"
                class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-emerald-600"
                active-class="!bg-gray-50 !text-emerald-600"
              >
                <Icon
                  icon="mdi:address-marker-outline"
                  class="h-6 w-6 shrink-0 group-hover:text-emerald-600"
                />
                address
              </RouterLink>
            </li>
            <li>
              <RouterLink
                to="/profile-security"
                class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-emerald-600"
                active-class="!bg-gray-50 !text-emerald-600"
              >
                <Icon
                  icon="mingcute:user-security-line"
                  class="h-6 w-6 shrink-0 group-hover:text-emerald-600"
                />
                Security
              </RouterLink>
            </li>
          </ul>
        </nav>
      </aside>
      <main class="px-4 sm:px-6 lg:flex-auto lg:px-0">
        <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
          <RouterView />
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { RouterView, RouterLink } from 'vue-router'
</script>
