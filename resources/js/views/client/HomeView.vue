<template>
  <div class="bg-white py-6 sm:py-8 lg:py-12">
    <section class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="mb-8 flex flex-wrap justify-between md:mb-16">
        <div
          class="mb-6 flex w-full flex-col justify-center sm:mb-12 lg:mb-0 lg:w-1/3 lg:pt-48 lg:pb-24"
        >
          <h1 class="text-black-800 mb-4 text-4xl font-bold sm:text-5xl md:mb-8 md:text-6xl">
            Find your<br />style online
          </h1>

          <p class="max-w-md leading-relaxed text-gray-500 xl:text-lg">
            This is a section of some simple filler text, also known as placeholder text. It shares
            characteristics of real text.
          </p>
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

      <div class="flex flex-col items-center justify-between gap-8 md:flex-row">
        <div class="flex h-12 w-64 divide-x overflow-hidden rounded-lg border">
          <a
            href="#"
            class="flex w-1/3 items-center justify-center text-gray-500 transition duration-100 hover:bg-gray-100 active:bg-gray-200"
          >
            Men
          </a>
          <a
            href="#"
            class="flex w-1/3 items-center justify-center text-gray-500 transition duration-100 hover:bg-gray-100 active:bg-gray-200"
          >
            Women
          </a>
          <a
            href="#"
            class="flex w-1/3 items-center justify-center text-gray-500 transition duration-100 hover:bg-gray-100 active:bg-gray-200"
          >
            Teens
          </a>
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
          Selected
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
      <h2 class="mb-8 text-center text-2xl font-bold text-gray-800 md:mb-12 lg:text-3xl">
        Collections
      </h2>

      <div class="grid gap-4 sm:grid-cols-2 md:gap-6 lg:grid-cols-3 xl:grid-cols-4">
        <!-- product - start -->
        <div>
          <a
            href="#"
            class="group relative flex h-96 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg"
          >
            <img
              src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?auto=format&q=75&fit=crop&crop=top&w=600&h=700"
              loading="lazy"
              alt="Photo by Austin Wade"
              class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
            />

            <div class="relative flex w-full flex-col rounded-lg bg-white p-4 text-center">
              <span class="text-gray-500">Men</span>
              <span class="text-lg font-bold text-gray-800 lg:text-xl">Business Causual</span>
            </div>
          </a>
        </div>
        <!-- product - end -->

        <!-- product - start -->
        <div>
          <a
            href="#"
            class="group relative flex h-96 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg"
          >
            <img
              src="https://images.unsplash.com/photo-1603344797033-f0f4f587ab60?auto=format&q=75&fit=crop&crop=top&w=600&h=700"
              loading="lazy"
              alt="Photo by engin akyurt"
              class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
            />

            <div class="relative flex w-full flex-col rounded-lg bg-white p-4 text-center">
              <span class="text-gray-500">Women</span>
              <span class="text-lg font-bold text-gray-800 lg:text-xl">Summer Season</span>
            </div>
          </a>
        </div>
        <!-- product - end -->

        <!-- product - start -->
        <div>
          <a
            href="#"
            class="group relative flex h-96 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg"
          >
            <img
              src="https://images.unsplash.com/photo-1552668693-d0738e00eca8?auto=format&q=75&fit=crop&crop=top&w=600&h=700"
              loading="lazy"
              alt="Photo by Austin Wade"
              class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
            />

            <div class="relative flex w-full flex-col rounded-lg bg-white p-4 text-center">
              <span class="text-gray-500">Men</span>
              <span class="text-lg font-bold text-gray-800 lg:text-xl">Streetwear</span>
            </div>
          </a>
        </div>
        <!-- product - end -->

        <!-- product - start -->
        <div>
          <a
            href="#"
            class="group relative flex h-96 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg"
          >
            <img
              src="https://images.unsplash.com/photo-1560269999-cef6ebd23ad3?auto=format&q=75&fit=crop&w=600&h=700"
              loading="lazy"
              alt="Photo by Austin Wade"
              class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110"
            />

            <div class="relative flex w-full flex-col rounded-lg bg-white p-4 text-center">
              <span class="text-gray-500">Women</span>
              <span class="text-lg font-bold text-gray-800 lg:text-xl">Sale</span>
            </div>
          </a>
        </div>
        <!-- product - end -->
      </div>
    </div>
  </div>
  <!-- collections - end -->
</template>
