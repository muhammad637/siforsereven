  @foreach ($orders as $order)
                                    
                                            {{-- @php
                                                // $i += $order->jumlah_order;
                                                // $nohp = $order->no_pelapor;
                                                // if (substr(trim($nohp), 0, 1) == '0') {
                                                //     $nohp = '62' . substr(trim($nohp), 1);
                                                // }
                                                // $nohpteknisi = $order->user->no_telephone;
                                                // if (substr(trim($nohpteknisi), 0, 1) == '0') {
                                                //     $nohpteknisi = '62' . substr(trim($nohpteknisi), 1);
                                                // }
                                                $nohpteknisi = 1;
                                                $nohp = 1;
                                                // $array = json_decode($order->pesan, true);
                                            @endphp --}}
                                            <tr>
                                                <td class="text-center"> {{ Carbon::parse($order->created_at)->format('d-M-Y') }}
                                                    <br>{{ Carbon::parse($order->created_at)->format('H:i:s') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $order->barang->jenis->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe->tipe }}
                                                </td>
                                                <td class="text-center">{{ $order->ruangan->nama }}</td>
                                                <td class="text-center"><a
                                                        href="https://wa.me/{{ $nohp }}/?text=SIFORSEVEN%0Auntuk : {{ $order->nama_pelapor }}%0Aservisan barang  {{ $order->barang->jenis->jenis }} {{ $order->barang->merk->merk }} {{ $order->barang->tipe->tipe }} %0Astatus masih :{{ $order->status == null ? 'pending' : $order->status }} %0Adengan keterangan status: {{ $order->pesan_status == null ? 'masih menunggu' : $order->pesan_status }} %0Adari Admin SIFORSEVEN: {{ auth()->user()->nama }}"
                                                        target="_blank" class="badge bg-info p-2"
                                                        style="color: white"><span>
                                                            {{ $order->nama_pelapor }}
                                                        </span><i class="fa fa-whatsapp fs-6" aria-hidden="true"></i> </a>
                                                </td>
                                                <td class="text-center">
                                                    {{ $order->status == null ? 'pending' : $order->status }}</td>
                                                <td class="text-center">
                                                    @if ($order->pesan_status != null)
                                                        <button type="button"
                                                            class="badge bg-gradient-success btn-block mb-0 border-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#keterangan-{{ $order->id }}">
                                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                                        </button>
                                                    @else
                                                        <p class="text-sm font-weight-bold mb-0">
                                                            {{ $order->pesan_status == null ? ' - ' : $order->pesan_status }}
                                                        </p>
                                                    @endif
                                                </td>
                                                <td class="text-center"> {{ $order->pesan_kerusakan }}</td>
                                                <td class="text-center">
                                                    {{ $order->tanggal_selesai ? $parse($order->tanggal_selesai) : '-' }}
                                                </td>
                                                @if (auth()->user()->cekLevel == 'admin')
                                                    <td>

                                                        <a href="https://wa.me/{{ $nohpteknisi }}/?text=SIFORSEVEN%0Auntuk : {{ $order->user->nama }}%0Aada orderan barang {{ $order->barang->jenis->jenis }} {{ $order->barang->merk->merk }} {{ $order->barang->tipe->tipe }}%0Adengan keluhan {{ $order->pesan_kerusakan }} %0Adari ruangan {{ $order->ruangan->nama }} %0Amohon diambil di ruang IT RSUD Blambangan Banyuwangi%0Adari Admin SIFORSEVEN: {{ auth()->user()->nama }}%0ATerimakasih"
                                                            target="_blank" class="badge bg-info p-2"
                                                            style="color: white;"><span>{{ $order->user->nama }} </span> <i
                                                                class="fa fa-whatsapp fs-6" aria-hidden="true"></i> </a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="#update-{{ $order->id }}" data-toggle="modal"
                                                            class="badge bg-warning" style="color: white">edit</a>
                                                    </td>
                                                @endif
                                                @if (auth()->user()->cekLevel =='admin')
                                                <td class="text-center">
                                                    <a href="{{ route('order.print', ['order' => $order->id]) }}"
                                                        class="badge bg-success" style="color: white;" target="_blank"><i
                                                            class="fa fa-print" aria-hidden="true"></i></a>
                                                </td>
                                                @endif
                                            </tr>

                                            <div class="modal fade" id="keterangan-{{ $order->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="keterangan-{{ $order->id }}Title"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Keterangan
                                                                Status
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Nama
                                                                        Teknisi:</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $order->user->nama }}" readonly
                                                                        id="recipient-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="message-text"
                                                                        class="col-form-label">Keterangan
                                                                        Status</label>
                                                                    <textarea class="form-control" id="message-text" readonly value="{{ $order->pesan_status }}">{{ $order->pesan_status }}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tanggal_edit"
                                                                        class="col-form-label">Terakhir diupdate</label>
                                                                    <input type="text" id="tanggal_edit"
                                                                        class="form-control"
                                                                        value="{{ $parse($order->updated_at) . ' ' . $parse_hour($order->updates_at) }}"readonly>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-secondary"
                                                                data-dismiss="modal" aria-label="Close">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- modal update order --}}
                                            <div class="modal fade" id="update-{{ $order->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="update-{{ $order->id }}-Title"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Form Update
                                                            </h5>
                                                        </div>
                                                        <form
                                                            action="{{ route('update.order', ['order' => $order->id]) }}"
                                                            method="post">
                                                            <div class="modal-body">

                                                                @method('put')
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Nama
                                                                                Barang</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $order->barang->jenis->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe->tipe }}"
                                                                                readonly id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text"
                                                                                class="col-form-label">Kerusakan</label>
                                                                            <input type="text" name=""
                                                                                value="{{ $order->pesan_kerusakan }}"
                                                                                readonly class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Status</label>
                                                                            <select name="status"
                                                                                id="status-{{ $order->id }}"
                                                                                class="form-control">
                                                                                @if ($order->status == 'on progress')
                                                                                    <option value="on progress"
                                                                                        {{ $order->status == 'on progress' ? 'selected' : '' }}>
                                                                                        on progress</option>
                                                                                    <option value="selesai"
                                                                                        {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                                                                        selesai</option>
                                                                                @else
                                                                                    <option value=""
                                                                                        {{ $order->status == '' ? 'selected' : '' }}>
                                                                                        pending</option>
                                                                                    <option value="on progress"
                                                                                        {{ $order->status == 'on progress' ? 'selected' : '' }}>
                                                                                        on progress</option>
                                                                                    <option value="selesai"
                                                                                        {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                                                                        selesai</option>
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div id="status_selesai-{{ $order->id }}"
                                                                            class="form-group"
                                                                            style="display:{{ $order->status_selesai ? '' : 'none;' }}">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Status
                                                                                Selesai</label>
                                                                            <select name="status_selesai" id=""
                                                                                class="form-control">

                                                                                <option value=""
                                                                                    {{ $order->status_selesai == '' ? 'selected' : '' }}>
                                                                                    Pilih Status Selesai</option>
                                                                                <option value="rusak berat"
                                                                                    {{ $order->status_selesai == 'Rusak Berat' ? 'selected' : '' }}>
                                                                                    Rusak Berat</option>
                                                                                <option value="selesai"
                                                                                    {{ $order->status_selesai == 'selesai' ? 'selected' : '' }}>
                                                                                    Bisa Dipakai</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="message-text"
                                                                                class="col-form-label">Pesan
                                                                                Status</label>
                                                                            <textarea name="pesan_status" id="" class="form-control"> {{ $order->pesan_status }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Tanggal
                                                                                Order</label>
                                                                            <input type="date"
                                                                                value="{{ $order->tanggal_order }}"
                                                                                name="tanggal_order" readonly
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text"
                                                                                class="col-form-label">Tanggal
                                                                                Selesai</label>
                                                                            <input type="date"
                                                                                value="{{ $order->tanggal_selesai }}"
                                                                                name="tanggal_selesai"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn bg-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    $("#status-{{ $order->id }}").change(function() {
                                                        // alert($(this).val())
                                                        if ($(this).val() == 'selesai') {
                                                            $("#status_selesai-{{ $order->id }}").show();
                                                            // alert('oke')
                                                        } else {
                                                            $("#status_selesai-{{ $order->id }}").hide();
                                                            // alert("not oke {{ $order->id }}")
                                                        }
                                                    });
                                                });
                                            </script>
                                        @endforeach