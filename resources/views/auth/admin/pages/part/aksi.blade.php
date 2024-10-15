<td>
    <a href="#update-{{ $model->id }}" data-toggle="modal" class="badge bg-warning" style="color: white">edit</a>
</td>
<div class="modal fade" id="update-{{ $model->id }}" tabindex="-1" role="dialog"
    aria-labelledby="update-{{ $model->id }}-Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Update
                </h5>
            </div>
            <form action="{{ route('update.order', ['order' => $model->id]) }}" method="post">
                <div class="modal-body">

                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nama
                                    Barang</label>
                                <input type="text" class="form-control"
                                    value="{{ $model->barang->jenis->jenis . ' ' . $model->barang->merk->merk . ' ' . $model->barang->tipe->tipe }}"
                                    readonly id="recipient-name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Kerusakan</label>
                                <input type="text" name="" value="{{ $model->pesan_kerusakan }}" readonly
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Status</label>
                                <select name="status" id="status-{{ $model->id }}" class="form-control">
                                    @if ($model->status == 'on progress')
                                        <option value="on progress"
                                            {{ $model->status == 'on progress' ? 'selected' : '' }}>
                                            on progress</option>
                                        <option value="selesai" {{ $model->status == 'selesai' ? 'selected' : '' }}>
                                            selesai</option>
                                    @else
                                        <option value="" {{ $model->status == '' ? 'selected' : '' }}>
                                            pending</option>
                                        <option value="on progress"
                                            {{ $model->status == 'on progress' ? 'selected' : '' }}>
                                            on progress</option>
                                        <option value="selesai" {{ $model->status == 'selesai' ? 'selected' : '' }}>
                                            selesai</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="status_selesai-{{ $model->id }}" class="form-group"
                                style="display:{{ $model->status_selesai ? '' : 'none;' }}">
                                <label for="recipient-name" class="col-form-label">Status
                                    Selesai</label>
                                <select name="status_selesai" id="" class="form-control">

                                    <option value="" {{ $model->status_selesai == '' ? 'selected' : '' }}>
                                        Pilih Status Selesai</option>
                                    <option value="rusak berat"
                                        {{ $model->status_selesai == 'Rusak Berat' ? 'selected' : '' }}>
                                        Rusak Berat</option>
                                    <option value="selesai"
                                        {{ $model->status_selesai == 'selesai' ? 'selected' : '' }}>
                                        Bisa Dipakai</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Pesan
                                    Status</label>
                                <textarea name="pesan_status" id="" class="form-control"> {{ $model->pesan_status }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Tanggal
                                    Order</label>
                                <input type="date" value="{{ $model->tanggal_order }}" name="tanggal_order" readonly
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Tanggal
                                    Selesai</label>
                                <input type="date" value="{{ $model->tanggal_selesai }}" name="tanggal_selesai"
                                    class="form-control">
                            </div>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#status-{{ $model->id }}").change(function() {
            // alert($(this).val())
            if ($(this).val() == 'selesai') {
                $("#status_selesai-{{ $model->id }}").show();
                // alert('oke')
            } else {
                $("#status_selesai-{{ $model->id }}").hide();
            }
        });
    });
</script>
