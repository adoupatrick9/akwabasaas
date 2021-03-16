
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalStorePromo" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="addPromo" method="post">
             @csrf
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Ajouter une promotion</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-6 form-group">
                   Intitulé <em class="text-danger">*</em><input type="text" name="pro_intitule" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('pro_intitule') }}">
                </div>
                <div class="col-md-6 form-group">
                    Service <em class="text-danger">*</em><select name="Sce_code_service" id="Sce_code_service" class="form-control placeholder-no-fix">
                        @foreach($services as $service)
                            <option value="{{ $service['sce_code_service'] }}">{{ $service['Sce_nom_service'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    Devise <em class="text-danger">*</em><select name="dev_code_devise" id="dev_code_devise" class="form-control placeholder-no-fix">
                        @foreach($devises as $devise)
                            <option value="{{ $devise['dev_code_devise'] }}">{{ $devise['dev_intitule_devise'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    Début période <em class="text-danger">*</em><input type="date" name="pro_debut_periode" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('pro_debut_periode') }}">
                </div>
                <div class="col-md-6 form-group">
                    Fin période <em class="text-danger">*</em><input type="date" name="pro_fin_periode" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('pro_fin_periode') }}">
                </div>
                <div class="col-md-6 form-group">
                    Coût unitaire<input type="number" name="pro_cout_unitaire" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('pro_cout_unitaire') }}">
                </div>
                <div class="col-md-6 form-group">
                    Coût mensuel <em class="text-danger">*</em><input type="number" name="pro_cout_mensuel" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('pro_cout_mensuel') }}">
                </div>
                <div class="col-md-6 form-group">
                    Coût trimestriel <em class="text-danger">*</em><input type="number" name="pro_cout_trimestriel" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('pro_cout_trimestriel') }}">
                </div>
                <div class="col-md-6 form-group">
                    Coût semestriel <em class="text-danger">*</em><input type="number" name="pro_cout_semestriel" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('pro_cout_semestriel') }}">
                </div>
                <div class="col-md-6 form-group">
                    Coût annuel <em class="text-danger">*</em><input type="number" name="pro_cout_annuel" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('pro_cout_annuel') }}">
                </div>
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
              <button class="btn btn-theme" type="submit">Enregistrer <i class="fa fa-save"></i></button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
