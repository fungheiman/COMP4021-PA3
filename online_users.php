<?php

if (!isset($_COOKIE["name"])) {
    header("Location: error.php");
    return;
}

// get the name from cookie
$name = $_COOKIE["name"];

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Oneline Users List</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript">
        //<![CDATA[

        var loadTimer = null;
        var request;
        var datasize;

        function load() {
            loadTimer = null;
            datasize = 0;

            getUpdate();
        }

        function unload() {
            if (loadTimer != null) {
                loadTimer = null;
                clearTimeout("load()", 100);
            }
        }

        function getUpdate() {
            request =new XMLHttpRequest();
            request.onreadystatechange = stateChange;
            request.open("POST", "server.php", true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send("datasize=" + datasize);
        }

        function stateChange() {
            if (request.readyState == 4 && request.status == 200 && request.responseText) {
                var xmlDoc;
                try {
                    xmlDoc =new XMLHttpRequest();
                    xmlDoc.loadXML(request.responseText);
                } catch (e) {
                    var parser = new DOMParser();
                    xmlDoc = parser.parseFromString(request.responseText, "text/xml");
                }
                datasize = request.responseText.length;
                updateUser(xmlDoc);
                getUpdate();
            }
        }

        function clearUserList(){
        	var userList = document.getElementById('userList');
        	while (userList.firstChild) {
        		userList.removeChild(userList.firstChild);
        	}
        }

        function updateUser(xmlDoc) {

        	clearUserList();

        	var users = xmlDoc.getElementsByTagName("user");
        	var htmlstr = "<tr>";
        	htmlstr += '<th style="width: 100px">Picture</th>';
        	htmlstr += '<th style="width: 200px">Username</th>';
        	htmlstr += '</tr>';

            for (var i = 0; i < users.length; i++) {
                var user = users.item(i);
                var name = user.getAttribute("name");
				var picture = user.getAttribute("picture");

				htmlstr += "<tr>";
				htmlstr += "<td><img src=\"" + picture + "\" / style='height:50px'></td>";
				htmlstr += "<td>" + name + "</td>";

            }

            var userList = document.getElementById('userList');
            userList.innerHTML = htmlstr;
        }
   
        //]]>
        </script>
    </head>

    <body style="text-align: left; padding-left:20px" onload="load()" onunload="unload()">
        <h2>Online Users List</h2>
        
        <table border=1 style="text-align: center;" id="userList">
        
		    <th style="width: 100px">Picture</th>
		    <th style="width: 200px">Username</th>
        </tr>

        </table>

    </body>
</html>
