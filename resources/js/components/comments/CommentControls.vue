<template>
    <div class="d-flex justify-content-between">
        <like-buttons :model="comment"></like-buttons>
        <div class="d-flex">
            <div class="d-flex px-0 flex-column align-items-center" v-if="!reply">
                <div>{{comment.replies.count}}</div>
                <a role="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                   title="Comments" @click="$emit('click_comments')">
                    <i class="far fa-comment line-height-initial"></i>
                </a>
            </div>

            <div class="d-flex px-0 flex-column align-items-center justify-content-end">
                <div class="btn-group dropdown">
                    <a role="button" class="btn focus-shadow-0 focus-outline-0" id="dropdownMenuButton"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h  line-height-initial "></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" role="button" @click="openModal">Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LikeButtons from '../buttons/LikeButtons'

    export default {
        props: ['comment', 'reply'],
        components: {LikeButtons},
        data() {
            return {
                reportContent: '',
            }
        },
        methods: {
            openModal() {
                this.$modal.show('report', {url: this.comment.reportUrl})
            },
        },
    }
</script>

<style>
    .shareDropdownMenuButton {
        min-width: auto;
        width: auto;
    }
</style>
