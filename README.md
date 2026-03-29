# 🚀 Job Board Platform

منصة وظائف احترافية متكاملة مع نظام إدارة التقديمات والمقالات

## ✨ المميزات

### 📝 نظام المقالات المتقدم
- **إدارة المقالات:** إنشاء، تعديل، وحذف المقالات
- **نظام الإعجابات:** إعجاب وإلغاء الإعجاب بالمقالات
- **صلاحيات دقيقة:** صاحب المقال فقط يمكنه التعديل
- **عرض احترافي:** 4 أعمدة مع تصميم عصري
- **صور المقالات:** رفع وتخزين صور المقالات

### 🎯 نظام التقديمات
- **إدارة التقديمات:** عرض وتقييم طلبات المتقدمين
- **حالات التقديم:** متقدم، قيد المراجعة، مختار، متم توظيفه، مرفوض
- **عرض الملفات:** تحميل وعرض السير الذاتية والرسائل التعريفية
- **واجهة احترافية:** تصميم عصري بـ Tailwind CSS

### 👥 إدارة المستخدمين
- **صلاحيات متعددة:** Admin، Company، User
- **ملفات تعريف:** ملفات شخصية للمستخدمين
- **توثيق:** تسجيل دخول آمن

### 🏢 إدارة الشركات
- **ملفات الشركات:** معلومات كاملة عن الشركات
- **لوحة تحكم:** dashboard خاص بالشركات
- **عرض الوظائف:** وظائف كل شركة

### 💼 إدارة الوظائف
- **إنشاء الوظائف:** نموذج متكامل لإضافة وظائف
- **تصنيفات:** تنظيم الوظائف حسب الفئات
- **بحث متقدم:** فلترة وبحث في الوظائف
- **حفظ الوظائف:** حفظ الوظائف المفضلة

### 📢 التنبيهات
- **تنبيهات الوظائف:** إشعارات عند إضافة وظائف جديدة
- **نظام إشعارات:** إشعارات داخل النظام
- **بريد إلكتروني:** إشعارات عبر الإيميل

## 🛠️ التقنيات المستخدمة

### 🎯 Backend Stack
- **Framework:** Laravel 12.34.0 (أحدث إصدار)
- **Language:** PHP 8.2
- **Database:** MySQL مع Eloquent ORM
- **Authentication:** Laravel Breeze + Policies
- **File Storage:** Laravel Storage System

### 🎨 Frontend Stack
- **CSS Framework:** Tailwind CSS 3.x
- **Icons:** Font Awesome 6
- **Templates:** Blade Components
- **Design:** Responsive & Modern UI

### 🔧 Features & Libraries
- **Authorization:** Laravel Policies & Gates
- **File Upload:** Multiple file support
- **Image Processing:** Laravel Image Intervention
- **Caching:** Laravel Cache System
- **Validation:** Custom Validation Rules

## 📋 المتطلبات

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

## 🚀 التثبيت

```bash
# استنساخ المشروع
git clone <repository-url>
cd board_platform_job

# تثبيت الاعتماديات
composer install
npm install

# إعداد البيئة
cp .env.example .env
php artisan key:generate

# تشغيل الميجرشن
php artisan migrate

# ربط الـ storage
php artisan storage:link

# تشغيل الخادم
php artisan serve
```

## 📁 هيكل المشروع

```
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── Policies/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
├── routes/
└── storage/
```

## 📊 إحصائيات المشروع

### 🎯 الأرقام
- **📝 المقالات:** نظام كامل مع الإعجابات
- **💼 الوظائف:** إدارة وتقديم متقدم
- **👥 المستخدمين:** 3 أدوار مختلفة
- **🏢 الشركات:** ملفات تعريف كاملة
- **📁 الملفات:** رفع وتخزين آمن
- **🔐 الصلاحيات:** Policies & Gates

### 🚀 المميزات الفنية
- **⚡ Performance:** Optimized queries & caching
- **🔒 Security:** CSRF protection & validation
- **📱 Responsive:** Mobile-first design
- **🎨 UI/UX:** Modern & intuitive interface
- **🔧 Maintainable:** Clean code & best practices

## 🎯 لماذا هذا المشروع؟

### 💡 الأهداف
- **تعليمي:** مثال متكامل لـ Laravel
- **تجاري:** جاهز للاستخدام الفعلي
- **تطويري:** أساس قوي للتطوير
- **احترافي:** يتبع أفضل الممارسات

### � ما يميزه
- **🏗️ Architecture:** MVC مع Design Patterns
- **🔐 Authorization:** نظام صلاحيات متقدم
- **📱 UI/UX:** تجربة مستخدم احترافية
- **🚀 Performance:** محسّن للسرعة
- **📈 Scalability:** قابل للتطوير

## 🔐 الأمان

- **توثيق آمن:** Laravel Authentication
- **صلاحيات:** Role-based access control
- **حماية:** CSRF protection
- **تشفير:** Password hashing

## 🤝 المساهمة

مرحباً بك في المساهمة في المشروع! 

### 📋 خطوات المساهمة
1. Fork المشروع
2. أنشئ branch جديد (`git checkout -b feature/AmazingFeature`)
3. قم بالتعديلات
4. Commit التغييرات (`git commit -m 'Add some AmazingFeature'`)
5. Push إلى الـ branch (`git push origin feature/AmazingFeature`)
6. افتح Pull Request

### 🎯 المجالات للمساهمة
- � إصلاح الأخطاء
- ✨ إضافة مميزات جديدة
- 📚 تحسين الوثائق
- 🎨 تحسين الـ UI/UX
- ⚡ تحسين الأداء

## �📞 التواصل

للمزيد من المعلومات أو الدعم الفني، تواصل معنا عبر:

- 📧 Email: support@example.com
- 🌐 Website: example.com
- 💬 Discord: [Join our community](https://discord.gg/example)

## 📄 الترخيص

هذا المشروع مرخص تحت [MIT License](LICENSE).

---

### 🌟 شكر وتقدير

- **Laravel Team** - إطار العمل الرائع
- **Tailwind CSS** - تصميم عصري
- **Font Awesome** - أيقونات احترافية
- **المجتمع** - الدعم والمساعدة

---

**⭐ إذا أعجبك المشروع، لا تنسى إعطائه نجمة!**

**🚀 بني بحب و passion للبرمجة** ❤️
