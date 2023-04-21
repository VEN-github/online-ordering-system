<template>
  <h1 class="text-3xl font-semibold leading-tight tracking-tight text-gray-700">Supplier</h1>
  <div class="mt-10">
    <TheTable search sort pagination>
      <thead>
        <tr>
          <th>Hello</th>
          <th>Hello</th>
          <th>Hello</th>
          <th>Hello</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>sdadsa</td>
          <td>sdadsa</td>
          <td>sdadsa</td>
          <td><button type="button">Edit</button></td>
        </tr>
      </tbody>
    </TheTable>
  </div>
</template>

<script setup>
import TheTable from '@/components/UI/table/TheTable.vue'
</script>
