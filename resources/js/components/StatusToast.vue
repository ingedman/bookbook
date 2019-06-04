<template>
    
</template>

<script>
    export default {
        name: "StatusToast",
        props:['status'],
        mounted() {
            this.$toasted.show(this.status, {
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
    }
</script>

<style scoped>

</style>