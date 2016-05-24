
 $(document).ready(function(){
$("#valid").hide();
  $("#regisdescription").hide();
  $("#regiscity").hide();
   $("#regisplace").hide();
   $("#regislocation").prop( "disabled", true );
   $("#regisaddon").hide();
      $("#regispackage").change(function(){
        $("#regislocation").prop( "disabled", false );
        var p =  $("#regispackage").val();
        <?php $p = p; ?>
          $("#regisaddon").show();
 })
     $("#regislocation").change(function(){
      var d =  $("#regisemail").val();
      var a =  $("#regislocation").val();
      var b = "0";
if (a == b) {
      $("#regisplace").show();
      $("#regisdescription").hide();
      $("#regiscity").show();
      $("#regisdescription").val('');

} else {
   $("#regisplace").hide();
   $("#regisdescription").show();
      $("#regiscity").hide();
      $("#regiscity").val('City');
      $("#regisplace").val('');
}})
      $("#textalasantermination").hide();
      $("#selectalasantermination").change(function(){
        var a =  $("#selectalasantermination").val();
        var b = "Other";
        if (a == b){
          $("#textalasantermination").show();
        } else {
          $("#textalasantermination").hide();
        }
  })
      });
