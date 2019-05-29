<template>
    <div class="d-flex justify-content-between">
        <like-buttons :model="review"></like-buttons>
        <div class="d-flex ">
            <div class="d-flex px-0 flex-column align-items-center">
                <div>{{review.comments.count}}</div>
                <a :href="review.comments_url" role class="btn" data-toggle="tooltip" data-placement="bottom"
                   title="Comments">
                    <i class="far fa-comment line-height-initial"></i>
                </a>
            </div>

            <share-buttons :url="review.url"></share-buttons>

            <div class="d-flex px-0 flex-column align-items-center justify-content-end hidden-md-down1">
                <bookmark-button
                        :bookmarked="bookmarked"
                        :url="review.bookmarkUrl"
                ></bookmark-button>
            </div>
            <div class="d-flex px-0 flex-column align-items-center justify-content-end">
                <div class="btn-group dropdown">
                    <a role="button" class="btn focus-shadow-0 focus-outline-0"
                       id="dropdownMenuButton"
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
    import ReportModal from './ReportModal'
    import ShareButtons from './buttons/ShareButtons'
    import BookmarkButton from './buttons/BookmarkButton'

    import LikeButtons from './buttons/LikeButtons'


    export default {
        props: ['review', 'index'],
        components: {ReportModal, ShareButtons, BookmarkButton, LikeButtons},
        data() {
            return {
                bookmarked: this.review.bookmarked,
            }
        },
        methods: {
            openModal() {
                this.$modal.show('report', {url: this.review.reportUrl})
            },
        },
    }
</script>
