<template>
  <div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
      <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
        <div class="flex flex-col-reverse">
          <div class="mx-auto mt-6 w-full max-w-2xl lg:max-w-none">
            <div
              v-if="galleryImages.length"
              class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4"
              aria-orientation="horizontal"
              role="tablist"
            >
              <button
                v-for="(image, index) in galleryImages"
                :key="index"
                class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4"
                role="tab"
                type="button"
                @click="highlightImage = image"
              >
                <span class="sr-only">Angled view</span>
                <span class="absolute inset-0 overflow-hidden rounded-md">
                  <img
                    :src="image"
                    alt="Image Gallery"
                    class="h-full w-full object-contain object-center"
                  />
                </span>
                <span
                  class="pointer-events-none absolute inset-0 rounded-md ring-2 ring-offset-2"
                  :class="[highlightImage == image ? 'ring-emerald-500' : 'ring-transparent']"
                  aria-hidden="true"
                ></span>
              </button>
            </div>
          </div>
          <div class="aspect-h-1 aspect-w-1 w-full">
            <div id="tabs-1-panel-1" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
              <img
                v-if="highlightImage"
                :src="highlightImage"
                alt="Highlight Image"
                class="h-[395px] w-full object-contain object-center sm:rounded-lg"
              />
              <img
                v-else
                src="../../../assets/images/no-image.png"
                alt="No image available"
                class="h-[395px] w-full object-contain object-center sm:rounded-lg"
              />
            </div>
          </div>
        </div>
        <div class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0">
          <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ product?.name }}</h1>
          <div class="mt-3">
            <h2 class="sr-only">Product information</h2>
            <p
              v-if="!product?.discounted_price"
              class="gap-2 text-3xl tracking-tight text-gray-900"
            >
              {{ formattedPrice }}
            </p>
            <p v-else class="flex items-center gap-2 text-3xl tracking-tight text-gray-900">
              <span>{{ formattedDiscountedPrice }}</span>
              <span class="text-lg text-red-500 line-through">{{ formattedPrice }}</span>
            </p>
          </div>
          <div class="mt-6">
            <h3 class="sr-only">Description</h3>
            <div class="space-y-6 text-base text-gray-700">
              <p v-html="product?.description"></p>
            </div>
          </div>
          <div
            v-if="product?.variations.length"
            class="mt-10 lg:col-start-1 lg:row-start-2 lg:max-w-lg lg:self-start"
          >
            <section aria-labelledby="options-heading">
              <h2 id="options-heading" class="sr-only">Product options</h2>
              <form>
                <div class="sm:flex sm:justify-between">
                  <fieldset>
                    <legend class="block text-sm font-medium text-gray-700">Options</legend>
                    <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                      <div
                        v-for="variation in product?.variations"
                        :key="variation.id"
                        class="relative block cursor-pointer rounded-lg border border-gray-300 p-4 focus:outline-none"
                        :class="[
                          variation.id == selectedVariation ? 'ring-2 ring-emerald-500' : ''
                        ]"
                        @click="selectVariation(variation)"
                      >
                        <input
                          v-model="selectedVariation"
                          type="radio"
                          name="variation"
                          :value="variation.id"
                          class="sr-only"
                        />
                        <p class="text-base font-medium text-gray-900">
                          {{ variation.size }}
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                          {{ variation.color }}
                        </p>
                        <div
                          class="pointer-events-none absolute -inset-px rounded-lg border-2"
                          :class="[
                            variation.id == selectedVariation
                              ? 'border-emerald-500'
                              : 'border-transparent'
                          ]"
                          aria-hidden="true"
                        ></div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </form>
            </section>
          </div>
          <div class="mt-6">
            <div class="mt-10 flex items-center gap-8">
              <QuantityInput
                v-model="quantity"
                :max-value="maxValue"
                @add="quantity++"
                @subtract="quantity--"
              />
              <BaseButton
                mode="primary"
                size="xl"
                is-full
                :disabled="isDisabled"
                @click="addToCart"
              >
                <Icon class="h-5 w-5 text-white" icon="heroicons:shopping-bag" />
                <span> Add to Cart </span>
              </BaseButton>
            </div>
          </div>
          <section aria-labelledby="policies-heading" class="mt-10">
            <h2 id="policies-heading" class="sr-only">Our Policies</h2>
            <dl
              class="grid grid-cols-1 gap-6 divide-y divide-gray-200 border-t pt-5 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2"
            >
              <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-center">
                <dt>
                  <Icon
                    icon="akar-icons:shipping-box-02"
                    class="mx-auto h-6 w-6 flex-shrink-0 text-gray-400"
                  />
                  <span class="mt-4 text-sm font-medium text-gray-900">Standard Shipping</span>
                </dt>
                <dd class="mt-1 text-sm text-gray-500">{{ formattedStandardShippingPrice }}</dd>
              </div>
              <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-center">
                <dt>
                  <Icon
                    icon="la:shipping-fast"
                    class="mx-auto h-6 w-6 flex-shrink-0 text-gray-400"
                  />
                  <span class="mt-4 text-sm font-medium text-gray-900">Express Shipping</span>
                </dt>
                <dd class="mt-1 text-sm text-gray-500">{{ formattedExpressShippingPrice }}</dd>
              </div>
            </dl>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useProductStore } from '@/store/products/product'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import BaseButton from '@/components/UI/button/BaseButton.vue'
import QuantityInput from '@/components/UI/forms/QuantityInput.vue'

const props = defineProps({
  slug: {
    type: String,
    default() {
      return ''
    }
  }
})

const router = useRouter()
const productStore = useProductStore()
const product = ref(null)
const highlightImage = ref(null)
const galleryImages = ref([])
const selectedVariation = ref('')
const quantity = ref(1)
const maxValue = ref(1)

const formattedPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(product.value?.orig_price)
})

const formattedDiscountedPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(product.value?.discounted_price)
})

const formattedStandardShippingPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(product.value?.standard_shipping_price)
})

const formattedExpressShippingPrice = computed(() => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP'
  }).format(product.value?.express_shipping_price)
})

const isDisabled = computed(() => {
  if (!product.value?.variations.length) return false
  return !selectedVariation.value
})

watch(
  () => product.value?.variations,
  (variations) => {
    if (variations.length === 1) {
      selectVariation(variations[0])
    }
  }
)

onMounted(async () => {
  await getGuestProduct()
})

async function getGuestProduct() {
  try {
    await productStore.getGuestProduct(props.slug)
    product.value = productStore.guestProduct
    highlightImage.value = product.value.highlight_image
    maxValue.value = product.value.stocks ?? 1
    if (!product.value.images.length) return
    galleryImages.value = [product.value.highlight_image, ...product.value.images]
  } catch ({ message }) {
    router.push({ name: 'not-found' })
  }
}

function selectVariation(variation) {
  quantity.value = 1
  selectedVariation.value = variation.id
  maxValue.value = variation.stock
}

function addToCart() {
  productStore.addToCart({
    quantity: quantity.value,
    selectedVariation: product.value?.variations.find(
      (variation) => variation.id == selectedVariation.value
    ),
    ...product.value
  })
  toast(`${product.value?.name} added to cart.`, {
    type: 'success',
    theme: 'colored',
    hideProgressBar: true,
    multiple: true,
    transition: toast.TRANSITIONS.SLIDE,
    position: toast.POSITION.TOP_CENTER,
    pauseOnHover: false,
    pauseOnFocusLoss: false
  })
}
</script>
