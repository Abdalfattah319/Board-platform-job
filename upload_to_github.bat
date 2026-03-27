@echo off
echo 🚀 رفع المشروع إلى GitHub...
echo.

echo 📂 1. تهيئة Git...
git init
echo.

echo ➕ 2. إضافة جميع الملفات...
git add .
echo.

echo 📝 3. إنشاء أول commit...
git commit -m "Initial commit: Job Board Platform with Articles & Likes System"
echo.

echo 🔗 4. ربط بـ GitHub (غير هذا الرابط)
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
echo.

echo 🚀 5. رفع الملفات إلى GitHub...
git push -u origin main
echo.

echo ✅ تم رفع المشروع بنجاح!
echo.
echo 📝 ملاحظات:
echo - غير YOUR_USERNAME إلى اسم مستخدم GitHub
echo - غير YOUR_REPO_NAME إلى اسم الـ repository
echo - تأكد من إنشاء الـ repository في GitHub أولاً
pause
