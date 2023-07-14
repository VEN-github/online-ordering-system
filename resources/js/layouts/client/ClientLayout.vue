<template>
  <TheHeader />
  <RouterView />
  <TheFooter />
</template>

<script setup>
import { RouterView } from 'vue-router'

import TheHeader from './TheHeader.vue'
import TheFooter from './TheFooter.vue'
</script>
