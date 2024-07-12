</div><!DOCTYPE html>
<html lang="en">
<head>
  <!-- Include necessary Bootstrap CSS and other dependencies -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  
</head>

<body>
@extends('layout.sidebar')
@section('title')
<title>Previous Audit Plan</title>
@endsection

@section('page')
    <div class="page-header">
        <h2>Previous Audit Plan</h2>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 p-3">
                <div class="m-3 bg-white py-2">
     <div class="px-3 py-2">
                        @include('layout.alert')
                        
                            <form id="auditPlanForm" method="POST" action="{{ route('lead-auditor.audit.update',$audit_plan->id) }}">
                                @csrf
                                <div>
                                    <div class="mb-3">
                                        <label for="process" class="form-label">Name</label>
                                        <input type="text" value="{{ $audit_plan->name ?? '' }}" class="form-control shadow-none" id="name" name="name" placeholder="Enter name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="process" class="form-label">Description</label>
                                        <textarea class="form-control shadow-none" rows="3" id="description" name="description" placeholder="Enter description">{{ $audit_plan->description ?? '' }}</textarea>
                                    </div><br>
                                    <div class="mt-2">
                                        <h4>Process and Auditors</h4>
                                        <button class="btn btn-success" style="float:right" type="button" data-bs-toggle="modal" data-bs-target="#addProcessModal"><i class="fa fa-plus"></i> Add Process</button><br><br>
                                        <table class="table text-black table-process">
                                            <thead>
                                                <tr>
                                                    <th>TEAM LEAD</th>
                                                    <th>PROCESS</th>
                                                    <th>AUDITORS</th>
                                                    <th>Date</th>
                                                    <th>From</th>
                                                    <th>TO</th>
                                                    <th><i class="fas fa-cogs"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($batches as $batch)
                                                <tr>
                                                    <td>{{ $batch->areaLead[0]->firstname }} {{ $batch->areaLead[0]->surname }}</td>
                                                    {{-- <td>{{ $batch->areaLead->firstname }} {{ $batch->areaLead->surname }}</td> --}}
                                                    <td>{{ $batch->area_names() }}</td>
                                                    <td>{{ $batch->user_names() }}</td>
                                                    <td>{{ $batch->date_scheduled }}</td>
                                                    <td>{{ $batch->from_time }}</td>
                                                    <td>{{ $batch->to_time }}</td>
                                                    <td><button class="btn btn-danger btn-remove" type="button"><i class="fa fa-times"></i></button></td>
                                                    <input type="hidden" name="area_names[]" value="{{ implode(',', $batch->areas->pluck('id')->toArray()) }}">
                                                    <input type="hidden" name="auditors[]" value="{{ implode(',', $batch->users->unique()->pluck('id')->toArray()) }}">
                                                    <input type="hidden" name="lead[]" value="{{$batch->areaLead[0]->lead_user_id}}">
                                                    <input type="hidden" name="date_selected[]" value="{{$batch->date_scheduled}}">
                                                    <input type="hidden" name="from_time[]" value="{{$batch->from_time}}">
                                                    <input type="hidden" name="to_time[]" value="{{$batch->to_time}}">
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                     </div>
                                </div>
                                <div style="text-align: right" class="pb-5">
                                    <button type="submit" class="btn btn-success btn-save px-3 py-2"><i class="fa fa-save"></i> Save Audit Plan</button>
                                </div>
                            </form>
                        
                    </div>
                </div>
            </div>
    
            <div class="col-lg-3 p-3">
                <div class="m-3 bg-white py-2">
                    <button class="btn btn text-success" type="button" data-toggle="collapse" data-target="#internal-auditors" aria-expanded="true" aria-controls="internal-auditors" style="border: none; box-shadow: none;">
                        <i class="fas fa-bars"></i>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;INTERNAL AUDITORS
                    </button>
    
                    <div class="collapse show m-3" id="internal-auditors" style="flex-direction: row-reverse;">
                        @if(auth()->user()->role->role_name == 'Internal Lead Auditor')
                        <div class="card bg-light border-0">
                            <div class="card-body p-3">
                                @foreach($auditors as $user)
                                <div class="media align-items-center mb-4">
                                    <img src="{{ Storage::url($user->img) }}" alt="Avatar" class="rounded-circle mr-3" alt="Profile Image" width="50">
    
                                    <div class="media-body">
                                        <h6 class="mt-0 text-primary">{{ sprintf("%s %s", $user->firstname ?? '', $user->surname ?? '') }}</h6>
                                        <p class="mb-0 text-success small">Assigned on:</p>
                                        <ul class="list-unstyled mb-0 text-muted small">
                                            @foreach($user->getAssignedAreas() as $assignedArea)
                                            <li class="mb-1">{{ $assignedArea }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    
        <div class="modal fade" id="addProcessModal" tabindex="-1" aria-labelledby="addProcessModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Process And Auditors</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <div class="mb-3 auditors-panel-1">
                                <label for="name" class="form-label">Process</label>
                                <select required id="processes" class="form-control select21" required data-placeholder="Select a process" required>
                                    <option disabled selected>Select a process</option>
                                    @foreach($main as $process)
                                        <option value="{{ $process['text'] }}">{{ $process['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 auditors-panel-4">
                                <label for="name" class="form-label">Institute/Office</label>
                                <select required id="area_list" class="form-control select24" multiple="multiple" required data-placeholder="Select an office/intitute" required>
                                    {{-- <option disabled selected>Select an office/intitute</option> --}}
                                </select>
                            </div>
                            <div class="mb-3 auditors-panel-2">
                                <label for="name" class="form-label">Team Lead</label>
                                <select required id="lead" class="form-control select22" required data-placeholder="Choose Team Lead" required>
                                    @foreach($auditors as $user)
                                        <option value="{{ $user->id }}">{{ sprintf("%s %s", $user->firstname ?? '', $user->surname ?? '') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 auditors-panel-3">
                                <label for="name" class="form-label">Auditors</label>
                                <select required id="auditors" class="form-control select23" multiple required data-placeholder="Choose Auditors" required>
                                    @foreach($auditors as $user)
                                        <option value="{{ $user->id }}">{{ sprintf("%s %s", $user->firstname ?? '', $user->surname ?? '') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-lable">Date</label>
                                <input type="date" id="date_selected" class="form-control" name="date[]" required>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-lable">From</label>
                                <input type="time" id="from_time" class="form-control" name="from_time[]" required>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-lable">To</label>
                                <input type="time" id="to_time" class="form-control" name="to_time[]" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success btn-add-process"><i class="fa fa-plus"></i> Add</button>
                            <button type="button" class="btn btn-close-modal btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
@endsection


@section('js')
<script src="{{ asset('packages/bootstrap-treeview-1.2.0/src/js/bootstrap-treeview.js') }}"></script>
<script>
    
    var areas = {!! json_encode($tree_areas) !!};
    var main = {!! json_encode($main) !!};
    var list = {!! json_encode($list) !!};

    var tree = $('.tree').treeview({
        data: main,
        multiSelect: false,
        collapseIcon: "fa fa-minus",
        expandIcon: "fa fa-plus",
        onNodeSelected: function(event, data) {
            var processName = data.text;
            var unselectedNodes = tree.treeview('getUnselected');
            unselectedNodes.forEach(element => {
                if(processName == element.text) {
                    tree.treeview('selectNode', [ element.nodeId, { silent: true } ]);
                }
            });
        }
    });

    $('.btn-process-modal').on('click', function(){
        // var selectedNodes = tree.treeview('getSelected');
        // selectedNodes.forEach(element => {
        //     tree.treeview('unselectNode', [ element.nodeId, { silent: true } ]);
        // });
    });
    

    tree.treeview('expandAll', { levels: 1});

    $('.select21').select2({
        'width': '100%',
        dropdownParent: $('.auditors-panel-1')
    });
    $('.select22').select2({
        'width': '100%',
        dropdownParent: $('.auditors-panel-2')
    });
    $('.select23').select2({
        'width': '100%',
        dropdownParent: $('.auditors-panel-3')
    });
    $('.select24').select2({
        'width': '100%',
        dropdownParent: $('.auditors-panel-4')
    });

    $('.select21').change(function(){
        let area = $(this).val();
        $('.rmv').remove();
        $.ajax({
            url: "{{route('lead-auditor.audit.create.list')}}",
            type: 'GET',
            data: { area: area },
            success: function(response) {
                // console.log("AJAX Response:", response);
                console.log(response.data);
                for (const key in response.data) {
                    let newOpton = $('<option>').text(key).addClass('rmv').val(response.data[key]['process_id']);
                    $('#area_list').append(newOpton);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
            }
        });
    });

    $("#audit_plan_date").flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });

    

    $('.btn-save').on('click', function(e){
        if($('.table-process tbody > tr').length == 0) {
            e.preventDefault();
            Swal.fire({
                text: 'Please Add Process...',
                icon: 'warning',
            });
        }
    });

    $('.btn-add-process').on('click', function() {
        
        var auditors_name = '';
        var auditors_id = '';
        var lead_name = '';
        var lead_id = '';
        var area_names = '';
        $('#processes option:selected').each(function(i, val){
            area_names += val.text;
            if(i <  ($('#processes option:selected').length -1)) {
                area_names += ', ';
            }
        });
        $('#auditors option:selected').each(function(i, val){
            auditors_name += val.text;
            auditors_id += val.value;
            if(i <  ($('#auditors option:selected').length -1)) {
                auditors_name += ', ';
                auditors_id += ',';
            }
        });

        $('#lead option:selected').each(function(i, val){
            lead_name += val.text;
            lead_id += val.value;
            if(i <  ($('#lead option:selected').length -1)) {
                lead_name += ', ';
                lead_id += ',';
            }
        });

        let date_selected = $('#date_selected').val();
        let from_time = $('#from_time').val();
        let to_time = $('#to_time').val();

        auditors_id = auditors_id + ',' + lead_id;
        let temp = auditors_id.split(",");
        let arr = [];
        for (const key in temp) {
            if (!arr.includes(temp[key])) {
                arr.push(temp[key]);
            }
        }
        auditors_id = arr.join(',');
        let area_list = $('#area_list').val();
        let area_name = [];
        let a = $('#area_list').find(":selected");
        console.log($('#area_list').find(":selected"));
        for (const key in a) {
            if (a[key]['innerText']) {
                area_name.push(a[key]['innerText']);
            }
        }
        area_name = area_name.join(',');

        if (
            date_selected == '' ||
            from_time == '' ||
            to_time == '' ||
            lead_name == '' ||
            area_names == '' ||
            auditors_name == ''||
            area_list == ''
        ) {
           alert('Please fill up all the values needed!');
           return;
        }

        $('.table-process tbody').append(`<tr>
                <td>` + lead_name + `</td>
                <td>` + area_name + '-' + area_names +`</td>
                <td>` + auditors_name + `</td>
                <td>` + date_selected + `</td>
                <td>` + from_time + `</td>
                <td>` + to_time + `</td>
                <td>
                    <button class="btn btn-danger btn-remove" type="button"><i class="fa fa-times"></i></button>
                    <input type="hidden" name="lead[]" value="` + lead_id + `">
                    <input type="hidden" name="area_names[]" value="` + area_list + `">
                    <input type="hidden" name="auditors[]" value="` + auditors_id + `">
                    <input type="hidden" name="date_selected[]" value="` + date_selected + `">
                    <input type="hidden" name="from_time[]" value="` + from_time + `">
                    <input type="hidden" name="to_time[]" value="` + to_time + `">
                </td>
        </tr>`);

        $('.btn-close-modal').trigger('click');
    });

    $(document).on('click','.btn-remove', function(){
        $(this).parents('tr').remove();
    });
</script>
@endsection