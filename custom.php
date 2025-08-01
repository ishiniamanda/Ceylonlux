<?php
session_start(); // Start the session

include 'php/db.php'; // Include database connection

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_email']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : null; // Get user's name if logged in
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Serendi & Marquise</title>
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap"
    rel="stylesheet">
  <style>
    .image-upload-label {
          display: none;
        }

    .upload-icon {
      font-size: 20px;
      margin-right: 10px;
    }

    .image-upload-box {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      border: 2px solid #000;
      background-color: #ffffff;
      color: #666;
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
      position: relative;
      flex-direction: column;
      cursor: pointer;
      min-height: 200px;
      width: 100%;
    }

    .image-upload-box:hover {
      background-color: #eaeaea;
    }

    #uploadText {
      margin: 0;
      font-size: 16px;
    }

    #previewContainer {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin-top: 10px;
      width: 100%;
    }

    .img-wrapper {
      position: relative;
      width: 80px;
      height: 80px;
      margin-top: 10px;
    }

    .preview-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .remove-sign {
      position: absolute;
      top: 0;
      right: 0;
      background: #f44336;
      color: white;
      font-size: 14px;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      text-align: center;
      cursor: pointer;
      line-height: 18px;
    }

    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
      }

      .form-group {
        width: 100%;
      }

      .form-section hr {
        width: 90%;
      }
    }
    
    
.dropdown-menu {
  overflow: hidden; /* Prevent scrollbars */
  border: none; /* Remove border */
  background-color: transparent; /* Transparent background */
  text-align: left; /* Align text to the right */
  background-color: #fff;
  border-radius: 0px;
}

.dropdown-item {
  color: #000; /* Black text color */
}

.dropdown-item:hover {
  color: #000; /* Keep text color on hover */
  background-color: transparent !important; /* Prevent hover background */
}

/* Dropdown button - no hover, focus, active color changes */
.dropdown .btn-secondary {
  background-color: transparent !important; /* Transparent background */
  border: none !important; /* No border */
  box-shadow: none !important; /* No shadow */
  color: inherit; /* Keep text color as inherited */
}

