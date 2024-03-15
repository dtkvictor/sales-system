@push('scripts')
    <script type="module">
        import { createToast } from "{{ asset('assets/js/src/components/toast.js') }}";
        createToast('{{ $type }}', '{{ $slot }}');
    </script>
@endpush
