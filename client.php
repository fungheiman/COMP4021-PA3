<?php

if (!isset($_COOKIE["name"])) {
    header("Location: error.html");
    return;
}

// get the name from cookie
$name = $_COOKIE["name"];

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Add Message Page</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript">
        //<![CDATA[
        function load() {
            var name = "<?php print $name; ?>";

            //delete this line 
            //window.parent.frames["message"].document.getElementById("username").setAttribute("value", name)

            setTimeout("document.getElementById('msg').focus()",100);
        }

        function onColorSelect(color) {
            var colorbtns = document.getElementsByClassName("colorBtn");
            var hiddenField = document.getElementById("selectedColor");
            hiddenField.setAttribute("value", color.getAttribute("class").split(' ')[1]);

            for (var i = 0; i < colorbtns.length; i++) {
                colorbtns[i].style.border = "none";
                colorbtns[i].style.width = "25px";
                colorbtns[i].style.height = "25px";
            }

            color.style.border = "2px solid grey";
            color.style.width = "23px";
            color.style.height = "23px";
        }
        //]]>
        </script>
    </head>

    <body style="text-align: left" onload="load()">
        <form action="add_message.php" method="post">
            <table border="0" cellspacing="5" cellpadding="0">
                <tr>
                    <td>What is your message?</td>
                </tr>
                <tr>
                    <td colspan="2"><input class="text" type="text" name="message" id="msg" style= "width: 780px" /></td>
                </tr>
                <tr>
                    <td style= "width: 180px;">Choose your colour:</td>
                    <td>
                        <div class="colorBtn black" style="background-color: black;width: 23px;height: 23px;border: 2px solid grey;display: inline-block;cursor: pointer;" onclick="onColorSelect(this)"></div>
                        <div class="colorBtn red" style="background-color: red;width: 25px;height: 25px;display: inline-block;cursor: pointer;" onclick="onColorSelect(this)"></div>
                        <div class="colorBtn orange" style="background-color: orange;width: 25px;height: 25px;display: inline-block;cursor: pointer;" onclick="onColorSelect(this)"></div>
                        <div class="colorBtn seagreen" style="background-color: seagreen;width: 25px;height: 25px;display: inline-block;cursor: pointer;" onclick="onColorSelect(this)"></div>
                        <div class="colorBtn royalblue" style="background-color: royalblue;width: 25px;height: 25px;display: inline-block;cursor: pointer;" onclick="onColorSelect(this)"></div>
                        <div class="colorBtn darkviolet" style="background-color: darkviolet;width: 25px;height: 25px;display: inline-block;cursor: pointer;" onclick="onColorSelect(this)"></div>
                        <input type="hidden" id="selectedColor" name="selectedColor" value="black" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input class="button" type="submit" value="Send Your Message" style="width: 200px" /></td>
                </tr>
            </table>
        </form>
        
        <!--logout button-->
         <form action="logout.php" style="padding-top: 10px">
            <input class="button" type="submit" value="Logout" style="width: 200px" />
        </form>

        <form action="logout.php">
            <input class="button" type="submit" value="View Online Users" style="width: 200px" />
        </form>


    </body>
</html>
