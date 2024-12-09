<x-layouts.app class="mt-6 pb-16">
    <a href="{{ route('new-data') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
    <h1 class="text-5xl font-bold">{{ __('Edit Stocks') }}</h1>

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    @if (session('error'))
        <div role="alert" class="alert alert-error">
            @svg('phosphor-x-circle', 'w-6 h-6')
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="card bg-base-100 shadow-xl p-6 max-w-4xl mx-auto mt-10">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold mb-6">Add New Product</h2>
            
            <x-layouts.form method="POST" action="{{ route('save-update', $product->id) }}" enctype="multipart/form-data" class="pb-12 max-w-none">
                @csrf
                
                <!-- Input Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="input input-bordered w-full mt-1" placeholder="Enter product name" value="{{ old('name', $product->name) }}" required>
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
    
                <!-- Input Price -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" id="price" class="input input-bordered w-full mt-1" placeholder="Enter price" value="{{ old('price', $product->price) }}" required>
                </div>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
    
                <!-- Input Stock -->
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" id="stock" class="input input-bordered w-full mt-1" placeholder="Enter stock" value="{{ old('stock', $product->stock) }}" required>
                </div>
                @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
    
                <!-- Select Category -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <div class="join w-full">
                        <input class="join-item btn w-1/3" type="radio" name="category" value="food" id="category1" {{ old('category', $product->category) == 'food' ? 'checked' : '' }} required />
                        <label for="category1" class="join-item btn w-1/3">Food</label>
                
                        <input class="join-item btn w-1/3" type="radio" name="category" value="drink" id="category2" {{ old('category', $product->category) == 'drink' ? 'checked' : '' }} required />
                        <label for="category2" class="join-item btn w-1/3">Drink</label>
                
                        <input class="join-item btn w-1/3" type="radio" name="category" value="snack" id="category3" {{ old('category', $product->category) == 'dessert' ? 'checked' : '' }} required />
                        <label for="category3" class="join-item btn w-1/3">Dessert</label>
                    </div>
                </div>
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                
                <!-- Upload Image -->
                <div class="mb-4">
                    <div class="mb-4">
                        @if ($product->image)
                            <label>Old</label>
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="rounded shadow-md" width="100">
                        @endif
                    </div>

                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    <div class="form-group border border-gray-300 rounded-lg p-4 flex flex-col items-center space-y-2">
                        <input type="file" id="image" name="image" class="file-input file-input-bordered w-full max-w-xs" accept="image/*" />
                    </div>
                </div>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
    
                <!-- Buttons -->
                <div class="flex justify-between">
                    <button type="reset" class="btn btn-ghost">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>
            </x-layouts.form>
        </div>
    </div>
</x-layouts.app>
