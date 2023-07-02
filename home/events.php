<?php 
 
include '../home/header.php';

?>


<link rel="stylesheet" href="../home/main.css">


<style>
    /* Event */

    @media (max-width:400px){
        #card-event {
            align-items: center;
            justify-content: center;
        }
        #card-body {
            height: 25vh!important;
        }
        #card-body #bg-image {
            background-size: contain!important;
            padding-top: 1rem!important;
        }

        #cardEvent-content{
            margin-top: 0rem!important;
            height: 50%!important;
        }
    }
    @media (max-width: 576px) {
        #card-event {
            align-items: center;
            justify-content: center;
        }
        #card-body {
            height: 30vh!important;
        }
        #card-body #bg-image {
            background-size: contain!important;
            padding-top: 1rem!important;
        }

        #cardEvent-content{
            margin-top: 2rem!important;
            height: 50%!important;
        }
    }

    @media (min-width: 577px) and (max-width: 1300px) {
        #card-body {
            height: 30vh!important;
        }
        #card-body #bg-image {
            background-size: contain!important;
            padding-top: 2rem!important;
        }
    }

    @media (min-width: 800px) and (max-width: 992px) {
        #card-body {
            height: 30vh!important;
        }
        #card-body #bg-image {
            background-size: contain!important;
            padding-top: 1rem!important;
        }
    }

    @media (min-width: 993px) {
        #card-body {
            height: 70vh;
        }
    }
</style>

<div class="container mb-5">
    <div class="title">
        <h3 class="text-primary mt-5">Upcoming Events</h3>
        <hr>
    </div>

    <div class="card d-flex flex-column align-items-end justify-content-end h-100 border-0 " id="card-event">
        <div class="w-100 border-0 d-flex" style="height: 60vh;" id="card-body">
            <div class="pt-2" style="background-image: url(../images/bg.svg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 100%; width: 100%;" id="bg-image">
                <div class="container h-100 w-100" id="cardEvent-content">
                    <div class="col d-flex flex-column justify-content-start align-items-end">
                        <a href="../home/reservation.php"><button class="btn btn-success border-0">Reserve Now</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card d-flex flex-column align-items-end justify-content-end h-100 border-0  mt-5" id="card-event">
        <div class="w-100 border-0 d-flex" style="height: 60vh;" id="card-body">
            <div class="pt-2" style="background-image: url(../images/bg.svg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 100%; width: 100%;" id="bg-image">
                <div class="container h-100 w-100" id="cardEvent-content">
                    <div class="col d-flex flex-column justify-content-start align-items-end">
                        <a href="../home/reservation.php"><button class="btn btn-success border-0">Reserve Now</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>



<?php

include "../home/footer.php";
?>