<template>
  <FormModal title="Add Inventory" :is-show="isShow" @on-submit="addInventory">
    <div>
      <FormLabel label-id="product" :is-invalid="v$.product_id.$error">Product</FormLabel>
      <div class="mt-2">
        <FormSelect id="product" v-model="models.product_id" :is-invalid="v$.product_id.$error">
          <option value="" disabled selected>Select Product</option>
          <option v-for="product in products" :key="product.id" :value="product.id">
            {{ product.name }}
          </option>
        </FormSelect>
      </div>
      <FormValidation v-if="v$.product_id.$error"> Product is required. </FormValidation>
    </div>
    <div v-if="hasVariation" class="mt-5">
      <FormLabel label-id="variation" :is-invalid="v$.variation_id.$error">Size & Color</FormLabel>
      <div class="mt-2">
        <FormSelect
          id="variation"
          v-model="models.variation_id"
          :is-invalid="v$.variation_id.$error"
        >
          <option value="" disabled selected>Select Size & Color</option>
          <option v-for="variation in variations" :key="variation.id" :value="variation.id">
            {{ variation.size }} - {{ variation.color }}
          </option>
        </FormSelect>
      </div>
      <FormValidation v-if="v$.variation_id.$error"> Variation is required. </FormValidation>
    </div>
    <div class="mt-5">
      <FormLabel label-id="stock" :is-invalid="v$.added_stock.$error">Stock</FormLabel>
      <div class="mt-2">
        <FormInput
          id="stock"
          v-model="models.added_stock"
          type="number"
          min="1"
          placeholder="Enter stock"
          :is-invalid="v$.added_stock.$error"
        />
      </div>
      <FormValidation v-if="v$.added_stock.$error"> Stock is required. </FormValidation>
    </div>
    <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:justify-end">
      <BaseButton
        mode="outline-default"
        size="lg"
        class="order-2 w-full sm:order-1 sm:w-auto"
        @click="onClose"
      >
        Cancel
      </BaseButton>
      <BaseButton
        type="submit"
        mode="primary"
        size="lg"
        class="order-1 w-full sm:order-2 sm:w-auto"
      >
        Submit
      </BaseButton>
    </div>
  </FormModal>
</template>

<script setup>
import { reactive, computed, watch } from 'vue'
import { useVuelidate } from '@vuelidate/core'
import { required, requiredIf } from '@vuelidate/validators'

import FormModal from '@/components/UI/modal/FormModal.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormSelect from '@/components/UI/forms/FormSelect.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'

const props = defineProps({
  isShow: {
    type: Boolean,
    default() {
      return false
    }
  },
  products: {
    type: Array,
    default() {
      return []
    }
  }
})
const emit = defineEmits(['onClose', 'submitForm'])

const models = reactive({
  product_id: '',
  variation_id: '',
  added_stock: ''
})

const hasVariation = computed(() => {
  if (!props.products.length || models.product_id == '') return false

  const product = props.products.find((product) => product.id == models.product_id)

  return product.has_variations
})

const variations = computed(() => {
  if (!props.products.length || models.product_id == '') return []

  const product = props.products.find((product) => product.id == models.product_id)

  return product.variations
})

const rules = computed(() => {
  return {
    product_id: { required },
    variation_id: { required: requiredIf(() => hasVariation.value) },
    added_stock: { required }
  }
})

const v$ = useVuelidate(rules, models)

watch(
  () => models.product_id,
  () => {
    models.variation_id = ''
  }
)

watch(
  () => props.isShow,
  (value) => {
    if (value) {
      resetForm()
      return
    }
  },
  { immediate: true }
)

async function addInventory() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  emit('submitForm', models)
}

function resetForm() {
  v$.value.$reset()
  models.product_id = ''
  models.variation_id = ''
  models.added_stock = ''
}

function onClose() {
  resetForm()
  emit('onClose')
}
</script>
