<template>
    <div class="card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Шаблон 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Шаблон 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Шаблон 3</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <first-template-component></first-template-component>
                <second-template-component></second-template-component>
                <third-template-component></third-template-component>
            </div>
        </div>
    </div>
</template>

<script>
import FirstTemplateComponent from "./FirstTemplateComponent.vue";
import SecondTemplateComponent from "./SecondTemplateComponent.vue";
import ThirdTemplateComponent from "./ThirdTemplateComponent.vue";
export default {
    name: "MainTemplateComponent",
    components: {
        FirstTemplateComponent,
        SecondTemplateComponent,
        ThirdTemplateComponent
    }
}
</script>

<style scoped>

</style>
