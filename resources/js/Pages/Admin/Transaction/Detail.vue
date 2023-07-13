<template>
  <AppAdmin>
    <div class="text-xl font-semibold mb-8 ">Detail Transaction </div>
    <!-- User -->
    <div class="flex flex-col mb-4">
      <div class="font-semibold text-xl mb-4 bg-blue-500 py-2 px-4 rounded-lg text-white text-center">User</div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Name</div>
        <div class="font-semibold">: {{ transaction.users.name }}</div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Email</div>
        <div class="font-semibold">: {{ transaction.users.email }}</div>
      </div>
    </div>
    <!-- Transaction -->
    <div class="flex flex-col mb-4">
      <div class="font-semibold text-xl mb-4 bg-blue-500 py-2 px-4 rounded-lg text-white text-center">Transaction</div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>ID Transaction</div>
        <div class="font-semibold">: {{ transaction.id_transaction }}</div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Order Date</div>
        <div class="font-semibold">: {{ transaction.order_date }}</div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Start Time</div>
        <div class="font-semibold">: {{ transaction.start_time }}</div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Total Guest</div>
        <div class="font-semibold">: {{ transaction.total_guest }}</div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Payment Status</div>
        <div class="font-semibold">: <span class="underline">{{ transaction.payment_status }}</span></div>
      </div>
    </div>
    <!-- Proof Payment -->

  </AppAdmin>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppAdmin from '../../../Layout/AppAdmin.vue'

const props = defineProps({ transaction: Object, proofPayment: Object })
console.log(props.proofPayment);
</script>
