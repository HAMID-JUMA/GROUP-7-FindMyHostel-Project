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
    <link rel="stylesheet" href="style/Booking.css">

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





 <!-- @Jackson Add your content here  -->

 <div class="container">
    
    <div class="side-nav">    
    
     <form> 
        <!---search bar-->
        <input type="text" name="search"  class="search" placeholder="search" required> <br> 
          
        <!--price range bar-->
        <label for="price">Price range</label><br>
        <input type="range" id="price" name="price" min="0" max="100" value="50"><br><br><br>
        
        <!-- room type -->
        <label for="room-type">Room type</label><br>
        <select id="location" name="location">
            <option value="self-contained">self contained</option>
            <option value="non-self-contained">Non self contained</option>
        </select>
        

        <!-- rating -->
        <br><br><label>rating</label><br>
        <div class="rating">
            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">★</label>
            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">★</label>
            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">★</label>
            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">★</label>
            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">★</label>
        </div>
        
        <!-- Amenities -->
        <br><label for="Amenities">amenities</label><br>
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

        <!-- room capacity -->
        <br><br><br><label for="capacity">Room capacity</label><br>
        <select id="capacity" name="capacity">
            <option value="single">Single bed</option>
            <option value="double">Double beds</option>
            <option value="triple">Triple beds</option>
            <option value="quad">Quad beds</option>
                </select>  
   
         </form>  
    </div>
   
    <!--start main content-->
    <div class="main-cont">
        
        <div class="Hostel hst-1">
            <img src="img/room-1.jpg" >
            <div class="Hostel_content">
                <h3>Room 1</h3>
                <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
                <a href="booking-form.html" class="btn">Book now</a>
            </div>
        </div>
 

       <div class="Hostel hst-1">
           <img src="img/room-2.webp" >
           <div class="Hostel_content">
               <h3>Room 2</h3>
               <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
               <a href="booking-form.html" class="btn">Book now</a>
           </div>
       </div>

       <div class="Hostel hst-1">
        <img src="img/room-3.jpg" >
        <div class="Hostel_content">
            <h3>Room 3</h3>
            <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>

    <div class="Hostel hst-1">
        <img src="img/room-4.jpg" >
        <div class="Hostel_content">
            <h3>Room 4</h3>
            <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>

    <div class="Hostel hst-1">
        <img src="img/room-5.jpg" >
        <div class="Hostel_content">
            <h3>Room 5</h3>
            <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>

    <div class="Hostel hst-6">
        <img src="img/room-6.png" >
        <div class="Hostel_content">
            <h3>Room 6</h3>
            <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>

    <div class="grid-label" style="grid-column: span 2;"><b>Boys rooms</b></div>

    <div class="Hostel hst-1">
        <img src="img/room-7.jpg" >
        <div class="Hostel_content">
            <h3>Room 7</h3>
            <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>

    <div class="Hostel hst-1">
        <img src="img/room-8.jpg" >
        <div class="Hostel_content">
            <h3>Room 8</h3>
            <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>

    <div class="Hostel hst-1">
        <img src="img/room-1.jpg" >
        <div class="Hostel_content">
            <h3>Room 9</h3>
            <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>

    <div class="Hostel hst-1">
        <img src="img/room-2.webp" >
        <div class="Hostel_content">
            <h3>Room 10</h3>
            <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>

    <div class="Hostel hst-1">
        <img src="img/room-2.webp" >
        <div class="Hostel_content">
            <h3>Room 11</h3>
            <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>

    <div class="Hostel hst-1">
        <img src="img/room-3.jpg" >
        <div class="Hostel_content">
            <h3>Room 12</h3>
            <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>

   <!---starts modern hostels--> 
    <div class="grid-label" style="grid-column: span 2;"><b>MODERN HOSTELSs</b></div>
        
    <div class="Hostel hst-1">
        <img src="img/room-1.jpg" >
        <div class="Hostel_content">
            <h3>Room 1</h3>
            <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
            <a href="booking-form.html" class="btn">Book now</a>
        </div>
    </div>


   <div class="Hostel hst-1">
       <img src="img/room-2.webp" >
       <div class="Hostel_content">
           <h3>Room 2</h3>
           <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
           <a href="booking-form.html" class="btn">Book now</a>
       </div>
   </div>

   <div class="Hostel hst-1">
    <img src="img/room-3.jpg" >
    <div class="Hostel_content">
        <h3>Room 3</h3>
        <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>

