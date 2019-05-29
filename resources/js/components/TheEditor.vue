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
            <book-search id="book" v-model="bookId" :initial_book="initial_book" ></book-search>

            <div class="invalid-feedback d-block" v-if="errors['book_id']">
                {{ errors['book_id'][0] }}
            </div>
        </div>

        <ckeditor :editor="editor" v-model="content" :config="editorConfig"></ckeditor>
        <div class="invalid-feedback d-block" v-if="errors.content">
            {{ errors.content[0] }}
        </div>

        <button class="btn btn-primary" @click="save">Save</button>
    </div>
</template>

<script>
    // todo: add csp headers
    import BookSearch from './BookSearch';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import CKEditor from '@ckeditor/ckeditor5-vue';

    export default {
        props: ['save_url', 'initial_content', 'initial_title','initial_book'],
        components: {
            ckeditor: CKEditor.component,
            BookSearch
        },
        data() {
            return {
                title: this.initial_title ? this.initial_title : '',
                bookId: this.initial_book ? this.initial_book.id : null,
                content: this.initial_content ? this.initial_content : '',

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
                },
                errors: {},
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
                    console.log(res.data)
                    if (res.data.success) {
                        console.log('success')
                        window.location.href = '/home'
                        // todo: show toast after success
                    } else if (res.data.errors) {
                        console.log('error')

                        this.errors = res.data.errors
                    }

                }).catch((err) => {
                    console.log('Error: ', err)
                })
            }
        },
        computed:{

        },
        created() {
            // this.editor.data.processor = new GFMDataProcessor();
        }
    }
</script>
