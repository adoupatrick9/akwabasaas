    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditPromo" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="editPromo" method="post" action="">
             @csrf
             @method('put')
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modifier une promotion</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-6 form-group">
                   Intitulé <em class="text-danger">*</em><input type="text" name="pro_intitule" id="pro_intitule" autocomplete="on" class="form-control placeholder-no-fix text-uppercase">
                </div>
                <div class="col-md-6 form-group">
                    Service <em class="text-danger">*</em><select name="Sce_code_service" id="Sce_code" class="form-control placeholder-no-fix">
                        @foreach($services as $service)
                            <option value="{{ $service['sce_code_service'] }}">{{ $service['Sce_nom_service'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    Devise <em class="text-danger">*</em><select name="Dev_code_devise" id="Dev_code" class="form-control placeholder-no-fix">
                        @foreach($devises as $devise)
                            <option value="{{ $devise['Dev_code_devise'] }}">{{ $devise['Dev_intitule_devise'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    Début période <em class="text-danger">*</em><input type="date" name="pro_debut_periode" id="pro_debut_periode" autocomplete="on" class="form-control placeholder-no-fix">
                </div>
                <div class="col-md-6 form-group">
                    Fin période <em class="text-danger">*</em><input type="date" name="pro_fin_periode" id="pro_fin_periode" autocomplete="on" class="form-control placeholder-no-fix">
                </div>
                <div class="col-md-6 form-group">
                    Coût unitaire<input type="number" name="pro_cout_unitaire" id="pro_cout_unitaire" autocomplete="on" class="form-control placeholder-no-fix">
                </div>
                <div class="col-md-6 form-group">
                    Coût mensuel <em class="text-danger">*</em><input type="number" name="pro_cout_mensuel" id="pro_cout_mensuel" autocomplete="on" class="form-control placeholder-no-fix">
                </div>
                <div class="col-md-6 form-group">
                    Coût trimestriel <em class="text-danger">*</em><input type="number" name="pro_cout_trimestriel" id="pro_cout_trimestriel" autocomplete="on" class="form-control placeholder-no-fix">
                </div>
                <div class="col-md-6 form-group">
                    Coût semestriel <em class="text-danger">*</em><input type="number" name="pro_cout_semestriel" id="pro_cout_semestriel" autocomplete="on" class="form-control placeholder-no-fix">
                </div>
                <div class="col-md-6 form-group">
                    Coût annuel <em class="text-danger">*</em><input type="number" name="pro_cout_annuel" id="pro_cout_annuel" autocomplete="on" class="form-control placeholder-no-fix">
                </div>
                <input type="number" name="IDas_promotion" id="IDas_promotion" class="hidden">
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
              <button class="btn btn-theme" type="submit">Modifier <i class="fa fa-edit"></i></button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->

