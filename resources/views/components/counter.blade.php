<div x-data="{ count: 0 }" class="flex items-center join h-8">
    <button x-on:click="count--" class="btn btn-sm join-item" :disabled="count <= 0">
        <i class="ph-bold ph-minus"></i>
    </button>
    <input type="number" x-model="count"
        class="border-none focus:ring-0 h-full join-item w-16 bg-base-200 tabular-nums slashed-zero flex items-center justify-center text-center no-spinner" />
    <button x-on:click="count++" class="btn btn-sm join-item">
        <i class="ph-bold ph-plus"></i>
    </button>
</div>
