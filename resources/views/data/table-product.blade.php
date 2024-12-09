<x-layouts.app class="mt-6 pb-16">
    <a href="{{ route('home') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
    <h1 class="text-5xl font-bold">{{ __('Data Product') }}</h1>

    @if (session('error'))
        <div role="alert" class="alert alert-error">
            @svg('phosphor-x-circle', 'w-6 h-6')
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="card bg-base-100 shadow-xl p-6 max-w-4xl mx-auto mt-10">
        <div class="card-body">
            <x-layouts.form method="POST" action="{{ route('new-data') }}" class="pb-12 max-w-none" enctype="multipart/form-data">
                @csrf

              <div class="overflow-x-auto">
                <table class="table table-zebra w-full border-collapse border border-gray-300">
                    <thead>
                      <tr>
                          <th class="border border-gray-300 p-2 text-center">#</th>
                          <th class="border border-gray-300 p-2 text-center">Name</th>
                          <th class="border border-gray-300 p-2 text-center">Price</th>
                          <th class="border border-gray-300 p-2 text-center">Stock</th>
                          <th class="border border-gray-300 p-2 text-center">Category</th>
                          <th class="border border-gray-300 p-2 text-center">Image</th>
                          <th class="border border-gray-300 p-2 text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($products as $index => $product)
                      <tr>
                          <td class="border border-gray-300 p-2 text-center align-middle">
                            {{ ($products->currentPage()-1) * $products->perPage() + $index + 1 }}
                          </td>

                          <td class="border border-gray-300 p-2 text-center align-middle">
                            {{ $product->name }}
                          </td>

                          <td class="border border-gray-300 p-2 text-center align-middle">
                            {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}
                          </td>

                          <td class="border border-gray-300 p-2 text-center align-middle">
                            {{ $product->stock }}
                          </td>

                          <td class="border border-gray-300 p-2 text-center align-middle">
                            {{ $product->category }}
                          </td>

                          <td class="border border-gray-300 p-2 text-center align-middle">
                            <div class="flex justify-center items-center">
                              <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="90">
                            </div>
                          </td>
                          
                          <td class="border border-gray-300 p-2 text-center align-middle">
                            <a href="{{ route('new-edit', $product->id) }}" type="button" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ route('delete-product', $product->id) }}" type="button" class="btn btn-sm btn-error">Delete</a>
                          </td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                </table>

                <div class="mt-4">
                  {{ $products->links() }}
                </div>

              </div>
              
            </x-layouts.form>
        </div>
    </div>
</x-layouts.app>
