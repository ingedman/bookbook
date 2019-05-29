<template>
    <div class="d-flex justify-content-between">
        <like-buttons :model="book"></like-buttons>
        <div class="d-flex">
            <share-buttons :url="book.url"></share-buttons>

            <div class=" d-flex px-0 flex-column align-items-center justify-content-end">
                <div class="btn-group dropdown">
                    <a role="button" class="btn focus-shadow-0 focus-outline-0"
                       id="dropdownMenuButton"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h  line-height-initial "></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right"
                         aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" role="button" @click="openModal">Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShareButtons from './buttons/ShareButtons'
    import LikeButtons from './buttons/LikeButtons'

    export default {
        props: ['book', 'index'],
        components: {LikeButtons, ShareButtons},
        methods: {
            openModal() {
                this.$modal.show('report', {url: this.book.reportUrl})
            },
        },
    }
</script>
