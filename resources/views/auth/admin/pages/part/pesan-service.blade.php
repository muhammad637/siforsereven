 @if ($model->pesan_status != null)
     <button type="button" class="badge bg-gradient-success btn-block mb-0 border-0" data-bs-toggle="modal"
         data-bs-target="#keterangan-{{ $model->id }}">
         <i class="fa fa-envelope" aria-hidden="true"></i>
     </button>
 @else
     <p class="text-sm font-weight-bold mb-0">
         {{ $model->pesan_status == null ? ' - ' : $model->pesan_status }}
     </p>
 @endif
 <div class="modal fade" id="keterangan-{{ $model->id }}" tabindex="-1" role="dialog"
     aria-labelledby="keterangan-{{ $model->id }}Title" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Keterangan
                     Status
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form>
                     <div class="form-group">
                         <label for="recipient-name" class="col-form-label">Nama
                             Teknisi:</label>
                         <input type="text" class="form-control" value="{{ $model->user->nama }}" readonly
                             id="recipient-name">
                     </div>
                     <div class="form-group">
                         <label for="message-text" class="col-form-label">Keterangan
                             Status</label>
                         <textarea class="form-control" id="message-text" readonly value="{{ $model->pesan_status }}">{{ $model->pesan_status }}</textarea>
                     </div>
                     <div class="form-group">
                         <label for="tanggal_edit" class="col-form-label">Terakhir diupdate</label>
                         <input type="text" id="tanggal_edit" class="form-control"
                             value="{{Carbon\Carbon::parse($model->updated_at)->format('d-M-Y H:i:s') }}"readonly>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn bg-gradient-secondary" data-dismiss="modal" aria-label="Close">Close
                 </button>
             </div>
         </div>
     </div>
 </div>
