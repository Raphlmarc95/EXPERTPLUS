$(document).ready(function(){
$(document).foundation();


$("#login").click(function(e){

$("#search").hide(100);	

 $("#xox").slideToggle(350);

});


$("#search_button").click(function(e){
$("#user").hide(100);
$("#nav_menu").hide(10);

$("#search").slideToggle(500);

});



// Resnponsive


$(".menu-icon").click(function(e){
	$("#search").hide(10);


$("#nav_menu").slideToggle(400);

});

$("#connecter").click(function(e){
   e.preventDefault();
   if(   ($("#mot_de_passe").val()=='') && ($("#pseudo").val()=='')   ){
    $("#temp").text("Veuillez remplir tous les champs").css("color","red");

   }

});



$('.owl-carousel').owlCarousel({
    loop:true,
    margin:5,
    nav:true,
    
   
    responsive:{
        0:{
            items:1
        },

        300:{
            items:2
        },
        600:{
            items:3
        },

        800:{
            items:4
        },

        1000:{
            items:5
        }
    }
})

});



