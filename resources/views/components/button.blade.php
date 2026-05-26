<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 btn-gold border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus-ring-gold disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
