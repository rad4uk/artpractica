<template>
    <div class="double-widget" v-draggable>
        <input type="text" v-model="textValue">
        <input type="file" @change="onFileChange1">
        <input type="file" @change="onFileChange2">
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
        file1: {
            type: File,
            default: null
        },
        file2: {
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

        const onFileChange1 = (e) => {
            const file1 = e.target.files[0];
            props.onWidgetSort(props.index, { text: textValue.value, file1, file2: props.file2 });
        };

        const onFileChange2 = (e) => {
            const file2 = e.target.files[0];
            props.onWidgetSort(props.index, { text: textValue.value, file1: props.file1, file2 });
        };

        return {
            textValue,
            onFileChange1,
            onFileChange2
        };
    }
};
</script>
