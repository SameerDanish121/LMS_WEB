<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director Dashboard | LMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Core styling with enhanced visual elements */
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* For footer at bottom */
        }

        /* Main content container with reduced side spacing */
        .main-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.5rem 1rem; /* Reduced side padding */
            flex: 1 0 auto; /* For footer positioning */
        }

        /* Sticky top bar styling from original code */
        .sticky-top-container {
            position: sticky;
            top: 0;
            z-index: 40;
            background: white;
        }

        .sticky-top-bar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.75rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Welcome card styling from original code */
        .welcome-card {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 240px;
        }

        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .welcome-text {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 24px;
        }

        .session-info {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 12px 16px;
            border-radius: 12px;
            margin-top: auto;
        }

        .session-detail {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .session-detail:last-child {
            margin-bottom: 0;
        }

        .session-icon {
            margin-right: 12px;
            font-size: 18px;
        }

        /* Stats card styling from original code */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .stat-card {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
        }

        .stat-content {
            flex-grow: 1;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 14px;
            color: #6b7280;
        }

        /* Enhanced quick action styling with REDUCED SPACING */
        .section-divider {
            position: relative;
            height: 40px; /* Further reduced */
            margin: 16px 0; /* Further reduced */
            overflow: hidden;
        }

        .section-divider::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.3), transparent);
        }

        .section-divider::after {
            content: attr(data-title);
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 0 20px;
            color: #3b82f6;
            font-weight: 600;
            font-size: 1.1rem;
            white-space: nowrap;
            box-shadow: 0 0 0 10px white;
        }

        .action-card {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(226, 232, 240, 0.8);
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 20px;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 160px;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.2);
            border-color: rgba(165, 180, 252, 0.5);
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #6366f1);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .action-card:hover::before {
            opacity: 1;
        }

        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 24px;
            color: white;
            background: linear-gradient(135deg, var(--icon-color-1), var(--icon-color-2));
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-name {
            font-size: 15px;
            font-weight: 600;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .card-description {
            font-size: 13px;
            color: #6b7280;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Slightly reduced card width */
            gap: 16px; /* Reduced gap */
        }

        /* Section spacing has been reduced */
        .section-content {
            margin-bottom: 24px; /* Further reduced */
        }

        /* Color variables */
        :root {
            --icon-blue-1: #3b82f6;
            --icon-blue-2: #2563eb;
            --icon-purple-1: #8b5cf6;
            --icon-purple-2: #7c3aed;
            --icon-green-1: #10b981;
            --icon-green-2: #059669;
            --icon-orange-1: #f59e0b;
            --icon-orange-2: #d97706;
            --icon-red-1: #ef4444;
            --icon-red-2: #dc2626;
            --icon-indigo-1: #6366f1;
            --icon-indigo-2: #4f46e5;
            --icon-teal-1: #14b8a6;
            --icon-teal-2: #0d9488;
            --icon-amber-1: #f59e0b;
            --icon-amber-2: #d97706;
        }

        /* Footer styling */
        .footer {
            flex-shrink: 0;
            background-color: #1e3a8a;
            color: white;
            padding: 1rem 0;
            text-align: center;
            margin-top: 2rem;
        }

        .footer-content {
            padding: 0.5rem 0;
        }

        .footer-copyright {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .welcome-card {
                min-height: auto;
            }
        }

        @media (max-width: 576px) {
            .cards-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Top Bar from original code -->
    <div class="sticky-top-container">
        <div class="sticky-top-bar">
            <div class="flex items-center">
                <h1 class="text-xl font-bold text-blue-600">
                    Director <span class="hidden sm:inline">Dashboard</span>
                </h1>
            </div>
            @include('DIRECTOR.Profile')
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Welcome Card and Stats from original code -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="welcome-card">
                <div>
                    <h1 class="welcome-title">Welcome, {{ session('username', 'Director') }}</h1>
                    <p class="welcome-text">Manage your institution with real-time insights and powerful tools</p>
                </div>
                <div class="session-info">
                    <div class="session-detail">
                        <span class="session-icon">🚀</span>
                        <span>Current Session: {{ session('currentSession', 'Spring 2025') }}</span>
                    </div>
                    <div class="session-detail">
                        <span class="session-icon">🏛️</span>
                        <span>Session Start: {{ session('startDate', 'Jan 15, 2025') }}</span>
                    </div>
                    <div class="session-detail">
                        <span class="session-icon">🎓</span>
                        <span>Session End: {{ session('endDate', 'May 30, 2025') }}</span>
                    </div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-500">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ session('faculty_count', '42') }}</div>
                        <div class="stat-label">Faculty Members</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-purple-500">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ session('student_count', '834') }}</div>
                        <div class="stat-label">Total Students</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-green-500">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ session('course_count', '28') }}</div>
                        <div class="stat-label">Active Courses</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-yellow-500">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ session('offer_count', '156') }}</div>
                        <div class="stat-label">Pending Requests</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TIMETABLE, STUDENTS, AND STAFF IN ONE SECTION -->
        <div class="section-divider" data-title="Main Navigation"></div>
        
        <div class="section-content">
            <div class="cards-grid">
                <!-- Timetable Card -->
                <a href="{{ route('timetable.view') }}" class="action-card">
                    <div class="card-icon" style="--icon-color-1: var(--icon-blue-1); --icon-color-2: var(--icon-blue-2);">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="card-name">View Timetable</h3>
                    <p class="card-description">Complete institutional schedule</p>
                    <div class="mt-3 text-blue-500 text-sm font-medium flex items-center justify-center">
                        <span>View Now</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </a>

                <!-- Students Card -->
                <a href="{{ route('Director.student') }}" class="action-card">
                    <div class="card-icon" style="--icon-color-1: var(--icon-green-1); --icon-color-2: var(--icon-green-2);">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="card-name">View Students</h3>
                    <p class="card-description">Browse all registered students</p>
                    <div class="mt-3 text-green-500 text-sm font-medium flex items-center justify-center">
                        <span>View Students</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </a>

                <!-- Faculty Card -->
                <a href="{{ route('Director.teachers') }}" class="action-card">
                    <div class="card-icon" style="--icon-color-1: var(--icon-indigo-1); --icon-color-2: var(--icon-indigo-2);">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="card-name">View Faculty</h3>
                    <p class="card-description">Manage teaching staff</p>
                    <div class="mt-3 text-indigo-500 text-sm font-medium flex items-center justify-center">
                        <span>View Faculty</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </a>

                <!-- Excluded Days Card -->
                <a href="{{ route('Director.excludedDays') }}" class="action-card">
                    <div class="card-icon" style="--icon-color-1: var(--icon-orange-1); --icon-color-2: var(--icon-orange-2);">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <h3 class="card-name">Excluded Days</h3>
                    <p class="card-description">Set holidays and special days</p>
                    <div class="mt-3 text-orange-500 text-sm font-medium flex items-center justify-center">
                        <span>Manage Now</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Academic Management Section -->
        <div class="section-divider" data-title="Academic Management"></div>

        <div class="section-content">
            <div class="cards-grid">
                <!-- Academic Sessions -->
                <a href="{{ route('Director.session') }}" class="action-card">
                    <div class="card-icon" style="--icon-color-1: var(--icon-teal-1); --icon-color-2: var(--icon-teal-2);">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <h3 class="card-name">Academic Sessions</h3>
                    <p class="card-description">Manage terms and semesters</p>
                    <div class="mt-3 text-teal-500 text-sm font-medium flex items-center justify-center">
                        <span>View Sessions</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </a>

                <!-- Course Content -->
                <a href="{{ route('Director.course_content') }}" class="action-card">
                    <div class="card-icon" style="--icon-color-1: var(--icon-amber-1); --icon-color-2: var(--icon-amber-2);">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="card-name">Course Content</h3>
                    <p class="card-description">Review course materials</p>
                    <div class="mt-3 text-amber-500 text-sm font-medium flex items-center justify-center">
                        <span>View Content</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </a>

                <!-- Courses -->
                <a href="{{ route('Director.course') }}" class="action-card">
                    <div class="card-icon" style="--icon-color-1: var(--icon-red-1); --icon-color-2: var(--icon-red-2);">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="card-name">Courses</h3>
                    <p class="card-description">Browse course catalog</p>
                    <div class="mt-3 text-red-500 text-sm font-medium flex items-center justify-center">
                        <span>View Courses</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </a>

                <!-- Course Allocations -->
                <a href="{{ route('Director.course_allocation') }}" class="action-card">
                    <div class="card-icon" style="--icon-color-1: #ec4899; --icon-color-2: #db2777;">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3 class="card-name">Course Allocations</h3>
                    <p class="card-description">Manage assignments</p>
                    <div class="mt-3 text-pink-500 text-sm font-medium flex items-center justify-center">
                        <span>View Allocations</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container mx-auto">
            <div class="footer-content">
                <div class="footer-copyright">
                    © Sharjeel | Ali | Sameer Learning Management System
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Add animation to cards when they come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.action-card').forEach(card => {
            card.style.opacity = "0";
            card.style.transform = "translateY(20px)";
            card.style.transition = "all 0.4s ease-out";
            observer.observe(card);
        });

        // Activity logging function
        function logFunction(name) {
            const actionName = name
                .replace(/([A-Z])/g, ' $1')
                .replace(/(\b\w)/g, firstChar => firstChar.toUpperCase())
                .trim();

            console.log(`Action logged: ${actionName} at ${new Date().toLocaleTimeString()}`);
        }

        // Add click event listeners to all action links
        document.querySelectorAll('a[href^="{{ route("]').forEach(link => {
            link.addEventListener('click', function() {
                const action = this.querySelector('.card-name').textContent;
                logFunction(action);
            });
        });
    </script>
</body>
</html>