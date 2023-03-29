<template>
    <div class="atelier">
        <div class="atelier-furniture">
            <div class="container">
                <div class="atelier-furniture-title service-title">
                    ARTPRACTICA FURNITURE ATELIER
                </div>
                <div class="atelier-furniture-text">
                    <p class="service-text">
                        МЕБЕЛЬНОЕ ПРОИЗВОДСТВО <a href="https://apfurniture.ru/" target="_blank">APFURNITURE.RU</a>
                    </p>
                    <p class="service-text">
                        Работает с 2017 года. На площади более 1500 кв.м. расположено современное оборудование для выпуска эксклюзивных дизайнерских изделий. Стаж каждого сотрудника - не менее 10 лет. Мы создаем мебель любой сложности от минимализма до классики. Уверены, что качество всегда будет в тренде. Для нас важно, чтобы изделия выглядели эстетично и радовали вас десятилетиями.

                    </p>
                </div>
                <div class="atelier-furniture-image">
                    <img src="../../../../../public/images/design/img_3.png" alt="">
                </div>
            </div>
        </div>

        <div class="atelier-team">
            <div class="container">
                <div class="atelier-team-title service-title">
                    КОМАНДА ПРОФЕССИОНАЛОВ
                </div>
                <div class="atelier-team-text">
                    <p class="service-text">
                        <span>ARTPRACTICA FURNITURE — </span>это опытная команда профессионалов и высокотехнологичное производство полного цикла. Успешно воплощаем идеи дизайнеров. Индивидуальный подход к каждому проекту.
                    </p>
                </div>
                <div class="row">
                    <div class="equipment__column">
                        <div class="equipment__image">
                            <img
                                lazy
                                v-lazy="{
                                  src: '/images/design/img_4.png',
                                  error: 'url',
                                }"
                                alt="">
                        </div>
                    </div>
                    <div class="equipment__column">
                        <div class="equipment__item">
                            <div class="equipment__item-title">
                                <h4>
                                    <span>01</span>
                                </h4>
                            </div>
                            <div class="equipment__item-text">
                                <p>
                                    Группа штатных конструкторов и собственное производство позволяют нам реализовать дизайнерские задачи любой сложности на высоком уровне.
                                </p>
                            </div>
                        </div>
                        <div class="equipment__item">
                            <div class="equipment__item-title">
                                <h4>
                                    <span>02</span>
                                </h4>
                            </div>
                            <div class="equipment__item-text">
                                <p>
                                    Мы создаем мебель, начиная с первичных замеров, заканчивая установкой изделия. На производстве используются материалы и комплектующие, имеющие сертификаты соответствия и безопасности, а сам процесс тщательно контролируется профессионалами.
                                </p>
                            </div>
                        </div>
                        <div class="equipment__item">
                            <div class="equipment__item-title">
                                <h4>
                                    <span>03</span>
                                </h4>
                            </div>
                            <div class="equipment__item-text">
                                <p>
                                    Пристальное внимание к деталям прослеживается на каждом этапе изготовления и реализации изделий.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="atelier-apfurniture">
            <div class="container">
                <div class="atelier-apfurniture-title service-title">
                    APFURNITURE.RU
                </div>
                <div class="atelier-apfurniture-text">
                    <p class="service-text">
                        Сотрудничаем с дизайнерами по РФ. Опыт и техническое оснащение позволяют качественно реализовать любую вашу идею. С нашими работами вы можете подробно ознакомиться на нашем сайте
                    </p>
                </div>
                <div class="row">
                    <div class="atelier-apfurniture-item">
                        <img
                            lazy
                            v-lazy="{
                              src: '/images/design/img_5.png',
                              error: 'url',
                            }"
                            alt="" class="atelier-apfurniture-image">
                    </div>
                    <div class="atelier-apfurniture-item">
                        <img
                            lazy
                            v-lazy="{
                              src: '/images/design/img_6.png',
                              error: 'url',
                            }"
                            alt="" class="atelier-apfurniture-image">
                    </div>
                    <div class="atelier-apfurniture-item">
                        <img
                            lazy
                            v-lazy="{
                              src: '/images/design/img_7.png',
                              error: 'url',
                            }"
                            alt="" class="atelier-apfurniture-image">
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Atelier"
}
</script>

<style scoped>
.service-text a{
    color: #ffffff;
    text-decoration: underline;
}
</style>
