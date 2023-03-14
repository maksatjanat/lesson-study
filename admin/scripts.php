<script type="application/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
<script type="application/javascript" src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script type="application/javascript">
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script type="application/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="application/javascript" src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script type="application/javascript" src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="application/javascript" type="text/javascript" src="plugins/clockpicker-gh-pages/dist/bootstrap-clockpicker.min.js"></script>
<script type="application/javascript" src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="application/javascript" src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script type="application/javascript" src="dist/js/script.js"></script>
<script type="application/javascript" src="dist/js/pages/dashboard.js"></script>

<!-- Цветовое оформление <script src="dist/js/demo.js"></script> -->

<!-- data table -->

<script type="application/javascript" src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script type="application/javascript" src="bower_components/datatables.net-bs/js/dataTables.bootstrap.js"></script>

<!-- end data table --> 

<script type="application/javascript" src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="application/javascript" src="plugins/input-mask/jquery.inputmask.js"></script>
<script type="application/javascript" src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script type="application/javascript" src="plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="application/javascript" src="bower_components/ckeditor/ckeditor.js"></script>
<script type="application/javascript" src="plugins/bootstrap-fileinput-master/js/fileinput.js"></script>
<script type="application/javascript" src="plugins/bootstrap-fileinput-master/js/locales/ru.js"></script>

<script type="application/javascript">
  $("#myfile").fileinput({
      language: "ru",
      allowedFileExtensions: ["jpg", "png", "gif", "pdf", "docx", "txt", "pptx", "ppt", "doc", "xls", "xlsx"]
  });
</script>

<script type="application/javascript">
  $(function () {
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
    CKEDITOR.replace('editor3')
    CKEDITOR.replace('editor4')
    CKEDITOR.replace('editor5')
    $('.textarea').wysihtml5()

    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    })
  })
</script>

<script type="application/javascript">
  $(function () {

    $('.datatable').DataTable({
        'autoWidth'   : false,
    })

  })
</script>
<script type="application/javascript">
  $('[data-mask]').inputmask()

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

<script type="application/javascript">
  $("#wizard-picture").change(function(){
    readURL(this);
  });
</script>

<script type="application/javascript"> 
  $(function () {
    //Initialize Select2 Elements
    $('#select').select2()
    $('.select').select2()

    $('.select_report').select2()

    $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy',
      startDate: '0d',
      startView: 0,
      minView: 2,
      weekStart: 1
    })

  });
</script>