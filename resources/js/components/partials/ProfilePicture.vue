<template>
    <img
            class="rounded-circle"
            :src="imgUrl"
            :width="width"
            alt="profile picture"
    >
</template>

<script>
    import {Bus} from '../../bus'
    export default {
        name: "ProfilePicture",
        props:['width','src',],
        data() {
            return {
                imgUrl: this.src
            }
        },
        mounted() {
            Bus.$on('pictureChanged' ,path =>{
                this.imgUrl = path
            })
        },
    }
</script>