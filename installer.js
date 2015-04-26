/*
 * Copyright 2015 TheShark34
 *
 * This file is part of S-Update.

 * S-Update is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * S-Update is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with S-Update.  If not, see <http://www.gnu.org/licenses/>.
 */

function startInstallation() {
    setPercentage(55);
    sendInstallerRequest("install", deleteInstaller);
}

function deleteInstaller() {
	setPercentage(90);
	sendInstallerRequest("deleteInstaller", redirect);
}

function redirect() {
    setPercentage(100);
    window.location.replace("config.php");
}

function sendInstallerRequest(request, callback) {
    var http = new XMLHttpRequest();
    http.open("GET", "installer.php?request=" + request, true);
    http.onreadystatechange = function() {
        if(http.readyState == 4 && (http.status == 200 || http.status == 0))
            if(http.responseText == "success") {
        		if(callback != null)
                	callback();
            } else {
                alert("An error occured, installer returned : " + http.responseText + "\nMake sure the installer is called installer.php and you have a working internet connection.");
            	closeWindow();
            }
    }
    http.send(null);
}

function setPercentage(percentage) {
    $('#pb').css('width', percentage + '%').attr('aria-valuenow', percentage);
}

function closeWindow() {
	window.open('','_self').close();
}