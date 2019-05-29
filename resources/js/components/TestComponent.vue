<template>
    <div class="f">adf</div>
</template>

<script>
    export default {
        name: "TestComponent",
        props:['user'],
        mounted() {
            console.log('user: ',this.user)
        }
    }
</script>

<style scoped>

</style>