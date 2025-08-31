<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div style="font-family: Arial, sans-serif;">
                            <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 1.5rem;">Dashboard</h1>
                            <div style="display: flex; gap: 1.5rem;">
                                <div style="background: linear-gradient(135deg, #90caf9 0%, #e3f2fd 100%); border-radius: 8px; padding: 1.5rem; flex: 1; box-shadow: 0 1px 4px rgba(0,0,0,0.05); border: 1px solid #bbdefb;">
                                    <div style="font-weight: bold; margin-bottom: 0.5rem; color: #1565c0;">Jumlah Produk</div>
                                    <div style="font-size: 2rem; font-weight: bold; color: #0d47a1;">{{ number_format($totalProducts) }}</div>
                                    <div style="font-size: 0.95rem; color: #333; margin-top: 0.5rem;">Total produk yang tersedia di sistem.</div>
                                </div>
                                <div style="background: linear-gradient(135deg, #a5d6a7 0%, #e8f5e9 100%); border-radius: 8px; padding: 1.5rem; flex: 1; box-shadow: 0 1px 4px rgba(0,0,0,0.05); border: 1px solid #c8e6c9;">
                                    <div style="font-weight: bold; margin-bottom: 0.5rem; color: #388e3c;">Jumlah Klik Produk</div>
                                    <div style="font-size: 2rem; font-weight: bold; color: #1b5e20;">{{ number_format($totalClicks) }}</div>
                                    <div style="font-size: 0.95rem; color: #333; margin-top: 0.5rem;">Total klik pada produk yang telah dilihat pengguna.</div>
                                </div>
                                <div style="background: linear-gradient(135deg, #ffe082 0%, #fff8e1 100%); border-radius: 8px; padding: 1.5rem; flex: 1; box-shadow: 0 1px 4px rgba(0,0,0,0.05); border: 1px solid #ffe0b2;">
                                    <div style="font-weight: bold; margin-bottom: 0.5rem; color: #ff8f00;">Jumlah Kategori Produk</div>
                                    <div style="font-size: 2rem; font-weight: bold; color: #ff6f00;">{{ number_format($totalCategories) }}</div>
                                    <div style="font-size: 0.95rem; color: #333; margin-top: 0.5rem;">Total kategori produk yang tersedia di sistem.</div>
                                </div>
                                  <div style="background: linear-gradient(135deg, #50d66d 0%, #fff8e1 100%); border-radius: 8px; padding: 1.5rem; flex: 1; box-shadow: 0 1px 4px rgba(0,0,0,0.05); border: 1px solid #ffe0b2;">
                                    <div style="font-weight: bold; margin-bottom: 0.5rem; color: #050505;">Jumlah Stock Produk</div>
                                    <div style="font-size: 2rem; font-weight: bold; color: #df7fdb;">{{ number_format($productStock) }}</div>
                                    <div style="font-size: 0.95rem; color: #333; margin-top: 0.5rem;">Total stok yang tersedia di sistem.</div>
                            </div>
                               <div style="background: linear-gradient(135deg, #bfe76b 0%, #fff8e1 100%); border-radius: 8px; padding: 1.5rem; flex: 1; box-shadow: 0 1px 4px rgba(0,0,0,0.05); border: 1px solid #ffe0b2;">
                                    <div style="font-weight: bold; margin-bottom: 0.5rem; color: #747474;">Total price of all products</div>
                                    <div style="font-size: 2rem; font-weight: bold; color: #8637fc;">{{ number_format($totalStockValue) }}</div>
                                    <div style="font-size: 0.95rem; color: #333; margin-top: 0.5rem;">Total sum of all Products in stock.</div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
