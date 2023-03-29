<template>
    <div class="single-widget" v-draggable>
        <input type="text" v-model="textValue">
        <input type="file" @change="onFileChange">
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    props: {
        index: {
            type: Number,
            required: true
        },
        text: {
            type: String,
            default: ''
        },
        file: {
            type: File,
            default: null
        },
        onWidgetSort: {
            type: Function,
            required: true
        }
    },
    directives: {
        draggable: {
            mounted(el) {
                el.setAttribute('draggable', 'true');
            }
        }
    },
    setup(props) {
        const textValue = ref(props.text);

        const onFileChange = (e) => {
            const file = e.target.files[0];
            props.onWidgetSort(props.index, { text: textValue.value, file });
        };

        return {
            textValue,
            onFileChange
        };
    }
};
</script>
