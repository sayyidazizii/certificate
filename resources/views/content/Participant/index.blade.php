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
                    <a href="{{ route('participant.index') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Participants
                    </a>
                </li>
            </ol>
        </nav>

        <!-- Card container -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg overflow-hidden mx-5">
            <!-- Title and button container with justify-between -->
            <div class="flex justify-between items-center mb-6 mx-8 my-2">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mx-2">Winners</h1>

                <div class="flex space-x-2"> <!-- Container for the buttons with space between them -->
                    <a href="{{ route('participant.importForm') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg inline-block transition duration-200 ease-in-out flex items-center">
                        <i class="fas fa-upload mr-2"></i> {{ __('Import') }}
                    </a>
                    <a href="{{ route('participant.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg inline-block transition duration-200 ease-in-out flex items-center">
                        <i class="fas fa-plus mr-2"></i> {{ __('Add Participant') }}
                    </a>
                </div>
            </div>

            <!-- Table Header -->
            <div class="overflow-x-auto mx-2">
                <table id="participants-table" class="min-w-full bg-white dark:bg-gray-800 table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200"></th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">No</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Participant Name</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Dojo</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Created At</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Updated At</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($participants as $participant)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-sm"></td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $participant->participant_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $participant->dojo->dojo_name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $participant->created_at ? $participant->created_at->format('d M Y') : 'No date' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $participant->updated_at ? $participant->updated_at->format('d M Y') : 'No date' }}
                            </td>
                            <td class="px-6 py-4 text-sm flex space-x-2">
                                <a href="{{ route('participant.edit', $participant->id) }}"
                                    class="bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-3 py-1 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800 transition duration-200 ease-in-out flex items-center">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('participant.destroy', $participant->id) }}" method="POST" class="delete-form inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)"
                                        class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 px-3 py-1 rounded-lg hover:bg-red-200 dark:hover:bg-red-800 transition duration-200 ease-in-out flex items-center">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 px-4 py-2">
                {{ $participants->links() }}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#participants-table').DataTable({
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

            setTimeout(function() {
                $('#success-message').fadeOut();
                $('#error-message').fadeOut();
            }, 5000);
        });

        function confirmDelete(button) {
            if (confirm('Are you sure you want to delete this participant? This action cannot be undone.')) {
                button.closest('form').submit();
            }
        }
    </script>
</x-app-layout>
