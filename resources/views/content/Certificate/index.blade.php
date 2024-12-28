<x-app-layout>
    <div class="container mx-auto mt-6">

        <!-- Flash Message Notification -->
        @if (session('success'))
            <div class="fixed top-2 left-1/2 transform -translate-x-1/2 z-50 bg-green-500 text-white py-3 px-6 rounded-md shadow-md flex items-center space-x-2 mb-4 transition-transform duration-300" id="success-message">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div class="fixed top-2 left-1/2 transform -translate-x-1/2 z-50 bg-red-500 text-white py-3 px-6 rounded-md shadow-md flex items-center space-x-2 mb-4 transition-transform duration-300" id="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Breadcrumbs -->
        <nav class="mb-4 mx-5" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <li>
                    <a href="/dashboard" class="text-blue-600 font-semibold hover:text-blue-700">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                </li>
                <li>
                    <span class="mx-0">-</span>
                </li>
                <li>
                    <a href="{{ route('certificate.index') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Certificates
                    </a>
                </li>
            </ol>
        </nav>

        <!-- Card container for adding new certificate -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg overflow-hidden mx-5 mb-6 p-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Create Certificate</h2>
            <form id="create-certificate-form">
                @csrf
                <div class="mb-4">
                    <label for="participant_id" class="block text-sm font-medium text-gray-600 dark:text-gray-200">Participant</label>
                    <select id="participant_id" name="participant_id" class="js-example-basic-single block w-full mt-2 p-2 border border-gray-300 rounded-md">
                        @foreach($participants as $participant)
                            <option value="{{ $participant->id }}" data-name="{{ $participant->participant_name }}" data-dojo="{{ $participant->dojo->dojo_name }}">
                                {{ $participant->participant_name }} - {{ $participant->dojo->dojo_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="winner_id" class="block text-sm font-medium text-gray-600 dark:text-gray-200">Winner</label>
                    <select id="winner_id" name="winner_id" class="js-example-basic-single block w-full mt-2 p-2 border border-gray-300 rounded-md">
                        @foreach($winners as $winner)
                            <option value="{{ $winner->id }}">{{ $winner->winner_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Create Certificate</button>
                </div>
            </form>
        </div>

        <!-- Card container for displaying certificates -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg overflow-hidden mx-5">
            <!-- Table Header -->
            <div class="overflow-x-auto mx-2">
                <table id="certificates-table" class="min-w-full bg-white dark:bg-gray-800 table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">No</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Participant</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Winner</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Certificate Date</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Created At</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Updated At</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($certificates as $certificate)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $certificate->participant->participant_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $certificate->winner->winner_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $certificate->certificate_date ? \Carbon\Carbon::parse($certificate->certificate_date)->format('d M Y') : 'No date' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $certificate->created_at ? \Carbon\Carbon::parse($certificate->created_at)->format('d M Y') : 'No date' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $certificate->updated_at ? \Carbon\Carbon::parse($certificate->updated_at)->format('d M Y') : 'No date' }}
                            </td>
                            <td class="px-6 py-4 text-sm flex space-x-2">
                                <form action="{{ route('certificate.destroy', $certificate->id) }}" method="POST" class="delete-form inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)"
                                        class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 px-3 py-1 rounded-lg hover:bg-red-200 dark:hover:bg-red-800 transition duration-200 ease-in-out flex items-center">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                                <!-- Print Button -->
                                <a href="{{ route('certificate.print', $certificate->id) }}" target="_blank"
                                    class="bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-3 py-1 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800 transition duration-200 ease-in-out flex items-center">
                                    <i class="fas fa-print mr-1"></i> Print
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 px-4 py-2">
                {{ $certificates->links() }}
            </div>
        </div>
    </div>

    <script>
        // Handle form submission with AJAX
        document.getElementById('create-certificate-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch("{{ route('certificate.store') }}", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Reload to see the new certificate
                } else {
                    alert('Error creating certificate');
                }
            });
        });

        $(document).ready(function() {
            // Initialize Select2 for participant and winner dropdowns
            $('.js-example-basic-single').select2({
                placeholder: "Select an option",
                allowClear: true
            });

            // Initialize DataTable
            $('#certificates-table').DataTable({
                paging: true,
                searching: true,
                info: true,
                order: [],
                lengthChange: true,
                pageLength: 5,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search ...",
                    paginate: {
                        next: '<i class="fas fa-chevron-right"></i>',
                        previous: '<i class="fas fa-chevron-left"></i>'
                    },
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries"
                },
                dom: '<"flex justify-between items-center mb-4"<"flex items-center"l><f>>rt<"flex justify-between items-center mt-4"ip>',
                drawCallback: function() {
                    $('table tbody tr').addClass('hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200');
                }
            });
        });
    </script>
</x-app-layout>
