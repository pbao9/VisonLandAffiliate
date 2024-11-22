<div class="d-flex gap-2 justify-content-center">
    <a href="{{ route('admin.user.customer.edit', $id) }}"><x-button type="button" class="btn-info btn-icon">
            <i class="ti ti-pencil"></i>
        </x-button></a>
    <x-button.modal-delete class="btn-icon"
        data-route="{{ route('admin.user.customer.delete', [
            'user_id' => $user_id,
            'id' => $id,
        ]) }}">
        <i class="ti ti-trash"></i>
    </x-button.modal-delete>

</div>
