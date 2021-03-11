$('.date').datepicker({
    format: "dd/mm/yyyy",
    language:"pt-BR", 
    startDate:"+0"
});

// Timer for errors
$(document).ready(function () {
    window.setTimeout(function() {
      $(".alert-danger").fadeTo(1000, 0).slideUp(1000, function(){
          $(this).remove(); 
      });
    }, 2000);
});

//pass data to modal

// $(".btn-success").on("click", function() {
//     var object = "teste" + $(this).data('id').val();
//     $(".modal-body").html(object);
// });
