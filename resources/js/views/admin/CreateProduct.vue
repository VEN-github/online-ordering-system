<template>
  <div class="flex items-center space-x-4 py-5 lg:py-6">
    <BaseButton link="/products" is-link>
      <Icon icon="material-symbols:arrow-back-rounded" />
      <span>Back</span>
    </BaseButton>
    <h2 class="text-xl font-medium text-slate-800 lg:text-2xl">Add Product</h2>
  </div>
  <div class="mt-5 space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
      <div class="px-4 sm:px-0">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Product Photos</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
          Enhance Your Product's Appeal with High-Quality Photos.
        </p>
      </div>
      <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
        <div class="px-4 py-6 sm:p-8">
          <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="col-span-full">
              <FormLabel :is-invalid="v$.highlightImage.$error">Highlight Image</FormLabel>
              <div class="mt-2">
                <FormUpload @on-upload="handleHighlightImage" />
              </div>
              <FormValidation v-if="v$.highlightImage.$error">
                Highlight Image is required.
              </FormValidation>
            </div>
            <div class="col-span-full">
              <FormLabel>Products Images</FormLabel>
              <div class="mt-2">
                <FormUpload max-files="3" allow-multiple @on-upload="handleImages" />
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
      <div class="px-4 sm:px-0">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Product Information</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
          Get All the Details You Need: Comprehensive Product Information.
        </p>
      </div>
      <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
        <div class="px-4 py-6 sm:p-8">
          <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="col-span-full">
              <FormSwitch v-model="models.isFeatured" label="Featured Product" />
            </div>
            <div class="col-span-full">
              <FormSwitch v-model="models.isActive" label="Active" />
            </div>
            <div class="sm:col-span-3">
              <FormLabel label-id="product-name" :is-invalid="v$.name.$error">
                Product name
              </FormLabel>
              <div class="mt-2">
                <FormInput
                  id="product-name"
                  v-model="models.name"
                  placeholder="Enter product name"
                  :is-invalid="v$.name.$error"
                />
              </div>
              <FormValidation v-if="v$.name.$error"> Product name is required. </FormValidation>
            </div>
            <div class="sm:col-span-3">
              <FormLabel label-id="slug">Slug</FormLabel>
              <div class="mt-2">
                <FormInput id="slug" v-model="models.slug" placeholder="Enter slug(optional)" />
              </div>
            </div>
            <div class="sm:col-span-4">
              <FormLabel label-id="category" :is-invalid="v$.category.$error">Category</FormLabel>
              <div class="mt-2">
                <FormSelect
                  id="category"
                  v-model="models.category"
                  :is-invalid="v$.category.$error"
                >
                  <option value="" disabled>Select Category</option>
                  <option v-for="category in categories" :key="category" :value="category.id">
                    {{ category.name }}
                  </option>
                </FormSelect>
              </div>
              <FormValidation v-if="v$.category.$error"> Category is required. </FormValidation>
            </div>
            <div class="sm:col-span-4">
              <FormLabel label-id="supplier" :is-invalid="v$.supplier.$error">Supplier</FormLabel>
              <div class="mt-2">
                <FormSelect
                  id="supplier"
                  v-model="models.supplier"
                  :is-invalid="v$.supplier.$error"
                >
                  <option value="" disabled>Select Supplier</option>
                  <option v-for="supplier in suppliers" :key="supplier" :value="supplier.id">
                    {{ supplier.name }}
                  </option>
                </FormSelect>
                <FormValidation v-if="v$.supplier.$error"> Supplier is required. </FormValidation>
              </div>
            </div>
            <div class="col-span-full">
              <FormLabel label-id="supplier" :is-invalid="v$.description.$error">
                Product description
              </FormLabel>
              <div class="mt-2">
                <Editor
                  v-model="models.description"
                  api-key="h150xfdpyl6rtt2kexadd3wh4rlahxzbt1gzv3qnhpku52hu"
                  :init="{
                    skin: 'bootstrap',
                    menubar: false,
                    plugins:
                      'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar:
                      'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                    height: '500'
                  }"
                />
              </div>
              <FormValidation v-if="v$.description.$error">
                Product description is required.
              </FormValidation>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
      <div class="px-4 sm:px-0">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Product Price & Shipping</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
          Transparent pricing, shipping fees, and delivery information.
        </p>
      </div>
      <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
        <div class="px-4 py-6 sm:p-8">
          <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <FormLabel label-id="product-price" :is-invalid="v$.originalPrice.$error">
                Original Price
              </FormLabel>
              <div class="mt-2">
                <FormInput
                  id="product-price"
                  v-model="models.originalPrice"
                  type="number"
                  placeholder="Enter original price"
                  :is-invalid="v$.originalPrice.$error"
                />
              </div>
              <FormValidation v-if="v$.originalPrice.$error">
                Original price is required.
              </FormValidation>
            </div>
            <div class="sm:col-span-3">
              <FormLabel label-id="product-discount">Discount Price</FormLabel>
              <div class="mt-2">
                <FormInput
                  id="product-discount"
                  v-model="models.discountPrice"
                  type="number"
                  placeholder="Enter discount price(optional)"
                />
              </div>
            </div>
            <div class="col-span-full">
              <fieldset>
                <legend class="text-sm font-semibold leading-6 text-gray-900">
                  Shipping Service
                </legend>
                <p class="mt-1 text-sm leading-6 text-gray-600">
                  Configure shipping services according to your product type.
                </p>
                <div class="mt-6 space-y-6">
                  <div>
                    <FormLabel label-id="standard-shipping">Standard</FormLabel>
                    <div class="mt-2">
                      <FormInput
                        id="standard-shipping"
                        v-model="models.standardShipping"
                        type="number"
                        placeholder="Enter standard shipping price"
                        :is-invalid="v$.standardShipping.$error"
                      />
                    </div>
                    <FormValidation v-if="v$.standardShipping.$error">
                      Standard shipping is required.
                    </FormValidation>
                  </div>
                  <div>
                    <FormLabel label-id="express-shipping">Express</FormLabel>
                    <div class="mt-2">
                      <FormInput
                        id="express-shipping"
                        v-model="models.expressShipping"
                        type="number"
                        placeholder="Enter express shipping price"
                        :is-invalid="v$.expressShipping.$error"
                      />
                    </div>
                    <FormValidation v-if="v$.expressShipping.$error">
                      Express shipping is required.
                    </FormValidation>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
      <div class="px-4 sm:px-0">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Product Variant</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
          Explore different options and variations of the product.
        </p>
      </div>
      <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
        <div class="px-4 py-6 sm:p-8">
          <div
            class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
            :class="{ 'pointer-events-none opacity-60': models.enableVariation == 1 }"
          >
            <div class="sm:col-span-3">
              <FormLabel label-id="product-stock" :is-invalid="v$.stock.$error">
                Product Stock
              </FormLabel>
              <div class="mt-2">
                <FormInput
                  id="product-stock"
                  v-model="models.stock"
                  type="number"
                  placeholder="Enter product stock"
                  :is-invalid="v$.stock.$error"
                />
              </div>
              <FormValidation v-if="v$.stock.$error"> Product stock is required </FormValidation>
            </div>
            <div class="sm:col-span-3">
              <FormLabel label-id="sku" :is-invalid="v$.sku.$error">
                SKU (Stock Keeping Unit)
              </FormLabel>
              <div class="mt-2">
                <FormInput
                  id="sku"
                  v-model="models.sku"
                  placeholder="Enter SKU"
                  :is-invalid="v$.sku.$error"
                />
              </div>
              <FormValidation v-if="v$.sku.$error"> SKU is required </FormValidation>
            </div>
          </div>
          <div class="col-span-full my-6">
            <FormSwitch
              v-model="models.enableVariation"
              label="Add Variation"
              @change="toggleVariation"
            />
          </div>
          <div
            v-for="(variation, i) in models.variation"
            :key="i"
            class="mb-6 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 border-b border-b-slate-200 pb-6 sm:grid-cols-6"
            :class="{ 'pointer-events-none opacity-60': models.enableVariation == 0 }"
          >
            <div class="sm:col-span-3">
              <FormLabel
                :label-id="'product-size-' + i"
                :is-invalid="v$.variation.$each.$response.$data[i].size.$error"
              >
                Product Size
              </FormLabel>
              <div class="mt-2">
                <FormInput
                  :id="'product-size-' + i"
                  v-model="variation.size"
                  placeholder="Enter product size"
                  :is-invalid="v$.variation.$each.$response.$data[i].size.$error"
                />
              </div>
              <FormValidation v-if="v$.variation.$each.$response.$data[i].size.$error">
                Product Size is required.
              </FormValidation>
            </div>
            <div class="sm:col-span-3">
              <FormLabel
                :label-id="'product-color-' + i"
                :is-invalid="v$.variation.$each.$response.$data[i].color.$error"
              >
                Product Color
              </FormLabel>
              <div class="mt-2">
                <FormInput
                  :id="'product-color-' + i"
                  v-model="variation.color"
                  placeholder="Enter product color"
                  :is-invalid="v$.variation.$each.$response.$data[i].color.$error"
                />
              </div>
              <FormValidation v-if="v$.variation.$each.$response.$data[i].color.$error">
                Product Color is required.
              </FormValidation>
            </div>
            <div class="sm:col-span-3">
              <FormLabel
                :label-id="'product-stock-' + i"
                :is-invalid="v$.variation.$each.$response.$data[i].stock.$error"
              >
                Product Stock
              </FormLabel>
              <div class="mt-2">
                <FormInput
                  :id="'product-stock-' + i"
                  v-model="variation.stock"
                  type="number"
                  placeholder="Enter product stock"
                  :is-invalid="v$.variation.$each.$response.$data[i].stock.$error"
                />
              </div>
              <FormValidation v-if="v$.variation.$each.$response.$data[i].stock.$error">
                Product Stock is required.
              </FormValidation>
            </div>
            <div class="sm:col-span-3">
              <FormLabel
                :label-id="'sku-' + i"
                :is-invalid="v$.variation.$each.$response.$data[i].sku.$error"
              >
                SKU (Stock Keeping Unit)
              </FormLabel>
              <div class="mt-2">
                <FormInput
                  :id="'sku-' + i"
                  v-model="variation.sku"
                  placeholder="Enter SKU"
                  :is-invalid="v$.variation.$each.$response.$data[i].sku.$error"
                />
              </div>
              <FormValidation v-if="v$.variation.$each.$response.$data[i].sku.$error">
                SKU is required.
              </FormValidation>
            </div>
          </div>
          <div :class="{ 'pointer-events-none opacity-60': models.enableVariation == 0 }">
            <BaseButton mode="primary" @click="addMoreVariation">Add more</BaseButton>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="mt-6 flex items-center justify-end gap-x-6">
    <BaseButton link="/products" is-link size="xl" :disabled="isLoading">Cancel</BaseButton>
    <BaseButton mode="primary" size="xl" :disabled="isLoading" @click.prevent="addProduct">
      <Icon v-if="isLoading" icon="gg:spinner" class="animate-spin text-base" />
      {{ isLoading ? 'Saving...' : 'Save' }}
    </BaseButton>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useCategoryStore } from '@/store/products/category'
