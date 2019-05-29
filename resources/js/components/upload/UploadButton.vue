<template>
    <div class="d-flex flex-column align-items-center mb-3">

        <profile-picture :src="img_url" width="120" class="rounded-circle mx-auto mb-2"></profile-picture>
        <button class="btn btn-outline-primary py-0" @click="openModal">Upload</button>
    </div>

</template>
<script>
    export default {
        name: "UploadButton",
        props: ['img_url'],
        methods: {
            openModal() {
                this.$modal.show('upload')
            },
        },

    }
</script>