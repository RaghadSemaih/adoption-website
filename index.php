<?php

session_start(); 

$conn = new mysqli("localhost", "root", "", "adaptly");

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email && $password) {
    $query = $conn->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    if ($query->num_rows > 0) {
        $_SESSION['login'] = true;
    }
}

$loggedIn = $_SESSION['login'] ?? false;

?>




<!DOCTYPE html>
<html>

<head>
<title>Home page</title>
<meta charset="UTF-8">
</head>

<body>

<div id="divv">
<a href="https://successstoriesadoptly.netlify.app/" id="SS">Success stories</a>
<a href="http://localhost/projectWeb/q.php" id="FA">Frequently asked</a>
<a href="http://localhost/projectWeb/dashboard.php" id="DB">Dashboard</a>
<a href="http://localhost/projectWeb/signup.php" id="SU">Sign up</a>
<a href= "http://localhost/projectWeb/login.php" id="LN">Login</a>

</div> 

<hr id="hrr">

<div id= "div_main">
<h1 style= "color: #966443">Welcome to adaptly!</h1>
<h3 style="font-weight: normal;">Choose your new lovely pet from the avilable once below</h3>
<h3 style="font-weight: normal;">Your new loyal friend is waiting for you!</h3>
</div>

<br><br><br>
<section id="_pics" style="background-color: #C6A58E;">

<div class= "animal">
<img src="https://i.pinimg.com/736x/af/0a/40/af0a404f70739c5ac57701f359ba8ac2.jpg" alt="puppy">
<h2>shadow</h2>
<p>Male Rottweiler dog, loyal, brave, and a guardian who is always ready to protect his people,</p>
<button class= "b">select</button>
  
</div>

<div class= "animal">
<img src="https://i.pinimg.com/474x/05/41/2c/05412c712d2f0fa5a94bc87d5b6fb2ab.jpg" alt="dog">
<h2>Biscuit</h2>
<p>male golden retriver who has a heart full of joy and boundless energy, he's
ready to bring laughter and joy to his future family's life.</p>
<button class= "b">select</button>
</div>

<div class= "animal">
<img src="https://i.pinimg.com/474x/84/1b/70/841b7006de3aa3fc313b2a4ae52c481f.jpg" alt="rabbit" >
<h2>Snow</h2>
<p>female white bunny who is soft and sweet, she loves cuddles and the perfect pet for you!</p>
<button class= "b">select</button>
</div>

<div class= "animal">
<img src="https://i.pinimg.com/736x/a7/9f/d7/a79fd75168bb058a518772ff0550d656.jpg" alt="kitty">
<h2>Luna</h2>
<p>Female Ragdoll cat, calm and has moon-kissed beauty, perfect for people who love peaceful and quiet nights</p>
<button class= "b">select</button>
</div>

<div class= "animal">
<img src= "https://i.pinimg.com/736x/6d/62/b4/6d62b4c40b169706fb4bb8c248fff5e2.jpg" alt="kitty">
<h2>Pumpkin</h2>
<p>Male orange cat, a small kitty who is really friendly and loves adventure, he brings a spark to any home he enters. </p>
<button class= "b">select</button>
</div>

<div class= "animal">
<img src= "https://i.pinimg.com/736x/e6/e8/4d/e6e84dbcf4b545cff3b9f63f8b135164.jpg" alt="rabbit">
<h2>Daisy</h2>
<p>female white rabbit how is cuddley, friendly, and loves naps and queit places, her fur is so soft and pretty as her heart.</p>
<button class= "b">select</button>
</div>

<div class= "animal">
<img src= "https://i.pinimg.com/736x/6f/54/fd/6f54fd9b2cec804f6b9979c58a1e0734.jpg" alt="puppy">
<h2>Max</h2>
<p>Male husky who is Loyal and full of spark, Max was rescued from the streets and is now ready to be your brave little adventurer.</p>
<button class= "b">select</button>
</div>

