@echo off
schtasks /create /tn "KursRate" /tr %cd%DownloaderXML.exe /sc DAILY /st 08:00:00
pause