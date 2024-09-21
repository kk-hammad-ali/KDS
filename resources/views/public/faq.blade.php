<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
<div class="d-flex flex-column min-vh-100">
    <!-- Background Image Section -->
    <div class="container-fluid p-0">
        <div class="position-relative" style="height: 50vh;">
            <img src="/images/ter.jpg" class="w-100 h-100" style="object-fit: cover;">
            <div class="position-absolute" style="top: 30%; left: 10%;">
                <h1 class="display-3 fw-bold text-light">Help & FAQ</h1>
                <p class="h5 fw-bold text-light">Help and Frequently Asked Questions</p>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="container py-5">
        <div class="accordion" id="faqAccordion">
            <!-- FAQ Item 1 -->
            <div class="accordion-item mt-3 p-2">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        I have a car driving license in my country. Can this help me?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, having a car driving license from your country may help. You can provide the required documents and get assistance for local driving training and exams.
                    </div>
                </div>
            </div>
            <!-- FAQ Item 2 -->
            <div class="accordion-item mt-3 p-2">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Is there any option for people who require getting the Driving license on a fast or urgent basis?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, there is an urgent basis option available. Please contact our support team for more details.
                    </div>
                </div>
            </div>
            <!-- Additional FAQs -->
            <div class="accordion-item mt-3 p-2">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        I lost my Emirates ID, however, I have an Emirates ID copy. Can I apply for my driving training?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You need to have the original Emirates ID for applying. Please check with our support team for alternative options.
                    </div>
                </div>
            </div>
            <!-- FAQ Item 4 -->
            <div class="accordion-item mt-3 p-2">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Is it possible to take training in any other Eco Drive branch after making registration at DIC?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, you can transfer your training to another branch. Contact our admin office to process your request.
                    </div>
                </div>
            </div>
            <!-- More FAQs (Add as Needed) -->
            <!-- FAQ Item 5 -->
            <div class="accordion-item mt-3 p-2">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        What are the fees for driving training courses?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        The fees vary depending on the course package. You can check our pricing page or contact our support team for more details.
                    </div>
                </div>
            </div>
            <!-- FAQ Item 6 -->
            <div class="accordion-item mt-3 p-2">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        Can I change my driving instructor if I am not comfortable?
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, you can request a change of instructor. Please contact the training office for the necessary steps.
                    </div>
                </div>
            </div>
            <!-- Continue Adding More FAQs as Needed -->
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>