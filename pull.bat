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

:: Konfigurasi server Rumahweb Anda
set SERVER_USER=quic1934
set SERVER_HOST=quizb.my.id
set SERVER_PATH=/home/quic1934/public_html/wirid.quizb.my.id

:: Jika menggunakan SSH key yang berbeda (Biarkan kosong jika ingin pakai password)
set SSH_KEY=

echo Server: %SERVER_USER%@%SERVER_HOST%
echo Path: %SERVER_PATH%
echo Port: 2223
echo.
echo ==================================================
echo       MENARIK PERUBAHAN DARI GITHUB
echo ==================================================
echo.

:: Menjalankan git pull di server via SSH (Dengan Port 2223)
if "%SSH_KEY%"=="" (
    ssh -p 2223 %SERVER_USER%@%SERVER_HOST% "cd %SERVER_PATH% && git pull"
) else (
    ssh -p 2223 -i "%SSH_KEY%" %SERVER_USER%@%SERVER_HOST% "cd %SERVER_PATH% && git pull"
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