<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
  <title>Akwaba</title>

    <!-- Favicons -->
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/zabuto_calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/gritter/css/jquery.gritter.css') }}" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
    <script src="{{ asset('lib/chart-master/Chart.js') }}"></script>

    <!--datatable css-->
    <link href="{{ asset('lib/advanced-datatable/css/demo_page.css') }}" rel="stylesheet" />
    <link href="{{ asset('lib/advanced-datatable/css/demo_table.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('lib/advanced-datatable/css/DT_bootstrap.css') }}" />

    <link rel="stylesheet" href="{{ asset('dist/jquery-pretty-tabs.css') }}">

@yield('css')

</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="#" class="logo"><b>AKWABA<span>SAAS</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- settings start -->
          {{-- <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
              <i class="fa fa-tasks"></i>
              <span class="badge bg-theme">4</span>
              </a>
            <ul class="dropdown-menu extended tasks-bar">
              <div class="notify-arrow notify-arrow-green"></div>
              <li>
                <p class="green">You have 4 pending tasks</p>
              </li>
              <li>
                <a href="index.html#">
                  <div class="task-info">
                    <div class="desc">Dashio Admin Panel</div>
                    <div class="percent">40%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                      <span class="sr-only">40% Complete (success)</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="index.html#">
                  <div class="task-info">
                    <div class="desc">Database Update</div>
                    <div class="percent">60%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                      <span class="sr-only">60% Complete (warning)</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="index.html#">
                  <div class="task-info">
                    <div class="desc">Product Development</div>
                    <div class="percent">80%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                      <span class="sr-only">80% Complete</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="index.html#">
                  <div class="task-info">
                    <div class="desc">Payments Sent</div>
                    <div class="percent">70%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                      <span class="sr-only">70% Complete (Important)</span>
                    </div>
                  </div>
                </a>
              </li>
              <li class="external">
                <a href="#">See All Tasks</a>
              </li>
            </ul>
          </li>
          <!-- settings end -->
          <!-- inbox dropdown start-->
          <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
              <i class="fa fa-envelope-o"></i>
              <span class="badge bg-theme">5</span>
              </a>
            <ul class="dropdown-menu extended inbox">
              <div class="notify-arrow notify-arrow-green"></div>
              <li>
                <p class="green">You have 5 new messages</p>
              </li>
              <li>
                <a href="index.html#">
                  <span class="photo"><img alt="avatar" src="img/ui-zac.jpg"></span>
                  <span class="subject">
                  <span class="from">Zac Snider</span>
                  <span class="time">Just now</span>
                  </span>
                  <span class="message">
                  Hi mate, how is everything?
                  </span>
                  </a>
              </li>
                <a href="index.html#">See all messages</a>
              </li>
            </ul>
          </li>
          <!-- inbox dropdown end -->
          <!-- notification dropdown start-->
          <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
              <i class="fa fa-bell-o"></i>
              <span class="badge bg-warning">7</span>
              </a>
            <ul class="dropdown-menu extended notification">
              <div class="notify-arrow notify-arrow-yellow"></div>
              <li>
                <p class="yellow">You have 7 new notifications</p>
              </li>
              <li>
                <a href="index.html#">
                  <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                  Server Overloaded.
                  <span class="small italic">4 mins.</span>
                  </a>
              </li>
              <li>
                <a href="index.html#">
                  <span class="label label-warning"><i class="fa fa-bell"></i></span>
                  Memory #2 Not Responding.
                  <span class="small italic">30 mins.</span>
                  </a>
              </li>
              <li>
                <a href="index.html#">
                  <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                  Disk Space Reached 85%.
                  <span class="small italic">2 hrs.</span>
                  </a>
              </li>
              <li>
                <a href="index.html#">
                  <span class="label label-success"><i class="fa fa-plus"></i></span>
                  New User Registered.
                  <span class="small italic">3 hrs.</span>
                  </a>
              </li>
              <li>
                <a href="index.html#">See all notifications</a>
              </li>
            </ul>
          </li> --}}
          <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li style="left: 15px;"><a class="logout" href="{{ url('deconnexion') }}" ><i class="fa fa-sign-out"></i> Déconnexion</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php
        $urlCourant = URL::Current();
        $urlRelatif = parse_url($urlCourant);
        $url = $urlRelatif['path'];

        $urlDecoupe = explode("/", $url);
        $nbreElementUrlDecoupe = count($urlDecoupe);
        $autreUrl = $urlDecoupe[$nbreElementUrlDecoupe-1];

        $active_index = '';
        $active_client = '';
        $active_facture = '';
        $active_partenaire = '';
        $active_utilisateur = '';
        $active_service = '';
        $active_promotion = '';
        $active_configuration = '';
        switch ($autreUrl) {
            case 'index':
                $active_index = 'active';
                break;

            case 'client':
                $active_client = 'active';
                break;

            case 'partenaire':
                $active_partenaire = 'active';
                break;

            case 'utilisateur':
                $active_utilisateur = 'active';
                break;

            case 'factures':
                $active_facture = 'active';
                break;
                //-------------
            case 'services':
                $active_service = 'active';
                break;

            case 'promotions':
                $active_promotion = 'active';
                break;

            case 'configurations':
                $active_configuration = 'active';
                break;
        }
    ?>
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <li class="mt">
            <a class="{{ $active_index }}" href="{{ url('/index') }}">
              <i class="fa fa-dashboard"></i>
              <span>Tableau de bord</span>
              </a>
          </li>
          <li class="sub-menu">
            <a class="{{ $active_utilisateur }}" href="{{ url('utilisateurs/utilisateur') }}">
              <i class="fa fa-users"></i>
              <span>Utilisateurs</span>
              </a>
          </li>
          <li class="sub-menu">
            <a class="{{ $active_partenaire }}" href="{{ url('utilisateurs/partenaire') }}">
              <i class="fa fa-handshake-o"></i>
              <span>Partenaires</span>
            </a>
          </li>
          <li class="sub-menu">
            <a class="{{ $active_client }}" href="{{ url('utilisateurs/client') }}">
              <i class="fa fa-user"></i>
              <span>Clients</span>
              </a>
          </li>
          <li class="sub-menu">
            <a class="{{ $active_facture }}" href="{{ url('/factures') }}">
              <i class="fa fa-list-alt"></i>
              <span>Factures</span>
            </a>
          </li>
          <li class="sub-menu">
            <a class="{{ $active_promotion }}" href="{{ url('/promotions') }}">
              <i class="fa fa-bullhorn"></i>
              <span>Promotions</span>
            </a>
          </li>
          <li class="sub-menu">
            <a class="{{ $active_service }}" href="{{ url('/services') }}">
              <i class="fa fa-wrench"></i>
              <span>Services</span>
            </a>
          </li>
          <li class="sub-menu">
            <a class="{{ $active_configuration }}" href="{{ url('/configurations') }}">
              <i class="fa fa-cogs"></i>
              <span>Configurations</span>
            </a>
          </li>
          <li class="sub-menu">
          </li>
          <li class="sub-menu centered">
              <div class="centered" style="padding: 70px 0px;">
                  <hr><i class="fa fa-user-circle" style="font-size: 50px;"></i>
                  <h5 class="text-uppercase" style="color: white;"> {{ session()->get('user.NomComplet') }}</h5><hr>
              </div>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        @yield('content')
    </section>
    <!--main content end-->

  </section>



  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>

  <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
  <script class="include" type="text/javascript" src="{{ asset('lib/jquery.dcjqaccordion.2.7.js') }}"></script>
  <script src="{{ asset('dist/jquery-pretty-tabs.js') }}"></script>
  <script src="{{ asset('lib/jquery.scrollTo.min.js') }}"></script>
  <script src="{{ asset('lib/jquery.nicescroll.js') }}" type="text/javascript"></script>
  <script src="{{ asset('lib/jquery.sparkline.js') }}"></script>
  <!--common script for all pages-->
  <script src="{{ asset('lib/common-scripts.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/gritter/js/jquery.gritter.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/gritter-conf.js') }}"></script>
  <!--script for this page-->
  <script src="{{ asset('lib/sparkline-chart.js') }}"></script>
  <script src="{{ asset('lib/zabuto_calendar.js') }}"></script>


