<form wire:submit.prevent="saveAndGoBack">
    <div class="modal-header">
        <h5 class="modal-title">{{ $title }}</h5>
        <a class="btn btn-danger" href="javascript:;"
            wire:click="closeModalForm('{{ $modalId }}')">{{ __('Fechar') }}</a>
    </div>
    <div class="modal-body p-md-5" style="max-height: calc(100vh - 150px);">
        <div class="row">
            @foreach ($fields as $field)
            <div class="col-sm-12 col-md-{{$field->span}}">
                @include('laravel-livewire-forms::fields.' . $field->view)
            </div>
            @endforeach
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" wire:click="closeModalForm('{{ $modalId }}')">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">{{ __('Cancelar') }}</span>
        </button>
        <x-button type="submit">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">{{ __('Salvar') }}</span>
        </x-button>
    </div>
</form>
