<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Filter Data</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar"); 
            });
        </script>

    </head>

    <body>
        <!--Navigation Bar-->
        <div id="navBar"></div>
        <!--Second Bar-->
        <div class = "secondBarContainer">
            <div class = "secondBar">
                <div class = "rightDiv">
                    <a href="logoff.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <form class = "centeredRectangle" action = "FilteredData.html">
            <h1 class = "H190Width" >Select properties to filter data</h1>
            <div class = "centeredItem" style = "margin-top:35px;">
                <select class = "filterSelector" name = "site">
                    <option selected value = "" disabled>-- Site --</option>
                    <option value = "option1">Lucas Heights</option>
                    <option value = "option2">Warrawong</option>
                    <option value = "option3">Option 3</option>
                </select>
                <select class = "filterSelector" name = "month">
                    <option selected value = '' disabled>-- Month --</option>
                    <option value = '1'>January</option>
                    <option value = '2'>February</option>
                    <option value = '3'>March</option>
                    <option value = '4'>April</option>
                    <option value = '5'>May</option>
                    <option value = '6'>June</option>
                    <option value = '7'>July</option>
                    <option value = '8'>August</option>
                    <option value = '9'>September</option>
                    <option value = '10'>October</option>
                    <option value = '11'>November</option>
                    <option value = '12'>December</option>
                </select>
                <input class = "filterSelector" type = "number" value = "2018"></input>
            </div>
            
            <div class = "bottomStripAbs">
                <input type = "submit" class = "confirmButton floatRight" value = "Confirm"></input>
            </div>
        </form>
    </body>
</html>