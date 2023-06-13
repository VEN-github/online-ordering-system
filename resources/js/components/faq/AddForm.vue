<template>
  <FormModal title="Add Q&A" :is-show="isShow" @on-submit="addFaq">
    <Transition name="fade">
      <BaseAlert v-if="isError" mode="error" class="mb-5">{{ errorMessage }}</BaseAlert>
    </Transition>
    <div>
      <FormLabel label-id="question" :is-invalid="v$.question.$error">Question</FormLabel>
      <div class="mt-2">
        <FormInput
          id="question"
          v-model="models.question"
          placeholder="Enter question"
          :is-invalid="v$.question.$error"
        />
      </div>
      <FormValidation v-if="v$.question.$error"> Question is required. </FormValidation>
    </div>
    <div class="mt-5">
      <FormLabel label-id="slug" :is-invalid="v$.slug.$error">Slug</FormLabel>
      <div class="mt-2">
        <FormInput
          id="slug"
          v-model="models.slug"
          placeholder="Enter slug"
          :is-invalid="v$.slug.$error"
        />
        <FormValidation v-if="v$.slug.$error"> Slug is required. </FormValidation>
      </div>
    </div>
    <div class="mt-5">
      <FormLabel label-id="answer" :is-invalid="v$.answer.$error">Answer</FormLabel>
      <div class="mt-2">
        <FormInput
          id="answer"
          v-model="models.answer"
          placeholder="Enter answer"
          :is-invalid="v$.answer.$error"
        />
      </div>
      <FormValidation v-if="v$.answer.$error"> Answer is required. </FormValidation>
    </div>
    <div class="mt-5">
      <FormSwitch v-model="models.active" label="Show on homepage" />
    </div>
    <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:justify-end">
      <BaseButton
        mode="outline-default"
        size="lg"
        class="order-2 w-full sm:order-1 sm:w-auto"
        :disabled="isLoading"
        @click="emit('onClose')"
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
import { useFAQStore } from '@/store/faq/faq'
import { useVuelidate } from '@vuelidate/core'
import { required } from '@vuelidate/validators'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

import FormModal from '@/components/UI/modal/FormModal.vue'
import FormLabel from '@/components/UI/forms/FormLabel.vue'
import FormInput from '@/components/UI/forms/FormInput.vue'
import FormSwitch from '@/components/UI/forms/FormSwitch.vue'
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

const faqStore = useFAQStore()
const models = reactive({
  question: '',
  slug: '',
  answer: '',
  active: 0
})
const isLoading = ref(false)
const isError = ref(false)
const errorMessage = ref('')
let timeout

const rules = computed(() => {
  return {
    question: { required },
    slug: { required },
    answer: { required }
  }
})

const v$ = useVuelidate(rules, models)

async function addFaq() {
  const isFormCorrect = await v$.value.$validate()

  if (!isFormCorrect) return

  try {
    clearTimeout(timeout)
    isLoading.value = true
    isError.value = false
    await faqStore.addFAQ(models)
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
  models.question = ''
  models.slug = ''
  models.answer = ''
  models.active = 0
}
</script>
