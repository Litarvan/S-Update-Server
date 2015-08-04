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

var dropzone = document.getElementById('dropzone');
var message = document.getElementById('message');
var barcanvas = document.getElementById('barcanvas');
var dest = root + "Upload";

var totalSize = 0;
var totalProgress = 0;
var progress = 0;
var list = [];

var uploadedFiles = 0;
var filesToUpload = 0;

var uploading = false;

document.getElementById('filesToUpload').addEventListener('change', processUpload, false);

function drawBar() {
    var ctx = barcanvas.getContext('2d');

    ctx.clearRect(0, 0, barcanvas.width, barcanvas.height);
    ctx.fillStyle = '#FFFFFF';

    ctx.beginPath();
        ctx.globalAlpha = 0.20;
        ctx.fillRect(0, 0, barcanvas.width, barcanvas.height);
    ctx.closePath();

    ctx.beginPath();
        ctx.globalAlpha = 0.40;
        ctx.fillRect(0, 0, progress * barcanvas.width, barcanvas.height);
    ctx.closePath();
}

function resizeCanvas() {
    barcanvas.width  = window.innerWidth;
    drawBar();
}

function processFiles(filelist) {
    if (!filelist || !filelist.length || list.length)
        return;

    totalSize = 0;
    totalProgress = 0;

    for (var i = 0; i < filelist.length; i++) {
        list.push(filelist[i]);
        totalSize += filelist[i].size;
    }

    filesToupload = list.length;

    uploadNext();
}

function handleComplete(size) {
    totalProgress += size;
    progress = totalProgress / totalSize;
    drawBar();
    uploadNext();
}

function handleProgress(event) {
    progress = totalProgress + event.loaded;
    drawBar();
}

function uploadFile(file, status) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', dest);

    xhr.onload = function() {
        if(this.responseText != "success")
            alert(this.responseText);
        handleComplete(file.size);
    };
    xhr.onerror = function() {
        alert(this.responseText);
        handleComplete(file.size);
    };
    xhr.upload.onprogress = function(event) {
        handleProgress(event);
    }
    xhr.upload.onloadstart = function(event) {
    }

    var formData = new FormData();
    formData.append('file', file);
    xhr.send(formData);
}

function uploadNext() {
    uploadedFiles++;

    if (list.length) {
        message.innerHTML = uploadedFiles + "/" + filesToupload;

        uploadFile(list.shift(), status);
    } else
        location.reload();
}

function upload() {
    if(uploading)
        return;

    uploading = true;
    document.getElementById("filesToUpload").click();
}

function processUpload() {
    processFiles(document.getElementById('filesToUpload').files);
}

resizeCanvas();
drawBar();
