{{-- resources/views/components/sweetalert-session.blade.php --}}

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Sucesso!",
                text: @json(session('success')),
                icon: "success"
            });
        });
    </script>
@endif

@if (session()->has('message'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Aviso!",
                text: @json(session('message')),
                icon: "success"
            });
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Erro!",
                text: @json(session('error')),
                icon: "error"
            });
        });
    </script>
@endif

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Erros de Validação",
                html: `{!! implode('<br>', $errors->all()) !!}`,
                icon: "warning"
            });
        });
    </script>
@endif
