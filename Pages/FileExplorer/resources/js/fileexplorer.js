/*
 * Copyright 2015 TheShark34
 *
 * This file is part of S-Update-Server.
 *
 * S-Update-Server is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * S-Update-Server is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with S-Update-Server.  If not, see <http://www.gnu.org/licenses/>.
 */

// Implementing a endswith function
if (typeof String.prototype.endsWith !== 'function') {
    String.prototype.endsWith = function(suffix) {
        return this.indexOf(suffix, this.length - suffix.length) !== -1;
    };
}

// Implementing a startsWith function
if (typeof String.prototype.startsWith != 'function') {
  // see below for better implementation!
  String.prototype.startsWith = function (str){
    return this.indexOf(str) === 0;
  };
}

function deleteFile(message, path, root) {
    // Checking if it is the sub directory
    if(path.endsWith("..")) {
        alert("Nope");
        return;
    }

    // The user need to say yes
    if(!confirm(message))
        return;

    // Sending a delete request else
    sendRequest(root + "Delete/" + path);
    alert("OK");

    // Reloading
    location.reload();
}

function sendRequest(request) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", request, true);
    xhr.send(null);
}

function newFolder(root, path) {
    var folderName = prompt();

    // Checking the folder path
    if(folderName == "" || folderName.indexOf("/") > 0 || folderName.indexOf("\\") > 0) {
        alert("--'");
        return;
    }

    // Sending a new folder request
    sendRequest(root + "NewFolder/" + path + "/" + folderName);
    alert("OK");

    // Reloading
    location.reload();
}

function rename(path, root) {
    // Checking if it is the sub directory
    if(path.endsWith("..")) {
        alert("Nope");
        return;
    }

    var newName = prompt("", path);

    // Checking the new name
    if(newName == "" || newName.indexOf("..") > 0 || newName.indexOf("?") > 0) {
        alert("--'");
        return;
    }

    if(!newName.startsWith("files/"))
        newName = "files/" + newName;

    // Sending a rename request
    sendRequest(root + "Rename/" + path + "/?/" + newName);
    alert("OK");

    // Reloading
    location.reload();
}

function unzip(message, path, root) {
    // The user need to say yes
    if(!confirm(message))
        return;

    alert(root + "Unzip/" + path);

    // Sending a unzip request
    sendRequest(root + "Unzip/" + path);
    alert("OK");

    // Reloading
    location.reload();
}
