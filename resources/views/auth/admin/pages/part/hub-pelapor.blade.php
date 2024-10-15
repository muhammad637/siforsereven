
<a href="https://wa.me/{{ substr(trim($model->no_pelapor), 0, 1) == '0' ? '62' . substr(trim($no_pelapor), 1) : $model->no_pelapor }}/?text=SIFORSEVEN%0Auntuk : {{ $model->nama_pelapor }}%0Aservisan barang  {{ $model->barang->jenis->jenis }} {{ $model->barang->merk->merk }} {{ $model->barang->tipe->tipe }} %0Astatus masih :{{ $model->status == null ? 'pending' : $model->status }} %0Adengan keterangan status: {{ $model->pesan_status == null ? 'masih menunggu' : $model->pesan_status }} %0Adari Admin SIFORSEVEN: {{ auth()->user()->nama }}"
    target="_blank" class="badge bg-info p-2" style="color: white"><span>
        {{ $model->nama_pelapor }}
    </span><i class="fa fa-whatsapp fs-6" aria-hidden="true"></i> </a>
