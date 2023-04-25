
<!DOCTYPE html>
<html>
<head>
    <title>Pnc Movies</title>


   
</head>
<body>
    <h1>PnC Movies</h1>
    <form id="searchForm">
  <label for="genre">Genre:</label>
  <input type="text" id="genre" name="genre">
  
  <label for="rating">Rating:</label>
  <input type="text" id="rating" name="rating">
  
  <label for="decade">Decade:</label>
  <input type="text" id="decade" name="decade">

  <label for="Runtime">Runtime:</label>
  <input type="text" id="runtime" name="runtime">
  
  <button type="submit" id="submitBut">Search</button>

<h3> Result</h3>
<p id="resultP"></p>
<p id="resultP2"></p>
<p id="resultP3"></p>

</form>
</body>

<script type="text/javascript">

    //Declare variables outside so they can be used in other functions. 
    //Divide everything into functions. 
    var results=[]; 

    function start(){

    //No button, subfunction is called when the form is submitted. 
    var searchForm = document.getElementById("searchForm");
    searchForm.addEventListener("submit", subFunction, false);
    
    }

    //SubFunction, async to send HTTP request. 
    async function subFunction(event){
      
      event.preventDefault();
      console.log("Hello World"); 

  //Have to be able to pass multiple genres 
  const genre = document.getElementById('genre').value;
  const rating = document.getElementById('rating').value;
  //Have to take care of upper limit, more than 2023, no movies. If they want modern movies from the 20s, then top year  is 2023. 
  const decade = document.getElementById('decade').value;
  //Runtime 4 options, one hour 30 (90 minutes) to two hours (120), two hours to two hours 30(150 minutes), two hours 30 to 3 hours (180) 
  const runtime = document.getElementById('runtime').value;
  //Popular mmovie more than 1 million ratings, 500k to 1 million popular movie 500k to 200k cult movie less popular less than 100k not popular movies. 
  //For runtime passs two values, lower limit and upper limit. 
  //We gather the values and get the form data to send it to the php
  const formData = new FormData();
  formData.append('genre', genre);
  formData.append('rating', rating);
  formData.append('decade', decade);
  formData.append('runtime', runtime);

  // SEND THE HTTP request TO A SEPARATE PHP FILE
  const response = await fetch('search.php', {
    method: 'POST',
    body: formData
  });
  results = await response.json();
  console.log(results); 
    
    postResult();
    }
  

    function postResult(){

    var row1= results[0];
    console.log(row1);
    var result1= row1["PrimaryTitle"];
    var result2= row1["avgRating"];
    var result3= row1["ReleaseYear"];

    document.getElementById("resultP").innerHTML ="Title= "+result1;
    document.getElementById("resultP2").innerHTML ="Rating= "+result2;
    document.getElementById("resultP3").innerHTML ="Release Year= "+result3;

    
    }
    window.addEventListener("load",start,false);
    </script>
</html>