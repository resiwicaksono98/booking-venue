<template>
  <AppAdmin>
    <div class="text-xl font-semibold ">Detail Venue {{ venue.name }}</div>
    <div class="flex justify-center my-6">
      <img :src="'/storage/cover-images/'+ venue.image" alt="cover" >
    </div>
    <div class="grid grid-cols-2 text-lg gap-4 mb-4">
      <div>Name</div>
      <div class="font-semibold">: {{ venue.name }}</div>
    </div>
    <div class="grid grid-cols-2 text-lg gap-4 mb-4">
      <div>Address</div>
      <div class="font-semibold">: {{ venue.address }}</div>
    </div>
    <div class="grid grid-cols-2 text-lg gap-4 mb-4">
      <div>Description</div>
      <div class="font-semibold">: {{ venue.description }}</div>
    </div>
    <div class="grid grid-cols-2 text-lg gap-4 mb-4">
      <div>Price</div>
      <div class="font-semibold">: Rp.{{ venue.price }}</div>
    </div>
    <div class="grid grid-cols-2 text-lg gap-4 mb-4">
      <div>Max Capacity</div>
      <div class="font-semibold">: {{ venue.max_capacity }}</div>
    </div>
    <Link href="/admin/venue" class="underline mt-8 text-lg">Back</Link>
  </AppAdmin>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import AppAdmin from "../../../Layout/AppAdmin.vue";
const props = defineProps({venue:Object})
console.log(props.venue.image);
</script>
