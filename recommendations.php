<!--File: recommendations.php
Project: PnC
Author: PnC Development Team
History: Version 3.0 April 22, 2022-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Recommendations</title>
    <link href="style.css" rel="stylesheet" />
</head>
<body>

    <ul>
    <li><img src="Pn'C Movies Logo4 SMALL.jpg" alt="Logo" width="200" /></li>
    <li><a href="login.php">Login</a></li>
        <li><a class="active" href="ConnectionW.php">Home</a></li>
        <li><a href="recommendations.php">Past Recommendations</a></li>
        <li><a href="aboutUs.html">About Us</a></li>
    </ul>

    <div class="box">
        <h2>Recommendations</h2>

        <form id="searchForm">

            <label for="user">Username:</label>
            <input type="text" id="user" name="user">

            <button type="submit" id="submitBut">Search</button>

        </form>
        <!--Movie Rec 1-->
        <p id="title1"></p>
        <p id="releaseYear1"></p>
        <a id="link1"></a>
        <!--Movie Rec 2-->
        <p id="title2"></p>
        <p id="releaseYear2"></p>
        <a id="link2"></a>
        <!--Movie Rec 3-->
        <p id="title3"></p>
        <p id="releaseYear3"></p>
        <a id="link3"></a>
        <br>
        
        <button onclick="window.location.href = 'ConnectionW.php';" type="button">Retake</button>
    </div>
</body>
<script>



function start(){

    var searchForm = document.getElementById("searchForm");
    searchForm.addEventListener("submit", displayRecs, false);

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
    document.getElementById("title1").innerHTML ="Title: "+results[0]["PrimaryTitle"];
    document.getElementById("releaseYear1").innerHTML ="Release Year: "+results[0]["ReleaseYear"];
    document.getElementById("link1").innerHTML ="Check on IMDB Website";
    var link1= document.getElementById("link1"); 
    link1.setAttribute("href", "https://www.imdb.com/title/"+results[0]["ID"]+"/");

    //SET MOVIE 2
    document.getElementById("title2").innerHTML ="Title: "+results[1]["PrimaryTitle"];
    document.getElementById("releaseYear2").innerHTML ="Release Year: "+results[1]["ReleaseYear"];
    document.getElementById("link2").innerHTML ="Check on IMDB Website";
    var link2= document.getElementById("link2"); 
    link2.setAttribute("href", "https://www.imdb.com/title/"+results[1]["ID"]+"/");
    //SET MOVIE 3
    document.getElementById("title3").innerHTML ="Title: "+results[2]["PrimaryTitle"];
    document.getElementById("releaseYear3").innerHTML ="Release Year: "+results[2]["ReleaseYear"];
    document.getElementById("link3").innerHTML ="Check on IMDB Website";
    var link3= document.getElementById("link3"); 
    link3.setAttribute("href", "https://www.imdb.com/title/"+results[2]["ID"]+"/");
}



window.addEventListener("load",start,true);
</script>
</html>