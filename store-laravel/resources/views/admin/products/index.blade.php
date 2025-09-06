@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
@include('layouts.status_info')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('admin.products.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add New Product</a>

                    <div class="mb-4 flex gap-4">
                        <form action="{{ route('admin.products.index') }}" method="GET" class="flex-1">
                            <div class="flex gap-2">
                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Search products..."
                                    value="{{ request('search') }}"
                                    class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                >
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Search
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                        Clear
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                <div>
                    <form action ="{{ route('admin.products.index') }}" method="GET" class ="mb-4">
                        <label for="category" class="mr-2">Filter by Category:</label>
                        <select name="category" id="category" onchange="this.form.submit()" class="px-4 py-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    <table class="min-w-full bg-white dark:bg-gray-800 border">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Description</th>
                                <th class="px-4 py-2 border">Image</th>
                                <th class="px-4 py-2 border">Price</th>
                                <th class="px-4 py-2 border">Stock</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $product->id }}</td>
                                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border">{{ $product->description }}</td>
                                    <td class="px-4 py-2 border">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded">
                                        @else
                                            <span class="text-gray-500">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 border">{{ $product->stock }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete:  {{ $product->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            @if (request('search'))
                                <tr>
                                    <td colspan="7" class="px-4 py-2 border text-center text-gray-500">No products found.</td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="7" class="px-4 py-2 border text-center text-gray-500">No products available.</td>
                                </tr>
                                @endif
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $products->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
