@include('frontend.pages._layout')

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<style>
body { background: #fdfbf7; margin: 0; overflow-x: hidden; }
.page-hero, .page-content { display: none; } /* Hide old static content */

/* Split Screen Layout */
.contact-split {
    display: flex;
    width: 100vw;
    min-height: 100vh;
}

/* Left Side - 3D Globe */
.contact-left {
    flex: 1;
    position: relative;
    background: radial-gradient(circle at center, #ffffff 0%, #f4f0e6 100%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 60px;
    overflow: hidden;
    border-right: 1px solid rgba(201, 169, 110, 0.2);
}
#webgl-container {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    z-index: 0;
    pointer-events: none;
}
.left-content {
    position: relative;
    z-index: 10;
    max-width: 500px;
    margin-left: 5vw;
}
.left-content h1 {
    font-family: 'Playfair Display', serif;
    font-size: 5rem;
    color: #111;
    line-height: 1.1;
    margin-bottom: 30px;
    letter-spacing: -1px;
}
.left-content p {
    color: #555;
    font-size: 1.2rem;
    line-height: 1.8;
    margin-bottom: 50px;
}
.contact-info-list {
    display: flex;
    flex-direction: column;
    gap: 30px;
}
.info-row {
    display: flex;
    align-items: center;
    gap: 20px;
}
.info-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--brand-gold, #c9a96e);
    border: 1px solid rgba(201, 169, 110, 0.2);
}
.info-text h4 {
    margin: 0 0 5px 0;
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: #111;
}
.info-text p {
    margin: 0;
    color: #666;
    font-size: 1rem;
}

