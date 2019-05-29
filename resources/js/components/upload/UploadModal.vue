<template>
    <div>
        <!-- Modal -->
        <modal name="upload"
               :width="600"
               height="auto"
               :adaptive="true"
               @before-open="beforeOpen"
               @close="closeModal"
        >

                    <image-uploader v-model="selectedImage" @close="closeModal"></image-uploader>


        </modal>

    </div>
</template>

<script>
    import ImageUploader from './ImageUploader'

    export default {
        name: 'UploadModal',
        components:{ImageUploader},
        data() {
            return {
                selectedImage: '',
                url:'',

            }
        },
        methods: {
            beforeOpen(event) {
                // console.log(event.params.url);
                this.url = event.params.url
            },
            closeModal() {
                this.$modal.hide('upload')
            },

        },
    }
</script>
