'use strict';

const qs = require ("querystring");
const electron = require('electron');
const app = electron.app;
const BrowserWindow = electron.BrowserWindow;

var mainWindow = null;

const pdfURL = "http://localhost/chatburn/electron-pdfjs/pdfjs/web/aadhaar card.pdf";

app.on('ready', function() {
  mainWindow = new BrowserWindow({
    width: 800,
    height: 600,
    webPreferences: {
      nodeIntegration: false,
      webSecurity: false,
    },
  });

  // mainWindow.document.addEventListener('contextmenu', event => event.preventDefault());

  const param = qs.stringify({file: pdfURL});

  mainWindow.loadURL('file://' + __dirname + '/pdfjs/web/viewer.html?' + param);
  console.log('file://' + __dirname + '/pdfjs/web/viewer.html?' + param);
  mainWindow.webContents.openDevTools();

  mainWindow.on('closed', function() {
    mainWindow = null;
  });
});
