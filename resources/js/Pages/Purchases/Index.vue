<script setup>
import FlashMessage from "@/Components/FlashMessage.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Pagination from '@/Components/Pagination.vue';
import dayjs from 'dayjs'; // 購入日の表記の修正ライブラリ

defineProps({
    orders: Object
})
</script>

<template>
    <Head title="購入履歴" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                購入履歴
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-8 mx-auto">
                                <FlashMessage />
                                <div
                                    class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto"
                                >
                                    <div>
                                        <input type="text" name="search" v-model="search">
                                        <button
                                            class="bg-blue-500 text-white py-2 px-2 ml-2"
                                            @click="searchCustomers"
                                        >
                                            検索
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="lg:w-2/3 w-full mx-auto overflow-auto"
                                >
                                    <table
                                        class="table-auto w-full text-left whitespace-no-wrap"
                                    >
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"
                                                >
                                                    ID
                                                </th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                                                >
                                                    氏名
                                                </th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                                                >
                                                    合計金額
                                                </th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                                                >
                                                    ステータス
                                                </th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                                                >
                                                    購入日
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="order in orders.data" :key="order.id">
                                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                                        {{ order.id }}
                                                </td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                                    {{ order.customer_name }}
                                                </td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ order.total }}</td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ order.status }}</td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ dayjs(order.created_at).format('YYYY-MM-DD HH:mm:ss') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <Pagination class="mt-6 ml-40" :links="orders.links"></Pagination>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
