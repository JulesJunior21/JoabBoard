<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <title>Home</title>
</head>

<body>

  <!-- Barre de Navigation -->

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">JOB ADV.</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>


  <!-- BAnni??re -->

  <div class="container">
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="heading-section mb-5 pb-md-4">JOB ADVERTISEMENTS</h2>
          </div>
          <div class="col-md-12">
            <div class="slider-hero">
              <div class="featured-carousel owl-carousel">
                <div class="item">
                  <div class="work">
                    <div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/banner1.jpg);">
                      <div class="text text-center">
                        <h2>Discover New Places</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="work">
                    <div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/banner2.jpg);">
                      <div class="text text-center">
                        <h2>Dream Destination</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="work">
                    <div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/banner3.jpg);">
                      <div class="text text-center">
                        <h2>Travel Exploration</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="my-5 text-center">
                <ul class="thumbnail">
                  <li class="active img"><a href="#"><img src="images/thumb-1.jpg" alt="Image" class="img-fluid"></a></li>
                  <li><a href="#"><img src="images/thumb-2.jpg" alt="Image" class="img-fluid"></a></li>
                  <li><a href="#"><img src="images/thumb-3.jpg" alt="Image" class="img-fluid"></a></li>
                </ul>
              </div>
            </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!--000-->

  <div id="ad_container" class="container">

    <!-- modal popup -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title center" id="exampleModalLabel">Enter your informations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form id="applyform">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Firstname</label>
                  <input type="text" class="form-control" id="firstname" placeholder="Firstname" required>
                </div>
                <div class="form-group col-md-6">
                  <label for=surname">Lastname</label>
                  <input type="text" class="form-control" id="lastname" placeholder="Lastname" required>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="email@example.com" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" required>
              </div>
              <div class="form-group">
                <label for="street">Street</label>
                <input type="text" class="form-control" id="street" required>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="city">City</label>
                  <input type="text" class="form-control" id="city" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="state">State</label>
                  <input type="text" class="form-control" id="state" required>
                </div>
                <div class="form-group col-md-2">
                  <label for="postalcode">Zip</label>
                  <input type="text" class="form-control" id="postalcode" required>
                </div>
              </div>

              <div class="form-group">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" required>
              </div>

              <div class="form-group">
                <label for="message">Message</label>

                <textarea id="message" name="message" rows="5" cols="33" required>
                </textarea>
              </div>


              <button id="apply" type="submit" class="btn btn-primary">Apply</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>

              <span id="currentid"></span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/main.js"></script>
  <script src="js/home.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


</body>

</html>