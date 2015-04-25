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

function startDownloader() {
	var http = new XMLHttpRequest();
	http.open("GET", "installer.php?request=download", true);
	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			if(http.responseText == "success") {
				$('#pb').css('width', 25 + '%').attr('aria-valuenow', 25);
				alert("It works !");
			}
			else 
				alert("Sorry ! Unable to access to the installer ! Check if it is called precisely 'installer.php', then try to restart.");
		}
	}
	http.send(null);
}