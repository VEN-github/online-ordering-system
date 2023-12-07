<template>
  <FilePond
    :files="files"
    accepted-file-types="image/jpeg, image/png"
    :allow-multiple="allowMultiple"
    :max-files="maxFiles"
    max-file-size="200000"
    :class="{ 'filepond--single': !allowMultiple }"
    @addfile="handleFilePondAddFile"
    @removefile="handleFilePondRemoveFile"
  />
</template>

<script setup>
import vueFilePond from 'vue-filepond'
import 'filepond/dist/filepond.min.css'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size'

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
const emit = defineEmits(['onUpload', 'onRemove'])

const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview,
  FilePondPluginFileValidateSize
)

function handleFilePondAddFile(error, file) {
  if (error) {
    console.log('FilePond error: ', error)
    return
  }

  emit('onUpload', file.file)
}

function handleFilePondRemoveFile(error, file) {
  if (error) {
    console.log('FilePond error: ', error)
    return
  }

  emit('onRemove', file.file)
}
</script>
