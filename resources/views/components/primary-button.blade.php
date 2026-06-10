<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-2xl bg-[#ea6b6b] px-5 py-3 text-sm font-black text-white shadow-md shadow-red-900/10 transition hover:bg-[#df5f5f] focus:outline-none focus:ring-2 focus:ring-[#ea6b6b]/30']) }}>
    {{ $slot }}
</button>
