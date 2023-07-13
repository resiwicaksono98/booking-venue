<template>
  <AppAdmin>
    <div class="text-2xl font-semibold">Create Transaction</div>
    <form class="my-8" @submit.prevent="submit">
       <!-- Venue -->
       <div class="mb-4 flex flex-col gap-2">
        <label for="venue_id">Venue</label>
        <select v-model="form.venue_id" class=" rounded-lg border-slate-200 ">
          <option value="" disabled>Select Venue</option>
          <option v-for="(venue,i) in venues" :value="venue.id" :key="i">{{ venue.name }}</option>
        </select>
        <div v-if="form.errors.user_id" class="text-red-500 my-2">
          {{ form.errors.user_id }}
        </div>
      </div>
      <!-- User -->
      <div class="mb-4 flex flex-col gap-2">
        <label for="user_id">User</label>
        <select v-model="form.user_id" class=" rounded-lg border-slate-200 ">
          <option value="" disabled>Select User</option>
          <option v-for="(user,i) in users" :value="user.id" :key="i">{{ user.name }}</option>
        </select>
        <div v-if="form.errors.user_id" class="text-red-500 my-2">
          {{ form.errors.user_id }}
        </div>
      </div>
      <!-- Order Date -->
      <div class="mb-4 flex flex-col gap-2">
        <label for="order_date">Order Date</label>
        <input type="date" v-model="form.order_date" class="border-slate-200 w-full rounded-lg" placeholder="24-09-2023" />
        <div v-if="form.errors.order_date" class="text-red-500 my-2">
          {{ form.errors.order_date }}
        </div>
      </div>
      <!-- Start Time -->
      <div class="mb-4 flex flex-col gap-2">
        <label for="start_time">Start Time</label>
        <select v-model="form.start_time"  id="" class="border-neutral-100 w-full rounded-lg">
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
      <!-- Total Guest -->
      <div class="mb-4 flex flex-col gap-2">
        <label for="total_guest">Total Guest</label>
        <input type="number" v-model="form.total_guest" class="border-neutral-100 w-full rounded-lg" placeholder="Guest" />
        <div v-if="form.errors.total_guest" class="text-red-500 my-2">
          {{ form.errors.total_guest }}
        </div>
      </div>
      <!-- Payment Status -->
      <div class="mb-4 flex flex-col gap-2">
        <label for="payment_status">Payment Status</label>
        <select v-model="form.payment_status" class=" rounded-lg border-slate-200 ">
          <option value="" selected disabled>Select Payment</option>
          <option value="unpaid">Unpaid</option>
          <option value="on_proccess">On Proccess</option>
          <option value="paid">Paid</option>
        </select>
        <div v-if="form.errors.payment_status" class="text-red-500 my-2">
          {{ form.errors.payment_status }}
        </div>
      </div>
      <!-- Button -->
      <button type="submit" class="bg-blue-500 py-2 px-4 rounded-lg text-white">Create Order</button>
    </form>
  </AppAdmin>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AppAdmin from '../../../Layout/AppAdmin.vue'

const props = defineProps({users: Object, venues: Object})

const form = useForm({
  venue_id: '',
  user_id: '',
  order_date: null,
  start_time: '',
  total_guest: null,
  payment_status: ''
})

function submit(){
  form.post('/admin/transaction/create', {
    onSuccess: () => {
      alert('Success Create Transaction')
    }
  })
}

</script>
