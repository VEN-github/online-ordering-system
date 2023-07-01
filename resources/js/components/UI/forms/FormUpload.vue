<template>
  <FilePond
    :files="files"
    accepted-file-types="image/jpeg, image/png"
    :allow-multiple="allowMultiple"
    :max-files="maxFiles"
    :class="{ 'filepond--single': !allowMultiple }"
    @updatefiles="emit('onUpload', $event)"
  />
</template>

<script setup>
import vueFilePond from 'vue-filepond'
import 'filepond/dist/filepond.min.css'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'

defineProps({
  files: {
    type: [String, Array],
    default() {
      return null
    }
  },
  allowMultiple: {
    type: Boolean,
    default() {
      return false
    }
  },
  maxFiles: {
    type: String,
    default() {
      return '1'
    }
  }
})
const emit = defineEmits(['onUpload'])

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview)
</script>
