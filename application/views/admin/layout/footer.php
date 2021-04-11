</div>
<!-- END wrapper -->


<!-- Vendor js -->
<script src="<?= base_url('assets/') ?>js/vendor.min.js"></script>

<!-- knob plugin -->
<script src="<?= base_url('assets/') ?>libs/jquery-knob/jquery.knob.min.js"></script>

<!--Morris Chart-->
<script src="<?= base_url('assets/') ?>libs/morris-js/morris.min.js"></script>
<script src="<?= base_url('assets/') ?>libs/raphael/raphael.min.js"></script>

<!-- Dashboard init js-->
<script src="<?= base_url('assets/') ?>js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="<?= base_url('assets/') ?>js/app.min.js"></script>

<!-- dropify -->
<script src="<?= base_url('assets/') ?>libs/fileuploads/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong appended.'
        },
        error: {
            'fileSize': 'The file size is too big (1M max).'
        }
    });
</script>
</body>

</html>