<div class="Hostel hst-1">
    <img src="img/room-4.jpg" >
    <div class="Hostel_content">
        <h3>Room 4</h3>
        <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>

<div class="Hostel hst-1">
    <img src="img/room-5.jpg" >
    <div class="Hostel_content">
        <h3>Room 5</h3>
        <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>

<div class="Hostel hst-6">
    <img src="img/room-6.png" >
    <div class="Hostel_content">
        <h3>Room 6</h3>
        <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>

<div class="grid-label" style="grid-column: span 2;"><b>Boys rooms</b></div>

<div class="Hostel hst-1">
    <img src="img/room-7.jpg" >
    <div class="Hostel_content">
        <h3>Room 7</h3>
        <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>

<div class="Hostel hst-1">
    <img src="img/room-8.jpg" >
    <div class="Hostel_content">
        <h3>Room 8</h3>
        <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>

<div class="Hostel hst-1">
    <img src="img/room-1.jpg" >
    <div class="Hostel_content">
        <h3>Room 9</h3>
        <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>

<div class="Hostel hst-1">
    <img src="img/room-2.webp" >
    <div class="Hostel_content">
        <h3>Room 10</h3>
        <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>

<div class="Hostel hst-1">
    <img src="img/room-2.webp" >
    <div class="Hostel_content">
        <h3>Room 11</h3>
        <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>

<div class="Hostel hst-1">
    <img src="img/room-3.jpg" >
    <div class="Hostel_content">
        <h3>Room 12</h3>
        <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>       
   </div>
   
   <!---starts palm line hostels--> 
   <div class="grid-label" style="grid-column: span 2;"><b>PALMLINE HOSTELSs</b></div>
    
   <div class="Hostel hst-1">
    <img src="img/room-1.jpg" >
    <div class="Hostel_content">
        <h3>Room 1</h3>
        <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>


<div class="Hostel hst-1">
   <img src="img/room-2.webp" >
   <div class="Hostel_content">
       <h3>Room 2</h3>
       <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
       <a href="booking-form.html" class="btn">Book now</a>
   </div>
</div>

<div class="Hostel hst-1">
<img src="img/room-3.jpg" >
<div class="Hostel_content">
    <h3>Room 3</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-4.jpg" >
<div class="Hostel_content">
    <h3>Room 4</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-5.jpg" >
<div class="Hostel_content">
    <h3>Room 5</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-6">
<img src="img/room-6.png" >
<div class="Hostel_content">
    <h3>Room 6</h3>
    <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="grid-label" style="grid-column: span 2;"><b>Boys rooms</b></div>

<div class="Hostel hst-1">
<img src="img/room-7.jpg" >
<div class="Hostel_content">
    <h3>Room 7</h3>
    <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-8.jpg" >
<div class="Hostel_content">
    <h3>Room 8</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-1.jpg" >
<div class="Hostel_content">
    <h3>Room 9</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-2.webp" >
<div class="Hostel_content">
    <h3>Room 10</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-2.webp" >
<div class="Hostel_content">
    <h3>Room 11</h3>
    <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-3.jpg" >
<div class="Hostel_content">
    <h3>Room 12</h3>
    <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<!---starts modern hostels--> 
<div class="grid-label" style="grid-column: span 2;"><b>MODERN HOSTELSs</b></div>



<div class="Hostel hst-1">
<img src="img/room-1.jpg" >
<div class="Hostel_content">
    <h3>Room 1</h3>
    <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>


<div class="Hostel hst-1">
<img src="img/room-2.webp" >
<div class="Hostel_content">
   <h3>Room 2</h3>
   <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
   <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-3.jpg" >
<div class="Hostel_content">
<h3>Room 3</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-4.jpg" >
<div class="Hostel_content">
<h3>Room 4</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-5.jpg" >
<div class="Hostel_content">
<h3>Room 5</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-6">
<img src="img/room-6.png" >
<div class="Hostel_content">
<h3>Room 6</h3>
<p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>


