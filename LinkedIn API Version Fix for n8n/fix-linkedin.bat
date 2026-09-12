@echo off
echo ========================================
echo   LinkedIn API Version Fix for n8n
echo ========================================
echo.

set CONTAINER=n8n

echo [1] Checking container '%CONTAINER%'...
docker ps --filter "name=%CONTAINER%" --format "{{.Names}}" > nul 2>&1
if errorlevel 1 (
    echo [ERROR] Container '%CONTAINER%' is not running!
    echo.
    echo Running containers:
    docker ps
    echo.
    echo If your container has a different name, edit this file and change CONTAINER variable.
    pause
    exit /b 1
)
echo [OK] Container is running.
echo.

echo [2] Searching for GenericFunctions.js inside container...
for /f "delims=" %%i in ('docker exec %CONTAINER% find /usr/local/lib/node_modules/n8n/node_modules/.pnpm -path "*/LinkedIn/GenericFunctions.js" 2^>nul') do set FILE_PATH=%%i

if "%FILE_PATH%"=="" (
    echo [ERROR] Could not find GenericFunctions.js inside container!
    pause
    exit /b 1
)
echo [OK] Found file at: %FILE_PATH%
echo.

echo [3] Copying file from container to C:\...
docker cp %CONTAINER%:%FILE_PATH% C:\GenericFunctions.js
if errorlevel 1 (
    echo [ERROR] Failed to copy file!
    pause
    exit /b 1
)
echo [OK] File copied.
echo.

echo [4] Please edit the file now...
echo.
echo ========================================
echo   INSTRUCTION:
echo   1. Press Ctrl+F in Notepad
echo   2. Search for: 'LinkedIn-Version': '202504'
echo   3. Change it to: 'LinkedIn-Version': '202604'
echo   4. Save the file (Ctrl+S) and close Notepad
echo ========================================
echo.
pause
notepad C:\GenericFunctions.js

echo.
echo [5] Copying file back to container...
docker cp C:\GenericFunctions.js %CONTAINER%:%FILE_PATH%
if errorlevel 1 (
    echo [ERROR] Failed to copy file back!
    pause
    exit /b 1
)
echo [OK] File copied back.
echo.

echo [6] Cleaning up temporary file...
del C:\GenericFunctions.js
echo [OK] Cleanup complete.
echo.

echo [7] Restarting container...
docker restart %CONTAINER%
echo [OK] Container restarted.
echo.

echo ========================================
echo   SUCCESS! API version updated to 202604.
echo ========================================
echo.
echo Test your LinkedIn connection in n8n now.
pause