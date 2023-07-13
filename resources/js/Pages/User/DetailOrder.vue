<template>
  <App>
    <h1 class="text-xl mt-6 font-bold">Order {{ transaction.venue.name }} 03, Mei 2023</h1>
    <div class="grid grid-cols-2">
      <div class="mt-8 flex text-xl items-start gap-12">
        <div class="flex flex-col gap-8">
          <div>Name</div>
          <div>No Transaction</div>
          <div>Total Price</div>
          <div>DP</div>
          <div>Status DP</div>
          <div>Date</div>
          <div>Status Payment</div>
          <div :class="{'hidden' : transaction.payment_status === 'paid'}">Action</div>
        </div>
        <div class="flex flex-col gap-8">
          <div>: {{ transaction.users.name }}</div>
          <div>: #{{ transaction.id_transaction }}</div>
          <div>: {{ formatToRupiah(parseInt(transaction.venue.price)) }}</div>
          <div>: {{ countDp }}</div>
          <div class="uppercase">: <span class="text-green-500">{{ dataDp.length ? dataDp[0].status : 'Belum Pembayaran DP' }}</span> </div>
          <div>: 15 April 2023</div>
          <div class="uppercase">: <span class="text-green-500">{{ transaction.payment_status }}</span></div>
          <div :class="{'hidden' : transaction.payment_status === 'paid'}">
            :
            <Link :href="`/${transaction.id_transaction}/payment`" class=" bg-blue-500 py-2 px-3 rounded-lg text-white text-base" > Bayar Sekarang</Link>
          </div>

        </div>

      </div>
      <div>

      </div>
    </div>
  </App>
</template>

<script setup>
import { ref } from "vue";
import App from "../../Layout/App.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({ transaction: Object, proofPayment: Object })
const countDp = ref(formatToRupiah(parseInt(props.transaction.venue.price / 100 * 20)))
const dataDp = props.proofPayment.filter((item) => item.type == 'dp')

function formatToRupiah(amount) {
  return amount.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
}

</script>
