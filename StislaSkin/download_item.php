<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="alert alert-success alert-has-icon">
            <div class="alert-icon">
                <i class="far fa-lightbulb"></i>
            </div>
            <div class="alert-body">
                <div class="alert-title">Redirecting!</div>
                Your download will start in a few seconds, or <a href="<?php echo $download->link;?>">click here to manually start.</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"> 
    window.location = "<?php echo $download->link;?>";
</script>