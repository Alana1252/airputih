<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
      .banner-image {
        background-image: url('images/logo.ico');
        background-size: cover;
      }
	  .gambar {
  border-radius: 50%;
  margin-right: 18px;
  margin-left: 24px;
}
    </style>
  </head>
  <body>
    <!-- Navbar  -->
    <nav class="navbar fixed-top navbar-expand-lg p-md-3">
      <div class="container">
         <img src="images/logo.ico" width="64" height="60" class="d-inline-block gambar" alt="Logo">           
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="mx-auto"></div>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#album">Album</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#mahasiswa">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="admin/index.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      var nav = document.querySelector('nav');

      window.addEventListener('scroll', function () {
        if (window.pageYOffset > 600) {
          nav.classList.add('bg-dark', 'shadow');
        } else {
          nav.classList.remove('bg-dark', 'shadow');
        }
      });
    </script>
  </body>
</html>


