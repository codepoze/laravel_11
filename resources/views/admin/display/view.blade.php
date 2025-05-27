<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Nomor Antrian - PT. Maccon Generasi Mandiri</title>
    <link rel="apple-touch-icon" href="{{ asset_admin('images/icon/apple-touch-icon.png') }}" sizes="180x180" />
    <link rel="shortcut icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-32x32.png') }}" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-16x16.png') }}" type="image/x-icon" sizes="16x16" />
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <style>
        /* Optional: Custom scrollbar for the main content area */
        .main-content-area::-webkit-scrollbar {
            width: 8px;
        }

        .main-content-area::-webkit-scrollbar-thumb {
            background-color: #a0aec0;
            /* slate-400 */
            border-radius: 4px;
        }

        .main-content-area::-webkit-scrollbar-track {
            background-color: transparent;
        }

        .main-content-area {
            scrollbar-width: thin;
            scrollbar-color: #a0aec0 transparent;
        }
    </style>
</head>

<body class="bg-[#EFDE80] text-black flex flex-col h-screen overflow-hidden">
    <div class="w-full py-3 shadow-md bg-[#EFDE80] flex-shrink-0">
        <h1 class="text-xl sm:text-2xl md:text-3xl font-semibold text-black text-center">
            PT. Maccon Generasi Mandiri
        </h1>
    </div>

    <div class="flex flex-col items-center w-full flex-grow p-2 overflow-y-auto main-content-area transition-opacity opacity-100 duration-750 starting:opacity-0">

        <div class="flex flex-row w-full max-w-4xl md:max-w-5xl lg:max-w-6xl xl:max-w-7xl 2xl:max-w-[1600px] mb-4 flex-shrink-0 items-start">
            <div class="w-[30%] p-2 md:p-3 text-center flex-shrink-0">
                <div id="currentTime" class="text-3xl md:text-9xl font-bold text-black break-words">&nbsp;</div>
                <div id="currentDate" class="text-xs md:text-4xl text-black mt-1 break-words">&nbsp;</div>
            </div>

            <div class="w-[70%] p-2 md:p-3 flex-shrink-0">
                <div class="flex flex-col items-center">
                    <div id="mainSlider" class="bg-slate-300 dark:bg-slate-600 aspect-[16/9] w-full rounded-lg flex items-center justify-center text-slate-500 dark:text-slate-400 text-lg sm:text-xl overflow-hidden relative max-h-[32vh] md:max-h-[46dvh]">
                        <img id="sliderImage" src="https://placehold.co/800x450/7f1d1d/fde68a?text=Loading..." alt="Slide Show" class="w-full h-full object-cover transition-opacity duration-1000 ease-in-out opacity-0" onerror="this.style.display='none'; document.getElementById('sliderFallbackText').style.display='block'; console.error('Error loading image: ' + this.src);">
                        <span id="sliderFallbackText" class="absolute">Slide Show</span>
                    </div>
                    <div id="sliderBullets" class="flex justify-center mt-3">
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold text-black m-4 text-center flex-shrink-0">
            Nomor Antrian Saat Ini
        </h2>

        <div class="flex flex-wrap justify-center items-start gap-2 sm:gap-4 w-full max-w-5xl md:max-w-6xl lg:max-w-7xl xl:max-w-[1600px] 2xl:max-w-[1920px] flex-shrink-0" id="queueDisplay">
            <!-- Antrean akan dimuat dari JS -->
        </div>
    </div>

    <script>
        function updateTimeDateDisplay() {
            const now = new Date();

            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            };
            const currentTimeString = now.toLocaleTimeString('en-GB', timeOptions);

            let currentDateString;
            try {
                const dateOptions = {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                };
                currentDateString = now.toLocaleDateString('id-ID', dateOptions);
            } catch (e) {
                console.warn("Indonesian locale ('id-ID') not fully supported for date formatting, using default.");
                const dateOptionsFallback = {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                };
                currentDateString = now.toLocaleDateString(undefined, dateOptionsFallback);
            }

            const currentTimeElem = document.getElementById('currentTime');
            const currentDateElem = document.getElementById('currentDate');

            if (currentTimeElem) currentTimeElem.textContent = currentTimeString;
            if (currentDateElem) currentDateElem.textContent = currentDateString;
        }

        function loadQueue() {
            $.get("{{ route('admin.display.list') }}", function(response) {
                const queueDisplay = document.getElementById("queueDisplay");
                queueDisplay.innerHTML = "";

                response.forEach((item) => {
                    const card = document.createElement("div");
                    card.innerHTML = `
                        <div class="bg-black p-6 md:p-8 rounded-lg text-center flex flex-col justify-between min-h-[180px]">
                            <p class="text-xl md:text-2xl font-medium text-[#EFDE80]">${item.nama}</p>
                            <p class="text-5xl md:text-6xl font-bold text-[#EFDE80] mt-2">${item.no_antrean}</p>
                        </div>
                    `;
                    queueDisplay.appendChild(card);
                });
            }, "json");
        }

        function initializeSlider(sliderId, imageElementId, fallbackTextId, bulletsContainerId, imagesArray) {
            let currentImageIndex = 0;
            const sliderImageElement = document.getElementById(imageElementId);
            const sliderFallbackTextElement = document.getElementById(fallbackTextId);
            const sliderBulletsContainer = document.getElementById(bulletsContainerId);
            let slideInterval;

            if (!sliderImageElement || !sliderFallbackTextElement || !sliderBulletsContainer) {
                console.error("Slider elements not found for ID:", sliderId);
                return;
            }

            function updateActiveBullet() {
                if (!sliderBulletsContainer) return;
                const bullets = sliderBulletsContainer.children;
                for (let i = 0; i < bullets.length; i++) {
                    bullets[i].classList.remove('bg-slate-100', 'dark:bg-slate-300');
                    bullets[i].classList.add('bg-slate-400', 'dark:bg-slate-500');
                }
                if (bullets[currentImageIndex]) {
                    bullets[currentImageIndex].classList.add('bg-slate-100', 'dark:bg-slate-300');
                    bullets[currentImageIndex].classList.remove('bg-slate-400', 'dark:bg-slate-500');
                }
            }

            function goToSlide(index) {
                if (index < 0 || index >= imagesArray.length) {
                    console.warn("Invalid slide index:", index);
                    return;
                }

                sliderImageElement.style.opacity = 0;
                currentImageIndex = index;

                const tempImage = new Image();
                tempImage.onload = () => {
                    sliderImageElement.src = imagesArray[currentImageIndex];
                };
                tempImage.onerror = () => {
                    console.error(`Error preloading image for ${sliderId}: ${imagesArray[currentImageIndex]}`);
                    sliderImageElement.src = imagesArray[currentImageIndex];
                };
                tempImage.src = imagesArray[currentImageIndex];

                updateActiveBullet();

                clearInterval(slideInterval);
                slideInterval = setInterval(showNextImage, 7000);
            }

            function createBullets() {
                if (!sliderBulletsContainer) return;
                sliderBulletsContainer.innerHTML = '';
                imagesArray.forEach((_, index) => {
                    const bullet = document.createElement('button');
                    bullet.type = 'button';
                    bullet.classList.add('w-3', 'h-3', 'md:w-3.5', 'md:h-3.5', 'rounded-full', 'mx-1.5', 'cursor-pointer', 'transition-colors', 'duration-300', 'ease-in-out', 'bg-slate-400', 'dark:bg-slate-500', 'hover:bg-slate-300', 'dark:hover:bg-slate-400');
                    bullet.setAttribute('aria-label', `Go to slide ${index + 1}`);
                    bullet.addEventListener('click', () => goToSlide(index));
                    sliderBulletsContainer.appendChild(bullet);
                });
            }

            function showNextImage() {
                const nextIndex = (currentImageIndex + 1) % imagesArray.length;
                goToSlide(nextIndex);
            }

            if (imagesArray && imagesArray.length > 0) {
                createBullets();

                sliderImageElement.onload = () => {
                    sliderImageElement.style.opacity = 1;
                    if (sliderFallbackTextElement) sliderFallbackTextElement.style.display = 'none';
                };

                goToSlide(0);
            } else if (sliderFallbackTextElement) {
                sliderFallbackTextElement.style.display = 'block';
                if (sliderImageElement) sliderImageElement.style.display = 'none';
                console.warn("No images provided for slider:", sliderId);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateTimeDateDisplay();
            loadQueue();
            setInterval(updateTimeDateDisplay, 1000);

            const imagesMain = [
                "{{ asset_admin('images/sliders/1.jpg') }}",
                "{{ asset_admin('images/sliders/2.jpg') }}",
                "{{ asset_admin('images/sliders/3.jpg') }}",
                "{{ asset_admin('images/sliders/4.jpg') }}"
            ];
            initializeSlider('mainSlider', 'sliderImage', 'sliderFallbackText', 'sliderBullets', imagesMain);
        });

        const pusher = new Pusher("7a42cd92d61eaa4ee28e", {
            cluster: "ap1",
            forceTLS: false,
        });

        const channel = pusher.subscribe("call-the-queue");
        channel.bind("calling", function() {
            loadQueue();
        });
    </script>
</body>

</html>