<div>
    <div class="row mt-4">
        <div class="col">
            <input type="text" class="form-control my-2" placeholder=" Search" wire:model="searchTerm" />

            <table class="table table-hover table-responsive-sm">
                <thead>
                    <tr>
                        <th>zip_name</th>
                        <th>Sizes</th>


                        <th class="text-end">{{ __('labels.backend.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ZipFiles as $ZipFile)
                    <tr>

                        <td>{{ $ZipFile->zip_name }}</td>
                        <td>
                            {!! $ZipFile->Sizes !!}
                            {!! $ZipFile->confirmed_label !!}
                        </td>




                        <td class="text-end">

                            <a href="{{url('admin/uploadZip', $ZipFile)}}" class="btn btn-success btn-sm mt-1" data-toggle="tooltip" title="Update Files"><i class="fas fa-file"></i></a>
                            <a href="{{url('admin/deleteZip', $ZipFile)}}" class="btn btn-danger btn-sm mt-1" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.delete')}}" data-confirm="Are you sure?"><i class="fas fa-trash-alt"></i></a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-7">
            <div class="float-left">
                {!! $ZipFiles->total() !!} {{ __('labels.backend.total') }}
            </div>
        </div>
        <div class="col-5">
            <div class="float-end">
                {!! $ZipFiles->links() !!}
            </div>
        </div>
    </div>
</div>
