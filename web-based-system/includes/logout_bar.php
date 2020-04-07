<?php
if( isset($_SESSION['logged_in']) ) { 
?>
<div class="row logoutBar">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="card" >
            <div class="card-body"  style="padding:4px;">
              <h4 style="float:left;">Food Detection</h4>
              <a href="logout.php">
              	<button style="float:right;" class="btn btn-sm btn-danger">Logout</button>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
<?php
}
?>