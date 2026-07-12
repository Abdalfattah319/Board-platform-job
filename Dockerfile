# استخدام نسخة PHP رسمية مدمجة مع Apache ومناسبة للارافيل
FROM php:8.2-apache

# تثبيت الإضافات والمكتبات اللازمة لتشغيل لارافيل وقاعدة البيانات وتثبيت Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd

# تثبيت Node.js و NPM (مطلوب لتشغيل Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y openssl nodejs

# تفعيل موديل Re-write الخاص بـ Apache لتوجيه الروابط بشكل صحيح
RUN a2enmod rewrite

# تعديل مسار الـ DocumentRoot الخاص بـ Apache ليتوجه إلى مجلد public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# نسخ ملفات المشروع إلى السيرفر داخل الحاوية
WORKDIR /var/www/html
COPY . .

# تثبيت Composer والحزم المطلوبة للارافيل
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# تثبيت حزم الـ NPM وبناء ملفات Vite المجمعة (توليد ملف manifest.json)
RUN npm install
RUN npm run build

# إنشاء ملفات قاعدة بيانات SQLite الاحتياطية ومجلدات الكاش لضمان وجودها
RUN mkdir -p database storage/framework/cache storage/framework/sessions storage/framework/views \
    && touch database/database.sqlite

# إعطاء الصلاحيات الكاملة لمستخدم Apache (www-data) على كامل ملفات المشروع
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# تحديد المنفذ الافتراضي
EXPOSE 80

# تنظيف الكاش القديم وبدء تشغيل سيرفر Apache
CMD php artisan migrate --force && php artisan config:clear && php artisan cache:clear && php artisan view:clear && apache2-foreground