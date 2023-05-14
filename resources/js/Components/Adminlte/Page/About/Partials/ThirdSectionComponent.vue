<template>
    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
         aria-labelledby="custom-tabs-three-home-tab">
        <form>
            <div class="form-group">
                <label for="inputName">Заголовок к третьей секции</label>
                <input type="text" id="inputName" name="authorName" class="form-control" v-model="title">
            </div>

            <div class="form-group">
                <label for="inputName">Описание к третьей секции</label>
                <textarea id="inputName" name="description" class="form-control" v-model="description"></textarea>
            </div>

        </form>
    </div>

</template>

<script>
import {adminAboutPageStore} from "@/store/adminlte/aboutPageStore";

export default {
    name: "ThirdSectionComponent",
    props: ['page', 'is_type_page'],
    data: () => {
        return {
            title: '',
            description: '',
        }
    },
    async beforeMount() {
        if (this.is_type_page === 'edit' && this.page.third_section_data) {
            const thirdSectionData = JSON.parse(this.page.third_section_data)
            if (thirdSectionData.title) {
                this.title = thirdSectionData.title
            }
            if (thirdSectionData.description) {
                this.description = thirdSectionData.description
            }
        }
    },
    setup() {
        const pageStore = adminAboutPageStore()

        return {pageStore}
    },
    watch: {
        title(value) {
            this.pageStore.setThirdSectionDataTitle(value)
        },
        description(value) {
            this.pageStore.setThirdSectionDataDescription(value)
        }
    },
}
</script>

<style scoped>

</style>
