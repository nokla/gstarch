<!DOCTYPE html>
<html>
<head>
	<title>PSD-Module Security DB</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->


    <link rel="stylesheet" href="css/Litera.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- Font Awesome CSS -->
	<!-- Custom CSS -->
	<style>
		.bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      body {
  font-size: .875rem;
}

.feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}

/*
 * Sidebar
 */

.sidebar {
  position: fixed;
  top: 0;
  /* rtl:raw:
  right: 0;
  */
  bottom: 0;
  /* rtl:remove */
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 48px 0 0; /* Height of navbar */
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

@media (max-width: 767.98px) {
  .sidebar {
    top: 5rem;
  }
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #727272;
}

.sidebar .nav-link.active {
  color: #048918;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
  color: inherit;
}

.sidebar-heading {
  font-size: .75rem;
  text-transform: uppercase;
}

/*
 * Navbar
 */

.navbar-brand {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, .25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}

.navbar .navbar-toggler {
  top: .25rem;
  right: 1rem;
}

.navbar .form-control {
  padding: .75rem 1rem;
  border-width: 0;
  border-radius: 0;
}

.form-control-dark {
  color: #fff;
  background-color: rgba(255, 255, 255, .1);
  border-color: rgba(255, 255, 255, .1);
}

.form-control-dark:focus {
  border-color: transparent;
  box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}
	</style>
    <meta name="theme-color" content="#7952b3">
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">PSD Module Sécurité et BD</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="#">Sign out</a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Serveur
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="shopping-cart"></span>
                Comptes Utilisateurs
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="users"></span>
                Administrateur
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Demandes d'intervention
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="layers"></span>
                Mises à jour
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Infos Serveur</h1>
        </div>

        <div class="table-responsive">
            <section class="tables py-0">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <div class="page-header" id="banner">
            <div class="row text-start">
              <div class="col-lg-10 col-md-8 col-sm-6 mx-auto">
                <h1>Serveur PSD</h1>
                <hr>
                <div class="card  border-success mb-3">
                    <div class="card-body">
                        <div class="card-text">
                            <p><br></p>
                            <ul class="list-group">
                                <li class="list-group-item">Serveur MySQL : 8.0.31-0ubuntu0.20.04.1</li><li class="list-group-item">Version de serveur : 80031</li><li class="list-group-item">Infos de serveur : mysqlnd 8.1.11</li><li class="list-group-item">Etat Connexion : psd</li>                        </ul>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-6 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 bg-primary text-white">
                            <h4 class="my-0 fw-normal">Administrateur DB Actif:</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group mt-3 mb-4">
                                                            <li class="list-group-item">psd</li>
                                                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-6 rounded-3 shadow-sm border-success">
                        <div class="card-header py-3 bg-success text-white">
                            <h4 class="my-0 fw-normal">Administrateurs Connectés</h4>
                        </div>
                        <div class="card-body">
                                                        <li class="list-group-item">psd@localhost</li>
                                                            <li class="list-group-item">event_scheduler@localhost</li>
                                                            <li class="list-group-item">psdrep@196.92.7.236</li>
                                                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card table-responsive">
                        <table class="table table-border table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Serveur</th>
                                <th>Administrateur DB</th>
                                <th>Base</th>
                                <th>Action</th>
                                <th>Temps</th>
                                <th>Etat</th>
                            </tr>
                            </thead>
                            <tbody>
                                                        <tr>
                                    <td>1237220</td>
                                    <td>localhost</td>
                                    <td>psd</td>
                                    <td>gsc20222023</td>
                                    <td>Query</td>
                                    <td>0</td>
                                    <td>executing</td>
                                </tr>
                                                            <tr>
                                    <td>5</td>
                                    <td>localhost</td>
                                    <td>event_scheduler</td>
                                    <td></td>
                                    <td>Daemon</td>
                                    <td>10321826</td>
                                    <td>Waiting on empty queue</td>
                                </tr>
                                                            <tr>
                                    <td>1233110</td>
                                    <td>196.92.7.236:50060</td>
                                    <td>psdrep</td>
                                    <td></td>
                                    <td>Binlog Dump</td>
                                    <td>33057</td>
                                    <td>Source has sent all binlog to replica; waiting for more updates</td>
                                </tr>
                                                        </tbody>
                        </table>
                    </div>

                    <hr>
                </div>
            </div>

            <h2 class="display-6 text-center mb-4">Server Détails</h2>

            <div class="table-responsive">
            <div class="list-group">

                <a href="#" class="list-group-item list-group-item-action">Aborted_connects =><span class="text-success">16924</span></a>

                <a href="#" class="list-group-item list-group-item-action">Connection_errors_accept =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Connection_errors_internal =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Connection_errors_max_connections =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Connection_errors_peer_address =><span class="text-success">13</span></a>

                <a href="#" class="list-group-item list-group-item-action">Connection_errors_select =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Connection_errors_tcpwrap =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Connections =><span class="text-success">1237220</span></a>

                <a href="#" class="list-group-item list-group-item-action">Global_connection_memory =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Locked_connects =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Max_used_connections =><span class="text-success">22</span></a>

                <a href="#" class="list-group-item list-group-item-action">Max_used_connections_time =><span class="text-success">2023-01-23 11:20:56</span></a>

                <a href="#" class="list-group-item list-group-item-action">Mysqlx_connection_accept_errors =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Mysqlx_connection_errors =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Mysqlx_connections_accepted =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Mysqlx_connections_closed =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Mysqlx_connections_rejected =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Performance_schema_session_connect_attrs_longest_seen =><span class="text-success">182</span></a>

                <a href="#" class="list-group-item list-group-item-action">Performance_schema_session_connect_attrs_lost =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Ssl_client_connects =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Ssl_connect_renegotiates =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Ssl_finished_connects =><span class="text-success">0</span></a>

                <a href="#" class="list-group-item list-group-item-action">Threads_connected =><span class="text-success">2</span></a>

            </div>                    </div>
                      </div>
                    </div>

                    </div>
                  </div>
                </div>
              </section>
        </div>
      </main>
    </div>
  </div>




  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
