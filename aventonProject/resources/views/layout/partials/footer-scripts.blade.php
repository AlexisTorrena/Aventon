<!-- Bootstrap core JavaScript
================================================= -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
<script type="text/javascript">
  $(function () {
    jQuery.datetimepicker.setLocale('es');
        $('#startDate').datetimepicker(
          {
            timepicker:false,
            mask:true,
            format:'d/m/Y',
            lang:'es',
            minDate:0
          }
        );
        $('#endDate').datetimepicker(
          {
            timepicker:false,
            mask:true,
            format:'d/m/Y',
            lang:'es',
            minDate:0,
            onShow:function( ct ){
                this.setOptions({
                minDate:jQuery('#startDate').val()?jQuery('#startDate').val():false,
                formatDate:'d/m/Y'
                       })
                }
          }
        );
    });

</script>
<script type="text/javascript">
  $(function () {
              $('#startTime').datetimepicker({
                datepicker:false,
                format:'H:i'
              });
          });

</script>
<script type="text/javascript">
  // Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
<script>
    function showEndCalendar() {
      var e = document.getElementById("periodicity");
      var periodicity = e.options[e.selectedIndex].value;

      if ( periodicity == 'Diaria' || periodicity == 'Semanal' || periodicity == 'Mensual')
      {
        $("#endDate").prop('disabled', false);
      }
      else
      {
        $("#endDate").prop('disabled', true);
      }
    }
    </script>