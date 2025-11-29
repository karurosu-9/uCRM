<script setup>
    import { Link } from '@inertiajs/vue3';
    defineProps({
        links: Object
    })

    // 「前」と「次」へ表示変換
    const convertLabel = (label) => {
    if (label.includes("pagination.previous")) {
        return "前";
    }
    if (label.includes("pagination.next")) {
        return "次";
    }
    return label;
};
</script>

<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap mb-1">
            <template v-for="(link, index) in links" :key="index">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="convertLabel(link.label)" />
                <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{'bg-blue-700 text-white':link.active}" :href="link.url" v-html="convertLabel(link.label)" />
            </template>
        </div>

    </div>
</template>
