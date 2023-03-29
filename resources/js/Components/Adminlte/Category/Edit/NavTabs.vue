<template>
    <ul class="nav nav-tabs">
        <li class="nav-item" @click="setActiveTab('gallery')">
            <a class="nav-link" :class="{active: isActiveTab('gallery')}" href="#">Галлерея</a>
        </li>
        <li class="nav-item" @click="setActiveTab('download')">
            <a class="nav-link" :class="{active: isActiveTab('download')}" href="#">Загрузить</a>
        </li>
    </ul>
</template>

<script>
import {adminCategoryStore} from "@/store/categoryStore";
export default {
    name: "NavTabs",
    setup() {
        const categoryStore = adminCategoryStore()

        return { categoryStore }
    },
    data: () => {
        return {
            activeTab: 'gallery',
        }
    },
    methods: {
        isActiveTab: function (menuTab) {
            return this.activeTab === menuTab
        },
        setActiveTab: function (menuTab) {
            this.categoryStore.setContentActive();
            console.log(this.categoryStore.getContentActive)
            this.activeTab = menuTab
        },


    }
}
</script>

<style scoped>
.nav-tabs{
    margin-bottom: 20px;
}
</style>
