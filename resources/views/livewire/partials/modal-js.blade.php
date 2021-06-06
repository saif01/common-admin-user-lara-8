<script>

    window.addEventListener('closeModal', event => {
        // console.log(event);
        $("#dataAddModal").modal('hide');                
    });

    window.addEventListener('openModal', event => {
        // console.log(event);
        $("#dataAddModal").modal('show');                
    });

</script>