import { useSupplierStore } from '@/store/supplier/supplier'
import { useProductStore } from '@/store/products/product'
import { useVuelidate } from '@vuelidate/core'
import { required, requiredIf, helpers } from '@vuelidate/validators'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import Editor from '@tinymce/tinymce-vue'

import BaseButton from '@/components/UI/button/BaseButton.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormUpload from '@/components/UI/forms/FormUpload.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormSwitch from '@/components/UI/forms/FormSwitch.vue'
import FormSelect from '@/components/UI/forms/FormSelect.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'

const router = useRouter()
const categoryStore = useCategoryStore()
const supplierStore = useSupplierStore()
const productStore = useProductStore()
const categories = ref([])
const suppliers = ref([])
const models = reactive({
  highlightImage: '',
  images: [],
  isFeatured: 0,
  isActive: 0,
  name: '',
  slug: '',
  category: '',
  supplier: '',
  description: '',
  originalPrice: '',
  discountPrice: '',
  standardShipping: '',
  expressShipping: '',
  stock: '',
  sku: '',
  variation: [
    {
      size: '',
      color: '',
      stock: '',
      sku: ''
    }
  ],
  enableVariation: 0
})
const isLoading = ref(false)

const rules = computed(() => {
  return {
    highlightImage: { required },
    name: { required },
    category: { required },
    supplier: { required },
    description: { required },
    originalPrice: { required },
    standardShipping: { required },
    expressShipping: { required },
    stock: { required: requiredIf(() => models.enableVariation == 0) },
    sku: { required: requiredIf(() => models.enableVariation == 0) },
    variation: {
      $each: helpers.forEach({
        size: { required: requiredIf(() => models.enableVariation == 1) },
        color: { required: requiredIf(() => models.enableVariation == 1) },
        stock: { required: requiredIf(() => models.enableVariation == 1) },
        sku: { required: requiredIf(() => models.enableVariation == 1) }
      })
    }
  }
})
const v$ = useVuelidate(rules, models)

