<?php
  include 'config.php';
  // include 'controller.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>PrintVendo</title>

<!-- Favicons -->
<link href="img/favicon.png" rel="icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Bootstrap core CSS -->
<link href="/admin/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--external css-->
<link href="/admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="/admin/lib/dropzone/css/dropzone.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="/admin/css/style.css" rel="stylesheet">
<link href="/admin/css/style-responsive.css" rel="stylesheet">
  <!-- Custom styles for this template -->
<style>
@import url('https://fonts.googleapis.com/css?family=Orbitron');
body, html {
  height: 100%;
  margin: 0;
}
#showtime{
  font-family: 'Orbitron', sans-serif;
  font-size:3rem;
    margin:0;
}
.bg {
  /* The image used */
  background-image: url("/admin/img/bg.jpg");
	/* zoom: 1;
	filter: alpha(opacity=50);
	opacity: 0.5; */
    filter:brightness(.4);

  /* Full height */
  height: 100%; 
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.content{
    position:absolute;
    top:0px;
    color:white;
    height:100vh;
    width:100vw;
    text-align:center;
}
.left{text-align:left}
.right{text-align:right; min-width:5rem}
div.scrollmenu {
  overflow: auto;
  white-space: nowrap;
}

div.scrollitem {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px;
  text-decoration: none;
}
.action{
  display:flex;
  justify-content:center;
}
.action>div{
  padding: 0 1rem;
}
.pic{
  width:50%;
}

h2 {
  color: #4db1bc;
  font-weight:bolder;
  margin: 0;
  grid-column: 1;
  grid-row: 1;
  z-index: 1;
  text-transform: uppercase;
  animation: glow 1s ease-in-out infinite alternate;
  text-align: center;
}
@keyframes glow {
    from {
      text-shadow: 0 0 20px #2d9da9;
    }
    to {
      text-shadow: 0 0 30px #34b3c1, 0 0 10px #4dbbc7;
    }
  }
  .cont{
    padding: 1rem;
  }
  .credits{
    color:black;
  }

</style>
</head>
<body style="max-height:100vh">

<div class="bg"></div>
<div class="content">
        <div class="container">
            <div id="showtime"></div>
            <?php include 'component/msg.php'  ?>
            <div>
                <h3>Printer Vendo: </h3><span>Raspberrypi Powered Printer Vending Machine</span>
                <hr>
                <center>
                  <table>
                    <tr>
                      <td class="left"><h4>IP:</h4></td>
                      <td class="left"><h4><?=$client['ip'] ?></h4></td>
                    </tr>
                    <tr>
                      <td class="left"><h4>MAC:</h4></td>
                      <td class="left"><h4><?=$client['mac'] ?></h4></td>
                    </tr>
                    <tr>
                      <td class="left"><h4>Credits:</h4></td>
                      <td class="left"><h4 style="color:white" id="mcreds" class="credits"><?=$client['credits'] ?> PHP</h4></td>
                    </tr>
                  </table>
                </center>
            </div>
            <div class="col-lg-4 col-lg-offset-4">
            <div class="lock-screen">
            <div class="action">
              <div>
                <h4><a data-toggle="modal" href="#myModal"><i class="fa fa-upload" style="font-size:5rem"></i></a></h4>
                <p>Add File</p>
              </div>
              <div>
                <h4><a data-toggle="modal" class="addcoins"  href="#addcoins"><i class="fa fa-dollar"  style="font-size:5rem"></i></a></h4>
                <p>Add Credits</p>
              </div>
            </div>
                <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Upload Files</h4>
                </div>
                <div class="modal-body">
                      <!--main content start-->
                    <div class="row mt" id="asd">
                      <!-- <div class="white-panel mt">
                        <div class="panel-body">
                          <form action="/controller/uploadfile.php" class="dropzone" id="my-awesome-dropzone"></form>
                        </div>
                      </div> -->
                      <form action="/controller/uploadfile.php" class="dropzone" id="my-awesome-dropzone"></form>
                    </div>
                  </div>
                  <div class="modal-footer centered">
                      <button data-dismiss="modal" class="btn btn-theme04" type="button">Cancel</button>
                      <button class="btn btn-theme03" type="button">Done</button>
                  </div>
                </div>
              </div>
            </div>
              <!-- modal -->
            </div>
          </div>
          <!-- /col-lg-4 -->
            <div id="af" class="scrollmenu" style="width:100%">
              <?php include 'controller/getfiles.php' ?>
            </div>
            <!-- /lock-screen -->
        </div>
        <!-- /container -->

</div>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="printme" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Print Files</h4>
        </div>
        <div class="modal-body">
          <center>
            <img class="pic" src="#" id="printimg" alt="" >
          </center>

          <div class="row cont">
            <label class="col-sm-3 control-label"> Print Type </label>
            <div class="col-sm-9">
              <label class="checkbox-inline">
                <input type="radio" name="type" class="compute" value="colored" checked> Colored
              </label>
              <label class="checkbox-inline">
                <input type="radio" name="type" class="compute" value="grayscale"> Grayscale
              </label>
              <label class="checkbox-inline">
                <input type="radio" name="type" class="compute" value="bnw"> Black n White
              </label>
            </div>
          </div>

          <div class="row cont">
            <label class="col-sm-3 control-label"> Paper Size </label>
            <div class="col-sm-9">
              <select class="form-control compute" name="size" id="papersize">
                  <option value="short">Letter - US Letter (8.5x11 inches, or 216x279mm)</option>
                  <option value="long">Legal - US Legal (8.5x14 inches, or 216x356mm)</option>
                  <option value="a4">A4 - ISO A4 (8.27x11.69 inches, or 210x297mm)</option>
                </select>
            </div>
          </div>

          <div class="row cont">
            <label class="col-sm-3 control-label"> Pages </label>
            <div class="col-sm-9">
              <input type="text" name="pages" class="form-control compute" placeholer="1,2,3 or 2-4 leave blank for all pages">
              <span class="help-block">1,2,3 or 2-4 leave blank for all pages</span>
            </div>
          </div>
          
          <div class="row cont">
            <label class="col-sm-3 control-label"> Copies </label>
            <div class="col-sm-9">
              <input type="number" name="copies" class="form-control compute" value="1" min="1">
              <!-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
            </div>
          </div>
        <hr>
        <div class="row">
          <div class="col-sm-12"> <h3>Credits <span class="credits"><?=$client['credits'] ?> PHP</span></h3> </div>
          <div class="col-sm-12"> <h3>Price: <span id="price"></span></h3> </div>
        </div>

        </div>
        <div class="modal-footer centered">
            <button data-dismiss="modal" class="btn btn-theme04" type="button">Cancel</button>
            <button class="btn btn-theme02 addcoins" type="button"  data-toggle="modal" href="#addcoins">Add coins</button>
            <button data-dismiss="modal" class="btn btn-theme03" type="button">Print</button>
        </div>
      </div>
    </div>
  </div>
    <!-- modal -->

    
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="addcoins" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Insert Coins</h4>
        </div>
        <div class="modal-body">
          <center>
            <img src="coin.png" class="pic">
            <h2 class="blinking">Insert coin to add credits!!</h2>
          <h3 id="timer">timer</h3>
          <p>Credits: <span class="credits"></span></p>
          </center>
        </div>
        <div class="modal-footer centered">
            <button data-dismiss="modal" class="btn btn-theme04" type="button">Cancel</button>
            <button class="btn btn-theme02 addcoins" type="button">Add coins</button>
            <button data-dismiss="modal" class="btn btn-theme03" type="button">Done</button>
        </div>
      </div>
    </div>
  </div>
    <!-- modal -->
    

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="/admin/lib/jquery/jquery.min.js"></script>
  <script src="/admin/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="/admin/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="/admin/lib/jquery.scrollTo.min.js"></script>
  <script src="/admin/lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="/admin/lib/common-scripts.js"></script>
  <!--script for this page-->
  <script src="/admin/lib/dropzone/dropzone.js"></script>
  <script>
    $('.addcoins').click((e)=>{
      $.ajax({
        url: "cont.php?trigger=<?=$client['mac'] ?>",
        error:(err)=>{
          if(err.status==500) $('#timer').html('server error')
          if(err.status==400) $('#timer').html(err.responseText)
        },
        success:(res)=>{
          starttimer();
        }
      });
    })
    function starttimer(){
      let timer2=15;
      const timer=setInterval(() => {
        $.ajax({
          url: "cont.php?coins=<?=$client['mac'] ?>",
          error:(err)=>{
            if(err.status==500) $('#credits').html('error')
          },
          success:(res)=>{
            res=JSON.parse(res)
            // $('.credits').map((ind,cred)=>{
            //   console.log(cred);
            //   cred.innerHTML=res.credits+' PHP'
            // })
            $('.credits').html(res.credits+' PHP')
            // $('#mcreds').html(res.credits+' PHP')
          }
        });
        $('#timer').html(timer2)
        if(timer2==0){
          $('#timer').html('')
          clearInterval(timer);
        }
        timer2--;
      }, 1000);
    }

    function setdoc(node){
      let img=node.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[0].children[0].children[0];
      document.querySelector('#printimg').src=img.src;
    }
    $('.compute').change((event)=>{
      compute()
    });
      let prices={};
      $.ajax({
          url: "cont.php?prices",
          error:(err)=>{
            if(err.status==500) alert('error fetching prices')
          },
          success:(res)=>{
            res=JSON.parse(res);
            // prices=res;
            res.map((price)=>{
              prices=Object.assign({},prices,{[price.name]:price.price})
            });
            compute();
          },
      });
    function compute(){
      let type=$(':input[name="type"]:checked').val();
      // let size=$(':input[name="size"]:checked').val();
      let size=$('#papersize').val();
      let pages=$(':input[name="pages"]').val();
      pages= pages.split(',');
      let c=0
      pages.map((page)=>{
        if(page.indexOf('-')>-1){
          nums=page.split('-');
          c+=nums[1]-nums[0]+1
        }
        else{
          c+=1
        }
      })
      let copies=$(':input[name="copies"]').val();
      let price= Object.entries(prices).filter((price)=>price[0]==type)[0][1]
      let pp= Object.entries(prices).filter((pr)=>pr[0]==size)[0][1]
      price=price*pp*c*copies
      $('#price').html(price +' PHP')
    }
  </script>
</body>
</html>