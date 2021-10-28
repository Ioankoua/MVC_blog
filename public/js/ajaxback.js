$('#kek').click(function(){
   $.ajax({ 
         type: "POST",
         url: "like",
         data: ('#back').serialize(),
         success: function(response) {
            $('#zdes_tablica_result_div').html(response);
         }
   })
});