    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditCoutService" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
          <form method="post" id="editCoutService" action="{{ url('/couts-service-update/') }}">
          @csrf
          @method('put')
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modifier un coût service</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-12 form-group">
                   Intitulé <em class="text-danger">*</em><input type="text" name="cs_intitule" id="cs_intitule" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('cs_intitule') }}">
                </div>
                <div class="col-md-6 form-group">
                    Devise <em class="text-danger">*</em><select name="dev_code_devise" id="dev_code" class="form-control placeholder-no-fix">
                        @foreach($devises as $devise)
                        <option value="{{ $devise['dev_code_devise'] }}">{{ $devise['dev_intitule_devise'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    Type service<em class="text-danger">*</em><select name="cs_type_service" id="cs_type" class="form-control placeholder-no-fix">
                        <option value="1">Saas</option>
                        <option value="2">One premise</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                   Fréquence<em class="text-danger">*</em><input type="number" name="cs_frequence" id="cs_frequence" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('cs_frequence') }}">
                </div>
                <div class="col-md-6 form-group">
                   Coût borne <em class="text-danger">*</em><input type="number" name="cs_cout_borne" id="cs_cout_borne" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('cs_cout_borne') }}">
                </div>
                <div class="col-md-6 form-group">
                    Borne inférieur<em class="text-danger">*</em><input type="number" name="cs_borne_inferieure" id="cs_borne_inferieure" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('cs_borne_inferieure') }}">
                </div>
                <div class="col-md-6 form-group">
                    Borne supérieur<em class="text-danger">*</em><input type="number" name="cs_borne_superieure" id="cs_borne_superieure" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('cs_borne_superieure') }}">
                </div>
                <div class="col-md-6 form-group">
                   Coût mensuel <em class="text-danger">*</em><input type="number" name="cs_cout_mensuel" id="cs_cout_mensuel" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('cs_cout_mensuel') }}">
                </div>
                <div class="col-md-6 form-group">
                   Coût trimestriel <em class="text-danger">*</em><input type="number" name="cs_cout_trimestriel" id="cs_cout_trimestriel" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('cs_cout_trimestriel') }}">
                </div>
                <div class="col-md-6 form-group">
                   Coût semestriel <em class="text-danger">*</em><input type="number" name="cs_cout_semestriel" id="cs_cout_semestriel" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('cs_cout_semestriel') }}">
                </div>
                <div class="col-md-6 form-group">
                   Coût annuel <em class="text-danger">*</em><input type="number" name="cs_cout_annuel" id="cs_cout_annuel" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('cs_cout_annuel') }}">
                </div>
                <div class="col-md-12 text-center text-success chargement">
                    <br>
                    <h6>Veuillez patienter un moment...</h6>
                </div>
            </div>
            <input type="number" name="idas_service" id="idas_service" class="hidden" value="{{ $service['idas_service'] }}">
            <input type="number" name="idas_cout_service" id="idas_cout_service" class="hidden">
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
              <button class="btn btn-theme" type="submit">Modifier <i class="fa fa-edit"></i></button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->

