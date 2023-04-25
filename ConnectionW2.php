<!--File: ConnectionW2.php
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
        <h2>Quiz Part 2</h2>
        <button type="button" id="startButton" onclick="subFunction()">Populate</button>

        <form id="searchForm" action="/action_page.php" method="post">
            <!--Question 8-->
            <label for="actor">8. Pick your favorite actor.</label><br />
            <select id="actorDrop" name="actor">
                
                <!--<option value="nota">None of the Above</option>-->
            </select><br />
            <!--Question -->
            <label for="actress">9. Pick your favorite actress.</label><br />
            <select id="actressDrop" name="actress">
                
                <!--<option value="nota">None of the Above</option>-->
            </select><br />
            <!--Question 10-->
            <label for="director">10. Pick your favorite director.</label><br />
            <select id="directorDrop" name="director">
                
                <!--<option value="nota">None of the Above</option>-->
            </select><br />


            <!--Submit Button  -->
            <br>
            <button type="submit">Submit</button>
        </form>

    </div>

</body>
<script>

  //Global Variables
  var actorN = [];
  var actressN = [];
  var directorN = [];

  var actNames=[];

  var act1=[]; 
  var act2=[];
  var act3=[];
  var act4=[];


  var actressNames=[];

  var actress1= []; 
  var actress2= [];
  var actress3= [];
  var actress4=[];


  var dicNames=[];

  var dic1=[]; 
  var dic2=[];
  var dic3=[];
  var dic4=[];

  var id1; 
  var id2;
  var id3; 

  //Get dropdown button values. 
  const actorDropdown = document.getElementById('actorDrop');
  const actressDropdown = document.getElementById('actressDrop');
  const directorDropdown = document.getElementById('directorDrop');


function start(){

//No button, subfunction is called when the form is submitted. 
//var startButton = document.getElementById("startButton");


}


async function subFunction(){

  event.preventDefault();
  console.log("---------------------------------------------------------------------------------------------"); 


  var category1="actor";
  var category2="actress";
  var category3="director";

  //FormData to extract the actor names for all movies
  var formData1= new FormData();
  formData1.append('category',category1);

  //HTTP request to getN.php
  const response = await fetch('getN.php', {
        method: 'POST',
        body: formData1
      });

      actorN= await response.json();
      console.log(actorN); 

  //Save results into arrays:
  act1=actorN.Name1; 
  act2=actorN.Name2;
  act3=actorN.Name3;
  act4=actorN.Name4;

  //Handle if there no name for the movie. 
  if (act1.length > 0) {
    actNames[0] = act1[0]["primaryName"];
  } else {
    actNames[0] = "Empty Space";
  }

  if (act2.length > 0) {
    actNames[1] = act2[0]["primaryName"];
  } 
  else {
    actNames[1] = "Empty Space";
  }

  if (act3.length > 0) {
    actNames[2] = act3[0]["primaryName"];
  } 
  else {
    actNames[2] = "Empty Space";
  }

  if (act4.length > 0) {
    actNames[3] = act4[0]["primaryName"];
  } 
  else {
    actNames[3] = "Empty Space";
  }
    
  console.log(actNames);

  //FormData to access the Actress Names for all movies
  var formData2= new FormData();
  formData2.append('category',category2);

  //HTTP request 
  const response2 = await fetch('getN.php', {
        method: 'POST',
        body: formData2
      });

  actressN= await response2.json();
  console.log(actressN); 
  
  //Save results into arrays:
  actress1=actressN.Name1; 
  actress2=actressN.Name2;
  actress3=actressN.Name3;
  actress4=actressN.Name4;
  
  
    
  //Handle if there no name for the movie. 
  if( actress1.length > 0){
    actressNames[0] = actress1[0]["primaryName"];
  }
  else{
    actressNames[0] = "Empty Space";
  }
  if (actress2.length > 0) {
    actressNames[1] = actress2[0]["primaryName"];
  }
  else{
    actressNames[1] = "Empty Space"; 
  }
  if (actress3.length > 0) {
    actressNames[2] = actress3[0]["primaryName"];
  }
  else{
    actressNames[2] = "Empty Space"; 
  }
  if( actress4.length > 0){
    actressNames[3] = actress4[0]["primaryName"];
  }
  else{
    actressNames[3] = "Empty Space"; 
  }
    
  console.log(actressNames);

  //FormData to get Director Names
  var formData3= new FormData();
  formData3.append('category',category3);


  const response3 = await fetch('getN.php', {
        method: 'POST',
        body: formData3
      });

  directorN= await response3.json();
  console.log(directorN); 

  dic1=directorN.Name1; 
  dic2=directorN.Name2;
  dic3=directorN.Name3;
  dic4=directorN.Name4;
  
  
  //Handle if there no name for the movie. 
  if (dic1.length > 0) {
  dicNames[0]= dic1[0]["primaryName"];
  } 
  else {
    dicNames[0] = "Empty Space";
  }

  if (dic2.length > 0) {
      dicNames[1]= dic2[0]["primaryName"];
  } 
  else {
      dicNames[1] = "Empty Space";
  }

  if (dic3.length > 0) {
      dicNames[2]= dic3[0]["primaryName"];
  } 
  else {
      dicNames[2] = "Empty Space";
  }

  if (dic4.length > 0) {
      dicNames[3]= dic4[0]["primaryName"];
  } 
  else {
      dicNames[3] = "Empty Space";
  }

    console.log(dicNames);

  //WIPE TABLE names_table. For next time the program runs. 
  const wipe = await fetch('wipeN.php', {
      method: 'POST',
    });

    var messageW= await wipe.json();
    console.log(messageW);

  //Pass Names into the dropdown buttons
  for (let i = 0; i <= actNames.length-1; i++) {
    const option = document.createElement('option');
    option.text = actNames[i];
    option.value = actNames[i];
      if (option.value === "Empty Space") {
      option.disabled = true;
    }
    actorDropdown.add(option);
  }

  for (let i = 0; i <= actressNames.length-1; i++) {
    const option = document.createElement('option');
    option.text = actressNames[i];
    option.value = actressNames[i];
      if (option.value === "Empty Space") {
      option.disabled = true;
    }
    actressDropdown.add(option);
  }

  for (let i = 0; i <= dicNames.length-1; i++) {
    const option = document.createElement('option');
    option.text = dicNames[i];
    option.value = dicNames[i];
      if (option.value === "Empty Space") {
      option.disabled = true;
    }
    directorDropdown.add(option);
  }

  //When order is submitted getAnswer function is called. 
  var searchForm = document.getElementById("searchForm");
  searchForm.addEventListener("submit", getAnswer, false);
}

