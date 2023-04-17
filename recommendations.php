<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Recommendations</title>
    <!--<link href="style.css" rel="stylesheet" />-->
    <link href="style.css" rel="stylesheet" />
</head>
<body>

    <!--<img src="/images/Pn'C Movies Logo4.jpg" alt="Logo" width="200" />-->
    <ul>
    <li><img src="Pn'C Movies Logo4 SMALL.jpg" alt="Logo" width="200" /></li>
    <li><a href="login.php">Login</a></li>
        <li><a class="active" href="ConnectionW.php">Home</a></li>
        <li><a href="recommendations.php">Past Recommendations</a></li>
        <li><a href="aboutUs.html">About Us</a></li>
    </ul>

    <div class="box">
        <h2>Recommendations</h2>
        <!--title#, releaseYear#, link#: encase in <p></p> for each value and add unique id for each-->
        <!--The way that the link will work is a bit different, since you have to use the <a href> tag,
        i just dont know how we should implement that with the javascript and database-->
        <form id="searchForm">

            <label for="user">Username:</label>
            <input type="text" id="user" name="user">

            <button type="submit" id="submitBut">Search</button>

        </form>

        <p id="title1"></p>
        <p id="releaseYear1"></p>
        <a id="link1"></a>

        <p id="title2"></p>
        <p id="releaseYear2"></p>
        <a id="link2"></a>

        <p id="title3"></p>
        <p id="releaseYear3"></p>
        <a id="link3"></a>
        
        <button onclick="window.location.href = 'ConnectionW.php';" type="button">Retake</button>
    </div>
</body>
<script>

//Global Variables



function start(){

    var searchForm = document.getElementById("searchForm");
    searchForm.addEventListener("submit", displayRecs, false);
//No button, subfunction is called when the form is submitted. 
//var startButton = document.getElementById("startButton");


}

async function displayRecs(){

    event.preventDefault();
    var username = document.getElementById('user').value;
//Retrieve recs from table, right now user=admin 
  const formData1 = new FormData();
  formData1.append('user', username);
  
  const response1 = await fetch('display.php', {
      method: 'POST',
      body: formData1
    });

var results=await response1.json();

  console.log(results);
    //SET MOVIE 1
  document.getElementById("title1").innerHTML ="Title= "+results[0]["PrimaryTitle"];
    document.getElementById("releaseYear1").innerHTML ="Release Year= "+results[0]["ReleaseYear"];
    //EX LINK https://www.imdb.com/title/tt16428256/
    document.getElementById("link1").innerHTML ="Check on IMDB Website";
    var link1= document.getElementById("link1"); 
    link1.setAttribute("href", "https://www.imdb.com/title/"+results[0]["ID"]+"/");

    //SET MOVIE 2
    document.getElementById("title2").innerHTML ="Title= "+results[1]["PrimaryTitle"];
    document.getElementById("releaseYear2").innerHTML ="Release Year= "+results[1]["ReleaseYear"];
    //EX LINK https://www.imdb.com/title/tt16428256/
    document.getElementById("link2").innerHTML ="Check on IMDB Website";
    var link2= document.getElementById("link2"); 
    link2.setAttribute("href", "https://www.imdb.com/title/"+results[1]["ID"]+"/");
    //SET MOVIE 3
    document.getElementById("title3").innerHTML ="Title= "+results[2]["PrimaryTitle"];
    document.getElementById("releaseYear3").innerHTML ="Release Year= "+results[2]["ReleaseYear"];
    //EX LINK https://www.imdb.com/title/tt16428256/
    document.getElementById("link3").innerHTML ="Check on IMDB Website";
    var link3= document.getElementById("link3"); 
    link3.setAttribute("href", "https://www.imdb.com/title/"+results[2]["ID"]+"/");
}



window.addEventListener("load",start,true);
</script>
</html>