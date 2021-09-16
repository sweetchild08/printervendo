<?php
$page=[
    'isprotected'=>true,
    'name'=>'prices'
  ];
  include 'includes/config.php';
  include 'includes/checksession.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'components/adminheader.php'; ?>
<?php
    $prices=[];
    $res=$db->run('select * from price');
    while($row=$res->fetch(PDO::FETCH_ASSOC)){
        $prices[$row['name']]=$row['price'];
    }
?>
<body>
  <section id="container">
        <?php include 'components/header.php'; ?>
    
    <?php include 'components/sidebar.php'?>
    
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
      
	<?php include 'components/msg.php' ?>
            <div style="padding:1rem">
              <h3>Prices Management</h3>
            </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="col-md-6 col-xs-12">
                <form action="cont/updateprice.php" method="post">
              <div class="custom-box">
                <div class="servicetitle">
                  <h4>Paper Sizes</h4>
                  <hr>
                </div>
                
                <p>Paper sizes and corresponding price</p>
                <ul class="pricing">
                  <li style="padding-bottom:1rem">
                      <div class="row mt">
                        <span class="col-xs-4">Letter</span>
                        <input name="Letter" type="number" style="width:60%" class="col-xs-8 form-control round-form"step="0.05" value="<?=$prices['Letter']?>">
                      </div>
                  </li>
                  <li style="padding-bottom:1rem">
                      <div class="row mt">
                        <span class="col-xs-4">Legal</span>
                        <input name="Legal" type="number" style="width:60%" class="col-xs-8 form-control round-form"step="0.05" value="<?=$prices['Legal']?>">
                      </div>
                  </li>
                  <li style="padding-bottom:1rem">
                      <div class="row mt">
                        <span class="col-xs-4">A4</span>
                        <input name="A4" type="number" style="width:60%" class="col-xs-8 form-control round-form" step="0.05" value="<?=$prices['A4']?>">
                      </div>
                  </li>
                </ul>
                <button class="btn btn-theme" type="submit" name="paper">Update</button>
              </div>
              <!-- end custombox -->
                </form>
            </div>
            <!-- end col-4 -->
            
            <div class="col-md-6 col-xs-12">
                <form action="cont/updateprice.php" method="post">
              <div class="custom-box">
                <div class="servicetitle">
                  <h4>Print Type</h4>
                  <hr>
                </div>
                
                <p>Type of Printing (Ink to be used)</p>
                <ul class="pricing">
                  <li style="padding-bottom:1rem">
                      <div class="row mt">
                        <span class="col-xs-4">BNW</span>
                        <input name="bnw" type="number" style="width:60%" class="col-xs-8 form-control round-form"step="0.05" value="<?=$prices['bnw']?>">
                      </div>
                  </li>
                  <li style="padding-bottom:1rem">
                      <div class="row mt">
                        <span class="col-xs-4">Grayscale</span>
                        <input name="grayscale" type="number" style="width:60%" class="col-xs-8 form-control round-form"step="0.05" value="<?=$prices['grayscale']?>">
                      </div>
                  </li>
                  <li style="padding-bottom:1rem">
                      <div class="row mt">
                        <span class="col-xs-4">Colored</span>
                        <input name="colored" type="number" style="width:60%" class="col-xs-8 form-control round-form"step="0.05" value="<?=$prices['colored']?>">
                      </div>
                  </li>
                </ul>
                <button class="btn btn-theme" Type="submit" name="type">Update</button>
              </div>
              <!-- end custombox -->
                </form>
            </div>
            <!-- end col-4 -->
          </div>
          <!--  /col-lg-12 -->
        </div>
        <!--  /row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
        </div>
        <a href="pricing_table.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <?php include 'components/adminscript.php' ?>

</body>

</html>