.dropdown .btn-secondary:hover,
.dropdown .btn-secondary:focus,
.dropdown .btn-secondary:active,
.dropdown .btn-secondary.show {
  background-color: transparent !important; /* No background color on hover, focus, or active */
  box-shadow: none !important; /* No shadow */
  outline: none !important; /* Remove focus outline */
  color: inherit !important; /* Keep text color consistent */
}

    /* Remove background color from icons */
    .navbar a.text-dark {
      background-color: transparent !important;
      /* Ensure no background color */
      border: none;
      /* Remove any border that might appear */
      box-shadow: none;
      /* Remove any focus or hover box-shadow */
      outline: none;
      /* Remove focus outline */
      color: inherit;
      /* Keep the color consistent */
    }

    /* Ensure no background or border on hover or focus */
    .navbar a.text-dark:hover,
    .navbar a.text-dark:focus,
    .navbar a.text-dark:active {
      background-color: transparent !important;
      /* No background color on hover/focus */
      color: inherit;
      /* Keep icon color unchanged */
      border: none;
      /* Prevent any borders */
      box-shadow: none;
      /* No shadow on focus or hover */
      outline: none;
      /* No focus outline */
    }

   

    /* Navbar Styles */
    .navbar-nav {
      margin: 10px 200px;
      flex: 1;
      gap: 40px;
      justify-content: center;
    }

    @media (min-width: 993px) and (max-width: 1400px) {
    .navbar-nav {
      gap: 0px; /* Reduces space between navbar items */
      
    }
  }

    @media (max-width: 992px) {
      .navbar-nav {
        gap: 0px;
        
      }
    }

    .navbar-nav .nav-link {
      color: black !important;
      text-decoration: none;
      font-weight: 400;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #007bff;
    }

    .navbar-nav .nav-link.active {
      font-weight: bold;
      text-decoration: underline;
      color: black !important;
    }

    /* Search Bar Styles */
    #searchBar {
      position: absolute;
      top: -300px;
      /* Initially hidden by 300px */
      left: 0;
      right: 0;
      width: 100%;
      background: white;
      padding: 10px 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: top 0.5s ease;
      z-index: 1049;
      /* Below the search bar but above content */
    }

    #searchBar.active {
      top: 30%;
      /* Position the search bar to the middle of the page */
      transform: translateY(-30%);
      /* Center the search bar vertically */
    }

    .search-input {
      width: calc(100% - 40px);
      /* Adjust width to account for the button */
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 0px;
      box-sizing: border-box;
      display: inline-block;
      margin-left: 25%;

    }

    .search-btn,
    .close-btn {
      padding: 12px 15px;
      margin-left: 10px;
      border: 1px solid #ddd;
      background-color: #f8f9fa;
      cursor: pointer;
      border-radius: 0px;
      /* Ensures the button has sharp edges */
      display: inline-block;
    }

    .close-btn {
      margin-right: 25%;
    }

    .search-btn {
      background-color: #000;
      color: white;
    }

    .close-btn {
      background-color: #f8f9fa;
      color: #333;
    }

    .search-btn:hover,
    .close-btn:hover {
      background-color: #e2e6ea;
    }

    /* Icon Styles */
    .d-flex.align-items-center i {
      font-size: 1rem;
    }


    /* Responsive Design */
    @media (max-width: 1024px) {
      .search-input {
        margin-left: 0;
        /* Remove left and right margin */
      }

      .close-btn {
        margin-right: 0;
        margin-left: 10px;
        /* Remove left and right margin */

      }

      #searchBar.active {
        top: 20%;
        /* Position the search bar to the middle of the page */
        transform: translateY(-20%);
        /* Center the search bar vertically */
      }
    }
  </style>
</head>

<body>


<header class="bg-white py-3">
  <!-- Logo Section -->
  <div class="container text-center">
    <img src="Images/logo-2.svg" alt="Logo" class="img-fluid">
  </div>

  <!-- Search Bar -->
  <div id="searchBar">
    <div class="container d-flex justify-content-between">
      <!-- Search Input -->
      <input type="text" class="search-input" placeholder="Search here...">
      <!-- Search Button -->
      <button class="search-btn">
        <i class="fas fa-search" style="margin-right:-20px"></i>
      </button>
      <!-- Close Button -->
      <button class="close-btn" id="closeSearchBar">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container">
    <!-- Search Icon -->
    <a href="#" class="text-decoration-none text-dark" id="searchToggle" >
      <i class="fas fa-search" style="margin-left: 12px; font-size: 16px;"></i>
    </a>

    <!-- Navbar Items -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav" style="margin-left: 19px;">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="custom.php">CUSTOM ORDERS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">ABOUT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="collectionew.php">COLLECTIONS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php">BLOG</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">CONTACT</a>
        </li>
      </ul>
    </div>

          <!-- Profile and Cart Icons -->
          <div class="d-flex align-items-center ms-auto  " style="gap: 10px;">
            <div class="dropdown">
              <!-- Check if the user is logged in -->
              <?php if ($is_logged_in): ?>
                <!-- Show logout only for logged-in users -->
                <button class="btn btn-secondary dropdown-toggle text-dark" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span><?php echo htmlspecialchars($user_name); ?></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="/Serandi 2/logout.php">Logout</a>
                </div>
              <?php else: ?>
                <!-- Show login only for non-logged-in users -->
                <button class="btn btn-secondary dropdown-toggle text-dark" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user fa-lg"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="/Serandi 2/login.php">Login</a>
                </div>
              <?php endif; ?>
            </div>

            <!-- Shopping Bag Icon -->
            <a href="mycart.php" class="text-decoration-none text-dark">
              <i class="fas fa-shopping-bag" style="margin-right: 12px;"></i>
            </a>
          </div>
      </div>



  </nav>
