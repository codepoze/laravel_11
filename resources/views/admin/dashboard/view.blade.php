<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    @endpush
    <!-- end:: css local -->

    <!-- begin:: content -->
    <section>
        <div class="row justify-content-center">
            @foreach ($antrean as $row)
            <div class="col-md-4 col-6 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h4>{{ $row['no_antrean'] }}</h4>
                        <h6 class="text-muted m-b-0">Jumlah Antrean {{ $row['nama'] }}</h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- end:: content -->

    <!-- begin:: js local -->
    @push('js')
    @endpush
    <!-- end:: js local -->
</x-admin-layout>