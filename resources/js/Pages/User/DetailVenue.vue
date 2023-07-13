<template>
  <App>
    <div class="mt-4 pb-20">
      <div class="font-bold text-xl">{{ venue.name }}</div>
      <img :src="'/storage/cover-images/' + venue.image" alt="venue-img"
        class="mt-4 object-cover h-[25rem] w-full rounded-md" />
      <!-- Detail And order -->
      <div class="grid grid-cols-6 gap-8 mt-4">
        <!-- Detail -->
        <div class="col-span-4">
          <button class="flex bg-blue-200 py-2 px-4 rounded-full text-blue-700">
            About
          </button>
          <div class="mt-3 h-0.5 bg-neutral-50"></div>
          <!-- Address -->
          <div class="bg-neutral-50 mt-4 p-2 rounded-md flex gap-3 items-center">
            <font-awesome-icon icon="location-dot" class="h-6 text-blue-400" />
            <div>
              {{ venue.address }}
            </div>
          </div>
          <!-- About -->
          <div class="mt-4">
            <div class="text-xl font-medium">About Event Venue</div>
            <div class="flex gap-8 mt-6">
              <div class="flex flex-col items-center gap-1 p-4 rounded-lg">
                <font-awesome-icon icon="person" class="h-8 text-neutral-200"></font-awesome-icon>
                <div class="font-semibold text-lg">
                  Standing
                </div>
                <div class="text-sm text-neutral-300">
                  Up to 200
                </div>
              </div>
              <div class="flex flex-col items-center gap-1 p-4 rounded-lg">
                <font-awesome-icon icon="utensils" class="h-8 text-neutral-200"></font-awesome-icon>
                <div class="font-semibold text-lg">Cuisine</div>
                <div class="text-sm text-neutral-300">
                  Available
                </div>
              </div>
              <div class="flex flex-col items-center gap-1 p-4 rounded-lg">
                <font-awesome-icon icon="chair" class="h-8 text-neutral-200"></font-awesome-icon>
                <div class="font-semibold text-lg">Seated</div>
                <div class="text-sm text-neutral-300">
                  No set up
                </div>
              </div>
              <div class="flex flex-col items-center gap-1 p-4 rounded-lg">
                <font-awesome-icon icon="bowl-food" class="h-8 text-neutral-200"></font-awesome-icon>
                <div class="font-semibold text-lg">
                  External Catering
                </div>
                <div class="text-sm text-neutral-300">
                  Not Allowed
                </div>
              </div>
            </div>
            <div class="mt-6">
              {{ venue.description }}
            </div>
          </div>
        </div>
        <!-- Order -->
        <div class="mt-8 col-span-2 border p-4 border-blue-100 rounded-lg h-min">
          <div class="flex items-center gap-2">
            <font-awesome-icon icon="briefcase" class="text-neutral-200 h-5"></font-awesome-icon>
            <div class="font-bold text-xl">Order Now</div>
          </div>
          <!-- Forms -->
          <form class="mt-4" @submit.prevent="submit">
            <div class="w-full mb-4">
              <input type="date" v-model="form.order_date" class="border-neutral-100 w-full rounded-lg"
                placeholder="24-09-2023" />
              <div v-if="form.errors.order_date" class="text-red-500 my-2">
                {{ form.errors.order_date }}
              </div>
            </div>
            <div class="w-full mb-4">
              <select v-model="form.start_time" class="border-neutral-100 w-full rounded-lg">
                <option value="" disabled selected>
                  Start Time
                </option>
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="08:00">11:00</option>
                <option value="08:00">12:00</option>
                <option value="08:00">13:00</option>
                <option value="08:00">14:00</option>
                <option value="08:00">15:00</option>
                <option value="08:00">16:00</option>
                <option value="08:00">17:00</option>
                <option value="08:00">18:00</option>
              </select>
              <div v-if="form.errors.start_time" class="text-red-500 my-2">
                {{ form.errors.start_time }}
              </div>
            </div>
            <div class="w-full mb-4">
              <input type="number" v-model="form.total_guest" class="border-neutral-100 w-full rounded-lg"
                placeholder="Guest" />
              <div v-if="form.errors.total_guest" class="text-red-500 my-2">
                {{ form.errors.total_guest }}
              </div>
            </div>
            <div class="w-full mb-4 flex flex-col gap-2 ">
              <div>
                {{ newPrice }} / Day
              </div>
              <div>
                DP 20% {{ countDp }}
              </div>

            </div>

            <button type="submit" class="bg-blue-500 py-2 px-4 rounded-lg text-white text-lg hover:bg-blue-600">
              <font-awesome-icon icon="paper-plane"></font-awesome-icon>
              Order Now
            </button>
          </form>
        </div>
      </div>
    </div>
  </App>
</template>

<script setup>
import App from "../../Layout/App.vue";
import venueImg from "../../Assets/images/venue.jpg";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faLocationDot,
  faPerson,
  faUtensils,
  faChair,
  faBowlFood,
  faBriefcase,
  faPaperPlane,
} from "@fortawesome/free-solid-svg-icons";
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import { confirmDelete } from "../../Components/ConfirmDialog.vue";
library.add([
  faLocationDot,
  faPerson,
  faUtensils,
  faChair,
  faBowlFood,
  faBriefcase,
  faPaperPlane,
]);
const props = defineProps({ venue: Object })
const page = usePage().props


// let DpClearDots = props.venue.price.replace(/\./g, '')
const newPrice = formatToRupiah(parseInt(props.venue.price))
const countDp = ref(formatToRupiah(parseInt(props.venue.price / 100 * 20)))


function formatToRupiah(amount) {
  return amount.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
}

const form = useForm({
  user_id: page.user ? page.user.id : null,
  order_date: null,
  start_time: '',
  total_guest: null
});





function submit() {
  if(!page.user){
    alert('Anda Belum Login')
    return router.visit('/login')
  }
  confirmDelete({
    title: 'Create Order',
    text: "Apa anda yakin untuk membuat pesanan?",
    then: (result) => {
      if (result.isConfirmed) {
        form.post(`/${props.venue.slug}/order`, {
          onSuccess: () => {
            alert('Success Create Order')
          },
        });
      }
    },
  });
}

</script>
