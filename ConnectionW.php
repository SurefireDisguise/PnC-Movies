<!--File: ConnectionW.php
Project: PnC
Author: PnC Development Team
History: Version 3.0 April 22, 2022-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Pn'C Movies</title>
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
        <h2>Quiz Part 1</h2>
        <p id="resultP"></p>
        <form id="searchForm" action="/action_page.php" method="post" >
            <!--Question 1-->
            <label for="genre">1. What is the primary genre you want to see?</label><br />
            <select id="genre" name="genre">
            <option value="Action">Action</option>
            <option value="Adventure">Adventure</option>
            <option value="Animation">Animation</option>
            <option value="Biography">Biography</option>
            <option value="Comedy">Comedy</option>
            <option value="Crime">Crime</option>
            <option value="Drama">Drama</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Film-Noir">Film-Noir</option>
            <option value="Horror">Horror</option>
            <option value="Mystery">Mystery</option>
            <option value="Romance">Romance</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Sport">Sport</option>
            <option value="Thriller">Thriller</option>
            <option value="War">War</option>
            <option value="Western">Western</option>
            </select><br />
            <!--Question 2-->
            <label for="fam">2. Are you watching alone or with family, friends, or a partner?</label><br />
            <select id="fam" name="fam">
                <option value="No">Alone</option>
                <option value="Yes">Family</option>
                <option value="No">Friends</option>
                <option value="No">Partner</option>
            </select><br />
            <!--Question 3-->
            <label for="rating">3. What rating do you want the movie to have?</label><br />
            <select id="rating" name="rating">
                <option value="Low">Low</option>
                <!--<option value="Medium">Medium</option>-->
                <option value="High">High</option>
                <!--<option value="Masterpiece">Masterpiece</option>-->
            </select><br />
            <!--Question 4-->
            <label for="decade">4. What decade do you want the movie to be from?</label><br />
            <select id="decade" name="decade">
                <option value="1910">1910s</option>
                <option value="1920">1920s</option>
                <option value="1930">1930s</option>
                <option value="1940">1940s</option>
                <option value="1950">1950s</option>
                <option value="1960">1960s</option>
                <option value="1970">1970s</option>
                <option value="1980">1980s</option>
                <option value="1990">1990s</option>
                <option value="2000">2000s</option>
                <option value="2010">2010s</option>
            </select><br />
            <!--Question 5-->
            <label for="runtime">5. How long should the movie's runtime be?</label><br />
            <select id="runtime" name="runtime">

                <option value="60">60 – 90 mins Around 1.5 hours</option>
                <option value="90">90 – 120 mins Around 2 hours</option>
                <option value="120">120 – 150 mins Around 2.5 hours</option>
                <option value="150">150 – 180 mins Around 3 hours</option>
                <option value="210">Over 210 mins Around 3.5 hours</option>
            </select><br />
            <!--Question 6-->
            <label for="pop">6. How popular do you want the movie to be?</label><br />
            <select id="pop" name="pop">
                <option value="Popular">Popular</option>
                <option value="Cult">Cult Classic</option>
                <option value="Hidden">Hidden Gem</option>
            </select><br />
            <!--Question 1-->
            <label for="genre2">7. What is the secondary genre you want to see?</label><br />
            <select id="genre2" name="genre2">
            <option value="Action">Action</option>
            <option value="Adventure">Adventure</option>
            <option value="Animation">Animation</option>
            <option value="Biography">Biography</option>
            <option value="Comedy">Comedy</option>
            <option value="Crime">Crime</option>
            <option value="Drama">Drama</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Film-Noir">Film-Noir</option>
            <option value="Horror">Horror</option>
            <option value="Mystery">Mystery</option>
            <option value="Romance">Romance</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Sport">Sport</option>
            <option value="Thriller">Thriller</option>
            <option value="War">War</option>
            <option value="Western">Western</option>
            </select><br />
            <!--Submit Button onclick="window.location.href = 'ConnectionW2.php';"-->
            <br>
            <button type="submit" id="submitBut">Submit</button>
        </form>

    </div>

</body>

