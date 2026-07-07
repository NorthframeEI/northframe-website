export default function billingPeriod() {
    const typeSelect = document.getElementById('type');
    const billingContainer = document.getElementById('billing_period_container');

    function toggleBillingPeriod() {

        if (typeSelect.value === 'recurring') {

            billingContainer.classList.remove('hidden');
            billingContainer.classList.add('flex');

        } else {

            billingContainer.classList.add('hidden');
            billingContainer.classList.remove('flex');

        }

    }


    typeSelect.addEventListener('change', toggleBillingPeriod);


    // Permet de gérer le cas où une valeur existe déjà (édition plus tard)
    toggleBillingPeriod();
}