@if (session('success'))
        <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif
    @if (session('info'))
        <div class="mb-4 p-4 rounded bg-blue-100 text-blue-800 border border-blue-300">
            {{ session('info') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-300">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif