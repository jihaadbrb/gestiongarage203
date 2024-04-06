<table id="datatable-buttons"
class="table table-striped table-bordered dt-responsive nowrap"
style="border-collapse: collapse; border-spacing: 0; width: 100%;">


<thead>
    <tr>
        <th>{{ __('start') }}</th>
        <th>{{ __('email') }}</th>
        <th>{{ __('address') }}</th>
        <th>{{ __('phone_number') }}</th>
        <th>{{ __('start_date') }}</th>
        <th>{{ __('action') }}</th>
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
            <button type="button" class="btn btn-primary edit-client"
                data-client-id="{{ $client->id }}"
                data-client-name="{{ $client->name }}"
                data-client-email="{{ $client->email }}"
                data-client-address="{{ $client->address }}"
                data-client-phone="{{ $client->phoneNumber }}">
                <i class="ri-edit-2-fill"></i>
            </button>
            <button type="button" class="btn btn-danger delete-client"
                data-client-id="{{ $client->id }}">
                <i class="r ri-delete-bin-3-line"></i>
            </button>

        </td>
    </tr>

    @endforeach

    @include('admin.layouts.components.edit-modal')
    @include('admin.layouts.components.add-modal')
    @include('admin.layouts.components.confirm-modal')

</tbody>
</table>