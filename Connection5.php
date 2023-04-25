
<!DOCTYPE html>
<html>
<head>
    <title>Pnc Movies</title>


   
</head>
<body>
    <h1>PnC Movies</h1>
    <form id="searchForm">

  <label for="fam">Family:</label>
  <input type="text" id="fam" name="fam">

  <label for="genre">Genre:</label>
  <input type="text" id="genre" name="genre">

  <label for="genre2">Genre 2:</label>
  <input type="text" id="genre2" name="genre2">

  <label for="rating">Rating:</label>
  <input type="text" id="rating" name="rating">
  
  <label for="decade">Decade:</label>
  <input type="text" id="decade" name="decade">

  <label for="Runtime">Runtime:</label>
  <input type="text" id="runtime" name="runtime">

  <label for="pop">Popularity:</label>
  <input type="text" id="pop" name="runtime">
  
  <button type="submit" id="submitBut">Search</button>

<h3> Result</h3>
<p id="resultP"></p>
<p id="resultP2"></p>
<p id="resultP3"></p>
<p id="resultP4"></p>
<p id="resultP5"></p>



</form>
</body>

<script type="text/javascript">

    //Declare variables outside so they can be used in other functions. 
    //Divide everything into functions. 
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



    function start(){

    //No button, subfunction is called when the form is submitted. 
    var searchForm = document.getElementById("searchForm");
    searchForm.addEventListener("submit", subFunction, false);
    
    }

    //SubFunction, async to send HTTP request. 
    async function subFunction(event){
      
      event.preventDefault();
      console.log("---------------------------------------------------------------------------------------------"); 

  //Are they looking for a Family movie
  const fam = document.getElementById('fam').value;
  //Genres, genre 1 is used in first query genre 2 is used on the second query
  const genre = document.getElementById('genre').value;
  const genre2 = document.getElementById('genre2').value;

  //Avg rating of the movie. Create 4 groups of ratings. 
  // LOW SCORE 1.0 TO 4.0 , MEDIUM 4.0 TO 6.0 , HIGH 6.0 TO 8.0., VERY HIGH 8.0 TO 10.0
  const rating = document.getElementById('rating').value;

  var avgRating=0.0; 
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

  //Have to take care of upper limit, more than 2023, no movies. If they want modern movies from the 20s, then top year  is 2023. 
  const decade = document.getElementById('decade').value;
  //Runtime 4 options, one hour 30 (90 minutes) to two hours (120), two hours to two hours 30(150 minutes), two hours 30 to 3 hours (180) 
  const runtime = document.getElementById('runtime').value;
  //Blockbuster movie more than 1 million ratings, 500k to 1 million popular movie 500k to 100k cult movie less popular less than 100k not popular movies. 
  const popularity = document.getElementById('pop').value; 

  //Have to pass the vote floor and ceiling for the query
  var voteCeiling=0;
  var voteFloor=0;
  //IF ELSE to find the number of votes limits
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
    if (results.Query1.length == 0) {
      throw new Error('No results found');
    }
    // Do something with the results array
  } else {
    throw new Error(`HTTP error! status: ${response.status}`);
  }

} catch (error) {
  // Handle the error in a way that is appropriate for your application
  //console.error('Error:', error.message);
  document.getElementById("resultP").innerHTML ="We could not find a movie, please try again with different answers.";
  throw new Error("An error has occurred. Please reload the page.");
}
  
  console.log("Result Array:"); 
  console.log(results); 
  //WORKING 
  q1 = results.Query1; //Results from query 1
  q2 = results.Query2; //Results from query 2 after filtering with genre2
  q3 = results.Query3; //Remaining movies from q1 sorted by avg rating in descending order. If we need extra movies this is where we take 
  //If Q2 is too small then we take movies from the q3. Q3 is sorted in descending order depending on rating.  
  //console.log(q1);
  //console.log(q2);
  console.log("Q1 :");
  console.log(q1);
  console.log("Q2 :");
  console.log(q2);
  console.log("Q3 :");
  console.log(q3);

  console.log("Q2 length:"); 
  console.log(q2.length);
  //console.log(q3);
  
  
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

var formData2 = new FormData();

formData2.append('category',category2);
//Append the ids from the movies inside actor array
formData2.append('ac1',actorArr[0]["ID"]);
formData2.append('ac2', actorArr[1]["ID"]);
formData2.append('ac3',actorArr[2]["ID"]);
formData2.append('ac4', actorArr[3]["ID"]);
console.log(formData2);

const response2 = await fetch('searchT.php', {
      method: 'POST',
      body: formData2
    });

    actorN= await response2.json();
    console.log(actorN); 


var formData3 = new FormData();
formData3.append('category',category3);
//Append the ids from the movies inside actor array
formData3.append('ac1',actressArr[0]["ID"]);
formData3.append('ac2', actressArr[1]["ID"]);
formData3.append('ac3',actressArr[2]["ID"]);
formData3.append('ac4', actressArr[3]["ID"]);
console.log(formData2);

const response3 = await fetch('searchT.php', {
      method: 'POST',
      body: formData3
    });

    actressN= await response3.json();
    console.log(actressN); 

var formData4 = new FormData();
formData4.append('category',category4);
//Append the ids from the movies inside actor array
formData4.append('ac1',directorArr[0]["ID"]);
formData4.append('ac2', directorArr[1]["ID"]);
formData4.append('ac3',directorArr[2]["ID"]);
formData4.append('ac4', directorArr[3]["ID"]);
console.log(formData2);

const response4 = await fetch('searchT.php', {
      method: 'POST',
      body: formData4
    });

    directorN= await response4.json();
    console.log(directorN); 
  
  /*
  //GET ONLY NAMES INTO 3 ARRAYS
  var act1=actorN.Name1; 
  var act2=actorN.Name2;
  var act3=actorN.Name3;
  var act4=actorN.Name4;
  
  
    var actNames=[];
    actNames[0]=act1[0]["primaryName"];
    actNames[1]=act2[0]["primaryName"];
    actNames[2]=act3[0]["primaryName"];
    actNames[3]=act4[0]["primaryName"];

    console.log(actNames);
    */
    //HAVE TO PASS TO A DIFFERENT PAGE


  //Call Post results.
  postResult();
  
    }
  

    function postResult(){

    var row1= q1[0];
    console.log(row1);
    var result1= row1["PrimaryTitle"];
    var result2= row1["avgRating"];
    var result3= row1["ReleaseYear"];
    var result4= row1["numVotes"];

    document.getElementById("resultP").innerHTML ="Title= "+result1;
    document.getElementById("resultP2").innerHTML ="Rating= "+result2;
    document.getElementById("resultP3").innerHTML ="Release Year= "+result3;
    document.getElementById("resultP4").innerHTML ="Number of Votes= "+result4;
    }

    function getRandomNumber(length) {

    return Math.floor(Math.random() * length);

    }

    ///Function to generate random number for past recommendation table. 
    function generateRandomHex() {
  const digits = '0123456789abcdef';
  let hex = '';
  for (let i = 0; i < 10; i++) {
    hex += digits[Math.floor(Math.random() * 16)];
  }
  return hex;
}
    window.addEventListener("load",start,false);
    </script>
</html>