<template>
<!--    <div>-->
<!--        <slot name="designTextComponent"></slot>-->

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
                                Помните русскую пословицу «Не место красит человека, а человек – место»?
                            </p>
                        </slot>
                        <slot name="text">
                            <p>
                                Проработав с профессионалами своего дела, людьми, объединенными вот уже более 15 лет общей специальностью, креативным мышлением, творческим началом, готовы заверить: такой принцип может быть зеркален.
                            </p>
                        </slot>
                        <slot name="text">
                            <p>
                                История ArtPractica о том, как место повлияло на жизни многих людей. Как были задуманы и воплощены сотни красивых и функциональных проектов, соединивших владельцев с их мечтами.
                            </p>
                        </slot>
                        <slot name="text">
                            <p>
                                Наша команда предлагает индивидуальный сервис для создания дизайн-проекта любой сложности, формирования образа дома, который вы хотите полюбить. И мы готовы приложить все усилия, чтобы это была любовь с первого взгляда.
                            </p>
                        </slot>
                    </div>

                    <div class="sectionimage__block">
                        <div class="sectionimage__image">
                            <img src="../../../../../public/images/design/img.png" alt="">
                        </div>
                    </div>
                    <a href="#form" class="designtext__button">ОСТАВИТЬ ЗАЯВКУ</a>
                </div>
            </div>
        </div>

    <div class="stages">
        <div class="container">
            <div class="stages__title">
                <h3>ЭТАПЫ РАБОТЫ НАД ДИЗАЙН ПРОЕКТОМ</h3>
            </div>
            <div class="row">
                <div class="stages__column">
                    <div class="stages__column-item stages-item">
                        <div class="stages-item-title">

                            <p><span>01</span>встреча с заказчиком</p>
                        </div>
                        <div class="stages-item-content">
                            <p>Обсуждение дизайнера и заказчика его идей и пожеланий.</p>
                        </div>
                    </div>
                    <div class="stages__column-item stages-item">
                        <div class="stages-item-title">
                            <p><span>02</span>ЗАКЛЮЧЕНИЕ ДОГОВОРА</p>
                        </div>
                        <div class="stages-item-content">
                            <p>Заключение договора с определением четких сроков, состава проекта и индивидуальных условий.</p>
                        </div>
                    </div>
                    <div class="stages__column-item stages-item">
                        <div class="stages-item-title">
                            <p><span>03</span>РАЗРАБОТКА КОНЦЕПЦИИ</p>
                        </div>
                        <div class="stages-item-content">
                            <p>Определение основной идеи проекта: стиль, цветовые решения, материалы, настроение.</p>
                        </div>
                    </div>
                    <div class="stages__column-item stages-item">
                        <div class="stages-item-title">
                            <p><span>04</span>СОЗДАНИЕ ВИЗУАЛИЗАЦИИ</p>
                        </div>
                        <div class="stages-item-content">
                            <p>Демонстрация 3D – изображений, реально отражающих каждый уголок вашего будущего пространства.</p>
                        </div>
                    </div>
                </div>
                <div class="stages__column">
                    <div class="stages__column-item stages-item">
                        <div class="stages-item-title">
                            <p><span>05</span>ВЫЕЗД НА ОБМЕРЫ</p>
                        </div>
                        <div class="stages-item-content">
                            <p>Выезд архитектора-дизайнера на профессиональный обмер в любое удобное для заказчика время без географических ограничений</p>
                        </div>
                    </div>
                    <div class="stages__column-item stages-item">
                        <div class="stages-item-title">
                            <p><span>06</span>ПРОЕКТНАЯ ДОКУМЕНТАЦИЯ</p>
                        </div>
                        <div class="stages-item-content">
                            <p>Трансформация 3D-изображений в конкретные чертежи, позволяющие воплотить идеи архитектора-дизайнера в жизнь.</p>
                        </div>
                    </div>
                    <div class="stages__column-item stages-item">
                        <div class="stages-item-title">
                            <p><span>07</span>ПЛАНИРОВОЧНОЕ РЕШЕНИЕ</p>
                        </div>
                        <div class="stages-item-content">
                            <p>Профессиональная разработка грамотного планировочного решения – гарант успеха будущего проекта.</p>
                        </div>
                    </div>
                    <div class="stages__column-item stages-item">
                        <div class="stages-item-title">
                            <p><span>08</span>ВОПЛОЩЕНИЕ</p>
                        </div>
                        <div class="stages-item-content">
                            <p>На основании согласованного с заказчиком проекта команда ArtPractica сделает любую идею реальной независимо от ее сложности.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "firstTemplate",
    props: ['data'],
    mounted() {
        console.log(this.data)
    }
}
</script>

<style scoped>

</style>
