@php
    use App\Models\User;
    $notifikasiCount = count(
        User::with('notifikasi')
            ->where('id', auth()->user()->id)
            ->first()
            ->notifikasi->where('mark', 'false'),
    );
    // $notifikasiCount = 5
@endphp

<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="javascript:;">{{$title}}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav">
                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="get-data"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="nc-icon nc-bell-55"></i>
                        <p>
                            <span class="badge bg-primary" id="notif-number"
                                style="color: white;">{{ $notifikasiCount }}</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="get-data">
                        <div id="data"></div>
                        {{-- <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a> --}}
                    </div>
                </li>
                <li class="nav-item">
                  <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    {{-- <a class="nav-link btn-rotate border-0" type="submit">
                      <i class="fa fa-sign-out" aria-hidden="true"></i> 
                    </a> --}}
                    <a class="nav-link btn-rotate" href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <p>
                          <span href="{{ route('logout') }}"
                                onclick="" class="d-sm-inline d-none"></span>
                        </p>
                    </a>
                  </form> 
                </li>

            </ul>
        </div>
    </div>
</nav>
@push('js')
<script>
  $(document).ready(function() {
    // alert('oke')
      $('#get-data').click(function() {
          $.ajax({
              url: "{{ route('notifi.mark') }}",
              type: 'GET',
              dataType: 'json',
              success: function(data) {
                  // tampilkan data pada halaman
                  // console.log(data)
                  $('#data').empty()
                  $('#data').html(`
                      <li class="dropdown-header">
                          pesan terakhir
                              <a href="{{ route('notifikasi') }}" class="text-decoration-none">
                                  <span class="badge rounded-pill bg-primary p-2 ms-2">View all
                                  </span>
                              </a>
                          </li>
                          <li>
                          <hr class="dropdown-divider"></hr>
                              </li>
                      `)
                  if (data.length == 0) $('#data').append(
                      `<li class="notification-item"> <h4 class="mx-auto text-center mt-2">pesan kosong</h4></li>`
                  )
                  else {
                      $.each(data, async function(index, item) {
                          // console.log(index)
                          var row = $('<li>').addClass(
                              'd-flex justify-content-between align-items-center'
                              );
                          if (item.status == 'berhasil') {
                              var i = $('<i>').addClass(
                                  'fa fa-check text-success me-2')
                          } else {
                              var i = $('<i>').addClass(
                                  'fa fa-x-circle text-danger')
                          }
                          var div = $('<div>').addClass('ms-2').css('cursor', 'pointer')
                          var h5 = $('<h5>').addClass(
                              'font-poppins text-uppercase').text(
                              "tabel " +
                              await item
                              .nama_table);
                          var p = $('<span>').addClass(
                              'font-poppins font-weight-bold mb-2 fs-12'
                              ).text(
                              await item.msg);
                          var hr = $('<hr>').addClass('dropdown-divider');
                          div.append(h5, p)
                          row.append(i, div)
                          $('#data').append(row, hr)

                      })
                  }

                  $('#notif-number').html('0')

              },
              error: function(data) {
                  // tampilkan pesan error pada halaman
                  // console.log(data)
              }
          });
      });
  });
</script>
@endpush
