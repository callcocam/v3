<div>
    <div class="d-flex flex-column justify-content-center"
         x-data="{
                setUp() {
                    const cropper = new Cropper(document.getElementById('cover'), {
                        aspectRatio: 3/2,
                        autoCropArea: 1,
                        viewMode: 1,
                        crop (event) {
                            @this.set('x', event.detail.x)
                            @this.set('y', event.detail.y)
                            @this.set('width', parseInt(event.detail.width))
                            @this.set('height', parseInt(event.detail.height))
                        }
                    })
                }
            }"
         x-init="setUp">
        <div class="w-100"
             wire:ignore>
            <img id="cover" src="{{ \Illuminate\Support\Facades\Storage::url($cover) }}"
                 style="width: 100%; max-width: 100%;">
        </div>
        <div class="d-flex justify-content-between pt-2 pb-2"
             wire:ignore>
            <button wire:click="save('{{$cover}}','{{$name}}')" type="button" class="btn btn-primary">
                Aplicar
            </button>
            <button wire:click="cancel('{{$cover}}','{{$name}}')" type="button" class="btn btn-danger">
                Cancelar
            </button>
        </div>
        <div class="d-flex justify-content-between">
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3 p-1">
                        <span class="input-group-text">Largura</span>
                        <input wire:model="width" type="text" class="form-control"
                               aria-label="Amount (to the nearest dollar)"
                               placeholder="1500px"
                               readonly>
                        <span class="input-group-text">Px</span>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3 p-1">
                        <span class="input-group-text">Altura</span>
                        <input  wire:model="height" type="text" class="form-control"
                                aria-label="Amount (to the nearest dollar)"
                                placeholder="1000px"
                                readonly>
                        <span class="input-group-text">Px</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

