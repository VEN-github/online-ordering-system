<template>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <section class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="mb-8 flex flex-wrap justify-between md:mb-16">
        <div class="mb-6 sm:mb-12 lg:mb-0 lg:w-1/3 lg:pt-48 lg:pb-24">
          <h1 class="text-black-800 mb-4 text-4xl font-bold sm:text-5xl md:mb-8 md:text-6xl">
            Find your<br />furniture style
          </h1>

          <p class="mb-5 max-w-md leading-relaxed text-gray-500 xl:text-lg">
            This is a section of some simple filler text, also known as placeholder text. It shares
            characteristics of real text.
          </p>
          <BaseButton mode="primary" size="lg">
            <span>Shop Now</span><Icon icon="ion:cart" class="h-5 w-5" />
          </BaseButton>
        </div>

        <div class="mb-12 flex w-full md:mb-16 lg:w-2/3">
          <div
            class="relative top-12 left-12 z-10 -ml-12 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:top-16 md:left-16 lg:ml-0"
          >
            <img
              src="https://images.unsplash.com/photo-1606744824163-985d376605aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1632&q=80"
              loading="lazy"
              alt="Photo by Kaung Htet"
              class="h-full w-full object-cover object-center"
            />
          </div>

          <div class="overflow-hidden rounded-lg bg-gray-100 shadow-lg">
            <img
              src="https://images.unsplash.com/photo-1596179141065-81fc52bec5ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1083&q=80"
              loading="lazy"
              alt="Photo by Manny Moreno"
              class="h-full w-full object-cover object-center"
            />
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- hero - end -->

  <!-- product-grid - start -->
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <!-- text - start -->
      <div class="mb-10 md:mb-16">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">
          Feature Products
        </h2>

        <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
          This is a section of some simple filler text, also known as placeholder text. It shares
          some characteristics of a real written text but is random or otherwise generated.
        </p>
      </div>
      <!-- text - end -->

      <div class="grid gap-x-4 gap-y-8 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-3 xl:grid-cols-4">
        <!-- product - start -->
        <div>
          <a
            href="#"
            class="group relative mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3"
          >
            <img
              src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?auto=format&q=75&fit=crop&crop=top&w=600&h=700"
              loading="lazy"
              alt="Photo by Austin Wade"
              class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
            />

            <div class="absolute left-0 bottom-2 flex gap-2">
              <span
                class="rounded-r-lg bg-red-500 px-3 py-1.5 text-sm font-semibold uppercase tracking-wider text-white"
              >
                -50%
              </span>
              <span
                class="rounded-lg bg-white px-3 py-1.5 text-sm font-bold uppercase tracking-wider text-gray-800"
              >
                New
              </span>
            </div>
          </a>

          <div class="flex items-start justify-between gap-2 px-2">
            <div class="flex flex-col">
              <a
                href="#"
                class="text-lg font-bold text-gray-800 transition duration-100 hover:text-gray-500 lg:text-xl"
              >
                Fancy Outfit
              </a>
              <span class="text-gray-500">by Fancy Brand</span>
            </div>

            <div class="flex flex-col items-end">
              <span class="font-bold text-gray-600 lg:text-lg">$19.99</span>
              <span class="text-sm text-red-500 line-through">$39.99</span>
            </div>
          </div>
        </div>
        <!-- product - end -->

        <!-- product - start -->
        <div>
          <a
            href="#"
            class="group relative mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3"
          >
            <img
              src="https://images.unsplash.com/photo-1523359346063-d879354c0ea5?auto=format&q=75&fit=crop&crop=top&w=600&h=700"
              loading="lazy"
              alt="Photo by Nick Karvounis"
              class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
            />
          </a>

          <div class="flex items-start justify-between gap-2 px-2">
            <div class="flex flex-col">
              <a
                href="#"
                class="text-lg font-bold text-gray-800 transition duration-100 hover:text-gray-500 lg:text-xl"
              >
                Cool Outfit
              </a>
              <span class="text-gray-500">by Cool Brand</span>
            </div>

            <div class="flex flex-col items-end">
              <span class="font-bold text-gray-600 lg:text-lg">$29.99</span>
            </div>
          </div>
        </div>
        <!-- product - end -->

        <!-- product - start -->
        <div>
          <a
            href="#"
            class="group relative mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3"
          >
            <img
              src="https://images.unsplash.com/photo-1548286978-f218023f8d18?auto=format&q=75&fit=crop&crop=top&w=600&h=700"
              loading="lazy"
              alt="Photo by Austin Wade"
              class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
            />
          </a>

          <div class="flex items-start justify-between gap-2 px-2">
            <div class="flex flex-col">
              <a
                href="#"
                class="text-lg font-bold text-gray-800 transition duration-100 hover:text-gray-500 lg:text-xl"
              >
                Nice Outfit
              </a>
              <span class="text-gray-500">by Nice Brand</span>
            </div>

            <div class="flex flex-col items-end">
              <span class="font-bold text-gray-600 lg:text-lg">$35.00</span>
            </div>
          </div>
        </div>
        <!-- product - end -->

        <!-- product - start -->
        <div>
          <a
            href="#"
            class="group relative mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3"
          >
            <img
              src="https://images.unsplash.com/photo-1566207274740-0f8cf6b7d5a5?auto=format&q=75&fit=crop&crop=top&w=600&h=700"
              loading="lazy"
              alt="Photo by Vladimir Fedotov"
              class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
            />
          </a>

          <div class="flex items-start justify-between gap-2 px-2">
            <div class="flex flex-col">
              <a
                href="#"
                class="text-lg font-bold text-gray-800 transition duration-100 hover:text-gray-500 lg:text-xl"
              >
                Lavish Outfit
              </a>
              <span class="text-gray-500">by Lavish Brand</span>
            </div>

            <div class="flex flex-col items-end">
              <span class="font-bold text-gray-600 lg:text-lg">$49.99</span>
            </div>
          </div>
        </div>
        <!-- product - end -->
      </div>
    </div>
  </div>
  <!-- product-grid - end -->

  <!-- collections - start -->
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <!-- text - start -->
      <div class="mb-10 md:mb-16">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">
          Shop by Category
        </h2>

        <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
          This is a section of some simple filler text, also known as placeholder text. It shares
          some characteristics of a real written text but is random or otherwise generated.
        </p>
      </div>
      <!-- text - end -->

      <div class="grid gap-6 sm:grid-cols-2">
        <!-- product - start -->
        <a
          href="#"
          class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg"
        >
          <img
            src="https://images.unsplash.com/photo-1620243318482-fdd2affd7a38?auto=format&q=75&fit=crop&w=750"
            loading="lazy"
            alt="Photo by Fakurian Design"
            class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
          />

          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50"
          ></div>

          <div class="relative flex flex-col">
            <span class="text-gray-300">Home</span>
            <span class="text-lg font-semibold text-white lg:text-xl">Decoration</span>
          </div>
        </a>
        <!-- product - end -->

        <!-- product - start -->
        <a
          href="#"
          class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg"
        >
          <img
            src="https://images.unsplash.com/photo-1620241608701-94ef138c7ec9?auto=format&q=75&fit=crop&w=750"
            loading="lazy"
            alt="Photo by Fakurian Design"
            class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
          />

          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50"
          ></div>

          <div class="relative flex flex-col">
            <span class="text-gray-300">Modern</span>
            <span class="text-lg font-semibold text-white lg:text-xl">Furniture</span>
          </div>
        </a>
        <!-- product - end -->
      </div>
    </div>
  </div>
  <!-- collections - end -->

  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <!-- text - start -->
      <div class="mb-10 md:mb-16">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">
          Frequently asked questions
        </h2>

        <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
          This is a section of some simple filler text, also known as placeholder text. It shares
          some characteristics of a real written text but is random or otherwise generated.
        </p>
      </div>
      <!-- text - end -->

      <div class="grid gap-8 sm:grid-cols-2 sm:gap-y-10 xl:grid-cols-3">
        <!-- question - start -->
        <div class="relative rounded-lg bg-gray-100 p-5 pt-8">
          <span
            class="absolute -top-4 left-4 inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-500 text-white"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                clip-rule="evenodd"
              />
            </svg>
          </span>

          <h3 class="mb-3 text-lg font-semibold text-indigo-500 md:text-xl">
            How does the product work?
          </h3>
          <p class="text-gray-500">
            This is a section of some simple filler text, also known as placeholder text. It shares
            some characteristics of a real written text.
          </p>
        </div>
        <!-- question - end -->

        <!-- question - start -->
        <div class="relative rounded-lg bg-gray-100 p-5 pt-8">
          <span
            class="absolute -top-4 left-4 inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-500 text-white"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                clip-rule="evenodd"
              />
            </svg>
          </span>

          <h3 class="mb-3 text-lg font-semibold text-indigo-500 md:text-xl">
            What are the features?
          </h3>
          <p class="text-gray-500">
            This is a section of some simple filler text, also known as placeholder text. It shares
            some characteristics of a real written text.
          </p>
        </div>
        <!-- question - end -->

        <!-- question - start -->
        <div class="relative rounded-lg bg-gray-100 p-5 pt-8">
          <span
            class="absolute -top-4 left-4 inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-500 text-white"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                clip-rule="evenodd"
              />
            </svg>
          </span>

          <h3 class="mb-3 text-lg font-semibold text-indigo-500 md:text-xl">
            What about integrations?
          </h3>
          <p class="text-gray-500">
            This is a section of some simple filler text, also known as placeholder text. It shares
            some characteristics of a real written text.
          </p>
        </div>
        <!-- question - end -->

        <!-- question - start -->
        <div class="relative rounded-lg bg-gray-100 p-5 pt-8">
          <span
            class="absolute -top-4 left-4 inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-500 text-white"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                clip-rule="evenodd"
              />
            </svg>
          </span>

          <h3 class="mb-3 text-lg font-semibold text-indigo-500 md:text-xl">
            Is support available?
          </h3>
          <p class="text-gray-500">
            This is a section of some simple filler text, also known as placeholder text. It shares
            some characteristics of a real written text.
          </p>
        </div>
        <!-- question - end -->

        <!-- question - start -->
        <div class="relative rounded-lg bg-gray-100 p-5 pt-8">
          <span
            class="absolute -top-4 left-4 inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-500 text-white"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                clip-rule="evenodd"
              />
            </svg>
          </span>

          <h3 class="mb-3 text-lg font-semibold text-indigo-500 md:text-xl">
            How does one upgrage a plan?
          </h3>
          <p class="text-gray-500">
            This is a section of some simple filler text, also known as placeholder text. It shares
            some characteristics of a real written text.
          </p>
        </div>
        <!-- question - end -->

        <!-- question - start -->
        <div class="relative rounded-lg bg-gray-100 p-5 pt-8">
          <span
            class="absolute -top-4 left-4 inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                clip-rule="evenodd"
              />
            </svg>
          </span>

          <h3 class="mb-3 text-lg font-semibold text-emerald-500 md:text-xl">
            Which payment methods are available?
          </h3>
          <p class="text-gray-500">
            This is a section of some simple filler text, also known as placeholder text. It shares
            some characteristics of a real written text.
          </p>
        </div>
        <!-- question - end -->
      </div>
    </div>
  </div>
</template>

<script setup>
import BaseButton from '@/components/UI/button/BaseButton.vue'
</script>
