<script setup>
import InputError from "@/Components/InputError.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { reactive } from "vue";
import { Core as YubinbangoCore } from "yubinbango-core2"; // 郵便番号から住所の自動検索用

defineProps({
    errors: Object,
});

const form = reactive({
    name:     null,
    kana:     null,
    tel:      null,
    email:    null,
    postcode: null,
    address:  null,
    birthday: null,
    gender:   null,
    memo:     null,
});

// 郵便番号から住所の自動検索用
const fetchAddress = () => {
    new YubinbangoCore(String(form.postcode), (value) => {
        form.address = value.region + value.locality + value.street
    })
}

const storeCustomer = () => {
    router.post("/customers", form);
};
</script>

<template>
    <Head title="顧客登録" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                顧客登録
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="storeCustomer">
                                <div class="container px-5 py-8 mx-auto">
                                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                        <div class="flex flex-wrap -m-2">

                                            <!-- 氏名 -->
                                            <div class="p-2 w-full">
                                                <InputError :message="errors.name" />
                                                <div class="relative">
                                                    <label
                                                        for="name"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >顧客名</label
                                                    >
                                                    <input
                                                        type="text"
                                                        id="name"
                                                        name="name"
                                                        v-model="form.name"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                    />
                                                </div>
                                            </div>

                                            <!-- カナ -->
                                            <div class="p-2 w-full">
                                                <InputError :message="errors.kana" />
                                                <div class="relative">
                                                    <label
                                                        for="kana"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >顧客名カナ</label
                                                    >
                                                    <input
                                                        type="text"
                                                        id="kana"
                                                        name="kana"
                                                        v-model="form.kana"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                    />
                                                </div>
                                            </div>

                                            <!-- 電話番号 -->
                                            <div class="p-2 w-full">
                                                <InputError :message="errors.tel" />
                                                <div class="relative">
                                                    <label
                                                        for="tel"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >電話番号</label
                                                    >
                                                    <input
                                                        type="tel"
                                                        id="tel"
                                                        name="tel"
                                                        v-model="form.tel"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                    />
                                                </div>
                                            </div>

                                            <!-- メールアドレス -->
                                            <div class="p-2 w-full">
                                                <InputError :message="errors.email" />
                                                <div class="relative">
                                                    <label
                                                        for="email"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >メールアドレス</label
                                                    >
                                                    <input
                                                        type="email"
                                                        id="email"
                                                        name="email"
                                                        v-model="form.email"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                    />
                                                </div>
                                            </div>

                                            <!-- 郵便番号 -->
                                            <div class="p-2 w-full">
                                                <InputError :message="errors.postcode" />
                                                <div class="relative">
                                                    <label
                                                        for="postcode"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >郵便番号</label
                                                    >
                                                    <input
                                                        type="number"
                                                        id="postcode"
                                                        name="postcode"
                                                        @change="fetchAddress" 
                                                        v-model="form.postcode"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                    />
                                                </div>
                                            </div>

                                            <!-- 住所 -->
                                            <div class="p-2 w-full">
                                                <InputError :message="errors.address" />
                                                <div class="relative">
                                                    <label
                                                        for="address"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >住所</label
                                                    >
                                                    <input
                                                        type="text"
                                                        id="address"
                                                        name="address"
                                                        v-model="form.address"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                    />
                                                </div>
                                            </div>

                                            <!-- 誕生日 -->
                                            <div class="p-2 w-full">
                                                <InputError :message="errors.birthday" />
                                                <div class="relative">
                                                    <label
                                                        for="birthday"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >誕生日</label
                                                    >
                                                    <input
                                                        type="date"
                                                        id="birthday"
                                                        name="birthday"
                                                        v-model="form.birthday"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                    />
                                                </div>
                                            </div>

                                            <!-- 性別 -->
                                            <div class="p-2 w-full">
                                                <InputError :message="errors.gender" />
                                                <div class="relative">
                                                    <label
                                                        for="gender"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >性別</label
                                                    ><br>
                                                    <label class="ml-2 mr-4" for="gender1">女性</label>
                                                    <input
                                                        type="radio"
                                                        id="gender1"
                                                        name="gender"
                                                        v-model="form.gender"
                                                        value="1"
                                                    />
                                                    <label class="ml-2 mr-4" for="gender0">男性</label>
                                                    <input
                                                        type="radio"
                                                        id="gender0"
                                                        name="gender"
                                                        v-model="form.gender"
                                                        value="0"
                                                    />
                                                </div>
                                            </div>

                                            <!-- メモ -->
                                            <div class="p-2 w-full">
                                                <InputError :message="errors.memo" />
                                                <div class="relative">
                                                    <label
                                                        for="memo"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >メモ</label
                                                    >
                                                    <textarea
                                                        id="memo"
                                                        name="memo"
                                                        v-model="form.memo"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"
                                                    ></textarea>
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <button
                                                    class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                                                >
                                                    顧客登録
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
