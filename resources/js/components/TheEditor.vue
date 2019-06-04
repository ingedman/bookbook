<template>
    <div class="container">
        <div class="title form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control my-2 bg-transparent h1 " id="title" v-model="title"
                   placeholder="Your great title goes here" style="font-size: 2.25rem;">
            <div class="invalid-feedback d-block" v-if="errors.title">
                {{ errors.title[0] }}
            </div>
        </div>
        <div class="book form-group">
            <label for="book">Book</label>
            <book-search id="book" v-model="bookId" :initial_book="initial_book"></book-search>

            <div class="invalid-feedback d-block" v-if="errors['book_id']">
                {{ errors['book_id'][0] }}
            </div>
        </div>

        <ckeditor :editor="editor" v-model="content" :config="editorConfig"></ckeditor>
        <div class="invalid-feedback d-block" v-if="errors.content">
            {{ errors.content[0] }}
        </div>
        <div class="d-flex my-3">
            <button class="btn btn-primary mr-2" @click="$refs.SaveReviewForm.submit()">Save</button>
            <button class="btn btn-danger" v-if="delete_review_url" @blur="isConfirmed = false" @click="deleteReview">
                {{ isConfirmed?'Are you sure?':'Delete' }}
            </button>

            <form ref="SaveReviewForm" action="" method="POST">
                <input type="hidden" name="title" :value="title">
                <input type="hidden" name="content" :value="content">
                <input type="hidden" name="book_id" :value="bookId">
                <input type="hidden" name="_token" :value="csrf">
            </form>

            <form ref="DeleteReviewForm" :action="delete_review_url||''" method="POST"
                  style="display: none;">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="_method" value="delete">
            </form>

        </div>
    </div>
</template>

<script>
    // todo: add csp headers
    import BookSearch from './BookSearch';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import CKEditor from '@ckeditor/ckeditor5-vue';

    export default {
        props: [
            'save_url',
            'initial_content',
            'initial_title',
            'initial_book',
            'delete_review_url',
            'csrf',
            'initial_errors'
        ],
        components: {
            ckeditor: CKEditor.component,
            BookSearch
        },
        data() {
            return {
                title: this.initial_title || '',
                bookId: this.initial_book ? this.initial_book.id : null,
                content: this.initial_content || '',
                isConfirmed: false,

                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                    toolbar: ['heading', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
                    heading: {
                        options: [
                            {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                            {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                            {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                        ]
                    },
                    autoGrow_minHeight: 500,
                    width: 200,
                },
                errors: this.initial_errors || {},
            }
        },
        methods: {
            save() {
                axios({
                    method: 'post',
                    url: window.location.href,
                    data: {
                        'title': this.title,
                        'content': this.content,
                        'book_id': this.bookId
                    }
                }).then((res) => {
                    if (res.data.success) {
                        window.location.href = '/home'
                        // todo: show toast after success
                    } else if (res.data.errors) {
                        this.errors = res.data.errors
                    }

                }).catch((err) => {
                    console.log('Error: ', err)
                })
            },
            deleteReview() {
                if (this.isConfirmed) {
                    this.$refs.DeleteReviewForm.submit()
                } else {
                    this.isConfirmed = true
                }
            }
        },
    }
</script>

<style>
    .ck-editor__editable {
        min-height: 350px;
    }
</style>