@props(['formAction', 'recordId'])

<x-misc.button
    style="transparent"
    class="td__delete"
    icon="delete"
    title="{{ __('Delete') }}"
    data-click-action="show-target-delete-modal"
    :data-form-action="$formAction"
    :data-target-id="$recordId" />
