<!doctype html>

<html class="no-js" lang="en">
  <head>
      <meta charset="utf-8">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BiBlioPlus</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?> ">
<link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?> ">
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?> ">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.min.css'); ?> ">
         <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.theme.default.min'); ?> "> 
        
        <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Bevan|Carter+One|Fira+Sans+Extra+Condensed|Fjalla+One|Fredoka+One|Hind+Madurai|Oswald|Palanquin+Dark|Paytone+One|Ramabhadra|Suez+One" rel="stylesheet">
        <script src="https://cdn.ckeditor.com/4.9.2/iFR2sdA7u06vHJyyLlAd4snFpCl/ckeditor.js"></script>
  </head>

<body>
 <header>

       <div class="grid-container" > 

        <div class="grid-x ">
        <button class="menu-icon show-for-small-only"></button>   
                 <div class="cell medium-12 large-2  small-2" style="text-align:center;">
                  <div id="logo" ><img src="<?php echo base_url('assets/img/BPlogo.png'); ?>"  style="max-width:160px;"/></div>

                </div>
                
                <nav class="cell small-10 medium-9 large-8 ">

                  <ul class="  menu align-center"  id="nav_menu">
                    <li><a href="<?php echo base_url('login/index'); ?>"><i class="fas fa-home " ></i></a></li>
                    <li><a href="<?php echo base_url('collection/index'); ?>">Collection</a></li>
                    <li><a href="<?php echo base_url('auteur/index'); ?>">Auteurs</a></li>
                    <li><a href="<?php echo base_url('event/index'); ?>">Evenements</a></li> 
                    <li><a href="<?php echo base_url('forum/index'); ?>">Forum</a></li>
                  </ul>
                  
                </nav>

                 <div class="cell small-4  medium-2 large-2">
                  <section class="menu align-center" style="padding:0px;" id="search_login" >

                <li><a href="#" id="login"><i class="fas fa-user-circle  ">                   

              </i></a></li>                    

        <?php if ($this->session->userdata('pseudo') === NULL) { ?>
              <div  id="authen">
                <div id="box_authen">
                   <a href="<?php echo base_url('login/sign_in'); ?>"> 
                    <input type="button" name="login/sign_in" value="Connexion" class="fill_button" align="center" style="width:80%;margin:2px;" />
                   </a> 
                   <a href="<?php echo base_url('login/sign_up'); ?>"> 
                    <input type="button" name="login/sign_up" value="Nouveau compte" class="fill_button" align="center" />
                   </a>
                </div>
              </div>

              
        <?php } else { ?>


  <!-- user connect -->

  <div  id="authen">
  <div id="box_authen"> <!-- Drop down login_box -->
      <form>
        <div class="grid-container">
          <div class="grid-x padding-x">

            <div class="cell medium-12 ">
              <?php if(empty($_SESSION['photo'] )){ ?>
              <a href="http://localhost/biblioplus/auteur/info?id=<?php echo $this->session->userdata('idmembre'); ?>">
                <img src="<?php echo base_url('assets/avatar/avatar.png'); ?>" style="height: 120px; width: 120px; " class="circle_round" />
              </a>
              <?php } else {?>
              <a href="http://localhost/biblioplus/auteur/info?id=<?php echo $this->session->userdata('idmembre'); ?>">
                 <img class="circle_round" style="height: 120px; width: 120px; " src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" />
              <?php } ?>
            </a>
            </div>

            <div class="medium-12 cell">
              <h6><?php echo $_SESSION['pseudo']; ?> </h6>
             <a href="<?php echo base_url('account/logout'); ?>"> 
              <input type="button" name="account/logout" value="Deconnexion" class="fill_button" />
             </a> 
            </div> 

          </div>
        </div> <!-- end of container dropdown -->
      </form>
    </div>   
  </div><!-- end of dropdown_login  -->

  <!-- end user connect -->
<?php }  ?>   

<li><a id="search_button" ><i class="fas fa-search" ></i></a></li>
  <div id="search_box"><!-- Drop down search -->

<!-- <?php // echo form_open('rechercher/index',''); ?>  -->
<form>
<div id="search" > 

  <div class="grid-container">
    <div class="grid-x padding-x">  

      <div class="medium-12 cell">
        
        <input class="custom_input" type="text" placeholder="Rechercher" name="search"> 
        
      </div>
    </div>
  </div> 
</div>  
 <!-- <?php // echo form_close();  ?> -->
</form> 

       </div> <!-- End of dropdwown_search -->

     </section> <!-- end of section menu -->

              </div>

            </div>
             <!--end of grid-->
          </div><!--end of grid-container-header-->
      </header>

  </div>



<script src="<?php echo base_url('assets/node_modules/jquery/dist/jquery.js'); ?>  "></script>
<script src="<?php echo base_url('assets/node_modules/what-input/dist/what-input.js'); ?>  "></script>
<script src="<?php echo base_url('assets/node_modules/foundation-sites/dist/js/foundation.js'); ?>  "></script>
<script src="<?php echo base_url('assets/js/app.js'); ?> "></script>
<script src="<?php echo base_url('assets/js/cropper.min.js'); ?> "></script>
<script src="<?php echo base_url('assets/js/owl.carousel.min.js'); ?> "> 
</script>