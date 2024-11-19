<div class="card lg:card-side card-compact bg-base-100 shadow-xl">
    <figure>
        <img src="https://placehold.co/400" />
    </figure>
    <div class="card-body justify-between w-56">
        <h2 class="card-title text-2xl">{{ $slot }}</h2>
        <div class="flex items-center join">
            <button class="btn join-item">
                <i class="ph-bold ph-minus text-lg"></i>
            </button>
            <div
                class="h-full join-item px-6 text-lg bg-base-200 tabular-nums slashed-zero flex items-center justify-center">
                0
            </div>
            <button class="btn join-item">
                <i class="ph-bold ph-plus text-lg"></i>
            </button>
        </div>
    </div>
</div>
