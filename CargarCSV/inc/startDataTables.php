<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            "columnDefs": [{
                "targets": -1,
                "orderable": false
            }],
            "language": {
                "url": "json/Spanish.json"
            }
        });
    });
</script>