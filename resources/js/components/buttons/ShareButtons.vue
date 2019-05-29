<template>
    <div class="d-flex">
        <div class=" d-flex px-0 flex-column align-items-center justify-content-end  hidden-sm-down">
            <a class="btn"
               target="blank"
               :href="`https://www.facebook.com/sharer/sharer.php?u=${url}`"
               data-toggle="tooltip"
               data-placement="bottom"
               title="Share with facebook"
            >
                <i class="fab fa-facebook-f line-height-initial"></i>
            </a>
        </div>
        <div class=" d-flex px-0 flex-column align-items-center justify-content-end  hidden-sm-down">
            <a class="btn"
               target="blank"
               :href="`https://twitter.com/intent/tweet?url=${url}`"
               data-toggle="tooltip"
               data-placement="bottom"
               title="Share with twitter">
                <i class="fab fa-twitter line-height-initial"></i>
            </a>
        </div>
        <div class=" d-flex px-0 flex-column align-items-center justify-content-end hidden-md-up">

            <div class="dropdown">
                <a class="btn" role="button" id="shareDropdownMenuButton" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-share-alt line-height-initial"></i>
                </a>
                <div class="dropdown-menu shareDropdownMenuButton " aria-labelledby="shareDropdownMenuButton">

                    <a class="dropdown-item" target="blank"
                       :href="`https://www.facebook.com/sharer/sharer.php?u=${url}`"> <i
                            class="fab fa-facebook-f line-height-initial"></i></a>
                    <a class="dropdown-item" target="blank"
                       :href="`https://twitter.com/intent/tweet?url=${url}`"> <i
                            class="fab fa-twitter line-height-initial"></i></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['url'],
    }
</script>
<style scoped>
    .shareDropdownMenuButton {
        min-width: auto;
        width: auto;
    }

</style>
