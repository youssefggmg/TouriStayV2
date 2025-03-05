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
            <button onclick="openModal(this)" data-id="{{$announcment->id}}"
                data-disponibility="{{$announcment->disponibility}}"
                data-reservations='@json($announcment->Reservations)'
                class="!bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                Reserve
            </button>
        </div>
    </div>
</div>

<!-- Unique Reservation Modal per Announcement -->
<div id="reservationModal-{{$announcment->id}}"
    class="fixed inset-0 !bg-black bg-opacity-50 flex justify-center items-center hidden z-50" role="dialog"
    aria-modal="true" aria-labelledby="modalTitle-{{$announcment->id}}">
    <div class="!bg-white p-8 rounded-xl shadow-xl w-full max-w-md relative mx-4 transition-all duration-300">
        <button onclick="closeModal('{{$announcment->id}}')"
            class="absolute top-4 right-4 !text-gray-500 hover:!text-gray-700 transition-colors"
            aria-label="Close reservation modal">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 id="modalTitle-{{$announcment->id}}" class="text-2xl font-bold !text-gray-800 mb-6">Book Your Stay</h2>

        <form action="/reserv" id="reservationForm-{{$announcment->id}}" class="space-y-6" method="POST">
            @csrf
            <input type="number" name="announcmentID" value="{{$announcment->id}}" class="hidden">

            <!-- Date Range Picker -->
            <div>
                <label for="dateRange-{{$announcment->id}}" class="block text-sm font-medium !text-gray-700 mb-2">
                    Select Date Range <span class="text-red-500">*</span>
                </label>
                <input type="text" id="dateRange-{{$announcment->id}}" name="dates" required
                    class="w-full px-4 py-3 border !border-gray-300 rounded-lg focus:ring-2 focus:!ring-blue-500 focus:!border-blue-500 transition-all"
                    placeholder="Select check-in and check-out dates">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4 pt-6">
                <button type="button" onclick="closeModal('{{$announcment->id}}')"
                    class="px-6 py-2.5 !text-gray-600 hover:!text-gray-800 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit"
                    class="px-6 py-2.5 !bg-blue-600 hover:!bg-blue-700 !text-white font-medium rounded-lg transition-colors">
                    Confirm Booking
                </button>
            </div>
        </form>
    </div>
</div>


<!-- JavaScript for Modal and Calendar -->

<script>
    function openModal(button) {
        let id = button.dataset.id;
        let disponibility = button.dataset.disponibility;
        let reservations = JSON.parse(button.dataset.reservations);

        console.log(reservations);

        let modal = document.getElementById(`reservationModal-${id}`);
        let dateInput = document.getElementById(`dateRange-${id}`);

        if (!modal || !dateInput) {
            console.error(`Modal or date input not found for announcement ${id}`);
            return;
        }

        modal.classList.remove("hidden");

        // Remove any previous Flatpickr instance before initializing a new one
        if (dateInput._flatpickr) {
            dateInput._flatpickr.destroy();
        }

        // Fetch reservations for the current announcement
        let disabledDates = reservations.map(reservation => ({
            from: reservation.startDate,
            to: reservation.endDate
        }));

        // Initialize Flatpickr for the selected announcement
        flatpickr(dateInput, {
            mode: "range",
            dateFormat: "Y-m-d",
            minDate: "today",
            maxDate: disponibility,
            disable: disabledDates
        });
    }

    function closeModal(announcementId) {
        let modal = document.getElementById(`reservationModal-${announcementId}`);
        if (modal) {
            modal.classList.add("hidden");
        }
    }

    // Close modal when clicking outside
    window.onclick = function (event) {
        let modals = document.querySelectorAll("[id^=reservationModal-]");
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        });
    };

</script>