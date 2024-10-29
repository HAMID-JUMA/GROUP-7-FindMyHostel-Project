<!DOCTYPE html>
<html lang="en">

<head>
    <title>FindMyHostel</title>
    <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1.0">
    
    <!-- Google fonts "poppins" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- main stylesheets -->
    <link rel="stylesheet" href="style/Style.css">
    <link rel="stylesheet" href="style/Hostel.css">

    <!-- CSS for poppins font -->
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
       
    </style>
</head>

<body>
    <!-- Banner starts here -->
<div class="banner">
    <div class="navbar">
        <img src="img/icons/logo.png" class="logo">  
        <ul>
            <li><a href="student_home.php">Home</a></li>
            <li><a href="Hostels.php">Hostels</a></li>
            <li><a href="Booking.php">Booking</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
        </ul>
        <div class="book_dv">
            <a href="Hostels.html" class="book_btn">Book Now</a>
            <a href="#" >
                <img src="img/icons/user.png" class="profile"> <!--no link to the profile currently-->
            </a> 
        </div>
    </div>
</div>

<!-- Banner ends here -->


 <!-- @Jackson Add your content here --> 
<div class="container">
    
 <div class="side-nav">    
    <!---search bar-->
    
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search here..."><br><br><br>
    </div>
   
    <!--price range bar-->

<label for="price">price range</label>
<input type="range" id="price" name="price" min="0" max="100" value="50"><br><br><br>

<label for="location">location</label><br>
<select id="location" name="location">
    <option value=mmina">mmina</option>
    <option value=mmina">mmina</option>
    <option value=mmina">mmina</option>
    <option value=mmina">mmina</option>
    <option value=mmina">mmina</option>
</select>

<br><br><br><label>rating</label><br>
<div class="rating">
   
    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">★</label>
    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">★</label>
    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">★</label>
    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">★</label>
    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">★</label>
</div>

<br><br><br><label>amenities</label><br>
<select id="amenities" name="amenities">
    <option value="security-guards">security security-guards</option>
    <option value="house-keeping">House keeping</option>
    <option value="parking-space">parking space</option>
    <option value="gym">gym/fitness room</option>
    <option value="kitchen">kitchen</option>
    <option value="parking-space">wi-fi</option>
    <option value="laundry-room">laundry room</option>
    <option value="lounge">Lounge</option>
</select>

<br><br><br><label>proximity to campus (km)</label><br>
<input type="range" id="distance" name="distance" min="0" max="100" value="50">


<!-- Hostel listing starts here -->
 </div>
 <div class="main-cont">

    <div class="Hostel hst-1">
        <img src="img/hostel-1.jpg" >
        <div class="Hostel_content">
            <h3>Leos</h3>
            <p>Mina Village  <br> MK 50,000 - 70,000 <br> 500m SW main entrance <br> your comfort, our priority<br> </p>
            <a href="" class="btn">Book now</a>
        </div>
    </div>

    <div class="Hostel hst-2 ">
        <img src="img/hostel-2.jpeg" >
        <div class="Hostel_content">
            <h3>Morden Hostels</h3>
            <p>Mina Village  <br> MK 60,000 - 70,000 <br> 800m North main entrance <br> Conducive for your excellence</p>
            <a href="Booking.html" class="btn">Book Now</a>
        </div>
    </div>

    <div class="Hostel Hst-3">
        <img src="img/hostel-5.jpeg" >
        <div class="Hostel_content">
            <h3>Palmline</h3>
            <p>Mina Village  <br> MK 80,000 - 120,000 <br> 200m West main entrance <br> Excellence starts with opulence</p>
            <a href="" class="btn">Book Now</a>
        </div>
    </div>

    
    <div class="Hostel Hst-4">
        <img src="img/hostel-4.jpeg" >
        <div class="Hostel_content">
            <h3>Royalty</h3>
            <p>Mina Village  <br> MK 50,000 - 70,000 <br> 500m SW main entrance <br> Experience the Luxury</p>
            <a href="" class="btn">Book Now</a>
        </div>
    </div>

    <div class="Hostel hst-5">
        <img src="img/hostel-1.jpg" >
        <div class="Hostel_content">
            <h3>Kwa Anaphiri</h3>
            <p>Mina Village  <br> MK 50,000 - 70,000 <br> 700m SW main entrance <br> your comfort, our priority<br> </p>
            <a href="" class="btn">Book now</a>
        </div>
    </div>

    <div class="Hostel hst-6 ">
        <img src="img/hostel-2.jpeg" >
        <div class="Hostel_content">
            <h3>Kwa ma-Gre</h3>
            <p>Mina Village  <br> MK 50,000 <br> 600m west main entrance <br> Conducive for your excellence</p>
            <a href="Booking.html" class="btn">Book Now</a>
        </div>
    </div>
    
</div>
<!-- Hostel listing ends here -->

 </div>
</div>




<!-- Footer Starts here-->
<div class="Footer">
    <!-- Quick links -->
    <div class="Ft Pages">
        <ul>
            <h3>PAGES</h3>
            <li><a href="Home.html">Home</a></li>
            <li><a href="Hostels.html">Hostels</a></li>
            <li><a href="Booking.html">Booking</a></li>
            <li><a href="Contac Us.html">Contact Us</a></li>
        </ul>

    </div>

    <!-- Quick Links -->
    <div class="Ft Quick_links">
        <ul>
            <h3>QUICK LINKS</h3>
            <li><a href="#About_us">About Us</a></li>
            <li><a href="#Trust">Why Trusting Us</a></li>
            <li><a href="#FHostels">Featured Hostels</a></li>
            <li><a href="#Gallery">Gallery</a></li>
            <li><a href="#Testimonials">Testimonials</a></li>
        </ul>
    </div>


    <!-- help -->
    <div class="Ft Help">
        <ul>
            <h3>HELP</h3>
            <li><a href="#FAQ">FAQ</a></li>
            <li><a href="Contac Us.html">Contact Us</a></li>
        </ul>

    </div>


    <!-- Sign Up -->
    <div class="Ft Register">
        <p>Signup to get 100% off your first booking</p> <br>

        <form> 
            <input type="email" id="Signup_email" placeholder=" Enter Your Email Address Here"> 

        </form>

        <button id="Signup">Sign up</button>

        <a href="Home.html">
            <img src="img/icons/logo.png" style="transform: translateY(-20px); width:58px; height: 58px;">
        </a>
        <img src="img/icons/ig.png">
        <img src="img/icons/x.png">
        <img src="img/icons/fb.png">

    </div>
</div>


<!-- Copyright info -->
<div class="Copy_right">
    <p>&copy; 2024, System Design Aces. All Rights Reserved</p>
</div>

</body>
</html>