<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h4>Verifikasi</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-2">
                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pemasukan-tab" data-toggle="tab" href="#pemasukan"
                                role="tab" aria-controls="pemasukan" aria-selected="true">Pemasukan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pengeluaran-tab" data-toggle="tab" href="#pengeluaran"
                                role="tab" aria-controls="pengeluaran" aria-selected="false">Pengeluaran</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-10">
                    <div class="tab-content no-padding" id="myTab2Content">
                        <div class="tab-pane fade show active" id="pemasukan" role="tabpanel"
                            aria-labelledby="pemasukan-tab">
                            <form action="{{ route('pemasukan.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <!--nomor_pemasukan-->
                                        <x-input name="nomor_pemasukan" label="Nomor Pemasukan" type="text"
                                            value="{{ old('nomor_pemasukan') }}" />

                                        <!--tanggal_pemasukan-->
                                        <x-input name="tanggal_pemasukan" label="Tanggal Pemasukan" type="date"
                                            value="{{ old('tanggal_pemasukan') }}" />
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <!--sumber_pemasukan-->
                                        <x-input name="sumber_pemasukan" label="Sumber Pemasukan" type="text"
                                            value="{{ old('sumber_pemasukan') }}" />

                                        <!--jumlah_pemasukan-->
                                        <x-input name="jumlah_pemasukan" label="Jumlah Pemasukan" type="number"
                                            value="{{ old('jumlah_pemasukan') }}" start="true" startText="Rp." />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <x-button-primary>
                                            Simpan
                                        </x-button-primary>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="pengeluaran" role="tabpanel" aria-labelledby="pengeluaran-tab">
                            <form action="{{ route('pengeluaran.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <!--nomor_pengeluaran-->
                                        <x-input name="nomor_pengeluaran" label="Nomor Pengeluaran" type="text"
                                            value="{{ old('nomor_pengeluaran') }}" />

                                        <!--nama_kegiatan-->
                                        <x-input name="nama_kegiatan" label="Nama Kegiatan" type="text"
                                            value="{{ old('nama_kegiatan') }}" />

                                        <!--penanggung_jawab-->
                                        <x-input name="penanggung_jawab" label="Penanggung Jawab" type="text"
                                            value="{{ old('penanggung_jawab') }}" />
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <!--sumber_dana-->
                                        <div class="form-group">
                                            <label for="sumber_dana">Sumber Dana</label>
                                            <select
                                                class="form-control select2 @error('sumber_dana') is-invalid @enderror"
                                                id="sumber_dana" name="sumber_dana" style="width: 100%">
                                                <option disabled selected>Pilih</option>
                                                @foreach ($dataPemasukan as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('sumber_dana') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nomor_pemasukan }} - {{ $item->sumber_pemasukan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('sumber_dana')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!--lama_kegiatan-->
                                        <x-input name="lama_kegiatan" label="Lama Kegiatan" type="number"
                                            end="true" endText="Hari" value="{{ old('lama_kegiatan') }}" />

                                        <!--tanggal_pengeluaran-->
                                        <x-input name="tanggal_pengeluaran" label="Tanggal Pengeluaran" type="date"
                                            value="{{ old('tanggal_pengeluaran') }}" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <!--jumlah_pengeluaran-->
                                        <x-input name="jumlah_pengeluaran" label="Jumlah Pengeluaran" type="number"
                                            value="{{ old('jumlah_pengeluaran') }}" start="true"
                                            startText="Rp." />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <x-button-primary>
                                            Simpan
                                        </x-button-primary>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
