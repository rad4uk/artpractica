<template>
    <a @click.prevent="changeIsModalOpen()" class="btn btn-danger btn-sm" href="#">
        <i class="fas fa-trash">
        </i>
        Удалить
    </a>
    <div v-if="this.isOpen" @click.self="changeIsModalOpen()" class="delete__modal">
        <div class="modal_dialog">
            <div class="modal_content">
                <div class="modal_header">
                    <h5 class="modal_title">Вы действительно хотите удалить этот элемент?</h5>
                </div>
                <div class="modal_body">
                    <div class="modal_body-item">
                        <h5 class="modal_body-item-title">Название категории: test</h5>
                    </div>
                    <div v-if="this.isMessage" class="modal_body-message">
                        <p class="modal_body-message-title">{{this.message}}</p>
                    </div>
                </div>
                <div class="modal_footer">
                    <button @click.prevent="this.deleteItem()" type="button" class="btn btn-danger">Удалить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {adminCategoryStore} from "@/store/categoryStore";
export default {
    name: "Delete",
    props: ['item', 'route'],
    setup() {
        const categoryContentStore = adminCategoryStore()

        return {categoryContentStore}
    },
    data: () => {
      return {
          isOpen: false,
          isMessage: false,
          message: ''
      }
    },
    methods: {
        changeIsModalOpen(){
            this.isMessage = false
            this.isOpen = !this.isOpen
        },
        async deleteItem(){
            const form = new FormData();
            form.append('id', this.item.id)
            await axios.post(this.route, form)
                .then(res => {
                    const data = res.data
                    console.log(res)
                    if (res.status === 200 && data.statusText === 'success'){
                        this.isOpen = false
                        this.categoryContentStore.updateCategoriesItems(this.item)
                    }
                    if (res.status === 200 && data.statusText === 'hasChildren'){
                        this.isMessage = true
                        this.message = data.message
                    }
                })
                .catch(error => {
                    console.log(error.response)
                })
                .finally(() => {

                })
        }

    }
}
</script>

<style scoped>
.delete__modal{
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    /*background: #212529;*/
    background: rgba(33, 37, 41, 0.3);
}
.modal_dialog{
    position: relative;
    width: auto;
    top: 10%;
    /*margin: 1.75rem auto;*/
    margin: 0 auto;
    max-width: 600px;
    transform: none;
    transition: transform .3s ease-out,-webkit-transform .3s ease-out;
}
.modal_content{
    position: relative;
    width: 100%;
    height: 100%;
    opacity: 1;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 0.3rem;
    box-shadow: 0 .25rem .5rem rgba(0,0,0,.5);
    outline: 0;
}
.modal_header{
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    border-top-left-radius: calc(0.3rem - 1px);
    border-top-right-radius: calc(0.3rem - 1px);
}
.modal_body-item-title{
    margin-bottom: 0;
    line-height: 1.5;
}
.modal_body{
    position: relative;
    flex: 1 1 auto;
    padding: 1rem;
}
.modal_footer{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    padding: 0.75rem;
    border-top: 1px solid #e9ecef;
    border-bottom-right-radius: calc(0.3rem - 1px);
    border-bottom-left-radius: calc(0.3rem - 1px);
}
.modal_body-item{
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}
.modal_body-message{
    display: flex;
    justify-content: center;
    color: #dc3545;
}
@media (max-width: 760px){
    .modal_dialog{
        max-width: 90%;
    }
}
.modal_body-message-title{
    text-align: center;
}
</style>
