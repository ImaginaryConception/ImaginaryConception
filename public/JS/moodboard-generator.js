document.addEventListener('DOMContentLoaded', function() {
    const moodboardButton = document.getElementById('moodboardButton');
    const moodboardModal = new bootstrap.Modal(document.getElementById('moodboardModal'));

    // Palettes de couleurs prédéfinies par style
    const colorPalettes = {
        moderne: ['#2D3436', '#636E72', '#B2BEC3', '#DFE6E9', '#0984E3'],
        classique: ['#2C3A47', '#6D214F', '#BDC581', '#EAB543', '#25CCF7'],
        creativ: ['#6C5CE7', '#00B894', '#FD79A8', '#FDCB6E', '#00CEC9'],
        tech: ['#1B1B2F', '#162447', '#1F4068', '#E43F5A', '#00B4D8'],
        nature: ['#588157', '#3A5A40', '#A3B18A', '#DAD7CD', '#344E41'],
        luxe: ['#2C3639', '#3F4E4F', '#A27B5C', '#DCD7C9', '#C7B7A3']
    };

    // Suggestions de polices par style
    const fontSuggestions = {
        moderne: ['Roboto', 'Open Sans', 'Montserrat'],
        classique: ['Playfair Display', 'Merriweather', 'Lora'],
        creativ: ['Poppins', 'Quicksand', 'Comfortaa'],
        tech: ['Space Mono', 'JetBrains Mono', 'Source Code Pro'],
        nature: ['Crimson Text', 'Cormorant Garamond', 'Libre Baskerville'],
        luxe: ['Cinzel', 'Cormorant', 'Italiana']
    };

    // Exemples de fonctionnalités par style
    const featureExamples = {
        moderne: [
            'Formulaire de contact épuré',
            'Galerie de projets interactive',
            'Section newsletter minimaliste'
        ],
        classique: [
            'Formulaire de contact traditionnel',
            'Galerie de produits élégante',
            'Section témoignages clients'
        ],
        creativ: [
            'Formulaire de contact animé',
            'Portfolio dynamique',
            'Section blog créative'
        ],
        tech: [
            'Formulaire de contact intelligent',
            'Dashboard interactif',
            'Section statistiques animée'
        ],
        nature: [
            'Formulaire de contact organique',
            'Galerie photos nature',
            'Section événements'
        ],
        luxe: [
            'Formulaire de contact premium',
            'Catalogue produits exclusifs',
            'Section VIP membres'
        ]
    };

    // Exemples de sections par style
    const sectionExamples = {
        moderne: [
            'Header minimaliste avec navigation fixe',
            'Sections avec beaucoup d\'espace négatif',
            'Grille de contenu asymétrique'
        ],
        classique: [
            'En-tête avec typographie élégante',
            'Sections avec bordures décoratives',
            'Mise en page traditionnelle à deux colonnes'
        ],
        creativ: [
            'Sections avec formes géométriques',
            'Animations interactives au défilement',
            'Disposition en grille dynamique'
        ],
        tech: [
            'Interface futuriste avec effets néon',
            'Mise en page inspirée des terminaux',
            'Sections avec animations de données'
        ],
        nature: [
            'Sections organiques avec formes fluides',
            'Galerie d\'images plein écran',
            'Navigation contextuelle discrète'
        ],
        luxe: [
            'En-tête avec animations dorées',
            'Sections avec bordures ornementales',
            'Galerie de produits exclusive'
        ]
    };

    // Animations par préférence
    const animations = {
        subtile: [
            'Fondu au défilement',
            'Transitions douces entre les sections',
            'Hover effects légers'
        ],
        dynamique: [
            'Parallax scrolling',
            'Animations de texte dynamiques',
            'Transitions avec rebond'
        ],
        minimal: [
            'Transitions basiques',
            'Pas d\'animations au défilement',
            'Effets hover simples'
        ]
    };

    // Styles de prévisualisation par style
    const previewStyles = {
        moderne: {
            header: `
                <nav class="d-flex justify-content-between align-items-center p-3" style="background-color: #2D3436; color: white;">
                    <div class="logo" style="font-family: Roboto, sans-serif;">LOGO</div>
                    <div class="menu-items" style="font-family: Open Sans, sans-serif;">
                        <span class="mx-2">Menu</span>
                        <span class="mx-2">Contact</span>
                    </div>
                </nav>
            `,
            hero: `
                <div class="text-center py-5" style="background-color: #DFE6E9;">
                    <h1 style="font-family: Montserrat, sans-serif; color: #2D3436;">Titre Principal</h1>
                    <p style="font-family: Open Sans, sans-serif; color: #636E72;">Description moderne et minimaliste</p>
                    <button class="btn btn-primary mt-3" style="background-color: #0984E3;">Action</button>
                </div>
            `,
            features: `
                <div class="row text-center" style="color: #2D3436;">
                    <div class="col-4 p-3">Feature 1</div>
                    <div class="col-4 p-3">Feature 2</div>
                    <div class="col-4 p-3">Feature 3</div>
                </div>
            `
        },
        classique: {
            header: `
                <nav class="d-flex justify-content-between align-items-center p-3" style="background-color: #2C3A47; color: #EAB543;">
                    <div class="logo" style="font-family: Playfair Display, serif;">LOGO</div>
                    <div class="menu-items" style="font-family: Merriweather, serif;">
                        <span class="mx-2">Menu</span>
                        <span class="mx-2">Contact</span>
                    </div>
                </nav>
            `,
            hero: `
                <div class="text-center py-5" style="background-color: #BDC581;">
                    <h1 style="font-family: Playfair Display, serif; color: #2C3A47;">Titre Élégant</h1>
                    <p style="font-family: Lora, serif; color: #6D214F;">Description classique et raffinée</p>
                    <button class="btn btn-primary mt-3" style="background-color: #25CCF7;">Action</button>
                </div>
            `,
            features: `
                <div class="row text-center" style="color: #2C3A47;">
                    <div class="col-4 p-3" style="border: 1px solid #EAB543;">Feature 1</div>
                    <div class="col-4 p-3" style="border: 1px solid #EAB543;">Feature 2</div>
                    <div class="col-4 p-3" style="border: 1px solid #EAB543;">Feature 3</div>
                </div>
            `
        },
        creativ: {
            header: `
                <nav class="d-flex justify-content-between align-items-center p-3" style="background-color: #6C5CE7; color: white;">
                    <div class="logo" style="font-family: Poppins, sans-serif;">LOGO</div>
                    <div class="menu-items" style="font-family: Quicksand, sans-serif;">
                        <span class="mx-2">Menu</span>
                        <span class="mx-2">Contact</span>
                    </div>
                </nav>
            `,
            hero: `
                <div class="text-center py-5" style="background-color: #00B894;">
                    <h1 style="font-family: Poppins, sans-serif; color: white;">Titre Créatif</h1>
                    <p style="font-family: Comfortaa, cursive; color: #FDCB6E;">Description audacieuse et innovante</p>
                    <button class="btn btn-primary mt-3" style="background-color: #FD79A8;">Action</button>
                </div>
            `,
            features: `
                <div class="row text-center" style="color: #6C5CE7;">
                    <div class="col-4 p-3" style="background-color: #00CEC9;">Feature 1</div>
                    <div class="col-4 p-3" style="background-color: #00CEC9;">Feature 2</div>
                    <div class="col-4 p-3" style="background-color: #00CEC9;">Feature 3</div>
                </div>
            `
        },
        tech: {
            header: `
                <nav class="d-flex justify-content-between align-items-center p-3" style="background-color: #1B1B2F; color: #00B4D8;">
                    <div class="logo" style="font-family: 'Space Mono', monospace;">LOGO</div>
                    <div class="menu-items" style="font-family: 'JetBrains Mono', monospace;">
                        <span class="mx-2">Menu</span>
                        <span class="mx-2">Contact</span>
                    </div>
                </nav>
            `,
            hero: `
                <div class="text-center py-5" style="background-color: #162447;">
                    <h1 style="font-family: 'Space Mono', monospace; color: #E43F5A;">Titre Tech</h1>
                    <p style="font-family: 'Source Code Pro', monospace; color: #00B4D8;">Description futuriste et innovante</p>
                    <button class="btn btn-outline-light mt-3" style="border-color: #00B4D8; color: #00B4D8;">Action</button>
                </div>
            `,
            features: `
                <div class="row text-center" style="color: #E43F5A;">
                    <div class="col-4 p-3" style="border: 1px solid #00B4D8;">Feature 1</div>
                    <div class="col-4 p-3" style="border: 1px solid #00B4D8;">Feature 2</div>
                    <div class="col-4 p-3" style="border: 1px solid #00B4D8;">Feature 3</div>
                </div>
            `
        },
        nature: {
            header: `
                <nav class="d-flex justify-content-between align-items-center p-3" style="background-color: #3A5A40; color: #DAD7CD;">
                    <div class="logo" style="font-family: 'Crimson Text', serif;">LOGO</div>
                    <div class="menu-items" style="font-family: 'Cormorant Garamond', serif;">
                        <span class="mx-2">Menu</span>
                        <span class="mx-2">Contact</span>
                    </div>
                </nav>
            `,
            hero: `
                <div class="text-center py-5" style="background-color: #588157;">
                    <h1 style="font-family: 'Crimson Text', serif; color: #DAD7CD;">Titre Nature</h1>
                    <p style="font-family: 'Libre Baskerville', serif; color: #A3B18A;">Description organique et naturelle</p>
                    <button class="btn btn-outline-light mt-3" style="border-color: #DAD7CD;">Action</button>
                </div>
            `,
            features: `
                <div class="row text-center" style="color: #344E41;">
                    <div class="col-4 p-3" style="background-color: #A3B18A;">Feature 1</div>
                    <div class="col-4 p-3" style="background-color: #A3B18A;">Feature 2</div>
                    <div class="col-4 p-3" style="background-color: #A3B18A;">Feature 3</div>
                </div>
            `
        },
        luxe: {
            header: `
                <nav class="d-flex justify-content-between align-items-center p-3" style="background-color: #2C3639; color: #DCD7C9;">
                    <div class="logo" style="font-family: 'Cinzel', serif;">LOGO</div>
                    <div class="menu-items" style="font-family: 'Cormorant', serif;">
                        <span class="mx-2">Menu</span>
                        <span class="mx-2">Contact</span>
                    </div>
                </nav>
            `,
            hero: `
                <div class="text-center py-5" style="background-color: #3F4E4F;">
                    <h1 style="font-family: 'Cinzel', serif; color: #DCD7C9;">Titre Luxe</h1>
                    <p style="font-family: 'Italiana', serif; color: #C7B7A3;">Description élégante et raffinée</p>
                    <button class="btn btn-outline-light mt-3" style="border-color: #A27B5C; color: #A27B5C;">Action</button>
                </div>
            `,
            features: `
                <div class="row text-center" style="color: #2C3639;">
                    <div class="col-4 p-3" style="border: 2px solid #A27B5C;">Feature 1</div>
                    <div class="col-4 p-3" style="border: 2px solid #A27B5C;">Feature 2</div>
                    <div class="col-4 p-3" style="border: 2px solid #A27B5C;">Feature 3</div>
                </div>
            `
        }
    };

    function updateMoodboard() {
        const selectedStyle = document.querySelector('input[name="styleOption"]:checked').value;
        const selectedAnimation = document.querySelector('input[name="animationOption"]:checked').value;

        // Mise à jour de la palette de couleurs
        const colorPalette = document.getElementById('colorPalette');
        colorPalette.innerHTML = colorPalettes[selectedStyle]
            .map(color => `<div class="color-sample" style="background-color: ${color}; width: 50px; height: 50px; border-radius: 8px;"></div>`)
            .join('');

        // Mise à jour des suggestions de polices
        const fontSuggestionDiv = document.getElementById('fontSuggestions');
        fontSuggestionDiv.innerHTML = fontSuggestions[selectedStyle]
            .map(font => `<p style="font-family: '${font}', sans-serif; margin-bottom: 10px;">${font}</p>`)
            .join('');

        // Ajout du message d'avertissement
        const warningMessage = `
            <div class="alert alert-info mb-4" role="alert">
                <strong>Note importante :</strong> Ces suggestions de design sont uniquement à titre indicatif pour vous donner une idée des polices d'écriture, couleurs et styles à utiliser dans différents contextes. Le design final de votre site sera basé sur des maquettes personnalisées créées spécifiquement pour votre projet.
            </div>
        `;

        // Mise à jour des exemples de sections et fonctionnalités
        const sectionExamplesDiv = document.getElementById('sectionExamples');
        sectionExamplesDiv.innerHTML = `
            ${warningMessage}
            <div class="section-examples">
                <h6 class="text-muted mb-3">Structure suggérée :</h6>
                ${sectionExamples[selectedStyle].map(section => `<p class="mb-2">• ${section}</p>`).join('')}
                <hr>
                <h6 class="text-muted mb-3">Fonctionnalités suggérées :</h6>
                ${featureExamples[selectedStyle].map(feature => `<p class="mb-2">• ${feature}</p>`).join('')}
                <hr>
                <h6 class="text-muted mb-3">Animations suggérées :</h6>
                ${animations[selectedAnimation].map(anim => `<p class="mb-2">• ${anim}</p>`).join('')}
            </div>
        `;

        // Mise à jour de la prévisualisation de la landing page
        const preview = previewStyles[selectedStyle];
        document.querySelector('.preview-header').innerHTML = preview.header;
        document.querySelector('.preview-hero').innerHTML = preview.hero;
        document.querySelector('.preview-features').innerHTML = preview.features.replace(/Feature \d/g, (match) => {
            const index = parseInt(match.slice(-1)) - 1;
            return featureExamples[selectedStyle][index] || match;
        });

        // Ajout des animations en fonction de la sélection
        const previewElement = document.getElementById('landingPagePreview');
        previewElement.className = 'border rounded p-3';
        if (selectedAnimation === 'subtile') {
            previewElement.style.transition = 'all 0.3s ease';
        } else if (selectedAnimation === 'dynamique') {
            previewElement.style.transition = 'all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
        } else {
            previewElement.style.transition = 'none';
        }
    }

    // Écouteurs d'événements pour les changements de style et d'animation
    document.querySelectorAll('input[name="styleOption"], input[name="animationOption"]').forEach(input => {
        input.addEventListener('change', updateMoodboard);
    });

    // Mise à jour initiale du moodboard lors de l'ouverture de la modal
    moodboardButton.addEventListener('click', function() {
        moodboardModal.show();
        updateMoodboard();
    });
});