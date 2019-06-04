<template>
    <div class="modal-content1">
        <div class="modal-header">
            <h5 class="modal-title">Upload</h5>
            <button type="button" class="close" @click.prevent="$emit('close')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="">
            <div class="">
                <div class="featured_image">
                    <img ref="image" :src="value" alt=""/>
                </div>

                <label for="image-picker" class="btn btn-primary btn-sm">Choose an image</label>
                <input type="file" id="image-picker" accept="image/*" @change="imageChosen" v-show="false">


            </div>
        </div>
        <div class="modal-footer">

            <button type="button" class="btn btn-light" @click.prevent="$emit('close')">Close</button>
            <button type="button" class="btn btn-primary" @click.prevent="upload">Upload</button>
        </div>
    </div>
</template>
<script>
    require('cropper');
    import {Bus} from '../../bus'
    export default {
        name: "ImageUploader",
        props: ['value', 'url'],
        data() {
            return {
                croppedImage: '',
                cropper: {},
                uploadDisabled: true,
            }
        },
        methods: {
            upload() {
                axios({
                    method: 'post',
                    url: 'settings/image',
                    data: {
                        image: this.croppedImage
                    },
                }).then((res) => {
                    if (res.data.success) {
                        Bus.$emit('pictureChanged', this.croppedImage);
                        this.$emit('close')
                        this.$toasted.show("Your profile picture has been changed", {
                            theme: "toasted-primary",
                            position: "top-right",
                            duration : 5000,
                            action : {
                                text: 'Close',
                                onClick: (e, toastObject) => {
                                    toastObject.goAway(0);
                                }
                            },
                        });
                    }
                }).catch((err) => {
                    console.log(err)
                })
            },
            cropped() {
                this.croppedImage = this.cropper.getCroppedCanvas().toDataURL();
            },
            imageChosen(event) {
                const _this = this
                const files = event.target.files
                const fileReader = new FileReader()
                fileReader.readAsDataURL(files[0])
                fileReader.onload = function () {
                    _this.updateImage(fileReader.result)
                    _this.$emit('input', fileReader.result)
                }
            },
            updateImage(res) {
                this.cropper.replace(res)
            },
        },
        mounted() {
            const _this = this;
            let $image = $(_this.$refs.image);
            $image.cropper({
                aspectRatio: 1,
                viewMode: 1,
                responsive: false,
                // resizable: true,
                // zoomable: false,
                zoomable: true,
                rotatable: true,
                minCropBoxHeight: 80,
                minCropBoxWidth: 80,
                // background:false,
                crop: _this.cropped,
            });
            this.cropper = $image.data('cropper');
        }
    }
</script>

<style scoped lang="scss">
    /*@import "~cropper/src/index.css";*/

    .featured_image {
        width: 400px;
        max-height: 500px;
        margin-right: auto;
        margin-left: auto;
    }
</style>