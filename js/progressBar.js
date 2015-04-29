/**
 * 
 */
/*
var maxprogress = 300;   // total à atteindre
var actualprogress = 0;  // valeur courante
var itv = 10;  // id pour setinterval
function prog() {
	
  if(actualprogress >= maxprogress) {
    clearInterval(itv);
    return;
}
  var progressnum = document.getElementById("progressnum");
  var indicator = document.getElementById("indicator");
	actualprogress += 0.1;	
	indicator.style.width=actualprogress + "px";
	progressnum.innerHTML = Math.round(actualprogress/10);
	if(actualprogress == maxprogress) clearInterval(itv);   
}*/
var timeout;
/*
var vale;
$(".textProblem").click(function() { 
	vale="3";
	alert(vale);
});
alert(vale);*/

$(function checkStatus() {
	//alert(vale);
    var progressbar = $( "#progressbar" ),
      progressLabel = $( ".progress-label" ),
	   progressFont = $( ".progress-font" );
	 var vale=$(".textProblem").attr('id');
	 $(".textProblem").click(function() { 
			vale="0";
		});
	 $(".reponse").click(function() { 
			vale="0";
		});

    
    progressbar.progressbar({
      value: true,
      change: function() {
        progressLabel.text( progressbar.progressbar( "value" ) + "s" );
      },
    });
 
    function progress() {
    	if(vale!=0){
	progressbar.progressbar({ max: 30 });
	
      var val = progressbar.progressbar( "value" ) || 31;
 
      progressbar.progressbar( "value", val - vale );
 
      if ( val >=7  && val<=16) {
	    setTimeout( progress, 1000 );
		$(".ui-widget-header").css("background-image","none");
		$(".ui-widget-header").css("background-color","orange");
      }
	  else if( val > 1 && val<=7){
		setTimeout( progress, 1000 );
		$(".ui-widget-header").css("background-image","none");
		$(".ui-widget-header").css("background-color","red");
	  }
	  else if( val > 1){
		setTimeout( progress, 1000 );
	  }
	  else{
		 progressLabel.text( "Temps écoulé!" );
		 alert("Vous avez perdu.");
		 window.location="/trivia/CQuestion/timeOut"; 
			
	  }
    }
    }
    setTimeout( progress, 1 );
  });


