<template>
  <AppAdmin>

    <h1 class="text-2xl font-semibold">Edit Venue {{ venue.name }}</h1>
    <div class="my-4 text-gray-500 flex gap-2 text-sm">
      <Link href="/admin/venue">Venue</Link>
      <div>/ Edit</div>

    </div>
    <form @submit.prevent="submit">
            <div class="my-4">
                <label for="name">Name</label>
                <input
                    type="text"
                    v-model="form.name"
                    class="mt-2 border-neutral-100 w-full rounded-lg"
                    placeholder="Venue Name"
                />
                <div v-if="form.errors.name" class="text-red-500 my-2">
                    {{ form.errors.name }}
                </div>
            </div>
            <div class="mb-4">
                <label for="address">Address</label>
                <textarea
                    v-model="form.address"
                    class="mt-2 border-neutral-100 w-full rounded-lg"
                    rows="4"
                    placeholder="Address"
                ></textarea>
                <div v-if="form.errors.address" class="text-red-500 my-2">
                    {{ form.errors.address }}
                </div>
            </div>
            <div class="mb-4">
                <label for="description">Description</label>
                <textarea
                    v-model="form.description"
                    class="mt-2 border-neutral-100 w-full rounded-lg"
                    rows="4"
                    placeholder="Address"
                ></textarea>
                <div v-if="form.errors.description" class="text-red-500 my-2">
                    {{ form.errors.description }}
                </div>
            </div>
            <div class="mb-4">
                <label for="price">Price</label>
                <input
                    type="number"
                    v-model="form.price"
                    class="mt-2 border-neutral-100 w-full rounded-lg"
                    placeholder="4000000"
                />
                <div v-if="form.errors.price" class="text-red-500 my-2">
                    {{ form.errors.price }}
                </div>
            </div>
            <div class="mb-4">
                <label for="max_capacity">Max Capacity</label>
                <input
                    type="number"
                    v-model="form.max_capacity"
                    class="mt-2 border-neutral-100 w-full rounded-lg"
                    placeholder="Max Capacity"
                />
                <div v-if="form.errors.max_capacity" class="text-red-500 my-2">
                    {{ form.errors.max_capacity }}
                </div>
            </div>
            <div class="mb-4">
                <label for="image">Image</label>
                <input
                    type="file"
                    id="image"
                    class="mt-2 border-neutral-100 w-full"
                    placeholder="Max Capacity"
                    @input="form.image = $event.target.files[0]"
                @change="preview"
                />
                <div v-if="form.errors.image" class="text-red-500 my-2">
                    {{ form.errors.image }}
                </div>
                <!-- Preview -->
                <div>
                    <img :src="imagePreview ? imagePreview : '/storage/cover-images/'+ venue.image" alt="" />
                </div>
            </div>
            <button
                type="submit"
                class="mt-6 bg-blue-500 py-2 px-4 rounded-lg text-base text-white"
            >
                Update Venue
            </button>
        </form>
  </AppAdmin>
</template>

<script setup>
import { Link, useForm, usePage } from "@inertiajs/vue3";
import AppAdmin from "../../../Layout/AppAdmin.vue";
import { ref } from "vue";
const props = defineProps({venue:Object})
const page = usePage().props;
const form = useForm({
    name: props.venue.name ?? null,
    address: props.venue.address ?? null,
    description: props.venue.description ?? null,
    price: props.venue.price ?? null,
    max_capacity: props.venue.max_capacity ?? null,
    image: props.venue.image ?? null,
});

const imagePreview = ref('')
const preview = (e) => {
  const file = event.target.files[0];
  if (file && file.type.includes("image/")) {
    form.image = file; // Menyimpan gambar yang diunggah ke field form
    // Membaca file gambar menggunakan FileReader
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result; // Menyimpan URL gambar ke field state
    };
    reader.readAsDataURL(file);
  }
}


 function submit(){
  form.post(`/admin/venue/${props.venue.slug}/update`, {
    forceFormData: true,
    onSuccess: () => {
      alert('Success Update Venue')
    }
  })
}

</script>
