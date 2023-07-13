<template>
    <div class="sm:flex justify-between items-center  py-4">
        <Link href="/" class="text-3xl font-sans font-bold text-blue-500 text-center mb-6 sm:mb-0">Venue's</Link>
        <div class=" flex items-center justify-center gap-4 tracking-wide" :class="{'hidden' : page.user}">
            <Link href="/login" class="font-sans bg-blue-500 py-2 px-4 rounded-lg tracking-wider text-neutral-0 hover:bg-blue-600">
                Login
            </Link>
            <button class="text-blue-500  text-lg  font-semibold hover:underline hover:text-blue-600">
                Register
            </button>
        </div>
        <div class="flex items-center justify-center gap-4 tracking-wide" :class="{'hidden' : !page.user}">
            <Link href="/dashboard" class="font-sans bg-blue-500 py-2 px-4 rounded-lg tracking-wider text-neutral-0 hover:bg-blue-600">
                Dashboard
            </Link>
            <button @click="logout" class="text-blue-500  text-lg  font-semibold hover:underline hover:text-blue-600">
                Logout
            </button>
        </div>
    </div>
</template>

<script setup>
import { Link, useForm, usePage} from "@inertiajs/vue3";
const page = usePage().props
const form = useForm({})

function logout(){
  form.post('/logout', {
    onSuccess: () => {
      alert('Success Logout')
    }
  })
}

</script>

<style></style>