<div class= "animal">
<img src= "https://i.pinimg.com/736x/94/a2/d0/94a2d07c4a5712608d95cd906ce0408b.jpg" alt="bird">
<h2>Sky</h2>
<p>female bird who brings peace and joy wherever she goes, Perfect for a calm, loving home filled with soft whispers and sweet melodies.</p>
<button class= "b">select</button>

</div>

<div class= "animal">
<img src= "https://i.pinimg.com/736x/2b/ae/76/2bae761abe0095be66600e68a37923fe.jpg" alt="hamster">
<h2>Cookie</h2>
<p>male hamster who is curious, clever, and loves building cozy nests, he’s ready for small-scale adventures with a big heart.</p>
<button class= "b">select</button>

</div>

<div class= "animal">
<img src= "https://i.pinimg.com/736x/13/f1/4f/13f14fa236ed1007033594a8fd7e5ee7.jpg" alt="rabbit">
<h2>kiki</h2>
<p>female rabbit who is a snuggly little companion who melts hearts with just one look. A sweet spirit who craves warmth and love.</p>
<button class= "b">select</button>
</div>
</section>

<style>

.b{
padding: 3px;
margin-left: 230px;
margin-bottom:20px;
}

#_pics {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 1.5rem;
  padding: 2rem;
  width: 100%;
  padding-left: 70px;
}

.animal {
  background-color: white;
  border-radius: 10px;
  box-shadow: 7px 4px 7px rgba(0,0,0,0.1);
  max-width: 300px;
  overflow: hidden;
  
}

.animal:hover {
  transform: translateY(-5px);
  transition: transform 0.2s ease;

}

.animal img {
  width: 100%;
  height:300px;
  object-fit: cover;
  display: block;

 }

.animal h2 {
  font-size: 1rem;
  margin: 1rem 1rem 1rem;
  font-family: Tahoma, Arial, sans-serif;
color: #966443;
}

.animal p {
  font-size: 1rem;
  margin: 0 1rem 1rem;
  color: #C6A58E;
  font-family: Tahoma, Arial, sans-serif;

}
#_pics{
}

#div_main{
margin-top: 50px;
padding: 10px;
text-align: center;
font-family: Tahoma, Arial, sans-serif;
font-weight: lighter;
color:#C6A58E;
}



#divv{ font-family: Tahoma, Arial, sans-serif;
font-size: 15px;
font-weight: lighter;
font-spacing: 3px;
margin-top: 20px;
}
#LN{
margin-left: 100px;
margin-right: 100px;
}
#FA{
margin-left: 100px;
margin-right: 100px;
}
#DB{
margin-left: 100px;
margin-right: 100px;
}

#SU{
margin-left: 100px;
margin-right: 100px;
}

#SS{
margin-left: 100px;
margin-right: 100px;
}

a:link{text-decoration:none; 
color: #966443;
;}

a:visited{text-decoration:none; 
color: #966443;
}

#hrr{border: 1px solid;
border-color:#D8B99C;
border-radius:2.5px;
margin-top: 20px;}


body{background-color:#FAF1EA;}

</style>

<script>

const buttons = document.getElementsByClassName("b");
var counter = 0;

<?php if ($loggedIn): ?>

  for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', function() {
      if(counter == 2){
        alert('You can only choose two pets at maximum.');
        return;
      }

      const result = confirm("Are you sure?");
      if (result){ 
        alert("Your request is confirmed");
        const message = document.createElement("p");
        message.textContent = "Pet Selected!";
        message.style.color = "green";
        message.style.fontWeight = "bold";

        buttons[i].parentNode.appendChild(message);
        buttons[i].style.display = "none";
        counter++;

      }
    });
  }

<?php else: ?>

  for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', function() {
      alert("Please login first to select a pet!");
    });
  }

<?php endif; ?>

</script>


</body>

</html>

