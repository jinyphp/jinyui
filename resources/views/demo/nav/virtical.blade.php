<x-jiny-theme>
    <style>
        html {
            scroll-behavior: smooth;
        }
        .section {
            height: 100vh;

        }
        #home {
            background-color: aqua
        }
        #about {
            background-color: bisque
        }
        #contact {
            background-color: blueviolet;
        }
        .nav {
            --nav-gap: 15px;
            padding: var(--nav-gap);
            position:fixed;
            right:0;
            top:50%;
            transform: translateY(-50%);
        }
        .nav-item {
            align-items: center;
            display: flex;
            margin-bottom: var(--nav-gap);
            flex-direction: row-reverse;
        }

        .nav-link:hover ~ .nav-label {
            opacity: 1;
        }

        .nav-label {
            color: black;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.1s;

        }

        .nav-link {
            background: rgba(0,0,0,0.3);
            border-radius: 50%;
            height: 15px;
            width: 15px;
            margin-left:var(--nav-gap);
            transition: transform 0.1s;

        }
        .nav-link-selected {
            background: black;
            transform: scale(1.4);
        }
    </style>

    <div class="section" id="home" data-label="home">Home</div>
    <div class="section" id="about" data-label="about">About</div>
    <div class="section" id="contact" data-label="contact">Contact</div>


    {{--
    <nav class="nav">
        <div class="nav-item">
            <a href="#home" class="nav-link">Bottle</a>
            <span class="nav-label">Home</span>
        </div>
        <div class="nav-item">
            <a href="#about" class="nav-link nav-link-selected">Bottle</a>
            <span class="nav-label">about</span>
        </div>
        <div class="nav-item">
            <a href="#contact" class="nav-link">Bottle</a>
            <span class="nav-label">contact</span>
        </div>
    </nav>
    --}}

    <script>
        function activateNavigation(){
            const section = document.querySelectorAll(".section");
            const navContainer = document.createElement("nav");
            const navIytems = Array.from(section).map(section => {
                return `<div class="nav-item" data-for-section="${section.id}">
            <a href="#${section.id}" class="nav-link nav-link-selected"></a>
            <span class="nav-label">${section.dataset.label}</span>
        </div>`;
            });
            
            navContainer.classList.add("nav");
            navContainer.innerHTML = navIytems.join("");

            const observer = new IntersectionObserver(entries => {
                console.log(entries);
                document.querySelectorAll(".nav-link").forEach(navLink => {
                    navLink.classList.remove("nav-link-selected");
                });

                const visibleSection = entries.filter(entry => entry.isIntersecting)[0];
                document.querySelector(`.nav-item[data-for-section="${visibleSection.target.id}"] .nav-link`)
                    .classList.add("nav-link-selected");

            }, { threshold: 0.5});
            section.forEach(el => observer.observe(el));

            document.body.appendChild(navContainer);

        }

        activateNavigation();
    </script>
</x-jiny-theme>