</header>

  <!-- Main Content Section -->
  <div class="container mt-5">
    <!-- Heading 3 -->
    <div class="title-with-lines">
      <div class="line"></div>
      <h1>What We Do</h1>
      <div class="line "></div>
    </div>



    <!-- Text + Image Block -->
    <div class="row mt-5 align-items-center text-center">
      <!-- Text Block -->
      <div class="col-lg-6 text-center text-lg-center">
        <img src="Images/logo-2.svg" alt="" style="max-width: 300px;">
        <p class="text-center-para">Welcome to our Custom Jewelry Service, where your vision meets our expertise! We
          specialize in
          creating breathtaking, personalized pieces that perfectly capture your style and story. </p>
        <a href="collectionew.php" class="text-center-btn">Shop Now</a>
      </div>

      <!-- Image Slider Block -->
      <div class="col-lg-6">
        <div id="imageSlider" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="Images/slider-1.jpg" class="d-block" width="600px" height="350px" alt="Image 1">
              <div class="carousel-caption d-none d-md-block text-left">
                <h5 class="carousel-caption-image">We select only the finest gemstones.</h5>
              </div>
            </div>
            <div class="carousel-item">
              <img src="Images/slider-2.jpg" class="d-block" width="600px" height="350px" alt="Image 2">
              <div class="carousel-caption d-none d-md-block text-left">
                <h5 class="carousel-caption-image">we customize our services for your satitsfaction
                </h5>
              </div>
            </div>
            <div class="carousel-item">
              <img src="Images/slider-3.jpg" class="d-block" width="600px" height="350px" alt="Image 3">
              <div class="carousel-caption d-none d-md-block text-left">
                <h5 class="carousel-caption-image">we work with the most talented artisans</h5>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </a>
          <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>
        </div>
      </div>
    </div>
  </div>





  <!-- How It Works Section -->
  <div class="how-it-works py-5">
    <h1 class="how-it-works-title">How it works</h1>
    <!-- Horizontal Line -->
    <div class="line1" style="height: 0.5px;">
      <hr class="divider">
    </div>

    <!-- Single Image with Steps -->
    <div class="steps-image-container">
      <img src="Images/how-it-works.png" alt="How It Works Steps" class="steps-image">
    </div>



  </div>



  <!-- Custom Design Section -->

  <div class="custom-design-section ">
    <h1>Custom Design</h1>
    <div class="line1" style="height: 0.5px;">
      <hr class="divider">
    </div>
    <div class="buttons">
      <button onclick="changeImage('Images/cover.png')">Rings</button>
      <button onclick="changeImage('Images/earing.png')">Earings</button>
      <button onclick="changeImage('Images/anklet.png')">Anklet</button>
      <button onclick="changeImage('Images/Necklace.png')">Necklace</button>
      <button onclick="changeImage('Images/chain.png')">Chain</button>
    </div>
    <div class="image-display">
      <img id="designImage" src="Images/cover.png" alt="Custom Design" />
    </div>
  </div>

  <!-- Form Section -->
  <!-- Form Section -->
  <div class="form-section">
    <h1>Ready to Customize</h1>
    <div class="line">
      <hr class="divider">
    </div>
   
  </div>
  <form action="/Serandi 2/php/customizeoder.php" method="POST" enctype="multipart/form-data" id="cutomize-form">
      <div class="form-row">
        <div class="form-group">
          <input type="text" name="firstname" id="firstName" required>
          <label for="firstName">First Name</label>
        </div>
        <div class="form-group">
          <input type="text" name="lastname" id="lastName" required>
          <label for="lastName">Jewelry Type</label>
        </div>
      </div>
    
      <div class="form-group full-width">
        <textarea id="design" name="description" rows="4" required></textarea>
        <label for="design">Explain your design</label>
      </div>
    
      <div class="form-group full-width image-upload">
        <label for="imageUpload" class="image-upload-label">Upload Images</label>
        <input type="file" name="images[]" id="imageUpload"  style="height: 200px;" accept="image/*" multiple required>
      </div>
    
      <div class="form-group full-width">
        <button type="submit">Submit</button>
      </div>
    </form>
    
