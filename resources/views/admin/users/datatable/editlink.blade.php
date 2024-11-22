<div class="d-flex gap-1 align-items-stretch flex-wrap mb-1" style="max-width: 370px;">
    <x-link :href="route('admin.user.edit', $id)" :title="$fullname"/>
</div>
<x-link :href="route('admin.user.customer.index', $id)" :title="__('Các khách hàng thuộc: ').$fullname"/>
