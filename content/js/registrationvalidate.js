
 $(document).ready(function(){
$("#valid").hide();
  $("#regisdescription").hide();
  $("#regiscity").hide();
   $("#regisplace").hide();
   $("#regislocation").prop( "disabled", true );
   $("#regisaddon").prop( "disabled", true );
   $("#costdetail").hide();
      $("#regispackage").change(function(){
        $("#regislocation").prop( "disabled", false );
        $("#regisaddon").prop( "disabled", false );
        $("#costdetail").show();
  var p = $("#regispackage").val();
  var p300 = "Groovy Home 300";
  var p350 = "Groovy Home 300";
  var p750 = "Groovy Home 300";
  var p500 = "Groovy Home 500";
  var p800 = "Groovy Home 800";
  var p1700 = "Groovy Home 1700";
  if (p == p300){
    $("#coststb").hide();
  } else if (p == p750){
    $("#coststb").show();
  }
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
