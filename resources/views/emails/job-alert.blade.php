<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وظيفة جديدة تطابق معاييرك</title>
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .content {
            padding: 30px;
        }
        .job-card {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9fafb;
        }
        .job-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }
        .meta-item {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #6b7280;
        }
        .meta-item i {
            margin-left: 5px;
        }
        .job-description {
            color: #4b5563;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .cta-button:hover {
            transform: translateY(-2px);
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .alert-info {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🎉 وظيفة جديدة!</h1>
            <p>وجدنا وظيفة تطابق معايير البحث الخاصة بك</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Alert Info -->
            <div class="alert-info">
                <strong>تنبيه:</strong> هذه الوظيفة تطابق معايير الإنذار الذي قمت بإنشائه في منصتنا.
            </div>

            <!-- Job Card -->
            <div class="job-card">
                <h2 class="job-title">{{ $job->title }}</h2>
                
                <div class="job-meta">
                    <div class="meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $job->location }}
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-briefcase"></i>
                        {{ __('types.' . $job->type) }}
                    </div>
                    @if($job->salary_min || $job->salary_max)
                    <div class="meta-item">
                        <i class="fas fa-dollar-sign"></i>
                        {{ $job->salary_min ? $job->salary_min : '0' }} 
                        @if($job->salary_max) - {{ $job->salary_max }} @endif
                    </div>
                    @endif
                </div>

                <div class="job-description">
                    {{ Str::limit($job->description, 200) }}
                </div>

                <center>
                    <a href="{{ route('jobs.show', $job->slug) }}" class="cta-button">
                        عرض التفاصيل والتقديم
                    </a>
                </center>
            </div>

            <!-- Additional Info -->
            <p style="text-align: center; color: #6b7280; font-size: 14px;">
                إذا لم تكن مهتماً بهذه الوظيفة، يمكنك 
                <a href="#" style="color: #4F46E5;">تعديل إنذاراتك</a>
                أو 
                <a href="#" style="color: #4F46E5;">إلغاء الاشتراك</a>.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>تم إرسال هذه الرسالة من {{ config('app.name') }}</p>
            <p style="font-size: 12px; margin-top: 10px;">
                إذا لم تكن قد طلبت هذه الرسالة، يرجى تجاهلها.
            </p>
        </div>
    </div>
</body>
</html>
