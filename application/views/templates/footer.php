<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Website Manajemen Proyek <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/calendar/dist/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/calendar/dist/cal-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<style>
    .post {
        border-bottom: 1px solid #adb5bd;
        color: #666;
        margin-bottom: 15px;
        padding-bottom: 15px;
    }

    .post:last-of-type {
        border-bottom: 0;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .post .user-block {
        margin-bottom: 15px;
        width: 100%;
    }

    .post .row {
        width: 100%;
    }

    .small-box {
        border-radius: 0.25rem;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
        display: block;
        margin-bottom: 20px;
        position: relative;
    }

    .small-box>.inner {
        padding: 10px;
    }

    .small-box>.small-box-footer {
        background-color: rgba(0, 0, 0, 0.1);
        color: rgba(255, 255, 255, 0.8);
        display: block;
        padding: 3px 0;
        position: relative;
        text-align: center;
        text-decoration: none;
        z-index: 10;
    }

    .small-box>.small-box-footer:hover {
        background-color: rgba(0, 0, 0, 0.15);
        color: #fff;
    }

    .small-box h3 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0 0 10px;
        padding: 0;
        white-space: nowrap;
    }

    @media (min-width: 992px) {

        .col-xl-2 .small-box h3,
        .col-lg-2 .small-box h3,
        .col-md-2 .small-box h3 {
            font-size: 1.6rem;
        }

        .col-xl-3 .small-box h3,
        .col-lg-3 .small-box h3,
        .col-md-3 .small-box h3 {
            font-size: 1.6rem;
        }
    }

    @media (min-width: 1200px) {

        .col-xl-2 .small-box h3,
        .col-lg-2 .small-box h3,
        .col-md-2 .small-box h3 {
            font-size: 2.2rem;
        }

        .col-xl-3 .small-box h3,
        .col-lg-3 .small-box h3,
        .col-md-3 .small-box h3 {
            font-size: 2.2rem;
        }
    }

    .small-box p {
        font-size: 1rem;
    }

    .small-box p>small {
        color: #f8f9fa;
        display: block;
        font-size: .9rem;
        margin-top: 5px;
    }

    .small-box h3,
    .small-box p {
        z-index: 5;
    }

    .small-box .icon {
        color: rgba(0, 0, 0, 0.15);
        z-index: 0;
    }

    .small-box .icon>i {
        font-size: 90px;
        position: absolute;
        right: 15px;
        top: 15px;
        transition: transform 0.3s linear;
    }

    .small-box .icon>i.fa,
    .small-box .icon>i.fas,
    .small-box .icon>i.far,
    .small-box .icon>i.fab,
    .small-box .icon>i.fal,
    .small-box .icon>i.fad,
    .small-box .icon>i.ion {
        font-size: 70px;
        top: 20px;
    }

    .small-box .icon svg {
        font-size: 70px;
        position: absolute;
        right: 15px;
        top: 15px;
        transition: transform 0.3s linear;
    }

    .small-box:hover {
        text-decoration: none;
    }

    .small-box:hover .icon>i,
    .small-box:hover .icon>i.fa,
    .small-box:hover .icon>i.fas,
    .small-box:hover .icon>i.far,
    .small-box:hover .icon>i.fab,
    .small-box:hover .icon>i.fal,
    .small-box:hover .icon>i.fad,
    .small-box:hover .icon>i.ion {
        transform: scale(1.1);
    }

    .small-box:hover .icon>svg {
        transform: scale(1.1);
    }

    .user-block {
        float: left;
    }

    .user-block img {
        float: left;
        height: 40px;
        width: 40px;
    }

    .user-block .username,
    .user-block .description,
    .user-block .comment {
        display: block;
        margin-left: 50px;
    }

    .user-block .username {
        font-size: 16px;
        font-weight: 600;
        margin-top: -1px;
    }

    .user-block .description {
        color: #6c757d;
        font-size: 13px;
        margin-top: -3px;
    }

    .user-block.user-block-sm img {
        width: 1.875rem;
        height: 1.875rem;
    }

    .user-block.user-block-sm .username,
    .user-block.user-block-sm .description,
    .user-block.user-block-sm .comment {
        margin-left: 40px;
    }

    .user-block.user-block-sm .username {
        font-size: 14px;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        background-color: transparent;

    }
</style>
<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/') ?>" + roleId;
            }
        })
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $(document).ready(function() {
        $('#lists').dataTable()
    })
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ol', 'ul', 'paragraph', 'height']],
            ['table', ['table']],
            ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
        ]
    })
    window.start_load = function() {
        $('body').prepend('<div id="preloader2"></div>')
    }
    window.end_load = function() {
        $('#preloader2').fadeOut('fast', function() {
            $(this).remove();
        })
    }
    window.viewer_modal = function($src = '') {
        start_load()
        var t = $src.split('.')
        t = t[1]
        if (t == 'mp4') {
            var view = $("<video src='" + $src + "' controls autoplay></video>")
        } else {
            var view = $("<img src='" + $src + "' />")
        }
        $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
        $('#viewer_modal .modal-content').append(view)
        $('#viewer_modal').modal({
            show: true,
            backdrop: 'static',
            keyboard: false,
            focus: true
        })
        end_load()

    }
    window.uni_modal = function($title = '', $url = '', $size = "") {
        start_load()
        $.ajax({
            url: $url,
            error: err => {
                console.log()
                alert("An error occured")
            },
            success: function(resp) {
                if (resp) {
                    $('#uni_modal .modal-title').html($title)
                    $('#uni_modal .modal-body').html(resp)
                    if ($size != '') {
                        $('#uni_modal .modal-dialog').addClass($size)
                    } else {
                        $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#uni_modal').modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false,
                        focus: true
                    })
                    end_load()
                }
            }
        })
    }
    window._conf = function($msg = '', $func = '', $params = []) {
        $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
        $('#confirm_modal .modal-body').html($msg)
        $('#confirm_modal').modal('show')
    }
    window.alert_toast = function($msg = 'TEST', $bg = 'success', $pos = '') {
        var Toast = Swal.mixin({
            toast: true,
            position: $pos || 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
        Toast.fire({
            icon: $bg,
            title: $msg
        })
    }
</script>
<script type="text/javascript">
    $(function() {
        $('.mydatetimepicker').datepicker({
            format: "mm-yyyy",
            viewMode: "years",
            minViewMode: "months"
        });
    });
    $(function() {
        $('.mydatetimepickerFull').datepicker({
            format: "dd-mm-yyyy",
            todayHighlight: true,
            autoclose: true,
            orientation: 'bottom'
        });

    });
</script>
<script>
    $(function() {
        $('#datetimepicker2').datetimepicker({
            language: 'en',
            pick12HourFormat: true
        });
    });
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Please select here",
            width: "100%"
        });
    })
</script>
</body>

</html>