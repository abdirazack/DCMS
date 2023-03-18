<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modern Responsive Sidebar Menu</title>
    <?php include_once('header.php'); ?>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top mb-5">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">My Website</a>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="./appointment.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./expenses.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./services.php">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div id="contentArea">
          <h1 class="mb-3">Welcome to My Website!</h1>
          <p>This is the home page of my website. Use the sidebar to navigate to other pages.</p>
        </div>
      </main>
    </div>
  </div>

 <script>
  $(document).ready(function() {
    // Add smooth scrolling to all links
    $("a").on('click', function(event) {
      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 800, function(){
      
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      } // End if
    });

    // Update the content area when a sidebar link is clicked
    $('.nav-link').on('click', function(event) {
      event.preventDefault();
      var href = $(this).attr('href');
      $('#contentArea').load(href);
    });
  });
</script>
</body>
</html>
