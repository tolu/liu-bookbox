	$(function() {


  $("#searchFieldInput").keyup(function(event)
  {
    var key = event.charCode ? event.charCode : event.keyCode ? event.keyCode : 0;
    //alert(key);
    if( key != 13 && $("#searchFieldInput").attr("value").length > 2)
    {
      //
      var searchPath = $("#searchForm").attr("action");
      var testsearchPath = searchPath.replace(/ /g,"_");
    
      $("#searchFieldResult").load(testsearchPath, {"searchString": $("#searchFieldInput").attr("value") ,"searchType": "WRITING"});
    }
    else
    {
    	$("#searchFieldResult").html("");
    }
  });
  
  //action to be performed when enter is pressed!
  $("#searchForm").submit(function(){
  	
    var searchPath = $("#searchForm").attr("action");
    $("#content").load(searchPath, {"searchString": $("#searchFieldInput").attr("value") ,"searchType": "ENTER"});
    $("#searchFieldResult").html("");
    return false;
  });
  
   $(".searchFieldItem").live("click",function(){
  	
    var searchPath = $(this).attr("href");
    var searchString =$(this).attr("id");
    $("#content").load(searchPath, {"searchString": searchString ,"searchType": "ENTER"});
    $("#searchFieldResult").html("");
    return false;
  });

  $("#searchFieldResultClearBtn").click(function (){
  	$("#searchFieldResult").html("");
  	$("#searchFieldInput").val("");
  });
  
  
//  $("#searchFieldInput").change( function(){
  	//	$("#searchFieldResult").html("");

//  });
		

	});