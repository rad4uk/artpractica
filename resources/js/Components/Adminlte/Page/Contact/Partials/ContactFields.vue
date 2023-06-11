<template>
    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
         aria-labelledby="custom-tabs-three-home-tab">

        <div class="card card-blue card-outline collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Контактная информация</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <div class="form-group collection-wrapper">
                    <div class="secondSectionDescription" id="secondSectionDescription">
                        <div class="row collection-row">
                            <div class="form-container">
                                <div class="form-group create-implement-title">
                                    <label for="inputName">Адрес</label>
                                    <input type="text" id="inputName" v-model="address" class="form-control">
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-group create-implement-title">
                                    <label for="inputName">Телефон</label>
                                    <input type="text" id="inputName" v-model="phone" class="form-control">
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-group create-implement-title">
                                    <label for="inputName">Почта</label>
                                    <input type="email" id="inputName" v-model="email" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: "ContactFields",
    props: ['data'],
    data: () => {
        return {
            address: '',
            phone: '',
            email: '',
        }
    },
    mounted() {
        const data = JSON.parse(this.data)
        if (data) {
            this.address = data.address ?? ''
            this.phone = data.phone ?? ''
            this.email = data.email ?? ''
        }
    },
    watch: {
        address(newValue) {
            this.$emit('setAddress', newValue);
        },
        phone(newValue) {
            this.$emit('setPhone', newValue);
        },
        email(newValue) {
            this.$emit('setEmail', newValue);
        }
    }
}
</script>

<style scoped>

</style>
