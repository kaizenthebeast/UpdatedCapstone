<?php
 include ('../userRegister/authentication.php');
 include '../home/header.php';


?>




<style>
    @media only screen and (max-width: 760px),
    (min-device-width: 802px) and (max-device-width: 1020px) {

        /* Force table to not be like tables anymore */
        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;

        }



        .empty {
            display: none;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        th {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
        }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }



        /*
		Label the data
		*/
        td:nth-of-type(1):before {
            content: "Sunday";
        }

        td:nth-of-type(2):before {
            content: "Monday";
        }

        td:nth-of-type(3):before {
            content: "Tuesday";
        }

        td:nth-of-type(4):before {
            content: "Wednesday";
        }

        td:nth-of-type(5):before {
            content: "Thursday";
        }

        td:nth-of-type(6):before {
            content: "Friday";
        }

        td:nth-of-type(7):before {
            content: "Saturday";
        }


    }

    /* Smartphones (portrait and landscape) ----------- */

    @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
        body {
            padding: 0;
            margin: 0;
        }
    }

    /* iPads (portrait and landscape) ----------- */

    @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
        body {
            width: 495px;
        }
    }

    @media (min-width:641px) {
        table {
            table-layout: fixed;
        }

        td {
            width: 33%;
        }
    }

    .row {
        margin-top: 20px;
    }

    .today {
        background: yellow;
    }
</style>



<div class="container my-lg-5 mt-5">
    <div class="container-fluid text-center text-light" style="background-color: rgb(4, 4, 132);">
        <h4 class="py-2">Online Reservation</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
           <div id="calendar"></div>
        </div>
        
    </div>
   
</div>

<script src="https:code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<script>    

  $.ajax({
    url:"calendar.php",
    type:"POST",
    data:{'month':'<?php echo date('m'); ?>','year':'<?php echo date('Y');?>'},
    success: function(data){
        $("#calendar").html(data);
    }
  });
   
  $(document).on('click','.changemonth',function(){
    $.ajax({
    url:"calendar.php",
    type:"POST",
    data:{'month':$(this).data('month'),'year':$(this).data("year")},
    success: function(data){
        $("#calendar").html(data);
    }
  });
  })

</script>


<?php
include "../home/footer.php";
?>