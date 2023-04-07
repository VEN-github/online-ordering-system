<template>
  <div v-if="!hideHomeNavbar">
    <RouterLink to="/">Home</RouterLink>
    <RouterLink to="/about">About</RouterLink>
  </div>
  <RouterView />
</template>

<script setup>
import { RouterLink, RouterView, useRoute } from 'vue-router'
import { computed } from 'vue'

const route = useRoute()

const hideHomeNavbar = computed(() => {
  return route.meta.hideHomeNavbar
})
</script>
