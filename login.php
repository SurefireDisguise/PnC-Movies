<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login/Signup Page</title>
    <!--<link rel="stylesheet" href="styles2.css">-->
    <link href="style2.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <ul>
    <li><img src="Pn'C Movies Logo4 SMALL.jpg" alt="Logo" width="200" /></li>
    <li><a href="login.php">Login</a></li>
        <li><a class="active" href="ConnectionW.php">Home</a></li>
        <li><a href="recommendations.php">Past Recommendations</a></li>
        <li><a href="aboutUs.html">About Us</a></li>
    </ul>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                Login
            </div>
            <div class="title signup">
                Sign Up
            </div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Sign Up</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form action="loginConnection.php" method="POST" class="login">
                    <div class="field">
                        <input type="text" placeholder="Username" required name="username_Value" id="username_Value">
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Password" required name="password_Value" id="password_Value">
                    </div>
                    <div class="pass-link">
                        <a href="#">Forgot password?</a>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Login" id="submit_value">
                    </div>
                    <div class="signup-link">
                        Not a member? <a href="">Signup now</a>
                    </div>
                </form>
                <form action="SignUpConnection.php" method="POST" class="signup" novalidate>
                    <div class="field">
                        <input type="text" placeholder="Username" required name="signup_username_value" id=" signup_username_value">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Email Address" required name="signup_email_value" id="signup_email_value">
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Password" required name="signup_password_value" id="signup_password_value">
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Confirm password" required name="signup_password_confirm_value" id="signup_password_confirm_value">
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Signup" id="submit_value_signup">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
         // Grabs values from the email and password input field of Login
         const emailValue = document.getElementById("username_Value");
         const passwordValue = document.getElementById("password_Value");

         // Grabs values from the email and password input field of SignUp
         const usernameValueSignUp = document.getElementById("signup_username_value")
         const emailValueSignUp = document.getElementById("signup_email_value");
         const passwordValueSignUp = document.getElementById("signup_password_value");
         const passwordConfirmValueSignUp = document.getElementById("signup_password_confirm_value");

         const loginText = document.querySelector(".title-text .login");
         const loginForm = document.querySelector("form.login");
         const loginBtn = document.querySelector("label.login");
         const signupBtn = document.querySelector("label.signup");
         const signupLink = document.querySelector("form .signup-link a");
         signupBtn.onclick = (()=>{
           loginForm.style.marginLeft = "-50%";
           loginText.style.marginLeft = "-50%";
         });
         loginBtn.onclick = (()=>{
           loginForm.style.marginLeft = "0%";
           loginText.style.marginLeft = "0%";
         });
         signupLink.onclick = (()=>{
           signupBtn.click();
           return false;
         });

         // On Submit button click it will run this code for Login
         document.getElementById("submit_value").addEventListener("click", () => {
         console.log(emailValue.value);
         console.log(passwordValue.value);
         });

         // On Submit button click it will run this code for SignUp
         document.getElementById("submit_value_signup").addEventListener("click", () => {
         console.log(emailValueSignUp.value);
         console.log(passwordValueSignUp.value);
         console.log(passwordConfirmValueSignUp.value);
         });

    </script>


   


</body>
</html>