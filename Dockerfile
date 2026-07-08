# استخدام نسخة PHP رسمية مدمجة مع Apache ومناسبة للارافيل
FROM php:8.2-apache

# تثبيت الإضافات والمكتبات اللازمة لتشغيل لارافيل وقاعدة البيانات
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd

# تفعيل موديل Re-write الخاص بـ Apache لتوجيه الروابط بشكل صحيح
RUN a2enmod rewrite

# تعديل مسار الـ DocumentRoot الخاص بـ Apache ليتوجه إلى مجلد public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# نسخ ملفات المشروع إلى السيرفر داخل الحاوية
WORKDIR /var/www/html
COPY . .

# تثبيت Composer والحزم المطلوبة
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# إعطاء الصلاحيات المناسبة لمجلدات التخزين والكاش
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تحديد المنفذ الافتراضي
EXPOSE 80