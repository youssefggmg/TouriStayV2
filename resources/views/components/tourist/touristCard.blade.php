@props(['announcment'])

<div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
    <div class="relative">
        <img src="/api/placeholder/400/300" alt="Luxury Villa" class="w-full h-48 object-cover">
        <button class="absolute top-3 right-3 p-1.5 bg-white rounded-full shadow-sm hover:bg-rose-50">
            <i class="fas fa-heart text-rose-500"></i>
        </button>
    </div>
    <div class="p-4">
        <div class="flex justify-between items-start">
            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{$announcment->title}}</h3>
            <div class="flex items-center">
                <i class="fas fa-star text-yellow-400"></i>
                <span class="ml-1 text-gray-700">4.9</span>
            </div>
        </div>
        <p class="text-gray-600 mb-2">
            <i class="fas fa-map-marker-alt mr-1 text-gray-400">{{$announcment->city}}</i>
        </p>
        <div class="text-sm text-gray-500 mb-3">{{$announcment->disponibility}}</div>
        <div class="flex justify-between items-center">
            <div class="text-rose-600 font-semibold">${{$announcment->price}} <span class="text-gray-500 font-normal">/
                    night</span></div>
            <!-- Reserve Button -->
            <button onclick="openModal('{{$announcment->id}}', '{{$announcment->disponibility}}')"
                class="!bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                Reserve
            </button>
        </div>
    </div>
</div>

<!-- Reservation Modal -->
<!-- Reservation Modal (empty, to be updated dynamically) -->
<div id="reservationModal" 
     class="fixed inset-0 !bg-black bg-opacity-50 flex justify-center items-center hidden z-50" 
     role="dialog" 
     aria-modal="true"
     aria-labelledby="modalTitle">
    <div class="!bg-white p-8 rounded-xl shadow-xl w-full max-w-md relative mx-4 transition-all duration-300">
        <!-- Close Button -->
        <button 
            onclick="closeModal()" 
            class="absolute top-4 right-4 !text-gray-500 hover:!text-gray-700 transition-colors"
            aria-label="Close reservation modal">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <h2 id="modalTitle" class="text-2xl font-bold !text-gray-800 mb-6">Book Your Stay</h2>

        <form id="reservationForm" class="space-y-6">
            <!-- Date Range Picker -->
            <div>
                <label for="dynamicDateRange" class="block text-sm font-medium !text-gray-700 mb-2">
                    Select Date Range
                    <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="dynamicDateRange" 
                    name="dates"
                    required
                    class="w-full px-4 py-3 border !border-gray-300 rounded-lg focus:ring-2 focus:!ring-blue-500 focus:!border-blue-500 transition-all"
                    placeholder="Select check-in and check-out dates">
            </div>

            <!-- Payment Section -->
            <div class="space-y-4">
                <div>
                    <label for="cardNumber" class="block text-sm font-medium text-gray-700 mb-2">
                        Card Number
                        <span class="!text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="cardNumber" 
                        name="cardNumber"
                        required
                        inputmode="numeric"
                        pattern="[0-9\s]{13,19}"
                        maxlength="19"
                        placeholder="4242 4242 4242 4242"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="expiryDate" class="block text-sm font-medium text-gray-700 mb-2">
                            Expiry Date
                            <span class="!text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="expiryDate" 
                            name="expiryDate"
                            required
                            placeholder="MM/YY"
                            pattern="\d{2}/\d{2}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>
                    <div>
                        <label for="cvc" class="block text-sm font-medium text-gray-700 mb-2">
                            CVC
                            <span class="!text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="cvc" 
                            name="cvc"
                            required
                            inputmode="numeric"
                            pattern="\d{3}"
                            maxlength="3"
                            placeholder="123"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-6">
                <button 
                    type="button"
                    onclick="closeModal()" 
                    class="px-6 py-2.5 !text-gray-600 hover:!text-gray-800 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <button 
                    type="submit"
                    class="px-6 py-2.5 !bg-blue-600 hover:!bg-blue-700 !text-white font-medium rounded-lg transition-colors focus:ring-2 focus:!ring-blue-500 focus:ring-offset-2 disabled:opacity-50"
                    id="submitButton">
                    <span class="inline-block mr-2">Confirm Booking</span>
                    <svg id="loadingSpinner" class="hidden w-5 h-5 !text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>


<!-- JavaScript for Modal and Calendar -->

<script>
    function openModal(announcementId, disponibility) {
        let modal = document.getElementById("reservationModal");
        let dateInput = document.getElementById("dynamicDateRange"); // Use a single input for all

        modal.classList.remove("hidden");

        // Remove any previous Flatpickr instance before initializing a new one
        if (dateInput._flatpickr) {
            dateInput._flatpickr.destroy();
        }
        let reservations = @json($announcment->Reservations);
        let dates = reservations.map((Reservation) => {
            return {
                form: Reservation.startDate,
                to: Reservation.endDate
            }
        })
        // Initialize Flatpickr for the selected announcement
        flatpickr(dateInput, {
            mode: "range",
            dateFormat: "Y-m-d",
            minDate: "today",
            maxDate: disponibility,
            disable: dates
        });
    }

    function closeModal() {
        document.getElementById("reservationModal").classList.add("hidden");
    }

    // Close modal when clicking outside
    window.onclick = function (event) {
        let modal = document.getElementById("reservationModal");
        if (event.target === modal) {
            closeModal();
        }
    };
</script>