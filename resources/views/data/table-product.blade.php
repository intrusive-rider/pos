<x-layouts.app class="mt-6 pb-16">
    <h1 class="text-5xl font-bold">{{ __('Data Product') }}</h1>

    @if (session('error'))
        <div role="alert" class="alert alert-error">
            @svg('phosphor-x-circle', 'w-6 h-6')
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="card bg-base-100 shadow-xl p-6 max-w-4xl mx-auto mt-10">
        <div class="card-body">
            <x-layouts.form method="POST" class="pb-12 max-w-none" enctype="multipart/form-data">
                @csrf
                <div class="overflow-x-auto">
                    <table class="table table-xs">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Stock</th>
                          <th>Category</th>
                          <th>Image</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>1</th>
                          <td>Cy Ganderton</td>
                          <td>Quality Control Specialist</td>
                          <td>Littel, Schaden and Vandervort</td>
                          <td>Canada</td>
                          <td>12/16/2020</td>
                          <td>Blue</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </x-layouts.form>
        </div>
    </div>
</x-layouts.app>