/* Right Side - Natural Language Form */
.contact-right {
    flex: 1;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px;
    position: relative;
    z-index: 10;
}
.letter-form {
    width: 100%;
    max-width: 650px;
}
.letter-form h2 {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    color: #111;
    margin-bottom: 50px;
    border-bottom: 2px solid var(--brand-gold, #c9a96e);
    padding-bottom: 15px;
    display: inline-block;
}

.nl-sentence {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    line-height: 2.2;
    color: #444;
    margin-bottom: 30px;
}

.nl-input {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--brand-gold, #c9a96e);
    border: none;
    border-bottom: 2px solid #ddd;
    background: transparent;
    padding: 0 15px;
    outline: none;
    text-align: center;
    transition: all 0.3s;
    width: auto;
    min-width: 200px;
}
.nl-input:focus {
    border-bottom-color: var(--brand-gold, #c9a96e);
}
.nl-input::placeholder {
    color: #ccc;
    font-style: italic;
    font-weight: 300;
}

.nl-select {
    appearance: none;
    cursor: pointer;
    text-align: center;
    font-weight: 600;
}

.nl-textarea {
    width: 100%;
    border: none;
    border-bottom: 2px solid #ddd;
    background: transparent;
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    padding: 20px 0;
    line-height: 1.8;
    resize: none;
    outline: none;
    height: 100px;
    margin-top: 10px;
    color: var(--brand-gold, #c9a96e);
}
.nl-textarea:focus {
    border-bottom-color: var(--brand-gold, #c9a96e);
}
.nl-textarea::placeholder {
    color: #ccc;
    font-style: italic;
}

.signature-line {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 50px;
}
.signature-font {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    color: #111;
    font-style: italic;
}

.btn-seal {
    background: #111;
    color: #fff;
    border: none;
    padding: 18px 40px;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 3px;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.4s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.btn-seal:hover {
    background: var(--brand-gold, #c9a96e);
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(201, 169, 110, 0.3);
}

@media(max-width: 1000px) {
    .contact-split { flex-direction: column; }
    .contact-left { min-height: 80vh; }
}
</style>

<div class="contact-split">
    
    <!-- Left Side: 3D Globe -->
    <div class="contact-left">
        <div id="webgl-container"></div>
        <div class="left-content">
            <h1>Global<br>Concierge</h1>
            <p>Step into the world of Lexoria. Whether you desire a bespoke masterpiece or need assistance with a private viewing, our diamond experts are at your service worldwide.</p>
            
            <div class="contact-info-list">
                <div class="info-row">
                    <div class="info-icon"><i class="bi bi-envelope-open"></i></div>
                    <div class="info-text">
                        <h4>Private Concierge</h4>
                        <p>hello@lexoriadiamond.com</p>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="bi bi-telephone"></i></div>
                    <div class="info-text">
                        <h4>Global Support</h4>
                        <p>+91 98765 43210</p>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
                    <div class="info-text">
                        <h4>Flagship Vault</h4>
                        <p>Surat & Mumbai, India</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Natural Language Letter Form -->
    <div class="contact-right">
        <div class="letter-form" id="formWrapper">
            <h2>A Personal Note</h2>
            <form onsubmit="event.preventDefault(); submitLuxuryForm();">
                
                <div class="nl-sentence">
                    Hello, my name is <input type="text" class="nl-input" style="width: 250px;" placeholder="Your Name" required> 
                    and you can reach me at <input type="email" class="nl-input" style="width: 350px;" placeholder="Your Email Address" required>.
                </div>
                
                <div class="nl-sentence">
                    I am writing to you today regarding a 
                    <select class="nl-input nl-select">
                        <option>Bespoke Commission</option>
                        <option>Private Viewing Request</option>
                        <option>Order Assistance</option>
                        <option>General Inquiry</option>
                    </select>.
                </div>

                <div class="nl-sentence">
                    Here are a few more details about my request:
                    <textarea class="nl-textarea" placeholder="Type your personal message here..." required></textarea>
                </div>

                <div class="signature-line">
                    <span class="signature-font">Sincerely,</span>
                    <button type="submit" class="btn-seal" id="submitBtn">Seal & Send</button>
                </div>
                
            </form>
        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    
    // --- Three.js Interactive Global Sphere ---
    const container = document.getElementById('webgl-container');
    if(container) {
        const scene = new THREE.Scene();
        // Adjust aspect ratio for half screen
        const aspect = container.offsetWidth / container.offsetHeight;
        const camera = new THREE.PerspectiveCamera(75, aspect, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        
        renderer.setSize(container.offsetWidth, container.offsetHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        container.appendChild(renderer.domElement);

        // Create a 3D particle sphere
        const geometry = new THREE.BufferGeometry();
        const particlesCount = 2000;
        const posArray = new Float32Array(particlesCount * 3);
        const colorsArray = new Float32Array(particlesCount * 3);

        const color1 = new THREE.Color(0xc9a96e); // Brand Gold
        const color2 = new THREE.Color(0x333333); // Dark Charcoal

        for(let i = 0; i < particlesCount * 3; i+=3) {
            const radius = 3.5;
            const theta = Math.random() * 2 * Math.PI;
            const phi = Math.acos((Math.random() * 2) - 1);
            
            posArray[i] = radius * Math.sin(phi) * Math.cos(theta);
            posArray[i+1] = radius * Math.sin(phi) * Math.sin(theta);
            posArray[i+2] = radius * Math.cos(phi);

            const mixedColor = Math.random() > 0.5 ? color1 : color2;
            colorsArray[i] = mixedColor.r;
            colorsArray[i+1] = mixedColor.g;
            colorsArray[i+2] = mixedColor.b;
        }

        geometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
        geometry.setAttribute('color', new THREE.BufferAttribute(colorsArray, 3));

        const material = new THREE.PointsMaterial({
            size: 0.02,
            vertexColors: true,
            transparent: true,
            opacity: 0.8,
            blending: THREE.NormalBlending
        });

        const particlesMesh = new THREE.Points(geometry, material);
        // Position globe slightly to the right so it's not hidden behind text
        particlesMesh.position.x = 2; 
        scene.add(particlesMesh);

        camera.position.z = 6;

        let mouseX = 0;
        let mouseY = 0;

        // Only track mouse over the left container to avoid global lag
        document.querySelector('.contact-left').addEventListener('mousemove', (event) => {
            mouseX = (event.clientX / container.offsetWidth) - 0.5;
            mouseY = (event.clientY / container.offsetHeight) - 0.5;
        });

        const clock = new THREE.Clock();

        const animate = () => {
            requestAnimationFrame(animate);
            // Smooth rotation based on mouse
            particlesMesh.rotation.y += 0.002 + (mouseX * 0.05);
            particlesMesh.rotation.x += 0.001 + (mouseY * 0.05);
            
            renderer.render(scene, camera);
        };
        animate();

        window.addEventListener('resize', () => {
            if(container.offsetWidth > 0) {
                camera.aspect = container.offsetWidth / container.offsetHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(container.offsetWidth, container.offsetHeight);
            }
        });
    }

    // Intro Animations
    gsap.from(".left-content", { x: -50, opacity: 0, duration: 1, delay: 0.2 });
    gsap.from(".letter-form", { y: 50, opacity: 0, duration: 1, delay: 0.5 });
});

// Submit Animation
function submitLuxuryForm() {
    const btn = document.getElementById('submitBtn');
    const wrapper = document.getElementById('formWrapper');
    
    btn.innerHTML = "Sealing...";
    
    gsap.to(wrapper, {
        opacity: 0,
        y: -30,
        duration: 0.5,
        onComplete: () => {
            wrapper.innerHTML = `<div style="text-align:center; padding: 50px 0;">
                <i class="bi bi-envelope-check" style="font-size: 6rem; color: #c9a96e; margin-bottom: 20px; display:block;"></i>
                <h1 style="font-family: 'Playfair Display'; font-size: 3rem; color:#111; margin-bottom: 10px;">Letter Delivered</h1>
                <p style="color: #555; font-size: 1.1rem; line-height: 1.8;">Thank you for writing to us.<br>Our luxury concierge is reviewing your note and will be in touch shortly.</p>
            </div>`;
            
            gsap.fromTo(wrapper, { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 0.5 });
        }
    });
}
</script>

@include('frontend.footer')
