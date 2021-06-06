{{-- <!-- Summernote Editor JS--> --}}
<script src="{{ asset('all-assets/common/summernote/summernote-bs4.min.js') }}"></script>
<script>

    // Summernote edit value clear
    window.addEventListener('editorTextClear', event => {
        // console.log(event);
        $("#customTextEditor").summernote("code", '');   
    });

    // Summernote edit value added
    window.addEventListener('editorText', event => {
        // console.log(event);
        $("#customTextEditor").summernote("code", event.detail.messege);   
    });

    // Summernote   
    $('#customTextEditor').summernote({
        placeholder: 'Write Detail about this issue.',
        tabsize: 5,
        height: 150,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        codemirror: {
            theme: 'monokai'
        },
        callbacks: {
            onChange: function(contents, $editable) {
                @this.set('details', contents);
            }
        }
    });

       
</script>