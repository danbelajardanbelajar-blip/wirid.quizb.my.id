@echo off
title Pull from GitHub to Server
echo ==================================================
echo       GIT PULL SCRIPT - WIRID.QUIZB.MY.ID
echo ==================================================
echo.
echo Script ini akan menarik perubahan dari GitHub ke server
echo.
echo ==================================================
echo       KONFIGURASI SERVER
echo ==================================================
echo.

:: Konfigurasi server - silakan sesuaikan dengan server Anda
set SERVER_USER=quic1934
set SERVER_HOST=202.10.43.133
set SERVER_PATH=/home/quic1934/public_html/wirid.quizb.my.id

:: Jika menggunakan SSH key yang berbeda
set SSH_KEY=

echo Server: %SERVER_USER%@%SERVER_HOST%
echo Path: %SERVER_PATH%
echo.
echo ==================================================
echo       MENARIK PERUBAHAN DARI GITHUB
echo ==================================================
echo.

:: Menjalankan git pull di server via SSH
if "%SSH_KEY%"=="" (
    ssh %SERVER_USER%@%SERVER_HOST% "cd %SERVER_PATH% && git pull"
) else (
    ssh -i %SSH_KEY% %SERVER_USER%@%SERVER_HOST% "cd %SERVER_PATH% && git pull"
)

echo.
if %ERRORLEVEL% equ 0 (
    echo ==================================================
    echo       BERHASIL PULL KE SERVER!
    echo ==================================================
) else (
    echo ==================================================
    echo       GAGAL PULL KE SERVER. Silakan periksa pesan error di atas.
    echo ==================================================
)

echo.
pause
