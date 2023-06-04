<div class="modal fade" id="modal-car-detail" tabindex="-1" role="dialog" aria-labelledby="modalCarDetail"
    aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCarDetailTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="form-group col-sm-12 d-flex justify-content-center">
                    <img class="circular--square--index d-flex justify-content-center"
                        style="width: 50vh; height: 30vh;" src="" id="modalBodyCarDetailFoto" />
                </div>
                <!-- Kategori Id Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('kategori_id', 'Kategori:') !!}
                    <p id="modalBodyCarDetailKategori"></p>
                </div>

                <!-- Nama Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('nama', 'Nama:') !!}
                    <p id="modalBodyCarDetailNama"></p>
                </div>

                <!-- Jenis Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('jenis', 'Jenis:') !!}
                    <p id="modalBodyCarDetailJenis"></p>
                </div>

                <!-- Merk Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('merk', 'Merk:') !!}
                    <p id="modalBodyCarDetailMerk"></p>
                </div>

                <!-- Harga Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('harga', 'Harga:') !!}
                    <p id="modalBodyCarDetailHarga"></p>
                </div>


                <!-- Denda Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('denda', 'Denda:') !!}
                    <p id="modalBodyCarDetailDenda"></p>
                </div>

                <div class="form-group col-sm-12" id="layanan">
                    <label for="jenis_kelaminModal" class="form-label">Detail Mobil</label>
                    <div class="table-responsive-sm">
                        <table class="table table-striped" id="modalBodyCarDetailMobil">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plat</th>
                                    <th>STNK</th>
                                    <th>Tahun</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="modalBodyCarDetailMobilTable">

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    {{-- <td>
                                        <span class="badge bg-"> </span>
                                    </td> --}}
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
