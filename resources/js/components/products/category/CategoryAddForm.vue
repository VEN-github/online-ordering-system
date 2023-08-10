<template>
  <FormModal title="Add Category" :is-show="isShow" @on-submit="addCategory">
    <Transition name="fade">
      <BaseAlert v-if="isError" mode="error" class="mb-5">{{ errorMessage }}</BaseAlert>
    </Transition>
    <div>
      <FormLabel label-id="category-name" :is-invalid="v$.name.$error">Name</FormLabel>
      <div class="mt-2">
        <FormInput
          id="category-name"
          v-model="models.name"
          placeholder="Enter category name"
          :is-invalid="v$.name.$error"
        />
      </div>
      <FormValidation v-if="v$.name.$error"> Name is required. </FormValidation>
    </div>
    <div class="mt-5">
      <FormLabel label-id="category-slug">Slug</FormLabel>
      <div class="mt-2">
        <FormInput id="category-slug" v-model="models.slug" placeholder="Enter slug (optional)" />
      </div>
    </div>
    <div class="mt-5">
      <FormLabel label-id="category-image">Image</FormLabel>
      <div class="mt-2">
        <FormUpload @on-upload="handleImage" @on-remove="handleRemoveImage" />
      </div>
    </div>
    <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:justify-end">
      <BaseButton
        mode="outline-default"
        size="lg"
        class="order-2 w-full sm:order-1 sm:w-auto"
        :disabled="isLoading"
        @click="onClose"
      >
        Cancel
      </BaseButton>
      <BaseButton
        type="submit"
        mode="primary"
        size="lg"
        class="order-1 w-full sm:order-2 sm:w-auto"
        :disabled="isLoading"
      >
        <Icon v-if="isLoading" icon="gg:spinner" class="animate-spin text-base" />
        {{ isLoading ? 'Loading...' : `Submit` }}
      </BaseButton>
    </div>
  </FormModal>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { useCategoryStore } from '@/store/products/category'
import { useVuelidate } from '@vuelidate/core'
import { required } from '@vuelidate/validators'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import FormModal from '@/components/UI/modal/FormModal.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormUpload from '@/components/UI/forms/FormUpload.vue'
import FormValidation from '@/components/UI/forms/FormValidation.vue'
import BaseButton from '@/components/UI/button/BaseButton.vue'
import BaseAlert from '@/components/UI/alert/BaseAlert.vue'

defineProps({
  isShow: {
    type: Boolean,
    default() {
      return false
    }
  }
})
const emit = defineEmits(['onClose', 'onSuccess'])

const categoryStore = useCategoryStore()
const models = reactive({
  name: '',
  slug: '',
  image: ''
})
const isLoading = ref(false)
const isError = ref(false)
const errorMessage = ref('')
let timeout

const rules = computed(() => {
  return {
    name: { required }
  }
})

const v$ = useVuelidate(rules, models)

function handleImage(file) {
  models.image = file
}

function handleRemoveImage() {
  models.image = ''
}

async function addCategory() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  let file = new FormData()
  file.append('file', models.image)

  try {
    clearTimeout(timeout)
    isLoading.value = true
    isError.value = false
    await categoryStore.addCategory(models)
    isLoading.value = false
    resetForm()
    toast('Successfully Added', {
      type: 'success',
      theme: 'colored',
      hideProgressBar: true,
      multiple: false,
      transition: toast.TRANSITIONS.SLIDE,
      position: toast.POSITION.TOP_CENTER,
      pauseOnHover: false,
      pauseOnFocusLoss: false
    })
    emit('onSuccess')
  } catch ({ message }) {
    isLoading.value = false
    isError.value = true
    errorMessage.value = message
    clearErrorMessage()
  }
}

function clearErrorMessage() {
  timeout = setTimeout(() => {
    isError.value = false
    errorMessage.value = ''
  }, 5000)
}

function resetForm() {
  v$.value.$reset()
  models.name = ''
  models.slug = ''
}

function onClose() {
  resetForm()
  emit('onClose')
}
</script>
