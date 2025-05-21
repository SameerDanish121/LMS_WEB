<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | LMS</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Core styling */
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
        }

        /* Sticky top bar styling */
        .sticky-top-container {
            position: sticky;
            top: 0;
            z-index: 40;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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

        /* Main content container */
        .main-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem 1rem;
            flex: 1 0 auto;
        }

        /* Profile card styling */
        .profile-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1);
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px -10px rgba(59, 130, 246, 0.2);
        }

        .profile-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .profile-image-container {
            margin: -4rem auto 1.5rem;
            position: relative;
            width: 8rem;
            height: 8rem;
        }

        .profile-image {
            width: 8rem;
            height: 8rem;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .profile-image:hover {
            transform: scale(1.05);
        }

        .edit-image-button {
            position: absolute;
            bottom: 0.5rem;
            right: 0.5rem;
            background: #10b981;
            color: white;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .edit-image-button:hover {
            transform: scale(1.1);
            background: #059669;
        }

        .profile-form {
            padding: 1.5rem 2rem 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .submit-button {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(37, 99, 235, 0.3);
            background: linear-gradient(to right, #2563eb, #1d4ed8);
        }

        .submit-button:active {
            transform: translateY(0);
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
    </style>
</head>
@php
$profileImage = session('profileImage', asset('images/male.png'));
$userName = session('username', 'Guest');
$designation = session('designation', 'N/A');
$userId = session('userId', '');
$userType = session('userType', 'User');
$email = session('email', '');
$phoneNumber = session('phoneNumber', '');
@endphp
<body>
    <!-- Top Bar -->
     <div class="sticky-top-container">
    <div class="sticky-top-bar">
        <div class="flex items-center">
            <a href="{{ route('director.dashboard') }}" class="text-xl font-bold text-blue-600">
                Director <span class="hidden sm:inline"></span>
            </a>
        </div>
        @include('DIRECTOR.Profile')
    </div>
</div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="profile-card">
            <div class="profile-header">
                <h2 class="text-2xl font-bold mb-2">Your Profile</h2>
                <p class="text-blue-100">Update your personal information</p>
            </div>
            
            <div class="profile-image-container">
                <img id="profilePreview" src="{{ $profileImage }}" class="profile-image" onclick="triggerFileInput()">
                <div class="edit-image-button" onclick="triggerFileInput()">
                    <i class="fas fa-camera"></i>
                </div>
                <input type="file" id="profileImageInput" class="hidden" accept="image/*" onchange="previewImage(event)">
            </div>

            <div class="profile-form">
                <form id="updateProfileForm">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" id="username" value="{{ $userName }}" class="form-control" placeholder="Enter your full name">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" id="email" value="{{ $email }}" class="form-control" placeholder="Enter your email address">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" id="phoneNumber" value="{{ $phoneNumber }}" class="form-control" placeholder="Enter your phone number">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Designation</label>
                            <input type="text" id="designation" value="{{ $designation }}" class="form-control" placeholder="Enter your designation">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Enter new password (leave blank to keep current)">
                        </div>
                    </div>
                    
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="submit-button">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </form>
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

    @include('components.loader')
    
    <script>
        function previewImage(event) {
            const image = document.getElementById('profilePreview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function triggerFileInput() {
            document.getElementById('profileImageInput').click();
        }

        document.addEventListener("DOMContentLoaded", function() {
            let API_BASE_URL = "http://127.0.0.1:8000/";
            async function getApiBaseUrl() {
                try {
                    let response = await fetch('/get-api-url');
                    let data = await response.json();
                    return data.api_base_url;
                } catch (error) {
                    return API_BASE_URL;
                }
            }
            API_BASE_URL = getApiBaseUrl();
            document.getElementById("updateProfileForm").addEventListener("submit", async function(event) {
                event.preventDefault();
                showLoader();
                API_BASE_URL=await getApiBaseUrl();
                let formData = new FormData();
                let userId = "{{ session('userId') }}";
                let role = "{{ session('userType') }}";
                let id="{{session('Id')}}";
                formData.append("id", id);
                formData.append("role", role);
                formData.append("name", document.getElementById("username").value.trim());
                formData.append("phone_number", document.getElementById("phoneNumber").value.trim());
                formData.append("Designation", document.getElementById("designation").value.trim());
                let email = document.getElementById("email").value.trim();
                let password = document.getElementById("password").value.trim();
                if (email) formData.append("email", email);
                if (password) formData.append("password", password);
                let imageInput = document.getElementById("profileImageInput");
                if (imageInput.files.length > 0) {
                    formData.append("image", imageInput.files[0]);
                }
                try {
                    let response = await fetch(`${API_BASE_URL}api/Insertion/update-single-user`, {
                        method: "POST"
                        , body: formData
                    });
                    let result = await response.json();
                    if (response.ok) {
                        sessionStorage.setItem("profileImage", result['image']);
                        sessionStorage.setItem("username", result['name']);
                        sessionStorage.setItem("phoneNumber", result['phone']);
                        sessionStorage.setItem("designation", result['designation']);
                        sessionStorage.setItem("usernames", result['username']);
                        hideLoader();
                        
                        // Enhanced success notification
                        const successNotification = document.createElement('div');
                        successNotification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 animate-bounce';
                        successNotification.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Profile updated successfully!';
                        document.body.appendChild(successNotification);
                        
                        setTimeout(() => {
                            successNotification.remove();
                            location.reload();
                        }, 2000);
                    } else {
                        hideLoader();
                        alert("⚠️ Failed to update profile: " + result.message);
                    }
                } catch (error) {
                    hideLoader();
                    console.error("❌ Error updating profile:", error);
                    alert("⚠️ An unexpected error occurred. Please try again." + error);
                }
            });
        });
    </script>
</body>
</html>