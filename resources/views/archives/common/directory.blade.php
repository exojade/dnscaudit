<div class="col-md-3 col-6 text-center">

<a>

</a>

    <button 
        data-toggle="tooltip" title="{{ $directory->fullPath() ?? '' }}" 
        class="btn align-items-center justify-content-center btn-block" 
        data-bs-toggle="dropdown" aria-expanded="false" 
        data-route="{{ route($route ?? 'archives-page') }}?directory={{ $directory->id }}" style="border:none">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-folder"></i></span>
                <div class="info-box-content">
                <span class="info-box-text text-left" style="text-overflow: ellipsis">{{ $directory->name ?? '' }}</span>

                </div>

            </div>
    </button>
    <ul class="dropdown-menu text-left">
        <li><a href="{{ route($route ?? 'archives-page') }}?directory={{ $directory->id }}" class="text-decoration-none px-2" ><i class="fa fa-folder"></i> Open Folder</a></li>
        <li><a href="#" class="text-decoration-none btn-property px-2"
            data-bs-toggle="modal" data-bs-target="#propertyModal"
            data-name="{{ $directory->name }}"
            data-type="Folder"
            data-full-path="{{ $directory->fullPath() ?? '' }}"
            data-created-by="{{ $directory->user->username ?? 'Admin' }}"
            data-created-at="{{ $directory->created_at ? $directory->created_at->format('M d, Y h:i A') : '' }}"
            data-updated-at="{{ $directory->created_at ? $directory->created_at->format('M d, Y h:i A') : '' }}"
            ><i class="fa fa-cog"></i> Properties</a></li>
        
        @if(Auth::user()->role->role_name == 'Document Control Custodian' && !empty($current_directory->area) && $current_directory->area->type == 'process')
        <li>
            <a href="#" class="text-decoration-none toggleDirectoryModal px-2"
                data-name="{{ $directory->name }}" 
                data-route="{{ route('archives-update-directory', $directory->id) }}" 
                data-bs-toggle="modal" data-bs-target="#directoryModal">
                <i class="fa fa-edit"></i>  Rename
            </a>
        </li>
        <li>
            <a href="#" class="text-decoration-none btn-confirm px-2" data-message="Are you sure you wan't to delete this folder?" data-target="#delete_directory_{{ $directory->id }}"><i class="fa fa-trash"></i>  Delete</button>
                <form id="delete_directory_{{ $directory->id }}" action="{{ route('archives-delete-directory', $directory->id) }}" class="d-none" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            </a>
        </li>
        @endif
    </ul>
</div>