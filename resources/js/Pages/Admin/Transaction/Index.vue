<template>
  <AppAdmin>
    <div class="text-2xl font-semibold">Transaction Management</div>
    <div class="my-8">
      <Link href="/admin/transaction/create" class="bg-blue-500 py-2 px-4 text-base text-white rounded-lg">Create New
      Transaction
      </Link>
      <!-- Table -->
      <div class="flex flex-col mt-4">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full text-left text-sm font-light">
                <thead class="border-b font-medium dark:border-neutral-500">

                  <tr class="text-center">
                    <th scope="col" class="px-6 py-4">#</th>
                    <th scope="col" class="px-6 py-4">
                      User
                    </th>
                    <th scope="col" class="px-6 py-4">
                      Order Date
                    </th>
                    <th scope="col" class="px-6 py-4">
                      Payment Status
                    </th>
                    <th scope="col" class="px-6 py-4">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(transaction, i) in transactions " class="border-b dark:border-neutral-500 text-center" :key="i">
                    <td class="px-6 py-4 font-medium">{{ i + 1 }}</td>
                    <td class="px-6 py-4">
                      {{ transaction.users.name }}
                    </td>
                    <td class="px-6 py-4"> {{ transaction.order_date }} </td>
                    <td class="px-6 py-4 font-bold">{{ transaction.payment_status }} </td>
                    <td class="px-6 py-4 ">
                      <div class="flex gap-2 justify-center text-white">
                        <Link :href="'/admin/transaction/' + transaction.id_transaction + '/edit'" class="bg-green-500 py-2 px-4 rounded-lg">
                        Edit
                        </Link>
                        <Link :href="'/admin/transaction/' + transaction.id_transaction " class="bg-blue-500 py-2 px-4 rounded-lg">
                        Detail
                        </Link>
                        <Link :href="'/admin/transaction/' + transaction.id + '/proof-payment'" class="bg-cyan-500 py-2 px-4 rounded-lg">
                        Proof Payment
                        </Link>
                        <button @click.prevent="destroy(`${transaction.id_transaction}`)" class="bg-red-500 py-2 px-4 rounded-lg">
                          Delete
                        </button>
                      </div>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </AppAdmin>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { confirmDelete } from '../../../Components/ConfirmDialog.vue';
import AppAdmin from '../../../Layout/AppAdmin.vue'
const props = defineProps({transactions: Object})

const form = useForm({})

function destroy(id_transaction) {
  confirmDelete({
    text: "Apa anda yakin menghapus transaksi?",
    then: (result) => {
      if (result.isConfirmed) {
        form.delete(`/admin/transaction/${id_transaction}/delete`, {
          onSuccess: () => {
            alert('Transaction Deleted')
          },
        });
      }
    },
  });
}

</script>