</div>
  <!--footer-->
  <footer class="bg-light text-center text-lg-start">
    <div class="container p-4">
      <div class="row">
        <div class="col-lg-4 col-md-12 mb-4">
          <h3>Quick Links</h3>
          <ul class="footer-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Custom Orders</a></li>
            <li><a href="#">Collections</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="/Serandi 2/faqs.php">Customer Care</a></li>
          </ul>

        </div>

        <div class="col-lg-4 col-md-6 mb-4 contact-info-container" style="margin-left:-10px;">
          <h3>Contact Information</h3>
          <ul class="footer-contact">
            <li><i class="fas fa-phone rotated-phone"></i> 011-1231234</li>
            <li><i class="fas fa-phone rotated-phone"></i> 011-1231234</li>
            <li><i class="fas fa-envelope"></i>ceylonluxe@gmail.com</li>
            <li><i class="fas fa-map-marker-alt"></i> Colombo 7, Sri Lanka</li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="footer-column2">
            <p>Join our email list for exclusive offers and the latest news.</p>
            <form class="newsletter-form newsletter-form" onsubmit="validateEmail(event)">
              <div class="newsletter-input-container">
                <input type="email" id="emailInput" class="newsletter-email-input newsletter-input"
                  placeholder="Enter your email" required />
                <button type="submit" class="submit-btn">Subscribe</button>
              </div><br>
              <div class="social-media">
                <h4>Connect</h4>
                <ul class="social-icons">
                  <li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
                  <li><a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="https://www.pinterest.com" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                </ul>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© 2024 Your Company Name. All rights reserved.</p>
    </div>
  </footer>

  <script src="js/script.js"></script>

  <script>
    const searchToggle = document.getElementById('searchToggle');
    const searchBar = document.getElementById('searchBar');
    const closeSearchBar = document.getElementById('closeSearchBar');

    // Toggle search bar visibility
    searchToggle.addEventListener('click', (e) => {
        e.preventDefault();
        searchBar.classList.toggle('active'); // Show or hide the search bar
    });

    // Close search bar when close button is clicked
    closeSearchBar.addEventListener('click', (e) => {
        searchBar.classList.remove('active'); // Hide the search bar
    });
</script>


<!-- JavaScript to handle image upload and preview -->
<script>
  document.getElementById('imageUpload').addEventListener('change', function(event) {
    const maxFiles = 3;
    const maxSize = 10 * 1024 * 1024; // 10MB in bytes
    const previewContainer = document.getElementById('previewContainer');
    const errorMessage = document.getElementById('errorMessage');
    previewContainer.innerHTML = ""; // Clear existing previews

    if (event.target.files.length > maxFiles) {
      alert("You can only upload up to 3 images.");
      return;
    }

    Array.from(event.target.files).forEach((file, index) => {
      if (file.size > maxSize) {
        errorMessage.style.display = 'block';
        return;
      } else {
        errorMessage.style.display = 'none';
      }

      const reader = new FileReader();
      reader.onload = function(e) {
        const imgWrapper = document.createElement("div");
        imgWrapper.classList.add("img-wrapper");
        imgWrapper.innerHTML = `
          <img src="${e.target.result}" alt="Uploaded Image Preview" class="preview-image">
          <span class="remove-sign" onclick="removeImage(${index})">&times;</span>
        `;
        previewContainer.appendChild(imgWrapper);
      };
      reader.readAsDataURL(file);
    });
  });

  function removeImage(index) {
    const previewContainer = document.getElementById('previewContainer');
    previewContainer.children[index].remove(); // Remove the preview
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-8w2NFxBQhX1MprMRHavvPiwRfxIWCu8rZib1/3VvqFT2R2p3mv3YI+N6JcB8o4tq"
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    

</body>

</html>