<div class="Hostel hst-1">
<img src="img/room-7.jpg" >
<div class="Hostel_content">
<h3>Room 7</h3>
<p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-8.jpg" >
<div class="Hostel_content">
<h3>Room 8</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-1.jpg" >
<div class="Hostel_content">
<h3>Room 9</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-2.webp" >
<div class="Hostel_content">
<h3>Room 10</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-2.webp" >
<div class="Hostel_content">
<h3>Room 11</h3>
<p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-3.jpg" >
<div class="Hostel_content">
<h3>Room 12</h3>
<p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>       
</div>
   
   <!---starts royalty hostels--> 
   <div class="grid-label" style="grid-column: span 2;"><b>ROYALTY HOSTELSs</b></div>
   
   <div class="Hostel hst-1">
    <img src="img/room-1.jpg" >
    <div class="Hostel_content">
        <h3>Room 1</h3>
        <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
        <a href="booking-form.html" class="btn">Book now</a>
    </div>
</div>


<div class="Hostel hst-1">
   <img src="img/room-2.webp" >
   <div class="Hostel_content">
       <h3>Room 2</h3>
       <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
       <a href="booking-form.html" class="btn">Book now</a>
   </div>
</div>

<div class="Hostel hst-1">
<img src="img/room-3.jpg" >
<div class="Hostel_content">
    <h3>Room 3</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-4.jpg" >
<div class="Hostel_content">
    <h3>Room 4</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-5.jpg" >
<div class="Hostel_content">
    <h3>Room 5</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-6">
<img src="img/room-6.png" >
<div class="Hostel_content">
    <h3>Room 6</h3>
    <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="grid-label" style="grid-column: span 2;"><b>Boys rooms</b></div>

<div class="Hostel hst-1">
<img src="img/room-7.jpg" >
<div class="Hostel_content">
    <h3>Room 7</h3>
    <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-8.jpg" >
<div class="Hostel_content">
    <h3>Room 8</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-1.jpg" >
<div class="Hostel_content">
    <h3>Room 9</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-2.webp" >
<div class="Hostel_content">
    <h3>Room 10</h3>
    <p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-2.webp" >
<div class="Hostel_content">
    <h3>Room 11</h3>
    <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-3.jpg" >
<div class="Hostel_content">
    <h3>Room 12</h3>
    <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<!---starts modern hostels--> 
<div class="grid-label" style="grid-column: span 2;"><b>MODERN HOSTELSs</b></div>

<div class="Hostel hst-1">
<img src="img/room-1.jpg" >
<div class="Hostel_content">
    <h3>Room 1</h3>
    <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
    <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>


<div class="Hostel hst-1">
<img src="img/room-2.webp" >
<div class="Hostel_content">
   <h3>Room 2</h3>
   <p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
   <a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-3.jpg" >
<div class="Hostel_content">
<h3>Room 3</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-4.jpg" >
<div class="Hostel_content">
<h3>Room 4</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-5.jpg" >
<div class="Hostel_content">
<h3>Room 5</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-6">
<img src="img/room-6.png" >
<div class="Hostel_content">
<h3>Room 6</h3>
<p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="grid-label" style="grid-column: span 2;"><b>Boys rooms</b></div>

<div class="Hostel hst-1">
<img src="img/room-7.jpg" >
<div class="Hostel_content">
<h3>Room 7</h3>
<p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-8.jpg" >
<div class="Hostel_content">
<h3>Room 8</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-1.jpg" >
<div class="Hostel_content">
<h3>Room 9</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-2.webp" >
<div class="Hostel_content">
<h3>Room 10</h3>
<p>Not self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-2.webp" >
<div class="Hostel_content">
<h3>Room 11</h3>
<p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>
</div>

<div class="Hostel hst-1">
<img src="img/room-3.jpg" >
<div class="Hostel_content">
<h3>Room 12</h3>
<p>self contained <br> capacity: 2 people<br> price: mwk 70,000 <br> available space: 2<br> </p>
<a href="booking-form.html" class="btn">Book now</a>
</div>       
</div>
   
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