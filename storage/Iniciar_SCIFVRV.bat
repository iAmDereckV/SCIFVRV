@echo off
title SCIFVRV

echo ===============================
echo      INICIANDO SCIFVRV
echo ===============================

REM Iniciar Apache
start "" /min "C:\xampp\apache_start.bat"

REM Esperar 3 segundos
timeout /t 3 /nobreak >nul

REM Iniciar MySQL
start "" /min "C:\xampp\mysql_start.bat"

REM Esperar 5 segundos
timeout /t 5 /nobreak >nul

REM Abrir navegador
start "" "http://localhost/SCIFVRV/"

exit