<!--script for this page-->
<script type="text/javascript">

    $(document).ready(function() {

      var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    });

    $('#ancientClient').hide();
    $('#new').change(function () {
        $('#nouveauClient').toggle(1000);
        $('#ancientClient').toggle(1000);
    });

</script>

<script type="application/javascript">
    $(document).ready(function() {
      /* $("#date-popover").popover({
        html: true,
        trigger: "manual"
      }); */
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      /* $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      }); */
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>

    @yield('js')

    <script type="text/javascript">
        $(document).ready(function() {

          /*
           * Initialse DataTables, with no sorting on the 'details' column
           */
          var oTable = $('#hidden-table-info').dataTable({
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [0]
            }],
            "aaSorting": [
              [1, 'asc']
            ]
          });

          /* Add event listener for opening and closing details
           * Note that the indicator for showing which row is open is not controlled by DataTables,
           * rather it is done here
           */
          $('#hidden-table-info tbody td img').live('click', function() {
            var nTr = $(this).parents('tr')[0];
            if (oTable.fnIsOpen(nTr)) {
              /* This row is already open - close it */
              this.src = "lib/advanced-datatable/media/images/details_open.png";
              oTable.fnClose(nTr);
            } else {
              /* Open this row */
              this.src = "lib/advanced-datatable/images/details_close.png";
              oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
            }
          });
        });
      </script>

      <!--datatable JS-->
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/advanced-datatable/js/DT_bootstrap.js') }}"></script>
</body>

</html>

