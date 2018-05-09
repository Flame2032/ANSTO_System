<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Scanning: Returned Filters</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            // Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar"); 
            });

            // Stop 'Enter' key from submitting the form
            $(document).ready(function() {
              $(window).keydown(function(event){
                if(event.keyCode == 13) {
                  event.preventDefault();
                  return false;
                }
              });
            });

            // Make the scanning textbox focus on load
            window.onload = function() {
              document.getElementById("scanTB").focus();
            };
        </script>

    </head>

    <body>
        <!--Navigation Bar-->
        <div id="navBar"></div>
        <!--Second Bar-->
        <div class = "secondBarContainer">
            <div class = "secondBar">
                <div class = "rightDiv">
                    <a href="login.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

         <div class = "container-ansto centered-800-X marginT-20" style = " width:600px;">
            <form action = "PostAnalysis.php" name = "numForm" method="POST" style = "margin:20px 0px;">
                <h1 class = "H290Width">Scan Filters</h1>

                <div class = "width-90 container-white">
                    <div class = "centeredItem" style = "padding:5px;">
                        Scan Next Barcode:
                        <input type = "textbox" id = "scanTB" style = "display:inline-block; width: ;">
                    </div>
                </div>
                
                <div class = "width-90 container-white" style = "margin-top:5px;">
                    <div class = "centeredItem" style = "padding:5px;">
                        Scanned Barcodes:
                    </div>
                    <div class = "centeredItem" style = "padding:2px;">
                        <ul id = "myList" name = "list" style = "padding:0px; margin:0px;">
                        </ul>
                    </div>
                </div>
                
                <div class = "strip width-90">
                    <input type = "submit" class = "btn-ansto font-16 floatRight" style = "margin:10px 0px;" value = "Finish Scanning">
                </div>
            </form>
        </div>

    </body>

    <script type="text/javascript">

        // Dynamically populate list each time 'Enter' is pressed (or barcode scanned)
        window.onkeyup = function(e) {
            if (e.keyCode === 13) {
                // Get textbox value
                var input = document.getElementById("scanTB").value;

                // Get list and create a new list item
                var myList = document.getElementById("myList");
                var li = document.createElement("li");
                li.className = "scanListItem";

                // Create the X icon for this list item
                var x = document.createElement("i");
                x.className = "fa fa-times hoverPoint";

                // Append the x icon and scanned barcode to the li element
                li.appendChild(x);
                var node = document.createTextNode(' ID: ' + input);
                li.appendChild(node);
                myList.appendChild(li);

                // Make textbox empty and refocus for the next scan
                document.getElementById("scanTB").value = "";
                document.getElementById("scanTB").focus();

                // Delete this if X is clicked
                x.onclick = function () {
                    li.removeChild(x);
                    li.removeChild(node);
                }
            }
        }
    </script>

</html>