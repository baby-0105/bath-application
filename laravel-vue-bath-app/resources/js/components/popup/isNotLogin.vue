<template>
    <div :class="['popup', { flex: !hidePopup, hide: hidePopup }]" id="popup">
        <div class="content">
            <p class="text">まだ、ログインが完了していません。</p>
            <p class="text">ログインを完了させてください。</p>
            <button class="btn close" @click="close"></button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'hidePopup': {
                type: Boolean,
                default: true,
            }
        },
        methods: {
            close() {
                this.hidePopup = true;
            }
        }
    }
</script>