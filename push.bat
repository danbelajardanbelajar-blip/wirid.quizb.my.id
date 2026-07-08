@echo off
title Push to GitHub
echo ==================================================
echo       GIT PUSH SCRIPT - WIRID.QUIZB.MY.ID
echo ==================================================
echo.

:: Menampilkan status git saat ini
echo [1/4] Mengecek status perubahan...
git status -s
echo.

:: Menambahkan semua file ke staging area
echo [2/4] Menambahkan semua perubahan (git add .)...
git add .
echo.

:: Meminta pesan commit dari pengguna
echo [3/4] Konfigurasi Commit
set /p commit_message="Masukkan pesan commit [tekan Enter untuk default]: "

:: Menggunakan pesan default jika pengguna tidak memasukkan apa pun
if "%commit_message%"=="" (
    set commit_message="Update otomatis: %date% %time%"
)

echo.
echo Melakukan commit dengan pesan: "%commit_message%"
git commit -m "%commit_message%"
echo.

:: Mendorong (push) perubahan ke server GitHub
echo [4/4] Mendorong perubahan ke GitHub (git push)...
git push
echo.

if %ERRORLEVEL% equ 0 (
    echo ==================================================
    echo       BERHASIL PUSH KE GITHUB!
    echo ==================================================
) else (
    echo ==================================================
    echo       GAGAL PUSH KE GITHUB. Silakan periksa pesan error di atas.
    echo ==================================================
)

echo.
pause
