<template>

  <AppAdmin>
    <div class="text-2xl font-semibold mb-8">Dashboard</div>
    <div class="grid grid-cols-3 gap-3">
      <div class="bg-blue-100 rounded-lg p-4">
        <div class="text-xl font-semibold mb-2">List Venue</div>
        <div class="text-4xl font-medium ">100</div>
      </div>
      <div class="bg-blue-100 rounded-lg p-4">
        <div class="text-xl font-semibold mb-2">List Transaction</div>
        <div class="text-4xl font-medium ">40</div>
      </div>
      <div class="bg-blue-100 rounded-lg p-4">
        <div class="text-xl font-semibold mb-2">Booking List</div>
        <div class="text-4xl font-medium ">20</div>
      </div>
    </div>
  </AppAdmin>

</template>

<script setup>
import AppAdmin from '../../Layout/AppAdmin.vue';

</script>