function getAnswer(){

  event.preventDefault();
  var answer1 =actorDropdown.value;
  var answer2 = actressDropdown.value;
  var answer3 = directorDropdown.value;

 
  //Get actor ID
    if (answer1 == actNames[0]){
        id1= act1[0]["ID"];
    }
    else if (answer1 == actNames[1]){
        id1= act2[0]["ID"];
    }
    else if (answer1 == actNames[2]){
        id1= act3[0]["ID"];
    }
    else {
        id1= act4[0]["ID"];
    }

    //Get actress ID
    if (answer2 == actressNames[0]){
        id2= actress1[0]["ID"];
    }
    else if (answer2 == actressNames[1]){
        id2= actress2[0]["ID"];
    }
    else if (answer2 == actressNames[2]){
        id2= actress3[0]["ID"];
    }
    else if (answer2 == actressNames[3]){
        id2= actress4[0]["ID"];
    }

    //Get director ID
    if (answer3 == dicNames[0]){
        id3= dic1[0]["ID"];
    }
    else if (answer3 == dicNames[1]){
        id3= dic2[0]["ID"];
    }
    else if (answer3 == dicNames[2]){
        id3= dic3[0]["ID"];
    }
    else {
        id3= dic4[0]["ID"];
    }

  console.log(answer1, answer2, answer3);
  console.log(id1, id2, id3);

  saveRecs();
  }

  async function saveRecs(){

    //Save Movies into past recommendation table.

    //Generate random number to identify past recs 
    var recNum= generateRandomHex(); 

    //FormData to save rec1
    const formData1 = new FormData();
    formData1.append('ID', id1);
    formData1.append('recNum', recNum);
    
    const response1 = await fetch('addRecs.php', {
        method: 'POST',
        body: formData1
      });

    var results1=await response1.json();

    console.log(results1);

    //FormData to save rec2
    const formData2 = new FormData();
    formData2.append('ID', id2);
    formData2.append('recNum', recNum);
    
    const response2 = await fetch('addRecs.php', {
        method: 'POST',
        body: formData2
      });

    var results2=await response2.json();

    console.log(results2);

    //FormData to save rec3
    const formData3 = new FormData();
    formData3.append('ID', id3);
    formData3.append('recNum', recNum);
    
    const response3 = await fetch('addRecs.php', {
        method: 'POST',
        body: formData3
      });

    var results3=await response3.json();

    console.log(results3);

    //FormData to save recnum into user sign in table. 
    const formData4 = new FormData();
    formData4.append('recNum', recNum);
    formData4.append('username',"admin");

    const response4 = await fetch('pastRecs.php', {
        method: 'POST',
        body: formData4
      });

    var results4=await response4.json();
    console.log(results4);
    
    //Passing into recommendations page. 
    window.location.href = 'recommendations.php';
  }


//Function generates a random hexadecimal number
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