<!DOCTYPE html>
<html>
    <head>
        <title>WEBAPP</title>
        <link rel="stylesheet" href="frontpage_class.css">
    </head>
    <body style="background-image: url('paste image here'); background-size: cover;">
        <h1 class="center2">Please Sign in to access the Website</h1>
        <div class="signin">
            <div class="unpw">
                <form action="signin.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                    <br><br>
                    <label for="password">Password:</label>
                    <input name="password" id="password" type="password">
                    <br><br>
                    <label for="email">Email Address:</label>
                    <input name="email" id="email" type="text">
                    <br><br>
                    <label for="phone">Phone Numeber:</label>
                    <input name="phone" id="phone" type="number">
                    <br><br>
                    <div>
                        <label for="age">DOB: </label>
                      <input type="date" id="age" name="age">
                      <br><br><br>
                      <div class="margin_right">
                        <p>Gender: </p>
                        <label for="gender">Male</label>
                        <input name="gender" id="gender" type="radio" value="male">
                        <label for="gender">Female</label>
                        <input name="gender" id="gender" type="radio" value="female">
                      </div>
                      
                    </div>
                    <br><br><br><br><br><br>
                    <input disabled type="submit" class="button2" value="Create Account" name="submit" id="aw" >
           
                </form>
            </div>
            <div class="signup">
                <br>
                <a href="index.html">
                    <button class="button1">Login page</button>
                </a>
            </div>
            <p style="display: none;"><?php 
                $connection = mysqli_connect('localhost', 'root', '', 'social_media');
                
            ?></p>
        </div>
        <script>
            document.addEventListener("mousemove", function(){
                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;
                var email = document.getElementById('email').value;
                var phone = document.getElementById('phone').value;
                var age = document.getElementById('age').value;
                var gender = document.getElementById('gender').value;
                function username(){
                    
                }
                if(username != "" && password != "" && email != "" && phone != "" && age != "" && gender != "")
                {
                    document.getElementById('aw').disabled = false;
                }
            });
            

        </script>
    </body>
</html>