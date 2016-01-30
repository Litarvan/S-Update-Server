
/*
 * Copyright 2015 TheShark34
 * .
 * This file is part of S-Update-Server.
 * .
 * S-Update-Server is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * .
 * S-Update-Server is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * .
 * You should have received a copy of the GNU Lesser General Public License
 * along with S-Update-Server.  If not, see <http://www.gnu.org/licenses/>.
 */
var checkAndSubmit, checkFields;

checkFields = function() {
  var password, vpassword;
  password = document.getElementById('password');
  vpassword = document.getElementById('vpassword');
  if (password.value === vpassword.value && document.getElementById('password').value.length > 0) {
    password.style.backgroundColor = 'green';
    return vpassword.style.backgroundColor = 'green';
  } else {
    password.style.backgroundColor = 'red';
    return vpassword.style.backgroundColor = 'red';
  }
};

checkAndSubmit = function() {
  if (document.getElementById('password').value === document.getElementById('vpassword').value && document.getElementById('password').value.length > 0) {
    return document.getElementById('passwordForm').submit();
  }
};
