<template>
    <div class="designtext">
        <div class="container">
            <div class="designtext__row">
                <div class="designtext__title">
                    <slot name="title">
                        <h1>ДИЗАЙН ПРОЕКТИРОВАНИЕ</h1>
                    </slot>

                </div>
                <div class="designtext__text">
                    <slot name="text">
                        <p>
                            Понимая, что отличный дизайн предполагает новые способы восприятия окружающего пространства, специалисты компании Апргасйса привносят в каждый проект более чем десятилетний творческий опыт, проявляя страсть к созданию функциональных, вдохновленных пространств, которые соединят людейс их мечтами. Начиная с первоначальной консультации, разработки концепции и заканчивая сдачей рабочей документации по проекту , наша команда, предлагает индивидуальный сервис для создания дизайн проектов любой сложности.
                        </p>
                    </slot>

                </div>
                <div class="designtext__button">
                    <a href="#form" class="buttonShadow">отправить</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DesignText"
}
</script>

<style scoped>

</style>
