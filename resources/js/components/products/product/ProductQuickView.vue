<template>
  <Teleport to="body">
    <BaseModal v-bind="$attrs">
      <div
        class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:items-center lg:gap-x-8"
      >
        <div
          class="aspect-h-3 aspect-w-2 overflow-hidden rounded-lg bg-gray-100 sm:col-span-4 lg:col-span-5"
        >
          <img
            src="https://tailwindui.com/img/ecommerce-images/product-page-01-featured-product-shot.jpg"
            alt="Back of women&#039;s Basic Tee in black."
            class="object-cover object-center"
          />
        </div>
        <div class="sm:col-span-8 lg:col-span-7">
          <h2 class="flex items-center justify-between">
            <span class="text-xl font-medium text-gray-900">Title Here</span>
            <Icon
              icon="material-symbols:close"
              role="button"
              class="h-6 w-6 text-gray-400 hover:text-gray-500"
              @click="emit('onClose')"
            />
          </h2>
          <section aria-labelledby="information-heading" class="mt-1">
            <h3 id="information-heading" class="sr-only">Product information</h3>
            <p class="font-medium text-gray-900">$32</p>
          </section>
          <section aria-labelledby="options-heading" class="mt-8">
            <h3 id="options-heading" class="sr-only">Product options</h3>
            <form>
              <!-- Color picker -->
              <div>
                <h4 class="text-sm font-medium text-gray-900">Color</h4>
                <fieldset class="mt-2">
                  <legend class="sr-only">Choose a color</legend>
                  <div class="flex items-center space-x-3">
                    <!--
                          Active and Checked: "ring ring-offset-1"
                          Not Active and Checked: "ring-2"
                        -->
                    <label
                      class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-900 focus:outline-none"
                    >
                      <input
                        type="radio"
                        name="color-choice"
                        value="Black"
                        class="sr-only"
                        aria-labelledby="color-choice-0-label"
                      />
                      <span id="color-choice-0-label" class="sr-only">Black</span>
                      <span
                        aria-hidden="true"
                        class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-gray-900"
                      ></span>
                    </label>
                    <!--
                          Active and Checked: "ring ring-offset-1"
                          Not Active and Checked: "ring-2"
                        -->
                    <label
                      class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-none"
                    >
                      <input
                        type="radio"
                        name="color-choice"
                        value="Heather Grey"
                        class="sr-only"
                        aria-labelledby="color-choice-1-label"
                      />
                      <span id="color-choice-1-label" class="sr-only">Heather Grey</span>
                      <span
                        aria-hidden="true"
                        class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-gray-400"
                      ></span>
                    </label>
                  </div>
                </fieldset>
              </div>

              <!-- Size picker -->
              <div class="mt-8">
                <div class="flex items-center justify-between">
                  <h4 class="text-sm font-medium text-gray-900">Size</h4>
                  <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    Size guide
                  </a>
                </div>

                <fieldset class="mt-2">
                  <legend class="sr-only">Choose a size</legend>
                  <div class="grid grid-cols-7 gap-2">
                    <!--
                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                        -->
                    <label
                      class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase focus:outline-none sm:flex-1"
                    >
                      <input
                        type="radio"
                        name="size-choice"
                        value="XXS"
                        class="sr-only"
                        aria-labelledby="size-choice-0-label"
                      />
                      <span id="size-choice-0-label">XXS</span>
                    </label>
                    <!--
                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                        -->
                    <label
                      class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase focus:outline-none sm:flex-1"
                    >
                      <input
                        type="radio"
                        name="size-choice"
                        value="XS"
                        class="sr-only"
                        aria-labelledby="size-choice-1-label"
                      />
                      <span id="size-choice-1-label">XS</span>
                    </label>
                    <!--
                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                        -->
                    <label
                      class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase focus:outline-none sm:flex-1"
                    >
                      <input
                        type="radio"
                        name="size-choice"
                        value="S"
                        class="sr-only"
                        aria-labelledby="size-choice-2-label"
                      />
                      <span id="size-choice-2-label">S</span>
                    </label>
                    <!--
                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                        -->
                    <label
                      class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase focus:outline-none sm:flex-1"
                    >
                      <input
                        type="radio"
                        name="size-choice"
                        value="M"
                        class="sr-only"
                        aria-labelledby="size-choice-3-label"
                      />
                      <span id="size-choice-3-label">M</span>
                    </label>
                    <!--
                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                        -->
                    <label
                      class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase focus:outline-none sm:flex-1"
                    >
                      <input
                        type="radio"
                        name="size-choice"
                        value="L"
                        class="sr-only"
                        aria-labelledby="size-choice-4-label"
                      />
                      <span id="size-choice-4-label">L</span>
                    </label>
                    <!--
                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                        -->
                    <label
                      class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase focus:outline-none sm:flex-1"
                    >
                      <input
                        type="radio"
                        name="size-choice"
                        value="XL"
                        class="sr-only"
                        aria-labelledby="size-choice-5-label"
                      />
                      <span id="size-choice-5-label">XL</span>
                    </label>
                    <!--
                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                        -->
                    <label
                      class="flex cursor-not-allowed items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase opacity-25 sm:flex-1"
                    >
                      <input
                        type="radio"
                        name="size-choice"
                        value="XXL"
                        disabled
                        class="sr-only"
                        aria-labelledby="size-choice-6-label"
                      />
                      <span id="size-choice-6-label">XXL</span>
                    </label>
                  </div>
                </fieldset>
              </div>
              <BaseButton mode="primary" size="xl" is-full>
                <Icon class="h-6 w-6 text-white" icon="heroicons:shopping-bag" />
                <span> Add to Cart </span>
              </BaseButton>
              <p class="absolute left-4 top-4 text-center sm:static sm:mt-8">
                <a href="#" class="font-medium text-emerald-600 hover:text-emerald-500">
                  View full details
                </a>
              </p>
            </form>
          </section>
        </div>
      </div>
    </BaseModal>
  </Teleport>
</template>

<script setup>
import BaseModal from '@/components/UI/modal/BaseModal.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const emit = defineEmits(['onClose'])
</script>
