<script>
    $(document).ready(function() {
        Swal.fire({
            title: 'Gagal',
            text: '{{ $message }}',
            icon: 'error'
        })
    })
</script>