@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Welcome to Nanx Traveling</h3>

    <!-- Statistik Wisata dan Penginapan -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card" style="background: linear-gradient(to right, #4976e7, #7cc6fa);" >
                <div class="card-body text-center text-white">
                    <h5 class="card-title">Jumlah Wisata</h5>
                    <p class="card-text display-4">{{ $touristsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="background: linear-gradient(to right, #9e72ce, #7cc6fa);">
                <div class="card-body text-center text-white">
                    <h5 class="card-title">Jumlah Penginapan</h5>
                    <p class="card-text display-4">{{ $accommodationsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="background: linear-gradient(to right, #ffcc00, #ff9900);">
                <div class="card-body text-center text-white">
                    <h5 class="card-title">Jumlah Total Pemesanan</h5>
                    <p class="card-text display-4">{{ $ordersCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 align-items-center">
        <div class="col-md-4">
            <div class="btn-group w-100" role="group">
                <button id="touristBtn" class="btn btn-primary w-50" onclick="toggleActive(this)">
                    <i class="fas fa-map-signs"></i> Wisata
                </button>
                <button id="accommodationBtn" class="btn btn-light w-50" onclick="toggleActive(this)">
                    <i class="fas fa-hotel"></i> Penginapan
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <select id="sortSelect" class="form-control">
                <option value="default">Sort By</option>
                <option value="name">Name</option>
                <option value="location">Location</option>
            </select>
        </div>
    </div>
    

    <!-- List to display either tourists or accommodations -->
    <div id="listContainer" class="row">
        <!-- Tourist Attractions -->
        <div id="touristList" class="col-md-12 d-none">
            <h2 class="text-center my-4">Daftar Wisata</h2>
            <div class="row" id="touristCards">
                @foreach($tourists as $tourist)
                    <div class="col-md-4 mb-4 tourist-card">
                        <div class="card">
                            <img src="{{ asset('storage/' . $tourist->image) }}" class="card-img-top" alt="{{ $tourist->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $tourist->name }}</h5>
                                <p class="card-text">{{ $tourist->description }}</p>
                                <p class="card-text"><small class="text-muted">{{ $tourist->location }}</small></p>
                                <a href="{{ route('accommodation-orders.create', $tourist->id) }}" class="btn btn-light">Pesan</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Accommodations -->
        <div id="accommodationList" class="col-md-12 d-none">
            <h2 class="text-center my-4">Daftar Penginapan</h2>
            <div class="row" id="accommodationCards">
                @foreach($accommodations as $accommodation)
                    <div class="col-md-4 mb-4 accommodation-card">
                        <div class="card">
                            <img src="{{ asset('storage/' . $accommodation->image) }}" class="card-img-top" alt="{{ $accommodation->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $accommodation->name }}</h5>
                                <p class="card-text">Harga: Rp{{ number_format($accommodation->price, 2, ',', '.') }}</p>
                                <p class="card-text"><small class="text-muted">{{ $accommodation->location }}</small></p>
                                <a href="{{ route('accommodation-orders.create', $accommodation->id) }}" class="btn btn-light">Pesan</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')<script>
    function toggleActive(button) {
        const touristBtn = document.getElementById('touristBtn');
        const accommodationBtn = document.getElementById('accommodationBtn');

        if (button === touristBtn) {
            touristBtn.classList.add('btn-primary');
            touristBtn.classList.remove('btn-light');
            accommodationBtn.classList.add('btn-light');
            accommodationBtn.classList.remove('btn-primary');
        } else {
            accommodationBtn.classList.add('btn-primary');
            accommodationBtn.classList.remove('btn-light');
            touristBtn.classList.add('btn-light');
            touristBtn.classList.remove('btn-primary');
        }
    }
    $(document).ready(function() {
        // Show tourist list by default
        $('#touristList').removeClass('d-none');

        // Handle button clicks
        $('#touristBtn').click(function() {
            $('#accommodationList').addClass('d-none');
            $('#touristList').removeClass('d-none');
        });

        $('#accommodationBtn').click(function() {
            $('#touristList').addClass('d-none');
            $('#accommodationList').removeClass('d-none');
        });

        // Search functionality
        $('#searchInput').on('keyup', function() {
            var searchValue = $(this).val().toLowerCase();
            $('.tourist-card, .accommodation-card').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1)
            });
        });

        // Sorting functionality
        $('#sortSelect').on('change', function() {
            var sortBy = $(this).val();
            var cards = $('.tourist-card, .accommodation-card');

            // Convert the jQuery object to an array for sorting
            cards = Array.from(cards);

            cards.sort(function(a, b) {
                if (sortBy === 'name') {
                    return $(a).find('.card-title').text().localeCompare($(b).find('.card-title').text());
                } else if (sortBy === 'location') {
                    return $(a).find('.text-muted').text().localeCompare($(b).find('.text-muted').text());
                }
                return 0;
            });

            // Append sorted cards back to the respective container
            if ($('#touristList').is(':visible')) {
                $('#touristCards').empty().append(cards.filter(card => $(card).hasClass('tourist-card')));
            } else {
                $('#accommodationCards').empty().append(cards.filter(card => $(card).hasClass('accommodation-card')));
            }
        });
    });
</script>

@endsection
