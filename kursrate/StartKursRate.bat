@echo off
set localPath=%~dp0
cd /d %localPath%
::Стартуем проверку лишних копий (DownloaderXML.exe)
start "DownloaderXML" /min /belownormal DownloaderXML.exe