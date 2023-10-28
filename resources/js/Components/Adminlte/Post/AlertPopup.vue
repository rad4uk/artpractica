<script>

export default {
    name: "RemovePopup",
    props: {
        removeLink: {
            type: String,
            required: true,
            default: ''
        },
        post: {
            type: Object,
            required: true,
            default: {}
        },
        message: {
            type: String,
        }
    },
}
</script>

<template>
    <div class="alert-wrapper"
         @click.self="$emit('closePopup')"
    >
        <div class="alert-popup">
            <p class="alert-popup__text">
                <slot name="text"></slot>
            </p>
            <button class="btn btn-primary"
                    @click="$emit('removePost', this.post)"
            >Подтвердить</button>

            <span class="alert alert-danger"
                v-if="this.message.length > 0"
            >
                 {{ this.message }}
            </span>
        </div>
    </div>

</template>

<style lang="scss" scoped>
.alert-wrapper{
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: #0000004d;
}
.alert-popup{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    height: 200px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 5px;
    gap: 10px;

    &__text{
        margin-bottom: 0;
    }
}
</style>
