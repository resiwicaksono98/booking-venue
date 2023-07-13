<template>
  <App>
    <div class="mt-4 text-xl font-sans font-semibold antialiased ">
      Booking Venue Di Dunia Fantasi (Dufan) Ancol
    </div>
    <div class="my-6">
      <div class="grid  sm:grid-cols-2 xl:grid-cols-3 gap-4">
        <!-- Cards -->
        <Link v-for="(venue, i) in venues" :href="'/' +  venue.slug + '/detail'"
          class="shadow-lg contrast-75 text-neutral-300 rounded-lg hover:shadow-2xl hover:contrast-100 hover:text-neutral-500 cursor-pointer"
          :key="i">
        <!-- Image Card -->
          <img :src="'/storage/cover-images/' + venue.image" alt="venue-img" class="rounded-lg h-[200px] w-full object-fill" />

        <!-- Detail Card -->
        <div class="px-4">
          <div class="flex my-4 items-center gap-2">
            <font-awesome-icon icon="building-user" />
            <div>{{ venue.name }}</div>
          </div>
          <div class="flex my-4 items-center gap-2">
            <font-awesome-icon icon="users" />
            <div>0-{{ venue.max_capacity }}</div>
          </div>
          <div class="flex my-4 items-center gap-2">
            <font-awesome-icon icon="rupiah-sign" />
            <div>Starts From <span class="font-bold">{{ formatToRupiah(parseInt(venue.price )) }}</span></div>
          </div>
        </div>
        </Link>

      </div>
    </div>
  </App>
</template>

<script setup>
import App from "../../Layout/App.vue";
import venueImg from "../../Assets/images/venue.jpg";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faBuildingUser, faUsers, faRupiahSign } from "@fortawesome/free-solid-svg-icons";
import { Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
library.add([faBuildingUser, faUsers, faRupiahSign]);
const props = defineProps({ venues: Object })


function formatToRupiah(amount) {
  return amount.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
}

</script>

<style>
</style>
