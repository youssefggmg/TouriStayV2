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
<div id="reservationModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-xl">
            &times;
        </button>

        <h2 class="text-xl font-semibold mb-4">Book Your Stay</h2>

        <label class="block text-sm font-medium text-gray-700">Select Date Range</label>
        <input type="text" id="dynamicDateRange" class="w-full p-2 border rounded mb-3">

        <label class="block text-sm font-medium text-gray-700">Payment Info</label>
        <input type="text" placeholder="Card Number" class="w-full p-2 border rounded mb-3">

        <div class="flex justify-end">
            <button onclick="closeModal()" class="!bg-gray-400 text-white px-4 py-2 rounded mr-2">Cancel</button>
            <button class="!bg-green-500 text-white px-4 py-2 rounded">Confirm Booking</button>
        </div>
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
        let reservations = @json($announcment->Reservations)
        let dates = reservatino.map((Reservation) => {
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
            maxDate: disponibility
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