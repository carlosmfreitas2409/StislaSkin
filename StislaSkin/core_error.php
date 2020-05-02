<?php if(Auth::LoggedIn()) { ?>
<script>
    $(window).load(function() {
        Swal.fire({
            title: 'Error!', 
            html: "<?php echo $message; ?>", 
            icon: "error"
        });
    })
</script>
<?php } else { ?>
<script>
    $(window).load(function() {
        Swal.fire({
            title: 'Error!', 
            html: "<?php echo $message; ?>", 
            icon: "error"
        }).then(function() {
            window.location = "<?php echo SITE_URL; ?>/index.php/login";
        });
    })
</script>
<?php } ?>