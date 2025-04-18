document.addEventListener('DOMContentLoaded', function() {
    const simulateButton = document.getElementById('simulateButton');
    const modal = new bootstrap.Modal(document.getElementById('simulationModal'));

    simulateButton.addEventListener('click', function() {
        // Récupérer les valeurs du formulaire
        const type = document.getElementById('website_request_form_type').value;
        const estimatedPages = document.getElementById('website_request_form_estimatedPages').value;
        const specificFunctions = Array.from(document.querySelectorAll('#website_request_form_specificFunctions input[type="checkbox"]:checked')).map(cb => cb.value);
        const hasLogo = document.getElementById('website_request_form_logo').value === 'Oui';

        // Calcul du coût de base selon le type de site
        let baseCost = 0;
        let baseTime = 0;
        switch(type) {
            case 'Site vitrine':
                baseCost = 499;
                baseTime = 7;
                break;
            case 'E-commerce':
                baseCost = 1500;
                baseTime = 15;
                break;
            case 'Portfolio':
                baseCost = 500;
                baseTime = 10;
                break;
            case 'Blog':
                baseCost = 600;
                baseTime = 10;
                break;
            default:
                baseCost = 1000;
                baseTime = 10;
        }

        // Ajustement selon le nombre de pages
        const pageCount = parseInt(estimatedPages) || 5;
        const pageCost = Math.max(0, (pageCount - 5) * 50);
        const pageTime = Math.max(0, (pageCount - 5) * 1);

        // Coût des fonctionnalités spécifiques
        const functionsCost = specificFunctions.reduce((total, func) => {
            switch(func) {
                case 'contact_form': return total + 50;
                case 'reservation': return total + 100;
                case 'online_payment': return total + 100;
                case 'gallery': return total + 75;
                case 'other': return total + 75;
                default: return total;
            }
        }, 0);

        const functionsTime = specificFunctions.reduce((total, func) => {
            switch(func) {
                case 'contact_form': return total + 1;
                case 'reservation': return total + 2;
                case 'online_payment': return total + 2;
                case 'gallery': return total + 1;
                case 'other': return total + 1;
                default: return total;
            }
        }, 0);

        // Coût supplémentaire si pas de logo/charte graphique
        const logoCost = hasLogo ? 0 : 250;
        const logoTime = hasLogo ? 0 : 3;

        // Calcul du total
        const totalCost = baseCost + pageCost + functionsCost + logoCost;
        const totalTime = Math.min(20, baseTime + pageTime + functionsTime + logoTime);

        // Afficher les résultats
        document.getElementById('estimatedCost').textContent = `${totalCost}€`;
        document.getElementById('estimatedTime').textContent = `${totalTime} jours`;

        // Détails de l'estimation
        const details = document.getElementById('estimationDetails');
        details.innerHTML = `
            <li>Coût de base (${type}): ${baseCost}€</li>
            <li>Pages supplémentaires: ${pageCost}€</li>
            <li>Fonctionnalités spécifiques: ${functionsCost}€</li>
            ${!hasLogo ? '<li>Création logo/charte graphique: ' + logoCost + '€</li>' : ''}
        `;

        modal.show();
    });
});