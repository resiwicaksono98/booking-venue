<template lang="">
    <div class="bg-white shadow-[0px_4px_140px_0px_A6A6A6]">
        <div class="w-[300px] flex flex-col h-screen justify-between">
            <div class="h-[90vh] sidebar-profile-menu overflow-x-scroll">
                <div class="mt-12 text-center text-2xl font-bold">
                    Booking Venue Dufan
                </div>
                <!-- List Item -->
                <div class="sidebar-menu">
                    <ul
                        class="w-full text-neutral-200 flex sticky top-0 flex-col mt-[20px]"
                    >
                        <!-- dashboard -->
                        <Link
                            href="/admin"
                            class="py-3 hover:bg-neutral-50 px-8"
                            :class="{
                                active:
                                    $page.component === 'Admin/Dashboard',
                            }"
                        >
                            <div class="flex gap-3 items-center">
                                <div><font-awesome-icon icon="house" /></div>
                                <div class="text-neutral-500">Dashboard</div>
                            </div>
                        </Link>
                        <!-- Transaction -->
                        <Link
                            href="/"
                            class="py-3 hover:bg-neutral-50 px-8"
                            :class="{
                                active:
                                    $page.component === 'admin/transaction',
                            }"
                        >
                            <div class="flex gap-3 items-center">
                                <div><font-awesome-icon icon="dollar-sign" /></div>
                                <div class="text-neutral-500">Transaction</div>
                            </div>
                        </Link>
                              <!-- Transaction -->
                              <Link
                            href="/"
                            class="py-3 hover:bg-neutral-50 px-8"
                            :class="{
                                active:
                                    $page.component === 'admin/transaction',
                            }"
                        >
                            <div class="flex gap-3 items-center">
                                <div><font-awesome-icon icon="list" /></div>
                                <div class="text-neutral-500">List Venue</div>
                            </div>
                        </Link>
                    </ul>
                </div>
            </div>
            <!-- Logout -->
            <div class="bg-[#f8f8f8] flex items-center gap-3 px-8">
                <div>
                    <font-awesome-icon icon="right-from-bracket" />
                </div>
                <div>
                    <button
                        class="w-full py-4 text-[#8E8E8E] sub-sm-semibold"
                        @click.prevent="logout"
                    >
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faRightFromBracket, faHouse,faDollarSign,faList } from "@fortawesome/free-solid-svg-icons";
library.add([faRightFromBracket, faHouse,faDollarSign,faList]);

const page = usePage().props;

function logout() {
    router.post("/logout");
}
</script>

<style>
.active {
    background: #f5f5f5;
    border-left: 3px solid #52e6c9;
}
</style>
