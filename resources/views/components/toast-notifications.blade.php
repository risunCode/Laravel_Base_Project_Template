<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swal === 'undefined') return;

    const toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: {
            popup: 'rounded-2xl border border-[var(--border-color)] shadow-2xl',
        }
    });

    @if(session('success'))
        toast.fire({ icon: 'success', title: @json(session('success')) });
    @endif

    @if(session('error'))
        toast.fire({ icon: 'error', title: @json(session('error')) });
    @endif

    @if($errors->any())
        toast.fire({ icon: 'error', title: @json($errors->first()) });
    @endif
});
</script>
