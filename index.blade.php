<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('products.create') }}" 
                       class="font-bold py-2 px-4 rounded inline-block"
                       style="background-color: #3b82f6; color: white; text-decoration: none;">
                        + Tambah Produk Baru
                    </a>
                </div>

                <table class="min-w-full table-auto border-collapse border border-slate-400 mt-4">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-slate-300 px-4 py-2 text-left">Nama</th>
                            <th class="border border-slate-300 px-4 py-2 text-left">Harga</th>
                            <th class="border border-slate-300 px-4 py-2 text-left">Stok</th>
                            <th class="border border-slate-300 px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="border border-slate-300 px-4 py-2">{{ $product->name }}</td>
                            <td class="border border-slate-300 px-4 py-2">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="border border-slate-300 px-4 py-2">{{ $product->stock }}</td>
                            <td class="border border-slate-300 px-4 py-2 text-center">
                                
                                <a href="{{ route('products.edit', $product->id) }}" class="text-yellow-600 hover:underline font-bold mr-2">
                                    Edit
                                </a>
                                
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline font-bold">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="border border-slate-300 px-4 py-4 text-center text-gray-500">
                                Belum ada data produk. Silakan klik tombol "+ Tambah Produk Baru" di atas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>