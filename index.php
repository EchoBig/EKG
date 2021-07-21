
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EKG Praibueng </title>


    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Ekg style -->
    <link href="dist/main.css" type="text/css" rel="stylesheet"/>
    <!-- <link rel="stylesheet" type="text/css" href="css/main.css"> -->
  </head>
  <body>
    
<header class="navbar sticky-top flex-md-nowrap p-0 ">
  <a class="navbar-brand  col-md-3 col-lg-2 me-0 px-3" href="#">EKG Praibueng Hospital</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <form id="frm_ekg" class="form-control">
    <input class="form-control form-control-green w-100" type="number" id="hn" name="hn" placeholder="Enter HN" aria-label="Search" autofocus="true">
  </form>
</header>

<div class="container-fluid">
  <div class="row">

    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky">
        <ul class="nav flex-column">
          <li class="nav-item border-bottom">
            <a class="nav-link" style="font-weight: bold;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> ประวัติ</a>
          </li>
          <span id="ekg_datehistory"></span>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <span id="patien-name"></span>
      </div>

      <!-- Ekg view -->
      <div id="ecgview"></div>
      <!-- End Ekg view -->

    </main>
  </div>
</div>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="lib/jquery.min.js"></script>
    <script src="dist/main.js" type="text/javascript"></script>
    <script src="js/loading.js"></script>

    <script>
      $(document).ready(function(){

        $(document).on('submit','#frm_ekg',function(e){
          e.preventDefault();
          var hn = $('#hn').val();
          fet_ekghistory(hn);
        });


        $(document).on('click','#ekg_datehistory li',function(event){
          var file = $(this).attr('data-file');
          document.querySelectorAll('ul li a.active').forEach(function(item) {
            item.classList.remove('active');
          })
            // mark as active selected menu item
            event.target.classList.add("active");
          view_ekg(file); // Call function to get file
        });

        function fet_ekghistory(hn){
          $.ajax({
            url:'sql_ekghistory.php',
            method:'post',
            data:{hn:hn},
            dataType:'json',
            success:function(data){
              if (data.status == 1) {
                $('#patien-name').html(data.name);
                $('#ekg_datehistory').html(data.message);
                view_ekg(data.last_ekg);
              }
              else{
                $('#patien-name').html(data.name);
                $('#ecgview').html('<span>ไม่มีประวัติ EKG</span>');
                $('#ekg_datehistory').html(data.message);
              }
            }
          });
        }

        function view_ekg(date){
          $.ajax({
            url:'get_fileekg.php',
            type:'post',
            data:{file:date},
            dataType:'html',
            beforeSend: function() {
              $('#ecgview').html('<div class="lv-bars lv-mid md lvt-5" data-label="Loading..."></div>');
              },
            success:function(data){
              $('#ecgview').html(data);
            }
          });
        }

      });
    </script>
  </body>
</html>
