@extends('layout.sidebar')
@section('title')
<title>Evidence</title>
@endsection
@section('page')
<style>
    .folder{
        width: 140px;
        height: 123px;
        background-repeat: no-repeat;
        background-position: center;
        background-image: url("{{ Storage::url('assets/folder.png') }}");
        color: #ffffff;
    }
    .folder:hover{
        border: 2px #d1d1d1 solid;
        color: #ffffff;
    }
    .folder:focus{
        border: 2px #d1d1d1 solid !important;
        color: #ffffff !important;
    }
    .folder:active{
        border: 2px #d1d1d1 solid !important;
        color: #ffffff !important;
    }
    .file{

    }
</style>
    <div class="container">
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('po-evidence-page') }}">Root</a></li>
              <li class="breadcrumb-item"><a href="{{ route('po-program-process',[request()->route('program')]) }}">{{ $program }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $process->process_name }}</li>
            </ol>
        </nav>
        <div class="row g-3">
            @foreach ($folder as $item)
                <div class="col-2">
                    <a class="folder btn d-flex align-items-center justify-content-center" href="{{ route('po-office-root-process',[request()->route('office'),$item->id]) }}">
                        {{ $item['folder_name'] }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const data = {!! json_encode($folder) !!};
        console.log(data);
    </script>
@endsection