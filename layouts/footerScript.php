<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Template Javascript -->
<script src="/assets/js/main.js"></script>

<!-- <script>
        $(document).ready(function () {
            console.log(sessionStorage.getItem("checkingforError"));
            var startTime;
            var inactivityTimeout = 120000; // 2 minutes in milliseconds

            // Set the start time when the document is ready
            startTime = new Date().getTime();

            // Function to record screen time
            function recordScreenTime() {
                var screenTime = new Date().getTime() - startTime;

                // Send an AJAX request to record screen time
                $.ajax({
                    url: '../scripts/requestAPI.php',
                    method: 'POST',
                    data: { "requestType": "recordScreentime", "screenTime": screenTime },
                    async: false, // Synchronous request for simplicity
                });
            }

            function recordPageTime() {
                var currentUrl = window.location.href;
                var screenTime = new Date().getTime() - startTime;
                // Send an AJAX request to record screen time
                $.ajax({
                    url: '../scripts/requestAPI.php',
                    method: 'POST',
                    data: { "requestType": "recordPageScreentime", "screenTime": screenTime, "pageUrl": currentUrl },
                    async: false, // Synchronous request for simplicity
                    success: (response) => {
                        sessionStorage.setItem("checkingforError", response);
                    },
                    error: (xhr,status,error) => {
                        sessionStorage.setItem("checkingforError", xhr.responseText);
                    }
                });
            }

            // Set up a timer to check for inactivity
            var inactivityTimer = setInterval(function () {
                var currentTime = new Date().getTime();
                var elapsedTime = currentTime - startTime;

                if (elapsedTime >= inactivityTimeout) {
                    // Record screen time if inactive for 2 minutes
                    recordScreenTime();
                }
            }, 10000); // Check every 10 seconds (adjust as needed)

            // Send an AJAX request when the user leaves the page
            $(window).on('beforeunload', function () {
                // Clear the inactivity timer
                clearInterval(inactivityTimer);

                // Record screen time
                recordScreenTime();
                recordPageTime();
            });
            $(window).on("unload", function() {
                recordPageTime()
            })
            recordScreenTime();
            recordPageTime();
        });
    </script> -->

<script>
    function makeAjaxCall(url, method, data) {
        return $.ajax({
            url: url,
            type: method,
            data: data,
            dataType: "Json"
        });
    }
    function updateRiskChart(
    [lifeWidth = "0%", incomeWidth = "0%", illnessWidth = "0%"],
    [lifeColor = "#fff", incomeColor = "#fff", illnessColor = "#fff"]) 
{
    $(".finance_chart_container .chart_bars_wrapper .bar_label.life_label .progress, .financial_section .chart_bars_wrapper .bar_label.life_label .progress").css({
        "width": lifeWidth,
        "background-color": lifeColor
    });
    $(".finance_chart_container .chart_bars_wrapper .bar_label.income_label .progress, .financial_section .chart_bars_wrapper .bar_label.income_label .progress").css({
        "width": incomeWidth,
        "background-color": incomeColor
    });
    $(".finance_chart_container .chart_bars_wrapper .bar_label.illness_label .progress, .financial_section .chart_bars_wrapper .bar_label.illness_label .progress").css({
        "width": illnessWidth,
        "background-color": illnessColor
    });
    console.log(incomeWidth)
    if (lifeWidth == "0%" && incomeWidth == "0%" && illnessWidth == "0%") {
        $(".finance_chart_container .chart_bars_wrapper .bar_label, .financial_section .chart_bars_wrapper .bar_label").addClass("d-none");
    } else {
        $(".finance_chart_container .chart_bars_wrapper .bar_label, .financial_section .chart_bars_wrapper .bar_label").removeClass("d-none");
    }
}
    $(document).ready(() => {
        $("#loading_screen").fadeOut();
        $("#root2").fadeIn()
        $("#full-page").fadeIn()
    })
</script>

<script>
    $(document).ready(function() {
        // console.log(sessionStorage.getItem("checkingforError"));
        var startTime = new Date().getTime();
        var totalScreenTime = 0; // Initialize total screen time
        var inactivityTimeout = 60000; // 2 minutes in milliseconds
        var inactivityTimer;

        // Function to record screen time
        function recordScreenTime() {
            var screenTime = totalScreenTime + (new Date().getTime() - startTime); // Total screen time
            // Send an AJAX request to record screen time
            $.ajax({
                url: '../scripts/requestAPI.php',
                method: 'POST',
                data: {
                    "requestType": "recordScreentime",
                    "screenTime": screenTime
                },
                async: true, // Use asynchronous requests
                success: function(response) {
                    sessionStorage.setItem("checkingforError", response.error);
                },
                error: function(xhr) {
                    sessionStorage.setItem("checkingforError", xhr.responseText);
                }
            });
            totalScreenTime += (new Date().getTime() - startTime); // Update total screen time
            startTime = new Date().getTime(); // Reset start time
        }

        function recordPageTime() {
            var currentUrl = window.location.href;
            var screenTime = totalScreenTime; // Total accumulated screen time
            // Send an AJAX request to record page time
            $.ajax({
                url: '../scripts/requestAPI.php',
                method: 'POST',
                data: {
                    "requestType": "recordPageScreentime",
                    "screenTime": screenTime,
                    "pageUrl": currentUrl
                },
                async: true, // Use asynchronous requests
                success: function(response) {
                    sessionStorage.setItem("checkingforError", response);
                },
                error: function(xhr) {
                    sessionStorage.setItem("checkingforError", xhr.responseText);
                }
            });
        }

        // Set up a timer to check for inactivity
        inactivityTimer = setInterval(function() {
            var currentTime = new Date().getTime();
            var elapsedTime = currentTime - startTime;

            if (elapsedTime >= inactivityTimeout) {
                // Record screen time if inactive for 2 minutes
                recordScreenTime();
                totalScreenTime = 0; // Reset total time after recording
            }
        }, 10000); // Check every 10 seconds

        // Send an AJAX request when the user leaves the page
        $(window).on('beforeunload', function() {
            // Clear the inactivity timer
            clearInterval(inactivityTimer);

            // Record screen time and page time
            recordScreenTime();
            recordPageTime();
        });

        // Initial recording on page load
        recordScreenTime();
        recordPageTime();
    });
</script>