@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @include('layouts.status_info')
                    <!-- Button to open modal -->
                    <button 
                        type="button" 
                        class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        onclick="document.getElementById('addCategoryModal').classList.remove('hidden')"
                    >
                        Add New Category
                    </button>

                    <!-- Modal -->
                    <div id="addCategoryModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6">
                            <h3 class="text-lg font-semibold mb-4">Add New Category</h3>
                            <form action="{{ route('admin.product-categories.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 dark:text-gray-200 mb-2">Name</label>
                                    <input type="text" name="name" id="name" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300 dark:bg-gray-700 dark:text-gray-100">
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" 
                                        class="mr-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                                        onclick="document.getElementById('addCategoryModal').classList.add('hidden')"
                                    >
                                        Cancel
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="min-w-full bg-white dark:bg-gray-800 border">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Products Count</th>
                                <th class="px-4 py-2 border">Total Stock</th>
                                <th class="px-4 py-2 border">Total Value</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $category->id }}</td>
                                    <td class="px-4 py-2 border">{{ $category->name }}</td>
                                    <td class="px-4 py-2 border">{{ $category->products_count }}</td>
                                    <td class="px-4 py-2 border">{{ $category->products_sum_stock ?? 0 }}</td>
                                    <td class="px-4 py-2 border"> Rp {{ number_format(($category->products_sum_price*$category->products_sum_stock ) ?? 0, 0, ',', '.') }}</td> 
                                    <td class="px-4 py-2 border">
                                        <button 
                                            type="button" 
                                            class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                            onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                        >
                                            Edit
                                        </button>
                                        <!-- Edit Modal -->
                                        <div id="editCategoryModal-{{ $category->id }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6">
                                                <h3 class="text-lg font-semibold mb-4">Edit Category</h3>
                                                <form action="{{ route('admin.product-categories.update', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <label for="edit-name-{{ $category->id }}" class="block text-gray-700 dark:text-gray-200 mb-2">Name</label>
                                                        <input type="text" name="name" id="edit-name-{{ $category->id }}" value="{{ $category->name }}" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300 dark:bg-gray-700 dark:text-gray-100">
                                                    </div>
                                                    <div class="flex justify-end">
                                                        <button type="button" 
                                                            class="mr-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                                                            onclick="closeEditModal({{ $category->id }})"
                                                        >
                                                            Cancel
                                                        </button>
                                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <script>
                                        function openEditModal(id, name) {
                                            document.getElementById('editCategoryModal-' + id).classList.remove('hidden');
                                            document.getElementById('edit-name-' + id).value = name;
                                        }
                                        function closeEditModal(id) {
                                            document.getElementById('editCategoryModal-' + id).classList.add('hidden');
                                        }
                                        </script>
                                        <form action="{{ route('admin.product-categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete the category {{ $category->name }} ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-2 border text-center text-gray-500">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $categories->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
