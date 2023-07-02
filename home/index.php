<?php 
  
  include("../home/header.php");    
   
?>

<!-- SERVICES -->

<section class="wrapper pt-5">

<div class="container align-items-center" id="container">
   <div class="row g-4 text-center ">

       <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 " id="card-content">
       <a href="../userSubmitArchive/submit_archive.php" class="text-decoration-none">
           <div class="card text-light align-items-center" id="card">
               <div class="card-body text-center">
                   <div class="h1 mb-3">
                       <i class="bi bi-file-earmark-arrow-down-fill card-icon"></i>
                   </div>
                   <h6 class="card-title  p-3 fw-bolder"id="card-title">
                       Submit your <br> Academic Research
                   </h6>
               </div>
           </div>
           </a>
       </div>

       <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" id="card-content">
        <a href="../home/guidelines.php" class="text-decoration-none">
           <div class="card text-light align-items-center" id="card">
               <div class="card-body text-center">
                   <div class="h1 mb-3">
                       <i class="bi bi-bar-chart-steps card-icon"></i>
                   </div>
                   <h6 class="card-title   p-3   fw-bolder"id="card-title">
                       Admission of <br> Research Guidelines
                   </h6>
               </div>
           </div>
           </a>
       </div>

       <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" id="card-content">
       <a href="../viewerArchive/mainArchivePage.php" class="text-decoration-none">
           <div class="card pb-2 text-light align-items-center"id="card">
               <div class="card-body text-center">
                   <div class="h1 mb-3">
                       <i class="bi bi-book-half card-icon"></i>
                   </div>
                   <h6 class="card-title  p-4 fw-bolder" id="card-title">
                      Research Archiving
                   </h6>
               </div>
           </div>
       </div>

       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="card-content">
       <a href="../home/guidelines.php" class="text-decoration-none text-light">
           <div class="card  text-light align-items-center"id="card">
               <div class="card-body text-center ">
                   <div class="h1 mb-3">
                       <i class="bi bi-list-check card-icon"></i>
                   </div>
                   <h6 class="card-title  p-3  fw-bolder"id="card-title">
                       Requirements <br> for the Registration
                   </h6>
               </div>
           </div>
           </a>
       </div>

       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="card-content">
        <a href="../home/events.php" class="text-decoration-none">
           <div class="card text-light      align-items-center"id="card">
               <div class="card-body text-center">
                   <div class="h1 mb-3">
                       <i class="bi bi-calendar2-check-fill card-icon"></i>
                   </div>
                   <h6 class="card-title p-4 fw-bolder"id="card-title">
                       Research Conference
                   </h6>
               </div>
            </div>
          </a>
       </div>

      
   </div>
</div>
</section>

<!-- About -->

<section class="pt-5" id="About">
   <div class="parallax-image">
       <div class="color-overlay d-flex justify-content-center  flex-column  text-center pt-4" style=" width: 100%;
    height: 70vh;
    background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(../images/National-Teachers-College.jpg);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position: relative;
    margin-bottom: 50px;
    color: rgb(252, 217, 217);" >
           <h4 class="text-center fw-bolder">ACADEMICS RESEARCH ARCHIVE @ NTC</h4>

           <p class="about-paragraph text-center ">This is an unofficial Academic Research Archiving of 
               the National Teachers College. <br> This website is exlusive 
               for NTC students, alumni, and teachers only.
           </p>
           
       </div>
      
   </div>
</section>  


<?php
 include "../home/footer.php";
?>