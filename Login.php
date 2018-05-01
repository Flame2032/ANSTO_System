<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>

    </head>

    <body>
        <!--This screen was made using bootstrap-->
        <div class = "container-fluid">
            <div class = "row justify-content-center">
                <div class = "col-auto "><img src="LOGOBlock.jpg"></div>
            </div>
            <!--Blue container-->
            <div class = "row justify-content-center">
                <div class = "col-auto" style = " width: 800px; padding: 50px 0px; margin-top: 10px; background-color: #0079c0;">
                    
                    <!--Login Title-->
                    <div class = "row justify-content-center">
                        <div class = "col-10">
                            <h1 class = "H190Width" style = "margin-top:0px; font-size:36px;">Login</h1>
                        </div>
                    </div>
                    <!--Login Form-->
                    <form action = "index.php">
                        <div class = "container-fluid">
                            <!--Username-->
                            <div class = "row justify-content-center" style = "margin-top:30px;">
                                <div class = "col-4">
                                    <input class = "form-control" type = "textbox" placeholder = "Username">
                                </div>
                            </div>
                            <!--Password-->
                            <div class = "row justify-content-center" style = "margin-top:30px;">
                                <div class = "col-4">
                                    <input class = "form-control" type = "password" placeholder = "Password">
                                </div>
                            </div>
                            <!--Confirm Button & Remember Me Checkbox-->
                            <div class = "row justify-content-center" style = "margin-top:30px;">
                                <div class = "col-4" style = "">
                                    <div class = "d-flex justify-content-between">
                                        <div class = "checkbox">
                                            <label style = "color: white;"><input type = "checkbox" style = "margin-right:10px;">Remember Me</label>
                                        </div>
                                        <input type = "submit" class = "btn btn-default" value = "Confirm"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>