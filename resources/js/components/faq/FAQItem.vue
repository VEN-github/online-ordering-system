<template>
  <div class="pt-6">
    <dt>
      <button
        type="button"
        class="flex w-full items-start justify-between text-left text-gray-900"
        aria-controls="faq-0"
        aria-expanded="false"
        @click="toggleAnswer"
      >
        <span class="text-base font-semibold leading-7">
          {{ faq.question }}
        </span>
        <span class="ml-6 flex h-7 items-center">
          <Icon v-if="!showAnswer" icon="ic:round-plus" class="h-6 w-6" />
          <Icon v-else icon="ic:round-minus" class="h-6 w-6" />
        </span>
      </button>
    </dt>
    <dd id="faq-0" class="mt-2 pr-12" :class="{ hidden: !showAnswer }">
      <p class="text-base leading-7 text-gray-600">
        {{ faq.answer }}
      </p>
    </dd>
  </div>
</template>

<script setup>
import { ref } from 'vue'

defineProps({
  faq: {
    type: Object,
    default() {
      return {}
    }
  }
})

const showAnswer = ref(false)

function toggleAnswer() {
  showAnswer.value = !showAnswer.value
}
</script>
