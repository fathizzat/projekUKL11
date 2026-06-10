<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-2xl bg-rose-600 px-5 py-3 text-sm font-black text-white shadow-md shadow-rose-900/10 transition hover:bg-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-200']) }}>
    {{ $slot }}
</button>
