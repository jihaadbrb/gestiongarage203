@extends('admin.layouts.home')
@section('content')
<div class="main-content">
    <style>
        .add-new {
            display: flex;
            width: 100%;
            justify-content: space-between;
        }

        .add-client,.import-clients {
            border: 0;
            border-radius: 5px;
            padding: 8px 19px;
        }
        #importForm {
  display: flex;
  flex-direction: column;
  gap: 10px; /* Adjust spacing between elements */
}

#file {
  padding: 5px;
  border: 1px solid #ccc;
}

#importButton {
  background-color: #007bff; /* Adjust button color */
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px; /* Add rounded corners */
  cursor: pointer; /* Indicate clickable element */
}

    </style>
    <div class="page-content">
        <div class="container-fluid">


            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="add-new">

                                <h4 class="card-title">{{ __('Client List') }}</h4>
                                <button class="btn-primary  add-client">{{ __('Add New Client') }}</button>
                                <button class="btn-primary import-clients">
                                    <i class="fas fa-upload"></i> {{ __('Import Clients') }}
                                  </button>
                                  
                                    {{-- <form action="{{ route('import.users') }}" method="POST" enctype="multipart/form-data" id="importForm">
                                        @csrf
                                        <div class="form-group">
                                        <label for="file">Select Excel File</label>
                                        <input type="file" name="file" id="file" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="importButton">Import Users</button>
                                    </form> --}}
                                  
                                <p class="card-title-desc">

                                </p>
                            </div>
                            
                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">


                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Address') }}</th>
                                        <th>{{ __('Phone Number') }}</th>
                                        <th>{{ __('Start Date') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr data-client-id="{{ $client->deleteId }}" id="row">
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->address }}</td>
                                        <td>{{ $client->phoneNumber }}</td>
                                        <td>{{ $client->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn  edit-client"
                                                data-client-id="{{ $client->id }}"
                                                data-client-name="{{ $client->name }}"
                                                data-client-email="{{ $client->email }}"
                                                data-client-address="{{ $client->address }}"
                                                data-client-phone="{{ $client->phoneNumber }}">
                                                <i class=" ri-edit-2-line "></i>
                                            </button>
                                            <button type="button" class="btn  delete-client"
                                                data-client-id="{{ $client->id }}">
                                                <i class="r ri-delete-bin-3-line"></i>
                                            </button>
                                            <button type="button" class="btn  show-client"
                                            data-client-id="{{ $client->id }}">
                                            <i class=" ri-file-info-line
                                            "></i>
                                            </button>
                                        </td>
                                    </tr>

                                    @endforeach

                                    @include('admin.layouts.components.users.edit-modal')
                                    @include('admin.layouts.components.users.add-modal')
                                    @include('admin.layouts.components.users.import-modal')
                                    @include('admin.layouts.components.users.confirm-modal')
                                    @include('admin.layouts.components.users.show-modal')

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © elklie.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        {{ __('crafted_with_love') }}
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

<!-- Modal for editing client -->

@endsection