const formData = computed(() => {
  let file = new FormData()
  file.append('file', models.highlight_image)
  file.append('file', models.images)

  return {
    highlight_image: models.highlightImage,
    images: models.images,
    is_featured: models.isFeatured,
    is_active: models.isActive,
    name: models.name,
    slug: models.slug,
    category_id: models.category,
    supplier_id: models.supplier,
    description: models.description,
    orig_price: models.originalPrice,
    discounted_price: models.discountPrice,
    standard_shipping_price: models.standardShipping,
    express_shipping_price: models.expressShipping,
    stocks: models.enableVariation == 0 ? models.stock : null,
    sku: models.enableVariation == 0 ? models.sku : null,
    variations: models.enableVariation == 1 ? models.variation : null
  }
})

onMounted(async () => {
  await getCategories()
  await getSuppliers()
})

async function getCategories() {
  try {
    await categoryStore.getCategories()
    categories.value = categoryStore.categories
  } catch ({ message }) {
    toast(message, {
      type: 'error',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_RIGHT,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}

async function getSuppliers() {
  try {
    await supplierStore.getSuppliers()
    suppliers.value = supplierStore.suppliers
  } catch ({ message }) {
    toast(message, {
      type: 'error',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_RIGHT,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}

function handleHighlightImage(fileItems) {
  const file = fileItems.map((fileItem) => fileItem.file)
  models.highlightImage = file[0]
}

function handleImages(fileItems) {
  const files = fileItems.map((fileItem) => fileItem.file)
  models.images = files.map((file) => file)
}

function toggleVariation() {
  if (models.enableVariation == 0) {
    models.variation = [
      {
        size: '',
        color: '',
        stock: '',
        sku: ''
      }
    ]
  } else {
    models.stock = ''
    models.sku = ''
  }
}

function addMoreVariation() {
  models.variation.push({
    size: '',
    color: '',
    stock: '',
    sku: ''
  })
}

async function addProduct() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    isLoading.value = true
    await productStore.addProduct(formData.value)
    router.push('/products')
    isLoading.value = false
  } catch ({ message }) {
    isLoading.value = false
    toast(message, {
      type: 'error',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_RIGHT,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
  }
}
</script>
