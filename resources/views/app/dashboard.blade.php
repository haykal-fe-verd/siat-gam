<x-app-layout>

    <div class="row ">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="card-content">
                                    <h5 class="font-15">Pemasukan</h5>
                                    <h2 class="mb-3 font-18">Rp. {{ number_format($totalPemasukan) }}</h2>
                                </div>
                            </div>
                            <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="banner-img">
                                    <img src="{{ asset('vectors/pemasukan.svg') }}" alt="Pemasukan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="card-content">
                                    <h5 class="font-15">Pengeluaran</h5>
                                    <h2 class="mb-3 font-18">Rp. {{ number_format($totalPengeluaran) }}</h2>
                                </div>
                            </div>
                            <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="banner-img">
                                    <img src="{{ asset('vectors/pengeluaran.svg') }}" alt="Pengeluaran">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="card-content">
                                    <h5 class="font-15">Sisa</h5>
                                    <h2 class="mb-3 font-18">Rp. {{ number_format($sisaDana) }}</h2>
                                </div>
                            </div>
                            <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="banner-img">
                                    <img src="{{ asset('vectors/sisa.svg') }}" alt="Sisa">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card ">
                <div class="card-header">
                    <h4>Grafik Pemasukan dan Pengeluaran</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('app/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>

        <script>
            var options = {
                chart: {
                    height: 230,
                    type: "line",
                    shadow: {
                        enabled: true,
                        color: "#000",
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 1
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ["#786BED", "#999b9c"],
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    curve: "smooth"
                },
                series: [{
                        name: "Pemasukan",
                        data: {!! json_encode($pemasukanChart, JSON_NUMERIC_CHECK) !!}
                    },
                    {
                        name: "Pengeluaran",
                        data: {!! json_encode($pengeluaranChart, JSON_NUMERIC_CHECK) !!}
                    }
                ],
                grid: {
                    borderColor: "#e7e7e7",
                    row: {
                        colors: ["#f3f3f3", "transparent"],
                        opacity: 0.0
                    }
                },
                markers: {
                    size: 6
                },
                xaxis: {
                    categories: Object.values({!! json_encode($bulan) !!}),
                    labels: {
                        style: {
                            colors: "#9aa0ac"
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: "Jumlah (Rp)"
                    },
                    labels: {
                        style: {
                            color: "#9aa0ac"
                        }
                    },
                },
                legend: {
                    position: "top",
                    horizontalAlign: "right",
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart1"), options);

            chart.render();
        </script>
    @endpush
</x-app-layout>
