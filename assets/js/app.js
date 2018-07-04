$(document).ready(function(){
$(document).foundation();
$(".ouvrage").hover (function(e){

$("#info_ouvrage").show(200);

});

$("#login").click(function(e){
 
	$("#nav_menu").hide();

$("#search").hide();	



$("#nav_menu").hide(10);


$("#search").hide(100);	




$("#box_authen").slideToggle(500);
});


$("#search_button").click(function(e){
$("#nav_menu").hide(10);
$("#box_authen").hide(100);
$("#search").slideToggle(500);



});
$("#nouveauSujet").click(function(e){
$("#nouveau_sujet_view").slideToggle(300);

})
$("#ajouterSujet").click(function(e){
$("#box_authen").slideDown(300);

})

 



// Resnponsive
$(".menu-icon").click(function(e){
	$("#search").hide(10);


$("#xox").hide(100);
    

$("#xox").hide(100);
    


$("#box_authen").hide(100);

  




$("#nav_menu").slideToggle(400);

});

$("#connecter").click(function(e){
   e.preventDefault();
   if(   ($("#mot_de_passe").val()=='') && ($("#pseudo").val()=='')){
    $("#temp").text("Veuillez remplir tous les champs").css("color","red");

   }

});



$('.owl-carousel').owlCarousel({
    // loop:true,
    margin:5,
    nav:true,
    center:true,
    autoplay:true,
   
    responsive:{
        0:{
            items:1
        },

        330:{
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





