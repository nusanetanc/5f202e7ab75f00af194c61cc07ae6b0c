
 $(document).ready(function(){
$("#valid").hide(); 
  $("#regisdescription").hide(); 
  $("#regiscity").hide(); 
   $("#regisplace").hide(); 
      $("#regispackage").change(function(){
        $("#regislocation").prop( "disabled", false );
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
      });