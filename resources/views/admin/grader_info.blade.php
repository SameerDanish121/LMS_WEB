<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grader History</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    @include('admin.navbar')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-4">Grader History</h2>

        <!-- Grader Info -->
        <div id="grader-info" class="flex flex-col sm:flex-row items-center gap-4 bg-gray-50 p-4 rounded-lg shadow-md">
        </div>

        <!-- Search Bar -->
        <div class="my-4">
            <input type="text" id="search-session" class="border p-2 w-full rounded-lg" placeholder="Search by Session Name..." oninput="filterAllocations()">
        </div>

        <!-- Current Session Section -->
        <div class="mb-6">
            <h3 class="text-xl font-bold text-blue-600">Current Session</h3>
            <div id="current-session-container" class="space-y-4 mt-2"></div>
        </div>

        <!-- Allocate Button (Hidden by Default) -->
        <div id="allocate-btn-container" class="hidden text-center my-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Allocate A Teacher</button>
        </div>

        <!-- Previous Session Section -->
        <div>
            <h3 class="text-xl font-bold text-gray-700">Previous Sessions</h3>
            <div id="previous-session-container" class="space-y-4 mt-2"></div>
        </div>
    </div>

    <script>
        let API_BASE_URL = "http://127.0.0.1:8001/";
        async function getApiBaseUrl() {
            try {
                let response = await fetch('/get-api-url');
                let data = await response.json();
                return data.api_base_url;
            } catch (error) {
                return API_BASE_URL;
            }
        }
        async function initializeApiBaseUrl() {
            API_BASE_URL = await getApiBaseUrl();
        }
        document.addEventListener("DOMContentLoaded",
            function() {
                const studentId = "{{ $student_id }}";

                if (!studentId) {
                    alert("Invalid Student ID!");
                    return;
                }
                initializeApiBaseUrl();
                fetch(`${API_BASE_URL}api/Grader/GraderInfo?student_id=${studentId}`)
                    .then(response => response.json())
                    .then(data => displayGraderHistory(data))
                    .catch(error => console.error("Error fetching data:", error));
            });

        function displayGraderHistory(response) {
            if (!response.data || response.data.length === 0) {
                document.getElementById("grader-info").innerHTML = "<p class='text-red-500'>No data found!</p>";
                return;
            }

            const grader = response.data[0];
            const graderInfoDiv = document.getElementById("grader-info");
            const currentSessionContainer = document.getElementById("current-session-container");
            const previousSessionContainer = document.getElementById("previous-session-container");
            const allocateBtnContainer = document.getElementById("allocate-btn-container");

            // Grader Info Card
            graderInfoDiv.innerHTML = `
                <img src="${grader.image || 'https://via.placeholder.com/100'}" alt="Grader Image" class="w-24 h-24 rounded-full border">
                <div>
                    <h3 class="text-lg font-bold">${grader.grader_name} (${grader.grader_RegNo})</h3>
                    <p class="text-gray-600"><strong>Section:</strong> ${grader.grader_section}</p>
                    <p class="text-gray-600"><strong>Status:</strong> ${grader["This Session"]}</p>
                    <p class="text-gray-600"><strong>Type:</strong> ${grader.type}</p>
                </div>
            `;

            // Sorting Allocations
            let hasCurrentSession = false;
            currentSessionContainer.innerHTML = "";
            previousSessionContainer.innerHTML = "";

            grader["Grader Allocations"].forEach(allocation => {
                const teacherImage = allocation.teacher_image ?
                    allocation.teacher_image :
                    `https://ui-avatars.com/api/?name=${allocation.teacher_name}&background=random`;

                const feedbackText = allocation.feedback && allocation.feedback !== "Not Added By Instructor" ?
                    allocation.feedback :
                    "Not Available";

                const predictedRating = predictRating(allocation.feedback);

                const sessionHTML = `
                    <div class="p-4 bg-white shadow rounded-lg border">
                        <div class="flex items-center gap-4">
                            <img src="${teacherImage}" alt="Teacher Image" class="w-16 h-16 rounded-full border">
                            <div>
                                <h4 class="text-lg font-bold">${allocation["session_name"]}</h4>
                                <p class="text-gray-600"><strong>Teacher:</strong> ${allocation.teacher_name}</p>
                                <p class="text-gray-600"><strong>Status:</strong> ${allocation["Allocation Status"]}</p>
                                ${allocation["Session is ? "] === " Previous Session"
                                    ? `<p class="text-gray-600"><strong>Feedback:</strong> ${feedbackText}</p>
                                       <p class="text-yellow-500"><strong>Predicted Rating:</strong> ${predictedRating}</p>`
                                    : ""}
                            </div>
                        </div>
                    </div>
                `;

                if (allocation["Session is ? "] === " Current Session") {
                    hasCurrentSession = true;
                    currentSessionContainer.innerHTML += sessionHTML;
                } else {
                    previousSessionContainer.innerHTML += sessionHTML;
                }
            });

            // Show "Allocate A Teacher" button if no current session data
            allocateBtnContainer.classList.toggle("hidden", hasCurrentSession);
        }

        function filterAllocations() {
            const searchValue = document.getElementById("search-session").value.toLowerCase();
            document.querySelectorAll("#current-session-container > div, #previous-session-container > div").forEach(allocation => {
                const sessionName = allocation.querySelector("h4").textContent.toLowerCase();
                allocation.style.display = sessionName.includes(searchValue) ? "block" : "none";
            });
        }

        function predictRating(feedback) {
            if (!feedback || feedback === "Not Added By Instructor") return "0/10 ⭐"; // Always shows a star

            const lowerFeedback = feedback.toLowerCase();
            if (lowerFeedback.includes("excellent")) return "10/10 ⭐⭐⭐⭐⭐";
            if (lowerFeedback.includes("very good")) return "9/10 ⭐⭐⭐⭐⭐";
            if (lowerFeedback.includes("good")) return "8/10 ⭐⭐⭐⭐";
            if (lowerFeedback.includes("average")) return "5/10 ⭐⭐⭐";
            if (lowerFeedback.includes("poor")) return "3/10 ⭐⭐";
            return "4/10 ⭐⭐"; // Default rating
        }

    </script>
    @include('components.footer')
</body>

</html>
