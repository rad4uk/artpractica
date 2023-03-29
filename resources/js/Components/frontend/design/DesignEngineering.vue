<template>
    <div>
        <slot name="designTextComponent"></slot>

        <div class="equipment">
            <div class="container">
                <div class="equipment__title">
                    КОМПЛЕКТАЦИЯ ИНТЕРЬЕРА
                </div>
                <div class="equipment__content">
                    <p>
                        Обратившись в компанию ArtPractica, вы получите весь спектр услуг в одном месте: стильный и продуманный дизайн ‚ качественные ремонтно - отделочные работы, полную комплектацию интерьера.
                        Подбор мебели, света, отделочных материалов существенно экономит время заказчика, гарантируя наилучший результат реализации проекта.
                        Команда ArtPractica комплексно закрывает вопрос оформления вашего пространства.
                    </p>
                </div>
                <div class="equipment__row">
                    <div class="equipment__column">
                        <div class="equipment__image">
                            <img src="/images/design/img_1.png" alt="">
                        </div>
                    </div>
                    <div class="equipment__column">
                        <div class="equipment__item">
                            <div class="equipment__item-title">
                                <h4>
                                    <span>01</span>ДИЗАЙНЕРСКАЯ МЕБЕЛЬ
                                </h4>
                            </div>
                            <div class="equipment__item-text">
                                <p>
                                    Кухни, спальни, столовые, корпусная мебель — мы сделаем все за вас: от заказа до монтажа.
                                </p>
                            </div>
                        </div>
                        <div class="equipment__item">
                            <div class="equipment__item-title">
                                <h4>
                                    <span>02</span>САНТЕХНИКА
                                </h4>
                            </div>
                            <div class="equipment__item-text">
                                <p>
                                    Смесители, раковины, ванны, инсталляции, душевые кабины лучшего качества.                            </p>
                            </div>
                        </div>
                        <div class="equipment__item">
                            <div class="equipment__item-title">
                                <h4>
                                    <span>03</span>ОТДЕЛОЧНЫЕ МАТЕРИАЛЫ
                                </h4>
                            </div>
                            <div class="equipment__item-text">
                                <p>
                                    Обои и лакокрасочные материалы, керамогранит, напольные покрытия, двери.
                                </p>
                            </div>
                        </div>
                        <div class="equipment__item">
                            <div class="equipment__item-title">
                                <h4>
                                    <span>04</span>ДЕКОР ИНТЕРЬЕРА
                                </h4>
                            </div>
                            <div class="equipment__item-text">
                                <p>
                                    Авторский подбор декора для создания особенного настроения в интерьере.
                                </p>
                            </div>
                        </div>
                        <div class="equipment__item">
                            <div class="equipment__item-title">
                                <h4>
                                    <span>05</span>ОСВЕЩЕНИЕ
                                </h4>
                            </div>
                            <div class="equipment__item-text">
                                <p>
                                    Команда специалистов поможет в выборе наиболее оптимальных вариантов как технического, так и декоративного освещения.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="supervision">
            <div class="container">
                <div class="supervision__row">
                    <div class="supervision__title">
                        <h2>
                            АВТОРСКИЙ НАДЗОР И РЕМОНТ ОТ АRTPRACTICA
                        </h2>
                    </div>
                    <div class="supervision__image">
                        <img
                            lazy
                            v-lazy="{
                              src: '/images/design/img_2.png',
                              error: 'url',
                            }"
                           alt="">
                    </div>
                    <div class="supervision__text">
                        <p>
                            За идеальным ремонтом скрываются архитекторы-дизайнеры, которые берут на себя неподъёмный груз ответственности за каждую деталь.
                        </p>
                        <p>
                            Команда ArtPractica уделяет особое внимание технической части ремонта, где надежность, как и качество, должны быть стопроцентными.
                        </p>
                        <p>
                            Для того чтобы согласованные 3D-изображения стали реальностью, необходим авторский надзор дизайнера, так как никто лучше него не знает, как воплотить ту или иную идею, заложенную в проекте. Не менее важным фактором является взаимодействие с проверенными строителями, подрядчиками и поставщиками, не нарушающими сроки и качественно, со знанием дела выполняющими свою работу. Только в таком случае можно быть уверенным, что стройка не превратится для вас в проблему, а будет приятным процессом воплощения мечты в реальность!
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="supervisionneeded">
            <div class="container">
                <div class="supervisionneeded__row">
                    <div class="supervisionneeded__title">
                        <h3>
                            ПОЧЕМУ НЕОБХОДИМ АВТОРСКИЙ НАДЗОР?
                        </h3>
                    </div>
                    <div class="supervisionneeded__content">
                        <ul class="supervisionneeded__list">
                            <li class="supervisionneeded__list-item">
                                Контроль бригады строителей со стороны архитектора-дизайнера для четкой реализации дизайн-проекта
                            </li>
                            <li class="supervisionneeded__list-item">
                                Регулярные выезды архитектора-дизайнера на объект для контроля строительных работ.
                            </li>
                            <li class="supervisionneeded__list-item">
                                Внесение в проект необходимых изменений, в том числе незапланированных.
                            </li>
                            <li class="supervisionneeded__list-item">
                                Постоянная коммуникация архитектора-дизайнера с прорабом, регулярное информирование заказчика о ходе текущих работ, помощь в решении возникающих вопросов.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DesignEngineering"
}
</script>

<style scoped>

</style>
