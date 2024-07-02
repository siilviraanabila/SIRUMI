<title>Jadwal Meeting</title>
@include('layouts.header')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>

<!-- Hero Section Start -->
<style>
    #halaman {
        background-color: white;
    }
</style>

<body style="background-color: #D3F0FF;">
    @include('layouts.sidebar')
    <section id="home" class="py-5">
        <div style="margin-left: 16rem;">
            <div id="halaman" class="w-full h-fit p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between p-4 border-b dark:border-primary text-gray-900 dark:text-white">
                    <h4 class="text-lg font-bold text-black dark:text-light text-center w-full" style="font-size: 24px;">Jadwal Meeting PT PLN Indonesia Power UBP Semarang</h4>
                </div>
                <div class="container panel panel-primary">
                    <div class="panel-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="eventDetailModal">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Layer backdrop -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal content -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">Detail Acara</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="eventDetailContent"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" id="closeModalBtn">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                navLinks: true,
                editable: true,
                events: "{{ route('geteventUmum') }}",
                displayEventTime: true,
                eventRender: function (event, element) {
                    if (event.color) {
                        element.css('background-color', event.color);
                        element.css('border-color', event.color);
                    }
                },
                eventClick: function(calEvent, jsEvent, view) {
                    // Show event details in modal
                    $('#eventDetailModalLabel').text(calEvent.title);
                    var modalBody =
                        '<p><strong>Acara:</strong> ' + calEvent.title + '</p>' +
                        '<p><strong>Start:</strong> ' + calEvent.start.format('YYYY-MM-DD HH:mm:ss') + '</p>' +
                        '<p><strong>End:</strong> ' + calEvent.end.format('YYYY-MM-DD HH:mm:ss') + '</p>' +
                        '<p><strong>Gedung:</strong> ' + calEvent.gedung + '</p>' +
                        '<p><strong>Ruangan:</strong> ' + calEvent.ruangan + '</p>' +
                        '<p><strong>Jumlah Peserta:</strong> ' + calEvent.jumlah_peserta + '</p>';
                    $('#eventDetailContent').html(modalBody);
                    $('#eventDetailModal').removeClass('hidden'); // Show modal
                }
            });

            // Close Button
            $('#closeModalBtn').click(function() {
                $('#eventDetailModal').addClass('hidden'); // Hide modal
            });
        });
    </script>

</body>

</html>