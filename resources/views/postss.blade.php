
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-list"></i> {{ __('Posts List') }}</div>

                <div class="card-body">
                    {{-- @session('success')
                        <div class="alert alert-success" role="alert"> 
                            {{ $value }}
                        </div>
                    @endsession --}}

                    <div id="notification">
                        
                    </div>
                    <livewire:post-component />

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @if(auth()->user()->admin)
        <script type="module">
                window.Echo.channel('posts')
                    .listen('.create', (data) => {
                        console.log('Order status updated: ', data);
                        var d1 = document.getElementById('notification');
                        d1.insertAdjacentHTML('beforeend', '<div class="alert alert-success alert-dismissible fade show"><span><i class="fa fa-circle-check"></i>  '+data.message+'</span></div>');
                    });
        </script>
    @endif
@endsection