<script type="text/javascript">

    
    //Global variables declaration
    var results=[]; 
    var q1=[];
    var q2=[];
    var q3=[]; 

    var actorArr=[];
    var actressArr=[];
    var directorArr=[]; 

    var actorN=[];
    var actressN=[];
    var directorN=[];


    //Start Function
    function start(){

    //subfunction is called when the form is submitted. 
    var searchForm = document.getElementById("searchForm");
    searchForm.addEventListener("submit", subFunction, false);
    
    }

    //SubFunction, async to send HTTP request. 
    async function subFunction(event){
      
      event.preventDefault();
      console.log("---------------------------------------------------------------------------------------------"); 

  //Receiving Family input
  const fam = document.getElementById('fam').value;

  //Receiving Genres input, genre 1 is used in first query genre 2 is used on the second query
  const genre = document.getElementById('genre').value;
  const genre2 = document.getElementById('genre2').value;

  //Receiving Avg rating of the movie.
  const rating = document.getElementById('rating').value;
    //TEST WITH ONLY LOW AND HIGH
  var avgRating=0.0; 

  
  if(rating=="Low"){
    avgRating=0.0;
  }
  else if(rating=="High"){
    avgRating=5.0;
  }
  

  /*
  if(rating=="Low"){
    avgRating=0.0;
  }
  else if(rating=="Medium"){
    avgRating=2.5;
  }
  else if(rating=="High"){
    avgRating=5.0;
  }
  else {
  if(rating=="Masterpiece"){
    avgRating=7.5;
  }
  }
  */

  //Receiving decade value
  const decade = document.getElementById('decade').value;
  //Receiving runtime value
  const runtime = document.getElementById('runtime').value;
  //Receiving popular value 
  const popularity = document.getElementById('pop').value; 

  //Have to pass the vote floor and ceiling for the query
  var voteCeiling=0;
  var voteFloor=0;

  //IF ELSE to find the number of votes limits
  //Test with two options
  if(popularity=="Popular"){
    voteCeiling=3000000;
    voteFloor=1000000;
  }
  else if(popularity=="Cult"){
    voteCeiling=1000000;
    voteFloor=100000;
  }
  else if(popularity=="Hidden"){
    voteCeiling=100000;
    voteFloor=1000;
  }

  //We gather the values and get the form data to send it to the php
  const formData = new FormData();
  formData.append('genre', genre);
  formData.append('genre2', genre2);
  formData.append('avgRating', avgRating);
  formData.append('decade', decade);
  formData.append('runtime', runtime);
  formData.append('voteCeiling', voteCeiling);
  formData.append('voteFloor', voteFloor);

  console.log(formData);

  // SEND THE HTTP request TO A SEPARATE PHP FILE
  
try {
  let response;
  if (fam == "Yes") {
    response = await fetch('searchF.php', {
      method: 'POST',
      body: formData
    });
  } else if (fam == "No") {
    response = await fetch('search.php', {
      method: 'POST',
      body: formData
    });
  }

  if (response.ok) {
    results = await response.json();
    if (results.Query1.length === 0) {
      throw new Error('No results found');
    }
    // Do something with the results array
  } else {
    throw new Error(`HTTP error! status: ${response.status}`);
  }

} catch (error) {
  document.getElementById("resultP").innerHTML ="We could not find a movie, please try again with different answers.";
  //throw new Error("An error has occurred. Please reload the page.");
}
  
  console.log("Result Array:"); 
  console.log(results); 


  //WORKING 
  q1 = results.Query1; //Results from query 1
  q2 = results.Query2; //Results from query 2 after filtering with genre2
  q3 = results.Query3; //Remaining movies from q1 sorted by avg rating in descending order. 
  //If Q2 is too small then we take movies from the q3. 
  
  console.log("Q1 :");
  console.log(q1);
  console.log("Q2 :");
  console.log(q2);
  console.log("Q3 :");
  console.log(q3);

  console.log("Q2 length:"); 
  console.log(q2.length);
  
  
  //Easier to handle if we always have 12  movies, less variability 
  if (q2.length<12){
    var counter=0;
    while (q2.length<12 && counter < q3.length){
        q2.push(q3[counter]);
        counter++;
        console.log(q2);
    }
  }
  else if (q2.length>12){
    q2.splice(12, q2.length-12);
  }
  
   
  console.log("Q2 Final:");
  console.log(q2);
  
  
  //Divide Q2 into the actor, actress and director arrays. 
  // Calculate the length of each subarray
    var subLen = Math.floor(q2.length / 3);

  //Could randomize array before dividing. 

  // Create the subarrays
  actorArr = q2.slice(0, subLen);
  actressArr = q2.slice(subLen, subLen * 2);
  directorArr = q2.slice(subLen * 2);

  console.log(actorArr);
  console.log(actorArr.length); 
  console.log(actressArr); 
  console.log(directorArr); 


  var category2="actor";
  var category3="actress";
  var category4="director";

  //FormData for Actors
  var formData2 = new FormData();

  formData2.append('category',category2);
  //Append the ids from the movies inside actor array
  formData2.append('ac1',actorArr[0]["ID"]);
  formData2.append('ac2', actorArr[1]["ID"]);
  formData2.append('ac3',actorArr[2]["ID"]);
  formData2.append('ac4', actorArr[3]["ID"]);
  console.log(formData2);


  //HTTP request sent to retrieve the names of actors. 
  const response2 = await fetch('searchT.php', {
        method: 'POST',
        body: formData2
      });

      actorN= await response2.json();
      console.log(actorN); 

  
    //FormData for Actress
    var formData3 = new FormData();
    formData3.append('category',category3);
    //Append the ids from the movies inside actor array
    formData3.append('ac1',actressArr[0]["ID"]);
    formData3.append('ac2', actressArr[1]["ID"]);
    formData3.append('ac3',actressArr[2]["ID"]);
    formData3.append('ac4', actressArr[3]["ID"]);
    console.log(formData2);
    
    //HTTP request to retrieve names
    const response3 = await fetch('searchT.php', {
          method: 'POST',
          body: formData3
        });

    actressN= await response3.json();
    console.log(actressN); 

    //FormData for directors
    var formData4 = new FormData();
    formData4.append('category',category4);
    //Append the ids from the movies inside actor array
    formData4.append('ac1',directorArr[0]["ID"]);
    formData4.append('ac2', directorArr[1]["ID"]);
    formData4.append('ac3',directorArr[2]["ID"]);
    formData4.append('ac4', directorArr[3]["ID"]);
    console.log(formData2);
    
    //HTTP request to retrieve names
    const response4 = await fetch('searchT.php', {
          method: 'POST',
          body: formData4
        });

        directorN= await response4.json();
        console.log(directorN);
        
        
    //Pass to next page for remaining of the quiz.
    window.location.href = 'ConnectionW2.php';
    }
    window.addEventListener("load",start,false);
    </script>
</html>