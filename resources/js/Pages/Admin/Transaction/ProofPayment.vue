<template>
  <AppAdmin>
    <div class="text-xl font-semibold mb-8 ">Proof Payment DP Or Paid Off </div>
    <div v-for="(proof, i) in proofPayment" class="flex flex-col mb-4" :key="i">
      <div class="font-semibold text-xl mb-4 bg-blue-500 py-2 px-4 rounded-lg text-white text-center">Proof Payment ~
        <span class="uppercase">{{ proof.type }}</span> </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Bank</div>
        <div class="font-semibold">: {{ proof.bank ?? '-' }}</div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Account Number</div>
        <div class="font-semibold">: {{ proof.account_number ?? '-' }}</div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Name</div>
        <div class="font-semibold">: {{ proof.name ?? '-' }}</div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Phone Number</div>
        <div class="font-semibold">: {{ proof.phone_number ?? '-' }}</div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Image</div>
        <div v-if="proof.image" class="flex justify-start my-6">
          <div class="mr-2">: </div> <img :src="'/storage/proof-images/' + proof.image" alt="cover">
        </div>
        <div v-else-if="!proof.image">
          <div>: -</div>
        </div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Status</div>
        <div class="font-semibold">: {{ proof.status ?? '-' }}</div>
      </div>
      <div class="grid grid-cols-2 text-lg gap-4 mb-4">
        <div>Change Status Proof</div>
        <form @submit.prevent="submit(proof.id)">
          <select v-model="form.status" class="border-slate-200  rounded-lg" >
            <option value=""  disabled selected >Select status</option>
            <option value="unpaid" >Unpaid</option>
            <option value="Paid">Paid</option>
          </select>
          <div v-if="form.errors.status" class="text-red-500 my-2">
          {{ form.errors.status }}
        </div>
          <button type="submit" class=" ml-4 bg-blue-500 py-1 px-2 text-white rounded-lg">Change Status</button>

        </form>


      </div>
    </div>
  </AppAdmin>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AppAdmin from '../../../Layout/AppAdmin.vue'
const props = defineProps({ proofPayment: Object })

const form = useForm({
  status: ''
})

function submit(id){
  form.put(`/admin/transaction/${id}/proof-payment`, {
    onSuccess: () => {
      alert('Update Status Success')
      form.reset()
    }
  })
}
</script>
