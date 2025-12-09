<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { onMounted, reactive } from "vue";
import { getToday } from "@/common";

onMounted(() => {
    form.startDate = getToday();
    form.endDate = getToday();
});

const form = reactive({
    startDate: null,
    endDate: null,
    type: "perDay",
});

const resData = reactive({});

const getData = async () => {
    try {
        await axios
            .get("/api/analysis/", {
                params: {
                    startDate: form.startDate,
                    endDate: form.endDate,
                    type: form.type,
                },
            })
            .then((res) => {
                resData.data = res.data.data;
                console.log(res.data);
            });
    } catch (e) {
        console.log(e.message);
    }
};
</script>

<template>
    <Head title="データ分析" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                データ分析
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="getData" class="flex items-center gap-4">
                            From:
                            <input
                                type="date"
                                name="startDate"
                                v-model="form.startDate"
                            />
                            To:
                            <input
                                type="date"
                                name="endDate"
                                v-model="form.endDate"
                            />
                            <button
                                class="ml-4 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                            >
                                分析する
                            </button>
                        </form>
                        <div v-show="resData.data" class="lg:w-2/3 mt-5 w-full mx-auto overflow-auto">
                            <table
                                class="table-auto w-full text-left whitespace-no-wrap"
                            >
                                <thead>
                                    <tr>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"
                                        >
                                            年月日
                                        </th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                                        >
                                            金額
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in resData.data" :key="item.id">
                                        <td
                                            class="border-b-2 border-gray-200 px-4 py-3"
                                        >
                                            {{ item.date }}
                                        </td>
                                        <td
                                            class="border-b-2 border-gray-200 px-4 py-3"
                                        >
                                            {{ item.total }} 円
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
