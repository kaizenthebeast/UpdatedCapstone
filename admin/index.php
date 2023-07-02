<?php
include("../userRegister/authentication.php");
include ("../admin/adminHeader.php");

?>


  
     
      <div class="container my-5">
        <div class="dashboard-tab verified">
          <i class="material-icons">done_all</i>
          <div class="dashboard-tab-content">
            <h2>Verify Users </h2>
            <p>View the list of users.</p>
          </div>
        </div>
        <div class="dashboard-tab verified-submissions">
          <i class="material-icons">check_circle</i>
          <div class="dashboard-tab-content">
            <h2>View Submissions</h2>
            <p>View the list of submissions.</p>
          </div>
        </div>
        <div class="dashboard-tab not-verified-submissions">
          <i class="material-icons">warning</i>
          <div class="dashboard-tab-content">
            <h2>Not Verified Submissions</h2>
            <p>View the list of not verified submissions.</p>
          </div>
        </div>
        <div class="dashboard-tab">
          <i class="material-icons">add</i>
          <div class="dashboard-tab-content">
            <h2>Manage conferences</h2>
            <p>Add or delete events.</p>
          </div>
        </div>
        <div class="dashboard-tab">
          <i class="material-icons">people</i>
          <div class="dashboard-tab-content">
            <h2>System Admin List</h2>
            <p>View System Users.</p>
          </div>
        </div>
       
      </div>
      
    </div>
  </div>
 
  
</div>

<?php
 include ("../admin/adminFooter.php");
?>