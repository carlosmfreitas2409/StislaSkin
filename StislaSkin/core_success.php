<script>
    $(window).load(function() {
        Swal.fire({
            title: 'Success!', 
            html: "<?php echo $message; ?>", 
            icon: "success"
        });
    })
</script>