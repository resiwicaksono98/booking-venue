<template>
  <App>
      <div class="text-2xl font-bold mt-6">Your Order</div>
      <div class="mt-6 flex flex-col gap-4">
        <Link v-for="(transaction, i) in transactions" :href="`/transaction/${transaction.id_transaction}/detail`" class="flex gap-2 bg-neutral-50 p-4 rounded-lg hover:bg-blue-100 cursor-pointer" :key="i">
          <div class="font-semibold">{{ transaction.venue.name }} /</div>
          <div> {{ transaction.order_date }} /</div>
          <div class="font-bold">{{ transaction.payment_status }}</div>
        </Link>

      </div>
  </App>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import App from '../../Layout/App.vue';
const props = defineProps({transactions: Object})

</script>
